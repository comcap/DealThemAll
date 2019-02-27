<div class="col-12 mb-3" style="background-color: rgba(255,255,255,0.1); border-radius: 8px">
    <div class="row">
        <div class="col-2 d-flex align-items-center pl-4 triangle-div" style="border-radius: 8px 0 0 8px;height: 130px;z-index: 1">
            <a href="profile/">
                <img src="{{asset('data-image/userImage/'.Auth::User()->user_image)}}" width="70px" height="70px" style="border-radius: 35px">
            </a>
        </div>
        <div class="col-10">
            <div class="row position-relative" style="width: 107%;height: 40px;right: 17px">
                <div class="col-4 border-bottom text-center pt-2">
                    <a href="#" class="text-white">STATUS</a>
                </div>
                <div class="col-4 border-bottom text-center pt-2">
                    <a href="#" class="text-white">PHOTO</a>
                </div>
                <div class="col-4 border-bottom text-center pt-2">
                    <a href="#" class="text-white">VIDEO</a>
                </div>
            </div>
            <div class="row align-items-center" style="height: 90px;">
                <div class="col-9 ">
                    <input type="text" placeholder="Type something…" class="bg-transparent w-100 label-font-Light text-white port-box-input">
                </div>
                <div class="col-3 ">
                    <select name="" id="" class="w-100 border-0 uneditable-input label-font-Light text-white px-4" style="height: 40px; background-color: #FBC226;border-radius: 20px">
                        <option value="" disabled selected>Tag with game</option>
                        @foreach($gameList as $item)
                            <option value={{$item->game_ID}}>{{$item->game_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
