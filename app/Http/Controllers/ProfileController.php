<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Comment;
use App\Feed;
use App\Follow;
use App\Game;
use App\Like;
use App\Notification;
use App\NotificationDetail;
use App\StatsPlayer;
use App\Team;
use App\TeamManager;
use App\User;
use App\UserRole;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TwitchProvider;

require "../app/twitch.php";


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
//        return $request;
        $userID = Auth::user()->user_ID;
        $teamManager = TeamManager::where('user_ID','=',$userID)->get();

        $state = $request->state;
        $userInvite = $request->userInvite;
        $gameID = $request->gameID;

        if ($state=="1"){
            if ($teamManager->count() <= 0){
                return redirect('createteam');
            }else{
                TeamManager::where('tbl_team_manager.teamID','=',$teamManager->team_ID)
                    ->where('tbl_team_manager.game_ID','=',$gameID)
                    ->whereNull('tbl_team_manager.user_ID')
                    ->first()
                    ->update(['user_ID' => $userInvite,'user_verify' => 0,'expired_invite' => Carbon::now()->addMinutes(5)->toDateTimeString()]);

                $notification = new Notification();
                $notification->notification_User = $userInvite;
                $notification->notification_isRead = 0;
                $notification->notification_type = 1;
                $notification->notificaiton_state = 0;
                $notification->save();

                $notificationDetail = new NotificationDetail();
                $notificationDetail->notificaitonID = $notification->notificationID;
                $notificationDetail->teamID = $teamManager->team_ID;
                $notificationDetail->senderID = $userInvite;
                $notificationDetail->gameID = $gameID;
                $notificationDetail->save();

                return redirect('/profile/'.$userInvite);
            }
        }else{
            $getFollow = Follow::where('user_ID','=',$userID)->where('user_follower_ID','=',$userInvite)->first();

            if (isset($getFollow)){
                Follow::where('user_ID','=',$userID)->where('user_follower_ID','=',$userInvite)->delete();
            }else{
                $follow = new Follow();
                $follow->user_ID = $userID;
                $follow->user_follower_ID = $userInvite;
                $follow->save();

                $notification = new Notification();
                $notification->notification_User = $userInvite;
                $notification->notification_isRead = 0;
                $notification->notification_type = 5;
                $notification->notificaiton_state = 0;
                $notification->save();

                $notificationDetail = new NotificationDetail();
                $notificationDetail->notificaitonID = $notification->notificationID;
                $notificationDetail->teamID = null;
                $notificationDetail->senderID = Auth::user()->user_ID;
                $notificationDetail->gameID = $gameID;
                $notificationDetail->save();
            }

            return redirect('/profile/'.$userInvite);
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

        $feeds = Feed::select('*','tbl_feed.updated_at','tbl_feed.created_at')
            ->join('tbl_User','tbl_User.user_ID','=','tbl_feed.user_ID')
            ->join('tbl_Game','tbl_Game.game_ID','=','tbl_feed.game_ID')
            ->where('tbl_feed.user_ID','=',$id)
            ->orderBy('tbl_feed.created_at','desc')
            ->get();

        $asset = Asset::get();

        $feeds->map(function ($item,$key) use ($asset){
            $orders = $asset->filter(function ($value, $key) use ($item){
                return $value->post_ID == $item->post_ID;
            });

            $item->imagePath = $orders->values();

            return $item;
        });

        if (isset($userProfile->user_birthday)){
            $userProfile->user_birthday = Carbon::parse($userProfile->user_birthday)->age;
        }

        $listComment = Comment::select('*','tbl_comment.created_at')->join('tbl_User','tbl_User.user_ID','=','tbl_comment.user_ID')
            ->get()->groupBy('post_ID');
        $listComment = ['data'=>$listComment];

        $getLike = Like::select('post_ID',DB::raw('count(post_ID) as total'))->where('state','=',1)->groupBy('post_ID')->get()->keyBy('post_ID');
        $getLike = ['data'=>$getLike];

        $stateLike = Like::select('post_ID','state')->where('user_ID','=',1)->where('state','=',1)->get()->groupBy('post_ID');

        $stateFollow = Follow::where('user_ID','=',$myUser->user_ID)->where('user_follower_ID','=',$id)->first();

        $getFollower = Follow::join('tbl_User','tbl_User.user_ID','=','tbl_Follow.user_ID')
            ->where('tbl_Follow.user_follower_ID','=',$id)->get();
        $roleFollower = Follow::join('tbl_User_Role','tbl_User_Role.user_ID','=','tbl_Follow.user_ID')
            ->join('tbl_Role','tbl_User_Role.role_ID','=','tbl_Role.role_ID')
            ->join('tbl_Game','tbl_Game.game_ID','=','tbl_User_Role.game_ID')
            ->where('tbl_Follow.user_follower_ID','=',$id)->get();


        $roleFollower = $roleFollower->mapToGroups(function ($item, $key) {
            return [$item['user_ID'] => ["role_name"=>$item['role_name'],"role_color"=>$item['role_color'],"game_logo"=>$item['game_logo']]];
        });

        $getFollower->map(function ($item) use($roleFollower){
            foreach ($roleFollower as $key => $role){
                if ($key == $item->user_ID){
                    $item->role = $role;
                }
            }
           return $item;
        });


        $getFollowing = Follow::join('tbl_User','tbl_User.user_ID','=','tbl_Follow.user_follower_ID')
            ->where('tbl_Follow.user_ID','=',$id)->get();

        $roleFollowing = Follow::join('tbl_User_Role','tbl_User_Role.user_ID','=','tbl_Follow.user_follower_ID')
            ->join('tbl_Role','tbl_User_Role.role_ID','=','tbl_Role.role_ID')
            ->join('tbl_Game','tbl_Game.game_ID','=','tbl_User_Role.game_ID')
            ->where('tbl_Follow.user_ID','=',$id)->get();

//        return $roleFollowing;

        $roleFollowing = $roleFollowing->mapToGroups(function ($item, $key) {
            return [$item['user_follower_ID'] => ["role_name"=>$item['role_name'],"role_color"=>$item['role_color'],"game_logo"=>$item['game_logo']]];
        });

//        return $roleFollowing;
        $getFollowing->map(function ($item) use($roleFollowing){
            foreach ($roleFollowing as $key => $role){
                if ($key == $item->user_follower_ID){
                    $item->role = $role;
                }else{
                    $item->role = [];
                }
            }

            return $item;
        });

        $listStats = StatsPlayer::join('tbl_Game','tbl_Game.game_ID','=','tbl_stats_player.game_ID')
                        ->where('user_ID','=',Auth::user()->user_ID)
                        ->get();

        if (!isset($_GET['code'])) {

            // Fetch the authorization URL from the provider, and store state in session
            $authorizationUrl = $this->getConfig()->getAuthorizationUrl();
            $_SESSION['oauth2state'] = $this->getConfig()->getState();

            // Display link to start auth flow
            return view("pages.profile",compact('feeds','listComment','getLike','stateLike','stateFollow','getFollow','getFollower','getFollowing','myTeam','myUser','id','type','statsPlayer','userProfile','userLanguage','userRole','getTeam','gameList','listStats','authorizationUrl'));

            // Check given state against previously stored one to mitigate CSRF attack
        }
//        return $getFollowing;
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
        switch ($request->state){
            case "tw_link":
                $this->linkTW($request->tw_username,$id);
                break;
            case "steam_link":
                $this->linkSteam($request->tw_username,$id);
//                return $dd;
                break;
            case "battlenet_link":
                if (preg_match("/^[\p{L}\p{Mn}][\p{L}\p{Mn}0-9]{2,11}#[0-9]{4,5}+$/u", $request->tw_username) > 0)
                {
                    $tw_username = str_replace("#","-",$request->tw_username);

                    $this->linkBattle($tw_username,$id);
                }else{
                    return redirect('/profile/'.$id);
                }
                break;
            case "tw_unlink":
                $user = User::find($id);
                $user->tw_username = null;
                $user->tw_ID = null;
                $user->tw_logo = null;
                $user->save();
                break;
            case "steam_unlink":
                $user = User::find($id);
                $user->steam_ID = null;
                $user->save();
                break;
            case "battlenet_unlink":
                $user = User::find($id);
                $user->battlenet_ID = null;
                $user->save();
                break;
            default:
        }

        return redirect('/profile/'.$id);
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

    function linkTW($tw_username,$id){
        if (filter_var($tw_username, FILTER_VALIDATE_URL) !== false) {
            $tw_username = basename($tw_username);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.twitch.tv/kraken/users?login=".$tw_username,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/vnd.twitchtv.v5+json",
                "Client-ID: nzrv6yapvtsrkp1nv4v1287hrbxs74",
                "Postman-Token: 55879291-e73d-4c88-8aa8-b1e0aa38eed6",
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response,true);
            if (!isset($response['error'])){
                $user = User::find($id);
                $user->tw_username = $response['users'][0]['name'];
                $user->tw_ID = $response['users'][0]['_id'];
                $user->tw_logo = $response['users'][0]['logo'];
                $user->save();
            }else{
                return "error";
            }
        }
        return true;
    }

    function linkSteam($usernameInGame,$id){
        $usernameInGame = filter_var($usernameInGame, FILTER_SANITIZE_URL);

        if (filter_var($usernameInGame, FILTER_VALIDATE_URL) !== false) {
            $usernameInGame = basename($usernameInGame);
        }

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.steampowered.com/ISteamUser/ResolveVanityURL/v1/?key=EBAC31D270D905749D75BEB0536CD423&vanityurl=".$usernameInGame,
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
                $user = User::find($id);
                $user->steam_ID = $json['response']['steamid'];
                $user->save();
            }
        }

        return true;
    }

    function linkBattle($battleTag,$id){
        $user = User::find($id);
        $user->battlenet_ID = $battleTag;
        $user->save();

        return true;
    }

    function apiTwitch(){
            try {
                // Get an access token using authorization code grant.
                $accessToken = $this->getConfig()->getAccessToken('authorization_code', [
                    'code' => $_GET['code']
                ]);

                // Using the access token, get user profile
                $resourceOwner = $this->getConfig()->getResourceOwner($accessToken);
                $user = $resourceOwner->toArray();

                echo '<html><table>';
                echo '<tr><th>Access Token</th><td>' . htmlspecialchars($accessToken->getToken()) . '</td></tr>';
                echo '<tr><th>Refresh Token</th><td>' . htmlspecialchars($accessToken->getRefreshToken()) . '</td></tr>';
                echo '<tr><th>Username</th><td>' . htmlspecialchars($user['data'][0]['display_name']) . '</td></tr>';
                echo '<tr><th>Bio</th><td>' . htmlspecialchars($user['data'][0]['bio']) . '</td></tr>';
                echo '<tr><th>Image</th><td><img src="' . htmlspecialchars($user['data'][0]['logo']) . '"></td></tr>';
                echo '</table></html>';


                // You can now create authenticated API requests through the provider.
                $request = $this->getConfig()->getAuthenticatedRequest(
                    'GET',
                    'https://api.twitch.tv/kraken/user',
                    $accessToken
                );

            } catch (Exception $e) {
                exit('Caught exception: '.$e->getMessage());
            }
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
