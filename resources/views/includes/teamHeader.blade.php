<div class="row mx-0 mx-md">
    <div class="col-12 mt-2">
        <div class="row p-4" style="background-color: rgba(255,255,255,0.1);border-radius: 8px">
            <div class="col-12 d-none d-md-inline px-4" style="height: auto">
                <div class="row">
                    <label class="text-white label-font-Bold" style="font-size: 18px;">TEAM</label>
                </div>
                <div class="row">
                    <div class="col-8 p-0" style="height: 130px;">
                        <div class="row px-4">
                            <div class="col-3 p-0">
                                @if($getTeam->team_logo)
                                    <img src="{{asset("/data-image/teamLogos/".$getTeam->team_logo)}}" height="130px" width="auto" style="border-radius: 65px">
                                @else
                                    <img src="{{asset("/data-image/nullProfile.png")}}" height="130px" width="auto" style="border-radius: 65px">
                                @endif
                            </div>
                            <div class="col-9 pt-3" style="height: 130px;border-right: 0.25px solid #CCCCCC">
                                <div class="row">
                                    <div class="col">
                                        <div class="row" style="height: 24px">
                                            @if($getTeam)
                                                <p class="text-white label-font-Condensed-Regular" style="font-size: 24px">{{$getTeam->team_name}}</p>
                                            @else
                                                <p class="text-white label-font-Condensed-Regular" style="font-size: 24px">ไม่ระบุ</p>
                                            @endif
                                        </div>
                                        <div class="row mt-2">
                                            @if($getTeam)
                                                <label class="text-white">Owner: <a href="/profile/{{$getTeam->user_ID}}" style="color:#aaaaaa;">{{$getTeam->user_name}}</a></label>
                                            @else
                                                <label class="text-white">Owner: <span style="color:#aaaaaa;">ไม่ระบุ</span></label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    @if($TeamOwner)
                                        <div class="col-4 pl-0" style="height: 30px">
                                            <a href="#" data-toggle="modal" data-target="#editTeam">
                                                <div class="light-btn text-center pt-2" style="width: 100%;height: 30px;font-size: 12px;font-weight: bold;">
                                                    <p>Edit team</p>
                                                </div>
                                            </a>
                                        </div>
                                    @else
                                        <div class="col pl-0">
                                            <div class="row mx-0">
                                                @if(!$statePlayer)
                                                    <div class="col-4 pl-0">
                                                        <a href="#" data-toggle="modal" data-target="#ApplyModal">
                                                            <button class="btn red-btn pt-2" name="teamApply" value="{{$teamManager}}" style="width: 100%;height: 30px;font-size: 12px;font-weight: bold;">Apply</button>
                                                        </a>
                                                    </div>
                                                @endif
                                                <form class="col-4" style="height: auto" action="/followTeam" method="post">
                                                    @csrf
                                                    <div class="w-100 px-0">
                                                        <button type="submit" class="btn light-btn pt-2 followBtn @if($stateFollow) active @endif" name="teamFollow" value="{{$teamManager}}" style="width: 100%;height: 30px;font-size: 12px;font-weight: bold;">Follow</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 p-0" style="height: 130px;">
                        <div class="row px-4" >
                            <div class="col-6">
                                <div class="row text-white pl-4 mt-3"><img src="{{asset('data-image/member.svg')}}" width="20px" height="20px" class="mr-2">Member: </div>
                                <div class="row text-white pl-4 mt-3"><img src="{{asset('data-image/time.svg')}}" width="20px" height="20px" class="mr-2">Time practice: </div>
                                <div class="row text-white pl-4 mt-3"><img src="{{asset('data-image/language.svg')}}" width="20px" height="20px" class="mr-2">Language: </div>
                            </div>
                            <div class="col-6">
                                <div class="row text-white pl-4 mt-3" style="height: 22px;">
                                    @if($getTeam)
                                        <span>{{count($result)}}</span>
                                    @else
                                        <span>ไม่ระบุ</span>
                                    @endif
                                </div>
                                <div class="row text-white pl-4 mt-3" style="height: 22px;">
                                    @if($getTeam)
                                        <span>{{$getTeam->team_time_start}}-{{$getTeam->team_time_end}}</span>
                                    @else
                                        <span>ไม่ระบุ</span>
                                    @endif
                                </div>
                                <div class="row text-white pl-4 mt-3" style="height: 22px;">
                                    @if($getTeam)
                                        <span>{{$getTeam->team_language}}</span>
                                    @else
                                        <span>ไม่ระบุ</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 d-inline d-md-none px-4" style="height: auto">
                <div class="row">
                    <label class="text-white label-font-Bold" style="font-size: 18px;">TEAM</label>
                </div>
                <div class="row">
                    <div class="col-12 col-md-8 p-0" style="height: auto;">
                        <div class="row px-4">
                            <div class="col-12 col-md-3 p-0 text-center text-md-left">
                                @if($getTeam->team_logo)
                                    <img src="{{asset("/data-image/teamLogos/".$getTeam->team_logo)}}" height="130px" width="auto" style="border-radius: 65px">
                                @else
                                    <img src="{{asset("/data-image/nullProfile.png")}}" height="130px" width="auto" style="border-radius: 65px">
                                @endif
                                @if($getTeam)
                                    <h4 class="text-white label-font-Condensed-Regular" style="font-size: 24px">{{$getTeam->team_name}}</h4>
                                @else
                                    <h4 class="text-white label-font-Condensed-Regular" style="font-size: 24px">ไม่ระบุ</h4>
                                @endif
                                @if($getTeam)
                                    <label class="text-white">Owner: <a href="/profile/{{$getTeam->user_ID}}" style="color:#aaaaaa;">{{$getTeam->user_name}}</a></label>
                                @else
                                    <label class="text-white">Owner: <span style="color:#aaaaaa;">ไม่ระบุ</span></label>
                                @endif
                            </div>
                            <div class="col-12 col-md-9 pt-3 pb-4" style="height: auto;border-bottom: 0.25px solid #CCCCCC">
                                <div class="row">
                                    @if($TeamOwner)
                                        <div class="col-12 px-0" style="height: 30px">
                                            <a href="#" data-toggle="modal" data-target="#editTeam">
                                                <div class="light-btn text-center pt-2" style="width: 100%;height: 30px;font-size: 12px;font-weight: bold;">
                                                    <p>Edit team</p>
                                                </div>
                                            </a>
                                        </div>
                                    @else
                                        <form class="w-100" style="height: auto" action="/followTeam" method="post">
                                            @csrf
                                            <div class="col-6 pl-0">
                                                <button type="submit" class="btn light-btn pt-2" name="teamApply" value="{{$teamManager}}" style="width: 100%;height: 30px;font-size: 12px;font-weight: bold;">Apply</button>
                                            </div>
                                            <div class="col-6 pl-0">
                                                <button type="submit" class="btn light-btn pt-2 followBtn @if($stateFollow) active @endif" name="teamFollow" value="{{$teamManager}}" style="width: 100%;height: 30px;font-size: 12px;font-weight: bold;">Follow</button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 p-0" style="height: auto;">
                        <div class="row px-4" >
                            <div class="col-6 pr-0">
                                <div class="row text-white mt-3"><img src="{{asset('data-image/member.svg')}}" width="20px" height="20px" class="mr-2">Member: </div>
                                <div class="row text-white mt-3"><img src="{{asset('data-image/time.svg')}}" width="20px" height="20px" class="mr-2">Time practice: </div>
                                <div class="row text-white mt-3"><img src="{{asset('data-image/language.svg')}}" width="20px" height="20px" class="mr-2">Language: </div>
                            </div>
                            <div class="col-6 pr-0">
                                <div class="row text-white pl-4 mt-3" style="line-height: 22px;height: 22px;">
                                    @if($getTeam)
                                        <span style="font-size: 12px">{{count($result)}}</span>
                                    @else
                                        <span>ไม่ระบุ</span>
                                    @endif
                                </div>
                                <div class="row text-white pl-4 mt-3" style="line-height: 14px;height: 22px;">
                                    @if($getTeam)
                                        <span style="font-size: 12px">{{$getTeam->team_time_start}}-{{$getTeam->team_time_end}}</span>
                                    @else
                                        <span>ไม่ระบุ</span>
                                    @endif
                                </div>
                                <div class="row text-white pl-4 mt-3" style="line-height: 22px;height: 22px;">
                                    @if($getTeam)
                                        <span style="font-size: 12px">{{$getTeam->team_language}}</span>
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