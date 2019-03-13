var arrInvite = []
var Isready;

function genderRadio() {
    console.log("test")

    if (document.getElementById('genderRadio0').checked) {
        var result = document.getElementById('genderRadio0').value;

        if (result) {
            result = "Male"
            $('#gender0').addClass('radio-active')
            $('#gender1').removeClass('radio-active')
            $('#gender2').removeClass('radio-active')
        }
    } else if (document.getElementById('genderRadio1').checked) {
        var result = document.getElementById('genderRadio1').value;

        if (result) {
            result = "Female"
            $('#gender1').addClass('radio-active')
            $('#gender0').removeClass('radio-active')
            $('#gender2').removeClass('radio-active')
        }
    } else if (document.getElementById('genderRadio2').checked) {
        var result = document.getElementById('genderRadio2').value;

        if (result) {
            result = "All"
            $('#gender2').addClass('radio-active')
            $('#gender0').removeClass('radio-active')
            $('#gender1').removeClass('radio-active')
        }
    }

    // alert(result)
}

function killRadio() {
    console.log("test")

    if (document.getElementById('killRadio0').checked) {
        var result = document.getElementById('killRadio0').value;

        if (result) {
            result = "High"
            $('#kill0').addClass('radio-active')
            $('#kill1').removeClass('radio-active')
            $('#kill2').removeClass('radio-active')
        }
    } else if (document.getElementById('killRadio1').checked) {
        var result = document.getElementById('killRadio1').value;

        if (result) {
            result = "Low"
            $('#kill1').addClass('radio-active')
            $('#kill0').removeClass('radio-active')
            $('#kill2').removeClass('radio-active')
        }
    } else if (document.getElementById('killRadio2').checked) {
        var result = document.getElementById('killRadio2').value;

        if (result) {
            result = "None"
            $('#kill2').addClass('radio-active')
            $('#kill0').removeClass('radio-active')
            $('#kill1').removeClass('radio-active')
        }
    }

    // alert(result)
}

function accuracyRadio() {
    console.log("test")

    if (document.getElementById('accuracyRadio0').checked) {
        var result = document.getElementById('accuracyRadio0').value;

        if (result) {
            result = "High"
            $('#accuracy0').addClass('radio-active')
            $('#accuracy1').removeClass('radio-active')
            $('#accuracy2').removeClass('radio-active')
        }
    } else if (document.getElementById('accuracyRadio1').checked) {
        var result = document.getElementById('accuracyRadio1').value;

        if (result) {
            result = "Low"
            $('#accuracy1').addClass('radio-active')
            $('#accuracy0').removeClass('radio-active')
            $('#accuracy2').removeClass('radio-active')
        }
    } else if (document.getElementById('accuracyRadio2').checked) {
        var result = document.getElementById('accuracyRadio2').value;

        if (result) {
            result = "None"
            $('#accuracy2').addClass('radio-active')
            $('#accuracy0').removeClass('radio-active')
            $('#accuracy1').removeClass('radio-active')
        }
    }

    // alert(result)
}

function wonRadio() {
    console.log("test")

    if (document.getElementById('wonRadio0').checked) {
        var result = document.getElementById('wonRadio0').value;

        if (result) {
            result = "High"
            $('#won0').addClass('radio-active')
            $('#won1').removeClass('radio-active')
            $('#won2').removeClass('radio-active')
        }
    } else if (document.getElementById('wonRadio1').checked) {
        var result = document.getElementById('wonRadio1').value;

        if (result) {
            result = "Low"
            $('#won1').addClass('radio-active')
            $('#won0').removeClass('radio-active')
            $('#won2').removeClass('radio-active')
        }
    } else if (document.getElementById('wonRadio2').checked) {
        var result = document.getElementById('wonRadio2').value;

        if (result) {
            result = "None"
            $('#won2').addClass('radio-active')
            $('#won0').removeClass('radio-active')
            $('#won1').removeClass('radio-active')
        }
    }

    // alert(result)
}

function selectGame() {
    var result = document.getElementById('gameSelect').value
    if (result) {
        window.location = "/updateprofile/" + result
    }
}

function selectGameTeam(id, idTeam) {
    var idGame = document.getElementById('gameList').value
    // var url = window.location.hostname+"getGameList"
    document.getElementById('gameListPlayerModal').value = idGame

    document.getElementById('boxManagerTeam').innerHTML = "<div id=\"LoadPlayer\" class=\"col\">\n" +
        "        <div class=\"row py-4 justify-content-center\">\n" +
        "        <div class='loader'></div>\n" +
        "        </div>\n" +
        "        </div>";

    var url2 = '/getGameList'
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var obj = JSON.parse(this.responseText);
            obj.forEach(function (item, index) {
                if (idGame == item['game_ID']) {
                    document.getElementById('gameLogo').src = item['game_logo']
                }
            })

            arrInvite = []
            InvitePlayer(id)
            renderInviteList()
        }
    };
    xhttp.open("GET", url2, true);
    xhttp.send();

    var url = '/getPlayerList/' + idGame + '/team/' + idTeam;
    var xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var obj = JSON.parse(this.responseText);
            document.getElementById('listPlayerModal').innerHTML = ""

            if (Object.entries(obj).length === 0 && obj.constructor === Object) {
                obj.forEach(function (item, index) {
                    var image_user = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/userImage/" + item['user_image']

                    if (item['role'][0] && item['role'][1]) {
                        document.getElementById('listPlayerModal').innerHTML += renderPlayerList(item['user_ID'], item['user_name'], image_user, item['rank_total'], item['role'][0]['role_name'], item['role'][1]['role_name'])

                        console.log(item['role'][0]['role_name'], "name")
                    } else if (item['role'][0]) {
                        document.getElementById('listPlayerModal').innerHTML += renderPlayerList(item['user_ID'], item['user_name'], image_user, item['rank_total'], item['role'][0]['role_name'], "")
                    } else {
                        document.getElementById('listPlayerModal').innerHTML += renderPlayerList(item['user_ID'], item['user_name'], image_user, item['rank_total'], "", "")

                        console.log("none role")
                    }
                })
            } else {
                document.getElementById('listPlayerModal').innerHTML += "<div class=\"col-12 px-4 py-5\">\n" +
                    "                        <div class=\"row\">\n" +
                    "                            <div class=\"col-12 d-flex justify-content-center\">\n" +
                    "                                <img src=\"../data-image/error.svg\" width=\"auto\" height=\"100px\">\n" +
                    "                            </div>\n" +
                    "                        </div>\n" +
                    "                        <div class=\"row mt-4\">\n" +
                    "                            <div class=\"col-12 text-center\">\n" +
                    "                                <h2 class=\"text-white label-font-Bold\" style=\"font-size: 24px\">Oops!</h2>\n" +
                    "                            </div>\n" +
                    "                        </div>\n" +
                    "                        <div class=\"row\">\n" +
                    "                            <div class=\"col-12 text-center\">\n" +
                    "                                <h2 class=\"text-white label-font-Condensed-Thin mb-0\" style=\"font-size: 20px\">Not found any player</h2>\n" +
                    "                            </div>\n" +
                    "                        </div>\n" +
                    "                    </div>"
            }
        }
    };
    xhttp2.open("GET", url, true);
    xhttp2.send();
}

