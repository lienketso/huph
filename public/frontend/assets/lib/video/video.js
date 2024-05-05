$(document).ready(function () {
    const videoElement = document.querySelector("video");

    $(".video-control").on("click", function () {
        var playing = document.querySelector(".playing");
        if (playing == null) {
            videoElement.play();
            $(".video-control").addClass("playing");
        }else{
            videoElement.pause();
            $(".video-control").removeClass("playing");
        }
    });

    videoElement.addEventListener("ended", () => {
        $(".video-control").removeClass("playing");
    });
});
