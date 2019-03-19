<div class="row">
    <div class="col-12 mt-2 mb-4">
        <div class="row p-4" style="background-color: rgba(255,255,255,0.1); height: auto; border-radius: 8px">
            <div class="col-12">
                <div class="row">
                    <div class="col p-0">
                        <div class="form-group">
                            @if(isset($StatsPlayer))
                                <div class="row px-3 mb-3 align-items-center">
                                    <img src="{{asset($StatsPlayer->iconPlayer)}}" width="40px" height="40px">
                                    <span class="label-font-Regular text-white ml-3 mr-2" style="font-size: 18px">{{$StatsPlayer->nameInGame}}</span>
                                    <form action="/deleteProfile" method="post">
                                        @csrf
                                        <button style="background-color: rgba(0,0,0,0);border: none">
                                            <i class="fas fa-times-circle text-danger"></i>
                                        </button>
                                        <input type="text" name="stats_playerID" value="{{$StatsPlayer->stats_playerID}}" hidden>
                                        <input type="text" name="gameSelect" value="{{$id}}" hidden>
                                    </form>
                                </div>
                            @endif
                            <form class="row px-3" action="/Apiupdate" method="post">
                                @if(!isset($StatsPlayer))
                                    <div class="mb-2">
                                        <span class="label-font-Bold text-white" style="font-size: 18px">Sync player profile</span>
                                    </div>
                                @endif
                                @csrf
                                <input type="text" name="gameSelect" value="{{$id}}" hidden>
                                @if(isset($StatsPlayer))
                                    <input type="text" name="username" value="{{$StatsPlayer->userPath}}" placeholder="Your battletag. Example: test-12345" class="text-input pl-3">
                                @else
                                        @switch($id)
                                            @case(1)
                                            <input type="text" name="username" placeholder="Your battletag / Example : test-12345" class="text-input pl-3">
                                            @break
                                            @case(2)
                                            <input type="text" name="username" placeholder="Your playernames in game pubg. / Example : test1234" class="text-input pl-3">
                                            @break
                                            @case(4)
                                            <input type="text" name="username" placeholder="Your battletag / Example : test-12345" class="text-input pl-3">
                                            @break
                                        @endswitch
                                @endif
                                <button type="submit" hidden></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <span class="label-font-Bold text-white" style="font-size: 18px">Specialisation</span>
                </div>
                <div class="row">
                    <div class="col-6 pl-0 pr-4" style="height: 280px">
                        <img src="{{asset($gameSelect->game_full)}}" class="img-fluid w-100">
                    </div>

                    @if(isset($resultRole))
                        @if(count($resultRole)==2)
                            {{--@for($i=0;$i<=1;$i++)--}}
                            @foreach($resultRole as $item)
                                @if($item->stateRole==1||$item->stateRole==2)
                                    <div class="col-3 pl-0" style="height: 280px">
                                        @if($item->stateRole==1)
                                            <h5 class="label-font-Bold text-white" style="font-size: 18px">PRIMARY ROLE</h5>
                                        @else
                                            <h5 class="label-font-Bold text-white" style="font-size: 18px">SECONDARY ROLE</h5>
                                        @endif
                                        <span class="label-font-Regular text-white" style="font-size: 16px">Pick your specialisation</span>
                                        <div class="open-AddBookDialog btn-role-update mt-4 pt-5" data-toggle="modal" data-target="#exampleModal" data-article-id={{$item->stateRole}}>
                                            <div class="row justify-content-center">
                                                <img src="{{asset('/data-image/role/'.$item->type_Image)}}" width="auto" height="90px">
                                            </div>
                                            <div class="row justify-content-center">
                                                <p class="label-font-Condensed-Bold m-2 text-white" style="font-size: 26px">{{$item->role_name}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-3 pl-0" style="height: 280px">
                                        <h5 class="label-font-Bold text-white" style="font-size: 18px">PRIMARY ROLE</h5>
                                        <span class="label-font-Regular text-white" style="font-size: 16px">Pick your specialisation</span>
                                        <div class="btn-role-update mt-4 pt-5" data-toggle="modal" data-target="#exampleModal">
                                            <div class="row justify-content-center">
                                                <img src="{{asset('/data-image/role/null.png')}}" width="auto" height="90px">
                                            </div>
                                            <div class="row justify-content-center">
                                                <p class="label-font-Condensed-Bold m-2 text-white" style="font-size: 26px">Select Role</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        @elseif(count($resultRole)==1)
                            <div class="col-3 pl-0" style="height: 280px">
                                <h5 class="label-font-Bold text-white" style="font-size: 18px">PRIMARY ROLE</h5>
                                <span class="label-font-Regular text-white" style="font-size: 16px">Pick your specialisation</span>
                                <div class="open-AddBookDialog btn-role-update mt-4 pt-5" data-toggle="modal" data-target="#exampleModal" data-article-id='1'>
                                    <div class="row justify-content-center">
                                        <img src="{{asset('/data-image/role/'.$resultRole[0]->type_Image)}}" width="auto" height="90px">
                                    </div>
                                    <div class="row justify-content-center">
                                        <p class="label-font-Condensed-Bold m-2 text-white" style="font-size: 26px">{{$resultRole[0]->role_name}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-3 pl-0" style="height: 280px">
                                <h5 class="label-font-Bold text-white" style="font-size: 18px">SECONDARY ROLE</h5>
                                <span class="label-font-Regular text-white" style="font-size: 16px">Pick your specialisation</span>
                                <div class="open-AddBookDialog btn-role-update mt-4 pt-5" data-toggle="modal" data-target="#exampleModal" data-article-id='2'>
                                    <div class="row justify-content-center">
                                        <img src="{{asset('/data-image/role/null.png')}}" width="auto" height="90px">
                                    </div>
                                    <div class="row justify-content-center">
                                        <p class="label-font-Condensed-Bold m-2 text-white" style="font-size: 26px">Select Role</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-3 pl-0" style="height: 280px">
                                <h5 class="label-font-Bold text-white" style="font-size: 18px">PRIMARY ROLE</h5>
                                <span class="label-font-Regular text-white" style="font-size: 16px">Pick your specialisation</span>
                                <div class="open-AddBookDialog btn-role-update mt-4 pt-5" data-toggle="modal" data-target="#exampleModal" data-article-id='1'>
                                    <div class="row justify-content-center">
                                        <img src="{{asset('/data-image/role/null.png')}}" width="auto" height="90px">
                                    </div>
                                    <div class="row justify-content-center">
                                        <p class="label-font-Condensed-Bold m-2 text-white" style="font-size: 26px">Select Role</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-3 pl-0" style="height: 280px">
                                <h5 class="label-font-Bold text-white" style="font-size: 18px">SECONDARY ROLE</h5>
                                <span class="label-font-Regular text-white"  style="font-size: 16px">Pick your specialisation</span>

                                <div class="open-AddBookDialog btn-role-update mt-4 pt-5" data-toggle="modal" data-target="#exampleModal" data-article-id='2'>
                                    <div class="row justify-content-center">
                                        <img src="{{asset('/data-image/role/null.png')}}" width="auto" height="90px">
                                    </div>
                                    <div class="row justify-content-center">
                                        <p class="label-font-Condensed-Bold m-2 text-white" style="font-size: 26px">Select Role</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="col-3 pl-0" style="height: 280px">
                            <h5 class="label-font-Bold text-white" style="font-size: 18px">PRIMARY ROLE</h5>
                            <span class="label-font-Regular text-white" style="font-size: 16px">Pick your specialisation</span>
                            <div class="open-AddBookDialog btn-role-update mt-4 pt-5" data-toggle="modal" data-target="#exampleModal" data-article-id='1'>
                                <div class="row justify-content-center">
                                    <img src="{{asset('/data-image/role/null.png')}}" width="auto" height="90px">
                                </div>
                                <div class="row justify-content-center">
                                    <p class="label-font-Condensed-Bold m-2 text-white" style="font-size: 26px">Select Role</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-3 pl-0" style="height: 280px">
                            <h5 class="label-font-Bold text-white" style="font-size: 18px">SECONDARY ROLE</h5>
                            <span class="label-font-Regular text-white"  style="font-size: 16px">Pick your specialisation</span>

                            <div class="open-AddBookDialog btn-role-update mt-4 pt-5" data-toggle="modal" data-target="#exampleModal" data-article-id='2'>
                                <div class="row justify-content-center">
                                    <img src="{{asset('/data-image/role/null.png')}}" width="auto" height="90px">
                                </div>
                                <div class="row justify-content-center">
                                    <p class="label-font-Condensed-Bold m-2 text-white" style="font-size: 26px">Select Role</p>
                                </div>
                            </div>
                        </div>
                    @endif



                </div>
                <div class="row">
                    <div class="col p-0 mt-4">
                        <h5 class="label-font-Bold text-white" style="font-size: 18px">Your skills
                            <span class="label-font-Condensed-Thin" style="color: #aaaaaa;font-size: 14px">maximum 5</span>
                        </h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 p-0">
                        <div class="form-group">
                            <input type="text" name="email" placeholder="Type you skill." class="text-input pl-3">
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="row pl-4 pr-0">
                            @if(isset($subResultRole))
                                @if(count($subResultRole)>0)
                                    <div class="box-role mr-2 mt-2">
                                        <label class="text-white">SNIPER</label><span class="text-white" style="margin-left: 6px"> ⏤</span>
                                    </div>
                                    <div class="box-role mr-2 mt-2">
                                        <label class="text-white">SNIPER</label><span class="text-white" style="margin-left: 6px"> ⏤</span>
                                    </div>
                                    <div class="box-role mr-2 mt-2">
                                        <label class="text-white">SNIPER</label><span class="text-white" style="margin-left: 6px"> ⏤</span>
                                    </div>
                                    <div class="box-role mr-2 mt-2">
                                        <label class="text-white">SNIPER</label><span class="text-white" style="margin-left: 6px"> ⏤</span>
                                    </div>
                                    <div class="box-role mr-2 mt-2">
                                        <label class="text-white">SNIPER</label><span class="text-white" style="margin-left: 6px"> ⏤</span>
                                    </div>
                                @else
                                    <div class="box-role mr-2 mt-2">
                                        <label class="text-white">SNIPER</label><span class="text-white" style="margin-left: 6px"> ⏤</span>
                                    </div>
                                    <div class="box-role mr-2 mt-2">
                                        <label class="text-white">SNIPER</label><span class="text-white" style="margin-left: 6px"> ⏤</span>
                                    </div>
                                    <div class="box-role mr-2 mt-2">
                                        <label class="text-white">SNIPER</label><span class="text-white" style="margin-left: 6px"> ⏤</span>
                                    </div>
                                    <div class="box-role mr-2 mt-2">
                                        <label class="text-white">SNIPER</label><span class="text-white" style="margin-left: 6px"> ⏤</span>
                                    </div>
                                    <div class="box-role mr-2 mt-2">
                                        <label class="text-white">SNIPER</label><span class="text-white" style="margin-left: 6px"> ⏤</span>
                                    </div>
                                @endif
                            @else
                                <div class="box-role mr-2 mt-2">
                                    <label class="text-white">SNIPER</label><span class="text-white" style="margin-left: 6px"> ⏤</span>
                                </div>
                                <div class="box-role mr-2 mt-2">
                                    <label class="text-white">SNIPER</label><span class="text-white" style="margin-left: 6px"> ⏤</span>
                                </div>
                                <div class="box-role mr-2 mt-2">
                                    <label class="text-white">SNIPER</label><span class="text-white" style="margin-left: 6px"> ⏤</span>
                                </div>
                                <div class="box-role mr-2 mt-2">
                                    <label class="text-white">SNIPER</label><span class="text-white" style="margin-left: 6px"> ⏤</span>
                                </div>
                                <div class="box-role mr-2 mt-2">
                                    <label class="text-white">SNIPER</label><span class="text-white" style="margin-left: 6px"> ⏤</span>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

