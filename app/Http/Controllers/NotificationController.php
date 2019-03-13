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

        $notication = Notification::select('tbl_notificaiton.notificationID','tbl_notificaiton.notification_type','tbl_notificaiton.notificaiton_state','tbl_notificaiton_type.typeName','tbl_notificaiton.created_at','teamID','team_name','team_logo','user_ID','user_name','user_image','typeDetail')
            ->join('tbl_notificaiton_detail','tbl_notificaiton_detail.notificaitonID','=','tbl_notificaiton.notificationID')
            ->join('tbl_notificaiton_type','tbl_notificaiton_type.typeID','=','tbl_notificaiton.notification_type')
            ->join('tbl_User','tbl_User.user_ID','=','tbl_notificaiton_detail.senderID')
            ->join('tbl_team','tbl_team.team_ID','=','tbl_notificaiton_detail.teamID')
//            ->whereDate('tbl_notificaiton.created_at','<',$now)
            ->where('tbl_notificaiton.notification_User','=',Auth::user()->user_ID)
            ->orderby('tbl_notificaiton.created_at','desc')
            ->get();

        $countNoti = $notication->count();

//        return [$notication,$countNoti,$now];
        return view('pages.notifications',compact('gameList','userRole','countStats','notication','noticationEarlier','countNoti'));
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
                    ->delete();
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
}
