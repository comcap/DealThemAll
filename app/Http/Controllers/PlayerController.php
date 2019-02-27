<?php

namespace App\Http\Controllers;

use App\Game;
use App\StatsPlayer;
use App\UserRole;
use Illuminate\Http\Request;


class PlayerController extends Controller
{
    public function index()
    {
        $gameList = Game::get();
        $id = '1';

        $gameSelect = Game::select('game_ID','game_name')
            ->where('game_ID','=',$id)
            ->first();

        $listPlayer = StatsPlayer::
            join('tbl_User','tbl_User.user_ID','=','tbl_stats_player.user_ID')
            ->where('game_ID','=',$id)
            ->orderby('tbl_stats_player.rank_total','desc')
            ->get();

//        $listPlayer = $listPlayer->sortByDesc('rank_total')->values()->all();

        $userRole = UserRole::join('tbl_Game','tbl_User_Role.game_ID','=','tbl_Game.game_ID')
            ->join('tbl_Role','tbl_User_Role.role_ID','=','tbl_Role.role_ID')
            ->get();

//        return $userRole;

//        dd($gameSelect);
        return view("pages.player",compact('id','gameList','listPlayer','gameSelect','userRole'));
    }

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

    public function show($id)
    {
        $gameList = Game::get();

        $gameSelect = Game::select('game_name')
            ->where('game_ID','=',$id)
            ->first();

        $listPlayer = StatsPlayer::join('tbl_User','tbl_User.user_ID','=','tbl_stats_player.user_ID')
            ->where('game_ID','=',$id)
            ->orderby('tbl_stats_player.rank_total','desc')
            ->get();


        return view("pages.player",compact('id','gameList','listPlayer','gameSelect'));
    }

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

