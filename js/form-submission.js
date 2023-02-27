const formIds = {
  register: '#registration-form',
  login: '#login-form',
  logout: '#sign-out-link',
  reservation: '#reservation-form',
  updateProfile: '#update-profile-form'
};

const formData = {
  registration: function () {
    return {
      fullName: $('input[name="registrationFullName"]').val(),
      phoneNumber: $("input[name='registrationPhoneNumber']").val(),
      email: $("input[name='registrationEmail']").val(),
      password: $("input[name='registrationPassword']").val(),
      password2: $("input[name='registrationPassword2']").val(),
      submitBtn: $('input[name="registerSubmitBtn"]').val() // for server $_POST
    };
  },
  login: function () {
    return {
      email: $('input[name="loginEmail"]').val(),
      password: $('input[name="loginPassword"]').val(),
      submitBtn: $('input[name="loginSubmitBtn"]').val()
    };
  },
  reservation: function () {
    return {
      cid: $('input[name="cid"]').val(),
      start: $('input[name="startDate"]').val(),
      end: $('input[name="endDate"]').val(),
      type: $('select[name="roomType"]').val(),
      requirement: $('select[name="roomRequirement"]').val(),
      adults: $('select[name="adults"]').val(),
      children: $('select[name="children"]').val(),
      requests: $('textarea[name="specialRequests"]').val(),
      submitBtn: $('input[name="reservationSubmitBtn"]').val()
    };
  },
  updateProfile: function () {
    return {
      cid: $('input[name="customerId"]').val(),
      fullName: $('input[name="updateFullName"]').val(),
      phone: $("input[name='updatePhoneNumber']").val(),
      email: $("input[name='updateEmail']").val(),
      newPassword: $("input[name='updatePassword']").val(),
      submitBtn: $('input[name="updateProfileSubmitBtn"]').val()
    };
  }
};

const registrationSubmit = function () {
  let registrationData = formData.registration();
  registrationData.submitBtn = 'updatebtn'; // to exclude from reserved words
  let dataStr = Object.values(registrationData).join(' ');
  if (!new UtilityFunctions().findMatchReservedWords(dataStr)) {
    $.ajax({
      url: 'app/process_registration.php',
      type: 'post',
      data: registrationData
    }).done(function (response) {
      $(formIds.register).find('.alert').remove();
      $(formIds.register).prepend(response);
    });
  } else {
    console.error('found reserved words');
    alert('Something went wrong!');
  }
};

const loginSubmit = function () {
  let loginData = formData.login();
  // TODO : use findMatchReservedWords here
  $.ajax({
    url: 'app/process_login.php',
    type: 'post',
    data: loginData
  }).done(function (response) {
    let resp = JSON.parse(response);
    if (resp[0] === 1) {
      new UtilityFunctions().setCookie('is_admin', resp[1]);
      let locHref = location.href;
      let homePageLink = locHref.substring(0, locHref.lastIndexOf('/')) + '/index.php';
      window.location.replace(homePageLink);
    } else {
      $(formIds.login).find('.alert').remove();
      $(formIds.login).prepend(response);
    }
  });
};

const clickSignOut = function () {
  $.ajax({
    url: 'app/process_logout.php',
    type: 'get'
  }).done(function (response) {
    if (response === '1') {
      new UtilityFunctions().eraseCookie('is_admin');
      let locHref = location.href;
      let homePageLink = locHref.substring(0, locHref.lastIndexOf('/')) + '/index.php';
      window.location.replace(homePageLink);
    } else {
      alert('error signing out');
    }
  });
};

const reservationSubmit = function () {
  let reservation = formData.reservation();
  // TODO : use findMatchReservedWords here
  $.ajax({
    url: 'app/process_reservation.php',
    type: 'post',
    data: reservation
  }).done(function (response) {
    $(formIds.reservation).find('.alert').remove();
    try {
      let out = JSON.parse(response);
      if (out.success === 'true') {
        $(formIds.reservation).prepend(out.response);
        $(formIds.reservation).find('input[type=submit]').prop('disabled', true);
      }
    } catch (string) {
      $(formIds.reservation).prepend(response);
    }
  });
};

const updateProfileSubmit = function () {
  let updateData = formData.updateProfile();
  console.log(updateData);
  updateData.submitBtn = 'updatebtn'; // to exclude from reserved words

  let dataStr = Object.values(updateData).join(' ');
  if (!new UtilityFunctions().findMatchReservedWords(dataStr)) {
    $.ajax({
      url: 'app/process_update_profile.php',
      type: 'post',
      data: updateData
    }).done(function (response) {
      $(formIds.updateProfile).find('.alert').remove();
      $(formIds.updateProfile).prepend(response);
      $(formIds.updateProfile).find('input').prop('disabled', true);
    });
  } else {
    console.error('found reserved words');
    alert('Something went wrong!');
  }
};

$(document).ready(function () {
  console.log('form-submission.js');
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

  $(formIds.logout).on('click', function (event) {
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

// success: set success action before making the request
// done: set success action just after starting the request
