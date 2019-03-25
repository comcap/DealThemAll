<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Feed;
use App\Follow;
use App\Notification;
use App\NotificationDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $postDetail = $request->postDetail;
        $gameID = $request->gameID;
        $stateID = $request->stateID;
        $postImage = $request->postImage;
        $postVideo = $request->postVideo;

        $getFollow = Follow::where('user_follower_ID','=',Auth::user()->user_ID)->get();

        switch ($stateID){
            case 1:
                $post = new Feed();
                $post->user_ID = Auth::user()->user_ID;
                $post->game_ID = $gameID;
                $post->post_detail = $postDetail;
                $post->postType_ID = $stateID;
                $post->save();

                break;
            case 2:
                $post = new Feed();
                $post->user_ID = Auth::user()->user_ID;
                $post->game_ID = $gameID;
                $post->post_detail = $postDetail;
                $post->postType_ID = $stateID;
                $post->save();

                $human_readable_date = Carbon::now()->toTimeString();
                $timedata = strtotime($human_readable_date) * 1000;

                if(isset($postImage)){
                    foreach ($postImage as $item){
                        $asset = new Asset();
                        $asset->post_ID = $post->post_ID;
                        $image_resize = ImageManagerStatic::make($item->getRealPath());
//                    $image_resize->resize(320, 320);
                        $image_resize->resize(null, 400, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                        $image_resize->save(public_path().'/data-image/post_asset/'. $timedata."_".$item->getclientoriginalname());

                        $asset->asset_name = $timedata."_".$item->getclientoriginalname();
                        $asset->save();
                    }
                }else{
                    return "error";
                }
                break;
            case 3:
                $post = new Feed();
                $post->user_ID = Auth::user()->user_ID;
                $post->game_ID = $gameID;
                $post->post_detail = $postDetail;
                $post->postType_ID = $stateID;
                $post->save();

                $human_readable_date = Carbon::now()->toTimeString();
                $timedata = strtotime($human_readable_date) * 1000;

                if(isset($postVideo)){
                    $asset = new Asset();
                    $asset->post_ID = $post->post_ID;
                    $postVideo->move(public_path().'/data-image/post_asset/',$timedata."_".$postVideo->getclientoriginalname());
                    $asset->asset_name = $timedata."_".$postVideo->getclientoriginalname();
                    $asset->save();
                }else{
                    return "error";
                }

                break;
            default:
                return "error";
        }

        foreach ($getFollow as $item){
            $notification = new Notification();
            $notification->notification_User = $item->user_ID;
            $notification->notification_isRead = 0;
            $notification->notification_type = 4;
            $notification->notificaiton_state = 0;
            $notification->save();

            $notificationDetail = new NotificationDetail();
            $notificationDetail->notificaitonID = $notification->notificationID;
            $notificationDetail->teamID = null;
            $notificationDetail->senderID = Auth::user()->user_ID;
            $notificationDetail->gameID = $gameID;
            $notificationDetail->notificationText = $postDetail;
            $notificationDetail->save();
        }

        return redirect("/");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function show(Feed $feed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function edit(Feed $feed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feed $feed)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feed $feed)
    {
        //
    }
}
