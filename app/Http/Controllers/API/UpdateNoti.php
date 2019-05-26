<?php

namespace App\Http\Controllers\API;

use App\Notification;
use App\TeamManager;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UpdateNoti extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dt = Carbon::now();
        $teamManager = TeamManager::where('user_verify', '=', 0)
            ->where('expired_invite', '<=', $dt)
            ->get();

        $notication = Notification::join('tbl_notificaiton_detail','tbl_notificaiton_detail.notificaitonID','=','tbl_notificaiton.notificationID')
            ->get();
        $userID = Auth::User()->user_ID;
        if ($teamManager != "[]"){
            foreach ($teamManager as $item){
                foreach ($notication as $value){
                    if ($item->teamID == $value->teamID && $item->user_ID == $value->notification_User){
                        $notification = Notification::join('tbl_notificaiton_detail','tbl_notificaiton_detail.notificaitonID','=','tbl_notificaiton.notificationID')
                            ->where('notification_User','=',$value->notification_User)
                            ->where('teamID','=',$value->teamID)
                            ->where('notificaiton_state','=',0)
                            ->first();

                        $notification->notificaiton_state = 2;
                        $notification->save();

                        TeamManager::where('user_verify','=',0)
                            ->where('expired_invite','<=',$dt)
                            ->update(['user_ID' => null,'user_verify' => 0,'expired_invite' => "9999-12-31"]);

                    }
                }
            }
            $countNoti = Notification::where('notification_isRead','=',0)
                ->where('notification_User','=',$userID)
                ->get()
                ->count();

            return $countNoti;
        }else{
            $countNoti = Notification::where('notification_isRead','=',0)
                ->where('notification_User','=',$userID)
                ->get()
                ->count();

            return $countNoti;
        }

//        TeamManager::where('user_verify','=',0)
//            ->where('expired_invite','<=',$dt)
//            ->delete();
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
        Notification::where('notification_User','=',$id)->update(['notification_isRead' => 1]);
        return "UpdateNoti update true";
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
