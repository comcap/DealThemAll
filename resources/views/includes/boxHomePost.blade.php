<div class="col-12 mb-3" style="background-color: rgba(255,255,255,0.1); border-radius: 8px">
    <div class="row">
        <div class="col-2 d-flex align-items-center pl-4 triangle-div"
             style="border-radius: 8px 0 0 8px;height: auto;z-index: 1">
            <a href="profile/">
                <img src="{{asset('data-image/userImage/'.Auth::User()->user_image)}}" width="70px" height="70px"
                     style="border-radius: 35px">
            </a>
        </div>
        <div class="col-10">
            <div class="row position-relative" style="width: 107%;height: 40px;right: 17px">
                <div class="col-4 border-bottom  border-danger text-center pt-2" id="post_action_1"
                     onclick="selectPost(1)">
                    <a href="#" class="text-pink" id="text_focus_1">STATUS</a>
                </div>
                <div class="col-4 border-bottom text-center pt-2" id="post_action_2" onclick="selectPost(2)">
                    <a href="#" class="text-white" id="text_focus_2">PHOTO</a>
                </div>
                <div class="col-4 border-bottom text-center pt-2" id="post_action_3" onclick="selectPost(3)">
                    <a href="#" class="text-white" id="text_focus_3">VIDEO</a>
                </div>
            </div>
            <div class="row align-items-center" id="nav_post1" style="padding-top: 20px;padding-bottom: 20px;height: auto;">
                <div class="col-md-12">
                    <div class="row">
                <div class="col-9 ">
                    <input type="text" placeholder="Type something…"
                           class="bg-transparent w-100 label-font-Light text-white port-box-input">
                </div>
                <div class="col-3 ">
                    <select name="" id=""
                            class="w-100 border-0 uneditable-input label-font-Light text-white px-4"
                            style="height: 40px; background-color: #FBC226;border-radius: 20px">
                        <option value="" disabled selected>Tag with game</option>
                        @foreach($gameList as $item)
                            <option value={{$item->game_ID}}>{{$item->game_name}}</option>
                        @endforeach
                    </select>
                </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-center" style="display: none;padding-top: 20px;padding-bottom: 20px;height: auto;" id="nav_post2">

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-9 ">
                            <input type="text" placeholder="Type something…"
                                   class="bg-transparent w-100 label-font-Light text-white port-box-input">
                        </div>
                        <div class="col-3 ">
                            <select name="" id=""
                                    class="w-100 border-0 uneditable-input label-font-Light text-white px-4"
                                    style="height: 40px; background-color: #FBC226;border-radius: 20px">
                                <option value="" disabled selected>Tag with game</option>
                                @foreach($gameList as $item)
                                    <option value={{$item->game_ID}}>{{$item->game_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-2 mb-2 col-12">
                    <div class="dropzone  border w-100" style="height: 120px">
                        <div class="text-center">dropfile hear!!.</div>
                    </div>
                </div>


            </div>
            <div class="row align-items-center" style="display: none;padding-top: 20px;padding-bottom: 20px;height: auto;" id="nav_post3">
                <div class="col-7 ">
                    <input type="text" placeholder="Type something…"
                           class="bg-transparent w-100 label-font-Light text-white port-box-input">
                </div>
                <div class="col-1 border " style="background-color: #4dc0b5; border-radius: 100%; border-color: white">
                    dasld;
                </div>
                <div class="col-4 ">
                    <select name="" id="" class="w-100 border-0 uneditable-input label-font-Light text-white px-4"
                            style="height: 40px; background-color: #FBC226;border-radius: 20px">
                        <option value="" disabled selected>Tag with game</option>
                        @foreach($gameList as $item)
                            <option value={{$item->game_ID}}>{{$item->game_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12 mt-2 mb-2 col-12">
                    <div class="dropzone  border w-100" style="height: 120px">
                        <div class="text-center">dropfile hear!!.</div>
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        selectPost(1);

        $('#nav_post1').show();
        $('#nav_post2').hide();
        $('#nav_post3').hide();
    });


function selectPost(id) {
    console.log(id);
    switch (id) {
        case 1:
            $('#nav_post1').show(250);
            $('#nav_post2').hide(250);
            $('#nav_post3').hide(250);

            $('#post_action_1').addClass('border-danger');
            $('#text_focus_1').addClass('text-pink');
            $('#text_focus_1').removeClass('text-white');

            $('#post_action_2').removeClass('border-danger');
            $('#text_focus_2').removeClass('text-pink');

            $('#post_action_3').removeClass('border-danger');
            $('#text_focus_3').removeClass('text-pink');

            $('#text_focus_2').addClass('text-white');
            $('#text_focus_3').addClass('text-white');

            break;
        case 2:
            $('#nav_post1').hide(250);
            $('#nav_post2').show(250);
            $('#nav_post3').hide(250);


            $('#post_action_1').removeClass('border-danger');
            $('#text_focus_1').removeClass('text-pink');

            $('#post_action_2').addClass('border-danger');
            $('#text_focus_2').addClass('text-pink');
            $('#text_focus_2').removeClass('text-white');


            $('#post_action_3').removeClass('border-danger');
            $('#text_focus_3').removeClass('text-pink');

            $('#text_focus_3').addClass('text-white');
            $('#text_focus_1').addClass('text-white');


            break;
        case 3:
            $('#nav_post1').hide(250);
            $('#nav_post2').hide(250);
            $('#nav_post3').show(250);

            $('#post_action_1').removeClass('border-danger');
            $('#text_focus_1').removeClass('text-pink');

            $('#post_action_2').removeClass('border-danger');
            $('#text_focus_2').removeClass('text-pink');

            $('#post_action_3').addClass('border-danger');
            $('#text_focus_3').addClass('text-pink');
            $('#text_focus_3').removeClass('text-white');

            $('#text_focus_1').addClass('text-white');
            $('#text_focus_2').addClass('text-white');
            break;

    }
}

</script>
