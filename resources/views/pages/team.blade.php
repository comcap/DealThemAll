@extends('layouts.sidebar')
@section('content')
    <div id="box-item" class="container-fluid mt-2">
        @include('includes.teamHeader')
        <div class="row border-bottom">
            <div class="col-12 mt-3 ">
                <div class="row mb-0 align-items-end">
                    <div class="col-5 p-0" style="height:50px">
                        <div class="row">
                            <img class="pl-3" id="gameLogo" src="{{asset('data-image/game_logo/overwatch/logo.svg')}}" height="40px">
                            <div class="col-10 pl-0">
                                <select class="pl-3 selectGameTeam label-font-Bold ml-3" onchange="selectGameTeam({{\Illuminate\Support\Facades\Auth::user()->user_ID}},{{$teamManager}})" name="game" id="gameList" style="font-size: 24px">
                                    @foreach($gameList as $item)
                                        <option value="{{$item->game_ID}}">{{$item->game_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 " style="height:50px">
                        <div id="warning-box" class="row align-items-end justify-content-end pb-1 h-100">
                            {{--<div class="col">--}}
                                {{--<h4><span class="badge badge-warning">Warning</span></h4>--}}
                            {{--</div>--}}
                            {{--<div class="col">--}}
                                {{--<h4><span class="badge badge-warning">Warning</span></h4>--}}
                            {{--</div>--}}
                            {{--<div class="col">--}}
                                {{--<h4><span class="badge badge-warning">Warning</span></h4>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="row p-0" style="height: 60px">
                            <div class="col-9 d-flex justify-content-end">
                                <div class="row">
                                    <div class="col-2 p-0">
                                        <img id="teamManReady" src="{{asset('data-image/standing-up-man.svg')}}" height="50px">
                                    </div>
                                    <div class="col-10 pr-0">
                                        <p class="label-font-Condensed-Bold text-white mb-0">Player</p>
                                        <p class="label-font-Condensed-Bold text-pink pt-0" id="countInvite" style="font-size: 24px;">0/6</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 pl-0 d-flex align-items-center">
                                <img id="teamReady" src="{{asset('data-image/notReady.svg')}}" height="40px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4 pb-3" style="height: auto;background-color: rgba(255,255,255,0.1); border-radius: 8px">
            <div class="col-12">
                    <div class="row mt-3" id="boxManagerTeam">
                        <div id="LoadPlayer" class="col">
                            <div class="row py-4 justify-content-center">
                                <div class='loader'></div>
                            </div>
                        </div>
                        @for($i=0;$i<6;$i++)
                            {{--@include('includes.boxPlayerMember')--}}
                            {{--@include('includes.boxPlayerNull')--}}
{{--                            @include('includes.boxPlayerNoneMember')--}}
                        @endfor
                    </div>
            </div>
        </div>
        <div class="row mt-4 pb-3" style="height: auto;">
            <div class="col-3 pr-4" >
                <div class="row">
                    <div class="col-12 pb-3" style="height: auto; background-color: rgba(255,255,255,0.1); border-radius: 8px">
                        <ul class="row nav nav-tabs" id="myTab" role="tablist" style="border-bottom: 1px #CCCCCC77 solid">
                            <li class="nav-item w-100 col-6 px-0">
                                <a class="nav-link border-0 member-btn team-active label-font-Light text-white text-center pt-3 active" data-toggle="tab" href="#member" role="tab" aria-controls="member" aria-selected="true">
                                    Member <span>{{count($result)}}</span>
                                </a>
                            </li>

                            <li class="nav-item w-100 col-6 px-0">
                                <a class="nav-link border-0 following-btn team-active label-font-Light text-white text-center pt-3" data-toggle="tab" href="#follower" role="tab" aria-controls="follower" aria-selected="false">
                                    Follower <span>{{count($getFollower)}}</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content" >
                            <div class="tab-pane fade show active" id="member" role="tabpanel">
                                <div class="row mx-0">
                                    @foreach($result as $item)
                                        <div class="col-12 pt-4 px-3" style="height: auto;">
                                            <div class="row" style="height: 60px;">
                                                <div class="col-3 px-0">
                                                    <a href="/profile/{{$item->user_ID}}" >
                                                        <img src="{{asset('data-image/userImage/'.$item->user_image)}}" width="60px" height="60px" style="border-radius: 30px">
                                                    </a>
                                                </div>
                                                <div class="col-9 pt-1">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <a href="/profile/{{$item->user_ID}}" >
                                                                <h3 class="label-font-Bold text-white" style="font-size: 16px">{{$item->user_name}}</h3>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="row px-3">
                                                        @foreach($item->role as $key => $role)
                                                            <div class="box-role d-flex align-items-center mr-2" style="background-color: {{$role['role_color']}}">
                                                                <img src="{{asset($role->game_logo)}}" height="14px" width="14px">
                                                                <label class="text-white ml-1 m-0">{{$role->role_name}}</label>
                                                            </div>
                                                            @if ($key == 1)
                                                                @break
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="follower" role="tabpanel">
                                <div class="row mx-0">
                                    @foreach($getFollower as $item)
                                        <div class="col-12 pt-4 px-3" style="height: auto;">
                                            <div class="row" style="height: 60px;">
                                                <div class="col-3 px-0">
                                                    <a href="/profile/{{$item->user_ID}}" >
                                                        <img src="{{asset('/data-image/userImage/'.$item->user_image)}}" width="60px" height="60px" style="border-radius: 30px">
                                                    </a>
                                                </div>
                                                <div class="col-9 pt-1">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <a href="/profile/{{$item->user_ID}}" >
                                                                <h3 class="label-font-Bold text-white" style="font-size: 16px">{{$item->user_name}}</h3>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="row pl-3">
                                                        @foreach($item->role as $key => $role)
                                                            <div class="box-role d-flex align-items-center mr-2" style="background-color: {{$role['role_color']}}">
                                                                <img src="{{asset($role['game_logo'])}}" height="14px" width="14px">
                                                                <label class="text-white ml-1 m-0">{{$role['role_name']}}</label>
                                                            </div>
                                                            @if ($key == 1)
                                                                @break
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-9 pl-4">
                <div class="row">
                    @if(count($feeds) > 0)
                        @foreach($feeds as $key => $item)
                            <div class="col-12 pl-4 mb-3">
                                <div class="row" style="height: auto; border-radius: 8px;background-color: rgba(255,255,255,0.1);">
                                    <div class="col-12 p-4">
                                        <div class="row mx-0 align-items-center">
                                            <a href="/profile/{{$item->user_ID}}">
                                                <img src="{{asset('data-image/userImage/'.$item->user_image)}}" width="60px" height="60px" style="border-radius: 30px">
                                            </a>
                                            <div>
                                                <h3 class="label-font-Bold text-white ml-3 mb-0" style="font-size: 16px">
                                                    <a class="label-font-Bold text-white" href="/profile/{{$item->user_ID}}">
                                                        {{$item->user_name}}
                                                    </a>
                                                    <span class="label-font-Condensed-Regular" style="color: #AAAAAA">played a {{$item->game_name}}.</span>
                                                </h3>
                                                <span class="label-font-Condensed-Thin ml-3" style="color: #999999;font-size: 12px">{{$item->created_at}}</span>
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
                                            <div class="row mt-3 mx-0 justify-content-center" style="height: 400px; background-color: rgba(0,0,0,1);">
                                                <video class="mw-100" style="max-height: 400px" controls>
                                                    <source type="video/mp4" src="{{asset('data-image/post_asset/'.$item->imagePath[0]->asset_name)}}">
                                                </video>
                                            </div>
                                            @break
                                        @endswitch
                                        <div class="row mt-4 mx-0">
                                            <div class="col-6">
                                                <div class="row align-items-center">
                                                    <img src="{{asset($item->game_logo)}}" width="40px" height="40px">
                                                    <h3 class="label-font-Light ml-3 mb-0" style="font-size: 16px;color: #AAAAAA">{{$item->game_name}}</h3>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="offset-6"></div>
                                                    <div class="col-6">
                                                        <div class="row align-items-center justify-content-end" style="height: 40px">
                                                            @if(\Illuminate\Support\Facades\Auth::User())
                                                                <div class="col-4">
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
                                                                <div class="col-4">
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
                                                            <div class="col-4">
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
                                                                            <div class="col-1 pl-0">
                                                                                <a href="/profile/{{$comment->user_ID}}">
                                                                                    <img src="{{asset('data-image/userImage/'.$comment->user_image)}}" width="60px" height="60px" style="border-radius: 30px">
                                                                                </a>
                                                                            </div>
                                                                            <div class="col-11 px-0">
                                                                                <h3 class="label-font-Bold text-white ml-3 mb-0" style="font-size: 16px">
                                                                                    <a class="label-font-Bold text-white" href="/profile/{{$comment->user_ID}}">
                                                                                        {{$comment->user_name}}
                                                                                    </a>
                                                                                    <span class="label-font-Condensed-Thin ml-1" style="color: #999999;font-size: 12px">{{$comment->created_at}}</span>
                                                                                </h3>
                                                                                <p class="label-font-Condensed-Regular ml-3" style="color: #999999;font-size: 14px">{{$comment->textMessage}}</p>
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
                                                                <div class="col-1 pl-0">
                                                                    <a href="/profile">
                                                                        <img src="{{asset('data-image/userImage/'.Auth::User()->user_image)}}" width="60px" height="60px" style="border-radius: 30px">
                                                                    </a>
                                                                </div>
                                                                <div class="col-11 px-0">
                                                                    <div class="row mx-0">
                                                                        <h3 class="label-font-Bold text-white ml-3 mb-0" style="font-size: 16px">
                                                                            <a class="label-font-Bold text-white" href="/profile">
                                                                                {{Auth::User()->user_name}}
                                                                            </a>
                                                                            <span class="label-font-Condensed-Thin ml-1" style="color: #999999;font-size: 12px">{{date("Y-m-d H:i:s")}}</span>
                                                                        </h3>
                                                                        <div class="col-12 mt-2">
                                                                            <input id="commentInput" type="text" name="comment" onkeydown="comment(this)" data-post-id="{{ $item->post_ID }}" data-user-id="{{\Illuminate\Support\Facades\Auth::User()->user_ID}}" placeholder="Write a comment..." class="text-input pl-3" style="height: 34px">
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
                    @else
                        <div class="col-12">
                            <div class="row" style="height: auto; border-radius: 8px;background-color: rgba(255,255,255,0.1);">
                                <div class="col-12 p-5">
                                    <div class="row mx-0 " style="height: auto">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <img src="{{asset('/data-image/nullFeed.svg')}}" height="160px" width="auto">
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 text-center">
                                                    <h2 class="text-secondary label-font-Bold m-0"
                                                        style="font-size: 24px">Oops!</h2>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <h2 class="text-secondary label-font-Condensed-Thin mb-0"
                                                        style="font-size: 20px">No feed yet.</h2>
                                                </div>
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

    <!-- Modal -->
    <div class="modal fade" id="editTeam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="background-color: rgba(0,0,0,0.85);">
                <div class="d-flex justify-content-center" style="height: auto">
                    <div class="col-12 p-2">
                        <form action="{{$getTeam->team_ID}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row p-4 py-4">
                                <div class="col-3" style="flex-direction: column">
                                    <p class="text-white label-font-Bold">Edit Team</p>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="">
                                                <div style="background-color: rgba(255,255,255,0.1); width: 180px;height: 180px;">
                                                    @if($getTeam->team_logo)
                                                        <img id="imagePreview" src="{{asset("/data-image/teamLogos/".$getTeam->team_logo)}}" height="180px" width="180px" style="cursor: pointer" onclick="document.getElementById('file').click();">
                                                    @else
                                                        <img id="imagePreview" src="{{asset("/data-image/nullTeam.svg")}}" height="180px" width="180px" style="cursor: pointer" onclick="document.getElementById('file').click();">
                                                    @endif
                                                    <input onchange="previewFile()" type="file" style="display:none;" id="file" name="file" accept="image/*"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="offset-1"></div>--}}
                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="text-input-label">Name Team</p>
                                            <div class="form-group mt-2">
                                                <input type="text" name="nameTeam" placeholder="Example" class="text-input pl-3" style="background-color: rgba(255,255,255,0.1);" value="{{$getTeam->team_name}}" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <p class="text-input-label pl-0">Practice time</p>
                                            <div class="form-group mt-2">
                                                <div class="row px-3">
                                                    <select name="timeStart" id="game" class="text-select pl-3 col-5" style="height: 40px;background-color: rgba(255,255,255,0.1);" required>
                                                        <option value="00:00" <?php if ("00:00:00"==$getTeam->team_time_start){echo "selected";}?> >00:00</option>
                                                        <option value="01:00" <?php if ("01:00:00"==$getTeam->team_time_start){echo "selected";}?> >01:00</option>
                                                        <option value="02:00" <?php if ("02:00:00"==$getTeam->team_time_start){echo "selected";}?> >02:00</option>
                                                        <option value="03:00" <?php if ("03:00:00"==$getTeam->team_time_start){echo "selected";}?> >03:00</option>
                                                        <option value="04:00" <?php if ("04:00:00"==$getTeam->team_time_start){echo "selected";}?> >04:00</option>
                                                        <option value="05:00" <?php if ("05:00:00"==$getTeam->team_time_start){echo "selected";}?> >05:00</option>
                                                        <option value="06:00" <?php if ("06:00:00"==$getTeam->team_time_start){echo "selected";}?> >06:00</option>
                                                        <option value="07:00" <?php if ("07:00:00"==$getTeam->team_time_start){echo "selected";}?> >07:00</option>
                                                        <option value="08:00" <?php if ("08:00:00"==$getTeam->team_time_start){echo "selected";}?> >08:00</option>
                                                        <option value="09:00" <?php if ("09:00:00"==$getTeam->team_time_start){echo "selected";}?> >09:00</option>
                                                        <option value="10:00" <?php if ("10:00:00"==$getTeam->team_time_start){echo "selected";}?> >10:00</option>
                                                        <option value="11:00" <?php if ("11:00:00"==$getTeam->team_time_start){echo "selected";}?> >11:00</option>
                                                        <option value="12:00" <?php if ("12:00:00"==$getTeam->team_time_start){echo "selected";}?> >12:00</option>
                                                        <option value="13:00" <?php if ("13:00:00"==$getTeam->team_time_start){echo "selected";}?> >13:00</option>
                                                        <option value="14:00" <?php if ("14:00:00"==$getTeam->team_time_start){echo "selected";}?> >14:00</option>
                                                        <option value="15:00" <?php if ("15:00:00"==$getTeam->team_time_start){echo "selected";}?> >15:00</option>
                                                        <option value="16:00" <?php if ("16:00:00"==$getTeam->team_time_start){echo "selected";}?> >16:00</option>
                                                        <option value="17:00" <?php if ("17:00:00"==$getTeam->team_time_start){echo "selected";}?> >17:00</option>
                                                        <option value="18:00" <?php if ("18:00:00"==$getTeam->team_time_start){echo "selected";}?> >18:00</option>
                                                        <option value="19:00" <?php if ("19:00:00"==$getTeam->team_time_start){echo "selected";}?> >19:00</option>
                                                        <option value="20:00" <?php if ("20:00:00"==$getTeam->team_time_start){echo "selected";}?> >20:00</option>
                                                        <option value="21:00" <?php if ("21:00:00"==$getTeam->team_time_start){echo "selected";}?> >21:00</option>
                                                        <option value="22:00" <?php if ("22:00:00"==$getTeam->team_time_start){echo "selected";}?> >22:00</option>
                                                        <option value="23:00" <?php if ("23:00:00"==$getTeam->team_time_start){echo "selected";}?> >23:00</option>
                                                    </select>
                                                    <p class="col-2 text-center label-font-Bold text-white pt-2">To</p>
                                                    <select name="timeEnd" id="game" class="text-select pl-3 col-5" style="height: 40px;background-color: rgba(255,255,255,0.1);" required>
                                                        <option value="00:00" <?php if ("00:00:00"==$getTeam->team_time_end){echo "selected";}?> >00:00</option>
                                                        <option value="01:00" <?php if ("01:00:00"==$getTeam->team_time_end){echo "selected";}?> >01:00</option>
                                                        <option value="02:00" <?php if ("02:00:00"==$getTeam->team_time_end){echo "selected";}?> >02:00</option>
                                                        <option value="03:00" <?php if ("03:00:00"==$getTeam->team_time_end){echo "selected";}?> >03:00</option>
                                                        <option value="04:00" <?php if ("04:00:00"==$getTeam->team_time_end){echo "selected";}?> >04:00</option>
                                                        <option value="05:00" <?php if ("05:00:00"==$getTeam->team_time_end){echo "selected";}?> >05:00</option>
                                                        <option value="06:00" <?php if ("06:00:00"==$getTeam->team_time_end){echo "selected";}?> >06:00</option>
                                                        <option value="07:00" <?php if ("07:00:00"==$getTeam->team_time_end){echo "selected";}?> >07:00</option>
                                                        <option value="08:00" <?php if ("08:00:00"==$getTeam->team_time_end){echo "selected";}?> >08:00</option>
                                                        <option value="09:00" <?php if ("09:00:00"==$getTeam->team_time_end){echo "selected";}?> >09:00</option>
                                                        <option value="10:00" <?php if ("10:00:00"==$getTeam->team_time_end){echo "selected";}?> >10:00</option>
                                                        <option value="11:00" <?php if ("11:00:00"==$getTeam->team_time_end){echo "selected";}?> >11:00</option>
                                                        <option value="12:00" <?php if ("12:00:00"==$getTeam->team_time_end){echo "selected";}?> >12:00</option>
                                                        <option value="13:00" <?php if ("13:00:00"==$getTeam->team_time_end){echo "selected";}?> >13:00</option>
                                                        <option value="14:00" <?php if ("14:00:00"==$getTeam->team_time_end){echo "selected";}?> >14:00</option>
                                                        <option value="15:00" <?php if ("15:00:00"==$getTeam->team_time_end){echo "selected";}?> >15:00</option>
                                                        <option value="16:00" <?php if ("16:00:00"==$getTeam->team_time_end){echo "selected";}?> >16:00</option>
                                                        <option value="17:00" <?php if ("17:00:00"==$getTeam->team_time_end){echo "selected";}?> >17:00</option>
                                                        <option value="18:00" <?php if ("18:00:00"==$getTeam->team_time_end){echo "selected";}?> >18:00</option>
                                                        <option value="19:00" <?php if ("19:00:00"==$getTeam->team_time_end){echo "selected";}?> >19:00</option>
                                                        <option value="20:00" <?php if ("20:00:00"==$getTeam->team_time_end){echo "selected";}?> >20:00</option>
                                                        <option value="21:00" <?php if ("21:00:00"==$getTeam->team_time_end){echo "selected";}?> >21:00</option>
                                                        <option value="22:00" <?php if ("22:00:00"==$getTeam->team_time_end){echo "selected";}?> >22:00</option>
                                                        <option value="23:00" <?php if ("23:00:00"==$getTeam->team_time_end){echo "selected";}?> >23:00</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="text-input-label">Language</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mt-2">
                                                <select name="language1" id="game" class="text-select pl-3" style="height: 40px;background-color: rgba(255,255,255,0.1);" required>
                                                    @if(isset($userLanguage[0]))
                                                        <option value="{{$userLanguage[0]->languageID}}">{{$userLanguage[0]->language_name}}</option>
                                                        @foreach($language as $item)
                                                            <option value="{{$item->languageID}}">{{$item->language_name}}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="" selected disabled>Select Language</option>
                                                        @foreach($language as $item)
                                                            <option value="{{$item->languageID}}">{{$item->language_name}}</option>
                                                        @endforeach
                                                        {{--<option value="ไม่พบข้อมูล">ไม่พบข้อมูล</option>--}}
                                                    @endif
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mt-2">
                                                <p class="text-input-label"></p>
                                                <select name="language2" id="game" class="text-select pl-3" style="height: 40px;background-color: rgba(255,255,255,0.1);">
                                                    @if(isset($userLanguage[0]))
                                                        <option value="{{$userLanguage[0]->languageID}}">{{$userLanguage[0]->language_name}}</option>
                                                        @foreach($language as $item)
                                                            <option value="{{$item->languageID}}">{{$item->language_name}}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="" selected disabled>Select Language</option>
                                                        @foreach($language as $item)
                                                            <option value="{{$item->languageID}}">{{$item->language_name}}</option>
                                                        @endforeach
                                                        {{--<option value="ไม่พบข้อมูล">ไม่พบข้อมูล</option>--}}
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mt-2">
                                                <p class="text-input-label"></p>
                                                <select name="language3" id="game" class="text-select pl-3" style="height: 40px;background-color: rgba(255,255,255,0.1);">
                                                    @if(isset($userLanguage[0]))
                                                        <option value="{{$userLanguage[0]->languageID}}">{{$userLanguage[0]->language_name}}</option>
                                                        @foreach($language as $item)
                                                            <option value="{{$item->languageID}}">{{$item->language_name}}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="" selected disabled>Select Language</option>
                                                        @foreach($language as $item)
                                                            <option value="{{$item->languageID}}">{{$item->language_name}}</option>
                                                        @endforeach
                                                        {{--<option value="ไม่พบข้อมูล">ไม่พบข้อมูล</option>--}}
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-4">
                                    <div class="row justify-content-center" style="height: auto">
                                        <input type="text" id="invitePlayer" name="invitePlayer" value="" hidden>
                                        <button type="submit" class="col-4 mr-3 btn btn-primary red-btn" style="font-size: 14px">Save</button>
                                        <button type="reset" class="col-4 ml-3 btn btn-secondary light-btn" style="font-size: 14px">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- KickModal -->
    <div class="modal fade" id="kickPlayer" tabindex="-1" role="dialog" aria-labelledby="KickModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content" style="background-color: rgba(0,0,0,0.85);">
                <div class="d-flex justify-content-center" style="height: auto">
                    <div class="col-12 p-2">
                        <form action="{{$teamManager}}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="row p-4 py-4">
                                <div class="col-12 text-center">
                                    <p class="text-white label-font-Bold" style="font-size: 20px">Kick Player <span id="deleteName" class="label-font-Condensed-Thin"></span></p>
                                </div>
                                <img data-dismiss="modal" src="{{asset('data-image/cancel.svg')}}" width="18px" height="18px" style="cursor: pointer;position: absolute;right: 16px; top: 16px;">
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                    <img id="deleteImg" src="{{asset('/data-image/error.svg')}}" width="auto" height="100px">
                                </div>
                            </div>
                            <div class="row p-4 py-4">
                                <div class="col-12 mt-4">
                                    <div class="row justify-content-center" style="height: auto">
                                        <input type="text" id="deletePlayer" name="inputUser_ID" value="" hidden>

                                        <button type="submit" value="" class="col-4 mr-3 btn btn-primary red-btn" style="font-size: 14px">Confirm</button>
                                        <button data-dismiss="modal" type="reset" class="col-4 ml-3 btn btn-secondary light-btn" style="font-size: 14px">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- AddPlayerModal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="background-color: rgba(0,0,0,0.85);">
                <div class="d-flex justify-content-center">
                    <div class="col-12 p-4">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h2 class="text-white label-font-Bold" style="font-size: 44px">SELECT PLAYER</h2>
                                <img data-dismiss="modal" src="{{asset('data-image/cancel.svg')}}" width="18px" height="18px" style="cursor: pointer;position: absolute;right: 7px; top: -11px;">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-center">
                                <h2 class="text-white label-font-Regular" style="font-size: 20px">Pick your player for selected</h2>
                            </div>
                        </div>

                        <div id="tab-select-role" class="row align-items-center mx-0" style="height: 50px">
                            <div class="col-3 text-center">
                                <label onclick="selectRolePlayer()" class="text-white pick-player label-font-Regular" style="font-size: 20px;">+item['typeName']+</label>
                            </div>
                        </div>
                        <form action="/team" method="post">
                            @csrf
                            <div id="listPlayerModal" class="row"></div>

                            <input type="text" name="teamID" value="{{$teamManager}}" hidden>
                            <input type="text" id="gameListPlayerModal" name="gameID" value="1" hidden>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var idTeam = {!! $teamManager !!}
        var teamOwner = {!! json_encode($TeamOwner) !!}
        var token = $("meta[name='csrf-token']").attr("content");

        $(document).ready(function () {
            setInterval(updateMember, 1000);   // 1000 = 1 second
            // updateMember();
            fetchPlayer();
            fetchType();
        })

        // $(".pick-player").hover(function() {
        //     $(this).addClass("text-pink")
        //     $(this).css("color","#F11D72")
        //     $(this).removeClass("text-white")
        // }).mouseleave(function() {
        //     $(this).addClass("text-white")
        //     $(this).css("color","#FFFFFF")
        //     $(this).removeClass("text-pink")
        // });

        $(document).on("click", "#kickMember", function () {
            var myBookId = $(this).data('article-id');
            var userName = $(this).data('player-name');
            var userImg= $(this).data('player-img');

            $("#deleteImg").attr("src",userImg);
            $("#deleteName").text(userName);
            $("#deletePlayer").val(myBookId);
        });

        function updateMember() {
            var xhttp = new XMLHttpRequest();
            var idGame = document.getElementById('gameList').value
            var url = '/getPlayerMember/'+idTeam+'/game/'+idGame

            xhttp.onreadystatechange = function() {
                var arr = [];
                var render = [];
                if (this.readyState == 4 && this.status == 200) {
                    var obj = JSON.parse(this.responseText);
                    console.log(obj,"getPlayerList")

                    arrInvite = obj['data'];

                    obj['warning'].forEach(function (item) {
                        render += "<h5><span class=\"badge text-white mx-2\" style='background-color: "+item['color']+"'>"+item['title']+"</span></h5>"
                    });

                    document.getElementById('warning-box').innerHTML = render;
                    // obj.forEach(function (item) {
                    //     item['role'].forEach(function (value) {
                    //         arr.push(value['role_name'])
                    //     })
                    // })
                    //
                    // console.log(arr,"role")

                    if (teamOwner) {
                        renderMyMember()
                    }else{
                        renderMemberList()
                    }
                }
            };
            xhttp.open("GET", url, true);
            xhttp.setRequestHeader("x-csrf-token", token);
            xhttp.send();
        }
        function fetchPlayer() {
            var url2 = '/getPlayerList/1/team/'+idTeam;
            // console.log(url2)
            var xhttp2 = new XMLHttpRequest();
            xhttp2.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var obj = JSON.parse(this.responseText);
                    document.getElementById('listPlayerModal').innerHTML = ""
                    obj.forEach(function (item) {
                        console.log(item,"getPlayerList")

                        var image_user = "http://"+window.location.hostname+":"+window.location.port+"/data-image/userImage/"+item['user_image']

                        if(item['role'][0] && item['role'][1]){
                            document.getElementById('listPlayerModal').innerHTML += renderListAddMember(item['user_ID'],item['user_name'],image_user,item['rank_total'],item['role'][0]['role_name'],item['role'][1]['role_name'])

                            // console.log(item['role'][0]['role_name'],"name")
                        }else if (item['role'][0]){
                            document.getElementById('listPlayerModal').innerHTML += renderListAddMember(item['user_ID'],item['user_name'],image_user,item['rank_total'],item['role'][0]['role_name'],"")
                        }else{
                            document.getElementById('listPlayerModal').innerHTML += renderListAddMember(item['user_ID'],item['user_name'],image_user,item['rank_total'],"","")

                        }
                    })
                }
            };
            xhttp2.open("GET", url2, true);
            xhttp2.send();
        }
        function fetchType() {
            var url3 = '/getRoleGame/1'
            var xhttp3 = new XMLHttpRequest();
            var render = ""
            xhttp3.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var obj = JSON.parse(this.responseText);
                    document.getElementById('tab-select-role').innerHTML = ""
                    render += "<div class=\"col-3 text-center item-Player-list\">\n" +
                        "                            <a href=\"#\" onclick=\"selectRolePlayer('all')\" class=\"pick-player label-font-Regular\" style=\"font-size: 20px;\">All Role</a>\n" +
                        "                            </div>"
                    obj.forEach(function (item, index) {

                        render += "<div class=\"col-3 text-center item-Player-list\">\n" +
                            "                            <a href=\"#\" onclick=\"selectRolePlayer("+item['typeID']+")\" class=\"pick-player label-font-Regular\" style=\"font-size: 20px;\">"+item['typeName']+"</a>\n" +
                            "                            </div>"
                    })
                    document.getElementById('tab-select-role').innerHTML = render
                }
            };
            xhttp3.open("GET", url3, true);
            xhttp3.send();
        }

        function comment(e) {
            var token = $("meta[name='csrf-token']").attr("content");

            if (event.keyCode === 13) {
                // alert(e.value)
                // alert(e.getAttribute("data-post-id"))
                // alert(e.getAttribute("data-user-id"))

                var text = e.value;
                var postID = e.getAttribute("data-post-id");
                var userID = e.getAttribute("data-user-id");
                var params = "text="+text+"&postID="+postID+"&userID="+userID;

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    var render = ""
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText != ""){
                            var obj = JSON.parse(this.responseText);
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
                            console.log(obj)
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
            var params = "&postID="+postID+"&userID="+userID;

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
    </script>
@stop