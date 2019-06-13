<?php

namespace App\Http\Controllers;

use App\Game;
use App\StatsPlayer;
use App\Team;
use App\TeamManager;
use App\User;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TwitchProvider;

require "../app/twitch.php";

class AchievementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()){
            $userProfile = Auth::user();

            return redirect('achievements/'.$userProfile->user_ID);
        }else{
            return view("pages.achievements");
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
            ->orderby('tbl_User_Role.game_ID','asc')
            ->orderby('tbl_User_Role.stateRole','desc')
            ->limit(10)
            ->get();

        $myTeam = TeamManager::join('tbl_team','tbl_team.team_ID','=','tbl_team_manager.teamID')->where('user_ID','=',$id)->first();

        $getTeam = Team::where('team_owner','=',$id)
            ->first();

        $gameList = Game::get();

        $getPubg = $this->getPubg(76561198013601133);
        $getOverWatch = $this->getOverWatch("Chickenfree-1154");

        if (!isset($_GET['code'])) {

            // Fetch the authorization URL from the provider, and store state in session
            $authorizationUrl = $this->getConfig()->getAuthorizationUrl();
            $_SESSION['oauth2state'] = $this->getConfig()->getState();

            // Display link to start auth flow
            return view('pages.achievements',compact('id','myUser','userProfile','statsPlayer','userLanguage','userRole','myTeam','getTeam','gameList','getPubg','getOverWatch','authorizationUrl'));
            // Check given state against previously stored one to mitigate CSRF attack
        }
//        return $getOverWatch;
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

    function getPubg($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v2/?appid=578080&key=EBAC31D270D905749D75BEB0536CD423&steamid=".$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Postman-Token: c07c310a-1b70-423c-bd4d-7985c4862d68",
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
            $PlayerAchievement = $json['playerstats']['stats'];
            $PlayerAchievementCom = $json['playerstats']['achievements'];
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.steampowered.com/ISteamUserStats/GetSchemaForGame/v2/?appid=578080&key=EBAC31D270D905749D75BEB0536CD423",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Postman-Token: 6dbb2c16-fddf-4e76-8630-29d7b89eb0a3",
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
            $Playerlist = $json['game']['availableGameStats']['achievements'];
            $PlayerlistID = $json['game']['availableGameStats']['stats'];
        }

        $collect = collect($Playerlist);
        $collectID = collect($PlayerlistID);

        $collectID = $collectID->map(function ($item)use ($PlayerAchievement){
            foreach ($PlayerAchievement as $value){
                if ($item['name'] == $value['name']){
                    $item['defaultvalue'] = $value['value'];
                }
            };
            return $item;
        });

        $result = $collect->map(function ($item,$index) use ($collectID){
            foreach ($collectID as $key => $value){
                if ($index == $key){
                    $item['defaultvalue'] = $value['defaultvalue'];
                }
            }
            return $item;
        });

        return $result;
    }

    function getOverWatch($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://owjs.ovh/overall/pc/us/".$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Postman-Token: bb3af313-ad24-4496-9cb7-1c293a3587b2",
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
            $PlayerAchievement = $json['achievements'];
        }

        return $PlayerAchievement;
    }

    function getConfig(){
        $provider = new TwitchProvider([
            'clientId'                => 'nzrv6yapvtsrkp1nv4v1287hrbxs74',     // The client ID assigned when you created your application
            'clientSecret'            => '8iyeiavzza160ls2j7jjcnwg5w3kkr', // The client secret assigned when you created your application
            'redirectUri'             => 'https://dealthemall.com/apiTwitch',  // Your redirect URL you specified when you created your application
            'scopes'                  => ['user:read:email']  // The scopes you would like to request
        ]);

        return $provider;
    }
}
