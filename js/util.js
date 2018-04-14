let util = {
    isEmpty: function (field) {
        return field.length === 0 || field === "";
    },
    formAndButtonIds: function () {
        return {
            register: "#registration-form",
            login: "#login-form",
            logout: "#sign-out-link",
            reservation: "#reservation-form"
        }
    },
    registrationFormData: function () {
        return {
            fullName: $('input[name="registrationFullName"]').val(),
            phoneNumber: $("input[name='registrationPhoneNumber']").val(),
            email: $("input[name='registrationEmail']").val(),
            password: $("input[name='registrationPassword']").val(),
            password2: $("input[name='registrationPassword2']").val(),
            submitBtn: $('input[name="registerSubmitBtn"]').val()
        }
    },
    loginFormData: function () {
        return {
            email: $('input[name="loginEmail"]').val(),
            password: $('input[name="loginPassword"]').val(),
            submitBtn: $('input[name="loginSubmitBtn"]').val()
        }
    },
    reservationData: function () {
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
    }
};