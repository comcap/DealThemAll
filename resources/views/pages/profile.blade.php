@extends('layouts.sidebar')
@section('content')
    <div id="box-item" class="container-fluid mt-2">
        @include('includes.profileHeader')
        <div class="row">
            <div class="col-12 mt-3">
                <div class="row mb-2">
                    <div class="col-8 p-0 border-bottom" style="height:50px">
                        <div class="row">
                            <div class="col-1 pr-0">
                                <img id="logoGame" src="{{asset('data-image/game_logo/overwatch/logo.svg')}}" width="40px" height="40px">
                            </div>
                            <div class="col-5 p-0">
                                <select name="game" id="gameSelect" style="font-size: 24px" class="pl-3 select-game label-font-Bold" onchange="profileSelectGame({{$id}})">
                                    @foreach($gameList as $item)
                                        @if($id == $item->game_ID)
                                            <option value="{{$item->game_ID}}" selected>{{$item->game_name}}</option>
                                        @else
                                            <option value="{{$item->game_ID}}">{{$item->game_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row pt-3" style="height:50px">
                            <a class="col-4 border-bottom-profile-hover text-center active" href="#">
                                <span style="font-size: 16px;color: #F11D72;text-shadow: 0px 0px 6px #F11D72;line-height: 100%">Profile</span>
                            </a>
                            <a class="col-4 border-bottom-profile-menu text-center text-white" href="/achievements">
                                <span style="font-size: 16px;line-height: 100%">Achievements</span>
                            </a>
                            <a class="col-4 border-bottom-profile-menu text-center" href="@if($userProfile->tw_username != "")https://www.twitch.tv/{{$userProfile->tw_username}}@else#@endif">
                                @if($userProfile->tw_username != "")
                                    <span style="font-size: 16px;color: #FF0000;line-height: 100%">LIVE •</span>
                                @else
                                    <span style="font-size: 16px;color: #666666;line-height: 100%">LIVE •</span>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-4">
                <div class="row p-4" style="background-color: rgba(255,255,255,0.1); height: auto; border-radius: 8px">
                    <div class="col-12">
                        <div class="row" style="height: 24px">
                            <p class="text-white label-font-Bold" style="font-size: 14px">CAREER STATS</p>
                        </div>
                        <div class="row ">
                            @if(count($statsPlayer)>0)
                                <div class="col-2 mt-3" style="height: 40px">
                                    <div class="row p-0">
                                        <img id="imgRank" src="{{asset("/data-image/stats_icon/three-stars.svg")}}" height="40px">
                                        <div>
                                            <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                                <h7>RANKING</h7>
                                            </div>
                                            <div class="text-white label-font-Condensed-Bold pl-2" style="font-size: 18px">
                                                <p id="rank_total">{{$statsPlayer->rank_total}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 mt-3" style="height: 40px">
                                    <div class="row p-0">
                                        <img id="imgWon" src="{{asset("/data-image/stats_icon/trophy.svg")}}" height="40px">
                                        <div>
                                            <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                                <h7>GAME WON</h7>
                                            </div>
                                            <div class="text-white label-font-Condensed-Bold pl-2" style="font-size: 18px">
                                                <p id="won_total">{{$statsPlayer->won_total}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 mt-3" style="height: 40px">
                                    <div class="row p-0">
                                        <img id="imgAcc" src="{{asset("/data-image/stats_icon/target.svg")}}" height="40px">
                                        <div>
                                            <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                                <h7 id="labelAcc">ACCURACY</h7>
                                            </div>
                                            <div class="text-white label-font-Condensed-Bold pl-2" style="font-size: 18px">
                                                <p id="accuracy_total">{{$statsPlayer->accuracy_total}} %</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 mt-3" style="height: 40px">
                                    <div class="row p-0">
                                        <img id="imgTime" src="{{asset("/data-image/stats_icon/clock.svg")}}" height="40px">
                                        <div>
                                            <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                                <h7 id="labelTime">TIME PLAYED</h7>
                                            </div>
                                            <div class="text-white label-font-Condensed-Bold pl-2" style="font-size: 18px">
                                                <p id="time_total">{{$statsPlayer->time_total}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 mt-3" style="height: 40px">
                                    <div class="row p-0">
                                        <img id="imgKill" src="{{asset("/data-image/stats_icon/skull.svg")}}" height="40px">
                                        <div>
                                            <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                                <h7 id="labelKill">KILL</h7>
                                            </div>
                                            <div class="text-white label-font-Condensed-Bold pl-2" style="font-size: 18px">
                                                <p id="kill_total">{{$statsPlayer->kill_total}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 mt-3" style="height: 40px">
                                    <div class="row p-0">
                                        <img id="imgHead" src="{{asset("/data-image/stats_icon/headshot.svg")}}" height="40px">
                                        <div>
                                            <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                                <h7 id="labelHead">HEADSHOT ACCURACY</h7>
                                            </div>
                                            <div class="text-white label-font-Condensed-Bold pl-2" style="font-size: 18px">
                                                <p id="headshot_total">{{$statsPlayer->headshot_total}} %</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-2 mt-3" style="height: 40px">
                                    <div class="row p-0">
                                        <img id="imgRank" src="{{asset("/data-image/stats_icon/three-stars.svg")}}" height="40px">
                                        <div>
                                            <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                                <h7>RANKING</h7>
                                            </div>
                                            <div class="text-white label-font-Condensed-Bold pl-2" style="font-size: 18px">
                                                <p id="rank_total">0</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 mt-3" style="height: 40px">
                                    <div class="row p-0">
                                        <img id="imgWon" src="{{asset("/data-image/stats_icon/trophy.svg")}}" height="40px">
                                        <div>
                                            <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                                <h7>GAME WON</h7>
                                            </div>
                                            <div class="text-white label-font-Condensed-Bold pl-2" style="font-size: 18px">
                                                <p id="won_total">0</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 mt-3" style="height: 40px">
                                    <div class="row p-0">
                                        <img id="imgAcc" src="{{asset("/data-image/stats_icon/target.svg")}}" height="40px">
                                        <div>
                                            <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                                <h7 id="labelAcc">ACCURACY</h7>
                                            </div>
                                            <div class="text-white label-font-Condensed-Bold pl-2" style="font-size: 18px">
                                                <p id="accuracy_total">0 %</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 mt-3" style="height: 40px">
                                    <div class="row p-0">
                                        <img id="imgTime" src="{{asset("/data-image/stats_icon/clock.svg")}}" height="40px">
                                        <div>
                                            <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                                <h7 id="labelTime">TIME PLAYED</h7>
                                            </div>
                                            <div class="text-white label-font-Condensed-Bold pl-2" style="font-size: 18px">
                                                <p id="time_total">00:00:00</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 mt-3" style="height: 40px">
                                    <div class="row p-0">
                                        <img id="imgKill" src="{{asset("/data-image/stats_icon/skull.svg")}}" height="40px">
                                        <div>
                                            <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                                <h7 id="labelKill">KILL</h7>
                                            </div>
                                            <div class="text-white label-font-Condensed-Bold pl-2" style="font-size: 18px">
                                                <p id="kill_total">0</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 mt-3" style="height: 40px">
                                    <div class="row p-0">
                                        <img id="imgHead" src="{{asset("/data-image/stats_icon/headshot.svg")}}" height="40px">
                                        <div>
                                            <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                                <h7 id="labelHead">HEADSHOT ACCURACY</h7>
                                            </div>
                                            <div class="text-white label-font-Condensed-Bold pl-2" style="font-size: 18px">
                                                <p id="headshot_total">0 %</p>
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

        <div class="row mt-4 pb-3" style="height: auto;">
            <div class="col-3 pr-4" >
                <div class="row">
                    <div class="col-12 pb-3" style="height: auto; background-color: rgba(255,255,255,0.1); border-radius: 8px">
                        {{--<div class="row" style="border-bottom: 1px #CCCCCC77 solid">--}}
                            {{----}}
                        {{--</div>--}}

                        <ul class="row nav nav-tabs" id="myTab" role="tablist" style="border-bottom: 1px #CCCCCC77 solid">
                            <li class="nav-item w-100 col-6 px-0">
                                <a class="nav-link border-0 member-btn team-active label-font-Light text-white text-center pt-3 active" data-toggle="tab" href="#follower" role="tab" aria-controls="follower" aria-selected="true">
                                    Follower <span>{{count($getFollower)}}</span>
                                </a>
                            </li>

                            <li class="nav-item w-100 col-6 px-0">
                                <a class="nav-link border-0 following-btn team-active label-font-Light text-white text-center pt-3" data-toggle="tab" href="#following" role="tab" aria-controls="following" aria-selected="false">
                                    Following <span>{{count($getFollowing)}}</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content" >
                            <div class="tab-pane fade show active" id="follower" role="tabpanel">
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
                            <div class="tab-pane fade" id="following" role="tabpanel">
                                <div class="row mx-0">
                                    @foreach($getFollowing as $item)
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
                                                    <a class="label-font-Bold text-white" href="profile/{{$item->user_ID}}">
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

    <!-- AddPlayerModal -->
    <div class="modal fade" id="invilteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content" style="background-color: rgba(0,0,0,0.85);">
                <div class="d-flex justify-content-center">
                    <div class="col-12 p-4">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h3 class="text-white label-font-Bold m-0">SELECT GAME</h3>
                                <img data-dismiss="modal" src="{{asset('data-image/cancel.svg')}}" width="18px" height="18px" style="cursor: pointer;position: absolute;right: 7px; top: -11px;">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-center">
                                <h2 class="text-white label-font-Regular" style="font-size: 20px">Pick game for invite</h2>
                            </div>
                        </div>

                        <form action="/profile" method="post">
                            @csrfF
                            <div id="listPlayerModal" class="row">
                                <div class="col-12 px-4" style="overflow-y: auto; height: auto;">
                                    @foreach($gameList as $item)
                                        <div class="row mt-3" style="height: 60px;">
                                            <button class="btn col-12 border-0" name="gameID" value="{{$item->game_ID}}" style=" border-radius: 10px;background-color: rgba(255,255,255,0.15);">
                                                <div class="row align-items-center h-100">
                                                    <div class="col-3">
                                                        <img src="{{$item->game_logo}}" width="50px" height="50px" alt="">
                                                    </div>
                                                    <div class="col-9">
                                                        <h5 class="text-white m-0">{{$item->game_name}}</h5>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <input type="text" name="userInvite" hidden value={{$id}}>
                            <input type="text" name="state" value="1" hidden>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- LINKTW -->
    <div class="modal fade" id="link_tw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="background-color: rgba(0,0,0,0.85);">
                <div class="d-flex justify-content-center">
                    <div class="col-12 p-4">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h3 class="text-white label-font-Bold m-0">LINK YOUR TWITCH</h3>
                                <img data-dismiss="modal" src="{{asset('data-image/cancel.svg')}}" width="18px" height="18px" style="cursor: pointer;position: absolute;right: 7px; top: -11px;">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-center">
                                <h2 class="text-white label-font-Regular" style="font-size: 20px">Enter you twitch account url.</h2>
                            </div>
                        </div>
                        <form action="/profile/{{$id}}" method="post">
                            @csrf
                            @method("PUT")
                            <div class="row mx-0">
                                <button type="submit" name="state" value="link" class="text-center"
                                        style="width: 5%;height: 40px;background-color: #ff425d; padding-top: 8px; border-radius: 20px 0px 0px 20px;border-color: transparent;cursor: pointer">
                                    <i class="fas fa-link text-white"
                                       style="font-size: 16px;position: relative;left: 2px;bottom: 2px;"></i>
                                </button>
                                <input type="text" name="tw_username" placeholder="Your twitch account url. / Example : http://www.twitch.tv/test1234" class="text-input px-3" style="background-color: rgba(255,255,255,0.1);width: 95%;border-radius: 0px 20px 20px 0px;">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- UNLINKTW -->
    <div class="modal fade" id="unlink_tw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content" style="background-color: rgba(0,0,0,0.85);">
                <div class="d-flex justify-content-center">
                    <div class="col-12 p-4">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h3 class="text-white label-font-Bold m-0">UNLINK TWITCH</h3>
                                <img data-dismiss="modal" src="{{asset('data-image/cancel.svg')}}" width="18px" height="18px" style="cursor: pointer;position: absolute;right: 7px; top: -11px;">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-center">
                                <h2 class="text-white label-font-Regular" style="font-size: 20px">Do you want to unlink</h2>
                            </div>
                        </div>
                        <form action="/profile/{{$id}}" method="post">
                            @csrf
                            @method("PUT")
                            <div class="row mx-0">
                                <div class="col-6">
                                    <button type="submit" name="state" value="unlink" class="btn red-btn text-center pt-2">
                                        <i class="fas fa-unlink text-white"
                                           style="font-size: 16px;position: relative;left: 2px;bottom: 2px;"></i>
                                        <label class="ml-1 mb-0 label-font-Condensed-Bold" for="" style="font-size: 18px">UNLINK</label>
                                    </button>
                                </div>

                                <div class="col-6">
                                    <button data-dismiss="modal" class="btn light-btn text-center pt-2">
                                        <label class="mb-0 label-font-Condensed-Bold" for="" style="font-size: 18px">CANCEL</label>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            profileSelectGame({{$id}})
        })
        function profileSelectGame(id) {

            var idGame = document.getElementById('gameSelect').value
            var url = '/getPlayerWithID/'+id+'/game/'+idGame;
            var urlGetGame = '/getGameList/'+idGame;

            // alert(idGame)
            switch (idGame) {
                case "1":
                    // $('#imgRank').src =
                    //     $('#imgRank').src =

                    document.getElementById('imgAcc').src = "/data-image/stats_icon/target.svg"
                    document.getElementById('labelAcc').innerText = "ACCURACY"

                    document.getElementById('imgTime').src = "/data-image/stats_icon/clock.svg"
                    document.getElementById('labelTime').innerText = "TIME PLAYED"

                    document.getElementById('imgKill').src = "/data-image/stats_icon/skull.svg"
                    document.getElementById('labelKill').innerText = "KILL"

                    document.getElementById('imgHead').src = "/data-image/stats_icon/headshot.svg"
                    document.getElementById('labelHead').innerText = "HEADSHOT"

                    document.getElementById('rank_total').innerText = "0"
                    document.getElementById('won_total').innerText = "0"
                    document.getElementById('accuracy_total').innerText = "0 %"
                    document.getElementById('time_total').innerText = "0"
                    document.getElementById('kill_total').innerText = "0"
                    document.getElementById('headshot_total').innerText = "0 %"
                    break;
                case "2":

                    document.getElementById('imgAcc').src = "/data-image/stats_icon/top10.svg"
                    document.getElementById('labelAcc').innerText = "WIN TOP 10"

                    document.getElementById('imgTime').src = "/data-image/stats_icon/dmg.png"
                    document.getElementById('labelTime').innerText = "DAMAGE DEALT"

                    document.getElementById('imgKill').src = "/data-image/stats_icon/skull.svg"
                    document.getElementById('labelKill').innerText = "KILL"

                    document.getElementById('imgHead').src = "/data-image/stats_icon/headshot.svg"
                    document.getElementById('labelHead').innerText = "HEADSHOT TOTAL"

                    document.getElementById('rank_total').innerText = "0"
                    document.getElementById('won_total').innerText = "0"
                    document.getElementById('accuracy_total').innerText = "0"
                    document.getElementById('time_total').innerText = "0"
                    document.getElementById('kill_total').innerText = "0"
                    document.getElementById('headshot_total').innerText = "0"
                    break;
                case "4":
                    document.getElementById('imgAcc').src = "/data-image/stats_icon/loss.svg"
                    document.getElementById('labelAcc').innerText = "GAME LOSS"

                    document.getElementById('imgTime').src = "/data-image/stats_icon/eye.svg"
                    document.getElementById('labelTime').innerText = "PURCHASE WARD"

                    document.getElementById('imgKill').src = "/data-image/stats_icon/skull.svg"
                    document.getElementById('labelKill').innerText = "KILL/DEAD/ASSISTS"

                    document.getElementById('imgHead').src = "/data-image/stats_icon/like.svg"
                    document.getElementById('labelHead').innerText = "FAVORITE HERO"

                    document.getElementById('rank_total').innerText = "0"
                    document.getElementById('won_total').innerText = "0"
                    document.getElementById('accuracy_total').innerText = "0"
                    document.getElementById('time_total').innerText = "0"
                    document.getElementById('kill_total').innerText = "0"
                    document.getElementById('headshot_total').innerText = "Empty"

                    break;
                default:
                    alert('error')
            }

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText != ""){
                        var obj = JSON.parse(this.responseText);
                        console.log(obj,"profileSelectGame")
                        switch (idGame) {
                            case "1":
                                // $('#imgRank').src =
                                //     $('#imgRank').src =
                                document.getElementById('rank_total').innerText = obj['rank_total']
                                document.getElementById('won_total').innerText = obj['won_total']
                                document.getElementById('accuracy_total').innerText = obj['accuracy_total']+" %"
                                document.getElementById('time_total').innerText = obj['time_total']
                                document.getElementById('kill_total').innerText = obj['kill_total']
                                document.getElementById('headshot_total').innerText = obj['headshot_total']+" %"
                                break;
                            case "2":
                                document.getElementById('rank_total').innerText = obj['rank_total']
                                document.getElementById('won_total').innerText = obj['won_total']
                                document.getElementById('accuracy_total').innerText = obj['topten']
                                document.getElementById('time_total').innerText = obj['dmgDealt']
                                document.getElementById('kill_total').innerText = obj['kill_total']
                                document.getElementById('headshot_total').innerText = obj['headshot_total']
                                break;
                            case "4":
                                document.getElementById('rank_total').innerText = obj['rank_total']
                                document.getElementById('won_total').innerText = obj['won_total']
                                document.getElementById('accuracy_total').innerText = obj['loss_total']
                                document.getElementById('time_total').innerText = obj['ward_sentry']
                                document.getElementById('kill_total').innerText = obj['kill_total']+"/"+obj['death_total']+"/"+obj['assists_total']
                                document.getElementById('headshot_total').innerText = obj['favoriteHero']
                                break;
                            default:
                                alert('error')
                        }

                    }
                }
            };

            xhttp.open("GET", url, true);
            xhttp.send();

            var getGame = new XMLHttpRequest();
            getGame.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var obj = JSON.parse(this.responseText);

                    document.getElementById('logoGame').src = obj['game_logo'];
                }
            };

            getGame.open("GET", urlGetGame, true);
            getGame.send();
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