function renderPlayerList(user_id, user_name, user_image, rank_total, role1, role2) {
    if (role1 && role2) {
        var render = "<div class=\"col-6\">\n" +
            "    <div class=\"col-12 p-2 \">\n" +
            "        <div class=\" player-box\" style=\"background-color: rgba(255,255,255,0.1); height: 160px; border-radius: 8px\">\n" +
            "            <div class=\"row px-4 pt-3\">\n" +
            "                <div id=\"\" class=\"col-4 pl-2 \">\n" +
            "                    <img src=" + user_image + " height=\"100px\" width=\"auto\" style=\"border-radius: 50px;\">\n" +
            "                </div>\n" +
            "                <div class=\"col-8 p-0\">\n" +
            "                    <div class=\"row pr-4\" style=\"height: 84px\">\n" +
            "                        <div class=\"col-8 pt-2\" style=\"height: 24px\">\n" +
            "                            <p class=\"text-white label-font-Bold\" style=\"font-size: 16px; word-wrap: break-word;\">" + user_name + "</p>\n" +
            "                            <div class=\"row pl-3\">\n" +
            "                                <div class=\"box-role mr-2\">\n" +
            "                                    <label class=\"text-white\">" + role1 + "</label>\n" +
            "                                </div>\n" +
            "                                <div class=\"box-role mr-2\">\n" +
            "                                    <label class=\"text-white\">" + role2 + "</label>\n" +
            "                                </div>\n" +
            "                            </div>\n" +
            "                        </div>\n" +
            "                        <div class=\"col-4 pl-0 \">\n" +
            "                            <div class=\"row justify-content-end\">\n" +
            "                                <div class=\"pt-2\">\n" +
            "                                    <div class=\"label-font-Condensed-Bold pl-2\" style=\"color: #ffffff; font-size: 10px\">\n" +
            "                                        <h7>RANKING</h7>\n" +
            "                                    </div>\n" +
            "                                    <div class=\"label-font-Condensed-Bold pl-2\" style=\"font-size: 24px;color: #F11D72;text-shadow: 0px 0px 6px #F11D72;line-height: 100%\">\n" +
            "                                        <p>" + rank_total + "</p>\n" +
            "                                    </div>\n" +
            "                                </div>\n" +
            "                            </div>\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "                    <div class=\"row justify-content-end pl-3 pr-4\">\n" +
            "                        <div class=\"col-12 btn btn-primary light-btn\" onclick=\"InvitePlayer(" + user_id + ")\" style=\"box-shadow: none;padding-top: 10px; height: 40px;border-radius: 10px\">\n" +
            "                            <label class=\"label-font-Condensed-Regular\" style=\"font-size: 14px\">INVITE</label>\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "                </div>\n" +
            "            </div>\n" +
            "        </div>\n" +
            "    </div>\n" +
            "</div>"
    } else if (role1) {
        var render = "<div class=\"col-6\">\n" +
            "    <div class=\"col-12 p-2 \">\n" +
            "        <div class=\" player-box\" style=\"background-color: rgba(255,255,255,0.1); height: 160px; border-radius: 8px\">\n" +
            "            <div class=\"row px-4 pt-3\">\n" +
            "                <div id=\"\" class=\"col-4 pl-2 \">\n" +
            "                    <img src=" + user_image + " height=\"100px\" width=\"auto\" style=\"border-radius: 50px;\">\n" +
            "                </div>\n" +
            "                <div class=\"col-8 p-0\">\n" +
            "                    <div class=\"row pr-4\" style=\"height: 84px\">\n" +
            "                        <div class=\"col-8 pt-2\" style=\"height: 24px\">\n" +
            "                            <p class=\"text-white label-font-Bold\" style=\"font-size: 16px; word-wrap: break-word;\">" + user_name + "</p>\n" +
            "                            <div class=\"row pl-3\">\n" +
            "                                <div class=\"box-role mr-2\">\n" +
            "                                    <label class=\"text-white\">" + role1 + "</label>\n" +
            "                                </div>\n" +
            "                            </div>\n" +
            "                        </div>\n" +
            "                        <div class=\"col-4 pl-0 \">\n" +
            "                            <div class=\"row justify-content-end\">\n" +
            "                                <div class=\"pt-2\">\n" +
            "                                    <div class=\"label-font-Condensed-Bold pl-2\" style=\"color: #ffffff; font-size: 10px\">\n" +
            "                                        <h7>RANKING</h7>\n" +
            "                                    </div>\n" +
            "                                    <div class=\"label-font-Condensed-Bold pl-2\" style=\"font-size: 24px;color: #F11D72;text-shadow: 0px 0px 6px #F11D72;line-height: 100%\">\n" +
            "                                        <p>" + rank_total + "</p>\n" +
            "                                    </div>\n" +
            "                                </div>\n" +
            "                            </div>\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "                    <div class=\"row justify-content-end pl-3 pr-4\">\n" +
            "                        <div class=\"col-12 btn btn-primary light-btn\" onclick=\"InvitePlayer(" + user_id + ")\" style=\"box-shadow: none;padding-top: 10px; height: 40px;border-radius: 10px\">\n" +
            "                            <label class=\"label-font-Condensed-Regular\" style=\"font-size: 14px\">INVITE</label>\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "                </div>\n" +
            "            </div>\n" +
            "        </div>\n" +
            "    </div>\n" +
            "</div>"
    } else {
        var render = "<div class=\"col-6\">\n" +
            "    <div class=\"col-12 p-2 \">\n" +
            "        <div class=\" player-box\" style=\"background-color: rgba(255,255,255,0.1); height: 160px; border-radius: 8px\">\n" +
            "            <div class=\"row px-4 pt-3\">\n" +
            "                <div id=\"\" class=\"col-4 pl-2 \">\n" +
            "                    <img src=" + user_image + " height=\"100px\" width=\"auto\" style=\"border-radius: 50px;\">\n" +
            "                </div>\n" +
            "                <div class=\"col-8 p-0\">\n" +
            "                    <div class=\"row pr-4\" style=\"height: 84px\">\n" +
            "                        <div class=\"col-8 pt-2\" style=\"height: 24px\">\n" +
            "                            <p class=\"text-white label-font-Bold\" style=\"font-size: 16px; word-wrap: break-word;\">" + user_name + "</p>\n" +
            "                            <div class=\"row pl-3\">\n" +
            "                            </div>\n" +
            "                        </div>\n" +
            "                        <div class=\"col-4 pl-0 \">\n" +
            "                            <div class=\"row justify-content-end\">\n" +
            "                                <div class=\"pt-2\">\n" +
            "                                    <div class=\"label-font-Condensed-Bold pl-2\" style=\"color: #ffffff; font-size: 10px\">\n" +
            "                                        <h7>RANKING</h7>\n" +
            "                                    </div>\n" +
            "                                    <div class=\"label-font-Condensed-Bold pl-2\" style=\"font-size: 24px;color: #F11D72;text-shadow: 0px 0px 6px #F11D72;line-height: 100%\">\n" +
            "                                        <p>" + rank_total + "</p>\n" +
            "                                    </div>\n" +
            "                                </div>\n" +
            "                            </div>\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "                    <div class=\"row justify-content-end pl-3 pr-4\">\n" +
            "                        <div class=\"col-12 btn btn-primary light-btn\" onclick=\"InvitePlayer(" + user_id + ")\" style=\"box-shadow: none;padding-top: 10px; height: 40px;border-radius: 10px\">\n" +
            "                            <label class=\"label-font-Condensed-Regular\" style=\"font-size: 14px\">INVITE</label>\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "                </div>\n" +
            "            </div>\n" +
            "        </div>\n" +
            "    </div>\n" +
            "</div>"
    }

    return render;
}

