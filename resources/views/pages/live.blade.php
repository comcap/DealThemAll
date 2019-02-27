@extends('layouts.sidebar')
@section('content')

    <?php

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.twitch.tv/helix/streams?game_id=488552&first=10",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "Client-ID: nzrv6yapvtsrkp1nv4v1287hrbxs74",
        "Postman-Token: 55f1f3f7-5cc0-40d8-9b36-0a694c68fbb3",
        "cache-control: no-cache"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
        $json = json_decode($response, true);

//        var_dump($json['data']);
    }
    ?>
    <div id="box-item" class="container">

        <div id='twitch-embed-top'></div>

        <div style="height: 50px; border-bottom: 1px #ffffff solid">
            <select class="form-control col-3" id="exampleFormControlSelect1">
                <option value="488552">Overwatch</option>
                <option value="21779">League of Legends</option>
                <option value="21779">Dota 2</option>
                <option value="21779">PUBG</option>
                <option value="21779">Counter-strike global offensive</option>
            </select>
        </div>

        <div class="row" style="background-color: rgba(255,255,255,0.1)">
            @foreach ($json['data'] as $key => $item)
                <iframe
                        src="https://player.twitch.tv/?channel={{$item['user_name']}}&autoplay=false&muted=true/"
                        height="250px"
                        width="100%"
                        scrolling="no"
                        frameborder="0"
                        allowfullscreen="true" class="col-4 mt-4">
                </iframe>
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
        new Twitch.Embed("twitch-embed-top", {
            width: "100%",
            height: "700px",
            layout: "video-with-chat",
            channel: "KabajiOW",
            autoplay: false
        });
    </script>
@stop