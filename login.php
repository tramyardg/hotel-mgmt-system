<!DOCTYPE html>
<html>
<head>
    <title>Facebook Login JavaScript Example</title>
    <meta charset="UTF-8">
</head>
<body>
<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else {
      // The person is not logged into your app or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
          'into this app.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function (response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function () {
    FB.init({
      appId: '488121818633232',
      cookie: true,  // enable cookies to allow the server to access
                     // the session
      xfbml: true,  // parse social plugins on this page
      version: 'v4.0' // The Graph API version to use for the call
    });

    // Now that we've initialized the JavaScript SDK, we call
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function (response) {
      statusChangeCallback(response);
    });

  };

  // Load the SDK asynchronously
  (function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function (response) {
      console.log('response', response);
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
          'Thanks for logging in, ' + response.name + '!';
      removeLoginButton();
      document.getElementById('logoutDiv').innerHTML = logoutButton();
    });
  }

  function logoutButton() {
    return '<button onclick="logoutFb()">Logout</button>';
  }

  function logoutFb() {
    FB.logout(function (response) {
      console.log('response', response);
      console.log('successfully logout');
      location.reload();
    });
  }

  function removeLoginButton() {
    let p = document.getElementsByTagName('fb:login-button')[0].parentElement;
    let c = document.getElementsByTagName('fb:login-button')[0];
    p.removeChild(c);
  }

</script>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->

<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>
<div id="status">
</div>
<div id="logoutDiv"></div>
</body>
</html>
