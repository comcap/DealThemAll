<?php

namespace App\Http\Controllers;

use App\Game;
use App\GameRole;
use App\StatsPlayer;
use App\Team;
use App\TeamList;
use App\TeamManager;
use App\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = '1';

        return redirect('/teamList/'.$id);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TeamList  $teamList
     * @return \Illuminate\Http\Response
     */
    public function show($teamList)
    {
        $gameList = Game::get();

        $gameSelect = Game::select('game_ID','game_name')
            ->where('game_ID','=',$teamList)
            ->first();

        $listPlayer = StatsPlayer::join('tbl_User','tbl_User.user_ID','=','tbl_stats_player.user_ID')
            ->where('game_ID','=',$teamList)
            ->orderby('tbl_stats_player.rank_total','desc')
            ->get();

//        $listPlayer = $listPlayer->sortByDesc('rank_total')->values()->all();

        $userRole = UserRole::join('tbl_Game','tbl_User_Role.game_ID','=','tbl_Game.game_ID')
            ->join('tbl_Role','tbl_User_Role.role_ID','=','tbl_Role.role_ID')
            ->get();

        $team = Team::get();
//        DB::connection()->enableQueryLog();
//        return DB::getQueryLog();

        $getTeamMember = TeamManager::select('tbl_team_manager.user_ID','teamID','role_ID','typeName','type_Image','color')
                                ->leftjoin('tbl_User_Role','tbl_User_Role.user_ID','=','tbl_team_manager.user_ID')
                                ->leftjoin('tbl_Role_type','tbl_User_Role.role_ID','=','tbl_Role_type.typeID')
                                ->where('tbl_team_manager.game_ID','=',$teamList)
                                ->where(function ($query) {
                                    $query->whereNull('tbl_User_Role.stateRole')
                                        ->orWhere('tbl_User_Role.stateRole','!=',0);
                                })
                                ->groupBy('tbl_team_manager.managerID')
                                ->get();

        $result = $team->map(function ($item,$key) use ($getTeamMember){
            $orders = $getTeamMember->filter(function ($value, $key) use ($item){
                return $value->teamID == $item->team_ID;
            });

            $item->role = $orders->values();
            return $item;
        });

        $gameRole = GameRole::join('tbl_Role_type','tbl_Role_type.typeID','=','tbl_Game_role.typeID')
            ->where('game_ID','=',$teamList)
            ->get();
        $userGameRole = [];
        $arrGameRole = [];

        foreach ($result as $item){
            $arrManager = [];
            foreach ($item['role'] as $value){
                array_push($arrManager,$value['role_ID']);
            }
            array_push($userGameRole,$arrManager);
        }


        foreach ($userGameRole as $value){
            $arrManager = [];
            foreach ($gameRole as $item){
                    if (!in_array($item['typeID'],$value)){
                    array_push($arrManager,$item);
                }
            }
            array_push($arrGameRole,$arrManager);
        }

        $fillter = $result->map(function ($item,$key) use ($arrGameRole){
            foreach ($arrGameRole as $index => $value){
                if ($key == $index){
                    $item->warning = $value;
                }
            }
            return $item;
        });

        return view('pages.teamList',compact('fillter','team','getTeamMember','teamList','gameList','listPlayer','gameSelect','userRole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TeamList  $teamList
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamList $teamList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TeamList  $teamList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeamList $teamList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TeamList  $teamList
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeamList $teamList)
    {
        //
    }

}