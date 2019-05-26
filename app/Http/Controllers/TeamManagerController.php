<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Comment;
use App\Feed;
use App\FollowTeam;
use App\Game;
use App\GameRole;
use App\Like;
use App\Notification;
use App\NotificationDetail;
use App\StatsPlayer;
use App\Team;
use App\TeamManager;
use App\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Image;
use Intervention\Image\ImageManagerStatic;

DB::connection()->enableQueryLog();

class TeamManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $userID = Auth::user()->user_ID;

        $TeamOwner = TeamManager::where('user_ID','=',$userID)->first();
        if (isset($TeamOwner)){
            return redirect('team/'.$TeamOwner->teamID)->with('gameList');
        }else{
            return redirect('createteam');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $playerID = $request->playerID;
        $teamID = $request->teamID;
        $gameID = $request->gameID;
        $userID = Auth::user()->user_ID;

        TeamManager::where('tbl_team_manager.teamID','=',$teamID)
            ->where('tbl_team_manager.game_ID','=',$gameID)
            ->whereNull('tbl_team_manager.user_ID')
            ->first()
            ->update(['user_ID' => $playerID,'user_verify' => 0,'expired_invite' => Carbon::now()->addMinutes(5)->toDateTimeString()]);

//        $TeamManager = new TeamManager();
//        $TeamManager->teamID = $teamID;
//        $TeamManager->game_ID = $gameID;
//        $TeamManager->user_ID = $playerID;
//        $TeamManager->user_verify = 0;
//        $TeamManager->expired_invite = Carbon::now()->addMinutes(5)->toDateTimeString();
//        $TeamManager->save();

        $notification = new Notification();
        $notification->notification_User = $playerID;
        $notification->notification_isRead = 0;
        $notification->notification_type = 1;
        $notification->notificaiton_state = 0;
        $notification->save();

        $notificationDetail = new NotificationDetail();
        $notificationDetail->notificaitonID = $notification->notificationID;
        $notificationDetail->teamID = $teamID;
        $notificationDetail->senderID = $userID;
        $notificationDetail->gameID = $gameID;
        $notificationDetail->save();

        return redirect('team');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TeamManager  $teamManager
     * @return \Illuminate\Http\Response
     */
    public function show($teamManager)
    {
        $userID = Auth::user()->user_ID;
        $TeamOwner = Team::where('team_owner','=',$userID)->where('team_ID','=',$teamManager)->first();

        $gameList = Game::get();

        $getTeam = Team::join('tbl_User','tbl_User.user_ID','=','tbl_team.team_owner')
                    ->where('team_ID','=',$teamManager)
                    ->first();

        $listPlayer = TeamManager::join('tbl_User','tbl_User.user_ID','=','tbl_team_manager.user_ID')
                        ->where('tbl_team_manager.teamID','=',$teamManager)
                        ->where('tbl_team_manager.user_verify','=',1)
                        ->get();

        $userRole = UserRole::select('tbl_User_Role.user_ID','tbl_Role.role_name','tbl_User_Role.stateRole','tbl_Game.game_logo','tbl_Role.role_color')
            ->join('tbl_User','tbl_User.user_ID','=','tbl_User_Role.user_ID')
            ->join('tbl_Role','tbl_User_Role.role_ID','=','tbl_Role.role_ID')
            ->join('tbl_team_manager','tbl_team_manager.user_ID','=','tbl_User_Role.user_ID')
            ->join('tbl_Game','tbl_Game.game_ID','=','tbl_User_Role.game_ID')
            ->where('tbl_User_Role.stateRole','>',0)
            ->where('tbl_team_manager.teamID','=',$teamManager)
            ->get();


        $result = $listPlayer->map(function ($item,$key) use ($userRole){
            $orders = $userRole->filter(function ($value, $key) use ($item){
                return $value->user_ID == $item->user_ID;
            });

            $item->role = $orders->values();

            return $item;
        });
        $language = DB::table('tbl_language')->get();

        $feeds = Feed::select('*','tbl_feed.updated_at','tbl_feed.created_at')
            ->join('tbl_User','tbl_User.user_ID','=','tbl_feed.user_ID')
            ->join('tbl_Game','tbl_Game.game_ID','=','tbl_feed.game_ID')
            ->join('tbl_team_manager','tbl_team_manager.user_ID','=','tbl_feed.user_ID')
            ->where('tbl_team_manager.teamID','=',$teamManager)
            ->orderBy('tbl_feed.created_at','desc')
            ->get();

        $asset = Asset::get();

        $feeds->map(function ($item,$key) use ($asset){
            $orders = $asset->filter(function ($value, $key) use ($item){
                return $value->post_ID == $item->post_ID;
            });

            $item->imagePath = $orders->values();

            return $item;
        });

        $listComment = Comment::select('*','tbl_comment.created_at')->join('tbl_User','tbl_User.user_ID','=','tbl_comment.user_ID')
            ->get()->groupBy('post_ID');
        $listComment = ['data'=>$listComment];

        $getLike = Like::select('post_ID',DB::raw('count(post_ID) as total'))->where('state','=',1)->groupBy('post_ID')->get()->keyBy('post_ID');
        $getLike = ['data'=>$getLike];

        $stateLike = Like::select('post_ID','state')->where('user_ID','=',1)->where('state','=',1)->get()->groupBy('post_ID');

        $stateFollow = FollowTeam::where('teamID','=',$teamManager)->where('userID','=',$userID)->first();

        $getFollower = FollowTeam::join('tbl_User','tbl_User.user_ID','=','tbl_team_follow.userID')
            ->where('tbl_team_follow.teamID','=',$teamManager)->get();
        $roleFollower = FollowTeam::join('tbl_User_Role','tbl_User_Role.user_ID','=','tbl_team_follow.userID')
            ->join('tbl_Role','tbl_User_Role.role_ID','=','tbl_Role.role_ID')
            ->join('tbl_Game','tbl_Game.game_ID','=','tbl_User_Role.game_ID')
            ->where('tbl_team_follow.teamID','=',$teamManager)->get();

        $roleFollower = $roleFollower->mapToGroups(function ($item, $key) {
            return [$item['userID'] => ["role_name"=>$item['role_name'],"role_color"=>$item['role_color'],"game_logo"=>$item['game_logo']]];
        });

        $getFollower->map(function ($item) use($roleFollower){
            foreach ($roleFollower as $key => $role){
                if ($key == $item->user_ID){
                    $item->role = $role;
                }
            }
            return $item;
        });

        $listStats = StatsPlayer::join('tbl_Game','tbl_Game.game_ID','=','tbl_stats_player.game_ID')
            ->where('user_ID','=',Auth::user()->user_ID)
            ->get();

        $statePlayer = TeamManager::join('tbl_User','tbl_User.user_ID','=','tbl_team_manager.user_ID')
            ->where('tbl_team_manager.user_ID','=',Auth::user()->user_ID)
            ->where('tbl_team_manager.user_verify','=',1)
            ->get();

        if (count($statePlayer) > 0){
            $statePlayer = true;
        }else{
            $statePlayer = false;
        }

        return view('pages.team',compact('feeds','listComment','getFollower','getLike','stateLike','stateFollow','TeamOwner','language','teamManager','gameList','result','getTeam','listStats','statePlayer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TeamManager  $teamManager
     * @return \Illuminate\Http\Response
     */
    public function edit($teamManager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TeamManager  $teamManager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$teamManager)
    {
        $user_ID = Auth::user()->user_ID;

        $file = $request->file;
        $nameTeam = $request->nameTeam;
        $timeStart = $request->timeStart;
        $timeEnd = $request->timeEnd;
        $language1 = $request->language1;
        $language2 = $request->language2;
        $language3 = $request->language3;

//        return [$file, $nameTeam, $timeStart, $timeEnd, $language1, $language2, $language3];

        $human_readable_date = Carbon::now()->toTimeString();
        $timedata = strtotime($human_readable_date) * 1000;

        $getTeam = Team::find($teamManager);

        $getTeam->team_name = $nameTeam;
        $getTeam->team_owner = $user_ID;
        $getTeam->team_time_start = $timeStart;
        $getTeam->team_time_end = $timeEnd;

        if(isset($file)){
            $image_resize = ImageManagerStatic::make($file->getRealPath());
            $image_resize->resize(320, 320);
            $image_resize->save(public_path().'/data-image/teamLogos/'. $timedata."_".$file->getclientoriginalname());

            $getTeam->team_logo = $timedata."_".$file->getclientoriginalname();
        }

        $language = DB::table('tbl_language')->whereIn('languageID', [$language1, $language2, $language3])->get();
        $languageString = "";

        foreach ($language as $item){
            $languageString = $languageString.$item->language_name;
        }

        $getTeam->team_language = $languageString;
        $getTeam->save();

//        return $teamManager;
        return redirect('team');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TeamManager  $teamManager
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$teamManager)
    {
        $kickID = $request->inputUser_ID;

            TeamManager::where('teamID','=',$teamManager)
                ->where('user_ID','=',$kickID)
                ->update(['user_ID' => null,'user_verify' => 0,'expired_invite' => "9999-12-31"]);

//        return $kickID;
        return redirect('team');
    }

    function logSQL(){
        $queries = DB::getQueryLog();
        return $queries;
    }

    function followTeam(Request $request){
        $user_ID = Auth::user()->user_ID;
        $teamFollow = $request->teamFollow;

        $getFollow = FollowTeam::where('teamID','=',$teamFollow)->where('userID','=',$user_ID)->first();

        if (isset($getFollow)){
            FollowTeam::where('teamID','=',$teamFollow)->where('userID','=',$user_ID)->delete();
        }else{
            $FollowTeam = new FollowTeam();
            $FollowTeam->teamID = $teamFollow;
            $FollowTeam->userID = $user_ID;
            $FollowTeam->save();
        }

        return redirect('team/'.$teamFollow);
    }

    function applyTeam(Request $request){

    }
}