function selectRolePlayer(id) {
    var idGame = document.getElementById('gameList').value
    var url = 'getPlayerListRole/' + idGame + '/role/' + id

    console.log(url);
    var xhttp = new XMLHttpRequest();
    var render = ""
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var obj = JSON.parse(this.responseText);
            document.getElementById('listPlayerModal').innerHTML = ""
            obj.forEach(function (item, index) {
                console.log(item);
                var image_user = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/userImage/" + item['user_image']

                if (id == 'all') {
                    if (item['role'][0] && item['role'][1]) {
                        document.getElementById('listPlayerModal').innerHTML += renderPlayerList(item['user_ID'], item['user_name'], image_user, item['rank_total'], item['role'][0]['role_name'], item['role'][1]['role_name'])

                        console.log(item['role'][0]['role_name'], "name")
                    } else if (item['role'][0]) {
                        document.getElementById('listPlayerModal').innerHTML += renderPlayerList(item['user_ID'], item['user_name'], image_user, item['rank_total'], item['role'][0]['role_name'], "")
                    } else {
                        document.getElementById('listPlayerModal').innerHTML += renderPlayerList(item['user_ID'], item['user_name'], image_user, item['rank_total'], "", "")

                        console.log("none role")
                    }
                } else {
                    document.getElementById('listPlayerModal').innerHTML += renderPlayerList(item['user_ID'], item['user_name'], image_user, item['rank_total'], item['role_name'], "")
                }
            })
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}

function InvitePlayer(id) {
    var xhttp = new XMLHttpRequest();
    var idGame = document.getElementById('gameList').value
    var url = 'getPlayerWithID/' + id + '/game/' + idGame
    $('#exampleModal').modal('hide')

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var obj = JSON.parse(this.responseText);
            console.log(obj);

            if (arrInvite <= 0) {
                arrInvite.push(obj);
            } else {
                var checkValue = arrInvite.find(function (item) {
                    return id == item['user_ID']
                })
                if (checkValue) {
                    $("#isReadyModal").modal()
                    // alert('ซ้ำ')
                } else {
                    arrInvite.push(obj);
                }
            }
            renderInviteList()
        }
    };

    xhttp.open("GET", url, true);
    xhttp.send();
}

function renderInviteList() {
    var i = 0;
    var render = "";
    document.getElementById('boxManagerTeam').innerHTML = "";
    document.getElementById('countInvite').innerText = arrInvite.length + "/6"

    var image_rank = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/stats_icon/three-stars.svg"
    var image_won = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/stats_icon/trophy.svg"
    var image_kill = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/stats_icon/skull.svg"
    var image_plus = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/plus.svg"
    var image_cancel = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/cancel.svg"

    checkComplertTeam();

    arrInvite.forEach(function (item) {
        var image_user = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/userImage/" + item['user_image']

        render += "<div class=\"col-2\">\n" +
            "    <div style=\"height: 324px;background-color: rgba(0,0,0,0.25); border-radius: 8px\">\n" +
            "        <div class=\"row pt-4\">\n" +
            "            <div class=\"col d-flex justify-content-center\">\n" +
            "                <img src=" + image_user + " height=\"100px\" style=\"border-radius: 50px\">\n" +
            "                <img onclick=\"deletePlayer(" + item['user_ID'] + ")\" src=" + image_cancel + " width=\"18px\" height=\"18px\" style=\"cursor: pointer;position: absolute;right: 25px;top: -3px;\">\n" +
            "            </div>\n" +
            "        </div>\n" +
            "        <div class=\"row mx-0 pt-2\">\n" +
            "            <div class=\"col d-flex justify-content-center\">\n" +
            "                <h5 class=\"text-white label-font-Condensed-Bold threeDot\">" + item['user_name'] + "</h5>\n" +
            "            </div>\n" +
            "        </div>\n" +
            "        <div class=\"row mx-0 mb-2 justify-content-center\">\n"

        item['role'].forEach(function (role) {
            render +=
                "            <div class=\"box-role mr-2\">\n" +
                "                <label class=\"text-white\">" + role['role_name'] + "</label>\n" +
                "            </div>\n"
        })

        render += "</div>" +
            "        <div class=\"row pt-0\">\n" +
            "           <div class=\"col\">\n" +
            "               <div class=\"row mx-0 px-4\">\n" +
            "                    <div class=\"col-6 p-0 pt-1 d-flex justify-content-center\">\n" +
            "                        <img src=" + image_rank + " height=\"30px\">\n" +
            "                    </div>\n" +
            "                    <div class=\"col-6 p-0\">\n" +
            "                        <div class=\"label-font-Condensed-Bold pl-2\" style=\"color: #9EA1A5; font-size: 10px\">\n" +
            "                            <h7>RANKING</h7>\n" +
            "                        </div>\n" +
            "                        <div class=\"text-white label-font-Condensed-Regular pl-2\" style=\"font-size: 16px\">\n" +
            "                            <p class=\"mb-1\">" + item['rank_total'] + "</p>\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "               </div>\n" +
            "            </div>\n" +
            "        </div>\n" +
            "        <div class=\"row pt-0\">\n" +
            "           <div class=\"col\">\n" +
            "                <div class=\"row mx-0 px-4\">\n" +
            "                    <div class=\"col-6 p-0 pt-1 d-flex justify-content-center\">\n" +
            "                        <img src=" + image_won + " height=\"30px\">\n" +
            "                    </div>\n" +
            "                    <div class=\"col-6 p-0\">\n" +
            "                        <div class=\"label-font-Condensed-Bold pl-2\" style=\"color: #9EA1A5; font-size: 10px\">\n" +
            "                            <h7>GAME WON</h7>\n" +
            "                        </div>\n" +
            "                        <div class=\"text-white label-font-Condensed-Regular pl-2\" style=\"font-size: 16px\">\n" +
            "                            <p class=\"mb-1\">" + item['won_total'] + "</p>\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "                </div>\n" +
            "            </div>\n" +
            "        </div>\n" +
            "        <div class=\"row pt-0\">\n" +
            "           <div class=\"col\">\n" +
            "                <div class=\"row mx-0 px-4\">\n" +
            "                    <div class=\"col-6 p-0 pt-1 d-flex justify-content-center\">\n" +
            "                        <img src=" + image_kill + " height=\"30px\">\n" +
            "                    </div>\n" +
            "                    <div class=\"col-6 p-0\">\n" +
            "                        <div class=\"label-font-Condensed-Bold pl-2\" style=\"color: #9EA1A5; font-size: 10px\">\n" +
            "                            <h7>KILL</h7>\n" +
            "                        </div>\n" +
            "                        <div class=\"text-white label-font-Condensed-Regular pl-2\" style=\"font-size: 16px\">\n" +
            "                            <p class=\"mb-1\">" + item['kill_total'] + "</p>\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "                </div>\n" +
            "            </div>\n" +
            "        </div>\n" +
            "    </div>\n" +
            "</div>"
        i++;
    })

    for (i; i < 6; i++) {
        render += "<div class=\"open-AddBookDialog col-2\" data-toggle=\"modal\" data-target=\"#exampleModal\" data-article-id={{$i}}>\n" +
            "    <div class=\"d-flex align-items-center justify-content-center\" style=\"height: 324px;background-color: rgba(255,255,255,0.1); border-radius: 8px\">\n" +
            "        <div class=\"row\">\n" +
            "            <div class=\"col-12 \">\n" +
            "                <img src=" + image_plus + " height=\"100px\" style=\"padding: 20px;background-color: rgba(255,255,255,0.1);border-radius: 50px\">\n" +
            "            </div>\n" +
            "        </div>\n" +
            "    </div>\n" +
            "</div>"
    }

    console.log(arrInvite);
    document.getElementById('boxManagerTeam').innerHTML = render;
}

