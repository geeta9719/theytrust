
$(document).ready(function () {

    var cookieval = readCookie("ybcookie"); 
    if (cookieval != null) {

        var validcookieval = isEmail(cookieval);
        if (!validcookieval) {
            window.location = "https://yesflex.in/signin";
        }
    }
   else {
        window.location = "https://yesflex.in/signin";
    }

})

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}


$('.logout').click(function() {
    document.cookie = "ybcookie=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
	window.location = "https://yesflex.in/signin";
})

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}