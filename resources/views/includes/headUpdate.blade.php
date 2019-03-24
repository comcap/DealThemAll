<div class="row">
    <div class="col-12 mt-2">
        <div class="row p-4" style="background-color: rgba(255,255,255,0.1); height: auto; border-radius: 8px">
            <div class="col-12 px-4" style="height: auto">
                {{--<div class="row">--}}
                {{--<label class="text-white label-font-Bold" style="font-size: 18px;">PLAYER</label>--}}
                {{--</div>--}}
                <div class="row align-items-center">
                    <a href="/profile">
                        <p class="text-white label-font-Thin" style="font-size: 14px">PROFILE <img src="{{asset('/data-image/arrow-rigth.svg')}}"width="6px" height="10px"></p></a>
                    <a href="#" class="ml-2">
                        <p class="text-white label-font-Bold" style="font-size: 16px">PLAYER</p>
                    </a>
                </div>
                <div class="row">
                    <div class="col-12 p-0" style="height: auto;">
                        <form action="{{$userProfile->user_ID}}" id="formInput" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row px-4">
                                <div class="col-2 p-0">
                                    @if($userProfile->user_image)
                                        <img id="imagePreview" src="{{asset("/data-image/userImage/$userProfile->user_image")}}" height="180px" width="180px" style="border-radius: 90px">
                                    @else
                                        <img id="imagePreview" src="{{asset("/data-image/userImage/nullProfile.png")}}" height="180px" width="180px" style="border-radius: 90px">
                                    @endif
                                    {{--<button class="light-btn mt-3" style="height: 36px">Upload Image</button>--}}
                                    <input class="light-btn mt-3" type="button" id="loadFileXml" value="Upload Image"onclick="document.getElementById('file').click();" />
                                    <input onchange="previewFile()" type="file" style="display:none;" id="file" name="file"/>
                                </div>
                                <div class="col-10">
                                    <div class="row">
                                        <div class="col-6" style="height: auto">
                                            <div class="form-group">
                                                <p class="text-input-label">Username</p>
                                                <input type="text" name="username" placeholder="Example" class="text-input pl-3" value="{{$userProfile->user_name}}">
                                            </div>

                                            <div class="form-group">
                                                <p class="text-input-label">Language</p>
                                                <select name="language1" id="game" class="text-select pl-3" style="height: 40px;">
                                                    @if(isset($userLanguage[0]))
                                                        <option value="{{$userLanguage[0]->languageID}}">{{$userLanguage[0]->language_name}}</option>
                                                        @foreach($language as $item)
                                                            <option value="{{$item->languageID}}">{{$item->language_name}}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="null">Select Language</option>
                                                        @foreach($language as $item)
                                                            <option value="{{$item->languageID}}">{{$item->language_name}}</option>
                                                        @endforeach
                                                        {{--<option value="ไม่พบข้อมูล">ไม่พบข้อมูล</option>--}}
                                                    @endif
                                                </select>
                                                {{--<input type="password" name="password" placeholder="••••••••••••••" class="text-input pl-3">--}}
                                            </div>

                                            {{--<div class="form-group">--}}
                                                {{--<select name="language2" id="game" class="text-select pl-3" style="height: 40px;">--}}
                                                    {{--@if(isset($userLanguage[1]))--}}
                                                        {{--<option value="{{$userLanguage[1]->languageID}}">{{$userLanguage[1]->language_name}}</option>--}}
                                                        {{--@foreach($language as $item)--}}
                                                            {{--<option value="{{$item->languageID}}">{{$item->language_name}}</option>--}}
                                                        {{--@endforeach--}}
                                                    {{--@else--}}
                                                        {{--<option value="null">Select Language</option>--}}
                                                        {{--@foreach($language as $item)--}}
                                                            {{--<option value="{{$item->languageID}}">{{$item->language_name}}</option>--}}
                                                        {{--@endforeach--}}
                                                    {{--@endif--}}
                                                {{--</select>--}}
                                                {{--<input type="password" name="password" placeholder="••••••••••••••" class="text-input pl-3">--}}
                                            {{--</div>--}}

                                            <div class="form-group mt-2">
                                                <p class="text-input-label pl-0">Practice time</p>
                                                <div class="row px-3">
                                                    <select name="timeStart" class="text-select pl-3 col-5" style="height: 40px;" required>
                                                        <option value="00:00" <?php if ("00:00:00"==$userProfile->team_time_start){echo "selected";}?> >00:00</option>
                                                        <option value="01:00" <?php if ("01:00:00"==$userProfile->team_time_start){echo "selected";}?> >01:00</option>
                                                        <option value="02:00" <?php if ("02:00:00"==$userProfile->team_time_start){echo "selected";}?> >02:00</option>
                                                        <option value="03:00" <?php if ("03:00:00"==$userProfile->team_time_start){echo "selected";}?> >03:00</option>
                                                        <option value="04:00" <?php if ("04:00:00"==$userProfile->team_time_start){echo "selected";}?> >04:00</option>
                                                        <option value="05:00" <?php if ("05:00:00"==$userProfile->team_time_start){echo "selected";}?> >05:00</option>
                                                        <option value="06:00" <?php if ("06:00:00"==$userProfile->team_time_start){echo "selected";}?> >06:00</option>
                                                        <option value="07:00" <?php if ("07:00:00"==$userProfile->team_time_start){echo "selected";}?> >07:00</option>
                                                        <option value="08:00" <?php if ("08:00:00"==$userProfile->team_time_start){echo "selected";}?> >08:00</option>
                                                        <option value="09:00" <?php if ("09:00:00"==$userProfile->team_time_start){echo "selected";}?> >09:00</option>
                                                        <option value="10:00" <?php if ("10:00:00"==$userProfile->team_time_start){echo "selected";}?> >10:00</option>
                                                        <option value="11:00" <?php if ("11:00:00"==$userProfile->team_time_start){echo "selected";}?> >11:00</option>
                                                        <option value="12:00" <?php if ("12:00:00"==$userProfile->team_time_start){echo "selected";}?> >12:00</option>
                                                        <option value="13:00" <?php if ("13:00:00"==$userProfile->team_time_start){echo "selected";}?> >13:00</option>
                                                        <option value="14:00" <?php if ("14:00:00"==$userProfile->team_time_start){echo "selected";}?> >14:00</option>
                                                        <option value="15:00" <?php if ("15:00:00"==$userProfile->team_time_start){echo "selected";}?> >15:00</option>
                                                        <option value="16:00" <?php if ("16:00:00"==$userProfile->team_time_start){echo "selected";}?> >16:00</option>
                                                        <option value="17:00" <?php if ("17:00:00"==$userProfile->team_time_start){echo "selected";}?> >17:00</option>
                                                        <option value="18:00" <?php if ("18:00:00"==$userProfile->team_time_start){echo "selected";}?> >18:00</option>
                                                        <option value="19:00" <?php if ("19:00:00"==$userProfile->team_time_start){echo "selected";}?> >19:00</option>
                                                        <option value="20:00" <?php if ("20:00:00"==$userProfile->team_time_start){echo "selected";}?> >20:00</option>
                                                        <option value="21:00" <?php if ("21:00:00"==$userProfile->team_time_start){echo "selected";}?> >21:00</option>
                                                        <option value="22:00" <?php if ("22:00:00"==$userProfile->team_time_start){echo "selected";}?> >22:00</option>
                                                        <option value="23:00" <?php if ("23:00:00"==$userProfile->team_time_start){echo "selected";}?> >23:00</option>
                                                    </select>
                                                    <p class="col-2 text-center label-font-Bold text-white pt-2">To</p>
                                                    <select name="timeEnd" class="text-select pl-3 col-5" style="height: 40px;" required>
                                                        <option value="00:00" <?php if ("00:00:00"==$userProfile->team_time_end){echo "selected";}?> >00:00</option>
                                                        <option value="01:00" <?php if ("01:00:00"==$userProfile->team_time_end){echo "selected";}?> >01:00</option>
                                                        <option value="02:00" <?php if ("02:00:00"==$userProfile->team_time_end){echo "selected";}?> >02:00</option>
                                                        <option value="03:00" <?php if ("03:00:00"==$userProfile->team_time_end){echo "selected";}?> >03:00</option>
                                                        <option value="04:00" <?php if ("04:00:00"==$userProfile->team_time_end){echo "selected";}?> >04:00</option>
                                                        <option value="05:00" <?php if ("05:00:00"==$userProfile->team_time_end){echo "selected";}?> >05:00</option>
                                                        <option value="06:00" <?php if ("06:00:00"==$userProfile->team_time_end){echo "selected";}?> >06:00</option>
                                                        <option value="07:00" <?php if ("07:00:00"==$userProfile->team_time_end){echo "selected";}?> >07:00</option>
                                                        <option value="08:00" <?php if ("08:00:00"==$userProfile->team_time_end){echo "selected";}?> >08:00</option>
                                                        <option value="09:00" <?php if ("09:00:00"==$userProfile->team_time_end){echo "selected";}?> >09:00</option>
                                                        <option value="10:00" <?php if ("10:00:00"==$userProfile->team_time_end){echo "selected";}?> >10:00</option>
                                                        <option value="11:00" <?php if ("11:00:00"==$userProfile->team_time_end){echo "selected";}?> >11:00</option>
                                                        <option value="12:00" <?php if ("12:00:00"==$userProfile->team_time_end){echo "selected";}?> >12:00</option>
                                                        <option value="13:00" <?php if ("13:00:00"==$userProfile->team_time_end){echo "selected";}?> >13:00</option>
                                                        <option value="14:00" <?php if ("14:00:00"==$userProfile->team_time_end){echo "selected";}?> >14:00</option>
                                                        <option value="15:00" <?php if ("15:00:00"==$userProfile->team_time_end){echo "selected";}?> >15:00</option>
                                                        <option value="16:00" <?php if ("16:00:00"==$userProfile->team_time_end){echo "selected";}?> >16:00</option>
                                                        <option value="17:00" <?php if ("17:00:00"==$userProfile->team_time_end){echo "selected";}?> >17:00</option>
                                                        <option value="18:00" <?php if ("18:00:00"==$userProfile->team_time_end){echo "selected";}?> >18:00</option>
                                                        <option value="19:00" <?php if ("19:00:00"==$userProfile->team_time_end){echo "selected";}?> >19:00</option>
                                                        <option value="20:00" <?php if ("20:00:00"==$userProfile->team_time_end){echo "selected";}?> >20:00</option>
                                                        <option value="21:00" <?php if ("21:00:00"==$userProfile->team_time_end){echo "selected";}?> >21:00</option>
                                                        <option value="22:00" <?php if ("22:00:00"==$userProfile->team_time_end){echo "selected";}?> >22:00</option>
                                                        <option value="23:00" <?php if ("23:00:00"==$userProfile->team_time_end){echo "selected";}?> >23:00</option>
                                                    </select>
                                                </div>
                                            </div>


                                            {{--<div class="form-group">--}}
                                                {{--<select name="language3" id="game" class="text-select pl-3" style="height: 40px;">--}}
                                                    {{--@if(isset($userLanguage[2]))--}}
                                                        {{--<option value="{{$userLanguage[1]->languageID}}">{{$userLanguage[1]->language_name}}</option>--}}
                                                        {{--@foreach($language as $item)--}}
                                                            {{--<option value="{{$item->languageID}}">{{$item->language_name}}</option>--}}
                                                        {{--@endforeach--}}
                                                    {{--@else--}}
                                                        {{--<option value="null">Select Language</option>--}}
                                                        {{--@foreach($language as $item)--}}
                                                            {{--<option value="{{$item->languageID}}">{{$item->language_name}}</option>--}}
                                                        {{--@endforeach--}}
                                                    {{--@endif--}}
                                                {{--</select>--}}
                                                {{--<input type="password" name="password" placeholder="••••••••••••••" class="text-input pl-3">--}}
                                            {{--</div>--}}


                                        </div>
                                        <div class="col-6 " style="height: auto">
                                            <div class="form-group">
                                                <p class="text-input-label">Birthday</p>
                                                <input name="birthday" id="datepicker" class="text-input pl-3" value="{{$userProfile->user_birthday}}">
                                            </div>

                                            <div class="form-group">
                                                <p class="text-input-label">Gender</p>
                                                <div class="form-group">
                                                    <select name="gender" id="game" class="text-select pl-3" style="height: 40px;">
                                                        @for($i=0;$i<=1;$i++)
                                                            @if($userProfile->user_gender == $i)
                                                                <option value="male">Male</option>
                                                            @else
                                                                <option value="female">Female</option>
                                                            @endif
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row align-items-end">
                                                <div class="col-6">
                                                    <button type="submit" class="btn btn-primary red-btn" style="height: 40px;font-size: 14px;font-weight: bold">Update Profile</button>
                                                </div>
                                                <div class="col-6">
                                                    <button onclick="reset()" type="reset" class="btn light-btn mt-3" style="height: 40px;font-size: 14px;font-weight: bold">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd'
    });

    function reset() {
        document.getElementById('formInput').reset()
    }
</script>