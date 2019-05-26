<style>
    .dropdown-toggle::after {
        display:none!important;
    }
</style>
<ul class="navbar fixed-bottom navbar-expand-sm justify-content-around m-0" style="background-color: rgba(0,0,0,0.75); height: 70px; ">
        <li class="nav-item">
            <a class="nav-link nav-text {{Request::is('/') ? 'activeSM' : '' }}" href="/">
                    <img class="svg {{Request::is('/') ? 'active' : '' }}" src="{{asset('/data-image/home.svg') }}" width="30px" height="30px">
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link nav-text {{Request::is('notifications') ? 'activeSM' : '' }}" href="/notifications" id="notification">
                @if(\Illuminate\Support\Facades\Auth::User())
                    @if(\App\Notification::where('notification_isRead','=',0)->where('notification_User','=',\Illuminate\Support\Facades\Auth::User()->user_ID)->get()->count() != 0)
                        <h6 class="position-absolute" style="left: 103px;bottom: 30px;"><span class="badge badge-pill badge-danger">{{\App\Notification::where('notification_isRead','=',0)->where('notification_User','=',\Illuminate\Support\Facades\Auth::User()->user_ID)->get()->count()}}</span></h6>
                    @endif
                @endif
                <img class="svg {{Request::is('notifications') ? 'activeSM' : '' }}" src="{{asset('/data-image/noti.svg') }}" width="30px" height="30px">
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-text {{Request::is('player','ApiSearch') ? 'activeSM' : '' }}" href="/player">
                <img class="svg {{Request::is('player','ApiSearch') ? 'activeSM' : '' }}" src="{{asset('/data-image/player.svg') }}" width="30px" height="30px">
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-text {{Request::is('teamList') ? 'activeSM' : '' }}" href="/teamList">
                <img class="svg {{Request::is('teamList') ? 'activeSM' : '' }}" src="{{asset('/data-image/team.svg') }}" width="30px" height="30px">
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-text {{Request::is('live') ? 'activeSM' : '' }}" href="/live">
                <img class="svg {{Request::is('live') ? 'activeSM' : '' }}" src="{{asset('/data-image/live.svg') }}" width="30px" height="30px">
            </a>
        </li>
        {{--<li class="nav-item">--}}
            {{--@if(isset(\Illuminate\Support\Facades\Auth::User()->user_ID))--}}
            {{--@if(count(\Illuminate\Support\Facades\DB::table('tbl_team_manager')->where('tbl_team_manager.user_ID','=',\Illuminate\Support\Facades\Auth::User()->user_ID)->where('tbl_team_manager.user_verify','=',1)->get())>0)--}}
            {{--<a class="nav-link nav-text pt-4 {{Request::is('team/*') ? 'active' : '' }}" href="/team">--}}
                {{--<img class="svg {{Request::is('team/*') ? 'active' : '' }}" src="{{asset('/data-image/team-manager.svg') }}" width="auto" height="20px">--}}
            {{--</a>--}}
            {{--@else--}}
            {{--<a class="nav-link nav-text pt-4 {{Request::is('createteam') ? 'active' : '' }}" href="/createteam">--}}
                {{--<img class="svg {{Request::is('createteam') ? 'active' : '' }}" src="{{asset('/data-image/create-team.svg') }}" width="auto" height="20px">--}}
            {{--</a>--}}
            {{--@endif--}}
            {{--@else--}}
            {{--<a class="nav-link nav-text pt-4 {{Request::is('createteam') ? 'active' : '' }}" href="/createteam">--}}
                {{--<img class="svg {{Request::is('createteam') ? 'active' : '' }}" src="{{asset('/data-image/create-team.svg') }}" width="auto" height="20px">--}}
            {{--</a>--}}
            {{--@endif--}}
        {{--</li>--}}


        {{--<li class="nav-item d-flex justify-content-center mb-4">--}}
            {{--<a class="nav-link" href="/profile">--}}
                {{--@if(isset(\Illuminate\Support\Facades\Auth::User()->user_ID))--}}
                {{--<img class="svg {{Request::is('profile/'.\Illuminate\Support\Facades\Auth::User()->user_ID,'updateprofile/*') ? 'active' : '' }}" src="{{asset('/data-image/profile.svg') }}" width="auto" height="20px">--}}
                {{--@else--}}
                {{--<img class="svg" src="{{asset('/data-image/profile.svg') }}" width="auto" height="20px">--}}
                {{--@endif--}}
            {{--</a>--}}
        {{--</li>--}}
</ul>