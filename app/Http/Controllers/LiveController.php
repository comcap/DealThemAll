<?php

namespace App\Http\Controllers;

use App\Game;
use App\StatsPlayer;
use Illuminate\Http\Request;

class LiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/live/1');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listPlayer = StatsPlayer::join('tbl_User','tbl_User.user_ID','=','tbl_stats_player.user_ID')
            ->where('game_ID','=',$id)
            ->orderby('tbl_stats_player.rank_total','desc')
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
        });


        $gameSelect = Game::where('game_ID','=',$id)->first();
        $gameList = Game::get();

//        return $arrLive[0];

        return view('pages.live',compact('id','arrLive','gameSelect','gameList'));
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
