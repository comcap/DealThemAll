@extends('layouts.sidebar')
@section('content')
    <div id="box-item" class="container-fluid mt-2">
        <div class="row mt-2">
            <div class="col-12 p-2">
                <form action="/ApiCreateTeam" method="POST" enctype="multipart/form-data" onsubmit="return checkIsready()">
                    @csrf
                    <div class="row p-2 py-4"
                         style="background-color: rgba(255,255,255,0.1);  border-radius: 8px">
                        <div class="col-3" style="height: 100%;flex-direction: column">
                            <p class="text-white label-font-Bold">Create Team</p>
                            <div class="row">
                                <div class="col-4">
                                    <div class="">
                                        <div style="background-color: rgba(0,0,0,0.25); width: 200px;height: 200px;">
                                            <img id="imagePreview" src="{{asset("/data-image/nullTeam.svg")}}" height="200" width="200" style="cursor: pointer" onclick="document.getElementById('file').click();">
                                            <input onchange="previewFile()" type="file" style="display:none;" id="file" name="file" accept="image/*" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--<div class="offset-1"></div>--}}
                        <div class="col-8">
                            <div class="row">
                                <div class="col-6">
                                    <p class="text-input-label">Name Team</p>
                                    <div class="form-group mt-2">
                                        <input type="text" name="nameTeam" placeholder="Example" class="text-input pl-3" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <p class="text-input-label pl-0">Practice time</p>
                                    <div class="form-group mt-2">
                                        <div class="row px-3">
                                            <select name="timeStart" id="game" class="text-select pl-3 col-5" style="height: 40px" required>
                                                <option value="" selected disabled>Select time</option>
                                                <option value="00:00">00:00</option>
                                                <option value="01:00">01:00</option>
                                                <option value="02:00">02:00</option>
                                                <option value="03:00">03:00</option>
                                                <option value="04:00">04:00</option>
                                                <option value="05:00">05:00</option>
                                                <option value="06:00">06:00</option>
                                                <option value="07:00">07:00</option>
                                                <option value="08:00">08:00</option>
                                                <option value="09:00">09:00</option>
                                                <option value="10:00">10:00</option>
                                                <option value="11:00">11:00</option>
                                                <option value="12:00">12:00</option>
                                                <option value="13:00">13:00</option>
                                                <option value="14:00">14:00</option>
                                                <option value="15:00">15:00</option>
                                                <option value="16:00">16:00</option>
                                                <option value="17:00">17:00</option>
                                                <option value="18:00">18:00</option>
                                                <option value="19:00">19:00</option>
                                                <option value="20:00">20:00</option>
                                                <option value="21:00">21:00</option>
                                                <option value="22:00">22:00</option>
                                                <option value="23:00">23:00</option>
                                            </select>
                                            <p class="col-2 text-center label-font-Bold text-white pt-2">To</p>
                                            <select name="timeEnd" id="game" class="text-select pl-3 col-5" style="height: 40px" required>
                                                <option value="" selected disabled>Select time</option>
                                                <option value="00:00">00:00</option>
                                                <option value="01:00">01:00</option>
                                                <option value="02:00">02:00</option>
                                                <option value="03:00">03:00</option>
                                                <option value="04:00">04:00</option>
                                                <option value="05:00">05:00</option>
                                                <option value="06:00">06:00</option>
                                                <option value="07:00">07:00</option>
                                                <option value="08:00">08:00</option>
                                                <option value="09:00">09:00</option>
                                                <option value="10:00">10:00</option>
                                                <option value="11:00">11:00</option>
                                                <option value="12:00">12:00</option>
                                                <option value="13:00">13:00</option>
                                                <option value="14:00">14:00</option>
                                                <option value="15:00">15:00</option>
                                                <option value="16:00">16:00</option>
                                                <option value="17:00">17:00</option>
                                                <option value="18:00">18:00</option>
                                                <option value="19:00">19:00</option>
                                                <option value="20:00">20:00</option>
                                                <option value="21:00">21:00</option>
                                                <option value="22:00">22:00</option>
                                                <option value="23:00">23:00</option>
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
                                        <select name="language1" id="game" class="text-select pl-3" style="height: 40px" required>
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
                                        <select name="language2" id="game" class="text-select pl-3" style="height: 40px">
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
                                        <select name="language3" id="game" class="text-select pl-3" style="height: 40px">
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
                    </div>

                    <div class="row border-bottom">
                        <div class="col-12 mt-3 ">
                            <div class="row mb-0 align-items-end">
                                <div class="col-10 p-0" style="height:50px">
                                    <div class="row">
                                        <img class="pl-3" id="gameLogo" src="{{asset('data-image/game_logo/overwatch/logo.svg')}}" height="40px">
                                        <div class="col-5 pl-0">
                                            <select class="pl-3 selectGameTeam label-font-Bold ml-3" onchange="selectGameTeam({{\Illuminate\Support\Facades\Auth::user()->user_ID}})" name="game" id="gameList" style="font-size: 24px">
                                                @foreach($gameList as $item)
                                                    <option value="{{$item->game_ID}}">{{$item->game_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
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
                    <div class="row mt-4" style="height: 354px;background-color: rgba(255,255,255,0.1); border-radius: 8px">
                        <div class="col-12">
                            <div class="row mt-3" id="boxManagerTeam">
                                {{--@include('includes.boxPlayer')--}}
                                @for($i=0;$i<6;$i++)
                                    @include('includes.boxPlayerNull')
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5" style="height: 80px">
                        <div class="col-12">
                            <div class="row justify-content-center" style="height: 40px">
                                <input type="text" id="invitePlayer" name="invitePlayer" value="" hidden>
                                <button type="submit" class="col-4 mr-3 btn btn-primary red-btn">Create Team</button>
                                <button type="reset" class="col-4 ml-3 btn btn-secondary light-btn">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
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
                        <div id="listPlayerModal" class="row"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="isReadyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content" style="background-color: rgba(0,0,0,0.85);">
                <div class="d-flex justify-content-center">
                    <div class="col-12 px-4 py-5">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <img src="{{asset('/data-image/error.svg')}}" width="auto" height="100px">
                                <img data-dismiss="modal" src="{{asset('data-image/cancel.svg')}}" width="18px" height="18px" style="cursor: pointer;position: absolute;right: 9px; top: -25px;">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 text-center">
                                <h2 class="text-white label-font-Bold" style="font-size: 24px">Oops!</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <h2 class="text-white label-font-Condensed-Thin mb-0" style="font-size: 20px">Please select player again</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            checkComplertTeam()
            InvitePlayer({{\Illuminate\Support\Facades\Auth::user()->user_ID}})

            var url2 = 'getPlayerList/1'
            var xhttp2 = new XMLHttpRequest();
            xhttp2.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var obj = JSON.parse(this.responseText);
                    document.getElementById('listPlayerModal').innerHTML = ""
                    obj.forEach(function (item, index) {
                        var image_user = "http://"+window.location.hostname+":"+window.location.port+"/data-image/userImage/"+item['user_image']

                        if(item['role'][0] && item['role'][1]){
                            document.getElementById('listPlayerModal').innerHTML += renderPlayerList(item['user_ID'],item['user_name'],image_user,item['rank_total'],item['role'][0]['role_name'],item['role'][1]['role_name'])

                            // console.log(item['role'][0]['role_name'],"name")
                        }else if (item['role'][0]){
                            document.getElementById('listPlayerModal').innerHTML += renderPlayerList(item['user_ID'],item['user_name'],image_user,item['rank_total'],item['role'][0]['role_name'],"")
                        }else{
                            document.getElementById('listPlayerModal').innerHTML += renderPlayerList(item['user_ID'],item['user_name'],image_user,item['rank_total'],"","")

                            // console.log("none role")
                        }
                    })
                }
            };
            xhttp2.open("GET", url2, true);
            xhttp2.send();

            var url3 = 'getRoleGame/1'
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

        $(document).on("click", ".open-AddBookDialog", function () {
            var myBookId = $(this).data('article-id');

            // alert(myBookId)
            // $("#form-modal-role #bookId").val( myBookId );
        });

    </script>

@stop