<div class="row">
    <div class="col-12 mt-2">
        <div class="row p-4" style="background-color: rgba(255,255,255,0.1); height: 220px; border-radius: 8px">
            <div class="col-12 px-4" style="height: 40px">
                <div class="row">
                    @if($id==$myUser->user_ID)
                        <label class="text-white label-font-Bold" style="font-size: 18px;">PROFILE</label>
                        <a href="/ApiLogout"><img src="{{asset('data-image/power-button-off.svg')}}" style="width: 16px;height: 16px;position: absolute;right: 1px;"></a>
                    @else
                        <label class="text-white label-font-Bold" style="font-size: 18px;">PLAYER</label>
                    @endif
                </div>
                <div class="row">
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
                                                <label class="text-white">Team: <span style="color: #CCCCCC;">{{$getTeam->team_name}}</span></label>
                                            </div>
                                        @elseif(isset($myTeam))
                                            <div class="row mt-2">
                                                <label class="text-white">Team: <span style="color: #CCCCCC;">{{$myTeam->team_name}}</span></label>
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
                                                @else
                                                    <form class="col-12 " style="height: auto" action="/profile" method="post">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-4 pl-0">
                                                                <button type="submit" name="invilte" value=1 class="btn red-btn pt-2" style="width: 100%;height: 30px;font-size: 12px;font-weight: bold;">INVITE</button>
                                                            </div>
                                                            <div class="col-4">
                                                                <button type="submit" name="follow" value=1 class="btn light-btn pt-2" style="width: 100%;height: 30px;font-size: 12px;font-weight: bold;">Follow</button>
                                                            </div>
                                                            <input type="text" name="userInvite" hidden value={{$id}}>
                                                        </div>
                                                    </form>
                                                @endif
                                            @else
                                                <div class="col-6 pl-0 pr-4" style="height: 30px">
                                                    <a href="#">
                                                        <div class="red-btn text-center pt-2" style="width: 100%;height: 30px">
                                                            <p>INVITE</p>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-6 pr-4" style="height: 30px">
                                                    <a href="#">
                                                        <div class="light-btn text-center pt-2" style="width: 100%;height: 30px;">
                                                            <p>Follow</p>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        @if(isset($getTeam))
                                            <div class="row mt-2">
                                                <img src="{{asset("/data-image/teamLogos/".$getTeam->team_logo)}}" height="70px" width="70px">
                                            </div>
                                        @elseif(isset($myTeam))
                                            <div class="row mt-2">
                                                <img src="{{asset("/data-image/teamLogos/".$myTeam->team_logo)}}" height="70px" width="70px">
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
                                <div class="row text-white pl-4">Birthday: </div>
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