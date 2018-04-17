const formIds = {
    register: "#registration-form",
    login: "#login-form",
    logout: "#sign-out-link",
    reservation: "#reservation-form",
    updateProfile: "#update-profile-form"
};

const formData = {
    registration: function () {
        return {
            fullName: $('input[name="registrationFullName"]').val(),
            phoneNumber: $("input[name='registrationPhoneNumber']").val(),
            email: $("input[name='registrationEmail']").val(),
            password: $("input[name='registrationPassword']").val(),
            password2: $("input[name='registrationPassword2']").val(),
            submitBtn: $('input[name="registerSubmitBtn"]').val()
        }
    },
    login: function () {
        return {
            email: $('input[name="loginEmail"]').val(),
            password: $('input[name="loginPassword"]').val(),
            submitBtn: $('input[name="loginSubmitBtn"]').val()
        }
    },
    reservation: function () {
        return {
            cid: $('input[name="cid"]').val(),
            start: $('input[name="startDate"]').val(),
            end: $('input[name="endDate"]').val(),
            type: $('#roomType').val(),
            requirement: $('#roomRequirement').val(),
            adults: $('#adults').val(),
            children: $('#children').val(),
            requests: $('#specialRequests').val(),
            submitBtn: $('input[name="reservationSubmitBtn"]').val()
        }
    },
    updateProfile: function () {
        return {
            cid: $('input[name="customerId"]').val(),
            fullName: $('input[name="updateFullName"]').val(),
            phone: $("input[name='updatePhoneNumber']").val(),
            email: $("input[name='updateEmail']").val(),
            password: $("input[name='updatePassword']").val(),
            submitBtn: $('input[name="updateProfileSubmitBtn"]').val()
        }
    }
};

const registrationSubmit = function () {
    let registrationData = formData.registration();
    $.ajax({
        url: "app/process_registration.php",
        type: "post",
        data: registrationData,
        success: function (data) {
            $(formIds.register).prepend(alertV1(data, "info"));
        }
    });
};

const loginSubmit = function () {
    let loginData = formData.login();
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
                for (let i = 0; i < errorsArr.length; i++) {
                    $(".card-body").prepend(alertV1(errorsArr[i], "warning"));
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
    let reservation = formData.reservation();
    let rModal = $(util.modalSel().reservation.body);
    $.ajax({
        url: "app/process_reservation.php",
        type: "post",
        data: reservation,
        success: function (data) {
            if (data === "1") {
                rModal.empty();
                rModal.append(alertV2({
                    title: "Well done!",
                    body: "You have reserved a room. You can view the status of your booking anytime.",
                    footer: "Your booking will be mark confirmed once approved."
                }, "success"));
            } else {
                let errorsArr = JSON.parse(data);
                for (let i = 0; i < errorsArr.length; i++) {
                    rModal.prepend(alertV1(errorsArr[i], "warning"));
                }
            }
        }
    });
};

const updateProfileSubmit = function () {
    let updateData = formData.updateProfile();
    $.ajax({
        url: "app/process_update_profile.php",
        type: "post",
        data: updateData,
        success: function (data) {
            if (data === "1") {
                $(formIds.updateProfile).prepend(alertV1(
                    "Your profile has been successfully updated.",
                    "success")
                );
            } else if (data === "0") {
                $(formIds.updateProfile).prepend(alertV1(
                    "Error occurred processing your request. Please try again later.",
                    "warning")
                );
            } else {
                for (let i = 0; i < JSON.parse(data).length; i++) {
                    $(formIds.updateProfile).prepend(alertV1(errorsArr[i], "warning"));
                }
            }
        }
    });
};

$(document).ready(function () {
    $(formIds.register).submit(function (event) {
        registrationSubmit();
        event.preventDefault();
        return false;
    });

    $(formIds.login).submit(function (event) {
        loginSubmit();
        event.preventDefault();
        return false;
    });

    $(formIds.logout).on("click", function (event) {
        clickSignOut();
        event.preventDefault();
        return false;
    });

    $(formIds.reservation).submit(function (event) {
        reservationSubmit();
        event.preventDefault();
        return false;
    });

    $(formIds.updateProfile).submit(function (event) {
        updateProfileSubmit();
        event.preventDefault();
        return false;
    });

});

