<div class="row mx-0 mx-md-3 home-margin-top">
    <div class="col-12 mt-2">
        <div class="row p-4" style="background-color: rgba(255,255,255,0.1); height: auto; border-radius: 8px">
            <div class="col-12 px-4" style="height: auto">
                <div class="row">
                    @if($id==$myUser->user_ID)
                        <label class="text-white label-font-Bold" style="font-size: 18px;">PROFILE</label>
                        <a href="/ApiLogout"><img src="{{asset('data-image/power-button-off.svg')}}" style="width: 16px;height: 16px;position: absolute;right: 1px;"></a>
                    @else
                        <label class="text-white label-font-Bold" style="font-size: 18px;">PLAYER</label>
                    @endif
                </div>
                <div class="row d-none d-md-flex">
                    <div class="col-8 p-0" style="height: 130px;">
                        <div class="row px-4">
                            <div class="col-3 p-0">
                                @if(isset($userProfile->user_image))
                                    <a href="/updateprofile">
                                        <img src="{{asset("/data-image/userImage/$userProfile->user_image")}}" height="130px" width="auto" style="border-radius: 65px">
                                    </a>
                                @else
                                    <a href="/updateprofile">
                                        <img src="{{asset("/data-image/nullProfile.png")}}" height="130px" width="auto" style="border-radius: 65px">
                                    </a>
                                @endif
                            </div>
                            <div class="col-9 p-0" style="height: 130px;border-right: 0.25px solid #CCCCCC">
                                <div class="row justify-content-between">
                                    <div class="col-10">
                                        <div class="row" style="height: 24px">
                                            @if(isset($userProfile->user_name))
                                                <p class="text-white label-font-Condensed-Regular" style="font-size: 24px">{{$userProfile->user_name}}</p>
                                            @else
                                                <p class="text-white label-font-Condensed-Regular" style="font-size: 24px">ไม่ระบุ</p>
                                            @endif
                                        </div>
                                        <div class="row mt-3">
                                            @if(count($userRole)>0)
                                                @foreach($userRole as $item)
                                                    <div class="box-role d-flex align-items-center mr-2" style="background-color: {{$item['role_color']}}">
                                                        <img src="{{asset($item->game_logo)}}" height="20px" width="20px">
                                                        <label class="text-white ml-1 m-0">{{$item->role_name}}</label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        @if(isset($getTeam))
                                            <div class="row mt-2">
                                                <label class="text-white">Team: <a href="/team/{{$getTeam->team_ID}}" style="color: #CCCCCC;">{{$getTeam->team_name}}</a></label>
                                            </div>
                                        @elseif(isset($myTeam))
                                            <div class="row mt-2">
                                                <label class="text-white">Team: <a href="/team/{{$myTeam->team_ID}}" style="color: #CCCCCC;">{{$myTeam->team_name}}</a></label>
                                            </div>
                                        @else
                                            <div class="row" style="margin-top: 8px">
                                                <label class="text-white">Team: <span>None</span></label>
                                            </div>
                                        @endif

                                        <div class="row">
                                            @if(isset($myUser->user_ID))
                                                @if($id==$myUser->user_ID)
                                                    <div class="col-4 pl-0 pr-0" style="height: 30px">
                                                        <a href="/updateprofile">
                                                            <div class="red-btn text-center pt-2" style="width: 100%;height: 30px;font-size: 12px;font-weight: bold;">
                                                                <p>Update Profile</p>
                                                            </div>
                                                        </a>
                                                    </div>

                                                    @if(isset($getTeam))
                                                        <div class="col-4" style="height: 30px">
                                                            <a href="/team">
                                                                <div class="light-btn text-center pt-2" style="width: 100%;height: 30px;font-size: 12px;font-weight: bold;">
                                                                    <p>Update Team</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @elseif(isset($myTeam))
                                                        <div class="col-4" style="height: 30px">
                                                            <a href="/team">
                                                                <div class="light-btn text-center pt-2" style="width: 100%;height: 30px;font-size: 12px;font-weight: bold;">
                                                                    <p>My Team</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="col-4" style="height: 30px">
                                                            <a href="/createteam">
                                                                <div class="light-btn text-center pt-2" style="width: 100%;height: 30px;font-size: 12px;font-weight: bold;">
                                                                    <p>Create team</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endif

                                                    @if($myUser->tw_username != "")
                                                        <div class="row mx-0">
                                                            <a href="#" data-toggle="modal" data-target="#unlink_tw">
                                                                <div class="col px-1">
                                                                    <i class="fab fa-twitch" style="color: #b38aff;font-size: 30px"></i>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="row mx-0">
                                                            <a href="{{$authorizationUrl}}">
                                                                <div class="col px-1">
                                                                    <i class="fab fa-twitch faa-tada animated" style="color: #666666;font-size: 30px"></i>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endif

                                                    @if($myUser->steam_ID != "")
                                                        <div class="row mx-0">
                                                            <a href="#" data-toggle="modal" data-target="#unlink_steam">
                                                                <div class="col px-1">
                                                                    <i class="fab fa-steam" style="color: #FFFFFF;font-size: 30px"></i>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="row mx-0">
                                                            <a href="#" data-toggle="modal" data-target="#link_steam">
                                                                <div class="col px-1">
                                                                    <i class="fab fa-steam" style="color: #666666;font-size: 30px"></i>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endif

                                                    @if($myUser->battlenet_ID != "")
                                                        <div class="row mx-0">
                                                            <a href="#" data-toggle="modal" data-target="#unlink_battle">
                                                                <div class="col px-1">
                                                                    <i class="fab fa-battle-net" style="color: #3e98ff;font-size: 30px"></i>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="row mx-0">
                                                            <a href="#" data-toggle="modal" data-target="#link_battle">
                                                                <div class="col px-1">
                                                                    <i class="fab fa-battle-net" style="color: #666666;font-size: 30px"></i>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endif
                                                @else
                                                    <form class="col-12 " style="height: auto" action="/profile" method="post">
                                                        @csrf
                                                        <div class="row">
                                                            @if(!isset($myTeam->team_ID))
                                                                <div class="col-4 pl-0">
                                                                    <a href="#" data-toggle="modal" data-target="#invilteModal">
                                                                        <button class="btn red-btn pt-2" style="width: 100%;height: 30px;font-size: 12px;font-weight: bold;">INVITE</button>
                                                                    </a>
                                                                </div>
                                                            @endif
                                                            <div class="col-4 pl-0">
                                                                <button type="submit" class="btn light-btn pt-2 followBtn @if($stateFollow) active @endif" style="width: 100%;height: 30px;font-size: 12px;font-weight: bold;">Follow</button>
                                                            </div>
                                                                <input type="text" name="userInvite" hidden value={{$id}}/>
                                                                <input type="text" name="state" value="2" hidden/>
                                                        </div>
                                                    </form>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-2">
                                        @if(isset($getTeam))
                                            <div class="row mt-2">
                                                <a href="/team/{{$getTeam->team_ID}}">
                                                    <img src="{{asset("/data-image/teamLogos/".$getTeam->team_logo)}}" height="70px" width="70px">
                                                </a>
                                            </div>
                                        @elseif(isset($myTeam))
                                            <div class="row mt-2">
                                                <a href="/team/{{$myTeam->team_ID}}">
                                                    <img src="{{asset("/data-image/teamLogos/".$myTeam->team_logo)}}" height="70px" width="70px">
                                                </a>
                                            </div>
                                        @else
                                            <div class="row mt-2"></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 p-0" style="height: 130px;">
                        <div class="row px-4" style="margin-top: 10%">
                            <div class="col-6">
                                <div class="row text-white pl-4">Age: </div>
                                <div class="row text-white pl-4">Gender: </div>
                                <div class="row text-white pl-4">Language: </div>
                            </div>
                            <div class="col-6">
                                <div class="row text-white">
                                    @if(isset($userProfile->user_birthday))
                                        <span>{{$userProfile->user_birthday}}</span>
                                    @else
                                        <span>ไม่ระบุ</span>
                                    @endif
                                </div>
                                <div class="row text-white">
                                    @if(isset($userProfile->user_gender))
                                        @if($userProfile->user_gender==0)
                                            <span>Male</span>
                                        @else
                                            <span>Female</span>
                                        @endif

                                    @else
                                        <span>ไม่ระบุ</span>
                                    @endif
                                </div>
                                <div class="row text-white">
                                    @if(count($userLanguage)>0)
                                        @foreach($userLanguage as $item)
                                            {{$item->language_name}}
                                        @endforeach
                                    @else
                                        <span>ไม่ระบุ</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex d-md-none">
                    <div class="col-12 p-0" style="height: auto;">
                        <div class="row px-4">
                            <div class="col-12 text-center p-0">
                                @if(isset($userProfile->user_image))
                                    <a href="/updateprofile">
                                        <img src="{{asset("/data-image/userImage/$userProfile->user_image")}}" height="130px" width="auto" style="border-radius: 65px">
                                    </a>
                                @else
                                    <a href="/updateprofile">
                                        <img src="{{asset("/data-image/nullProfile.png")}}" height="130px" width="auto" style="border-radius: 65px">
                                    </a>
                                @endif
                            </div>
                            <div class="col-12 text-center" style="height: 24px">
                                @if(isset($userProfile->user_name))
                                    <h3 class="text-white label-font-Condensed-Regular" style="font-size: 24px">{{$userProfile->user_name}}</h3>
                                @else
                                    <h3 class="text-white label-font-Condensed-Regular" style="font-size: 24px">ไม่ระบุ</h3>
                                @endif
                            </div>
                            <div class="col-12 pb-4" style="height: auto;border-bottom: 0.25px solid #CCCCCC">
                                <div class="row justify-content-between">
                                    <div class="col-12">
                                        <div class="row mt-3">
                                            <div class="col-9">
                                                <div class="row">
                                                    @if(count($userRole)>0)
                                                        @foreach($userRole as $key => $item)
                                                            {{--@if($key == 2)--}}
                                                            {{--@break--}}
                                                            {{--@endif--}}
                                                            <div class="box-role mb-2 d-flex align-items-center mr-2" style="background-color: {{$item['role_color']}}">
                                                                <img src="{{asset($item->game_logo)}}" height="20px" width="20px">
                                                                <label class="text-white ml-1 m-0">{{$item->role_name}}</label>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <p class="text-white label-font-Condensed-Bold">Not Found Role</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-3 p-0">
                                                @if(isset($getTeam))
                                                    <div class="row text-right mt-2">
                                                        <div class="col">
                                                            <a href="/team/{{$getTeam->team_ID}}">
                                                                <img src="{{asset("/data-image/teamLogos/".$getTeam->team_logo)}}" height="auto" width="100%">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @elseif(isset($myTeam))
                                                    <div class="row text-right mt-2">
                                                        <div class="col">
                                                            <a href="/team/{{$myTeam->team_ID}}">
                                                                <img src="{{asset("/data-image/teamLogos/".$myTeam->team_logo)}}" height="auto" width="100%">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="row mt-2"></div>
                                                @endif
                                            </div>
                                        </div>
                                        @if(isset($getTeam))
                                            <div class="row mt-2">
                                                <label class="text-white">Team: <a href="/team/{{$getTeam->team_ID}}" style="color: #CCCCCC;">{{$getTeam->team_name}}</a></label>
                                            </div>
                                        @elseif(isset($myTeam))
                                            <div class="row mt-2">
                                                <label class="text-white">Team: <a href="/team/{{$myTeam->team_ID}}" style="color: #CCCCCC;">{{$myTeam->team_name}}</a></label>
                                            </div>
                                        @else
                                            <div class="row" style="margin-top: 8px">
                                                <label class="text-white">Team: <span>None</span></label>
                                            </div>
                                        @endif

                                        <div class="row">
                                            @if(isset($myUser->user_ID))
                                                @if($id==$myUser->user_ID)
                                                    <div class="col-6 pl-0 pr-0" style="height: 30px">
                                                        <a href="/updateprofile">
                                                            <div class="red-btn text-center pt-2" style="width: 100%;height: 30px;font-size: 12px;font-weight: bold;">
                                                                <p>Update Profile</p>
                                                            </div>
                                                        </a>
                                                    </div>

                                                    @if(isset($getTeam))
                                                        <div class="col-6 pr-0" style="height: 30px">
                                                            <a href="/team">
                                                                <div class="light-btn text-center pt-2" style="width: 100%;height: 30px;font-size: 12px;font-weight: bold;">
                                                                    <p>Update Team</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @elseif(isset($myTeam))
                                                        <div class="col-6 pr-0" style="height: 30px">
                                                            <a href="/team">
                                                                <div class="light-btn text-center pt-2" style="width: 100%;height: 30px;font-size: 12px;font-weight: bold;">
                                                                    <p>My Team</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="col-6 pr-0" style="height: 30px">
                                                            <a href="/createteam">
                                                                <div class="light-btn text-center pt-2" style="width: 100%;height: 30px;font-size: 12px;font-weight: bold;">
                                                                    <p>Create team</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endif

                                                    @if($myUser->tw_username != "")
                                                        <div class="row mt-3 mx-0">
                                                            <a href="#" data-toggle="modal" data-target="#unlink_tw">
                                                                <div class="col px-1">
                                                                    <i class="fab fa-twitch" style="color: #b38aff;font-size: 30px"></i>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="row mt-3 mx-0">
                                                            <a href="#" data-toggle="modal" data-target="#link_tw">
                                                                <div class="col px-1">
                                                                    <i class="fab fa-twitch faa-tada animated" style="color: #666666;font-size: 30px"></i>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endif

                                                    @if($myUser->steam_ID != "")
                                                        <div class="row mt-3 mx-0">
                                                            <a href="#" data-toggle="modal" data-target="#unlink_steam">
                                                                <div class="col px-1">
                                                                    <i class="fab fa-steam" style="color: #FFFFFF;font-size: 30px"></i>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="row mt-3 mx-0">
                                                            <a href="#" data-toggle="modal" data-target="#link_steam">
                                                                <div class="col px-1">
                                                                    <i class="fab fa-steam" style="color: #666666;font-size: 30px"></i>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endif

                                                    @if($myUser->battlenet_ID != "")
                                                        <div class="row mt-3 mx-0">
                                                            <a href="#" data-toggle="modal" data-target="#unlink_battle">
                                                                <div class="col px-1">
                                                                    <i class="fab fa-battle-net" style="color: #3e98ff;font-size: 30px"></i>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="row mt-3 mx-0">
                                                            <a href="#" data-toggle="modal" data-target="#link_battle">
                                                                <div class="col px-1">
                                                                    <i class="fab fa-battle-net" style="color: #666666;font-size: 30px"></i>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endif
                                                @else
                                                    <form class="col-12 " style="height: auto" action="/profile" method="post">
                                                        @csrf
                                                        <div class="row">
                                                            @if(!isset($myTeam->team_ID))
                                                                <div class="col-6 pl-0">
                                                                    <a href="#" data-toggle="modal" data-target="#invilteModal">
                                                                        <button class="btn red-btn pt-2" style="width: 100%;height: 30px;font-size: 12px;font-weight: bold;">INVITE</button>
                                                                    </a>
                                                                </div>
                                                            @endif
                                                            <div class="col-6 pl-0 pr-0">
                                                                <button type="submit" class="btn light-btn pt-2 followBtn @if($stateFollow) active @endif" style="width: 100%;height: 30px;font-size: 12px;font-weight: bold;">Follow</button>
                                                            </div>
                                                            <input type="text" name="userInvite" hidden value={{$id}}/>
                                                            <input type="text" name="state" value="2" hidden/>
                                                        </div>
                                                    </form>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 p-0" style="height: auto;">
                        <div class="row px-4" style="margin-top: 10%">
                            <div class="col-6">
                                <div class="row text-white pl-4">Age: </div>
                                <div class="row text-white pl-4">Gender: </div>
                                <div class="row text-white pl-4">Language: </div>
                            </div>
                            <div class="col-6">
                                <div class="row text-white">
                                    @if(isset($userProfile->user_birthday))
                                        <span>{{$userProfile->user_birthday}}</span>
                                    @else
                                        <span>ไม่ระบุ</span>
                                    @endif
                                </div>
                                <div class="row text-white">
                                    @if(isset($userProfile->user_gender))
                                        @if($userProfile->user_gender==0)
                                            <span>Male</span>
                                        @else
                                            <span>Female</span>
                                        @endif

                                    @else
                                        <span>ไม่ระบุ</span>
                                    @endif
                                </div>
                                <div class="row text-white">
                                    @if(count($userLanguage)>0)
                                        @foreach($userLanguage as $item)
                                            {{$item->language_name}}
                                        @endforeach
                                    @else
                                        <span>ไม่ระบุ</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>