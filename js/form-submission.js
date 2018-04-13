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
            if (util.isEmpty(data)) {
                $(".card").remove();
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

$(document).ready(function () {
    // executed when registration form is submitted
    $(util.formIds().register).submit(function (event) {
        registrationSubmit();
        event.preventDefault();
        return false;
    });

    // executed when login form is submitted
    $(util.formIds().login).submit(function (event) {
        loginSubmit();
        event.preventDefault();
        return false;
    });
});

