<div class="row mt-3 mx-0 box-image" style="background-color: rgba(0,0,0,1);">
    <div id="demo{{$item->post_ID}}" class="carousel slide w-100" data-interval="false" data-ride="carousel">
        <!-- Indicators -->
        <ul class="carousel-indicators">
            @foreach($item->imagePath as $key => $images)
                @if(count($item->imagePath) > 1)
                    @if ($key == 0)
                        <li data-target="#demo{{$item->post_ID}}" data-slide-to="{{$key}}" class="active"></li>
                        @continue
                    @endif
                    <li data-target="#demo{{$item->post_ID}}" data-slide-to="{{$key}}"></li>
                @endif
            @endforeach
        </ul>

        <!-- The slideshow -->
        <div class="carousel-inner">
            @foreach($item->imagePath as $key => $images)
                @if ($key == 0)
                    <div class="carousel-item active">
                        <img src="{{asset('data-image/post_asset/'.$images->asset_name)}}" height="100%" class="content-image-center">
                    </div>
                    @continue
                @endif
                    <div class="carousel-item">
                        <img src="{{asset('data-image/post_asset/'.$images->asset_name)}}" height="100%" class="content-image-center">
                    </div>
            @endforeach
        </div>

        @if(count($item->imagePath) > 1)
        <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo{{$item->post_ID}}" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo{{$item->post_ID}}" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        @endif
    </div>
</div>