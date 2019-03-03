@extends('layouts.sidebar')
@section('content')
    <div id="box-item" class="container-fluid supreme-container">
        <div class="row pt-2">
            <div class="col-9 p-2">
                {{--------------------------curent content--------------------------}}
                <div class="row mx-0">

                    <div class="col-12">
                        <div class="row " style="height: auto; border-radius: 8px;background-color: rgba(255,255,255,0.1);">
                            <div class="col-12 pl-4 pt-3 pb-2 border-bottom border-secondary">
                                <h4 class="label-font-Regular text-white">Recent</h4>
                            </div>
                            <div class="col-12 py-3">
                                <div class="row">
                                    {{--@for($i=0;$i<3;$i++)--}}
                                        {{--<div class="col-12">--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col-8 py-2 px-4 ">--}}
                                                {{--<div class="row mx-0 align-items-center">--}}
                                                    {{--<img src="https://dummyimage.com/60x60/000/fff" style="border-radius: 30px">--}}
                                                    {{--<div>--}}
                                                        {{--<h3 class="label-font-Bold text-white ml-3 mb-0" style="font-size: 16px">test--}}
                                                            {{--<span class="label-font-Condensed-Regular" style="color: #AAAAAA">played a Playerunknown’s Battlegrounds.</span>--}}
                                                        {{--</h3>--}}
                                                        {{--<span class="label-font-Condensed-Thin ml-3" style="color: #999999;font-size: 12px">2018-03-06 02:30</span>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-4 py-2 px-0 pt-3">--}}
                                                {{--<div class="row mx-0">--}}
                                                    {{--<div class="col-6">--}}
                                                        {{--<button class="btn red-btn">ACCEPT</button>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-6">--}}
                                                        {{--<button class="btn light-btn">DECLINE</button>--}}
                                                    {{--</div>--}}

                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--@endfor--}}

                                    @foreach($notication as $item)
                                        <div class="col-12">
                                                <div class="row">
                                                    <div class="col-1 px-4">
                                                        <a href="profile/{{$item->user_ID}}"><img src="{{asset('/data-image/userImage/'.$item->user_image)}}" width="60px" height="60px" style="border-radius: 30px"></a>
                                                    </div>
                                                    <div class="col-7 py-2 px-4 ">
                                                        <div class="row mx-0">
                                                            <div class="col p-0">
                                                                <div class="row align-items-center">
                                                                    <a href="profile/{{$item->user_ID}}"><h3 class="text-white label-font-Bold ml-3 mb-0" style="font-size: 16px">{{$item->user_name}}</h3></a>
                                                                    <span class="label-font-Condensed-Regular mx-1" style="color: #AAAAAA">{{$item->typeDetail}}</span>
                                                                    <a href="team/{{$item->teamID}}"><span class="label-font-Bold" style="color: #eeeeee;">{{$item->team_name}}</span></a>
                                                                </div>
                                                                <div class="row">
                                                                    <span class="label-font-Condensed-Thin ml-3" style="color: #999999;font-size: 12px">{{$item->created_at}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 py-2 px-0 pt-3">
                                                        <div class="row mx-0">
                                                            <div class="col-6">
                                                                <button class="btn red-btn">ACCEPT</button>
                                                            </div>
                                                            <div class="col-6">
                                                                <button class="btn light-btn">DECLINE</button>
                                                            </div>

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
                {{--------------------------endcurent content--------------------------}}

                {{--------------------------content--------------------------}}
                <div class="row mx-0 mt-4">
                    <div class="col-12">
                        <div class="row" style="height: auto; border-radius: 8px;background-color: rgba(255,255,255,0.1);">
                            <div class="col-12 pl-4 pt-3 pb-2 border-bottom border-secondary">
                                <h4 class="label-font-Regular text-white">Earlier</h4>
                            </div>
                            <div class="col-12 py-3">
                                <div class="row">
                                    @for($i=0;$i<6;$i++)
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-8 py-2 px-4 ">
                                                    <div class="row mx-0 align-items-center">
                                                        <img src="https://dummyimage.com/60x60/000/fff" style="border-radius: 30px">
                                                        <div>
                                                            <h3 class="label-font-Bold text-white ml-3 mb-0" style="font-size: 16px">test
                                                                <span class="label-font-Condensed-Regular" style="color: #AAAAAA">played a Playerunknown’s Battlegrounds.</span>
                                                            </h3>
                                                            <span class="label-font-Condensed-Thin ml-3" style="color: #999999;font-size: 12px">2018-03-06 02:30</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4 py-2 px-0 pt-3">
                                                    <div class="row mx-0">
                                                        <div class="col-6">
                                                            <button class="btn red-btn">ACCEPT</button>
                                                        </div>
                                                        <div class="col-6">
                                                            <button class="btn light-btn">DECLINE</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--------------------------content--------------------------}}

            </div>
            <div class="col-3 p-2 ">
                @if(\Illuminate\Support\Facades\Auth::User())
                    <div class="row mx-0">
                        <div class="col-12 pl-3 pr-3 pt-3" style="background-color: rgba(255,255,255,0.1); height: auto;border-radius: 8px">
                            <div class="row" style="height: 60px">
                                <div class="col-3">
                                    <a href="profile/">
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
                                                <h3 class="text-white label-font-Thin mb-0" style="font-size: 40px">12</h3>
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
                    <div class="row mt-3 mx-0">
                        <div class="col-12 pl-3 pr-3 pt-3 pb-4" style="background-color: rgba(255,255,255,0.1); height: auto;border-radius: 8px">
                            <div class="row " style="height: auto">
                                <div class="col-6">
                                    <span class="text-white label-font-Regular">Achievements</span>
                                </div>
                                <div class="col-6 text-right">
                                    <span class="label-font-Light" style="font-size: 12px;color: #AAAAAA">see more</span>
                                </div>
                            </div>
                            <div class="row mt-3" style="height: auto;">
                                <div class="col-3">
                                    <img src="{{asset('/data-image/achievements/Image-60.svg')}}" width="64px" height="64px">
                                </div>
                                <div class="col-9 pt-1">
                                    <div class="row mx-0">
                                        <h5 class="text-white label-font-Bold mb-1" style="font-size: 14px">Blackjack</h5>
                                    </div>
                                    <div class="row mr-0">
                                        <div class="col-8" style="padding-top: 2px">
                                            <p class="label-font-Thin threeDot mb-0" style="color:#B5DEFF;font-size: 12px;height: auto">Earn 21 postgame cards in quick or competitive play.</p>
                                        </div>
                                        <div class="col-4 p-0 text-right">
                                            <span class="text-white label-font-Thin " style="font-size: 12px">100 / 100%</span>
                                        </div>
                                    </div>
                                    <div class="row mx-0 pt-2">
                                        <div id="myProgress1">
                                            <div id="myBar1" data-progress-id="1"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3" style="height: auto;">
                                <div class="col-3">
                                    <img src="{{asset('/data-image/achievements/Image-60.svg')}}" width="64px" height="64px">
                                </div>
                                <div class="col-9 pt-1">
                                    <div class="row mx-0">
                                        <h5 class="text-white label-font-Bold mb-1" style="font-size: 14px">Blackjack</h5>
                                    </div>
                                    <div class="row mr-0">
                                        <div class="col-8" style="padding-top: 2px">
                                            <p class="label-font-Thin threeDot mb-0" style="color:#B5DEFF;font-size: 12px;height: auto">Earn 21 postgame cards in quick or competitive play.</p>
                                        </div>
                                        <div class="col-4 p-0 text-right">
                                            <span class="text-white label-font-Thin " style="font-size: 12px">100 / 100%</span>
                                        </div>
                                    </div>
                                    <div class="row mx-0 pt-2">
                                        <div id="myProgress2">
                                            <div id="myBar2" data-progress-id="2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3" style="height: auto;">
                                <div class="col-3">
                                    <img src="{{asset('/data-image/achievements/Image-60.svg')}}" width="64px" height="64px">
                                </div>
                                <div class="col-9 pt-1">
                                    <div class="row mx-0">
                                        <h5 class="text-white label-font-Bold mb-1" style="font-size: 14px">Blackjack</h5>
                                    </div>
                                    <div class="row mr-0">
                                        <div class="col-8" style="padding-top: 2px">
                                            <p class="label-font-Thin threeDot mb-0" style="color:#B5DEFF;font-size: 12px;height: auto">Earn 21 postgame cards in quick or competitive play.</p>
                                        </div>
                                        <div class="col-4 p-0 text-right">
                                            <span class="text-white label-font-Thin " style="font-size: 12px">100 / 100%</span>
                                        </div>
                                    </div>
                                    <div class="row mx-0 pt-2">
                                        <div id="myProgress3">
                                            <div id="myBar3" data-progress-id="2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3" style="height: auto;">
                                <div class="col-3">
                                    <img src="{{asset('/data-image/achievements/Image-60.svg')}}" width="64px" height="64px">
                                </div>
                                <div class="col-9 pt-1">
                                    <div class="row mx-0">
                                        <h5 class="text-white label-font-Bold mb-1" style="font-size: 14px">Blackjack</h5>
                                    </div>
                                    <div class="row mr-0">
                                        <div class="col-8" style="padding-top: 2px">
                                            <p class="label-font-Thin threeDot mb-0" style="color:#B5DEFF;font-size: 12px;height: auto">Earn 21 postgame cards in quick or competitive play.</p>
                                        </div>
                                        <div class="col-4 p-0 text-right">
                                            <span class="text-white label-font-Thin " style="font-size: 12px">100 / 100%</span>
                                        </div>
                                    </div>
                                    <div class="row mx-0 pt-2">
                                        <div id="myProgress4">
                                            <div id="myBar4" data-progress-id="3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--<button onclick="move()" class="btn btn-primary red-btn" >Move</button>--}}

                        </div>
                    </div>
                    {{--banner sponsor--}}
                    <div class="row mt-3 mx-0">
                        <div class="col">
                            <div class="row mx-0" style="height:180px;">
                                <img class="col-12 p-0" src="{{asset('/data-image/null-ads.png') }}" alt="overwatch">
                            </div>
                            <div class="row mt-3">
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
                @else
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

                                <button type="submit" class="btn btn-primary red-btn" >LOGIN</button>
                            </form>
                            {{--<a href="/register"><button class="light-btn mt-3">SIGN UP</button></a>--}}
                            <button class="light-btn mt-3" data-toggle="modal" data-target="#exampleModal">SIGN UP</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-color: rgba(255,255,255,0.1);">
                <div class="d-flex justify-content-center">
                    <form action="/ApiRegister" method="post" class="col-12 pt-3" style=" height: 100%;">
                        @csrf
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
                        <div class="row d-flex justify-content-center pt-3">
                            <button type="submit" class="btn btn-primary red-btn col-6 mr-4 mb-5">Sign up</button>
                            <button type="reset" class="btn btn-secondary light-btn col-4 ml-4">Reset</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            move()
        })
        function move() {
            var value1 = 100
            var value2 = 30
            var value3 = 40
            var value4 = 100

            var elem1 = document.getElementById("myBar1");
            var elem2 = document.getElementById("myBar2");
            var elem3 = document.getElementById("myBar3");
            var elem4 = document.getElementById("myBar4");

            var width = 1;

            var id1 = setInterval(frame1, 10);
            var id2 = setInterval(frame2, 10);
            var id3 = setInterval(frame3, 10);
            var id4 = setInterval(frame4, 10);

            function frame1() {
                if (width >= value1) {
                    clearInterval(id1);
                } else {
                    width++;
                    elem1.style.width = width + '%';
                }
            }
            function frame2() {
                if (width >= value2) {
                    clearInterval(id2);
                } else {
                    width++;
                    elem2.style.width = width + '%';
                }
            }
            function frame3() {
                if (width >= value3) {
                    clearInterval(id3);
                } else {
                    width++;
                    elem3.style.width = width + '%';
                }
            }
            function frame4() {
                if (width >= value4) {
                    clearInterval(id4);
                } else {
                    width++;
                    elem4.style.width = width + '%';
                }
            }
        }
    </script>
@stop