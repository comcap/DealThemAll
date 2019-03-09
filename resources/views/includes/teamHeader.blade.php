<div class="row">
    <div class="col-12 mt-2">
        <div class="row p-4" style="background-color: rgba(255,255,255,0.1);border-radius: 8px">
            <div class="col-12 px-4" style="height: auto">
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
                                                <label class="text-white">Owner: <span style="color:#aaaaaa;">{{$getTeam->user_name}}</span></label>
                                            @else
                                                <label class="text-white">Owner: <span style="color:#aaaaaa;">ไม่ระบุ</span></label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if($TeamOwner)
                                    <div class="row">
                                        <div class="col-4 pl-0" style="height: 30px">
                                            <a href="#" data-toggle="modal" data-target="#editTeam">
                                                <div class="light-btn text-center pt-2" style="width: 100%;height: 30px;font-size: 12px;font-weight: bold;">
                                                    <p>Edit team</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endif
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

        </div>
    </div>
</div>