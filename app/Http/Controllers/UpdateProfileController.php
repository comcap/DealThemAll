<?php

namespace App\Http\Controllers;

use App\Game;
use App\GameRole;
use App\StatsPlayer;
use App\User;
use App\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic;

class UpdateProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()){
            $id = 1;

            return redirect('updateprofile/'.$id);
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
        $usernameInGame = $request->username;
        $id = $request->gameSelect;
        $userID = Auth::user()->user_ID;

        $userProfile = Auth::user();

        $language = DB::table('tbl_language')->get();
        $userLanguage = DB::table('tbl_User')
            ->join('tbl_User_language', 'tbl_User_language.user_ID', '=', 'tbl_User.user_ID')
            ->join('tbl_language', 'tbl_language.languageID', '=', 'tbl_User_language.languageID')
            ->select('tbl_language.language_name','tbl_language.languageID')
            ->where('tbl_User.user_id','=',$userProfile->user_ID)
            ->get();

        $role= UserRole::where('user_id','=',$userProfile->user_ID)
            ->get();

        $gameRole = GameRole::join('tbl_Game','tbl_Game.game_ID','=','tbl_Game_role.game_ID')
            ->join('tbl_Game_type','tbl_Game_type.game_type_ID','=','tbl_Game_role.game_type')
            ->join('tbl_Role_type','tbl_Role_type.typeID','=','tbl_Game_role.typeID')
            ->where('tbl_Game.game_ID','=',$id)
            ->get();

        $gameList = Game::get();

        $gameSelect = Game::where('game_ID','=',$id)->first();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://ow-api.com/v1/stats/pc/us/".$usernameInGame."/complete",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Client-ID: nzrv6yapvtsrkp1nv4v1287hrbxs74",
                "Postman-Token: 55f1f3f7-5cc0-40d8-9b36-0a694c68fbb3",
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $json = json_decode($response, true);
        }
        $card = $json['competitiveStats']['awards']['cards'];

        return $card;
        $topHeroes = $json['competitiveStats']['topHeroes'];
        $arr = [];
        foreach ($topHeroes as $item){
            array_push($arr,$item['weaponAccuracy']);
        }
        $icon = $json['icon'];
        $name = $json['name'];
        $rating = $json['rating'];
        $gamesWon = $json['gamesWon'];
        $weaponAccuracy = max($arr);
        $timePlayed = $json['quickPlayStats']['careerStats']['allHeroes']['game']['timePlayed'];
        $eliminations = $json['competitiveStats']['careerStats']['allHeroes']['combat']['eliminations'];

        $StatsPlayer = StatsPlayer::where('user_ID','=',$userID)->where('game_ID','=',$id)->first();

        if (count($StatsPlayer)==0){
            $StatsPlayer = new StatsPlayer();
        }

        $StatsPlayer->user_ID = $userID;
        $StatsPlayer->game_ID = $gameSelect->game_ID;
        $StatsPlayer->userPath = $usernameInGame;
        $StatsPlayer->nameInGame = $name;
        $StatsPlayer->iconPlayer = $icon;
        $StatsPlayer->rank_total = $rating;
        $StatsPlayer->won_total = $gamesWon;
        $StatsPlayer->accuracy_total = $weaponAccuracy;
        $StatsPlayer->time_total = $timePlayed;
        $StatsPlayer->kill_total = $eliminations;
        $StatsPlayer->headshot_total = "0";

        $StatsPlayer->save();

        $resultRole = [];
        $subResultRole = [];


        $role->each(function ($subItem) use (&$resultRole,&$subResultRole){
            if ($subItem->stateRole == 1 || $subItem->stateRole == 2){
                $resultRole[] = $subItem;
            }else{
                $subResultRole[] = $subItem;
            }
        });
