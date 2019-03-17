<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Feed;
use App\Game;
use App\StatsPlayer;
use App\Team;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()){
            $gameList = Game::get();

            $userRole = UserRole::join('tbl_Role','tbl_Role.role_ID','=','tbl_User_Role.role_ID')
                ->join('tbl_Game','tbl_Game.game_ID','=','tbl_User_Role.game_ID')
                ->where('user_ID','=',Auth::user()->user_ID)
                ->where('stateRole','>',0)
                ->limit(2)
                ->get();

            $countStats= StatsPlayer::where('user_ID','=',Auth::user()->user_ID)->count();

            $feeds = Feed::select('*','tbl_feed.updated_at','tbl_feed.created_at')
                    ->join('tbl_User','tbl_User.user_ID','=','tbl_feed.user_ID')
                    ->join('tbl_Game','tbl_Game.game_ID','=','tbl_feed.game_ID')
                    ->orderBy('tbl_feed.created_at','desc')
                    ->get();

            $asset = Asset::get();

            $result = $feeds->map(function ($item,$key) use ($asset){
                $orders = $asset->filter(function ($value, $key) use ($item){
                    return $value->post_ID == $item->post_ID;
                });

                $item->imagePath = $orders->values();

                return $item;
            });

//            ->join('tbl_asset','tbl_asset.post_ID','=','tbl_feed.post_ID')
//            return $result;

            return view('pages.home',compact('gameList','userRole','countStats','feeds'));
        }else{
            $feeds = Feed::select('*','tbl_feed.updated_at','tbl_feed.created_at')
                ->join('tbl_User','tbl_User.user_ID','=','tbl_feed.user_ID')
                ->join('tbl_Game','tbl_Game.game_ID','=','tbl_feed.game_ID')
                ->orderBy('tbl_feed.created_at','desc')
                ->get();

            return view('pages.home',compact('feeds'));
        }

    }
}
