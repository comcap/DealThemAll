<?php

namespace App\Http\Controllers;

use App\Game;
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

        $TeamManager = new TeamManager();
        $TeamManager->teamID = $teamID;
        $TeamManager->game_ID = $gameID;
        $TeamManager->user_ID = $playerID;
        $TeamManager->user_verify = 0;
        $TeamManager->expired_invite = Carbon::now()->addMinutes(5)->toDateTimeString();
        $TeamManager->save();

//        return $request;
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
        $TeamOwner = Team::where('team_owner','=',$userID)->first();

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

        return view('pages.team',compact('TeamOwner','language','teamManager','gameList','result','getTeam'));
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
                ->delete();

//        return $kickID;
        return redirect('team');
    }

    function logSQL(){
        $queries = DB::getQueryLog();
        return $queries;
    }
}
