<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')
</head>
<body style="background-color: #132357">
<nav class="navbar d-md-none navbar-expand-md navbar-dark fixed-top" style="background-color: rgba(0,0,0,0.90)">
    <a class="navbar-brand" href="/">
        <img src="{{asset('/data-image/logo.svg') }}" width="auto" height="40px">
    </a>

    <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars text-white" style="font-size: 20px"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            @if(isset(\Illuminate\Support\Facades\Auth::User()->user_ID))
                @if(count(\Illuminate\Support\Facades\DB::table('tbl_team_manager')->where('tbl_team_manager.user_ID','=',\Illuminate\Support\Facades\Auth::User()->user_ID)->where('tbl_team_manager.user_verify','=',1)->get())>0)
                    <li class="nav-item active text-right">
                        <a class="nav-link " href="/createteam">Team Manager</a>
                    </li>
                @else
                    <li class="nav-item active text-right">
                        <a class="nav-link " href="/createteam">Createteam</a>
                    </li>
                @endif
                    <li class="nav-item active text-right">
                        <a class="nav-link " href="/profile">My profile</a>
                    </li>
                    <li class="nav-item active text-right">
                        <a href="/ApiLogout" class="text-pink" style="color:#ff4d58;">
                            <img src="{{asset('data-image/power-button-off.svg')}}" style="width: 16px;">
                            LOGOUT
                        </a>
                    </li>

            @else
                <li class="nav-item active text-right">
                    <a class="nav-link" data-toggle="modal" data-target="#LoginModal">LOGIN</a>
                </li>
                <li class="nav-item active text-right">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal">SIGN UP</a>
                </li>
            @endif

        </ul>
    </div>

</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-1 d-none d-md-inline pl-0 pr-0">
            @include('includes.header')
        </div>
        <div id="main" class="container">
            <div class="row">
                <div class="col-12 pr-0 pl-0" style=" height: auto">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-lg-none pl-0 pr-0">
    @include('includes.headerSM')
</div>
<script>
    /*
     * Replace all SVG images with inline SVG
     */
    $(document).ready(function () {
        if ({{\Illuminate\Support\Facades\Auth::check()}}){
            setInterval(updateNoti, 1000);   // 1000 = 1 second
        }
    })

    function updateNoti() {
        var xhttp = new XMLHttpRequest();
        var url = '/updateNoti';

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var obj = JSON.parse(this.responseText);
                console.log(obj);
                document.getElementById('notiCount').innerText = obj;
            }
        };

        xhttp.open("GET", url, true);
        xhttp.send();
    }

    $(function(){
        jQuery('img.svg').each(function(){
            var $img = jQuery(this);
            var imgID = $img.attr('id');
            var imgClass = $img.attr('class');
            var imgURL = $img.attr('src');

            jQuery.get(imgURL, function(data) {
                // Get the SVG tag, ignore the rest
                var $svg = jQuery(data).find('svg');

                // Add replaced image's ID to the new SVG
                if(typeof imgID !== 'undefined') {
                    $svg = $svg.attr('id', imgID);
                }
                // Add replaced image's classes to the new SVG
                if(typeof imgClass !== 'undefined') {
                    $svg = $svg.attr('class', imgClass+' replaced-svg');
                }

                // Remove any invalid XML tags as per http://validator.w3.org
                $svg = $svg.removeAttr('xmlns:a');

                // Check if the viewport is set, else we gonna set it if we can.
                if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                    $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
                }

                // Replace image with new SVG
                $img.replaceWith($svg);

            }, 'xml');
        });
    });

</script>
</body>
</html>
