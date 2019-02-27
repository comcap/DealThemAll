@extends('layouts.sidebar')
@section('content')
    <div id="box-item" class="container-fluid mt-2 supreme-container">
        @include('includes.headUpdate')
        <div class="row">
            <div class="col-12 mt-3">
                <div class="row mb-2 border-bottom">
                    <div class="col-12 p-0" style="height:50px">
                        <div class="row pl-4">
                            <img src="{{asset($gameSelect->game_logo)}}" width="40px" height="40px">
                            <div>
                                <select name="game" id="gameSelect" style="font-size: 24px" class="pl-3 select-game label-font-Bold ml-3" onchange="selectGame()">
                                    @foreach($gameList as $item)
                                        @if($id == $item->game_ID)
                                            <option value="{{$item->game_ID}}" selected>{{$item->game_name}}</option>
                                        @else
                                            <option value="{{$item->game_ID}}">{{$item->game_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.boxUpdate')
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="background-color: rgba(0,0,0,0.4);">
                <div class="d-flex justify-content-center">
                    <div class="col-12 p-4">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h2 class="text-white label-font-Bold" style="font-size: 44px">SELECT ROLE</h2>
                            </div>
                            <div class="col-12 text-center">
                                <h2 class="text-white label-font-Regular" style="font-size: 20px">Pick your specialisation</h2>
                            </div>
                        </div>
                        <form id="form-modal-role" action="/selectrole" method="post">
                            @csrf
                            <div class="row">
                                @if($gameSelect->game_ID==$id)
                                    @foreach($gameRole as $item)
                                        <div class="col-4">
                                            <button name="typeRole" value="{{$item->typeID}}" class="btn-role-update mt-4 pt-4">
                                                <img src="{{asset('/data-image/role/'.$item->type_Image)}}" width="auto" height="90px">
                                                <p class="label-font-Condensed-Bold m-2 text-white" style="font-size: 26px">{{$item->typeName}}</p>
                                            </button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-4">
                                        <button class="btn-role-update mt-4 pt-4">
                                            <img src="{{asset('/data-image/role/dps.png')}}" width="auto" height="90px">
                                            <p class="label-font-Condensed-Bold m-2 text-white" style="font-size: 26px">DPS</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn-role-update mt-4 pt-4">
                                            <img src="{{asset('/data-image/role/dps.png')}}" width="auto" height="90px">
                                            <p class="label-font-Condensed-Bold m-2 text-white" style="font-size: 26px">DPS</p>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn-role-update mt-4 pt-4">
                                            <img src="{{asset('/data-image/role/dps.png')}}" width="auto" height="90px">
                                            <p class="label-font-Condensed-Bold m-2 text-white" style="font-size: 26px">DPS</p>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <input type="text" name="bookId" id="bookId" value="" hidden/>
                            <input type="text" name="gameSelect" value="{{$id}}" hidden>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on("click", ".open-AddBookDialog", function () {
            var myBookId = $(this).data('article-id');

            $("#form-modal-role #bookId").val( myBookId );
        });
    </script>

@stop