function checkComplertTeam() {
    var arr = []
    var arrId = []
    var idGame = document.getElementById('gameList').value

    arrInvite.forEach(function (item, index) {
        item['role'].forEach(function (role) {
            arr.push(role['role_name']);
        })
        arrId.push(item['user_ID']);
    })

    $('[name=invitePlayer]').val(arrId);
    console.log(document.getElementById('invitePlayer').value);

    if (idGame == 1) {
        if (arrInvite.length == 6 && arr.includes('TANK') && arr.includes('SUPPORT') && arr.includes('DPS')) {
            console.log('true');
            Isready = true
            document.getElementById('teamReady').src = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/Ready.svg"
            document.getElementById('teamManReady').src = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/standing-up-man-Ready.svg"
            $('#countInvite').removeClass("text-pink")
            $('#countInvite').addClass("text-green")
        } else {
            console.log('false');
            Isready = false
            document.getElementById('teamReady').src = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/notReady.svg"
            document.getElementById('teamManReady').src = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/standing-up-man.svg"
            $('#countInvite').removeClass("text-green")
            $('#countInvite').addClass("text-pink")
        }
    } else if (idGame == 2) {
        if (arrInvite.length == 6 && arr.includes('SNIPER') && arr.includes('SUPPORT') && arr.includes('DPS')) {
            console.log('true');
            Isready = true
            document.getElementById('teamReady').src = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/Ready.svg"
            document.getElementById('teamManReady').src = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/standing-up-man-Ready.svg"
            $('#countInvite').removeClass("text-pink")
            $('#countInvite').addClass("text-green")
        } else {
            console.log('false');
            Isready = false
            document.getElementById('teamReady').src = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/notReady.svg"
            document.getElementById('teamManReady').src = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/standing-up-man.svg"
            $('#countInvite').removeClass("text-green")
            $('#countInvite').addClass("text-pink")
        }
    } else if (idGame == 3) {
        if (arrInvite.length == 6 && arr.includes('TANK') && arr.includes('SUPPORT') && arr.includes('DPS')) {
            console.log('true');
            Isready = true
            document.getElementById('teamReady').src = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/Ready.svg"
            document.getElementById('teamManReady').src = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/standing-up-man-Ready.svg"
            $('#countInvite').removeClass("text-pink")
            $('#countInvite').addClass("text-green")
        } else {
            console.log('false');
            Isready = false
            document.getElementById('teamReady').src = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/notReady.svg"
            document.getElementById('teamManReady').src = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/standing-up-man.svg"
            $('#countInvite').removeClass("text-green")
            $('#countInvite').addClass("text-pink")
        }
    } else {
        console.log('false');
        Isready = false
        document.getElementById('teamReady').src = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/notReady.svg"
        document.getElementById('teamManReady').src = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/standing-up-man.svg"
        $('#countInvite').removeClass("text-green")
        $('#countInvite').addClass("text-pink")
    }
}

function checkIsready() {
    if (Isready == false) {
        $("#isReadyModal").modal()

        return false;
    }
}

function deletePlayer(id) {
    var index = arrInvite.map(function (e) {
        return e['user_ID'];
    }).indexOf(id);

    if (index > -1) {
        arrInvite.splice(index, 1);
    }
    renderInviteList()
}

