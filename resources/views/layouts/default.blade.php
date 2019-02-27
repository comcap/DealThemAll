<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')
</head>
<body style="background-color: #132357">
<div class="container-fluid">
    <div class="row">
        <div class="col-1 pl-0 pr-0" style="background-color: rgba(255,255,255,0.1)">
            @include('includes.header')
        </div>

        <div id="main" class="container" style="background-color: rgba(255,255,255,0.1)">
            <div class="row">
                <div class="col-8" style="background-color: rgba(255,255,255,0.1)">
                    @yield('content')
                </div>
                <div class="col-4" style="background-color: rgba(255,255,255,0.1)">
                    TEST
                </div>
            </div>


        </div>
    </div>

</div>

</body>
</html>
