/**
 * Form validation for
 *  - login
 *  - registration
 */
var $loginForm = $('#login-form');
$loginForm.validate({
    rules: {
        loginEmail: "required",
        loginPassword: "required"
    },
    errorPlacement: function (error, element) {
        error.appendTo(element.parent());
    },
    submitHandler: function (form) {
        form.submit();
    }
});

var $registerForm = $('#registration-form');
$registerForm.validate({
    rules: {
        registrationEmail: "required",
        registrationPassword: {
            required: true,
            minlength: 6
        },
        registrationPassword2: {
            required: true,
            minlength: 6,
            equalTo: "#registrationPassword"
        }
    },
    errorPlacement: function (error, element) {
        error.appendTo(element.parent());
    },
    submitHandler: function (form) {
        form.submit();
    }
});
