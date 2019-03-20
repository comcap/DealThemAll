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
                            <a class="col-4 border-bottom-profile-menu text-center text-white" href="#">
                                <span style="font-size: 16px;line-height: 100%">Achievements</span>
                            </a>
                            <a class="col-4 border-bottom-profile-menu text-center" href="#">
                                <span style="font-size: 16px;color: #FF0000;line-height: 100%">LIVE •</span>
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
                                        <img src="{{asset("/data-image/stats_icon/three-stars.svg")}}" height="40px">
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
                                        <img src="{{asset("/data-image/stats_icon/trophy.svg")}}" height="40px">
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
                                        <img src="{{asset("/data-image/stats_icon/target.svg")}}" height="40px">
                                        <div>
                                            <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                                <h7>ACCURACY</h7>
                                            </div>
                                            <div class="text-white label-font-Condensed-Bold pl-2" style="font-size: 18px">
                                                <p id="accuracy_total">{{$statsPlayer->accuracy_total}} %</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 mt-3" style="height: 40px">
                                    <div class="row p-0">
                                        <img src="{{asset("/data-image/stats_icon/clock.svg")}}" height="40px">
                                        <div>
                                            <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                                <h7>TIME PLAYED</h7>
                                            </div>
                                            <div class="text-white label-font-Condensed-Bold pl-2" style="font-size: 18px">
                                                <p id="time_total">{{$statsPlayer->time_total}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 mt-3" style="height: 40px">
                                    <div class="row p-0">
                                        <img src="{{asset("/data-image/stats_icon/skull.svg")}}" height="40px">
                                        <div>
                                            <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                                <h7>KILL</h7>
                                            </div>
                                            <div class="text-white label-font-Condensed-Bold pl-2" style="font-size: 18px">
                                                <p id="kill_total">{{$statsPlayer->kill_total}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 mt-3" style="height: 40px">
                                    <div class="row p-0">
                                        <img src="{{asset("/data-image/stats_icon/headshot.svg")}}" height="40px">
                                        <div>
                                            <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                                <h7>HEADSHOT ACCURACY</h7>
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
                                        <img src="{{asset("/data-image/stats_icon/three-stars.svg")}}" height="40px">
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
                                        <img src="{{asset("/data-image/stats_icon/trophy.svg")}}" height="40px">
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
                                        <img src="{{asset("/data-image/stats_icon/target.svg")}}" height="40px">
                                        <div>
                                            <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                                <h7>ACCURACY</h7>
                                            </div>
                                            <div class="text-white label-font-Condensed-Bold pl-2" style="font-size: 18px">
                                                <p id="accuracy_total">0 %</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 mt-3" style="height: 40px">
                                    <div class="row p-0">
                                        <img src="{{asset("/data-image/stats_icon/clock.svg")}}" height="40px">
                                        <div>
                                            <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                                <h7>TIME PLAYED</h7>
                                            </div>
                                            <div class="text-white label-font-Condensed-Bold pl-2" style="font-size: 18px">
                                                <p id="time_total">00:00:00</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 mt-3" style="height: 40px">
                                    <div class="row p-0">
                                        <img src="{{asset("/data-image/stats_icon/skull.svg")}}" height="40px">
                                        <div>
                                            <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                                <h7>KILL</h7>
                                            </div>
                                            <div class="text-white label-font-Condensed-Bold pl-2" style="font-size: 18px">
                                                <p id="kill_total">0</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 mt-3" style="height: 40px">
                                    <div class="row p-0">
                                        <img src="{{asset("/data-image/stats_icon/headshot.svg")}}" height="40px">
                                        <div>
                                            <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                                <h7>HEADSHOT ACCURACY</h7>
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
                        <div class="row" style="border-bottom: 1px #CCCCCC77 solid">
                            <button class="col-6 member-btn team-active label-font-Light">Follower <span>6</span></button>
                            <button class="col-6 following-btn label-font-Light">Following <span>231</span></button>
                        </div>
                        <div class="row mx-0">
                            <div class="col-12 pt-4 px-3" style="height: auto;">
                                <div class="row" style="height: 60px;">
                                    <div class="col-3 px-0">
                                        <a href="#" >
                                            <img src="https://dummyimage.com/60x60/000/fff" width="60px" height="60px" style="border-radius: 30px">
                                        </a>
                                    </div>
                                    <div class="col-9 pt-1">
                                        <div class="row">
                                            <div class="col-12">
                                                <a href="#" >
                                                    <h3 class="label-font-Bold text-white" style="font-size: 16px">Simple Name</h3>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row px-3">
                                            <div class="box-role mr-2" >
                                                <label class="text-white">test</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 pt-4 px-3" style="height: auto;">
                                <div class="row" style="height: 60px;">
                                    <div class="col-3 px-0">
                                        <a href="#" >
                                            <img src="https://dummyimage.com/60x60/000/fff" width="60px" height="60px" style="border-radius: 30px">
                                        </a>
                                    </div>
                                    <div class="col-9 pt-1">
                                        <div class="row">
                                            <div class="col-12">
                                                <a href="#" >
                                                    <h3 class="label-font-Bold text-white" style="font-size: 16px">Simple Name</h3>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row px-3">
                                            <div class="box-role mr-2" >
                                                <label class="text-white">test</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 pt-4 px-3" style="height: auto;">
                                <div class="row" style="height: 60px;">
                                    <div class="col-3 px-0">
                                        <a href="#" >
                                            <img src="https://dummyimage.com/60x60/000/fff" width="60px" height="60px" style="border-radius: 30px">
                                        </a>
                                    </div>
                                    <div class="col-9 pt-1">
                                        <div class="row">
                                            <div class="col-12">
                                                <a href="#" >
                                                    <h3 class="label-font-Bold text-white" style="font-size: 16px">Simple Name</h3>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row px-3">
                                            <div class="box-role mr-2" >
                                                <label class="text-white">test</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 pt-4 px-3" style="height: auto;">
                                <div class="row" style="height: 60px;">
                                    <div class="col-3 px-0">
                                        <a href="#" >
                                            <img src="https://dummyimage.com/60x60/000/fff" width="60px" height="60px" style="border-radius: 30px">
                                        </a>
                                    </div>
                                    <div class="col-9 pt-1">
                                        <div class="row">
                                            <div class="col-12">
                                                <a href="#" >
                                                    <h3 class="label-font-Bold text-white" style="font-size: 16px">Simple Name</h3>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row px-3">
                                            <div class="box-role mr-2" >
                                                <label class="text-white">test</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 pt-4 px-3" style="height: auto;">
                                <div class="row" style="height: 60px;">
                                    <div class="col-3 px-0">
                                        <a href="#" >
                                            <img src="https://dummyimage.com/60x60/000/fff" width="60px" height="60px" style="border-radius: 30px">
                                        </a>
                                    </div>
                                    <div class="col-9 pt-1">
                                        <div class="row">
                                            <div class="col-12">
                                                <a href="#" >
                                                    <h3 class="label-font-Bold text-white" style="font-size: 16px">Simple Name</h3>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row px-3">
                                            <div class="box-role mr-2" >
                                                <label class="text-white">test</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 pt-4 px-3" style="height: auto;">
                                <div class="row" style="height: 60px;">
                                    <div class="col-3 px-0">
                                        <a href="#" >
                                            <img src="https://dummyimage.com/60x60/000/fff" width="60px" height="60px" style="border-radius: 30px">
                                        </a>
                                    </div>
                                    <div class="col-9 pt-1">
                                        <div class="row">
                                            <div class="col-12">
                                                <a href="#" >
                                                    <h3 class="label-font-Bold text-white" style="font-size: 16px">Simple Name</h3>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row px-3">
                                            <div class="box-role mr-2" >
                                                <label class="text-white">test</label>
                                            </div>
                                        </div>
                                    </div>
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
                                            <a href="profile/{{$item->user_ID}}">
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
                                                            <div class="">
                                                                <img src="{{asset('/data-image/like.svg') }}" width="auto" height="40px">
                                                                <span class="text-pink">609</span>
                                                            </div>
                                                            <div class="ml-4">
                                                                <img src="{{asset('/data-image/comment.svg')}}" width="auto" height="40px">
                                                                <span class="text-pink">609</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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

            {{--<div class="col-9 pl-4">--}}
                {{--<div class="row" style="height: auto; border-radius: 8px;background-color: rgba(255,255,255,0.1);">--}}
                    {{--<div class="col-12 p-4 mb-3">--}}
                        {{--<div class="row mx-0 align-items-center">--}}
                            {{--<img src="https://dummyimage.com/60x60/000/fff" style="border-radius: 30px">--}}
                            {{--<div>--}}
                                {{--<h3 class="label-font-Bold text-white ml-3 mb-0" style="font-size: 16px">xLapisLazulix--}}
                                    {{--<span class="label-font-Condensed-Regular" style="color: #AAAAAA">played a Playerunknown’s Battlegrounds.</span>--}}
                                {{--</h3>--}}
                                {{--<span class="label-font-Condensed-Thin ml-3" style="color: #999999;font-size: 12px">2018-03-06 02:30</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="row mt-4 mx-0">--}}
                            {{--<p class="text-white label-font-Condensed-Regular" style="font-size: 14px">ผลไม้ บอยคอต แม็กกาซีนกราวนด์ปาสกาลบู๊พล็อต มวลชนสติ๊กเกอร์วืดรีสอร์ตนิวส์ พรีเซ็นเตอร์สไตล์อิออนดีมานด์ดาวน์ มาร์ชราชบัณฑิตยสถานสตาร์ คอร์รัปชั่น เรซินอุรังคธาตุลิมูซีนฟลุก วานิลา ชนะเลิศ ซานตาคลอสระโงกไทเฮาเซ็กส์ซีน โฮมศิรินทร์ภควัมปติ คาร์โก้ เซาท์โยเกิร์ตแพนดา จอหงวนสลัม แคป--}}

                            {{--</p>--}}
                        {{--</div>--}}

                        {{--<div class="row mt-4 mx-0 bg-secondary" style="height: 400px"></div>--}}

                        {{--<div class="row mt-4 mx-0">--}}
                            {{--<div class="col-6">--}}
                                {{--<div class="row align-items-center">--}}
                                    {{--<img src="https://dummyimage.com/40x40/000/fff">--}}
                                    {{--<h3 class="label-font-Light ml-3 mb-0" style="font-size: 16px;color: #AAAAAA">Playerunknown’s Battlegrounds</h3>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-6">--}}
                                {{--<div class="row mx-0">--}}
                                    {{--<div class="offset-6"></div>--}}
                                    {{--<div class="col-6">--}}
                                        {{--<div class="row align-items-center justify-content-end" style="height: 40px">--}}
                                            {{--<div class="row align-items-center justify-content-end" style="height: 40px">--}}
                                                {{--<div class="">--}}
                                                    {{--<img src="{{asset('/data-image/like.svg') }}" width="auto" height="40px">--}}
                                                    {{--<span class="text-pink">609</span>--}}
                                                {{--</div>--}}
                                                {{--<div class="ml-4">--}}
                                                    {{--<img src="{{asset('/data-image/comment.svg')}}" width="auto" height="40px">--}}
                                                    {{--<span class="text-pink">609</span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
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
                            <div class="col-12 text-center mb-2">
                                <h2 class="text-white label-font-Regular" style="font-size: 20px">Pick game for invite</h2>
                            </div>
                        </div>

                        <form action="/team" method="post">
                            @csrf
                            <div id="listPlayerModal" class="row">
                                <div class="col-12 px-4" style="overflow-y: auto; height: 230px;">
                                    <div class="row" style="height: 60px;">
                                        <div class="col-12" style=" border-radius: 10px;background-color: rgba(255,255,255,0.15);">
                                            <div class="row">
                                                <div class="col-3">
                                                    <img src="https://dummyimage.com/50x50/000/fff" alt="">
                                                </div>
                                                <div class="col-9">
                                                    <p class="text-white">Lorem ipsum dolor sit amet, </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci architecto blanditiis culpa eligendi, et, ex excepturi facilis illo, illum in ipsum iste nisi possimus quae ratione sint sit suscipit tenetur!</p>
                                    </div>
                                    <div class="row">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci architecto blanditiis culpa eligendi, et, ex excepturi facilis illo, illum in ipsum iste nisi possimus quae ratione sint sit suscipit tenetur!</p>
                                    </div>
                                    <div class="row">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci architecto blanditiis culpa eligendi, et, ex excepturi facilis illo, illum in ipsum iste nisi possimus quae ratione sint sit suscipit tenetur!</p>
                                    </div>
                                    <div class="row">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci architecto blanditiis culpa eligendi, et, ex excepturi facilis illo, illum in ipsum iste nisi possimus quae ratione sint sit suscipit tenetur!</p>
                                    </div>
                                    <div class="row">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci architecto blanditiis culpa eligendi, et, ex excepturi facilis illo, illum in ipsum iste nisi possimus quae ratione sint sit suscipit tenetur!</p>
                                    </div>
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

            console.log(url)

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText != ""){
                        var obj = JSON.parse(this.responseText);

                        document.getElementById('rank_total').innerText = obj['rank_total']
                        document.getElementById('won_total').innerText = obj['won_total']
                        document.getElementById('accuracy_total').innerText = obj['accuracy_total']+" %"
                        document.getElementById('time_total').innerText = obj['time_total']
                        document.getElementById('kill_total').innerText = obj['kill_total']
                        document.getElementById('headshot_total').innerText = obj['headshot_total']+" %"
                    } else{

                        document.getElementById('rank_total').innerText = "0"
                        document.getElementById('won_total').innerText = "0"
                        document.getElementById('accuracy_total').innerText = "0 %"
                        document.getElementById('time_total').innerText = "0"
                        document.getElementById('kill_total').innerText = "0"
                        document.getElementById('headshot_total').innerText = "0 %"
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
    </script>
@stop