//        return [$userID,$gameSelect,$usernameInGame,$icon,$name,$rating,$gamesWon,$weaponAccuracy,$timePlayed,$eliminations];

        if (isset($gameSelect)){

            return redirect('updateprofile/'.$id)->with('icon','name','userProfile','language','userLanguage','gameSelect','gameList','gameRole','role','id','StatsPlayer','resultRole','subResultRole');

//            return view('pages.updateProfile',compact('icon','name','userProfile','language','userLanguage','gameSelect','gameList','gameRole','role','id','StatsPlayer','resultRole','subResultRole'));
        }else{
            $id = 1;

            return redirect('updateprofile/'.$id);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()){
            $userProfile = Auth::user();

            $language = DB::table('tbl_language')->get();
            $userLanguage = DB::table('tbl_User')
                ->join('tbl_User_language', 'tbl_User_language.user_ID', '=', 'tbl_User.user_ID')
                ->join('tbl_language', 'tbl_language.languageID', '=', 'tbl_User_language.languageID')
                ->select('tbl_language.language_name','tbl_language.languageID')
                ->where('tbl_User.user_id','=',$userProfile->user_ID)
                ->get();

            $role= UserRole::leftjoin('tbl_Role_type','tbl_Role_type.typeID','=','tbl_User_Role.role_ID')
                ->leftjoin('tbl_Role','tbl_Role.role_ID','=','tbl_User_Role.role_ID')
                ->where('game_ID','=',$id)
                ->where('user_id','=',$userProfile->user_ID)
                ->get();

            $gameRole = GameRole::join('tbl_Game','tbl_Game.game_ID','=','tbl_Game_role.game_ID')
                ->join('tbl_Game_type','tbl_Game_type.game_type_ID','=','tbl_Game_role.game_type')
                ->join('tbl_Role_type','tbl_Role_type.typeID','=','tbl_Game_role.typeID')
                ->where('tbl_Game.game_ID','=',$id)
                ->get();

            $gameList = Game::get();

            $gameSelect = Game::where('game_ID','=',$id)->first();

            $StatsPlayer = StatsPlayer::where('user_ID','=',$userProfile->user_ID)->where('game_ID','=',$gameSelect->game_ID)->first();

            $resultRole = [];
            $subResultRole = [];


            $role->each(function ($subItem) use (&$resultRole,&$subResultRole){
                if ($subItem->stateRole == 1 || $subItem->stateRole == 2){
                    $resultRole[] = $subItem;
                }else{
                    $subResultRole[] = $subItem;
                }
            });


            if (isset($gameSelect)){
                return view("pages.updateProfile",compact('id','userProfile','language','userLanguage','role','gameRole','gameList','gameSelect','StatsPlayer','resultRole','subResultRole'));
            }else{
                $id = 1;

                return redirect('updateprofile/'.$id);
            }
        }else{
            return view("pages.home");
        }
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
        $username = $request->username;
        $file = $request->file;
        $language1 = $request->language1;
        $language2 = $request->language2;
        $birthday = $request->birthday;
        $gender = $request->gender;
        $timeStart = $request->timeStart;
        $timeEnd = $request->timeEnd;

        $human_readable_date = Carbon::now()->toTimeString();
        $timedata = strtotime($human_readable_date) * 1000;

        $getUser = User::find($id);
        $getUser->user_name = $username;

        if(isset($file)){
            $image_resize = ImageManagerStatic::make($file->getRealPath());
            $image_resize->resize(320, 320);
            $image_resize->save(public_path().'/data-image/userImage/'. $timedata."_".$file->getclientoriginalname());

            $getUser->user_image = $timedata."_".$file->getclientoriginalname();
        }

        $getUser->user_birthday = $birthday;
        $getUser->user_gender = $gender;
        $getUser->user_time_start = $timeStart;
        $getUser->user_time_end = $timeEnd;

//        $getUser->save();

        $arr = [];
        $userLanguage = DB::table('tbl_User_language')
            ->select('languageID')
            ->where('tbl_User_language.user_id','=',$id)
            ->get();

        foreach ($userLanguage as $item){
            array_push($arr,$item->languageID);
        }

        DB::table('tbl_User_language')->where('languageID', $arr[0])->update(['languageID' => $language1]);
        DB::table('tbl_User_language')->where('languageID', $arr[1])->update(['languageID' => $language2]);

