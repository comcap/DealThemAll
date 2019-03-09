<?php

namespace App\Http\Controllers;

use App\Game;
use App\StatsPlayer;
use App\Team;
use App\TeamManager;
use App\User;
use App\UserRole;
use Carbon\Carbon;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic;

class CreateTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getTeam = TeamManager::where('user_ID','=',Auth::user()->user_ID)->first();

        if ($getTeam){
            return redirect('team');
        }else{
            $language = DB::table('tbl_language')->get();
            $gameList = Game::get();

            return view("pages.createteam",compact('language','gameList'));
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

        $nameTeam = $request->nameTeam;
        $timeStart = $request->timeStart;
        $timeEnd = $request->timeEnd;
        $language1 = $request->language1;
        $language2 = $request->language2;
        $language3 = $request->language3;
        $game = $request->game;
        $invitePlayer = $request->invitePlayer;
        $imageFile = $request->file;

        $getLanguage = DB::table('tbl_language')->whereIn('languageID',[$language1,$language2,$language3])->get();
        $strLanguage = "";
        foreach ($getLanguage as $key => $item){
            $strLanguage = $strLanguage.$item->language_name;
        }
        $invitePlayer = explode(",",$invitePlayer);

        $timedata = Carbon::now()->toTimeString();

        $Team = new Team();
        $Team->team_name = $nameTeam;
        $Team->team_owner = Auth::user()->user_ID;
        $Team->team_time_start = $timeStart;
        $Team->team_time_end = $timeEnd;
        $Team->team_language = $strLanguage;

        if(isset($imageFile)){
            $image_resize = ImageManagerStatic::make($imageFile->getRealPath());
            $image_resize->resize(320, 320);
            $image_resize->save(public_path().'/data-image/teamLogos/'. $timedata."_".$imageFile->getclientoriginalname());

            $Team->team_logo = $timedata."_".$imageFile->getclientoriginalname();
        }else{
            $Team->team_logo = "";
        }

        $Team->save();

        foreach ($invitePlayer as $value){
            $TeamManager = new TeamManager();
            $TeamManager->teamID = $Team->team_ID;
            $TeamManager->game_ID = $game;
            $TeamManager->user_ID = $value;
            $TeamManager->user_verify = 0;
            $TeamManager->expired_invite = Carbon::now()->addMinutes(5)->toDateTimeString();
            $TeamManager->save();
        }
//        return $strLanguage;

        return redirect('team');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
