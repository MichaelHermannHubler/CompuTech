$(function () {

    $("#menu-icon").click(function () {
        $("#menu-bar").slideToggle();
    });
  

    $("#menu-bar").click(function () {
        selection = ($(document.activeElement).val());
        
        if (!getQueryVariable("menu")) {
            window.location += "?menu=" + selection;
        } else {
            selection = ($(document.activeElement).val());           
            var reExp = /menu=.*/;
            var url = window.location.toString();
            var newUrl = url.replace(reExp, "menu=" + selection);
            window.location = newUrl;
        }

    });

    function getQueryVariable(variable)
    {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            if (pair[0] == variable) {
                return pair[1];
            }
        }
        return(false);
    }
});


