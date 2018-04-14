const registrationSubmit = function () {
    let registrationData = util.registrationFormData();
    $.ajax({
        url: "app/process_registration.php",
        type: "post",
        data: registrationData,
        success: function (data) {
            if (util.isEmpty(data)) {
                $(".card").remove();
                $(".card-holder").append(registerSuccess());
            } else {
                let errorsArr = JSON.parse(data);
                $(".alert-warning").remove();
                for (let i = 0; i < errorsArr.length; i++) {
                    $(".card-body").prepend(alertFailed(errorsArr[i]));
                }
            }
        }
    });

};

const loginSubmit = function () {
    let loginData = util.loginFormData();
    $.ajax({
        url: "app/process_login.php",
        type: "post",
        data: loginData,
        success: function (data) {
            if (data === "1") {
                let locHref = location.href;
                let homePageLink = locHref.substring(0, locHref.lastIndexOf("/")) + "/index.php";
                window.location.replace(homePageLink);
            } else {
                let errorsArr = JSON.parse(data);
                $(".alert-warning").remove();
                for (let i = 0; i < errorsArr.length; i++) {
                    $(".card-body").prepend(alertFailed(errorsArr[i]));
                }
            }
        }
    });
};

const clickSignOut = function () {
    $.ajax({
        url: "app/process_logout.php",
        type: "get",
        success: function (data) {
            if (data === "1") {
                let locHref = location.href;
                let homePageLink = locHref.substring(0, locHref.lastIndexOf("/")) + "/index.php";
                window.location.replace(homePageLink);
            } else {
                alert("error signing out");
            }
        }
    });
};

const reservationSubmit = function () {
    let reservation = util.reservationData();
    $.ajax({
        url: "app/process_reservation.php",
        type: "post",
        data: reservation,
        success: function (data) {
            if (data === "1") {
                console.log(data);
                $(".alert-warning").remove();
            } else {
                let errorsArr = JSON.parse(data);
                $(".alert-warning").remove();
                for (let i = 0; i < errorsArr.length; i++) {
                    $(util.modalSel().reservation.body).prepend(alertFailed(errorsArr[i]));
                }
            }
        }
    });
};

$(document).ready(function () {
    // executed when registration form is submitted
    $(util.formAndButtonIds().register).submit(function (event) {
        registrationSubmit();
        event.preventDefault();
        return false;
    });

    // executed when login form is submitted
    $(util.formAndButtonIds().login).submit(function (event) {
        loginSubmit();
        event.preventDefault();
        return false;
    });

    // executed when sign out link
    $(util.formAndButtonIds().logout).on("click", function (event) {
        clickSignOut();
        event.preventDefault();
        return false;
    });

    // executed when login form is submitted
    $(util.formAndButtonIds().reservation).submit(function (event) {
        reservationSubmit();
        event.preventDefault();
        return false;
    });

});

