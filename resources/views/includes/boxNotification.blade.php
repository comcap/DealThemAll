@if(isset($notication[0]))
    @foreach($notication as $key => $item)
        @if ($key == 3)
            @break
        @endif
        @switch($item->notification_type)
            @case(1)
            @if($item->notificaiton_state == 0)
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-1 px-4">
                            <a href="profile/{{$item->user_ID}}"><img
                                        src="{{asset('/data-image/userImage/'.$item->user_image)}}"
                                        width="60px" height="60px"
                                        style="border-radius: 30px"></a>
                        </div>
                        <div class="col-7 py-2 px-4 ">
                            <div class="row mx-0">
                                <div class="col p-0">
                                    <div class="row align-items-center">
                                        <a href="profile/{{$item->user_ID}}"><h3
                                                    class="text-white label-font-Bold ml-3 mb-0"
                                                    style="font-size: 16px">{{$item->user_name}}</h3>
                                        </a>
                                        <span class="label-font-Condensed-Regular mx-1"
                                              style="color: #AAAAAA">{{$item->typeDetail}}</span>
                                        <a href="team/{{$item->teamID}}"><span
                                                    class="label-font-Bold"
                                                    style="color: #eeeeee;">{{$item->team_name}}</span></a>
                                    </div>
                                    <div class="row">
                                                                <span class="label-font-Condensed-Thin ml-3"
                                                                      style="color: #999999;font-size: 12px">{{$item->created_at}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 py-2 px-0 pt-3">
                            <div class="row mx-0">
                                <div class="col-6">
                                    <button type="submit" name="choice" value="1" class="btn red-btn">ACCEPT</button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" name="choice" value="2" class="btn light-btn">DECLINE</button>
                                </div>
                            </div>
                        </div>
                        <input type="text" name="notificationID" value="{{$item->notificationID}}" hidden>
                        <input type="text" name="user_ID" value="{{$item->user_ID}}" hidden>
                    </div>
                </div>
            @elseif($item->notificaiton_state == 1)
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-1 px-4">
                            <a href="profile/{{$item->user_ID}}"><img
                                        src="{{asset('/data-image/userImage/'.$item->user_image)}}"
                                        width="60px" height="60px"
                                        style="border-radius: 30px"></a>
                        </div>
                        <div class="col-7 py-2 px-4 ">
                            <div class="row mx-0">
                                <div class="col p-0">
                                    <div class="row align-items-center">
                                                                                <span class="label-font-Condensed-Regular ml-3 mx-1"
                                                                                      style="color: #AAAAAA">You accepted
                                                                                    <a href="profile/{{$item->user_ID}}">
                                                                                        <span class="text-white label-font-Bold mb-0"
                                                                                              style="font-size: 16px">
                                                                                            {{$item->user_name}}
                                                                                        </span>
                                                                                </a> team request. looking on
                                                                                    <a href="team/{{$item->teamID}}">
                                                                                        <span class="label-font-Bold"
                                                                                              style="color: #eeeeee;">
                                                                                            {{$item->team_name}}
                                                                                        </span>
                                                                                    </a> Timeline.
                                                                                </span>
                                    </div>
                                    <div class="row">
                                                                <span class="label-font-Condensed-Thin ml-3"
                                                                      style="color: #999999;font-size: 12px">{{$item->created_at}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-1 px-4">
                            <a href="profile/{{$item->user_ID}}"><img
                                        src="{{asset('/data-image/userImage/'.$item->user_image)}}"
                                        width="60px" height="60px"
                                        style="border-radius: 30px"></a>
                        </div>
                        <div class="col-7 py-2 px-4 ">
                            <div class="row mx-0">
                                <div class="col p-0">
                                    <div class="row align-items-center">
                                                                                <span class="label-font-Condensed-Regular ml-3 mx-1"
                                                                                      style="color: #AAAAAA">You decline
                                                                                    <a href="profile/{{$item->user_ID}}">
                                                                                        <span class="text-white label-font-Bold mb-0"
                                                                                              style="font-size: 16px">
                                                                                            {{$item->user_name}}
                                                                                        </span>
                                                                                </a> team request.
                                                                                </span>
                                    </div>
                                    <div class="row">
                                                                <span class="label-font-Condensed-Thin ml-3"
                                                                      style="color: #999999;font-size: 12px">{{$item->created_at}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @break

            @case(2)
            <div class="col-12 mb-3">
                <div class="row">
                    <div class="col-1 px-4">
                        <a href="profile/{{$item->user_ID}}"><img
                                    src="{{asset('/data-image/userImage/'.$item->user_image)}}"
                                    width="60px" height="60px"
                                    style="border-radius: 30px"></a>
                    </div>
                    <div class="col-7 py-2 px-4 ">
                        <div class="row mx-0">
                            <div class="col p-0">
                                <div class="row align-items-center">
                                    <a href="profile/{{$item->user_ID}}"><h3
                                                class="text-white label-font-Bold ml-3 mb-0"
                                                style="font-size: 16px">{{$item->user_name}}</h3>
                                    </a>
                                    <span class="label-font-Condensed-Regular mx-1"
                                          style="color: #AAAAAA">{{$item->typeDetail}}</span>
                                    <a href="team/{{$item->teamID}}"><span
                                                class="label-font-Bold"
                                                style="color: #eeeeee;">{{$item->team_name}}</span>
                                    </a>
                                </div>
                                <div class="row">
                                                                <span class="label-font-Condensed-Thin ml-3"
                                                                      style="color: #999999;font-size: 12px">{{$item->created_at}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @break

            @case(3)
            @if($item->notificaiton_state == 0)
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-1 px-4">
                            <a href="profile/{{$item->user_ID}}"><img
                                        src="{{asset('/data-image/userImage/'.$item->user_image)}}"
                                        width="60px" height="60px"
                                        style="border-radius: 30px"></a>
                        </div>
                        <div class="col-7 py-2 px-4 ">
                            <div class="row mx-0">
                                <div class="col p-0">
                                    <div class="row align-items-center">
                                        <a href="profile/{{$item->user_ID}}"><h3
                                                    class="text-white label-font-Bold ml-3 mb-0"
                                                    style="font-size: 16px">{{$item->user_name}}</h3>
                                        </a>
                                        <span class="label-font-Condensed-Regular mx-1"
                                              style="color: #AAAAAA">{{$item->typeDetail}}</span>
                                        <a href="team/{{$item->teamID}}"><span
                                                    class="label-font-Bold"
                                                    style="color: #eeeeee;">{{$item->team_name}}</span></a>
                                    </div>
                                    <div class="row">
                                                                <span class="label-font-Condensed-Thin ml-3"
                                                                      style="color: #999999;font-size: 12px">{{$item->created_at}}</span>
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
                                    <button class="btn light-btn">DECLINE
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @elseif($item->notificaiton_state == 1)
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-1 px-4">
                            <a href="profile/{{$item->user_ID}}"><img
                                        src="{{asset('/data-image/userImage/'.$item->user_image)}}"
                                        width="60px" height="60px"
                                        style="border-radius: 30px"></a>
                        </div>
                        <div class="col-7 py-2 px-4 ">
                            <div class="row mx-0">
                                <div class="col p-0">
                                    <div class="row align-items-center">
                                        <a href="profile/{{$item->user_ID}}"><h3
                                                    class="text-white label-font-Bold ml-3 mb-0"
                                                    style="font-size: 16px">{{$item->user_name}}</h3>
                                        </a>
                                        <span class="label-font-Condensed-Regular mx-1"
                                              style="color: #AAAAAA">{{$item->typeDetail}}</span>
                                        <a href="team/{{$item->teamID}}"><span
                                                    class="label-font-Bold"
                                                    style="color: #eeeeee;">{{$item->team_name}}</span></a>
                                        <span class="label-font-Condensed-Regular mx-1"
                                              style="color: #AAAAAA"> role </span>
                                        @foreach($userRole as $item)
                                            <div class="box-role d-flex align-items-center mr-2"
                                                 style="background-color: {{$item['role_color']}}">
                                                <img src="{{asset($item->game_logo)}}"
                                                     height="20px" width="20px">
                                                <label class="text-white ml-1 m-0">{{$item->role_name}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                                                <span class="label-font-Condensed-Thin ml-3"
                                                                      style="color: #999999;font-size: 12px">{{$item->created_at}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-1 px-4">
                            <a href="profile/{{$item->user_ID}}"><img
                                        src="{{asset('/data-image/userImage/'.$item->user_image)}}"
                                        width="60px" height="60px"
                                        style="border-radius: 30px"></a>
                        </div>
                        <div class="col-7 py-2 px-4 ">
                            <div class="row mx-0">
                                <div class="col p-0">
                                    <div class="row align-items-center">
                                        <a href="profile/{{$item->user_ID}}"><h3
                                                    class="text-white label-font-Bold ml-3 mb-0"
                                                    style="font-size: 16px">{{$item->user_name}}</h3>
                                        </a>
                                        <span class="label-font-Condensed-Regular mx-1"
                                              style="color: #AAAAAA">{{$item->typeDetail}}</span>
                                        <a href="team/{{$item->teamID}}"><span
                                                    class="label-font-Bold"
                                                    style="color: #eeeeee;">{{$item->team_name}}</span></a>
                                    </div>
                                    <div class="row">
                                                                <span class="label-font-Condensed-Thin ml-3"
                                                                      style="color: #999999;font-size: 12px">{{$item->created_at}}</span>
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
                                    <button class="btn light-btn">DECLINE
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @break

            @case(4)
            <div class="col-12 mb-3">
                <div class="row">
                    <div class="col-1 px-4">
                        <a href="profile/{{$item->user_ID}}"><img
                                    src="{{asset('/data-image/userImage/'.$item->user_image)}}"
                                    width="60px" height="60px"
                                    style="border-radius: 30px"></a>
                    </div>
                    <div class="col-11 py-2 px-4 ">
                        <div class="row mx-0">
                            <div class="col p-0">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <div class="row">
                                            <a href="profile/{{$item->user_ID}}" ><h3
                                                        class="text-white label-font-Bold ml-3 mb-0"
                                                        style="font-size: 16px;line-height: 1.5">{{$item->user_name}}</h3>
                                            </a>
                                            <span class="label-font-Condensed-Regular mx-1 text-secondary">{{$item->typeDetail}} </span>
                                            <span class=" threeDot" style="color: #AAAAAA"> {{$item->notificationText}}</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                                                <span class="label-font-Condensed-Thin ml-3"
                                                                      style="color: #999999;font-size: 12px">{{$item->created_at}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @break

            @case(5)
            <div class="col-12 mb-3">
                <div class="row">
                    <div class="col-1 px-4">
                        <a href="profile/{{$item->user_ID}}"><img
                                    src="{{asset('/data-image/userImage/'.$item->user_image)}}"
                                    width="60px" height="60px"
                                    style="border-radius: 30px"></a>
                    </div>
                    <div class="col-7 py-2 px-4 ">
                        <div class="row mx-0">
                            <div class="col p-0">
                                <div class="row align-items-center">
                                                                            <span class="label-font-Condensed-Regular ml-3 mx-1"
                                                                                  style="color: #AAAAAA">{{$item->typeDetail}}</span>
                                    <a href="profile/{{$item->user_ID}}"><h3
                                                class="text-white label-font-Bold mb-0"
                                                style="font-size: 16px">{{$item->user_name}}</h3>
                                    </a>
                                </div>
                                <div class="row">
                                                                <span class="label-font-Condensed-Thin ml-3"
                                                                      style="color: #999999;font-size: 12px">{{$item->created_at}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @break

            @default
        @endswitch
    @endforeach
@else
    <div class="col-12 px-4 py-3">
        <div class="row">
            <div class="col-12 text-center">
                <i class="far fa-bell text-secondary"
                   style="font-size: 60px"></i>
                {{--<img src="{{asset('/data-image/error.svg')}}" width="auto" height="100px">--}}
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12 text-center">
                <h2 class="text-secondary label-font-Bold m-0"
                    style="font-size: 24px">Oops!</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="text-secondary label-font-Condensed-Thin mb-0"
                    style="font-size: 20px">No notification yet.</h2>
            </div>
        </div>
    </div>
@endif

{{--____________________________________________________________________________________________________________________________________--}}


{{--@if(isset($notication[0]))--}}
    {{--@foreach($notication as $key => $item)--}}
        {{--@if ($key == 3)--}}
            {{--@break--}}
        {{--@endif--}}
        {{--@switch($item->notification_type)--}}
            {{--@case(1)--}}
            {{--@if($item->notificaiton_state == 0)--}}
                {{--<div class="col-12 mb-3">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-1 col-4 px-4">--}}
                            {{--<a href="profile/{{$item->user_ID}}"><img--}}
                                        {{--src="{{asset('/data-image/userImage/'.$item->user_image)}}"--}}
                                        {{--width="60px" height="60px"--}}
                                        {{--style="border-radius: 30px"></a>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-7 col-8 py-2 px-4 ">--}}
                            {{--<div class="row mx-0">--}}
                                {{--<div class="col p-0">--}}
                                    {{--<div class="row align-items-center">--}}
                                        {{--<a href="profile/{{$item->user_ID}}"><h3--}}
                                                    {{--class="text-white label-font-Bold ml-3 mb-0"--}}
                                                    {{--style="font-size: 16px">{{$item->user_name}}</h3>--}}
                                        {{--</a>--}}
                                        {{--<span class="label-font-Condensed-Regular mx-1"--}}
                                              {{--style="color: #AAAAAA">{{$item->typeDetail}}</span>--}}
                                        {{--<a href="team/{{$item->teamID}}"><span--}}
                                                    {{--class="label-font-Bold"--}}
                                                    {{--style="color: #eeeeee;">{{$item->team_name}}</span></a>--}}
                                    {{--</div>--}}
                                    {{--<div class="row">--}}
                                                                {{--<span class="label-font-Condensed-Thin ml-3"--}}
                                                                      {{--style="color: #999999;font-size: 12px">{{$item->created_at}}</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4 col-12 py-2 px-0 pt-3">--}}
                            {{--<div class="row mx-0">--}}
                                {{--<div class="col-6">--}}
                                    {{--<button type="submit" name="choice" value="1" class="btn red-btn">ACCEPT</button>--}}
                                {{--</div>--}}
                                {{--<div class="col-6">--}}
                                    {{--<button type="submit" name="choice" value="2" class="btn light-btn">DECLINE</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<input type="text" name="notificationID" value="{{$item->notificationID}}" hidden>--}}
                        {{--<input type="text" name="user_ID" value="{{$item->user_ID}}" hidden>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--@elseif($item->notificaiton_state == 1)--}}
                {{--<div class="col-12 mb-3">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-1 col-4 px-4">--}}
                            {{--<a href="profile/{{$item->user_ID}}"><img--}}
                                        {{--src="{{asset('/data-image/userImage/'.$item->user_image)}}"--}}
                                        {{--width="60px" height="60px"--}}
                                        {{--style="border-radius: 30px"></a>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-7 col-8 py-2 px-4 ">--}}
                            {{--<div class="row mx-0">--}}
                                {{--<div class="col p-0">--}}
                                    {{--<div class="row align-items-center">--}}
                                                                                {{--<span class="label-font-Condensed-Regular ml-3 mx-1"--}}
                                                                                      {{--style="color: #AAAAAA">You accepted--}}
                                                                                    {{--<a href="profile/{{$item->user_ID}}">--}}
                                                                                        {{--<span class="text-white label-font-Bold mb-0"--}}
                                                                                              {{--style="font-size: 16px">--}}
                                                                                            {{--{{$item->user_name}}--}}
                                                                                        {{--</span>--}}
                                                                                {{--</a> team request. looking on--}}
                                                                                    {{--<a href="team/{{$item->teamID}}">--}}
                                                                                        {{--<span class="label-font-Bold"--}}
                                                                                              {{--style="color: #eeeeee;">--}}
                                                                                            {{--{{$item->team_name}}--}}
                                                                                        {{--</span>--}}
                                                                                    {{--</a> Timeline.--}}
                                                                                {{--</span>--}}
                                    {{--</div>--}}
                                    {{--<div class="row">--}}
                                                                {{--<span class="label-font-Condensed-Thin ml-3"--}}
                                                                      {{--style="color: #999999;font-size: 12px">{{$item->created_at}}</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--@else--}}
                {{--<div class="col-12 mb-3">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-1 col-4 px-4">--}}
                            {{--<a href="profile/{{$item->user_ID}}"><img--}}
                                        {{--src="{{asset('/data-image/userImage/'.$item->user_image)}}"--}}
                                        {{--width="60px" height="60px"--}}
                                        {{--style="border-radius: 30px"></a>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-7 col-8 py-2 px-4 ">--}}
                            {{--<div class="row mx-0">--}}
                                {{--<div class="col p-0">--}}
                                    {{--<div class="row align-items-center">--}}
                                                                                {{--<span class="label-font-Condensed-Regular ml-3 mx-1"--}}
                                                                                      {{--style="color: #AAAAAA">You decline--}}
                                                                                    {{--<a href="profile/{{$item->user_ID}}">--}}
                                                                                        {{--<span class="text-white label-font-Bold mb-0"--}}
                                                                                              {{--style="font-size: 16px">--}}
                                                                                            {{--{{$item->user_name}}--}}
                                                                                        {{--</span>--}}
                                                                                {{--</a> team request.--}}
                                                                                {{--</span>--}}
                                    {{--</div>--}}
                                    {{--<div class="row">--}}
                                                                {{--<span class="label-font-Condensed-Thin ml-3"--}}
                                                                      {{--style="color: #999999;font-size: 12px">{{$item->created_at}}</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--@endif--}}
            {{--@break--}}

            {{--@case(2)--}}
            {{--<div class="col-12 mb-3">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-1 px-4">--}}
                        {{--<a href="profile/{{$item->user_ID}}"><img--}}
                                    {{--src="{{asset('/data-image/userImage/'.$item->user_image)}}"--}}
                                    {{--width="60px" height="60px"--}}
                                    {{--style="border-radius: 30px"></a>--}}
                    {{--</div>--}}
                    {{--<div class="col-7 py-2 px-4 ">--}}
                        {{--<div class="row mx-0">--}}
                            {{--<div class="col p-0">--}}
                                {{--<div class="row align-items-center">--}}
                                    {{--<a href="profile/{{$item->user_ID}}"><h3--}}
                                                {{--class="text-white label-font-Bold ml-3 mb-0"--}}
                                                {{--style="font-size: 16px">{{$item->user_name}}</h3>--}}
                                    {{--</a>--}}
                                    {{--<span class="label-font-Condensed-Regular mx-1"--}}
                                          {{--style="color: #AAAAAA">{{$item->typeDetail}}</span>--}}
                                    {{--<a href="team/{{$item->teamID}}"><span--}}
                                                {{--class="label-font-Bold"--}}
                                                {{--style="color: #eeeeee;">{{$item->team_name}}</span>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                                {{--<div class="row">--}}
                                                                {{--<span class="label-font-Condensed-Thin ml-3"--}}
                                                                      {{--style="color: #999999;font-size: 12px">{{$item->created_at}}</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--@break--}}

            {{--@case(3)--}}
            {{--@if($item->notificaiton_state == 0)--}}
                {{--<div class="col-12 mb-3">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-1 col-4 px-4">--}}
                            {{--<a href="profile/{{$item->user_ID}}"><img--}}
                                        {{--src="{{asset('/data-image/userImage/'.$item->user_image)}}"--}}
                                        {{--width="60px" height="60px"--}}
                                        {{--style="border-radius: 30px"></a>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-7 col-8 py-2 px-4 ">--}}
                            {{--<div class="row mx-0">--}}
                                {{--<div class="col p-0">--}}
                                    {{--<div class="row align-items-center">--}}
                                        {{--<a href="profile/{{$item->user_ID}}"><h3--}}
                                                    {{--class="text-white label-font-Bold ml-3 mb-0"--}}
                                                    {{--style="font-size: 16px">{{$item->user_name}}</h3>--}}
                                        {{--</a>--}}
                                        {{--<span class="label-font-Condensed-Regular mx-1"--}}
                                              {{--style="color: #AAAAAA">{{$item->typeDetail}}</span>--}}
                                        {{--<a href="team/{{$item->teamID}}"><span--}}
                                                    {{--class="label-font-Bold"--}}
                                                    {{--style="color: #eeeeee;">{{$item->team_name}}</span></a>--}}
                                    {{--</div>--}}
                                    {{--<div class="row">--}}
                                                                {{--<span class="label-font-Condensed-Thin ml-3"--}}
                                                                      {{--style="color: #999999;font-size: 12px">{{$item->created_at}}</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4 col-12 py-2 px-0 pt-3">--}}
                            {{--<div class="row mx-0">--}}
                                {{--<div class="col-6">--}}
                                    {{--<button class="btn red-btn">ACCEPT</button>--}}
                                {{--</div>--}}
                                {{--<div class="col-6">--}}
                                    {{--<button class="btn light-btn">DECLINE--}}
                                    {{--</button>--}}
                                {{--</div>--}}

                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--@elseif($item->notificaiton_state == 1)--}}
                {{--<div class="col-12 mb-3">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-1 col-4 px-4">--}}
                            {{--<a href="profile/{{$item->user_ID}}"><img--}}
                                        {{--src="{{asset('/data-image/userImage/'.$item->user_image)}}"--}}
                                        {{--width="60px" height="60px"--}}
                                        {{--style="border-radius: 30px"></a>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-7 col-8 py-2 px-4 ">--}}
                            {{--<div class="row mx-0">--}}
                                {{--<div class="col p-0">--}}
                                    {{--<div class="row align-items-center">--}}
                                        {{--<a href="profile/{{$item->user_ID}}"><h3--}}
                                                    {{--class="text-white label-font-Bold ml-3 mb-0"--}}
                                                    {{--style="font-size: 16px">{{$item->user_name}}</h3>--}}
                                        {{--</a>--}}
                                        {{--<span class="label-font-Condensed-Regular mx-1"--}}
                                              {{--style="color: #AAAAAA">{{$item->typeDetail}}</span>--}}
                                        {{--<a href="team/{{$item->teamID}}"><span--}}
                                                    {{--class="label-font-Bold"--}}
                                                    {{--style="color: #eeeeee;">{{$item->team_name}}</span></a>--}}
                                        {{--<span class="label-font-Condensed-Regular mx-1"--}}
                                              {{--style="color: #AAAAAA"> role </span>--}}
                                        {{--@foreach($userRole as $item)--}}
                                            {{--<div class="box-role d-flex align-items-center mr-2"--}}
                                                 {{--style="background-color: {{$item['role_color']}}">--}}
                                                {{--<img src="{{asset($item->game_logo)}}"--}}
                                                     {{--height="20px" width="20px">--}}
                                                {{--<label class="text-white ml-1 m-0">{{$item->role_name}}</label>--}}
                                            {{--</div>--}}
                                        {{--@endforeach--}}
                                    {{--</div>--}}
                                    {{--<div class="row">--}}
                                                                {{--<span class="label-font-Condensed-Thin ml-3"--}}
                                                                      {{--style="color: #999999;font-size: 12px">{{$item->created_at}}</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--@else--}}
                {{--<div class="col-12 mb-3">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-1 col-4 px-4">--}}
                            {{--<a href="profile/{{$item->user_ID}}"><img--}}
                                        {{--src="{{asset('/data-image/userImage/'.$item->user_image)}}"--}}
                                        {{--width="60px" height="60px"--}}
                                        {{--style="border-radius: 30px"></a>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-7 col-8 py-2 px-4 ">--}}
                            {{--<div class="row mx-0">--}}
                                {{--<div class="col p-0">--}}
                                    {{--<div class="row align-items-center">--}}
                                        {{--<a href="profile/{{$item->user_ID}}"><h3--}}
                                                    {{--class="text-white label-font-Bold ml-3 mb-0"--}}
                                                    {{--style="font-size: 16px">{{$item->user_name}}</h3>--}}
                                        {{--</a>--}}
                                        {{--<span class="label-font-Condensed-Regular mx-1"--}}
                                              {{--style="color: #AAAAAA">{{$item->typeDetail}}</span>--}}
                                        {{--<a href="team/{{$item->teamID}}"><span--}}
                                                    {{--class="label-font-Bold"--}}
                                                    {{--style="color: #eeeeee;">{{$item->team_name}}</span></a>--}}
                                    {{--</div>--}}
                                    {{--<div class="row">--}}
                                                                {{--<span class="label-font-Condensed-Thin ml-3"--}}
                                                                      {{--style="color: #999999;font-size: 12px">{{$item->created_at}}</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4 col-12 py-2 px-0 pt-3">--}}
                            {{--<div class="row mx-0">--}}
                                {{--<div class="col-6">--}}
                                    {{--<button class="btn red-btn">ACCEPT</button>--}}
                                {{--</div>--}}
                                {{--<div class="col-6">--}}
                                    {{--<button class="btn light-btn">DECLINE--}}
                                    {{--</button>--}}
                                {{--</div>--}}

                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--@endif--}}
            {{--@break--}}

            {{--@case(4)--}}
            {{--<div class="col-12 mb-3">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-1 col-4 px-4">--}}
                        {{--<a href="profile/{{$item->user_ID}}"><img--}}
                                    {{--src="{{asset('/data-image/userImage/'.$item->user_image)}}"--}}
                                    {{--width="60px" height="60px"--}}
                                    {{--style="border-radius: 30px"></a>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-11 col-8 py-2 px-4 ">--}}
                        {{--<div class="row mx-0">--}}
                            {{--<div class="col p-0">--}}
                                {{--<div class="row align-items-center">--}}
                                    {{--<div class="col-3">--}}
                                        {{--<div class="row">--}}
                                            {{--<a href="profile/{{$item->user_ID}}"><h3--}}
                                                        {{--class="text-white label-font-Bold ml-3 mb-0"--}}
                                                        {{--style="font-size: 16px">{{$item->user_name}}</h3>--}}
                                            {{--</a>--}}
                                            {{--<span class="label-font-Condensed-Regular mx-1 text-secondary">{{$item->typeDetail}} </span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="col-9 pl-0">--}}
                                        {{--<div class="row mr-0">--}}
                                            {{--<span class=" threeDot" style="color: #AAAAAA"> {{$item->notificationText}}</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                {{--</div>--}}
                                {{--<div class="row">--}}
                                                                {{--<span class="label-font-Condensed-Thin ml-3"--}}
                                                                      {{--style="color: #999999;font-size: 12px">{{$item->created_at}}</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--@break--}}

            {{--@case(5)--}}
            {{--<div class="col-12 mb-md-3">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-1 col-4 px-4">--}}
                        {{--<a href="profile/{{$item->user_ID}}"><img--}}
                                    {{--src="{{asset('/data-image/userImage/'.$item->user_image)}}"--}}
                                    {{--width="60px" height="60px"--}}
                                    {{--style="border-radius: 30px"></a>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-7 col-8 py-2 px-4 ">--}}
                        {{--<div class="row mx-0">--}}
                            {{--<div class="col p-0">--}}
                                {{--<div class="row align-items-center">--}}
                                                                            {{--<span class="label-font-Condensed-Regular ml-0 ml-md-3"--}}
                                                                                  {{--style="color: #AAAAAA">{{$item->typeDetail}}</span>--}}
                                    {{--<a href="profile/{{$item->user_ID}}"><h3--}}
                                                {{--class="text-white label-font-Bold mb-0"--}}
                                                {{--style="font-size: 16px">{{$item->user_name}}</h3>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                                {{--<div class="row">--}}
                                                                {{--<span class="label-font-Condensed-Thin ml-0 ml-md-3"--}}
                                                                      {{--style="color: #999999;font-size: 12px">{{$item->created_at}}</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--@break--}}

            {{--@default--}}
        {{--@endswitch--}}
    {{--@endforeach--}}
{{--@else--}}
    {{--<div class="col-12 px-4 py-3">--}}
        {{--<div class="row">--}}
            {{--<div class="col-12 text-center">--}}
                {{--<i class="far fa-bell text-secondary"--}}
                   {{--style="font-size: 60px"></i>--}}
                {{--<img src="{{asset('/data-image/error.svg')}}" width="auto" height="100px">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row mt-2">--}}
            {{--<div class="col-12 text-center">--}}
                {{--<h2 class="text-secondary label-font-Bold m-0"--}}
                    {{--style="font-size: 24px">Oops!</h2>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="col-12 text-center">--}}
                {{--<h2 class="text-secondary label-font-Condensed-Thin mb-0"--}}
                    {{--style="font-size: 20px">No notification yet.</h2>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--@endif--}}