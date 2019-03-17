<?php

namespace App\Http\Controllers;

use App\Game;
use App\StatsPlayer;
use App\Team;
use App\TeamList;
use App\UserRole;
use Illuminate\Http\Request;

class TeamListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team = Team::get();
        $gameList = Game::get();
        $id = '1';

        $gameSelect = Game::select('game_ID','game_name')
            ->where('game_ID','=',$id)
            ->first();

        $listPlayer = StatsPlayer::join('tbl_User','tbl_User.user_ID','=','tbl_stats_player.user_ID')
            ->where('game_ID','=',$id)
            ->orderby('tbl_stats_player.rank_total','desc')
            ->get();

//        $listPlayer = $listPlayer->sortByDesc('rank_total')->values()->all();

        $userRole = UserRole::join('tbl_Game','tbl_User_Role.game_ID','=','tbl_Game.game_ID')
            ->join('tbl_Role','tbl_User_Role.role_ID','=','tbl_Role.role_ID')
            ->get();

        return view('pages.teamList',compact('team','id','gameList','listPlayer','gameSelect','userRole'));
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
    public function show(TeamList $teamList)
    {
        //
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
