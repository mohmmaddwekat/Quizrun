document
    .querySelector(".custom-control-input")
    .addEventListener("click", function () {
        if ($(this).is(":checked")) {
            $("body").addClass("dark-mode");
            setCookie("theme", "dark-mode");
        } else {
            $("body").removeClass("dark-mode");
            setCookie("theme", "light-mode");
        }
    });
function setCookie(name, value) {
    var d = new Date();
    d.setTime(d.getTime() + 365 * 24 * 60 * 60 * 1000);
    var expires = "expires=" + d.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}
function readImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#blah").show();
            $("#blah").attr("src", e.target.result);
            var filename = $(".image input[type=file]")
                .val()
                .replace(/C:\\fakepath\\/i, "");
            $(".image .path").html(filename);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function readImageTwo(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#blah-two").show();
            $("#blah-two").attr("src", e.target.result);
            var filename = $(".image-two input[type=file]")
                .val()
                .replace(/C:\\fakepath\\/i, "");
            $(".image-two .path-two").html(filename);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function readVideo(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var filename = $(".video input[type=file]")
                .val()
                .replace(/C:\\fakepath\\/i, "");
            $(".video .path").html(filename);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function readtext(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var filename = $(".text input[type=file]")
                .val()
                .replace(/C:\\fakepath\\/i, "");
            $(".text .path").html(filename);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

/*=============================================
	=    		Isotope	Active  	      =
=============================================*/
var $filters = $(".filter-upcoming [data-filter]"),
    $card = $(".content [data-category]");
var $video = $(".slick-track [data-thumb]");
var $thumb = $(".filter-trailers [data-videos]");

$filters.on("click", function (e) {
    e.preventDefault();
    var $this = $(this);
    $filters.removeClass("active");
    $this.addClass("active");

    var $filterCard = $this.attr("data-filter");

    if ($filterCard == "all") {
        $card
            .removeClass("Show_card_animation")
            .fadeOut()
            .promise()
            .done(function () {
                $card.addClass("Show_card_animation").fadeIn();
            });
    } else {
        $card
            .removeClass("Show_card_animation")
            .fadeOut()
            .promise()
            .done(function () {
                $card
                    .filter('[data-category = "' + $filterCard + '"]')
                    .addClass("Show_card_animation")
                    .fadeIn();
            });
    }
});

$thumb.on("click", function (e) {
    e.preventDefault();
    var $this = $(this);
    $thumb.removeClass("active");
    $this.addClass("active");
    var $filtervideo = $this.attr("data-videos");
    $video
        .removeClass("slide-active")
        .fadeOut()
        .promise()
        .done(function () {
            $(".item-video").each(function () {
                $(this).get(0).pause();
            });
            $video
                .filter('[data-thumb = "' + $filtervideo + '"]')
                .addClass("slide-active")
                .fadeIn();
        });
});

function readImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var filename = $(".image input[type=file]")
                .val()
                .replace(/C:\\fakepath\\/i, "");
            $(".image .path").html(filename);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
