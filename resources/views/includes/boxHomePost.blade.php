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
            <div class="row align-items-center" style="padding-top: 20px;padding-bottom: 20px;height: auto;">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-8 ">
                            <input type="text" placeholder="Type something…"
                                   class="bg-transparent w-100 label-font-Light text-white port-box-input">
                        </div>
                        <div class="col-1 px-2">
                            <div class="row h-100 justify-content-end">
                                <div class="text-center"
                                     style="width: 40px;background-color: #ff425d; padding-top: 8px; border-radius: 20px;border-color: white">
                                    <i class="fas fa-paper-plane text-white"
                                       style="font-size: 16px;position: relative;left: -1px;top: 1px;"></i>
                                </div>
                            </div>
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
                <div class="col-md-12 mt-4 mb-2 col-12" id="nav_post2" style="display: none">
                    <div id="uploadPostImage" class="dropzone w-100 text-center"
                         style="background-color: rgba(255,255,255,0.1); border-radius: 8px;">
                        <div class="dz-message" data-dz-message>
                            <i class="fas fa-file-image text-white" style="font-size: 50px"></i>
                            <div class="text-white mt-2">Drag files to upload</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2 mb-2 col-12" id="nav_post3" style="display: none">
                    <div class="dropzone border w-100" style="height: 120px">
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

        $('#nav_post2').hide();
        $('#nav_post3').hide();
    });

    Dropzone.autoDiscover = false;

    var myDropzone = new Dropzone("#uploadPostImage", {
        url: "file/post",
        accept: function (file, done) {
            done(file.name);
        },
    });

    myDropzone.on("complete", function (file) {
        // console.log(myDropzone.files[0]);
        // $('#card_BannerImg')[0].files = new FileListItem(myDropzone.files);

        file.previewElement.addEventListener("click", function () {
            myDropzone.removeFile(file);
        });

        // console.log(document.getElementById('card_BannerImg').value);
        // file.previewElement.addEventListener("click", function() {
        //     myDropzone.removeFile(file);
        //     // $('#card_BannerImg')[0].files = new FileListItem(myDropzone.files);
        //
        //     // document.getElementById('bannerImg').value = arr;
        //     // console.log(document.getElementById('bannerImg').value);
        // });
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
                // $('#nav_post1').hide(250);
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
