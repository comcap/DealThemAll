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
                                <select name="game" id="gameSelect" style="font-size: 24px" class="pl-3 select-game label-font-Bold" onchange="profileSelectGame()">
                                    @foreach($gameList as $item)
                                        @if($item->game_ID != 4){
                                            @if($id == $item->game_ID)
                                                <option value="{{$item->game_ID}}" selected>{{$item->game_name}}</option>
                                            @else
                                                <option value="{{$item->game_ID}}">{{$item->game_name}}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row pt-3" style="height:50px">
                            <a class="col-4 border-bottom-profile-menu text-center text-white" href="#">
                                <span style="font-size: 16px;line-height: 100%">Profile</span>
                            </a>
                            <a class="col-4 border-bottom-profile-hover text-center active" href="/achievements">
                                <span style="font-size: 16px;color: #F11D72;text-shadow: 0px 0px 6px #F11D72;line-height: 100%">Achievements</span>
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
        <div id="boxAchievement1" class="row" style="margin-bottom: 80px">
            @foreach($getOverWatch as $item)
                @include('includes.boxOWachievement')
            @endforeach
        </div>
        <div id="boxAchievement2" class="row d-none" style="margin-bottom: 80px">
            @foreach($getPubg as $item)
                @include('includes.boxAchievement')
            @endforeach
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
        function profileSelectGame() {
            var idGame = document.getElementById('gameSelect').value

            switch (idGame) {
                case "1":
                    $('#boxAchievement1').addClass('d-flex');
                    $('#boxAchievement1').removeClass('d-none');

                    $('#boxAchievement2').removeClass('d-flex');
                    $('#boxAchievement3').removeClass('d-flex');
                    $('#boxAchievement2').addClass('d-none');
                    $('#boxAchievement3').addClass('d-none');
                    break;
                case "2":
                    $('#boxAchievement2').addClass('d-flex');
                    $('#boxAchievement2').removeClass('d-none');

                    $('#boxAchievement1').removeClass('d-flex');
                    $('#boxAchievement3').removeClass('d-flex');
                    $('#boxAchievement1').addClass('d-none');
                    $('#boxAchievement3').addClass('d-none');
                    break;
                case "4":
                    // $('#boxAchievement3').addClass('d-block');
                    // $('#boxAchievement3').removeClass('d-none');
                    //
                    // $('#boxAchievement2').removeClass('d-block');
                    // $('#boxAchievement1').removeClass('d-block');
                    // $('#boxAchievement2').addClass('d-none');
                    // $('#boxAchievement1').addClass('d-none');
                    break;
                default:
                    alert('error')
            }
        }

    </script>
@stop