@extends('layouts.sidebar')
@section('content')
        <div class="row mx-0 home-margin-top">
            <div class="col-3 d-none d-md-inline">
                <div class="sticky-top">
                    <div class="row mt-2">
                        <div class="col-12 p-2">
                            <form action="/ApiSearchTeam" method="GET">
                                {{--@csrf--}}
                                <div class="row py-4" style="background-color: rgba(255,255,255,0.1); height: auto; border-radius: 8px">
                                    <div class="d-flex col-12 justify-content-between" style="height: 100%;flex-direction: column">
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($gameList as $item)
                                                    @if($teamList==$item->game_ID)
                                                        <img src="{{asset($item->game_Img) }}" style="height: 60px;width: 100%">
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group mt-3" style="height: 60px;">
                                                    <p class="text-input-label">Game</p>
                                                    <select name="game" id= "game" class="text-select pl-3">
                                                        @foreach($gameList as $item)
                                                            @if($teamList==$item->game_ID)
                                                                <option value="{{$item->game_ID}}" selected>{{$item->game_name}}</option>
                                                            @else
                                                                <option value="{{$item->game_ID}}">{{$item->game_name}}</option>
                                                            @endif
                                                        @endforeach
                                                        {{--<option value="overwatch">Overwatch</option>--}}
                                                        {{--<option value="player unknown battlegrounds">Player unknown battlegrounds</option>--}}
                                                        {{--<option value="league of legends">League of legends</option>--}}
                                                        {{--<option value="dota 2">Dota 2</option>--}}
                                                    </select>
                                                    {{--<input type="text" name="email" placeholder="example@mail.com" class="text-input pl-3">--}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group m-0" style="height: 60px;">
                                                    <p class="text-input-label">Time Played</p>
                                                    <div class="row px-3 justify-content-between">
                                                        <select name="gameTimeStart" id="game" class="col-5 text-select">
                                                            <option value="" selected disabled>Select time</option>
                                                            <option value="00:00">00:00</option>
                                                            <option value="01:00">01:00</option>
                                                            <option value="02:00">02:00</option>
                                                            <option value="03:00">03:00</option>
                                                            <option value="04:00">04:00</option>
                                                            <option value="05:00">05:00</option>
                                                            <option value="06:00">06:00</option>
                                                            <option value="07:00">07:00</option>
                                                            <option value="08:00">08:00</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="10:00">10:00</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="13:00">13:00</option>
                                                            <option value="14:00">14:00</option>
                                                            <option value="15:00">15:00</option>
                                                            <option value="16:00">16:00</option>
                                                            <option value="17:00">17:00</option>
                                                            <option value="18:00">18:00</option>
                                                            <option value="19:00">19:00</option>
                                                            <option value="20:00">20:00</option>
                                                            <option value="21:00">21:00</option>
                                                            <option value="22:00">22:00</option>
                                                            <option value="23:00">23:00</option>
                                                        </select>
                                                        <div class="col-2">
                                                            <p class="text-white" style="text-align: center; padding-top: 10px">To</p>
                                                        </div>
                                                        <select name="gameTimeEnd" id="game" class="col-5 text-select">
                                                            <option value="" selected disabled>Select time</option>
                                                            <option value="00:00">00:00</option>
                                                            <option value="01:00">01:00</option>
                                                            <option value="02:00">02:00</option>
                                                            <option value="03:00">03:00</option>
                                                            <option value="04:00">04:00</option>
                                                            <option value="05:00">05:00</option>
                                                            <option value="06:00">06:00</option>
                                                            <option value="07:00">07:00</option>
                                                            <option value="08:00">08:00</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="10:00">10:00</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="13:00">13:00</option>
                                                            <option value="14:00">14:00</option>
                                                            <option value="15:00">15:00</option>
                                                            <option value="16:00">16:00</option>
                                                            <option value="17:00">17:00</option>
                                                            <option value="18:00">18:00</option>
                                                            <option value="19:00">19:00</option>
                                                            <option value="20:00">20:00</option>
                                                            <option value="21:00">21:00</option>
                                                            <option value="22:00">22:00</option>
                                                            <option value="23:00">23:00</option>
                                                        </select>
                                                    </div>
                                                    {{--<input type="text" name="email" placeholder="example@mail.com" class="text-input pl-3">--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex col-12 justify-content-between mt-3" style="height: 100%;flex-direction: column">
                                        <div class="form-group" style="height: 60px;">
                                            <div class="row">
                                                <h7 class="text-input-label pl-3">Gender</h7>
                                                <span class="member-only pt-2 pl-2">Member</span>
                                            </div>
                                            <div class="row px-3 justify-content-between">
                                                @for($i=0;$i<3;$i++)
                                                    @if(isset($gender))
                                                        @if($gender==$i)
                                                            <label class="text-white d-flex justify-content-center align-items-center label-font-Thin fillter-box radio-active" id="gender{{$i}}">
                                                                @if($i==0)
                                                                    Male
                                                                @elseif($i==1)
                                                                    Female
                                                                @elseif($i==2)
                                                                    All
                                                                @endif
                                                                <input id="genderRadio{{$i}}" type="radio" name="gender" value="{{$i}}" onclick="genderRadio()" hidden checked>
                                                            </label>
                                                        @else
                                                            <label class="text-white d-flex justify-content-center align-items-center label-font-Thin fillter-box" id="gender{{$i}}">
                                                                @if($i==0)
                                                                    Male
                                                                @elseif($i==1)
                                                                    Female
                                                                @elseif($i==2)
                                                                    All
                                                                @endif
                                                                <input id="genderRadio{{$i}}" type="radio" name="gender" value="{{$i}}" onclick="genderRadio()" hidden>
                                                            </label>
                                                        @endif
                                                    @else
                                                        @if($i==2)
                                                            <label class="text-white d-flex justify-content-center align-items-center label-font-Thin fillter-box radio-active" id="gender{{$i}}">
                                                                @if($i==0)
                                                                    Male
                                                                @elseif($i==1)
                                                                    Female
                                                                @elseif($i==2)
                                                                    All
                                                                @endif
                                                                <input id="genderRadio{{$i}}" type="radio" name="gender" value="{{$i}}" onclick="genderRadio()" hidden checked>
                                                            </label>
                                                        @else
                                                            <label class="text-white d-flex justify-content-center align-items-center label-font-Thin fillter-box" id="gender{{$i}}">
                                                                @if($i==0)
                                                                    Male
                                                                @elseif($i==1)
                                                                    Female
                                                                @elseif($i==2)
                                                                    All
                                                                @endif
                                                                <input id="genderRadio{{$i}}" type="radio" name="gender" value="{{$i}}" onclick="genderRadio()" hidden>
                                                            </label>
                                                        @endif
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="form-group" style="height: 60px;">
                                            <div class="row">
                                                <h7 class="text-input-label pl-3">Age</h7>
                                                <span class="member-only pt-2 pl-2">Member</span>
                                            </div>
                                            <select name="age" id="game" class="text-select pl-3">
                                                <option value="">Select age</option>
                                                <option value="18-25" @if($age == "18-25") selected @endif>18 - 25</option>
                                                <option value="26-30" @if($age == "26-30") selected @endif>26 - 30</option>
                                                <option value="31 +" @if($age == "31 +") selected @endif>31 +</option>
                                            </select>
                                        </div>
                                        <div class="form-group" style="height: 60px;">
                                            <div class="row">
                                                <h7 class="text-input-label pl-3">Member</h7>
                                                <span class="member-only pt-2 pl-2">Member</span>
                                            </div>
                                            <div class="row px-3 justify-content-between">
                                                @for($i=0;$i<3;$i++)
                                                    @if(isset($member))
                                                        @if($member==$i)
                                                            <label class="text-white d-flex justify-content-center align-items-center label-font-Thin fillter-box radio-active" id="kill{{$i}}">
                                                                @if($i==0)
                                                                    High
                                                                @elseif($i==1)
                                                                    Low
                                                                @elseif($i==2)
                                                                    None
                                                                @endif
                                                                <input id="killRadio{{$i}}" type="radio" name="member" value="{{$i}}" onclick="killRadio()" hidden checked>
                                                            </label>
                                                        @else
                                                            <label class="text-white d-flex justify-content-center align-items-center label-font-Thin fillter-box" id="kill{{$i}}">
                                                                @if($i==0)
                                                                    High
                                                                @elseif($i==1)
                                                                    Low
                                                                @elseif($i==2)
                                                                    None
                                                                @endif
                                                                <input id="killRadio{{$i}}" type="radio" name="member" value="{{$i}}" onclick="killRadio()" hidden>
                                                            </label>
                                                        @endif
                                                    @else
                                                        @if($i==2)
                                                            <label class="text-white d-flex justify-content-center align-items-center label-font-Thin fillter-box radio-active" id="kill{{$i}}">
                                                                @if($i==0)
                                                                    High
                                                                @elseif($i==1)
                                                                    Low
                                                                @elseif($i==2)
                                                                    None
                                                                @endif
                                                                <input id="killRadio{{$i}}" type="radio" name="member" value="{{$i}}" onclick="killRadio()" hidden checked>
                                                            </label>
                                                        @else
                                                            <label class="text-white d-flex justify-content-center align-items-center label-font-Thin fillter-box" id="kill{{$i}}">
                                                                @if($i==0)
                                                                    High
                                                                @elseif($i==1)
                                                                    Low
                                                                @elseif($i==2)
                                                                    None
                                                                @endif
                                                                <input id="killRadio{{$i}}" type="radio" name="member" value="{{$i}}" onclick="killRadio()" hidden>
                                                            </label>
                                                        @endif
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex col-12 justify-content-between" style="height: 100%;flex-direction: column">
                                        <button type="submit" class="btn btn-primary red-btn label-font-Bold " style="font-size: 16px">Find Team</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{--<div class="col-3 mt-2">--}}
                        {{--<div class="row mx-0" style="height:180px;">--}}
                        {{--<img class="col-12 p-0" src="{{asset('/data-image/null-ads.png') }}" alt="overwatch">--}}
                        {{--</div>--}}
                        {{--<div class="row mt-3">--}}
                        {{--<div class="col-6">--}}
                        {{--<p class="text-white">Sponsor By </p>--}}
                        {{--</div>--}}
                        {{--<div class="col-6">--}}
                        {{--<p class="text-white text-right">xxxxxxxxxxx</p>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-9 align-items-center" style="padding-bottom: 80px">
                <div class="row ml-0 ml-md-3 mr-0 mt-3" style="height: 40px">
                    <div class="col-md-7 pr-0 col-8">
                        <div class="row mt-2 align-items-center">
                            <a href="#" class="d-none d-md-inline">
                                <span class="text-white label-font-Thin" style="font-size: 14px">Player <img src="{{asset('/data-image/arrow-rigth.svg')}}"width="6px" height="10px"></span>
                            </a>
                            <a href="#" class="ml-2">
                                <span class="text-white label-font-Thin" style="font-size: 14px">Search Results <img src="{{asset('/data-image/arrow-rigth.svg')}}"width="6px" height="10px"></span>
                            </a>
                            <a href="#" class="ml-2">
                                <span class="text-white label-font-Bold" style="font-size: 16px">
                                    <img class="d-none d-md-inline" src="{{asset('/data-image/game_logo/overwatch/logo.svg')}}"width="30px" height="30px">
                                    {{$gameSelect->game_name}}
                                </span>
                            </a>
                        </div>
                        <div class="row d-flex d-md-none">
                            <div class="col-12 pl-2 text-left">
                                <span class="text-white label-font-Bold" style="font-size: 13px">{{count($fillter)}} Result</span>
                            </div>
                            <div class="col-6 px-0 d-none">
                                <button type="submit" class="btn btn-primary red-btn label-font-Bold " style="font-size: 12px">Create Announce</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 pt-3 col-4 d-md-none text-right">
                        <i class="fas fa-search text-white" data-toggle="modal" data-target="#exampleModal" style="cursor: pointer;font-size: 20px"></i>
                    </div>
                </div>

                <div class="row mx-0 mt-3" style="height: auto;">
                    @foreach($fillter as $item)
                        <div class="col-md-6 pl-0 pl-md-3 col-12 h-100 mb-3 pr-0">
                            <a href="/team/{{$item->team_ID}}" >
                                <div class="row mx-0 team-box" style=" border-radius: 8px;height: auto;">
                                    <div class="col-12">
                                        <div class="row h-100 align-items-center">
                                            <div class="col-4">
                                                <img src="{{asset('/data-image/teamLogos/'.$item->team_logo)}}" width="100%" height="auto" style="border-radius: 8px">
                                            </div>
                                            <div class="col-8 h-100 pt-4">
                                                <div class="row mr-0">
                                                    <div class="col-8 pl-1">
                                                        <h4 for="" class="text-white label-font-Condensed-Bold threeDot">{{$item->team_name}}</h4>
                                                    </div>
                                                    <div class="col-4 p-0">
                                                        <div class="row align-items-center justify-content-end mx-0 pb-2">
                                                            <img id="teamManReady" class="mr-2" src="{{asset('data-image/standing-up-man.svg')}}" height="24px">
                                                            <p class="label-font-Condensed-Bold text-pink m-0 p-0" id="countInvite" style="font-size: 24px;line-height:0px;">{{$item->count}}/6</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mr-0 align-items-end pt-1" style="height: 50px;">
                                                    @foreach($item->role as $role)
                                                        @if($role->user_ID != null)
                                                            <div class="col p-0 text-center">
                                                                <img src="{{asset('/data-image/role/'.$role->type_image_active)}}" width="auto" height="100%" style="max-height: 30px">
                                                                <p style="color: {{$role->color}};font-size: 10px">{{$role->typeName}}</p>
                                                            </div>
                                                        @else
                                                            <div class="col p-0 text-center">
                                                                <img src="{{asset('/data-image/nullRole.svg')}}" width="auto" height="100%" style="max-height: 30px">
                                                                <p class="text-white" style="font-size: 10px">NONE</p>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                @if(isset($item->warning))
                                                    <div class="row mr-0" style="height: 50px;">
                                                        @foreach($item->warning as $warning)
                                                            <h6><span class="badge text-white mx-1" style="background-color: {{$warning->color}}">NO {{$warning->typeName}}</span></h6>
                                                        @endforeach
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" style="background-color: #212529;border: none">
                        <div class="d-flex justify-content-center">
                            <div class="row mx-0 mt-2">
                                <div class="col-12">
                                    <div class="sticky-top">
                                        <div class="row mt-2">
                                            <div class="col-12 p-2">
                                                <img data-dismiss="modal" src="{{asset('data-image/cancel.svg')}}" width="18px" height="18px" style="cursor: pointer;position: absolute;right: 7px; top: 5px;">
                                                <form action="/ApiSearchTeam" method="GET">
                                                    {{--@csrf--}}
                                                    <div class="row py-4" style="height: auto; border-radius: 8px">
                                                        <div class="d-flex col-12 justify-content-between" style="height: 100%;flex-direction: column">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    @foreach($gameList as $item)
                                                                        @if($teamList==$item->game_ID)
                                                                            <img src="{{asset($item->game_Img) }}" style="height: 60px;width: 100%">
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group mt-3" style="height: 60px;">
                                                                        <p class="text-input-label">Game</p>
                                                                        <select name="game" id= "game" class="text-select pl-3">
                                                                            @foreach($gameList as $item)
                                                                                @if($teamList==$item->game_ID)
                                                                                    <option value="{{$item->game_ID}}" selected>{{$item->game_name}}</option>
                                                                                @else
                                                                                    <option value="{{$item->game_ID}}">{{$item->game_name}}</option>
                                                                                @endif
                                                                            @endforeach
                                                                            {{--<option value="overwatch">Overwatch</option>--}}
                                                                            {{--<option value="player unknown battlegrounds">Player unknown battlegrounds</option>--}}
                                                                            {{--<option value="league of legends">League of legends</option>--}}
                                                                            {{--<option value="dota 2">Dota 2</option>--}}
                                                                        </select>
                                                                        {{--<input type="text" name="email" placeholder="example@mail.com" class="text-input pl-3">--}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group m-0" style="height: 60px;">
                                                                        <p class="text-input-label">Time Played</p>
                                                                        <div class="row px-3 justify-content-between">
                                                                            <select name="gameTimeStart" id="game" class="col-5 text-select">
                                                                                <option value="" selected disabled>Select time</option>
                                                                                <option value="00:00">00:00</option>
                                                                                <option value="01:00">01:00</option>
                                                                                <option value="02:00">02:00</option>
                                                                                <option value="03:00">03:00</option>
                                                                                <option value="04:00">04:00</option>
                                                                                <option value="05:00">05:00</option>
                                                                                <option value="06:00">06:00</option>
                                                                                <option value="07:00">07:00</option>
                                                                                <option value="08:00">08:00</option>
                                                                                <option value="09:00">09:00</option>
                                                                                <option value="10:00">10:00</option>
                                                                                <option value="11:00">11:00</option>
                                                                                <option value="12:00">12:00</option>
                                                                                <option value="13:00">13:00</option>
                                                                                <option value="14:00">14:00</option>
                                                                                <option value="15:00">15:00</option>
                                                                                <option value="16:00">16:00</option>
                                                                                <option value="17:00">17:00</option>
                                                                                <option value="18:00">18:00</option>
                                                                                <option value="19:00">19:00</option>
                                                                                <option value="20:00">20:00</option>
                                                                                <option value="21:00">21:00</option>
                                                                                <option value="22:00">22:00</option>
                                                                                <option value="23:00">23:00</option>
                                                                            </select>
                                                                            <div class="col-2">
                                                                                <p class="text-white" style="text-align: center; padding-top: 10px">To</p>
                                                                            </div>
                                                                            <select name="gameTimeEnd" id="game" class="col-5 text-select">
                                                                                <option value="" selected disabled>Select time</option>
                                                                                <option value="00:00">00:00</option>
                                                                                <option value="01:00">01:00</option>
                                                                                <option value="02:00">02:00</option>
                                                                                <option value="03:00">03:00</option>
                                                                                <option value="04:00">04:00</option>
                                                                                <option value="05:00">05:00</option>
                                                                                <option value="06:00">06:00</option>
                                                                                <option value="07:00">07:00</option>
                                                                                <option value="08:00">08:00</option>
                                                                                <option value="09:00">09:00</option>
                                                                                <option value="10:00">10:00</option>
                                                                                <option value="11:00">11:00</option>
                                                                                <option value="12:00">12:00</option>
                                                                                <option value="13:00">13:00</option>
                                                                                <option value="14:00">14:00</option>
                                                                                <option value="15:00">15:00</option>
                                                                                <option value="16:00">16:00</option>
                                                                                <option value="17:00">17:00</option>
                                                                                <option value="18:00">18:00</option>
                                                                                <option value="19:00">19:00</option>
                                                                                <option value="20:00">20:00</option>
                                                                                <option value="21:00">21:00</option>
                                                                                <option value="22:00">22:00</option>
                                                                                <option value="23:00">23:00</option>
                                                                            </select>
                                                                        </div>
                                                                        {{--<input type="text" name="email" placeholder="example@mail.com" class="text-input pl-3">--}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex col-12 justify-content-between mt-3" style="height: 100%;flex-direction: column">
                                                            <div class="form-group" style="height: 60px;">
                                                                <div class="row">
                                                                    <h7 class="text-input-label pl-3">Gender</h7>
                                                                    <span class="member-only pt-2 pl-2">Member</span>
                                                                </div>
                                                                <div class="row px-3 justify-content-between">
                                                                    @for($i=0;$i<3;$i++)
                                                                        @if(isset($gender))
                                                                            @if($gender==$i)
                                                                                <label class="text-white d-flex justify-content-center align-items-center label-font-Thin fillter-box radio-active" id="gender{{$i}}">
                                                                                    @if($i==0)
                                                                                        Male
                                                                                    @elseif($i==1)
                                                                                        Female
                                                                                    @elseif($i==2)
                                                                                        All
                                                                                    @endif
                                                                                    <input id="genderRadio{{$i}}" type="radio" name="gender" value="{{$i}}" onclick="genderRadio()" hidden checked>
                                                                                </label>
                                                                            @else
                                                                                <label class="text-white d-flex justify-content-center align-items-center label-font-Thin fillter-box" id="gender{{$i}}">
                                                                                    @if($i==0)
                                                                                        Male
                                                                                    @elseif($i==1)
                                                                                        Female
                                                                                    @elseif($i==2)
                                                                                        All
                                                                                    @endif
                                                                                    <input id="genderRadio{{$i}}" type="radio" name="gender" value="{{$i}}" onclick="genderRadio()" hidden>
                                                                                </label>
                                                                            @endif
                                                                        @else
                                                                            @if($i==2)
                                                                                <label class="text-white d-flex justify-content-center align-items-center label-font-Thin fillter-box radio-active" id="gender{{$i}}">
                                                                                    @if($i==0)
                                                                                        Male
                                                                                    @elseif($i==1)
                                                                                        Female
                                                                                    @elseif($i==2)
                                                                                        All
                                                                                    @endif
                                                                                    <input id="genderRadio{{$i}}" type="radio" name="gender" value="{{$i}}" onclick="genderRadio()" hidden checked>
                                                                                </label>
                                                                            @else
                                                                                <label class="text-white d-flex justify-content-center align-items-center label-font-Thin fillter-box" id="gender{{$i}}">
                                                                                    @if($i==0)
                                                                                        Male
                                                                                    @elseif($i==1)
                                                                                        Female
                                                                                    @elseif($i==2)
                                                                                        All
                                                                                    @endif
                                                                                    <input id="genderRadio{{$i}}" type="radio" name="gender" value="{{$i}}" onclick="genderRadio()" hidden>
                                                                                </label>
                                                                            @endif
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="height: 60px;">
                                                                <div class="row">
                                                                    <h7 class="text-input-label pl-3">Age</h7>
                                                                    <span class="member-only pt-2 pl-2">Member</span>
                                                                </div>
                                                                <select name="age" id="game" class="text-select pl-3">
                                                                    <option value="">Select age</option>
                                                                    <option value="18-25" @if($age == "18-25") selected @endif>18 - 25</option>
                                                                    <option value="26-30" @if($age == "26-30") selected @endif>26 - 30</option>
                                                                    <option value="31 +" @if($age == "31 +") selected @endif>31 +</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group" style="height: 60px;">
                                                                <div class="row">
                                                                    <h7 class="text-input-label pl-3">Member</h7>
                                                                    <span class="member-only pt-2 pl-2">Member</span>
                                                                </div>
                                                                <div class="row px-3 justify-content-between">
                                                                    @for($i=0;$i<3;$i++)
                                                                        @if(isset($member))
                                                                            @if($member==$i)
                                                                                <label class="text-white d-flex justify-content-center align-items-center label-font-Thin fillter-box radio-active" id="kill{{$i}}">
                                                                                    @if($i==0)
                                                                                        High
                                                                                    @elseif($i==1)
                                                                                        Low
                                                                                    @elseif($i==2)
                                                                                        None
                                                                                    @endif
                                                                                    <input id="killRadio{{$i}}" type="radio" name="member" value="{{$i}}" onclick="killRadio()" hidden checked>
                                                                                </label>
                                                                            @else
                                                                                <label class="text-white d-flex justify-content-center align-items-center label-font-Thin fillter-box" id="kill{{$i}}">
                                                                                    @if($i==0)
                                                                                        High
                                                                                    @elseif($i==1)
                                                                                        Low
                                                                                    @elseif($i==2)
                                                                                        None
                                                                                    @endif
                                                                                    <input id="killRadio{{$i}}" type="radio" name="member" value="{{$i}}" onclick="killRadio()" hidden>
                                                                                </label>
                                                                            @endif
                                                                        @else
                                                                            @if($i==2)
                                                                                <label class="text-white d-flex justify-content-center align-items-center label-font-Thin fillter-box radio-active" id="kill{{$i}}">
                                                                                    @if($i==0)
                                                                                        High
                                                                                    @elseif($i==1)
                                                                                        Low
                                                                                    @elseif($i==2)
                                                                                        None
                                                                                    @endif
                                                                                    <input id="killRadio{{$i}}" type="radio" name="member" value="{{$i}}" onclick="killRadio()" hidden checked>
                                                                                </label>
                                                                            @else
                                                                                <label class="text-white d-flex justify-content-center align-items-center label-font-Thin fillter-box" id="kill{{$i}}">
                                                                                    @if($i==0)
                                                                                        High
                                                                                    @elseif($i==1)
                                                                                        Low
                                                                                    @elseif($i==2)
                                                                                        None
                                                                                    @endif
                                                                                    <input id="killRadio{{$i}}" type="radio" name="member" value="{{$i}}" onclick="killRadio()" hidden>
                                                                                </label>
                                                                            @endif
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex col-12 justify-content-between" style="height: 100%;flex-direction: column">
                                                            <button type="submit" class="btn btn-primary red-btn label-font-Bold " style="font-size: 16px">Find Team</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            {{--<div class="col-3 mt-2">--}}
                                            {{--<div class="row mx-0" style="height:180px;">--}}
                                            {{--<img class="col-12 p-0" src="{{asset('/data-image/null-ads.png') }}" alt="overwatch">--}}
                                            {{--</div>--}}
                                            {{--<div class="row mt-3">--}}
                                            {{--<div class="col-6">--}}
                                            {{--<p class="text-white">Sponsor By </p>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-6">--}}
                                            {{--<p class="text-white text-right">xxxxxxxxxxx</p>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--<div class="row mt-2 align-items-center">--}}
            {{--<a href="#">--}}
            {{--<p class="text-white label-font-Thin" style="font-size: 14px">Player <img src="{{asset('/data-image/arrow-rigth.svg')}}"width="6px" height="10px"></p>--}}
            {{--</a>--}}
            {{--<a href="#" class="ml-2">--}}
            {{--<p class="text-white label-font-Thin" style="font-size: 14px">Search Results <img src="{{asset('/data-image/arrow-rigth.svg')}}"width="6px" height="10px"></p>--}}
            {{--</a>--}}
            {{--<a href="#" class="ml-2">--}}
            {{--<p class="text-white label-font-Bold" style="font-size: 16px">--}}
            {{--<img src="{{asset('/data-image/game_logo/overwatch/logo.svg')}}"width="30px" height="30px">--}}
            {{--{{$gameSelect->game_name}}--}}
            {{--</p>--}}
            {{--</a>--}}
            {{--</div>--}}
            {{--<div class="row mt-2">--}}
            {{--<div class="col align-self-end"></div>--}}
            {{--<p class="text-white label-font-Bold" style="font-size: 13px">{{count($listPlayer)}} Result</p>--}}
            {{--</div>--}}

            {{--<div class="row">--}}
            {{--@include('includes.playerList')--}}
            {{--</div>--}}
    </div>
@stop