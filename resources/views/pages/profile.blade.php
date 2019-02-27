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
                                <select name="game" id="gameSelect" style="font-size: 24px" class="pl-3 select-game label-font-Bold" onchange="profileSelectGame({{\Illuminate\Support\Facades\Auth::user()->user_ID}})">
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
                <div class="row" style="height: auto; border-radius: 8px;background-color: rgba(255,255,255,0.1);">
                    <div class="col-12 p-4 mb-3">
                        <div class="row mx-0 align-items-center">
                            <img src="https://dummyimage.com/60x60/000/fff" style="border-radius: 30px">
                            <div>
                                <h3 class="label-font-Bold text-white ml-3 mb-0" style="font-size: 16px">xLapisLazulix
                                    <span class="label-font-Condensed-Regular" style="color: #AAAAAA">played a Playerunknown’s Battlegrounds.</span>
                                </h3>
                                <span class="label-font-Condensed-Thin ml-3" style="color: #999999;font-size: 12px">2018-03-06 02:30</span>
                            </div>
                        </div>
                        <div class="row mt-4 mx-0">
                            <p class="text-white label-font-Condensed-Regular" style="font-size: 14px">ผลไม้ บอยคอต แม็กกาซีนกราวนด์ปาสกาลบู๊พล็อต มวลชนสติ๊กเกอร์วืดรีสอร์ตนิวส์ พรีเซ็นเตอร์สไตล์อิออนดีมานด์ดาวน์ มาร์ชราชบัณฑิตยสถานสตาร์ คอร์รัปชั่น เรซินอุรังคธาตุลิมูซีนฟลุก วานิลา ชนะเลิศ ซานตาคลอสระโงกไทเฮาเซ็กส์ซีน โฮมศิรินทร์ภควัมปติ คาร์โก้ เซาท์โยเกิร์ตแพนดา จอหงวนสลัม แคป

                            </p>
                        </div>

                        <div class="row mt-4 mx-0 bg-secondary" style="height: 400px"></div>

                        <div class="row mt-4 mx-0">
                            <div class="col-6">
                                <div class="row align-items-center">
                                    <img src="https://dummyimage.com/40x40/000/fff">
                                    <h3 class="label-font-Light ml-3 mb-0" style="font-size: 16px;color: #AAAAAA">Playerunknown’s Battlegrounds</h3>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row mx-0">
                                    <div class="offset-6"></div>
                                    <div class="col-6">
                                        <div class="row align-items-center justify-content-end" style="height: 40px">
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
            </div>
        </div>
    </div>

    <script>
        function profileSelectGame(id) {

            var idGame = document.getElementById('gameSelect').value
            var url = '/getPlayerWithID/'+id+'/game/'+idGame;
            var urlGetGame = '/getGameList/'+idGame;

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