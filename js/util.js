/**
 * Contains utility functions.
 */
let util = {
    isEmpty: function (field) {
        return field.length === 0 || field === "";
    },
    formIds: function () {
        return {
            register: "#registration-form",
            login: "#login-form"
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