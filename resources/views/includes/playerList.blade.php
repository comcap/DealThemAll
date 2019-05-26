@foreach($listPlayer as $item)
    <div class="col-12 col-md-4 p-2 ">
        <a href="/profile/{{$item->user_ID}}">
            <div class=" player-box" style="background-color: rgba(255,255,255,0.1); height: 200px; border-radius: 8px">
                <div class="row px-4 pt-3">
                    <div class="col-4 pl-2 ">
                        <img src="{{asset("/data-image/userImage/$item->user_image")}}" height="auto" width="100%" style="border-radius: 50px;">
                    </div>
                    <div class="col-8 p-0">
                        <div class="row pr-4">
                            <div class="col-4 pr-0 col-md-6 pt-2" style="height: 24px">
                                <p class="text-white threeDot label-font-Bold" style="font-size: 16px; word-wrap: break-word;">{{$item->user_name}}</p>
                            </div>
                            <div class="col-8 col-md-6 pl-0 ">
                                <div class="row justify-content-end">
                                    <img src="{{asset("/data-image/three-stars.svg")}}" height="50px">
                                    <div class="pt-2">
                                        <div class="label-font-Condensed-Bold pl-2" style="color: #ffffff; font-size: 10px">
                                            <h7>RANKING</h7>
                                        </div>
                                        <div class="label-font-Condensed-Bold pl-2" style="font-size: 24px;color: #F11D72;text-shadow: 0px 0px 6px #F11D72;line-height: 100%">
                                            <p>{{number_format($item->rank_total)}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pl-3">
                            @if(count($userRole)>0)
                                @foreach($userRole as $roleItem)
                                    @if($item->user_ID == $roleItem->user_ID && $roleItem->game_ID == $id && ($roleItem->stateRole == 1 || $roleItem->stateRole == 2) )
                                        <div class="box-role d-flex align-items-center mr-2" style="background-color: {{$roleItem['role_color']}}">
                                            <img src="{{asset($roleItem->game_logo)}}" height="20px" width="20px">
                                            <label class="text-white ml-1 m-0">{{$roleItem->role_name}}</label>
                                        </div>
                                    @else
                                        <div style="height: 10px"></div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <div class="row pl-3 mt-2">
                                <div class="col-6" style="height: 40px">
                                    <div class="row p-0">
                                        <img src="{{asset("/data-image/stats_icon/trophy.svg")}}" height="30px">
                                        <div>
                                            <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                                <h7>GAME WON</h7>
                                            </div>
                                            <div class="text-white label-font-Condensed-Regular pl-2" style="font-size: 16px">
                                                <p>{{$item->won_total}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6" style="height: 40px">
                                    <div class="row p-0">
                                        <img src="{{asset("/data-image/stats_icon/skull.svg")}}" height="30px">
                                        <div>
                                            <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                                <h7>KILL</h7>
                                            </div>
                                            <div class="text-white label-font-Condensed-Regular pl-2" style="font-size: 16px">
                                                <p>{{$item->kill_total}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="row pl-3 mt-2">
                            <div class="col-6" style="height: 40px">
                                <div class="row p-0">
                                    <img src="{{asset("/data-image/stats_icon/target.svg")}}" height="30px">
                                    <div>
                                        <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                            <h7>ACCURACY</h7>
                                        </div>
                                        <div class="text-white label-font-Condensed-Regular pl-2" style="font-size: 16px">
                                            <p>{{number_format($item->accuracy_total)}} %</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6" style="height: 40px">
                                <div class="row p-0">
                                    <img src="{{asset("/data-image/stats_icon/clock.svg")}}" height="30px">
                                    <div>
                                        <div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">
                                            <h7>TIME PLAYED</h7>
                                        </div>
                                        <div class="text-white label-font-Condensed-Regular pl-2" style="font-size: 16px">
                                            <p>{{$item->time_total}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </a>
    </div>
    {{--<div class="col-12 p-2">--}}
        {{--<a href="/profile/{{$item->user_ID}}">--}}
            {{--<div class="row p-4 player-box" style="background-color: rgba(255,255,255,0.1); height: 140px; border-radius: 8px">--}}
                {{--<div class="col-1 p-0">--}}
                    {{--<img src="{{asset("/data-image/userImage/$item->user_image")}}" height="100px" width="auto" style="border-radius: 50px;">--}}
                {{--</div>--}}
                {{--<div class="col-9">--}}
                    {{--<div class="row pl-4" style="height: 24px">--}}
                        {{--<p class="text-white label-font-Bold" style="font-size: 14px">{{$item->user_name}}</p>--}}
                    {{--</div>--}}
                    {{--<div class="row pl-4">--}}
                        {{--@if(count($userRole)>0)--}}
                            {{--@foreach($userRole as $roleItem)--}}
                                {{--@if($item->user_ID == $roleItem->user_ID && $roleItem->game_ID == $id)--}}
                                {{--<div class="box-role mr-2">--}}
                                    {{--<img src="{{asset($roleItem->game_logo)}}" height="20px" width="20px">--}}
                                    {{--<label class="text-white">{{$roleItem->role_name}}</label>--}}
                                {{--</div>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--@endif--}}
                    {{--</div>--}}
                    {{--<div class="row pl-4 mt-2">--}}
                            {{--<div class="col-2" style="height: 40px">--}}
                                {{--<div class="row p-0">--}}
                                    {{--<img src="{{asset("/data-image/stats_icon/trophy.svg")}}" height="40px">--}}
                                    {{--<div>--}}
                                        {{--<div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">--}}
                                            {{--<h7>GAME WON</h7>--}}
                                        {{--</div>--}}
                                        {{--<div class="text-white label-font-Condensed-Bold pl-2" style="font-size: 18px">--}}
                                            {{--<p>{{$item->won_total}}</p>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-2" style="height: 40px">--}}
                                {{--<div class="row p-0">--}}
                                    {{--<img src="{{asset("/data-image/stats_icon/skull.svg")}}" height="40px">--}}
                                    {{--<div>--}}
                                        {{--<div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">--}}
                                            {{--<h7>KILL</h7>--}}
                                        {{--</div>--}}
                                        {{--<div class="text-white label-font-Condensed-Bold pl-2" style="font-size: 18px">--}}
                                            {{--<p>{{$item->kill_total}}</p>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-2" style="height: 40px">--}}
                                {{--<div class="row p-0">--}}
                                    {{--<img src="{{asset("/data-image/stats_icon/target.svg")}}" height="40px">--}}
                                    {{--<div>--}}
                                        {{--<div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">--}}
                                            {{--<h7>ACCURACY</h7>--}}
                                        {{--</div>--}}
                                        {{--<div class="text-white label-font-Condensed-Bold pl-2" style="font-size: 18px">--}}
                                            {{--<p>{{number_format($item->accuracy_total)}} %</p>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-2" style="height: 40px">--}}
                                {{--<div class="row p-0">--}}
                                    {{--<img src="{{asset("/data-image/stats_icon/clock.svg")}}" height="40px">--}}
                                    {{--<div>--}}
                                        {{--<div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">--}}
                                            {{--<h7>TIME PLAYED</h7>--}}
                                        {{--</div>--}}
                                        {{--<div class="text-white label-font-Condensed-Bold pl-2" style="font-size: 18px">--}}
                                            {{--<p>{{$item->time_total}}</p>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-2 align-self-center">--}}
                    {{--<div class="row justify-content-end" style="height: 60px">--}}
                        {{--<img src="{{asset("/data-image/three-stars.svg")}}" height="56px">--}}
                        {{--<div class="pt-2">--}}
                            {{--<div class="label-font-Condensed-Bold pl-2" style="color: #9EA1A5; font-size: 10px">--}}
                                {{--<h7>RANKING</h7>--}}
                            {{--</div>--}}
                            {{--<div class="label-font-Condensed-Bold pl-2" style="font-size: 30px;color: #F11D72;text-shadow: 0px 0px 6px #F11D72;line-height: 100%">--}}
                                {{--<p>{{number_format($item->rank_total)}}</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</a>--}}
    {{--</div>--}}
@endforeach
