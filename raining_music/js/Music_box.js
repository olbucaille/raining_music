$(document).ready(function () {

    var audio = document.getElementById("myMusic"); 

    $("#MainControl")._toggle(function () {
        $(this).removeClass("MainControl").addClass("StopControl");
        if (audio.src == "") {
            var Defaultsong = $(".Single .SongName").eq(0).attr("KV");
            $(".MusicBox .ProcessControl .SongName").text(Defaultsong);
            $(".Single .SongName").eq(0).css("color", "#7A8093");
            audio.src = "../media/" + Defaultsong + ".mp3";
        }
        audio.play();
        TimeSpan();
    }, function () {
        $(this).removeClass("StopControl").addClass("MainControl");
        audio.pause();
    });


    $(".MusicList .List .Single .SongName").click(function () {
        $(".MusicList .List .Single .SongName").css("color", "#fff");
        $("#MainControl").removeClass("MainControl").addClass("StopControl");
        $(this).css("color", "#7A8093");
        var SongName = $(this).attr("KV");
        $(".MusicBox .ProcessControl .SongName").text(SongName);
        audio.src = "../media/" + SongName + ".mp3";
        audio.play();
        TimeSpan();
    });


    $(".LeftControl").click(function () {
        $(".MusicList .List .Single .SongName").each(function () {
            if ($(this).css("color") == "rgb(122, 128, 147)") {
                var IsTop = $(this).parent(".Single").prev(".Single").length == 0 ? true : false; 
                var PrevSong;
                if (IsTop) {
                    PrevSong = $(".Single").last().children(".SongName").attr("KV");
                    $(".Single").last().children(".SongName").css("color", "#7A8093");
                }
                else {
                    PrevSong = $(this).parent(".Single").prev(".Single").children(".SongName").attr("KV");
                    $(this).parent(".Single").prev(".Single").children(".SongName").css("color", "#7A8093");
                }

                audio.src = "../Media/" + PrevSong + ".mp3";
                $(".MusicBox .ProcessControl .SongName").text(PrevSong);
                $(this).css("color", "#fff");
                audio.play();
                return false; 
            }
        })
    });


    $(".RightControl").click(function () {
        $(".MusicList .List .Single .SongName").each(function () {
            if ($(this).css("color") == "rgb(122, 128, 147)") {
                var IsBottom = $(this).parent(".Single").next(".Single").length == 0 ? true : false;  
                var NextSong;
                if (IsBottom) {
                    NextSong = $(".Single").first().children(".SongName").attr("KV");
                    $(".Single").first().children(".SongName").css("color", "#7A8093");
                }
                else {
                    NextSong = $(this).parent(".Single").next(".Single").children(".SongName").attr("KV");
                    $(this).parent(".Single").next(".Single").children(".SongName").css("color", "#7A8093");
                }

                audio.src = "../Media/" + NextSong + ".mp3";
                $(".MusicBox .ProcessControl .SongName").text(NextSong);
                $(this).css("color", "#fff");
                audio.play();
                return false; 
            }
        })
    });


    $(".VoiceEmp").click(function () {
        $(".VoidProcessYet").css("width", "0");
        audio.volume = 0;
    });


    $(".VoiceFull").click(function () {
        $(".VoidProcessYet").css("width", "66px");
        audio.volume = 1;
    });


    $(".Process").click(function (e) {


        var Process = $(".Process").offset();
        var ProcessStart = Process.left;
        var ProcessLength = $(".Process").width();


        var CurrentProces = e.clientX - ProcessStart;
        DurationProcessRange(CurrentProces / ProcessLength);
        $(".ProcessYet").css("width", CurrentProces);
    });


    $(".ProcessYet").click(function (e) {

        var Process = $(".Process").offset();
        var ProcessStart = Process.left;
        var ProcessLength = $(".Process").width();

        var CurrentProces = e.clientX - ProcessStart;
        DurationProcessRange(CurrentProces / ProcessLength);
        $(".ProcessYet").css("width", CurrentProces);
    });


    $(".VoidProcess").click(function (e) {

        var VoidProcess = $(".VoidProcess").offset();
        var VoidProcessStart = VoidProcess.left;
        var VoidProcessLength = $(".VoidProcess").width();

        var CurrentProces = e.clientX - VoidProcessStart;
        VolumeProcessRange(CurrentProces / VoidProcessLength);
        $(".VoidProcessYet").css("width", CurrentProces);
    });

  
    $(".VoidProcessYet").click(function (e) {

        var VoidProcess = $(".VoidProcess").offset();
        var VoidProcessStart = VoidProcess.left;
        var VoidProcessLength = $(".VoidProcess").width();

        var CurrentProces = e.clientX - VoidProcessStart;
        VolumeProcessRange(CurrentProces / VoidProcessLength);
        $(".VoidProcessYet").css("width", CurrentProces);
    });


    $(".ShowMusicList").toggle(function () {
        $(".MusicList").show();

        var MusicBoxRight = $(".MusicBox").offset().left + $(".MusicBox").width();
        var MusicBoxBottom = $(".MusicBox").offset().top + $(".MusicBox").height();
        $(".MusicList").css("left", MusicBoxRight - $(".MusicList").width());
        $(".MusicList").css("top", MusicBoxBottom + 15);
    }, function () {
        $(".MusicList").hide();
    });



    audio.addEventListener('ended', function () {
        $(".MusicList .List .Single .SongName").each(function () {
            if ($(this).css("color") == "rgb(122, 128, 147)") {
                var IsBottom = $(this).parent(".Single").next(".Single").length == 0 ? true : false;  
                var NextSong;
                if (IsBottom) {
                    NextSong = $(".Single").first().children(".SongName").attr("KV");
                    $(".Single").first().children(".SongName").css("color", "#7A8093");
                }
                else {
                    NextSong = $(this).parent(".Single").next(".Single").children(".SongName").attr("KV");
                    $(this).parent(".Single").next(".Single").children(".SongName").css("color", "#7A8093");
                }

                audio.src = "../Media/" + NextSong + ".mp3";
                $(".MusicBox .ProcessControl .SongName").text(NextSong);
                $(this).css("color", "#fff");
                audio.play();
                return false; 
            }
        });
    }, false);


});


