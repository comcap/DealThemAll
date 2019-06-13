<div class="col-4 mt-2 h-auto">
    <div class="row p-2 h-100">
        <div class="col-12"style="background-color: rgba(255,255,255,0.1); height: auto; border-radius: 8px">
            <div class="row p-4 align-content-center h-100">
                <div class="col-3">
                    <div class="row">
                        <img src="{{$item['thumbnail']}}" width="60px" height="60px">
                    </div>
                </div>
                <div class="col-9">
                    <div class="row">
                        <h5 class="text-white label-font-Bold" style="font-size: 14px">{{$item['title']}}</h5>
                    </div>
                    <div class="row">
                        <div class="col-8 p-0">
                            <p class="label-font-Thin mb-0" style="color:#B5DEFF; font-size: 14px">{{$item['description']}}</p>
                        </div>
                        <div class="col-4 p-0 text-right">
                            <span class="text-white label-font-Regular" style="font-size: 14px">
                                @if($item['acquired'] == true)
                                    Complete
                                @else
                                    Unfinished
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>