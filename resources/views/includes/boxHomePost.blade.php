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
                    <form action="/post" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-8 ">
                                    <input type="text" autocomplete="off" name="postDetail" placeholder="Type something…"
                                           class="bg-transparent w-100 label-font-Light text-white port-box-input" required>
                                </div>
                                <div class="col-1 px-2">
                                    <div class="row h-100 justify-content-end">
                                        <button class="text-center"
                                             style="width: 40px;background-color: #ff425d; padding-top: 8px; border-radius: 20px;border-color: transparent;cursor: pointer">
                                            <i class="fas fa-paper-plane text-white"
                                               style="font-size: 16px;position: relative;left: -1px;bottom: 3px;"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-3 ">
                                    <select name="gameID"
                                            class="w-100 border-0 uneditable-input label-font-Light text-white px-4"
                                            style="height: 40px; background-color: #FBC226;border-radius: 20px;cursor: pointer" required>
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
                        <div class="col-md-12 mt-4 mb-2 col-12" id="nav_post3" style="display: none">
                            <div class="row mx-0 text-center">
                                {{--<div class="col" style="max-width: fit-content">--}}
                                <div id="upload-button" style="padding-top: 34px;padding-bottom: 34px;">
                                    <div class="mb-2">
                                        <i class="fas fa-file-video text-white" style="font-size: 50px"></i>
                                    </div>
                                    <span>Select Video. Maximum duration 10 sec</span>
                                </div>
                                    <input type="file" name="postVideo" id="file-to-upload" accept="video/*" />
                                    <div class="col h-auto" style="max-width: fit-content">
                                        <video id="main-video" class="mw-100" controls>
                                            <source type="video/mp4">
                                        </video>
                                        <canvas id="video-canvas"></canvas>
                                        <img class="d-none" id="deleteVideo" onclick="removeVideo()" src="{{asset('data-image/cancel.svg')}}" width="18px" height="18px" style="cursor: pointer;position: absolute;right: 26px;top: 9px;">
                                    </div>
                                {{--</div>--}}
                            </div>
                        </div>

                        <input type="text" id="postState" name="stateID" value="1" hidden>
                        <input type="file" id="postImage" name="postImage[]" value="" multiple hidden/>
                    </form>
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
        $('#postImage')[0].files = new FileListItem(myDropzone.files);

        file.previewElement.addEventListener("click", function () {
            myDropzone.removeFile(file);
            $('#postImage')[0].files = new FileListItem(myDropzone.files);
        });
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

                document.getElementById('postState').value = 1
                $('#postImage').val('')
                myDropzone.removeAllFiles();
                removeVideo()

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

                document.getElementById('postState').value = 2
                $('#postImage').val('')
                myDropzone.removeAllFiles();
                removeVideo()

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

                document.getElementById('postState').value = 3
                $('#postImage').val('')
                myDropzone.removeAllFiles();
                removeVideo()

                break;
        }
    }


    var _CANVAS = document.querySelector("#video-canvas"),
        _CTX = _CANVAS.getContext("2d"),
        _VIDEO = document.querySelector("#main-video"),
        vid = document.createElement('video');

    // Upon click this should should trigger click on the #file-to-upload file input element
    // This is better than showing the not-good-looking file input element
    document.querySelector("#upload-button").addEventListener('click', function() {
        document.querySelector("#file-to-upload").click();
    });

    // When user chooses a MP4 file
    document.querySelector("#file-to-upload").addEventListener('change', function() {
        // Validate whether MP4

        // if(['video/mp4'].indexOf(document.querySelector("#file-to-upload").files[0].type) == -1) {
        //     alert('Error : Only MP4 format allowed');
        //     return;
        // }

        vid.src = URL.createObjectURL(document.querySelector("#file-to-upload").files[0])
        vid.ondurationchange = function() {
            if (this.duration < 10){
                // Hide upload button
                document.querySelector("#upload-button").style.display = 'none';

                // Object Url as the video source
                document.querySelector("#main-video source").setAttribute('src', URL.createObjectURL(document.querySelector("#file-to-upload").files[0]));

                // Load the video and show it
                _VIDEO.load();
                _VIDEO.style.display = 'inline';
                $('#deleteVideo').removeClass('d-none')

                // Load metadata of the video to get video duration and dimensions
                _VIDEO.addEventListener('loadedmetadata', function() { console.log(_VIDEO.duration);
                    var video_duration = _VIDEO.duration,
                        duration_options_html = '';

                    // Set options in dropdown at 4 second interval
                    for(var i=0; i<Math.floor(video_duration); i=i+4) {
                        duration_options_html += '<option value="' + i + '">' + i + '</option>';
                    }
                    document.querySelector("#set-video-seconds").innerHTML = duration_options_html;

                    // Show the dropdown container
                    document.querySelector("#thumbnail-container").style.display = 'block';

                    // Set canvas dimensions same as video dimensions
                    _CANVAS.width = _VIDEO.videoWidth;
                    _CANVAS.height = _VIDEO.videoHeight;
                });
            } else{
                alert("Maximum duration 10 sec. Please try agian.")
                document.getElementById('file-to-upload').value = ""
                $('#deleteVideo').addClass('d-none')
            }
        };
    });

    // On changing the duration dropdown, seek the video to that duration
    document.querySelector("#set-video-seconds").addEventListener('change', function() {
        _VIDEO.currentTime = document.querySelector("#set-video-seconds").value;

        // Seeking might take a few milliseconds, so disable the dropdown and hide download link
        document.querySelector("#set-video-seconds").disabled = true;
        document.querySelector("#get-thumbnail").style.display = 'none';
    });

    // Seeking video to the specified duration is complete
    document.querySelector("#main-video").addEventListener('timeupdate', function() {
        // Re-enable the dropdown and show the Download link
        document.querySelector("#set-video-seconds").disabled = false;
        document.querySelector("#get-thumbnail").style.display = 'inline';
    });

    function removeVideo() {
        document.getElementById('file-to-upload').value = ""
        _VIDEO.style.display = 'none';
        $('#deleteVideo').addClass('d-none')
        document.querySelector("#upload-button").style.display = 'block';
    }

    // On clicking the Download button set the video in the canvas and download the base-64 encoded image data
    // document.querySelector("#get-thumbnail").addEventListener('click', function() {
    //     _CTX.drawImage(_VIDEO, 0, 0, _VIDEO.videoWidth, _VIDEO.videoHeight);
    //
    //     document.querySelector("#get-thumbnail").setAttribute('href', _CANVAS.toDataURL());
    //     document.querySelector("#get-thumbnail").setAttribute('download', 'thumbnail.png');
    // });

</script>
