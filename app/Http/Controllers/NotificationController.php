<?php

namespace App\Http\Controllers;

use App\Game;
use App\Notification;
use App\StatsPlayer;
use App\TeamManager;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now()->toDateString();
        $gameList = Game::get();

        $userRole = UserRole::join('tbl_Role','tbl_Role.role_ID','=','tbl_User_Role.role_ID')
            ->join('tbl_Game','tbl_Game.game_ID','=','tbl_User_Role.game_ID')
            ->where('user_ID','=',Auth::user()->user_ID)
            ->where('stateRole','>',0)
            ->limit(2)
            ->get();

        $countStats= StatsPlayer::where('user_ID','=',Auth::user()->user_ID)->count();

//        $notication = Notification::select('tbl_notificaiton.notificationID','tbl_notificaiton.created_at','teamID','team_name','team_logo','user_ID','user_name','user_image','typeDetail')
//            ->join('tbl_notificaiton_detail','tbl_notificaiton_detail.notificaitonID','=','tbl_notificaiton.notificationID')
//            ->join('tbl_notificaiton_type','tbl_notificaiton_type.typeID','=','tbl_notificaiton.notification_type')
//            ->join('tbl_User','tbl_User.user_ID','=','tbl_notificaiton_detail.senderID')
//            ->join('tbl_team','tbl_team.team_ID','=','tbl_notificaiton_detail.teamID')
//            ->whereDate('tbl_notificaiton.created_at','=',$now)
//            ->where('tbl_notificaiton.notification_User','=',Auth::user()->user_ID)
//            ->get();

        $notication = Notification::select('tbl_notificaiton.notificationID','tbl_notificaiton.notification_type','tbl_notificaiton.notificaiton_state','tbl_notificaiton_type.typeName','tbl_notificaiton.created_at','notificationText','teamID','team_name','team_logo','user_ID','user_name','user_image','typeDetail')
            ->join('tbl_notificaiton_detail','tbl_notificaiton_detail.notificaitonID','=','tbl_notificaiton.notificationID')
            ->join('tbl_notificaiton_type','tbl_notificaiton_type.typeID','=','tbl_notificaiton.notification_type')
            ->join('tbl_User','tbl_User.user_ID','=','tbl_notificaiton_detail.senderID')
            ->leftjoin('tbl_team','tbl_team.team_ID','=','tbl_notificaiton_detail.teamID')
//            ->whereDate('tbl_notificaiton.created_at','<',$now)
            ->where('tbl_notificaiton.notification_User','=',Auth::user()->user_ID)
            ->orderby('tbl_notificaiton.created_at','desc')
            ->get();

        $countNoti = $notication->count();

        $arr = [];
        if (Auth::user()->steam_ID != null){
            $getPubg = $this->getPubg(Auth::user()->steam_ID);

            foreach ($getPubg as $value){
                array_push($arr,collect(["title"=>$value['displayName'],"description"=>$value['description'],"thumbnail"=>$value['icon'],"value"=>$value['defaultvalue']]));
            }
        }

        if (Auth::user()->battlenet_ID != null){
            $getOverWatch = $this->getOverWatch(Auth::user()->battlenet_ID);

            foreach ($getOverWatch as $value){
                array_push($arr,collect(["title"=>$value['title'],"description"=>$value['description'],"thumbnail"=>$value['thumbnail'],"value"=>$value['acquired']]));
            }
        }

        $fill = collect($arr)->filter(function ($item){
            return $item['value'] == false || $item['value'] == 0;
        });

        $count = collect($arr)->filter(function ($item){
            return $item['value'] == true || $item['value'] > 0;
        })->count();


        if (count($fill)>0){
            if (count($fill)>4){
                $result = $fill->random(4);
            }else{
                $result = $fill;
            }
        }else{
            $result = [];
        }

//        return [$notication,$countNoti,$now];
        return view('pages.notifications',compact('gameList','userRole','countStats','notication','noticationEarlier','countNoti','count','result'));
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
        $notificationID = $request->notificationID;
        $user_ID = $request->user_ID;
        $choice = $request->choice;

        $notification = Notification::where('notificationID',$notificationID)
            ->join('tbl_notificaiton_detail','tbl_notificaiton_detail.notificaitonID','=','tbl_notificaiton.notificationID')
            ->first();
        $notification->notificaiton_state = $choice;
        $notification->save();

        if ($notification->notification_type == 1){
            if ($choice == 1){
                $teamMabager = TeamManager::where('teamID','=',$notification->teamID)
                    ->where('user_ID','=',$notification->notification_User)
                    ->first();
                $teamMabager->user_verify = 1;
                $teamMabager->save();
            }else{
                TeamManager::where('teamID','=',$notification->teamID)
                    ->where('user_ID','=',$notification->notification_User)
                    ->update(['user_ID' => null,'user_verify' => 0,'expired_invite' => "9999-12-31"]);
            }
        }else{

        }

        return redirect('notifications');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
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
}
