<?php

namespace App\Http\Controllers\API;

use App\StatsPlayer;
use App\UserRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GetPlayer extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'Opp! not found';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return 'Opp! not found';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listPlayer = StatsPlayer::join('tbl_User','tbl_User.user_ID','=','tbl_stats_player.user_ID')
            ->leftjoin('tbl_team_manager','tbl_team_manager.user_ID','=','tbl_stats_player.user_ID')
            ->where('tbl_stats_player.game_ID','=',$id)
            ->whereNull('tbl_team_manager.managerID')
            ->orderby('tbl_stats_player.rank_total','desc')
            ->get();

        $userRole = UserRole::select('tbl_User_Role.user_ID','tbl_Role.role_name','tbl_User_Role.stateRole')
            ->join('tbl_User','tbl_User.user_ID','=','tbl_User_Role.user_ID')
            ->join('tbl_Role','tbl_User_Role.role_ID','=','tbl_Role.role_ID')
            ->where('tbl_User_Role.stateRole','>',0)
            ->where('game_ID','=',$id)
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
