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
use Illuminate\Support\Facades\Response;
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
        if (Auth::user()) {
            $id = 1;

            return redirect('updateprofile/' . $id);
        } else {
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
     * @param  \Illuminate\Http\Request $request
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
            ->select('tbl_language.language_name', 'tbl_language.languageID')
            ->where('tbl_User.user_id', '=', $userProfile->user_ID)
            ->get();

        $role = UserRole::where('user_id', '=', $userProfile->user_ID)
            ->get();

        $gameRole = GameRole::join('tbl_Game', 'tbl_Game.game_ID', '=', 'tbl_Game_role.game_ID')
            ->join('tbl_Game_type', 'tbl_Game_type.game_type_ID', '=', 'tbl_Game_role.game_type')
            ->join('tbl_Role_type', 'tbl_Role_type.typeID', '=', 'tbl_Game_role.typeID')
            ->where('tbl_Game.game_ID', '=', $id)
            ->get();

        $gameList = Game::get();

        $gameSelect = Game::where('game_ID', '=', $id)->first();

        $StatsPlayer = StatsPlayer::where('user_ID', '=', $userID)->where('game_ID', '=', $id)->first();

        if (count($StatsPlayer) == 0) {
            $StatsPlayer = new StatsPlayer();
        }

        switch ($id) {
            case 1:
                $getResult = $this->getOverWatch($usernameInGame)->getData();

                $StatsPlayer->user_ID = $userID;
                $StatsPlayer->game_ID = $gameSelect->game_ID;
                $StatsPlayer->userPath = $usernameInGame;
                $StatsPlayer->nameInGame = $getResult->name;
                $StatsPlayer->iconPlayer = $getResult->icon;
                $StatsPlayer->rank_total = $getResult->rating;
                $StatsPlayer->won_total = $getResult->gamesWon;
                $StatsPlayer->accuracy_total = $getResult->weaponAccuracy;
                $StatsPlayer->time_total = $getResult->timePlayed;
                $StatsPlayer->kill_total = $getResult->eliminations;

                break;
            case 2:
                $getResult = $this->getPubg($usernameInGame)->getData();

                $StatsPlayer->user_ID = $userID;
                $StatsPlayer->game_ID = $gameSelect->game_ID;
                $StatsPlayer->userPath = $usernameInGame;
                $StatsPlayer->nameInGame = $usernameInGame;
                $StatsPlayer->rank_total = round($getResult->rating);
                $StatsPlayer->won_total = $getResult->gamesWon;
                $StatsPlayer->topten = $getResult->top10s;
                $StatsPlayer->dmgDealt = round($getResult->damageDealt);
                $StatsPlayer->kill_total = $getResult->eliminations;
                $StatsPlayer->headshot_total = $getResult->headshot;

                break;
            case 4:
                $getResult = $this->getDota($usernameInGame)->getData();

                $StatsPlayer->user_ID = $userID;
                $StatsPlayer->game_ID = $gameSelect->game_ID;
                $StatsPlayer->userPath = $usernameInGame;
                $StatsPlayer->nameInGame = $getResult->name;
                $StatsPlayer->iconPlayer = $getResult->icon;
                $StatsPlayer->rank_total = $getResult->rating;
                $StatsPlayer->won_total = $getResult->gamesWon;
                $StatsPlayer->loss_total = $getResult->loss;
                $StatsPlayer->kill_total = $getResult->kills;
                $StatsPlayer->death_total = $getResult->deaths;
                $StatsPlayer->assists_total = $getResult->assists;
                $StatsPlayer->ward_sentry = $getResult->purchase_ward_sentry;
                $StatsPlayer->ward_observer = $getResult->purchase_ward_observer;
                $StatsPlayer->favoriteHero = $getResult->playerHero;
                break;
            default:
                return "error";
        }


        $StatsPlayer->save();

        $resultRole = [];
        $subResultRole = [];

        $role->each(function ($subItem) use (&$resultRole, &$subResultRole) {
            if ($subItem->stateRole == 1 || $subItem->stateRole == 2) {
                $resultRole[] = $subItem;
            } else {
                $subResultRole[] = $subItem;
            }
        });
//        return [$userID,$gameSelect,$usernameInGame,$icon,$name,$rating,$gamesWon,$weaponAccuracy,$timePlayed,$eliminations];

        if (isset($gameSelect)) {

            return redirect('updateprofile/' . $id)->with('icon', 'name', 'userProfile', 'language', 'userLanguage', 'gameSelect', 'gameList', 'gameRole', 'role', 'id', 'StatsPlayer', 'resultRole', 'subResultRole');

//            return view('pages.updateProfile',compact('icon','name','userProfile','language','userLanguage','gameSelect','gameList','gameRole','role','id','StatsPlayer','resultRole','subResultRole'));
        } else {
            $id = 1;

            return redirect('updateprofile/' . $id);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()) {
            $userProfile = Auth::user();

            $language = DB::table('tbl_language')->get();
            $userLanguage = DB::table('tbl_User')
                ->join('tbl_User_language', 'tbl_User_language.user_ID', '=', 'tbl_User.user_ID')
                ->join('tbl_language', 'tbl_language.languageID', '=', 'tbl_User_language.languageID')
                ->select('tbl_language.language_name', 'tbl_language.languageID')
                ->where('tbl_User.user_id', '=', $userProfile->user_ID)
                ->get();

            $role = UserRole::leftjoin('tbl_Role_type', 'tbl_Role_type.typeID', '=', 'tbl_User_Role.role_ID')
                ->leftjoin('tbl_Role', 'tbl_Role.role_ID', '=', 'tbl_User_Role.role_ID')
                ->where('game_ID', '=', $id)
                ->where('user_id', '=', $userProfile->user_ID)
                ->get();

            $gameRole = GameRole::join('tbl_Game', 'tbl_Game.game_ID', '=', 'tbl_Game_role.game_ID')
                ->join('tbl_Game_type', 'tbl_Game_type.game_type_ID', '=', 'tbl_Game_role.game_type')
                ->join('tbl_Role_type', 'tbl_Role_type.typeID', '=', 'tbl_Game_role.typeID')
                ->where('tbl_Game.game_ID', '=', $id)
                ->get();

            $gameList = Game::get();

            $gameSelect = Game::where('game_ID', '=', $id)->first();

            $StatsPlayer = StatsPlayer::where('user_ID', '=', $userProfile->user_ID)->where('game_ID', '=', $id)->first();

            $resultRole = [];
            $subResultRole = [];


            $role->each(function ($subItem) use (&$resultRole, &$subResultRole) {
                if ($subItem->stateRole == 1 || $subItem->stateRole == 2) {
                    $resultRole[] = $subItem;
                } else {
                    $subResultRole[] = $subItem;
                }
            });

            if (isset($gameSelect)) {
                return view("pages.updateProfile", compact('id', 'userProfile', 'language', 'userLanguage', 'role', 'gameRole', 'gameList', 'gameSelect', 'StatsPlayer', 'resultRole', 'subResultRole'));
            } else {
                $id = 1;

                return redirect('updateprofile/' . $id);
            }
        } else {
            return view("pages.home");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $username = $request->username;
        $file = $request->file;
        $language1 = $request->language1;
//        $language2 = $request->language2;
        $birthday = $request->birthday;
        $gender = $request->gender;
        $timeStart = $request->timeStart;
        $timeEnd = $request->timeEnd;

        $human_readable_date = Carbon::now()->toTimeString();
        $timedata = strtotime($human_readable_date) * 1000;

        $getUser = User::find($id);
        $getUser->user_name = $username;

        if (isset($file)) {
            $image_resize = ImageManagerStatic::make($file->getRealPath());
            $image_resize->resize(320, 320);
            $image_resize->save(public_path() . '/data-image/userImage/' . $timedata . "_" . $file->getclientoriginalname());

            $getUser->user_image = $timedata . "_" . $file->getclientoriginalname();
        }

        $getUser->user_birthday = $birthday;
        $getUser->user_gender = $gender;
        $getUser->user_time_start = $timeStart;
        $getUser->user_time_end = $timeEnd;

        $getUser->save();

        $arr = [];
        $userLanguage = DB::table('tbl_User_language')
            ->select('languageID')
            ->where('tbl_User_language.user_id', '=', $id)
            ->get();

        foreach ($userLanguage as $item) {
            array_push($arr, $item->languageID);
        }

        DB::table('tbl_User_language')->where('languageID', $arr[0])->update(['languageID' => $language1]);
//        DB::table('tbl_User_language')->where('languageID', $arr[1])->update(['languageID' => $language2]);

//            return [$username,$file,$language1,$language2,$language3,$birthday,$timeStart,$timeEnd,$gender];
        return redirect('profile/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
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
        $gameSelect = Game::where('game_ID', '=', $gameID)->first();

        $language = DB::table('tbl_language')->get();
        $userLanguage = DB::table('tbl_User')
            ->join('tbl_User_language', 'tbl_User_language.user_ID', '=', 'tbl_User.user_ID')
            ->join('tbl_language', 'tbl_language.languageID', '=', 'tbl_User_language.languageID')
            ->select('tbl_language.language_name', 'tbl_language.languageID')
            ->where('tbl_User.user_id', '=', $userProfile->user_ID)
            ->get();

        $role = UserRole::where('user_id', '=', $userProfile->user_ID)
            ->get();

        $gameRole = GameRole::get();
        $gameList = Game::get();

//        $StatsPlayer = StatsPlayer::where('user_ID','=',$userProfile->user_ID)->where('game_ID','=',$gameSelect->game_ID)->first();

        $StatsPlayer = StatsPlayer::find($id);
        $StatsPlayer->delete();


        return redirect('updateprofile/' . $gameSelect->game_ID)->with('icon', 'name', 'userProfile', 'language', 'userLanguage', 'gameSelect', 'gameList', 'gameRole', 'role', 'id');

//        return view('pages.updateProfile',compact('icon','name','userProfile','language','userLanguage','gameSelect','gameList','gameRole','role','id'));
    }

    public function selectrole(Request $request)
    {
        $bookId = $request->bookId;
        $typeRole = $request->typeRole;
        $id = $request->gameSelect;

        $userProfile = Auth::user();
        $gameSelect = Game::where('game_ID', '=', $id)->first();

        $language = DB::table('tbl_language')->get();
        $userLanguage = DB::table('tbl_User')
            ->join('tbl_User_language', 'tbl_User_language.user_ID', '=', 'tbl_User.user_ID')
            ->join('tbl_language', 'tbl_language.languageID', '=', 'tbl_User_language.languageID')
            ->select('tbl_language.language_name', 'tbl_language.languageID')
            ->where('tbl_User.user_id', '=', $userProfile->user_ID)
            ->get();

        $gameRole = GameRole::join('tbl_Game', 'tbl_Game.game_ID', '=', 'tbl_Game_role.game_ID')
            ->join('tbl_Game_type', 'tbl_Game_type.game_type_ID', '=', 'tbl_Game_role.game_type')
            ->join('tbl_Role_type', 'tbl_Role_type.typeID', '=', 'tbl_Game_role.typeID')
            ->where('tbl_Game.game_ID', '=', $id)
            ->get();

        $gameList = Game::get();

        $UserRole = UserRole::where('stateRole', '=', $bookId)
            ->where('user_ID', '=', $userProfile->user_ID)
            ->where('game_ID', '=', $id)
            ->first();

        if (count($UserRole) == 0) {
            $UserRole = new UserRole();
        }

        $UserRole->user_ID = $userProfile->user_ID;
        $UserRole->game_ID = $id;
        $UserRole->role_ID = $typeRole;
        $UserRole->stateRole = $bookId;

        $UserRole->save();

        $role = UserRole::leftjoin('tbl_Role_type', 'tbl_Role_type.typeID', '=', 'tbl_User_Role.role_ID')
            ->leftjoin('tbl_Role', 'tbl_Role.role_ID', '=', 'tbl_User_Role.role_ID')
            ->where('game_ID', '=', $id)
            ->where('user_id', '=', $userProfile->user_ID)
            ->get();


        $resultRole = [];
        $subResultRole = [];

        $role->each(function ($subItem) use (&$resultRole, &$subResultRole) {
            if ($subItem->stateRole == 1 || $subItem->stateRole == 2) {
                $resultRole[] = $subItem;
            } else {
                $subResultRole[] = $subItem;
            }
        });

        $StatsPlayer = StatsPlayer::where('user_ID', '=', $userProfile->user_ID)->where('game_ID', '=', $id)->first();

        return view('pages.updateProfile', compact('icon', 'name', 'userProfile', 'language', 'userLanguage', 'gameSelect', 'gameList', 'gameRole', 'role', 'id', 'resultRole', 'subResultRole', 'StatsPlayer'));
    }

    function getOverWatch($usernameInGame)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://ow-api.com/v1/stats/pc/us/" . $usernameInGame . "/complete",
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

            if (isset($json['error'])) {
                return $json;
            } else {
                if (isset($json['competitiveStats']['awards']['cards'])) {
                    $card = $json['competitiveStats']['awards']['cards'];
                } else {
                    $card = "";
                }

                if (count($json['competitiveStats']['topHeroes']) > 0 || $json['competitiveStats']['topHeroes'] != []) {
                    $topHeroes = $json['competitiveStats']['topHeroes'];
                } else {
                    $topHeroes = $json['quickPlayStats']['topHeroes'];
                }

                $arr = [];
                foreach ($topHeroes as $item) {
                    array_push($arr, $item['weaponAccuracy']);
                }

                if (isset($json['icon'])) {
                    $icon = $json['icon'];
                }

                if ($json['name']) {
                    $name = $json['name'];
                }

                if (isset($json['rating'])) {
                    $rating = $json['rating'];
                }

                if (isset($json['gamesWon'])) {
                    $gamesWon = $json['gamesWon'];
                }

                if (count($arr) > 0) {
                    $weaponAccuracy = max($arr);
                }


                if (isset($json['quickPlayStats']['careerStats']['allHeroes']['game']['timePlayed'])) {
                    $timePlayed = $json['quickPlayStats']['careerStats']['allHeroes']['game']['timePlayed'];
                }

                if (isset($json['competitiveStats']['careerStats']['allHeroes']['combat']['eliminations'])) {
                    $eliminations = $json['competitiveStats']['careerStats']['allHeroes']['combat']['eliminations'];
                } else {
                    $eliminations = $json['quickPlayStats']['careerStats']['allHeroes']['combat']['eliminations'];
                }
            }
        }

        return Response::json(["card" => $card, "icon" => $icon, "name" => $name, "rating" => $rating, "gamesWon" => $gamesWon, "weaponAccuracy" => $weaponAccuracy, "timePlayed" => $timePlayed, "eliminations" => $eliminations]);
    }

    function getPubg($usernameInGame)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.pubg.com/shards/steam/players?filter[playerNames]=".$usernameInGame,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiI0YTg1NDAxMC1jY2QwLTAxMzYtY2JkZS0yMWIxMzgxMGE0OTkiLCJpc3MiOiJnYW1lbG9ja2VyIiwiaWF0IjoxNTQyNDg0MzcxLCJwdWIiOiJibHVlaG9sZSIsInRpdGxlIjoicHViZyIsImFwcCI6ImRlYWwtdGhlbS1hbGwifQ.Zlw8zIoVJ50PPuolTIGzOgVapgf5KIsmjVLEKbdKrZQ",
                "Postman-Token: 561c76ad-0aa6-43aa-a09f-11a7170c9147",
                "accept: application/vnd.api+json",
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

            if (isset($json['errors'])) {
                return $json;
            } else {
                $getPlayer = curl_init();

                curl_setopt_array($getPlayer, array(
                    CURLOPT_URL => "https://api.pubg.com/shards/steam/players/" . $json['data'][0]['id'] . "/seasons/lifetime",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiI0YTg1NDAxMC1jY2QwLTAxMzYtY2JkZS0yMWIxMzgxMGE0OTkiLCJpc3MiOiJnYW1lbG9ja2VyIiwiaWF0IjoxNTQyNDg0MzcxLCJwdWIiOiJibHVlaG9sZSIsInRpdGxlIjoicHViZyIsImFwcCI6ImRlYWwtdGhlbS1hbGwifQ.Zlw8zIoVJ50PPuolTIGzOgVapgf5KIsmjVLEKbdKrZQ",
                        "Postman-Token: f7bb45aa-eba5-419a-93b8-56ef6eb3bf62",
                        "accept: application/vnd.api+json",
                        "cache-control: no-cache"
                    ),
                ));

                $response = curl_exec($getPlayer);
                $err = curl_error($getPlayer);

                curl_close($getPlayer);

                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    $json = json_decode($response, true);

                    if (isset($json['data']['attributes']['gameModeStats']['squad']['bestRankPoint'])) {
                        $bestRankPointSquad = $json['data']['attributes']['gameModeStats']['squad']['bestRankPoint'];
                    }
                    if (isset($json['data']['attributes']['gameModeStats']['squad-fpp']['bestRankPoint'])) {
                        $bestRankPointSquadFpp = $json['data']['attributes']['gameModeStats']['squad-fpp']['bestRankPoint'];
                    }
                    $bestRankPoint = max([$bestRankPointSquad, $bestRankPointSquadFpp]);

                    if (isset($json['data']['attributes']['gameModeStats']['squad']['top10s'])) {
                        $top10sSquad = $json['data']['attributes']['gameModeStats']['squad']['top10s'];
                    }
                    if (isset($json['data']['attributes']['gameModeStats']['squad-fpp']['top10s'])) {
                        $top10sSquadFpp = $json['data']['attributes']['gameModeStats']['squad-fpp']['top10s'];
                    }
                    $top10s = max([$top10sSquad, $top10sSquadFpp]);

                    $icon = public_path('data-image/game_logo/pubg/logo2.png');

                    if (isset($json['data']['attributes']['gameModeStats']['squad']['wins'])) {
                        $winsSquad = $json['data']['attributes']['gameModeStats']['squad']['wins'];
                    }
                    if (isset($json['data']['attributes']['gameModeStats']['squad-fpp']['wins'])) {
                        $winsSquadFpp = $json['data']['attributes']['gameModeStats']['squad-fpp']['wins'];
                    }
                    $wins = max([$winsSquad, $winsSquadFpp]);

                    if (isset($json['data']['attributes']['gameModeStats']['squad']['damageDealt'])) {
                        $damageDealtSquad = $json['data']['attributes']['gameModeStats']['squad']['damageDealt'];
                    }
                    if (isset($json['data']['attributes']['gameModeStats']['squad-fpp']['damageDealt'])) {
                        $damageDealtSquadFpp = $json['data']['attributes']['gameModeStats']['squad-fpp']['damageDealt'];
                    }
                    $damageDealt = max([$damageDealtSquad, $damageDealtSquadFpp]);

                    if (isset($json['data']['attributes']['gameModeStats']['squad']['kills'])) {
                        $killsSquad = $json['data']['attributes']['gameModeStats']['squad']['kills'];
                    }
                    if (isset($json['data']['attributes']['gameModeStats']['squad-fpp']['kills'])) {
                        $killsSquadFpp = $json['data']['attributes']['gameModeStats']['squad-fpp']['kills'];
                    }
                    $kills = max([$killsSquad, $killsSquadFpp]);

                    if (isset($json['data']['attributes']['gameModeStats']['squad']['headshotKills'])) {
                        $headshotKillsSquad = $json['data']['attributes']['gameModeStats']['squad']['headshotKills'];
                    }
                    if (isset($json['data']['attributes']['gameModeStats']['squad-fpp']['headshotKills'])) {
                        $headshotKillsSquadFpp = $json['data']['attributes']['gameModeStats']['squad-fpp']['headshotKills'];
                    }
                    $headshotKills = max([$headshotKillsSquad, $headshotKillsSquadFpp]);
                }
            }
        }
        return Response::json(["icon" => $icon, "name" => $usernameInGame, "rating" => $bestRankPoint, "gamesWon" => $wins, "top10s" => $top10s, "damageDealt" => $damageDealt, "eliminations" => $kills,"headshot"=> $headshotKills]);
    }

    function getDota($usernameInGame){
        $usernameInGame = filter_var($usernameInGame, FILTER_SANITIZE_URL);

        if (filter_var($usernameInGame, FILTER_VALIDATE_URL) !== false) {
            $usernameInGame = basename($usernameInGame);
        }
        if (is_numeric($usernameInGame)) {
            $steamid = $this->convert_steamid_64bit_to_32bit($usernameInGame);

        }else{
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "http://api.steampowered.com/ISteamUser/ResolveVanityURL/v0001/?key=EBAC31D270D905749D75BEB0536CD423&vanityurl=".$usernameInGame,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => "",
                CURLOPT_HTTPHEADER => [
                    "Postman-Token: 23c33d82-f4ae-4bbc-9377-6fce8f56c659",
                    "cache-control: no-cache"
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $json = json_decode($response, true);

                if (isset($json['response']['message'])){
                    return $json;
                }else{
                    $steamid = $this->convert_steamid_64bit_to_32bit($json['response']['steamid']);
                }
            }
        }

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.opendota.com/api/players/".$steamid,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => [
                "Postman-Token: 9efb82b0-eb57-4824-acf6-c31af1ec6ca0",
                "cache-control: no-cache"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $json = json_decode($response, true);

            if (isset($json['error'])){
                return $json;
            }else{
                $name = $json['profile']['personaname'];
                if (isset($json['mmr_estimate']['estimate'])){
                    $mmr = $json['mmr_estimate']['estimate']; //<------------------------------------------------MMR
                }else{
                    $mmr = 0;
                }
                $icon = $json['profile']['avatarfull'];
            }
        }

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.opendota.com/api/players/".$steamid."/wl",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => [
                "Postman-Token: 79ce9a49-14fa-4f7c-92a4-7b9b9eaf5efd",
                "cache-control: no-cache"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $json = json_decode($response, true);

            if (isset($json['error'])){
                return $json;
            }else{
                $win = $json['win']; //<---------------------------------------------------------------win
                $loss = $json['lose']; //<---------------------------------------------------------------lose
            }
        }


        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.opendota.com/api/players/".$steamid."/totals",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => [
                "Postman-Token: 79ce9a49-14fa-4f7c-92a4-7b9b9eaf5efd",
                "cache-control: no-cache"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $json = json_decode($response, true);

            if (isset($json['error'])){
                return $json;
            }else{
                foreach ($json as $item){
                    if ($item['field'] == "kills"){
                        $kills = $item['sum'];
                    }
                    if ($item['field'] == "deaths" ){
                        $deaths = $item['sum'];
                    }

                    if ($item['field'] == "assists"){
                        $assists = $item['sum'];
                    }
                    if ($item['field'] == "purchase_ward_sentry"){
                        $purchase_ward_sentry = $item['sum'];
                    }

                    if ($item['field'] == "purchase_ward_observer" ){
                        $purchase_ward_observer = $item['sum'];
                    }
                }
            }
        }


        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.opendota.com/api/players/".$steamid."/heroes",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => [
                "Postman-Token: 79ce9a49-14fa-4f7c-92a4-7b9b9eaf5efd",
                "cache-control: no-cache"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $json = json_decode($response, true);

            if (isset($json['error'])){
                return $json;
            }else{
                $hero_id = $json[0]['hero_id'];
            }
        }


        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.opendota.com/api/heroes",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => [
                "Postman-Token: 79ce9a49-14fa-4f7c-92a4-7b9b9eaf5efd",
                "cache-control: no-cache"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $json = json_decode($response, true);

            if (isset($json['error'])){
                return $json;
            }else{
                $getHero = collect($json);
                $playerHero = $getHero->firstWhere('id',$hero_id);
            }
        }

        return Response::json(["icon"=>$icon,"name" => $name, "rating" => $mmr, "gamesWon" => $win,"loss" => $loss, "kills" => $kills,"deaths" => $deaths,'assists'=>$assists, "purchase_ward_sentry" => $purchase_ward_sentry, "purchase_ward_observer" => $purchase_ward_observer,"playerHero"=> $playerHero['localized_name']]);
    }

    function convert_steamid_64bit_to_32bit($id)
    {
        $result = substr($id, 3) - 61197960265728;
        return (string) $result;
    }
}
