<?php

namespace App\Http\Controllers;

use App\Game;
use App\StatsPlayer;
use App\Team;
use App\User;
use App\UserRole;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        if (Auth::user()){
            $userProfile = Auth::user();

//        $client = new Client();
//        $res = $client->request('GET', 'https://ow-api.com/v1/stats/pc/us/Chickenfree-1154/complete');
//        $data = json_decode($res->getBody(), true);
//        dd($data['quickPlayStats']['games'],$data['quickPlayStats']['careerStats']['allHeroes']);

            return redirect('profile/'.$userProfile->user_ID);
        }else{
            return view("pages.home");
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
        $myUser = Auth::user();

        $userProfile = User::where('user_ID','=',$id)->first();
        $statsPlayer = StatsPlayer::where('user_ID','=',$id)->where('game_ID','=',1)->first();

        $userLanguage = DB::table('tbl_User')
            ->join('tbl_User_language', 'tbl_User_language.user_ID', '=', 'tbl_User.user_ID')
            ->join('tbl_language', 'tbl_language.languageID', '=', 'tbl_User_language.languageID')
            ->select('tbl_language.language_name')
            ->where('tbl_User.user_id','=',$userProfile->user_ID)
            ->get();

        $userRole = UserRole::join('tbl_Game','tbl_User_Role.game_ID','=','tbl_Game.game_ID')
            ->join('tbl_Role','tbl_User_Role.role_ID','=','tbl_Role.role_ID')
            ->where('user_ID','=',$id)
            ->limit(10)
            ->get();

        $getTeam = Team::where('team_owner','=',$id)
            ->first();

        $gameList = Game::get();

        return view("pages.profile",compact('myUser','id','type','statsPlayer','userProfile','userLanguage','userRole','getTeam','gameList'));
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
