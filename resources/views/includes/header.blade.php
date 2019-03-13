<ul class="nav flex-column position-fixed justify-content-between" style="background-color: rgba(0,0,0,0.25); height: 100%; ">
    <div>
        <li class="nav-item d-flex justify-content-center mt-4">
            <a class="nav-link" href="/">
                <img src="{{asset('/data-image/logo.svg') }}" width="auto" height="60px">
            </a>
        </li>
    </div>

    <div>
        <li class="nav-item item-menu-left">
            <a class="nav-link nav-text pt-4 {{Request::is('/') ? 'active' : '' }}" href="/">
                <div>
                    <img class="svg {{Request::is('/') ? 'active' : '' }}" src="{{asset('/data-image/home.svg') }}" width="auto" height="20px">
                    <p class="pt-1 label-font-Regular" style="font-size: 10px;">HOME</p>
                </div>
            </a>
        </li>
        <li class="nav-item item-menu-left">
            <a class="nav-link nav-text pt-4 {{Request::is('player','ApiSearch') ? 'active' : '' }}" href="/player">
                    <img class="svg {{Request::is('player','ApiSearch') ? 'active' : '' }}" src="{{asset('/data-image/player.svg') }}" width="auto" height="20px">
                <p class="pt-1 label-font-Regular" style="font-size: 10px;">PLAYER</p>
            </a>
        </li>
        <li class="nav-item item-menu-left">
            <a class="nav-link nav-text pt-4 {{Request::is('teamList') ? 'active' : '' }}" href="/teamList">
                <img class="svg {{Request::is('teamList') ? 'active' : '' }}" src="{{asset('/data-image/team.svg') }}" width="auto" height="20px">
                <p class="pt-1 label-font-Regular" style="font-size: 10px;">TEAM</p>
            </a>
        </li>
        <li class="nav-item item-menu-left">
            <a class="nav-link nav-text pt-4 {{Request::is('live') ? 'active' : '' }}" href="/live">
                <img class="svg {{Request::is('live') ? 'active' : '' }}" src="{{asset('/data-image/live.svg') }}" width="auto" height="20px">
                <p class="pt-1 label-font-Regular" style="font-size: 10px;">BOARDCAST</p>
            </a>
        </li>
        <li class="nav-item item-menu-left">
            @if(isset(\Illuminate\Support\Facades\Auth::User()->user_ID))
                @if(count(\Illuminate\Support\Facades\DB::table('tbl_team_manager')->where('tbl_team_manager.user_ID','=',\Illuminate\Support\Facades\Auth::User()->user_ID)->where('tbl_team_manager.user_verify','=',1)->get())>0)
                    <a class="nav-link nav-text pt-4 {{Request::is('team/*') ? 'active' : '' }}" href="/team">
                        <img class="svg {{Request::is('team/*') ? 'active' : '' }}" src="{{asset('/data-image/team-manager.svg') }}" width="auto" height="20px">
                        <p class="pt-1 label-font-Regular" style="font-size: 10px;">TEAM MANAGER</p>
                    </a>
                @else
                    <a class="nav-link nav-text pt-4 {{Request::is('createteam') ? 'active' : '' }}" href="/createteam">
                        <img class="svg {{Request::is('createteam') ? 'active' : '' }}" src="{{asset('/data-image/create-team.svg') }}" width="auto" height="20px">
                        <p class="pt-1 label-font-Regular" style="font-size: 10px;">CREATE TEAM</p>
                    </a>
                @endif
            @else
                <a class="nav-link nav-text pt-4 {{Request::is('createteam') ? 'active' : '' }}" href="/createteam">
                    <img class="svg {{Request::is('createteam') ? 'active' : '' }}" src="{{asset('/data-image/create-team.svg') }}" width="auto" height="20px">
                    <p class="pt-1 label-font-Regular" style="font-size: 10px;">CREATE TEAM</p>
                </a>
            @endif
        </li>

        <li class="nav-item item-menu-left">
            <a class="nav-link nav-text pt-4 {{Request::is('notifications') ? 'active' : '' }}" href="#" id="notification">
                @if(\Illuminate\Support\Facades\Auth::User())
                    @if(\App\Notification::where('notification_isRead','=',0)->where('notification_User','=',\Illuminate\Support\Facades\Auth::User()->user_ID)->get()->count() != 0)
                        <h6 class="position-absolute" style="left: 50px;bottom: 140px;"><span class="badge badge-pill badge-danger">{{\App\Notification::where('notification_isRead','=',0)->where('notification_User','=',\Illuminate\Support\Facades\Auth::User()->user_ID)->get()->count()}}</span></h6>
                    @endif
                @endif
                <img class="svg {{Request::is('notifications') ? 'active' : '' }}" src="{{asset('/data-image/noti.svg') }}" width="auto" height="20px">
                <p class="pt-1 label-font-Regular" style="font-size: 10px;">NOTIFICATION</p>
            </a>
        </li>
    </div>

    <div>
        <li class="nav-item d-flex justify-content-center mb-4">
            <a class="nav-link" href="/profile">
                @if(isset(\Illuminate\Support\Facades\Auth::User()->user_ID))
                    <img class="svg {{Request::is('profile/'.\Illuminate\Support\Facades\Auth::User()->user_ID,'updateprofile/*') ? 'active' : '' }}" src="{{asset('/data-image/profile.svg') }}" width="auto" height="20px">
                @else
                    <img class="svg" src="{{asset('/data-image/profile.svg') }}" width="auto" height="20px">
                @endif
            </a>
        </li>
    </div>
    <script>
        var token = $("meta[name='csrf-token']").attr("content");
        var auth = {!! \Illuminate\Support\Facades\Auth::user()->user_ID !!}

        $('#notification').click(function () {
            var xhttp = new XMLHttpRequest();
            var url = '/updateNoti/'+auth;
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var obj = JSON.parse(this.responseText);
                    console.log(obj,"updateNoti");
                }
            };
            window.location.href = "/notifications";

            xhttp.open("PUT", url, true);
            xhttp.setRequestHeader("x-csrf-token", token);
            xhttp.send();
        })
    </script>
</ul>