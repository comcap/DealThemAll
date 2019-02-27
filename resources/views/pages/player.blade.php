@extends('layouts.sidebar')
@section('content')
    <div id="box-item" class="container-fluid">

        <div class="row mt-2">
            <div class="col-9 p-2">
                <form action="/ApiSearch" method="POST">
                    @csrf
                    <div class="row p-2 py-4" style="background-color: rgba(255,255,255,0.1); height: 230px; border-radius: 8px">
                        <div class="d-flex col-4 justify-content-between" style="height: 100%;flex-direction: column">
                            <div class="row">
                                <div class="col-12">
                                    @foreach($gameList as $item)
                                        @if($id==$item->game_ID)
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
                                                @if($id==$item->game_ID)
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
                                            <select name="gameTimeStart" id="game" class="col-4 text-select">
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
                                            <div class="col-4">
                                                <p class="text-white" style="text-align: center; padding-top: 10px">To</p>
                                            </div>
                                            <select name="gameTimeEnd" id="game" class="col-4 text-select">
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
                        <div class="d-flex col-4 justify-content-between" style="height: 100%;flex-direction: column">
                            <div class="form-group m-0" style="height: 60px;">
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
                            <div class="form-group m-0" style="height: 60px;">
                                <div class="row">
                                    <h7 class="text-input-label pl-3">Age</h7>
                                    <span class="member-only pt-2 pl-2">Member</span>
                                </div>
                                <select name="age" id="game" class="text-select pl-3">
                                    <option value="18-25">18 - 25</option>
                                    <option value="26-30">26 - 30</option>
                                    <option value="31 +">31 +</option>
                                </select>
                            </div>
                            <div class="form-group m-0" style="height: 60px;">
                                <div class="row">
                                    <h7 class="text-input-label pl-3">Kill</h7>
                                    <span class="member-only pt-2 pl-2">Member</span>
                                </div>
                                <div class="row px-3 justify-content-between">
                                    @for($i=0;$i<3;$i++)
                                        @if(isset($kill))
                                            @if($kill==$i)
                                                <label class="text-white d-flex justify-content-center align-items-center label-font-Thin fillter-box radio-active" id="kill{{$i}}">
                                                    @if($i==0)
                                                        High
                                                    @elseif($i==1)
                                                        Low
                                                    @elseif($i==2)
                                                        None
                                                    @endif
                                                    <input id="killRadio{{$i}}" type="radio" name="kill" value="{{$i}}" onclick="killRadio()" hidden checked>
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
                                                    <input id="killRadio{{$i}}" type="radio" name="kill" value="{{$i}}" onclick="killRadio()" hidden>
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
                                                    <input id="killRadio{{$i}}" type="radio" name="kill" value="{{$i}}" onclick="killRadio()" hidden checked>
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
                                                    <input id="killRadio{{$i}}" type="radio" name="kill" value="{{$i}}" onclick="killRadio()" hidden>
                                                </label>
                                            @endif
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <div class="d-flex col-4 justify-content-between" style="height: 100%;flex-direction: column">
                            <div class="form-group m-0" style="height: 60px;">
                                <div class="row">
                                    <h7 class="text-input-label pl-3">Accuracy</h7>
                                    <span class="member-only pt-2 pl-2">Member</span>
                                </div>
                                <div class="row px-3 justify-content-between">
                                    @for($i=0;$i<3;$i++)
                                        @if(isset($accuracy))
                                            @if($accuracy==$i)
                                                <label class="text-white d-flex justify-content-center align-items-center fillter-box radio-active" id="accuracy{{$i}}">
                                                    @if($i==0)
                                                        High
                                                    @elseif($i==1)
                                                        Low
                                                    @elseif($i==2)
                                                        None
                                                    @endif
                                                    <input id="accuracyRadio{{$i}}" type="radio" name="accuracy" value="{{$i}}" onclick="accuracyRadio()" hidden checked>
                                                </label>
                                            @else
                                                <label class="text-white d-flex justify-content-center align-items-center fillter-box" id="accuracy{{$i}}">
                                                    @if($i==0)
                                                        High
                                                    @elseif($i==1)
                                                        Low
                                                    @elseif($i==2)
                                                        None
                                                    @endif
                                                    <input id="accuracyRadio{{$i}}" type="radio" name="accuracy" value="{{$i}}" onclick="accuracyRadio()" hidden>
                                                </label>
                                            @endif
                                        @else
                                            @if($i==2)
                                                <label class="text-white d-flex justify-content-center align-items-center fillter-box radio-active" id="accuracy{{$i}}">
                                                    @if($i==0)
                                                        High
                                                    @elseif($i==1)
                                                        Low
                                                    @elseif($i==2)
                                                        None
                                                    @endif
                                                    <input id="accuracyRadio{{$i}}" type="radio" name="accuracy" value="{{$i}}" onclick="accuracyRadio()" hidden checked>
                                                </label>
                                            @else
                                                <label class="text-white d-flex justify-content-center align-items-center fillter-box" id="accuracy{{$i}}">
                                                    @if($i==0)
                                                        High
                                                    @elseif($i==1)
                                                        Low
                                                    @elseif($i==2)
                                                        None
                                                    @endif
                                                    <input id="accuracyRadio{{$i}}" type="radio" name="accuracy" value="{{$i}}" onclick="accuracyRadio()" hidden>
                                                </label>
                                            @endif
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <div class="form-group m-0" style="height: 60px;">
                                <div class="row">
                                    <h7 class="text-input-label pl-3">Game Won</h7>
                                    <span class="member-only pt-2 pl-2">Member</span>
                                </div>
                                <div class="row px-3 justify-content-between">
                                    @for($i=0;$i<3;$i++)
                                        @if(isset($won))
                                            @if($won==$i)
                                                <label class="text-white d-flex justify-content-center align-items-center fillter-box radio-active" id="won{{$i}}">
                                                    @if($i==0)
                                                        High
                                                    @elseif($i==1)
                                                        Low
                                                    @elseif($i==2)
                                                        None
                                                    @endif
                                                    <input id="wonRadio{{$i}}" type="radio" name="won" value="{{$i}}" onclick="wonRadio()" hidden checked>
                                                </label>
                                            @else
                                                <label class="text-white d-flex justify-content-center align-items-center fillter-box" id="won{{$i}}">
                                                    @if($i==0)
                                                        High
                                                    @elseif($i==1)
                                                        Low
                                                    @elseif($i==2)
                                                        None
                                                    @endif
                                                    <input id="wonRadio{{$i}}" type="radio" name="won" value="{{$i}}" onclick="wonRadio()" hidden>
                                                </label>
                                            @endif
                                        @else
                                            @if($i==2)
                                                <label class="text-white d-flex justify-content-center align-items-center fillter-box radio-active" id="won{{$i}}">
                                                    @if($i==0)
                                                        High
                                                    @elseif($i==1)
                                                        Low
                                                    @elseif($i==2)
                                                        None
                                                    @endif
                                                    <input id="wonRadio{{$i}}" type="radio" name="won" value="{{$i}}" onclick="wonRadio()" hidden checked>
                                                </label>
                                            @else
                                                <label class="text-white d-flex justify-content-center align-items-center fillter-box" id="won{{$i}}">
                                                    @if($i==0)
                                                        High
                                                    @elseif($i==1)
                                                        Low
                                                    @elseif($i==2)
                                                        None
                                                    @endif
                                                    <input id="wonRadio{{$i}}" type="radio" name="won" value="{{$i}}" onclick="wonRadio()" hidden>
                                                </label>
                                            @endif
                                        @endif
                                    @endfor
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary red-btn label-font-Bold " style="font-size: 16px">Find a Player</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-3 mt-2">
                <div class="row mx-0" style="height:180px;">
                    <img class="col-12 p-0" src="{{asset('/data-image/null-ads.png') }}" alt="overwatch">
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <p class="text-white">Sponsor By </p>
                    </div>
                    <div class="col-6">
                        <p class="text-white text-right">xxxxxxxxxxx</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2 align-items-center">
            <a href="#">
                <p class="text-white label-font-Thin" style="font-size: 14px">Player <img src="{{asset('/data-image/arrow-rigth.svg')}}"width="6px" height="10px"></p>
            </a>
            <a href="#" class="ml-2">
                <p class="text-white label-font-Thin" style="font-size: 14px">Search Results <img src="{{asset('/data-image/arrow-rigth.svg')}}"width="6px" height="10px"></p>
            </a>
            <a href="#" class="ml-2">
                <p class="text-white label-font-Bold" style="font-size: 16px">
                    <img src="{{asset('/data-image/game_logo/overwatch/logo.svg')}}"width="30px" height="30px">
                    {{$gameSelect->game_name}}
                </p>
            </a>
        </div>
        <div class="row">
            <div class="col-12 p-2">
                <div class="row p-4" style="background-color: rgba(255,255,255,0.1); height: 400px; border-radius: 8px">
                    <p class="text-white label-font-Bold">Recommended</p>
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">
                                    @for($i=0;$i<3;$i++)
                                        @include('includes.recommentItem')
                                    @endfor
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    @for($i=0;$i<3;$i++)
                                        @include('includes.recommentItem')
                                    @endfor
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    @for($i=0;$i<3;$i++)
                                        @include('includes.recommentItem')
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" style="width: 5%" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" style="width: 5%" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col align-self-end"></div>
            <p class="text-white label-font-Bold" style="font-size: 13px">{{count($listPlayer)}} Result</p>
        </div>
        <div class="row">
                @include('includes.playerList')
        </div>
    </div>
@stop