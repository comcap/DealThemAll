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

        $gameSelect = Game::where('game_ID','=',$id)
            ->first();

        $listPlayer = StatsPlayer::join('tbl_User','tbl_User.user_ID','=','tbl_stats_player.user_ID')
            ->where('game_ID','=',$id)
            ->orderby('tbl_stats_player.rank_total','desc')
            ->get();

//        $listPlayer = $listPlayer->sortByDesc('rank_total')->values()->all();

        $userRole = UserRole::join('tbl_Game','tbl_User_Role.game_ID','=','tbl_Game.game_ID')
            ->join('tbl_Role','tbl_User_Role.role_ID','=','tbl_Role.role_ID')
            ->get();

        $arrID = [];
        foreach ($listPlayer as $item){
            if ($item->tw_username != "" || $item->tw_username != null){
                array_push($arrID,$item->tw_ID);
            }
        }

        $collection = [];
        foreach ($arrID as $item){
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.twitch.tv/kraken/streams/".$item,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => "",
                CURLOPT_HTTPHEADER => array(
                    "Accept: application/vnd.twitchtv.v5+json",
                    "Client-ID: nzrv6yapvtsrkp1nv4v1287hrbxs74",
                    "Postman-Token: c116853f-26eb-432b-a60f-7b65bcb8969c",
                    "cache-control: no-cache"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $json = json_decode($response,true);
                if ($json['stream'] != null){

                    array_push($collection,$json);
                }
            }
        }

//        $mockUp = file_get_contents(public_path("/mockup/live.json"));
//        $collection = json_decode($mockUp,true);

        $arrLive = collect($collection);

        $arrLive = $arrLive->map(function ($item) use ($listPlayer){
            foreach ($listPlayer as $value){
                if ($value->tw_username != "" || $value->tw_username != null){
                    if ((int)$value->tw_ID == $item['stream']['channel']['_id']){
                        $item['stream']['userID'] = $value['user_ID'];
                        $item['stream']['username'] = $value['user_name'];
                        $item['stream']['userImage'] = $value['user_image'];
                    }
                }
            }

            return $item;
        })->chunk(3);

        return view("pages.player",compact('id','gameList','listPlayer','gameSelect','userRole','arrLive'));
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


        $gameSelect = Game::where('game_ID','=',$id)->first();

        $arrID = [];
        foreach ($listPlayer as $item){
            if ($item->tw_username != "" || $item->tw_username != null){
                array_push($arrID,$item->tw_ID);
            }
        }

        $collection = [];
        foreach ($arrID as $item){
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.twitch.tv/kraken/streams/".$item,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => "",
                CURLOPT_HTTPHEADER => array(
                    "Accept: application/vnd.twitchtv.v5+json",
                    "Client-ID: nzrv6yapvtsrkp1nv4v1287hrbxs74",
                    "Postman-Token: c116853f-26eb-432b-a60f-7b65bcb8969c",
                    "cache-control: no-cache"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $json = json_decode($response,true);
                if ($json['stream'] != null){

                    array_push($collection,$json);
                }
            }
        }

//        $mockUp = file_get_contents(public_path("/mockup/live.json"));
//        $collection = json_decode($mockUp,true);

        $arrLive = collect($collection);

        $arrLive = $arrLive->map(function ($item) use ($listPlayer){
            foreach ($listPlayer as $value){
                if ($value->tw_username != "" || $value->tw_username != null){
                    if ((int)$value->tw_ID == $item['stream']['channel']['_id']){
                        $item['stream']['userID'] = $value['user_ID'];
                        $item['stream']['username'] = $value['user_name'];
                        $item['stream']['userImage'] = $value['user_image'];
                    }
                }
            }

            return $item;
        })->chunk(3);

//        $listPlayer = StatsPlayer::join('tbl_User','tbl_User.user_ID','=','tbl_stats_player.user_ID')
//            ->where('game_ID','=',$id)
//            ->orderby('tbl_stats_player.rank_total')
//            ->orderby('tbl_stats_player.won_total',$wonSort)
//            ->orderby('tbl_stats_player.accuracy_total',$accuracySort)
//            ->orderby('tbl_stats_player.kill_total',$killSort)
//            ->get();

//        dd($result);

//        return [$listPlayer,['Id'=>$id,'gameTimeStart'=>$gameTimeStart,'gameTimeEnd'=>$gameTimeEnd,'gender'=>$gender,'kill'=>$kill,'accuracy'=>$accuracy,'won'=>$won]];

        return view("pages.player",compact('id','gameList','listPlayer','gameSelect','gender','kill','accuracy','won','gameTimeStart','gameTimeEnd','userRole','arrLive'));

//        return view("pages.player",compact('id','gameList','listPlayer','gameSelect','gender','kill','accuracy','won','gameTimeStart','gameTimeEnd'));

    }
}