    public function playerSearch(Request $request)
    {
        $id = $request->game;
        $gender = $request->gender;

        $gameTimeStart = $request->gameTimeStart;
        $gameTimeEnd = $request->gameTimeEnd;

        $gameList = Game::get();

        $kill = $request->kill;
        $accuracy = $request->accuracy;
        $won = $request->won;

        $listPlayer = StatsPlayer::join('tbl_User','tbl_User.user_ID','=','tbl_stats_player.user_ID')
            ->where('game_ID','=',$id)
            ->orderby('tbl_stats_player.rank_total','desc')
            ->get();

        $userRole = UserRole::join('tbl_Game','tbl_User_Role.game_ID','=','tbl_Game.game_ID')
            ->join('tbl_Role','tbl_User_Role.role_ID','=','tbl_Role.role_ID')
            ->get();
//        $listPlayer = $listPlayer->sortByDesc('rank_total')->values()->all();


        if ($gender==0){
            $listPlayer = $listPlayer->where('user_gender',0);
        }elseif ($gender==1){
            $listPlayer = $listPlayer->where('user_gender',1);
        }

//        if ($kill == 0) {
//            $listPlayer = $listPlayer->sortByDesc('kill_total');
//
//            if ($accuracy == 0) {
//                $listPlayer = $listPlayer->sortByDesc('accuracy_total');
//
//                if ($won == 0) {
//                    $listPlayer = $listPlayer->sortByDesc('won_total');
//                } elseif ($won == 1) {
//                    $listPlayer = $listPlayer->sortBy('won_total');
//                }
//            } elseif ($accuracy == 1) {
//                $listPlayer = $listPlayer->sortBy('accuracy_total');
//
//                if ($won == 0) {
//                    $listPlayer = $listPlayer->sortByDesc('won_total');
//                } elseif ($won == 1) {
//                    $listPlayer = $listPlayer->sortBy('won_total');
//                }
//            } elseif ($kill == 1) {
//                $listPlayer = $listPlayer->sortBy('kill_total');
//
//                if ($accuracy == 0) {
//                    $listPlayer = $listPlayer->sortByDesc('accuracy_total');
//
//                    if ($won == 0) {
//                        $listPlayer = $listPlayer->sortByDesc('won_total');
//                    } elseif ($won == 1) {
//                        $listPlayer = $listPlayer->sortBy('won_total');
//                    }
//                } elseif ($accuracy == 1) {
//                    $listPlayer = $listPlayer->sortBy('accuracy_total');
//
//                    if ($won == 0) {
//                        $listPlayer = $listPlayer->sortByDesc('won_total');
//                    } elseif ($won == 1) {
//                        $listPlayer = $listPlayer->sortBy('won_total');
//                    }
//                } else {
//                    if ($accuracy == 0) {
//                        $listPlayer = $listPlayer->sortByDesc('accuracy_total');
//
//                        if ($won == 0) {
//                            $listPlayer = $listPlayer->sortByDesc('won_total');
//                        } elseif ($won == 1) {
//                            $listPlayer = $listPlayer->sortBy('won_total');
//                        }
//                    } elseif ($accuracy == 1) {
//                        $listPlayer = $listPlayer->sortBy('accuracy_total');
//
//                        if ($won == 0) {
//                            $listPlayer = $listPlayer->sortByDesc('won_total');
//                        } elseif ($won == 1) {
//                            $listPlayer = $listPlayer->sortBy('won_total');
//                        }
//                    }
//                }
//            }
//        }

        if ($kill == 0){
            $listPlayer = $listPlayer->sortByDesc('kill_total');

            if ($accuracy == 0){
                $listPlayer = $listPlayer->sortByDesc('accuracy_total');

                if ($won == 0){
                    $listPlayer = $listPlayer->sortByDesc('won_total');
                }elseif($won == 1){
                    $listPlayer = $listPlayer->sortBy('won_total');
                }else{

                }
            }elseif($accuracy == 1){
                $listPlayer = $listPlayer->sortBy('accuracy_total');

                if ($won == 0){
                    $listPlayer = $listPlayer->sortByDesc('won_total');
                }elseif($won == 1){
                    $listPlayer = $listPlayer->sortBy('won_total');
                }else{

                }

            }else{
                if ($won == 0){
                    $listPlayer = $listPlayer->sortByDesc('won_total');
                }elseif($won == 1){
                    $listPlayer = $listPlayer->sortBy('won_total');
                }else{

                }
            }
        }elseif($kill == 1){
            $listPlayer = $listPlayer->sortBy('kill_total');

            if ($accuracy == 0){
                $listPlayer = $listPlayer->sortByDesc('accuracy_total');

                if ($won == 0){
                    $listPlayer = $listPlayer->sortByDesc('won_total');
                }elseif($won == 1){
                    $listPlayer = $listPlayer->sortBy('won_total');
                }else{

                }
            }elseif($accuracy == 1){
                $listPlayer = $listPlayer->sortBy('accuracy_total');

                if ($won == 0){
                    $listPlayer = $listPlayer->sortByDesc('won_total');
                }elseif($won == 1){
                    $listPlayer = $listPlayer->sortBy('won_total');
                }else{

                }
            }else{
                if ($won == 0){
                    $listPlayer = $listPlayer->sortByDesc('won_total');
                }elseif($won == 1){
                    $listPlayer = $listPlayer->sortBy('won_total');
                }else{

                }
            }
        }else{
            if ($accuracy == 0){
                $listPlayer = $listPlayer->sortByDesc('accuracy_total');

                if ($won == 0){
                    $listPlayer = $listPlayer->sortByDesc('won_total');
                }elseif($won == 1){
                    $listPlayer = $listPlayer->sortBy('won_total');
                }else{

                }
            }elseif($accuracy == 1){
                $listPlayer = $listPlayer->sortBy('accuracy_total');

                if ($won == 0){
                    $listPlayer = $listPlayer->sortByDesc('won_total');
                }elseif($won == 1){
                    $listPlayer = $listPlayer->sortBy('won_total');
                }else{

                }
            }else{
                if ($won == 0){
                    $listPlayer = $listPlayer->sortByDesc('won_total');
                }elseif($won == 1){
                    $listPlayer = $listPlayer->sortBy('won_total');
                }else{

                }
            }
        }


        $gameSelect = Game::select('game_name')
            ->where('game_ID','=',$id)
            ->first();

//        $listPlayer = StatsPlayer::join('tbl_User','tbl_User.user_ID','=','tbl_stats_player.user_ID')
//            ->where('game_ID','=',$id)
//            ->orderby('tbl_stats_player.rank_total')
//            ->orderby('tbl_stats_player.won_total',$wonSort)
//            ->orderby('tbl_stats_player.accuracy_total',$accuracySort)
//            ->orderby('tbl_stats_player.kill_total',$killSort)
//            ->get();

//        dd($result);

//        return [$listPlayer,['Id'=>$id,'gameTimeStart'=>$gameTimeStart,'gameTimeEnd'=>$gameTimeEnd,'gender'=>$gender,'kill'=>$kill,'accuracy'=>$accuracy,'won'=>$won]];

        return view("pages.player",compact('id','gameList','listPlayer','gameSelect','gender','kill','accuracy','won','gameTimeStart','gameTimeEnd','userRole'));

//        return view("pages.player",compact('id','gameList','listPlayer','gameSelect','gender','kill','accuracy','won','gameTimeStart','gameTimeEnd'));

    }
}
