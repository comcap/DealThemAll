@extends('layouts.sidebar')
@section('content')
    <div id="box-item" class="container-fluid mt-2 d-flex align-items-center" style="height: 100vh">
        <div class="row mt-2">
            <div class="col-12 p-2">
                <form action="" method="PUT" enctype="multipart/form-data">
                    @csrf
                    <div class="row p-2 py-4"
                         style="background-color: rgba(255,255,255,0.1);  border-radius: 8px">
                        <div class="col-3" style="height: 100%;flex-direction: column">
                            <p class="text-white label-font-Bold">Edit Team</p>
                            <div class="row">
                                <div class="col-4">
                                    <div class="">
                                        <div style="background-color: rgba(0,0,0,0.25); width: 200px;height: 200px;">
                                            <img id="imagePreview" src="{{asset("/data-image/nullTeam.svg")}}" height="200" width="auto" style="cursor: pointer" onclick="document.getElementById('file').click();">
                                            <input onchange="previewFile()" type="file" style="display:none;" id="file" name="file" accept="image/*"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--<div class="offset-1"></div>--}}
                        <div class="col-8">
                            <div class="row">
                                <div class="col-6">
                                    <p class="text-input-label">Name Team</p>
                                    <div class="form-group mt-2">
                                        <input type="text" name="nameTeam" placeholder="Example" class="text-input pl-3" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <p class="text-input-label pl-0">Practice time</p>
                                    <div class="form-group mt-2">
                                        <div class="row px-3">
                                            <select name="timeStart" id="game" class="text-select pl-3 col-5" style="height: 40px" required>
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
                                            <p class="col-2 text-center label-font-Bold text-white pt-2">To</p>
                                            <select name="timeEnd" id="game" class="text-select pl-3 col-5" style="height: 40px" required>
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
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-input-label">Language</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <select name="language1" id="game" class="text-select pl-3" style="height: 40px" required>
                                            @if(isset($userLanguage[0]))
                                                <option value="{{$userLanguage[0]->languageID}}">{{$userLanguage[0]->language_name}}</option>
                                                @foreach($language as $item)
                                                    <option value="{{$item->languageID}}">{{$item->language_name}}</option>
                                                @endforeach
                                            @else
                                                <option value="" selected disabled>Select Language</option>
                                                @foreach($language as $item)
                                                    <option value="{{$item->languageID}}">{{$item->language_name}}</option>
                                                @endforeach
                                                {{--<option value="ไม่พบข้อมูล">ไม่พบข้อมูล</option>--}}
                                            @endif
                                        </select>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <p class="text-input-label"></p>
                                        <select name="language2" id="game" class="text-select pl-3" style="height: 40px">
                                            @if(isset($userLanguage[0]))
                                                <option value="{{$userLanguage[0]->languageID}}">{{$userLanguage[0]->language_name}}</option>
                                                @foreach($language as $item)
                                                    <option value="{{$item->languageID}}">{{$item->language_name}}</option>
                                                @endforeach
                                            @else
                                                <option value="" selected disabled>Select Language</option>
                                                @foreach($language as $item)
                                                    <option value="{{$item->languageID}}">{{$item->language_name}}</option>
                                                @endforeach
                                                {{--<option value="ไม่พบข้อมูล">ไม่พบข้อมูล</option>--}}
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mt-2">
                                        <p class="text-input-label"></p>
                                        <select name="language3" id="game" class="text-select pl-3" style="height: 40px">
                                            @if(isset($userLanguage[0]))
                                                <option value="{{$userLanguage[0]->languageID}}">{{$userLanguage[0]->language_name}}</option>
                                                @foreach($language as $item)
                                                    <option value="{{$item->languageID}}">{{$item->language_name}}</option>
                                                @endforeach
                                            @else
                                                <option value="" selected disabled>Select Language</option>
                                                @foreach($language as $item)
                                                    <option value="{{$item->languageID}}">{{$item->language_name}}</option>
                                                @endforeach
                                                {{--<option value="ไม่พบข้อมูล">ไม่พบข้อมูล</option>--}}
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <div class="row justify-content-center" style="height: 0px">
                                <input type="text" id="invitePlayer" name="invitePlayer" value="" hidden>
                                <button type="submit" class="col-4 mr-3 btn btn-primary red-btn">Save</button>
                                <button type="reset" class="col-4 ml-3 btn btn-secondary light-btn">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop