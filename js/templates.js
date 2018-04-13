const registerSuccess = function () {
    return `<div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Well done!</h4>
                <p>You have been successfully registered!</p>
                <hr>
                <p class="mb-0">You can <a href="sign-in.html">login</a> now.</p>
            </div>`;
};

const alertFailed = function (error) {
    return `<div class="alert alert-warning" role="alert">
                <span>${error}</span>
            </div>`;
};