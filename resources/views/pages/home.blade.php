@extends('layouts.sidebar')
@section('content')
    <style>
        .dropzone{
            padding: 10px 10px;
            border: 2px dashed #888888;
        }
        .dropzone .dz-preview .dz-image img {
            width: 100%;
        }
        .dropzone .dz-preview{
            margin: 10px;
        }
        .dropzone .dz-details .dz-size{
            display: none;
        }
        .dropzone .dz-preview .dz-image {
            border-radius: 0;
        }
        .dropzone .dz-preview.dz-image-preview{
            background: none;
        }
        .dropzone .dz-preview.dz-error:hover .dz-error-message {
            display: none;
        }

        #main-video {
            display: none;
            max-height: 300px;
        }

        #thumbnail-container {
            display: none;
        }

        #get-thumbnail {
            display: none;
        }

        #video-canvas {
            display: none;
        }

        #upload-button {
            width: 100%;
            height: 100%;
            cursor: pointer;
            display: block;
            padding: 10px 10px;
            border: 2px dashed #888888;
            background-color: rgba(255,255,255,0.1);
            border-radius: 8px;
            color: #ffffff;
        }

        #file-to-upload {
            display: none;
        }

        .carousel-indicators .active{
            background-color: rgba(241,29,114,1);
        }
        .carousel-indicators li {
            width: 10px;
            height: 10px;
            border-radius: 5px;
            background-color: rgba(255,255,255,.8);
        }
        .carousel{
            width:300px;
        }
        .item img{
            object-fit:cover;
            height:400px !important;
            width:350px;
        }
        .content-image-center{
            position: relative;
            left: 50%;
            transform: translateX(-50%);
        }
        .carousel-item{
            height: 100%;
        }
        .carousel{
            height: 100%;
        }
        .carousel-inner{
            height: 100%;
        }
        @media (max-width: 524px) {

            .box-image{
                height: 200px;
            }
        }
        @media (min-width: 1200px) {
            .box-image{
                height: 400px;
            }
        }

    </style>
    <div id="box-item" class="container-fluid supreme-container home-margin-top">
        <div class="row pt-2">
            <div class="col-12 col-md-9 p-2">
                <div class="row mx-0" style="height: auto;padding-bottom: 80px">
                    @if(\Illuminate\Support\Facades\Auth::User())
                        @include('includes.boxHomePost')
                    @endif
                    {{--------------------------content--------------------------}}
                        @foreach($feeds as $key => $item)
                            <div class="col-12 mb-3">
                                <div class="row" style="height: auto; border-radius: 8px;background-color: rgba(255,255,255,0.1);">
                                    <div class="col-12 p-md-4 p-3">
                                        <div class="row mx-0 align-items-center">
                                            <div class="col-2 col-md-1 p-0">
                                                <a href="profile/{{$item->user_ID}}">
                                                    <img src="{{asset('data-image/userImage/'.$item->user_image)}}" width="100%" height="auto" style="border-radius: 50%">
                                                </a>
                                            </div>
                                            <div class="col-10 col-md-11">
                                                    <h3 class="label-font-Bold text-white mb-0" style="font-size: 16px">
                                                        <a class="label-font-Bold text-white" href="profile/{{$item->user_ID}}">
                                                            {{$item->user_name}}
                                                        </a>
                                                        <span class="label-font-Condensed-Regular" style="color: #AAAAAA">played a {{$item->game_name}}.</span>
                                                    </h3>
                                                    <span class="label-font-Condensed-Thin" style="color: #999999;font-size: 12px">{{$item->created_at}}</span>
                                            </div>
                                        </div>
                                        <div class="row mt-4 mx-0">
                                            <p class="text-white label-font-Condensed-Regular mb-0" style="font-size: 14px">
                                                {{$item->post_detail}}
                                            </p>
                                        </div>
                                        @switch($item->postType_ID)
                                            @case(2)
                                                @include('includes.imageContentHome')
                                            @break
                                            @case(3)
                                                <div class="row mt-3 mx-0 justify-content-center box-image" style="height: 400px; background-color: rgba(0,0,0,1);">
                                                    <video class="mw-100" style="max-height: 400px" controls>
                                                        <source type="video/mp4" src="{{asset('data-image/post_asset/'.$item->imagePath[0]->asset_name)}}">
                                                    </video>
                                                </div>
                                            @break
                                        @endswitch
                                        <div class="row mt-4 mx-0">
                                            <div class="col-7 col-md-6">
                                                <div class="row align-items-center">
                                                    <div class="col-4 col-md-1 px-md-0 pl-0">
                                                        <img src="{{asset($item->game_logo)}}" width="100%" height="auto">
                                                    </div>
                                                    <div class="col-8 col-md-11 pl-md-3 pl-0">
                                                        <h3 class="label-font-Light mb-0 threeDot" style="font-size: 16px;color: #AAAAAA">{{$item->game_name}}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-5 col-md-6">
                                                <div class="row">
                                                    <div class="offset-md-6"></div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="row align-items-center justify-content-end" style="height: 40px">
                                                            @if(\Illuminate\Support\Facades\Auth::User())
                                                                <div class="col-6 col-md-4 pr">
                                                                    <div class="btn row align-items-center p-0 d-flex border-0 justify-content-end @if(isset($stateLike[$item->post_ID][0]['state'])) active @endif" onclick="like(this)" data-post-id="{{ $item->post_ID }}" data-user-id="{{\Illuminate\Support\Facades\Auth::User()->user_ID}}" data-toggle="button" @if(isset($stateLike[$item->post_ID][0]['state'])) aria-pressed="true" @else aria-pressed="false" @endif style="cursor: pointer;">
                                                                        <div class="like"></div>
                                                                        <span id="likeCount{{$item->post_ID}}" class="text-pink">
                                                                            @if(isset($getLike['data'][$item->post_ID]))
                                                                                {{$getLike['data'][$item->post_ID]['total']}}
                                                                            @else
                                                                                0
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="col-6 col-md-4">
                                                                    <div class="btn row align-items-center p-0 d-flex border-0 justify-content-end" style="cursor: pointer;">
                                                                        <div class="like"></div>
                                                                        <span id="likeCount{{$item->post_ID}}" class="text-pink">
                                                                            @if(isset($getLike['data'][$item->post_ID]))
                                                                                {{$getLike['data'][$item->post_ID]['total']}}
                                                                            @else
                                                                                0
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="col-6 col-md-4">
                                                                <div class="row justify-content-end">
                                                                    <div class="" data-toggle="collapse" data-target="#collapse{{$key}}" style="cursor: pointer">
                                                                        <img src="{{asset('/data-image/comment.svg')}}" width="auto" height="40px">
                                                                        <span id="commentCount{{$item->post_ID}}" class="text-pink">
                                                                            @if(isset($listComment['data'][$item->post_ID]))
                                                                                {{count($listComment['data'][$item->post_ID])}}
                                                                            @else
                                                                                0
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col collapse" id="collapse{{$key}}">
                                                <div class="row">
                                                    <div class="col" style="border: 1px solid rgba(255,255,255,0.1)"></div>
                                                </div>

                                                <div id="postID{{$item->post_ID}}">
                                                    @foreach($listComment['data'] as $key => $value)
                                                        @if($key == $item->post_ID)
                                                            @foreach($value as $comment)
                                                                <div class="row mt-3">
                                                                    <div class="col-12">
                                                                        <div class="row mx-0 ">
                                                                            <div class="col-3 col-md-1 pl-0">
                                                                                <a href="profile/{{$comment->user_ID}}">
                                                                                    <img src="{{asset('data-image/userImage/'.$comment->user_image)}}" width="100%" height="auto" style="border-radius: 30px">
                                                                                </a>
                                                                            </div>
                                                                            <div class="col-9 col-md-11 px-0">
                                                                                <h3 class="label-font-Bold text-white ml-md-3 mb-0" style="font-size: 16px">
                                                                                    <a class="label-font-Bold text-white" href="profile/{{$comment->user_ID}}">
                                                                                        {{$comment->user_name}}
                                                                                    </a>
                                                                                    <span class="label-font-Condensed-Thin ml-1" style="color: #999999;font-size: 12px">{{$comment->created_at}}</span>
                                                                                </h3>
                                                                                <p class="label-font-Condensed-Regular ml-md-3" style="color: #999999;font-size: 14px">{{$comment->textMessage}}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </div>

                                                @if(\Illuminate\Support\Facades\Auth::User())
                                                    <div class="row mt-3">
                                                        <div class="col-12">
                                                            <div class="row mx-0 ">
                                                                <div class="col-3 col-md-1 pl-0">
                                                                    <a href="/profile">
                                                                        <img src="{{asset('data-image/userImage/'.Auth::User()->user_image)}}" width="60px" height="60px" style="border-radius: 30px">
                                                                    </a>
                                                                </div>
                                                                <div class="col-9 col-md-11 px-0">
                                                                    <div class="row mx-0">
                                                                        <h3 class="label-font-Bold text-white ml-md-3 mb-0" style="font-size: 16px">
                                                                            <a class="label-font-Bold text-white" href="/profile">
                                                                                {{Auth::User()->user_name}}
                                                                            </a>
                                                                            <span class="label-font-Condensed-Thin ml-1" style="color: #999999;font-size: 12px">{{date("Y-m-d H:i:s")}}</span>
                                                                        </h3>
                                                                        <div class="col-12 pl-0 pl-md-3 mt-2">
                                                                            <input type="text" name="comment" onkeydown="comment(this)" data-post-id="{{ $item->post_ID }}" data-user-id="{{\Illuminate\Support\Facades\Auth::User()->user_ID}}" placeholder="Write a comment..." class="text-input pl-3" style="height: 34px">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                </div>
            </div>
            <div class="col-3 d-none d-lg-inline p-2 ">
                @if(\Illuminate\Support\Facades\Auth::User())
                    <div class="sticky-top" style="top: 10px;">
                        <div class="row mx-0">
                            <div class="col-12 pl-3 pr-3 pt-3" style="background-color: rgba(255,255,255,0.1); height: auto;border-radius: 8px">
                                <div class="row" style="height: 60px">
                                    <div class="col-3">
                                        <a href="/profile/">
                                            <img src="{{asset('data-image/userImage/'.Auth::User()->user_image)}}" width="60px" height="60px" style="border-radius: 30px">
                                        </a>
                                    </div>
                                    <div class="col-9">
                                        <div class="row mx-0 pl-1">
                                            <a href="profile/">
                                                <h3 class="label-font-Condensed-Regular text-white" style="font-size: 24px">{{Auth::User()->user_name}}</h3>
                                            </a>
                                            <a href="/ApiLogout"><img src="{{asset('data-image/power-button-off.svg')}}" style="width: 16px;height: 16px;position: absolute;right: 16px;"></a>
                                        </div>
                                        <div class="row mx-0 pl-1">
                                            @foreach($userRole as $item)
                                                <div class="box-role d-flex align-items-center mr-2" style="background-color: {{$item['role_color']}}">
                                                    <img src="{{asset($item->game_logo)}}" height="20px" width="20px">
                                                    <label class="text-white ml-1 m-0">{{$item->role_name}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4" style="height: 150px;">
                                    <div class="col-6">
                                        <img class="position-absolute" src="{{asset('/data-image/gameCount.svg')}}" width="60px" height="60px" style="top: -10px; left: 5px;">
                                        <div class="row mx-0">
                                            <div class="d-flex align-items-center justify-content-center" style="height: 110px;width: 120px;border-radius:60px;background-color: rgba(255,255,255,0.1)">
                                                <div class="d-flex align-items-center justify-content-center" style="height: 96px;width: 96px;border-radius:48px;background-color: rgba(255,255,255,0.1)">
                                                    <h3 class="text-white label-font-Thin mb-0" style="font-size: 40px">{{$countStats}}</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-center">
                                                <span class="label-font-Regular" style="font-size: 16px;color:#AAAAAA">Games</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <img class="position-absolute" src="{{asset('/data-image/gameReward.svg')}}" width="60px" height="60px" style="top: -10px; left: 5px;">
                                        <div class="row mx-0" >
                                            <div class="d-flex align-items-center justify-content-center" style="height: 110px;width: 120px;border-radius:60px;background-color: rgba(255,255,255,0.1)">
                                                <div class="d-flex align-items-center justify-content-center" style="height: 96px;width: 96px;border-radius:48px;background-color: rgba(255,255,255,0.1)">
                                                    <h3 class="text-white label-font-Thin mb-0" style="font-size: 40px">{{$count}}</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-center">
                                                <span class="label-font-Regular" style="font-size: 16px;color:#AAAAAA">Achievements</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--<a href="/ApiLogout"><button type="submit" class="btn btn-primary red-btn" >LOGOUT</button></a>--}}
                            </div>
                        </div>
                        <div class="row pt-3 mx-0">
                            <div class="col-12 pl-3 pr-3 pt-3 pb-4" style="background-color: rgba(255,255,255,0.1); height: auto;border-radius: 8px">
                                <div class="row " style="height: auto">
                                    <div class="col-6">
                                        <span class="text-white label-font-Regular">Achievements</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        <a href="/achievements" class="label-font-Light" style="font-size: 12px;color: #AAAAAA">see more</a>
                                    </div>
                                </div>

                                @foreach($result as $item)
                                    <div class="row mt-3" style="height: auto;">
                                    <div class="col-3">
                                        <img src="{{$item['thumbnail']}}" width="64px" height="64px">
                                    </div>
                                    <div class="col-9 pt-1">
                                        <div class="row mx-0">
                                            <h5 class="text-white label-font-Bold mb-1" style="font-size: 14px">{{$item['title']}}</h5>
                                        </div>
                                        <div class="row mr-0">
                                            <div class="col-8" style="padding-top: 2px">
                                                <p class="label-font-Thin threeDot mb-0" style="color:#B5DEFF;font-size: 12px;height: auto">{{$item['description']}}</p>
                                            </div>
                                            <div class="col-4 p-0 text-right">
                                                <span class="text-white label-font-Thin " style="font-size: 12px">
                                                    @if($item['value'] == true)
                                                        Complete
                                                    @else
                                                        Unfinished
                                                    @endif
                                                </span>

                                            </div>
                                        </div>
                                        {{--<div class="row mx-0 pt-2">--}}
                                            {{--<div id="myProgress{{$i}}">--}}
                                                {{--<div id="myBar{{$i}}" data-progress-id="{{$i}}"></div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                                @endforeach
                                {{--<button onclick="move()" class="btn btn-primary red-btn" >Move</button>--}}

                            </div>
                        </div>
                        {{--banner sponsor--}}
                        <div class="row mt-3 mx-0">
                            <div class="col-12" style="height:180px;">
                                <div class="row mx-0" style="height: auto">
                                    <img class="col-12 p-0" src="{{asset('/data-image/null-ads.png') }}" alt="overwatch">
                                </div>
                                <div class="row mt-3" style="height: auto">
                                    <div class="col-6">
                                        <p class="text-white">Sponsor By </p>
                                    </div>
                                    <div class="col-6">
                                        <p class="text-white text-right">xxxxxxxxxxx</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--<p class="text-input-label">user_name : {{Auth::User()->user_name}}</p>--}}
                        {{--<p class="text-input-label">user_email : {{Auth::User()->user_email}}</p>--}}
                        {{--<p class="text-input-label">created_at : {{Auth::User()->created_at}}</p>--}}
                    </div>
                @else
                    <div class="sticky-top" style="top: 10px;">
                        <div class="row mx-0">
                            <div class="col-12 pl-3 pr-3 pt-3" style="background-color: rgba(255,255,255,0.1); height: 500px">
                                <form action="/ApiLogin" method="post">
                                    @csrf
                                    <img src="{{asset('/data-image/title-welcome.png') }}" width="100%" height="150px">
                                    <div class="form-group mt-4">
                                        <p class="text-input-label">E-mail</p>
                                        <input type="text" name="email" placeholder="example@mail.com" class="text-input pl-3">
                                    </div>

                                    <div class="form-group mt-4">
                                        <p class="text-input-label">Password</p>
                                        <input type="password" name="password" placeholder="••••••••••••••" class="text-input pl-3">
                                    </div>
                                    <p class="mt-1" style="color: #ffffff; font-weight: lighter">Forgot your password ?</p>
                                    @if(session()->get( 'hint' ) != null)
                                        <p class="text-pink"><i class="fas fa-exclamation-triangle"></i> {{ session()->get( 'hint' ) }}</p>
                                    @endif
                                    {{--@if(isset($hint))--}}
                                        {{--<p>{{$hint}}</p>--}}
                                    {{--@endif--}}

                                    <button type="submit" class="btn btn-primary red-btn" >LOGIN</button>
                                </form>
                                {{--<a href="/register"><button class="light-btn mt-3">SIGN UP</button></a>--}}
                                <button class="light-btn mt-3" data-toggle="modal" data-target="#exampleModal">SIGN UP</button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-color: #212529;border: none">
                <div class="d-flex justify-content-center">
                    <form action="/ApiRegister" method="post" class="col-12 pt-3" style=" height: 100%;">
                        @csrf
                        <div class="form-group">
                            <h3 class="label-font-Bold text-white text-center">Sign Up</h3>
                        </div>
                        <div class="form-group">
                            <label class="text-input-label">User name</label>
                            <input name="userName" type="text" class="form-control text-input" aria-describedby="emailHelp" placeholder="User name">
                        </div>
                        <div class="form-group">
                            <label class="text-input-label">Email address</label>
                            <input name="email" type="email" class="form-control text-input" aria-describedby="emailHelp" placeholder="example@mail.com">
                        </div>
                        <div class="form-group">
                            <label class="text-input-label">Password</label>
                            <input name="password" type="password" class="form-control text-input" aria-describedby="emailHelp" placeholder="••••••••••••••">
                        </div>
                        <div class="form-group">
                            <label class="text-input-label">Confirm Password</label>
                            <input type="password" class="form-control text-input" placeholder="••••••••••••••">
                        </div>
                        <div class="row d-flex justify-content-center pt-2 mb-3">
                            <button type="submit" class="btn btn-primary red-btn col-6 mr-4">Sign up</button>
                            <button type="reset" class="btn btn-secondary light-btn col-4 ml-4">Reset</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-color: #212529;border: none">
                <div class="d-flex justify-content-center">
                    <form action="/ApiLogin" method="post" class="col-12 pt-3" style=" height: 100%;">
                        @csrf
                        <div class="form-group">
                            <h3 class="label-font-Bold text-white text-center">Login</h3>
                        </div>
                        <div class="form-group">
                            <label class="text-input-label">Email address</label>
                            <input name="email" type="email" class="form-control text-input" aria-describedby="emailHelp" placeholder="example@mail.com">
                        </div>
                        <div class="form-group">
                            <label class="text-input-label">Password</label>
                            <input name="password" type="password" class="form-control text-input" aria-describedby="emailHelp" placeholder="••••••••••••••">
                        </div>
                        <div class="row d-flex justify-content-center pt-2 mb-3">
                            <button type="submit" class="btn btn-primary red-btn col-6 mr-4">Sign up</button>
                            <button type="reset" class="btn btn-secondary light-btn col-4 ml-4">Reset</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        function comment(e) {
            var token = $("meta[name='csrf-token']").attr("content");

            if (event.keyCode === 13) {
                // alert(e.value)
                // alert(e.getAttribute("data-post-id"))
                // alert(e.getAttribute("data-user-id"))

                var text = e.value;
                var postID = e.getAttribute("data-post-id");
                var userID = e.getAttribute("data-user-id");
                var params = "text="+text+"&postID="+postID+"&userID="+userID+"&type=comment";

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    var render = ""
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText != ""){
                            var obj = JSON.parse(this.responseText);
                            console.log(obj,"comment")
                            obj.forEach(function (comment) {
                                render += "<div class=\"row mt-3\">\n" +
                                    "                                                                <div class=\"col-12\">\n" +
                                    "                                                                    <div class=\"row mx-0 \">\n" +
                                    "                                                                        <div class=\"col-1 pl-0\">\n" +
                                    "                                                                            <a href=&quot;profile/"+comment['user_ID']+"&quot;>\n" +
                                    "                                                                                <img src=data-image/userImage/"+comment['user_image']+" width=\"60px\" height=\"60px\" style=\"border-radius: 30px\">\n" +
                                    "                                                                            </a>\n" +
                                    "                                                                        </div>\n" +
                                    "                                                                        <div class=\"col-11 px-0\">\n" +
                                    "                                                                            <h3 class=\"label-font-Bold text-white ml-3 mb-0\" style=\"font-size: 16px\">\n" +
                                    "                                                                                <a class=\"label-font-Bold text-white\" href='/profile/"+comment['user_ID']+"'>\n" +
                                    "                                                                                    "+comment['user_name']+"\n" +
                                    "                                                                                </a>\n" +
                                    "                                                                                <span class=\"label-font-Condensed-Thin ml-1\" style=\"color: #999999;font-size: 12px\">"+comment['created_at']+"</span>\n" +
                                    "                                                                            </h3>\n" +
                                    "                                                                            <p class=\"label-font-Condensed-Regular ml-3\" style=\"color: #999999;font-size: 14px\">"+comment['textMessage']+"</p>\n" +
                                    "                                                                        </div>\n" +
                                    "                                                                    </div>\n" +
                                    "                                                                </div>\n" +
                                    "                                                            </div>"
                            })
                            document.getElementById('commentCount'+obj[0]['post_ID']).innerText = obj.length
                            document.getElementById('postID'+obj[0]['post_ID']).innerHTML = render;
                        }
                    }
                };

                xhttp.open("POST", "/", true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.setRequestHeader("x-csrf-token", token);
                xhttp.send(params);

                e.value = ""
            }
        }

        function like(e) {
            var token = $("meta[name='csrf-token']").attr("content");

            // alert(e.getAttribute("data-post-id"))
            // alert(e.getAttribute("data-user-id"))

            var postID = e.getAttribute("data-post-id");
            var userID = e.getAttribute("data-user-id");
            var params = "&postID="+postID+"&userID="+userID+"&type=like";

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('likeCount'+postID).innerText = ""
                    if (this.responseText != ""){
                        var obj = JSON.parse(this.responseText);
                        console.log(obj,"likeCount")
                        document.getElementById('likeCount'+postID).innerText = obj
                    }
                }
            };

            xhttp.open("POST", "/", true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.setRequestHeader("x-csrf-token", token);
            xhttp.send(params);
        }

        // document.getElementById('commentInput').addEventListener("keydown", function(event) {
        //     if (event.keyCode === 13) {
        //         event.preventDefault();
        //         alert(document.getElementById('commentInput').value)
        //         alert(document.getElementById('commentInput').getAttribute("data-post-id"))
        //         alert(document.getElementById('commentInput').getAttribute("data-user-id"))
        //         // document.getElementById("commentBtn").click();
        //     }
        // });
    </script>
@stop