$(function () {

    $(".article").click(function(){

        var selection = ($(document.activeElement).val());
        window.location = "./Computech/index.php?articleNum=" + selection;
    });
});