//            return [$username,$file,$language1,$language2,$language3,$birthday,$timeStart,$timeEnd,$gender];
        return redirect('profile/'.$id);
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

    public function deleteStat(Request $request)
    {
        $id = $request->stats_playerID;
        $gameID = $request->gameSelect;
        $userProfile = Auth::user();
        $gameSelect = Game::where('game_ID','=',$gameID)->first();

        $language = DB::table('tbl_language')->get();
        $userLanguage = DB::table('tbl_User')
            ->join('tbl_User_language', 'tbl_User_language.user_ID', '=', 'tbl_User.user_ID')
            ->join('tbl_language', 'tbl_language.languageID', '=', 'tbl_User_language.languageID')
            ->select('tbl_language.language_name','tbl_language.languageID')
            ->where('tbl_User.user_id','=',$userProfile->user_ID)
            ->get();

        $role= UserRole::where('user_id','=',$userProfile->user_ID)
            ->get();

        $gameRole = GameRole::get();
        $gameList = Game::get();

//        $StatsPlayer = StatsPlayer::where('user_ID','=',$userProfile->user_ID)->where('game_ID','=',$gameSelect->game_ID)->first();

        $StatsPlayer = StatsPlayer::find($id);
        $StatsPlayer->delete();


        return redirect('updateprofile/'.$gameSelect->game_ID)->with('icon','name','userProfile','language','userLanguage','gameSelect','gameList','gameRole','role','id');

//        return view('pages.updateProfile',compact('icon','name','userProfile','language','userLanguage','gameSelect','gameList','gameRole','role','id'));
    }

    public function selectrole(Request $request)
    {
        $bookId = $request->bookId;
        $typeRole = $request->typeRole;
        $id = $request->gameSelect;

        $userProfile = Auth::user();
        $gameSelect = Game::where('game_ID','=',$id)->first();

        $language = DB::table('tbl_language')->get();
        $userLanguage = DB::table('tbl_User')
            ->join('tbl_User_language', 'tbl_User_language.user_ID', '=', 'tbl_User.user_ID')
            ->join('tbl_language', 'tbl_language.languageID', '=', 'tbl_User_language.languageID')
            ->select('tbl_language.language_name','tbl_language.languageID')
            ->where('tbl_User.user_id','=',$userProfile->user_ID)
            ->get();

        $gameRole = GameRole::join('tbl_Game','tbl_Game.game_ID','=','tbl_Game_role.game_ID')
            ->join('tbl_Game_type','tbl_Game_type.game_type_ID','=','tbl_Game_role.game_type')
            ->join('tbl_Role_type','tbl_Role_type.typeID','=','tbl_Game_role.typeID')
            ->where('tbl_Game.game_ID','=',$id)
            ->get();

        $gameList = Game::get();

        $UserRole = UserRole::where('stateRole','=',$bookId)
            ->where('user_ID','=',$userProfile->user_ID)
            ->where('game_ID','=',$id)
            ->first();

        if (count($UserRole)==0){
            $UserRole = new UserRole();
        }

        $UserRole->user_ID = $userProfile->user_ID;
        $UserRole->game_ID = $id;
        $UserRole->role_ID = $typeRole;
        $UserRole->stateRole = $bookId;

        $UserRole->save();

        $role= UserRole::leftjoin('tbl_Role_type','tbl_Role_type.typeID','=','tbl_User_Role.role_ID')
            ->leftjoin('tbl_Role','tbl_Role.role_ID','=','tbl_User_Role.role_ID')
            ->where('game_ID','=',$id)
            ->where('user_id','=',$userProfile->user_ID)
            ->get();


        $resultRole = [];
        $subResultRole = [];

        $role->each(function ($subItem) use (&$resultRole,&$subResultRole){
            if ($subItem->stateRole == 1 || $subItem->stateRole == 2){
                $resultRole[] = $subItem;
            }else{
                $subResultRole[] = $subItem;
            }
        });

        $StatsPlayer = StatsPlayer::where('user_ID','=',$userProfile->user_ID)->where('game_ID','=',$id)->first();

        return view('pages.updateProfile',compact('icon','name','userProfile','language','userLanguage','gameSelect','gameList','gameRole','role','id','resultRole','subResultRole','StatsPlayer'));
    }
}