function VolumeProcessRange(rangeVal) {
    var audio = document.getElementById("myMusic");
    audio.volume = parseFloat(rangeVal);
}


function DurationProcessRange(rangeVal) {
    var audio = document.getElementById("myMusic");
    audio.currentTime = rangeVal * audio.duration;
    audio.play();
}


function Play(obj) {
    var SongUrl = obj.getAttribute("SongUrl");
    var audio = document.getElementById("myMusic");
    audio.src = "../Media/" + SongUrl + ".mp3";
    audio.play();
    TimeSpan();
}


function Pause() {
    var audio = document.getElementById("myMusic");
    $("#PauseTime").val(audio.currentTime);
    audio.pause();
}


function Continue() {
    var audio = document.getElementById("myMusic");
    audio.startTime = $("PauseTime").val();
    audio.play();
}


function TimeSpan() {
    var audio = document.getElementById("myMusic");
    var ProcessYet = 0;
    setInterval(function () {
        var ProcessYet = (audio.currentTime / audio.duration) * 500;
        $(".ProcessYet").css("width", ProcessYet);
        var currentTime = timeDispose(audio.currentTime);
        var timeAll = timeDispose(TimeAll());
        $(".SongTime").html(currentTime + "&nbsp;|&nbsp;" + timeAll);
    }, 1000);
}


function timeDispose(number) {
    var minute = parseInt(number / 60);
    var second = parseInt(number % 60);
    minute = minute >= 10 ? minute : "0" + minute;
    second = second >= 10 ? second : "0" + second;
    return minute + ":" + second;
}


function TimeAll() {
    var audio = document.getElementById("myMusic");
    return audio.duration;
}