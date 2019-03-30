@extends('layouts.sidebar')
@section('content')

    <div id="box-item" class="container">
        <div class="row mt-3">
            <div class="col-5 pl-0">
                <div class="row mx-0">
                    <h4 class="label-font-Bold text-white">Select game</h4>
                </div>
                <div class="row mx-0">
                    <img id="logoGame" src="{{asset('data-image/game_logo/overwatch/logo.svg')}}" width="40px" height="40px">
                    <select name="game" id="gameSelect" style="font-size: 24px" class="pl-3 select-game label-font-Bold w-75 ml-2" onchange="profileSelectGame({{$id}})">
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
        <div class="row mt-3">
            <div class="col border-bottom"></div>
        </div>

        <div class="row mt-3">
            <div class="col-12 px-0">
                <div id='twitch-embed-top'></div>
            </div>
        </div>







        <div class="row mt-3 h-auto pb-3" style="background-color: rgba(255,255,255,0.1); border-radius: 10px; margin-bottom: 80px">
            @foreach ($arrLive as $item)
                <div class="col-4 mt-3">
                    <div class="row px-4" style="height: 260px;">
                        <iframe
                                src="https://player.twitch.tv/?channel={{$item['stream']['channel']['name']}}&autoplay=false&muted=true/"
                                height="100%"
                                width="100%"
                                scrolling="no"
                                frameborder="0"
                                allowfullscreen="true">
                        </iframe>
                        {{--<img class="d-block w-100 h-100" src="https://dummyimage.com/600x400/000/fff">--}}
                    </div>

                    <div class="row px-4 mt-2" style="height: 50px;">
                        <div class="col-2 px-0">
                            <img src="{{asset("/data-image/userImage/".$item['stream']['userImage'])}}" height="50px" width="auto" style="border-radius: 25px">
                        </div>
                        <div class="col-7">
                            <h6 class="text-white mb-0 label-font-Bold" style="font-size: 13px">{{$item['stream']['username']}}</h6>
                            <p style="font-family: Arial;font-size: 12px;color: #CCCCCC">{{$item['stream']['channel']['status']}}</p>
                        </div>
                        <div class="col-3">
                            <div class="row">
                                <img class="mt-1" src="{{asset("/data-image/view.svg")}}" width="20px" height="10px">
                                <p class="label-font-Regular" style="font-size: 12px;color: #F11D72">{{$item['stream']['viewers']}} view</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Load the Twitch embed script -->
    <script src="https://embed.twitch.tv/embed/v1.js"></script>

    <!-- Create a Twitch.Embed object that will render within the "twitch-embed" root element. -->
    {{--<script type="text/javascript">--}}
        {{--var settings = {--}}
            {{--"async": true,--}}
            {{--"crossDomain": true,--}}
            {{--"url": "https://api.twitch.tv/helix/streams?game_id=488552",--}}
            {{--"method": "GET",--}}
            {{--"headers": {--}}
                {{--"Client-ID": "nzrv6yapvtsrkp1nv4v1287hrbxs74"--}}
            {{--}--}}
        {{--};--}}

        {{--$.ajax(settings).done(function (response) {--}}
            {{--// console.log(response);--}}
            {{--var render = "";--}}
            {{--response['data'].forEach(function(element, index) {--}}
                {{--new Twitch.Embed("twitch-embed"+index, {--}}
                    {{--width: "33%",--}}
                    {{--height: "250px",--}}
                    {{--layout: "video",--}}
                    {{--channel: element['user_name'],--}}
                    {{--autoplay: false--}}
                {{--});--}}

            {{--render += "<div id='twitch-embed"+index+"'></div>"--}}
            {{--});--}}

            {{--console.log(render,"render")--}}
            {{--// document.getElementById("box-item").innerHTML = render--}}
        {{--});--}}
    {{--</script>--}}

    <script type="text/javascript">
        var arrLive = {!! $arrLive !!}
        var username = arrLive[0]['stream']['channel']['name' ]

        new Twitch.Embed("twitch-embed-top", {
            width: "100%",
            height: "700px",
            layout: "video-with-chat",
            channel: username,
            autoplay: false
        });
    </script>
@stop