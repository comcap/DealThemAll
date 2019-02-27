<?php

namespace App\Http\Controllers;

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

            return view('pages.home',compact('gameList','userRole','countStats'));
        }else{
            return view('pages.home');
        }

    }
}
