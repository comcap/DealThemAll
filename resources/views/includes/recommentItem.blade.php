<div class="col-md-4 col-12">
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