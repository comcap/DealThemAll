<?php

namespace App\Http\Controllers\API;

use App\StatsPlayer;
use App\TeamManager;
use App\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GetPlayerMember extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$game)
    {
        $GetTeam = TeamManager::select('user_ID')
            ->where('teamID','=',$id)
            ->where('game_ID','=','1')
            ->get();

        $mytime = Carbon::now()->toDateTimeString();

        $listPlayer = StatsPlayer::join('tbl_User','tbl_User.user_ID','=','tbl_stats_player.user_ID')
            ->join('tbl_team_manager','tbl_team_manager.user_ID','=','tbl_stats_player.user_ID')
            ->where('tbl_team_manager.teamID','=',$id)
            ->where('tbl_team_manager.game_ID','=',$game)
            ->where('tbl_stats_player.game_ID','=',$game)
            ->orderby('tbl_stats_player.rank_total','desc')
            ->get();

        $listPlayer->map(function ($item){
            $item->expired_invite = gmdate('i:s', Carbon::now()->diffInSeconds($item->expired_invite));
            return $item;
        });

        $dt = Carbon::now();
        TeamManager::where('user_verify','=',0)
            ->where('expired_invite','<=',$dt)
            ->delete();

        $userRole = UserRole::select('tbl_User_Role.user_ID','tbl_Role.role_name','tbl_User_Role.stateRole','tbl_Role.role_name','tbl_Game.game_logo','tbl_Role.role_color')
            ->join('tbl_User','tbl_User.user_ID','=','tbl_User_Role.user_ID')
            ->join('tbl_Role','tbl_User_Role.role_ID','=','tbl_Role.role_ID')
            ->join('tbl_team_manager','tbl_team_manager.user_ID','=','tbl_User_Role.user_ID')
            ->join('tbl_Game','tbl_Game.game_ID','=','tbl_User_Role.game_ID')
            ->where('tbl_User_Role.stateRole','>',0)
            ->where('tbl_team_manager.game_ID','=',$game)
            ->where('tbl_User_Role.game_ID','=',$game)
            ->where('tbl_team_manager.teamID','=',$id)
            ->get();

        $result = $listPlayer->map(function ($item,$key) use ($userRole){
            $orders = $userRole->filter(function ($value, $key) use ($item){
                return $value->user_ID == $item->user_ID;
            });

            $item->role = $orders->values();

            return $item;
        });


        return $result;
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