function previewFile() {
    var file = document.querySelector('input[type=file]').files[0];
    var preview = document.getElementById('imagePreview');
    var reader = new FileReader();

    reader.addEventListener("load", function () {
        preview.src = reader.result;
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }
}

function renderMyMember() {
    var i = 0;
    var render = "";
    document.getElementById('boxManagerTeam').innerHTML = "";
    document.getElementById('countInvite').innerText = arrInvite.length + "/6"

    var image_rank = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/stats_icon/three-stars.svg"
    var image_won = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/stats_icon/trophy.svg"
    var image_kill = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/stats_icon/skull.svg"
    var image_plus = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/plus.svg"
    var image_cancel = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/cancel.svg"
    var rootPath = "http://" + window.location.hostname + ":" + window.location.port

    console.log(arrInvite)
    arrInvite.forEach(function (item) {
        var image_user = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/userImage/" + item['user_image']

        if (item['user_verify'] == 1) {
            render += "<div class=\"col-2\">\n" +
                "    <div style=\"height: 324px;background-color: rgba(0,0,0,0.25); border-radius: 8px\">\n" +
                "        <div class=\"row pt-4\">\n" +
                "            <div class=\"col d-flex justify-content-center\">\n" +
                "                <img src=" + image_user + " height=\"100px\" style=\"border-radius: 50px\">\n" +
                "                <img id=\"kickMember\" data-article-id=" + item['user_ID'] + " data-player-name=" + item['user_name'] + " data-player-img=" + image_user + " data-toggle=\"modal\" data-target=\"#kickPlayer\" src=" + image_cancel + " width=\"18px\" height=\"18px\" style=\"cursor: pointer;position: absolute;right: 25px;top: -3px;\">\n" +
                "            </div>\n" +
                "        </div>\n" +
                "        <div class=\"row mx-0 pt-2\">\n" +
                "            <div class=\"col d-flex justify-content-center\">\n" +
                "                <h5 class=\"text-white label-font-Condensed-Bold threeDot\">" + item['user_name'] + "</h5>\n" +
                "            </div>\n" +
                "        </div>\n" +
                "        <div class=\"row mx-0 mb-2 justify-content-center\">\n"

            if (item['role'].length > 0) {
                item['role'].forEach(function (role, index, array) {
                    if (index !== array.length - 1) {
                        render +=
                            "            <div class=\"box-role d-flex align-items-center mr-2\" style=\"background-color: " + role['role_color'] + "\">\n" +
                            "                <img src=" + rootPath + role['game_logo'] + " height=\"14px\" width=\"14px\">\n" +
                            "                <label class=\"text-white ml-1 m-0\">" + role['role_name'] + "</label>\n" +
                            "            </div>\n"
                    } else {
                        render +=
                            "            <div class=\"box-role d-flex align-items-center\" style=\"background-color: " + role['role_color'] + "\">\n" +
                            "                <img src=" + rootPath + role['game_logo'] + " height=\"14px\" width=\"14px\">\n" +
                            "                <label class=\"text-white ml-1 m-0\">" + role['role_name'] + "</label>\n" +
                            "            </div>\n"
                    }
                })
            } else {
                render +=
                    "            <div style=\"height: 24px\"></div>\n"
            }

            render += "</div>" +
                "        <div class=\"row pt-0\">\n" +
                "           <div class=\"col\">\n" +
                "               <div class=\"row mx-0 px-4\">\n" +
                "                    <div class=\"col-6 p-0 pt-1 d-flex justify-content-center\">\n" +
                "                        <img src=" + image_rank + " height=\"30px\">\n" +
                "                    </div>\n" +
                "                    <div class=\"col-6 p-0\">\n" +
                "                        <div class=\"label-font-Condensed-Bold pl-2\" style=\"color: #9EA1A5; font-size: 10px\">\n" +
                "                            <h7>RANKING</h7>\n" +
                "                        </div>\n" +
                "                        <div class=\"text-white label-font-Condensed-Regular pl-2\" style=\"font-size: 16px\">\n" +
                "                            <p class=\"mb-1\">" + item['rank_total'] + "</p>\n" +
                "                        </div>\n" +
                "                    </div>\n" +
                "               </div>\n" +
                "            </div>\n" +
                "        </div>\n" +
                "        <div class=\"row pt-0\">\n" +
                "           <div class=\"col\">\n" +
                "                <div class=\"row mx-0 px-4\">\n" +
                "                    <div class=\"col-6 p-0 pt-1 d-flex justify-content-center\">\n" +
                "                        <img src=" + image_won + " height=\"30px\">\n" +
                "                    </div>\n" +
                "                    <div class=\"col-6 p-0\">\n" +
                "                        <div class=\"label-font-Condensed-Bold pl-2\" style=\"color: #9EA1A5; font-size: 10px\">\n" +
                "                            <h7>GAME WON</h7>\n" +
                "                        </div>\n" +
                "                        <div class=\"text-white label-font-Condensed-Regular pl-2\" style=\"font-size: 16px\">\n" +
                "                            <p class=\"mb-1\">" + item['won_total'] + "</p>\n" +
                "                        </div>\n" +
                "                    </div>\n" +
                "                </div>\n" +
                "            </div>\n" +
                "        </div>\n" +
                "        <div class=\"row pt-0\">\n" +
                "           <div class=\"col\">\n" +
                "                <div class=\"row mx-0 px-4\">\n" +
                "                    <div class=\"col-6 p-0 pt-1 d-flex justify-content-center\">\n" +
                "                        <img src=" + image_kill + " height=\"30px\">\n" +
                "                    </div>\n" +
                "                    <div class=\"col-6 p-0\">\n" +
                "                        <div class=\"label-font-Condensed-Bold pl-2\" style=\"color: #9EA1A5; font-size: 10px\">\n" +
                "                            <h7>KILL</h7>\n" +
                "                        </div>\n" +
                "                        <div class=\"text-white label-font-Condensed-Regular pl-2\" style=\"font-size: 16px\">\n" +
                "                            <p class=\"mb-1\">" + item['kill_total'] + "</p>\n" +
                "                        </div>\n" +
                "                    </div>\n" +
                "                </div>\n" +
                "            </div>\n" +
                "        </div>\n" +
                "    </div>\n" +
                "</div>"
        } else {
            render += "<div class=\"col-2\">\n" +
                "    <div style=\"height: 324px;background-color: rgba(0,0,0,0.25); border-radius: 8px\">\n" +
                "        <div class=\"row pt-4\">\n" +
                "            <div class=\"col d-flex justify-content-center\">\n" +
                "                <img src=" + image_user + " height=\"100px\" style=\"border-radius: 50px\">\n" +
                "                <img id=\"kickMember\" data-article-id=" + item['user_ID'] + " data-player-name=" + item['user_name'] + " data-player-img=" + image_user + " data-toggle=\"modal\" data-target=\"#kickPlayer\"  src=" + image_cancel + " width=\"18px\" height=\"18px\" style=\"cursor: pointer;position: absolute;right: 25px;top: -3px;\">\n" +
                "            </div>\n" +
                "        </div>\n" +
                "        <div class=\"row mx-0 pt-2\">\n" +
                "            <div class=\"col d-flex justify-content-center\">\n" +
                "                <h5 class=\"text-white label-font-Condensed-Bold threeDot\">" + item['user_name'] + "</h5>\n" +
                "            </div>\n" +
                "        </div>\n" +
                "        <div class=\"row mx-0 mb-2 justify-content-center\">\n"

            if (item['role'].length > 0) {
                item['role'].forEach(function (role, index, array) {
                    if (index !== array.length - 1) {
                        render +=
                            "            <div class=\"box-role d-flex align-items-center mr-2\" style=\"background-color: " + role['role_color'] + "\">\n" +
                            "                <img src=" + rootPath + role['game_logo'] + " height=\"14px\" width=\"14px\">\n" +
                            "                <label class=\"text-white ml-1 m-0\">" + role['role_name'] + "</label>\n" +
                            "            </div>\n"
                    } else {
                        render +=
                            "            <div class=\"box-role d-flex align-items-center\" style=\"background-color: " + role['role_color'] + "\">\n" +
                            "                <img src=" + rootPath + role['game_logo'] + " height=\"14px\" width=\"14px\">\n" +
                            "                <label class=\"text-white ml-1 m-0\">" + role['role_name'] + "</label>\n" +
                            "            </div>\n"
                    }
                })
            } else {
                render +=
                    "            <div style=\"height: 24px\"></div>\n"
            }

            render += "</div>" +
                "        <div class=\"row pt-0\">\n" +
                "           <div class=\"col\">\n" +
                "               <div class=\"row mx-0 px-4\">\n" +
                "                    <div class=\"col-6 p-0 pt-1 d-flex justify-content-center\">\n" +
                "                        <img src=" + image_rank + " height=\"30px\">\n" +
                "                    </div>\n" +
                "                    <div class=\"col-6 p-0\">\n" +
                "                        <div class=\"label-font-Condensed-Bold pl-2\" style=\"color: #9EA1A5; font-size: 10px\">\n" +
                "                            <h7>RANKING</h7>\n" +
                "                        </div>\n" +
                "                        <div class=\"text-white label-font-Condensed-Regular pl-2\" style=\"font-size: 16px\">\n" +
                "                            <p class=\"mb-1\">" + item['rank_total'] + "</p>\n" +
                "                        </div>\n" +
                "                    </div>\n" +
                "               </div>\n" +
                "            </div>\n" +
                "        </div>\n" +
                "        <div class=\"row pt-0\">\n" +
                "           <div class=\"col\">\n" +
                "                <div class=\"row mx-0 px-4\">\n" +
                "                    <div class=\"col-6 p-0 pt-1 d-flex justify-content-center\">\n" +
                "                        <img src=" + image_won + " height=\"30px\">\n" +
                "                    </div>\n" +
                "                    <div class=\"col-6 p-0\">\n" +
                "                        <div class=\"label-font-Condensed-Bold pl-2\" style=\"color: #9EA1A5; font-size: 10px\">\n" +
                "                            <h7>GAME WON</h7>\n" +
                "                        </div>\n" +
                "                        <div class=\"text-white label-font-Condensed-Regular pl-2\" style=\"font-size: 16px\">\n" +
                "                            <p class=\"mb-1\">" + item['won_total'] + "</p>\n" +
                "                        </div>\n" +
                "                    </div>\n" +
                "                </div>\n" +
                "            </div>\n" +
                "        </div>\n" +
                "        <div class=\"row pt-0\">\n" +
                "           <div class=\"col\">\n" +
                "                <div class=\"row mx-0 px-4\">\n" +
                "                    <div class=\"col-6 p-0 pt-1 d-flex justify-content-center\">\n" +
                "                        <img src=" + image_kill + " height=\"30px\">\n" +
                "                    </div>\n" +
                "                    <div class=\"col-6 p-0\">\n" +
                "                        <div class=\"label-font-Condensed-Bold pl-2\" style=\"color: #9EA1A5; font-size: 10px\">\n" +
                "                            <h7>KILL</h7>\n" +
                "                        </div>\n" +
                "                        <div class=\"text-white label-font-Condensed-Regular pl-2\" style=\"font-size: 16px\">\n" +
                "                            <p class=\"mb-1\">" + item['kill_total'] + "</p>\n" +
                "                        </div>\n" +
                "                    </div>\n" +
                "                </div>\n" +
                "            </div>\n" +
                "        </div>\n" +
                "        <div class=\"row mx-0\">\n" +
                "            <div class=\"overlay position-relative text-center\" style=\"padding-top: 60px\">\n" +
                "                <span class=\"text-white label-font-Condensed-Bold \" style=\"font-size: 20px\">" + item['expired_invite'] + "</span>\n" +
                "            </div>\n" +
                "        </div>\n" +
                "    </div>\n" +
                "</div>"
        }
        i++;
    })

    for (i; i < 6; i++) {
        render += "<div class=\"open-AddBookDialog col-2\" data-toggle=\"modal\" data-target=\"#exampleModal\" data-article-id={{$i}}>\n" +
            "    <div class=\"d-flex align-items-center justify-content-center\" style=\"height: 324px;background-color: rgba(255,255,255,0.1); border-radius: 8px\">\n" +
            "        <div class=\"row\">\n" +
            "            <div class=\"col-12 \">\n" +
            "                <img src=" + image_plus + " height=\"100px\" style=\"padding: 20px;background-color: rgba(255,255,255,0.1);border-radius: 50px\">\n" +
            "            </div>\n" +
            "        </div>\n" +
            "    </div>\n" +
            "</div>"
    }

    console.log(arrInvite, 'arrInvite');
    document.getElementById('boxManagerTeam').innerHTML = render;
}

function renderMemberList() {
    var i = 0;
    var render = "";
    document.getElementById('boxManagerTeam').innerHTML = "";
    document.getElementById('countInvite').innerText = arrInvite.length + "/6"

    var image_rank = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/stats_icon/three-stars.svg"
    var image_won = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/stats_icon/trophy.svg"
    var image_kill = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/stats_icon/skull.svg"
    var image_plus = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/plus.svg"
    var image_cancel = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/cancel.svg"
    var rootPath = "http://" + window.location.hostname + ":" + window.location.port


    console.log(arrInvite)
    arrInvite.forEach(function (item) {
        var image_user = "http://" + window.location.hostname + ":" + window.location.port + "/data-image/userImage/" + item['user_image']
        var userProfile = "/profile/" + item['user_ID']
        if (item['user_verify'] == 1) {
            render += "<div class=\"col-2\">\n" +
                "    <div style=\"height: 324px;background-color: rgba(0,0,0,0.25); border-radius: 8px\">\n" +
                "        <div class=\"row pt-4\">\n" +
                "            <div class=\"col d-flex justify-content-center\">\n" +
                "        <a href='/profile/" + item['user_ID'] + "'>\n" +
                "                <img src=" + image_user + " height=\"100px\" style=\"border-radius: 50px\">\n" +
                "            </div>\n" +
                "        </a>\n" +
                "        </div>\n" +
                "        <div class=\"row mx-0 pt-2\">\n" +
                "            <div class=\"col d-flex justify-content-center\">\n" +
                "               <a href='/profile/" + item['user_ID'] + "'>\n" +
                "                   <h5 class=\"text-white label-font-Condensed-Bold threeDot\">" + item['user_name'] + "</h5>\n" +
                "               </a>\n" +
                "            </div>\n" +
                "        </div>\n" +
                "        <div class=\"row mx-0 mb-2 justify-content-center\">\n"

            if (item['role'].length > 0) {
                item['role'].forEach(function (role, index, array) {
                    if (index !== array.length - 1) {
                        render +=
                            "            <div class=\"box-role d-flex align-items-center mr-2\" style=\"background-color: " + role['role_color'] + "\">\n" +
                            "                <img src=" + rootPath + role['game_logo'] + " height=\"14px\" width=\"14px\">\n" +
                            "                <label class=\"text-white ml-1 m-0\">" + role['role_name'] + "</label>\n" +
                            "            </div>\n"
                    } else {
                        render +=
                            "            <div class=\"box-role d-flex align-items-center\" style=\"background-color: " + role['role_color'] + "\">\n" +
                            "                <img src=" + rootPath + role['game_logo'] + " height=\"14px\" width=\"14px\">\n" +
                            "                <label class=\"text-white ml-1 m-0\">" + role['role_name'] + "</label>\n" +
                            "            </div>\n"
                    }
                })
            } else {
                render +=
                    "            <div style=\"height: 24px\"></div>\n"
            }

            render += "</div>" +
                "        <div class=\"row pt-0\">\n" +
                "           <div class=\"col\">\n" +
                "               <div class=\"row mx-0 px-4\">\n" +
                "                    <div class=\"col-6 p-0 pt-1 d-flex justify-content-center\">\n" +
                "                        <img src=" + image_rank + " height=\"30px\">\n" +
                "                    </div>\n" +
                "                    <div class=\"col-6 p-0\">\n" +
                "                        <div class=\"label-font-Condensed-Bold pl-2\" style=\"color: #9EA1A5; font-size: 10px\">\n" +
                "                            <h7>RANKING</h7>\n" +
                "                        </div>\n" +
                "                        <div class=\"text-white label-font-Condensed-Regular pl-2\" style=\"font-size: 16px\">\n" +
                "                            <p class=\"mb-1\">" + item['rank_total'] + "</p>\n" +
                "                        </div>\n" +
                "                    </div>\n" +
                "               </div>\n" +
                "            </div>\n" +
                "        </div>\n" +
                "        <div class=\"row pt-0\">\n" +
                "           <div class=\"col\">\n" +
                "                <div class=\"row mx-0 px-4\">\n" +
                "                    <div class=\"col-6 p-0 pt-1 d-flex justify-content-center\">\n" +
                "                        <img src=" + image_won + " height=\"30px\">\n" +
                "                    </div>\n" +
                "                    <div class=\"col-6 p-0\">\n" +
                "                        <div class=\"label-font-Condensed-Bold pl-2\" style=\"color: #9EA1A5; font-size: 10px\">\n" +
                "                            <h7>GAME WON</h7>\n" +
                "                        </div>\n" +
                "                        <div class=\"text-white label-font-Condensed-Regular pl-2\" style=\"font-size: 16px\">\n" +
                "                            <p class=\"mb-1\">" + item['won_total'] + "</p>\n" +
                "                        </div>\n" +
                "                    </div>\n" +
                "                </div>\n" +
                "            </div>\n" +
                "        </div>\n" +
                "        <div class=\"row pt-0\">\n" +
                "           <div class=\"col\">\n" +
                "                <div class=\"row mx-0 px-4\">\n" +
                "                    <div class=\"col-6 p-0 pt-1 d-flex justify-content-center\">\n" +
                "                        <img src=" + image_kill + " height=\"30px\">\n" +
                "                    </div>\n" +
                "                    <div class=\"col-6 p-0\">\n" +
                "                        <div class=\"label-font-Condensed-Bold pl-2\" style=\"color: #9EA1A5; font-size: 10px\">\n" +
                "                            <h7>KILL</h7>\n" +
                "                        </div>\n" +
                "                        <div class=\"text-white label-font-Condensed-Regular pl-2\" style=\"font-size: 16px\">\n" +
                "                            <p class=\"mb-1\">" + item['kill_total'] + "</p>\n" +
                "                        </div>\n" +
                "                    </div>\n" +
                "                </div>\n" +
                "            </div>\n" +
                "        </div>\n" +
                "    </div>\n" +
                "</div>"
        } else {
            render += "<div class=\"col-2\">\n" +
                "    <div style=\"height: 324px;background-color: rgba(0,0,0,0.25); border-radius: 8px\">\n" +
                "        <div class=\"row pt-4\">\n" +
                "            <div class=\"col d-flex justify-content-center\">\n" +
                "                <img src=" + image_user + " height=\"100px\" style=\"border-radius: 50px\">\n" +
                "                <img id=\"kickMember\" data-article-id=" + item['user_ID'] + " data-player-name=" + item['user_name'] + " data-player-img=" + image_user + " data-toggle=\"modal\" data-target=\"#kickPlayer\"  src=" + image_cancel + " width=\"18px\" height=\"18px\" style=\"cursor: pointer;position: absolute;right: 25px;top: -3px;\">\n" +
                "            </div>\n" +
                "        </div>\n" +
                "        <div class=\"row mx-0 pt-2\">\n" +
                "            <div class=\"col d-flex justify-content-center\">\n" +
                "                <h5 class=\"text-white label-font-Condensed-Bold threeDot\">" + item['user_name'] + "</h5>\n" +
                "            </div>\n" +
                "        </div>\n" +
                "        <div class=\"row mx-0 mb-2 justify-content-center\">\n"

            if (item['role'].length > 0) {
                item['role'].forEach(function (role, index, array) {
                    if (index !== array.length - 1) {
                        render +=
                            "            <div class=\"box-role d-flex align-items-center mr-2\" style=\"background-color: " + role['role_color'] + "\">\n" +
                            "                <img src=" + rootPath + role['game_logo'] + " height=\"14px\" width=\"14px\">\n" +
                            "                <label class=\"text-white ml-1 m-0\">" + role['role_name'] + "</label>\n" +
                            "            </div>\n"
                    } else {
                        render +=
                            "            <div class=\"box-role d-flex align-items-center\" style=\"background-color: " + role['role_color'] + "\">\n" +
                            "                <img src=" + rootPath + role['game_logo'] + " height=\"14px\" width=\"14px\">\n" +
                            "                <label class=\"text-white ml-1 m-0\">" + role['role_name'] + "</label>\n" +
                            "            </div>\n"
                    }
                })
            } else {
                render +=
                    "            <div style=\"height: 24px\"></div>\n"
            }

            render += "</div>" +
                "        <div class=\"row pt-0\">\n" +
                "           <div class=\"col\">\n" +
                "               <div class=\"row mx-0 px-4\">\n" +
                "                    <div class=\"col-6 p-0 pt-1 d-flex justify-content-center\">\n" +
                "                        <img src=" + image_rank + " height=\"30px\">\n" +
                "                    </div>\n" +
                "                    <div class=\"col-6 p-0\">\n" +
                "                        <div class=\"label-font-Condensed-Bold pl-2\" style=\"color: #9EA1A5; font-size: 10px\">\n" +
                "                            <h7>RANKING</h7>\n" +
                "                        </div>\n" +
                "                        <div class=\"text-white label-font-Condensed-Regular pl-2\" style=\"font-size: 16px\">\n" +
                "                            <p class=\"mb-1\">" + item['rank_total'] + "</p>\n" +
                "                        </div>\n" +
                "                    </div>\n" +
                "               </div>\n" +
                "            </div>\n" +
                "        </div>\n" +
                "        <div class=\"row pt-0\">\n" +
                "           <div class=\"col\">\n" +
                "                <div class=\"row mx-0 px-4\">\n" +
                "                    <div class=\"col-6 p-0 pt-1 d-flex justify-content-center\">\n" +
                "                        <img src=" + image_won + " height=\"30px\">\n" +
                "                    </div>\n" +
                "                    <div class=\"col-6 p-0\">\n" +
                "                        <div class=\"label-font-Condensed-Bold pl-2\" style=\"color: #9EA1A5; font-size: 10px\">\n" +
                "                            <h7>GAME WON</h7>\n" +
                "                        </div>\n" +
                "                        <div class=\"text-white label-font-Condensed-Regular pl-2\" style=\"font-size: 16px\">\n" +
                "                            <p class=\"mb-1\">" + item['won_total'] + "</p>\n" +
                "                        </div>\n" +
                "                    </div>\n" +
                "                </div>\n" +
                "            </div>\n" +
                "        </div>\n" +
                "        <div class=\"row pt-0\">\n" +
                "           <div class=\"col\">\n" +
                "                <div class=\"row mx-0 px-4\">\n" +
                "                    <div class=\"col-6 p-0 pt-1 d-flex justify-content-center\">\n" +
                "                        <img src=" + image_kill + " height=\"30px\">\n" +
                "                    </div>\n" +
                "                    <div class=\"col-6 p-0\">\n" +
                "                        <div class=\"label-font-Condensed-Bold pl-2\" style=\"color: #9EA1A5; font-size: 10px\">\n" +
                "                            <h7>KILL</h7>\n" +
                "                        </div>\n" +
                "                        <div class=\"text-white label-font-Condensed-Regular pl-2\" style=\"font-size: 16px\">\n" +
                "                            <p class=\"mb-1\">" + item['kill_total'] + "</p>\n" +
                "                        </div>\n" +
                "                    </div>\n" +
                "                </div>\n" +
                "            </div>\n" +
                "        </div>\n" +
                "        <div class=\"row mx-0\">\n" +
                "            <div class=\"overlay position-relative text-center\" style=\"padding-top: 60px\">\n" +
                "                <span class=\"text-white label-font-Condensed-Bold \" style=\"font-size: 20px\">" + item['expired_invite'] + "</span>\n" +
                "            </div>\n" +
                "        </div>\n" +
                "    </div>\n" +
                "</div>"
        }
        i++;
    })

    for (i; i < 6; i++) {
        render += "<div class=\"col-2\">\n" +
            "    <div class=\"align-self-center\" style=\"height: 324px;padding-top: 50%;background-color: rgba(255,255,255,0.1); border-radius: 8px\">\n" +
            "        <div class=\"row\">\n" +
            "            <div class=\"col-12 d-flex justify-content-center\">\n" +
            "                <img src=\"../data-image/noneMember.svg\" height=\"100px\" width=\"100px\" style=\"padding: 20px;background-color: rgba(255,255,255,0.1);border-radius: 50px\">\n" +
            "            </div>\n" +
            "        </div>\n" +
            "        <div class=\"row\">\n" +
            "            <div class=\"col-12 text-center\">\n" +
            "                <span class=\"text-white\">Wait other player…</span>\n" +
            "            </div>\n" +
            "        </div>\n" +
            "    </div>\n" +
            "</div>";
    }

    // "<div class=\"open-AddBookDialog col-2\" data-toggle=\"modal\" data-target=\"#exampleModal\" data-article-id={{$i}}>\n" +
    // "    <div class=\"d-flex align-items-center justify-content-center\" style=\"height: 324px;background-color: rgba(255,255,255,0.1); border-radius: 8px\">\n" +
    // "        <div class=\"row\">\n" +
    // "            <div class=\"col-12 \">\n" +
    // "                <img src="+image_plus+" height=\"100px\" style=\"padding: 20px;background-color: rgba(255,255,255,0.1);border-radius: 50px\">\n" +
    // "            </div>\n" +
    // "        </div>\n" +
    // "    </div>\n" +
    // "</div>"

    console.log(arrInvite, 'arrInvite');
    document.getElementById('boxManagerTeam').innerHTML = render;
}

function renderListAddMember(user_id, user_name, user_image, rank_total, role1, role2) {
    if (role1 && role2) {
        var render = "<div class=\"col-6\">\n" +
            "    <div class=\"col-12 p-2 \">\n" +
            "        <div class=\" player-box\" style=\"background-color: rgba(255,255,255,0.1); height: 160px; border-radius: 8px\">\n" +
            "            <div class=\"row px-4 pt-3\">\n" +
            "                <div id=\"\" class=\"col-4 pl-2 \">\n" +
            "                    <img src=" + user_image + " height=\"100px\" width=\"auto\" style=\"border-radius: 50px;\">\n" +
            "                </div>\n" +
            "                <div class=\"col-8 p-0\">\n" +
            "                    <div class=\"row pr-4\" style=\"height: 84px\">\n" +
            "                        <div class=\"col-8 pt-2\" style=\"height: 24px\">\n" +
            "                            <p class=\"text-white label-font-Bold\" style=\"font-size: 16px; word-wrap: break-word;\">" + user_name + "</p>\n" +
            "                            <div class=\"row pl-3\">\n" +
            "                                <div class=\"box-role mr-2\">\n" +
            "                                    <label class=\"text-white\">" + role1 + "</label>\n" +
            "                                </div>\n" +
            "                                <div class=\"box-role mr-2\">\n" +
            "                                    <label class=\"text-white\">" + role2 + "</label>\n" +
            "                                </div>\n" +
            "                            </div>\n" +
            "                        </div>\n" +
            "                        <div class=\"col-4 pl-0 \">\n" +
            "                            <div class=\"row justify-content-end\">\n" +
            "                                <div class=\"pt-2\">\n" +
            "                                    <div class=\"label-font-Condensed-Bold pl-2\" style=\"color: #ffffff; font-size: 10px\">\n" +
            "                                        <h7>RANKING</h7>\n" +
            "                                    </div>\n" +
            "                                    <div class=\"label-font-Condensed-Bold pl-2\" style=\"font-size: 24px;color: #F11D72;text-shadow: 0px 0px 6px #F11D72;line-height: 100%\">\n" +
            "                                        <p>" + rank_total + "</p>\n" +
            "                                    </div>\n" +
            "                                </div>\n" +
            "                            </div>\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "                    <div class=\"row justify-content-end pl-3 pr-4\">\n" +
            "                        <button class=\"col-12 btn btn-primary light-btn\" name=\"playerID\" type=\"submit\" value=" + user_id + " \" style=\"box-shadow: none;padding-top: 10px; height: 40px;border-radius: 10px\">\n" +
            "                            <label class=\"label-font-Condensed-Regular\" style=\"font-size: 14px\">INVITE</label>\n" +
            "                        </button>\n" +
            "                    </div>\n" +
            "                </div>\n" +
            "            </div>\n" +
            "        </div>\n" +
            "    </div>\n" +
            "</div>"
    } else if (role1) {
        var render = "<div class=\"col-6\">\n" +
            "    <div class=\"col-12 p-2 \">\n" +
            "        <div class=\" player-box\" style=\"background-color: rgba(255,255,255,0.1); height: 160px; border-radius: 8px\">\n" +
            "            <div class=\"row px-4 pt-3\">\n" +
            "                <div id=\"\" class=\"col-4 pl-2 \">\n" +
            "                    <img src=" + user_image + " height=\"100px\" width=\"auto\" style=\"border-radius: 50px;\">\n" +
            "                </div>\n" +
            "                <div class=\"col-8 p-0\">\n" +
            "                    <div class=\"row pr-4\" style=\"height: 84px\">\n" +
            "                        <div class=\"col-8 pt-2\" style=\"height: 24px\">\n" +
            "                            <p class=\"text-white label-font-Bold\" style=\"font-size: 16px; word-wrap: break-word;\">" + user_name + "</p>\n" +
            "                            <div class=\"row pl-3\">\n" +
            "                                <div class=\"box-role mr-2\">\n" +
            "                                    <label class=\"text-white\">" + role1 + "</label>\n" +
            "                                </div>\n" +
            "                            </div>\n" +
            "                        </div>\n" +
            "                        <div class=\"col-4 pl-0 \">\n" +
            "                            <div class=\"row justify-content-end\">\n" +
            "                                <div class=\"pt-2\">\n" +
            "                                    <div class=\"label-font-Condensed-Bold pl-2\" style=\"color: #ffffff; font-size: 10px\">\n" +
            "                                        <h7>RANKING</h7>\n" +
            "                                    </div>\n" +
            "                                    <div class=\"label-font-Condensed-Bold pl-2\" style=\"font-size: 24px;color: #F11D72;text-shadow: 0px 0px 6px #F11D72;line-height: 100%\">\n" +
            "                                        <p>" + rank_total + "</p>\n" +
            "                                    </div>\n" +
            "                                </div>\n" +
            "                            </div>\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "                    <div class=\"row justify-content-end pl-3 pr-4\">\n" +
            "                        <button class=\"col-12 btn btn-primary light-btn\" name=\"playerID\" type=\"submit\" value=" + user_id + " style=\"box-shadow: none;padding-top: 10px; height: 40px;border-radius: 10px\">\n" +
            "                            <label class=\"label-font-Condensed-Regular\" style=\"font-size: 14px\">INVITE</label>\n" +
            "                        </button>\n" +
            "                    </div>\n" +
            "                </div>\n" +
            "            </div>\n" +
            "        </div>\n" +
            "    </div>\n" +
            "</div>"
    } else {
        var render = "<div class=\"col-6\">\n" +
            "    <div class=\"col-12 p-2 \">\n" +
            "        <div class=\" player-box\" style=\"background-color: rgba(255,255,255,0.1); height: 160px; border-radius: 8px\">\n" +
            "            <div class=\"row px-4 pt-3\">\n" +
            "                <div id=\"\" class=\"col-4 pl-2 \">\n" +
            "                    <img src=" + user_image + " height=\"100px\" width=\"auto\" style=\"border-radius: 50px;\">\n" +
            "                </div>\n" +
            "                <div class=\"col-8 p-0\">\n" +
            "                    <div class=\"row pr-4\" style=\"height: 84px\">\n" +
            "                        <div class=\"col-8 pt-2\" style=\"height: 24px\">\n" +
            "                            <p class=\"text-white label-font-Bold\" style=\"font-size: 16px; word-wrap: break-word;\">" + user_name + "</p>\n" +
            "                            <div class=\"row pl-3\">\n" +
            "                            </div>\n" +
            "                        </div>\n" +
            "                        <div class=\"col-4 pl-0 \">\n" +
            "                            <div class=\"row justify-content-end\">\n" +
            "                                <div class=\"pt-2\">\n" +
            "                                    <div class=\"label-font-Condensed-Bold pl-2\" style=\"color: #ffffff; font-size: 10px\">\n" +
            "                                        <h7>RANKING</h7>\n" +
            "                                    </div>\n" +
            "                                    <div class=\"label-font-Condensed-Bold pl-2\" style=\"font-size: 24px;color: #F11D72;text-shadow: 0px 0px 6px #F11D72;line-height: 100%\">\n" +
            "                                        <p>" + rank_total + "</p>\n" +
            "                                    </div>\n" +
            "                                </div>\n" +
            "                            </div>\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "                    <div class=\"row justify-content-end pl-3 pr-4\">\n" +
            "                        <button class=\"col-12 btn btn-primary light-btn\" name=\"playerID\" type=\"submit\" value=" + user_id + " style=\"box-shadow: none;padding-top: 10px; height: 40px;border-radius: 10px\">\n" +
            "                            <label class=\"label-font-Condensed-Regular\" style=\"font-size: 14px\">INVITE</label>\n" +
            "                        </button>\n" +
            "                    </div>\n" +
            "                </div>\n" +
            "            </div>\n" +
            "        </div>\n" +
            "    </div>\n" +
            "</div>"
    }

    return render;
}

function cancelPlayer(id) {
    var index = arrInvite.map(function (e) {
        return e['user_ID'];
    }).indexOf(id);

    if (index > -1) {
        arrInvite.splice(index, 1);
    }
    renderInviteList()
}
