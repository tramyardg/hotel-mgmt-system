/**
 * Contains utility functions.
 */
let util = {
    isEmpty: function (field) {
        return field.length === 0 || field === "";
    },
    formAndButtonIds: function () {
        return {
            register: "#registration-form",
            login: "#login-form",
            logout: "#sign-out-link"
        }
    },
    registrationFormData: function () {
        return {
            fullName: $('input[name="registrationFullName"]').val(),
            phoneNumber: $("input[name='registrationPhoneNumber']").val(),
            email: $("input[name='registrationEmail']").val(),
            password: $("input[name='registrationPassword']").val(),
            password2: $("input[name='registrationPassword2']").val()
        }
    },
    loginFormData: function () {
        return {
            email: $('input[name="loginEmail"]').val(),
            password: $('input[name="loginPassword"]').val()
        }
    }
};