<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Comment;
use App\Feed;
use App\Follow;
use App\Game;
use App\Like;
use App\StatsPlayer;
use App\Team;
use App\TeamManager;
use App\User;
use App\UserRole;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        if (Auth::user()){
            $userProfile = Auth::user();

//        $client = new Client();
//        $res = $client->request('GET', 'https://ow-api.com/v1/stats/pc/us/Chickenfree-1154/complete');
//        $data = json_decode($res->getBody(), true);
//        dd($data['quickPlayStats']['games'],$data['quickPlayStats']['careerStats']['allHeroes']);

            return redirect('profile/'.$userProfile->user_ID);
        }else{
            return view("pages.home");
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
//        return $request;
        $userID = Auth::user()->user_ID;
        $teamManager = TeamManager::where('user_ID','=',$userID)->get();

        $state = $request->state;
        $userInvite = $request->userInvite;
        $gameID = $request->gameID;

        if ($state=="1"){
            if ($teamManager->count() <= 0){
                return redirect('createteam');
            }else{
                TeamManager::where('tbl_team_manager.teamID','=',$teamManager->team_ID)
                    ->where('tbl_team_manager.game_ID','=',$gameID)
                    ->whereNull('tbl_team_manager.user_ID')
                    ->first()
                    ->update(['user_ID' => $userInvite,'user_verify' => 0,'expired_invite' => Carbon::now()->addMinutes(5)->toDateTimeString()]);

                $notification = new Notification();
                $notification->notification_User = $userInvite;
                $notification->notification_isRead = 0;
                $notification->notification_type = 1;
                $notification->notificaiton_state = 0;
                $notification->save();

                $notificationDetail = new NotificationDetail();
                $notificationDetail->notificaitonID = $notification->notificationID;
                $notificationDetail->teamID = $teamManager->team_ID;
                $notificationDetail->senderID = $userInvite;
                $notificationDetail->gameID = $gameID;
                $notificationDetail->save();

                return redirect('/profile/'.$userInvite);
            }
        }else{
            $getFollow = Follow::where('user_ID','=',$userID)->where('user_follower_ID','=',$userInvite)->first();

            if (isset($getFollow)){
                Follow::where('user_ID','=',$userID)->where('user_follower_ID','=',$userInvite)->delete();
            }else{
                $follow = new Follow();
                $follow->user_ID = $userID;
                $follow->user_follower_ID = $userInvite;
                $follow->save();
            }

            return redirect('/profile/'.$userInvite);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $myUser = Auth::user();

        $userProfile = User::where('user_ID','=',$id)->first();
        $statsPlayer = StatsPlayer::where('user_ID','=',$id)->where('game_ID','=',1)->first();

        $userLanguage = DB::table('tbl_User')
            ->join('tbl_User_language', 'tbl_User_language.user_ID', '=', 'tbl_User.user_ID')
            ->join('tbl_language', 'tbl_language.languageID', '=', 'tbl_User_language.languageID')
            ->select('tbl_language.language_name')
            ->where('tbl_User.user_id','=',$userProfile->user_ID)
            ->get();

        $userRole = UserRole::join('tbl_Game','tbl_User_Role.game_ID','=','tbl_Game.game_ID')
            ->join('tbl_Role','tbl_User_Role.role_ID','=','tbl_Role.role_ID')
            ->where('user_ID','=',$id)
            ->orderby('tbl_User_Role.game_ID','asc')
            ->orderby('tbl_User_Role.stateRole','desc')
            ->limit(10)
            ->get();

        $myTeam = TeamManager::join('tbl_team','tbl_team.team_ID','=','tbl_team_manager.teamID')->where('user_ID','=',$id)->first();

        $getTeam = Team::where('team_owner','=',$id)
            ->first();

        $gameList = Game::get();

        $feeds = Feed::select('*','tbl_feed.updated_at','tbl_feed.created_at')
            ->join('tbl_User','tbl_User.user_ID','=','tbl_feed.user_ID')
            ->join('tbl_Game','tbl_Game.game_ID','=','tbl_feed.game_ID')
            ->where('tbl_feed.user_ID','=',$id)
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

        if (isset($userProfile->user_birthday)){
            $userProfile->user_birthday = Carbon::parse($userProfile->user_birthday)->age;
        }

        $listComment = Comment::select('*','tbl_comment.created_at')->join('tbl_User','tbl_User.user_ID','=','tbl_comment.user_ID')
            ->get()->groupBy('post_ID');
        $listComment = ['data'=>$listComment];

        $getLike = Like::select('post_ID',DB::raw('count(post_ID) as total'))->where('state','=',1)->groupBy('post_ID')->get()->keyBy('post_ID');
        $getLike = ['data'=>$getLike];

        $stateLike = Like::select('post_ID','state')->where('user_ID','=',1)->where('state','=',1)->get()->groupBy('post_ID');

        $stateFollow = Follow::where('user_ID','=',$myUser->user_ID)->where('user_follower_ID','=',$id)->first();

        $getFollower = Follow::join('tbl_User','tbl_User.user_ID','=','tbl_Follow.user_ID')
            ->where('tbl_Follow.user_follower_ID','=',$id)->get();
        $roleFollower = Follow::join('tbl_User_Role','tbl_User_Role.user_ID','=','tbl_Follow.user_ID')
            ->join('tbl_Role','tbl_User_Role.role_ID','=','tbl_Role.role_ID')
            ->join('tbl_Game','tbl_Game.game_ID','=','tbl_User_Role.game_ID')
            ->where('tbl_Follow.user_follower_ID','=',$id)->get();


        $roleFollower = $roleFollower->mapToGroups(function ($item, $key) {
            return [$item['user_ID'] => ["role_name"=>$item['role_name'],"role_color"=>$item['role_color'],"game_logo"=>$item['game_logo']]];
        });

        $getFollower->map(function ($item) use($roleFollower){
            foreach ($roleFollower as $key => $role){
                if ($key == $item->user_ID){
                    $item->role = $role;
                }
            }
           return $item;
        });


        $getFollowing = Follow::join('tbl_User','tbl_User.user_ID','=','tbl_Follow.user_follower_ID')
            ->where('tbl_Follow.user_ID','=',$id)->get();

        $roleFollowing = Follow::join('tbl_User_Role','tbl_User_Role.user_ID','=','tbl_Follow.user_follower_ID')
            ->join('tbl_Role','tbl_User_Role.role_ID','=','tbl_Role.role_ID')
            ->join('tbl_Game','tbl_Game.game_ID','=','tbl_User_Role.game_ID')
            ->where('tbl_Follow.user_ID','=',$id)->get();

//        return $roleFollowing;

        $roleFollowing = $roleFollowing->mapToGroups(function ($item, $key) {
            return [$item['user_follower_ID'] => ["role_name"=>$item['role_name'],"role_color"=>$item['role_color'],"game_logo"=>$item['game_logo']]];
        });

//        return $roleFollowing;
        $getFollowing->map(function ($item) use($roleFollowing){
            foreach ($roleFollowing as $key => $role){
                if ($key == $item->user_follower_ID){
                    $item->role = $role;
                }else{
                    $item->role = [];
                }
            }

            return $item;
        });

//        return $getFollowing;
        return view("pages.profile",compact('feeds','listComment','getLike','stateLike','stateFollow','getFollow','getFollower','getFollowing','myTeam','myUser','id','type','statsPlayer','userProfile','userLanguage','userRole','getTeam','gameList'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
