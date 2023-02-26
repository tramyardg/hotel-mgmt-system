function setCookie (name, value, days) {
  var expires = '';
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = '; expires=' + date.toUTCString();
  }
  document.cookie = name + '=' + (value || '') + expires + '; path=/';
}

function getCookie (name) {
  var nameEQ = name + '';
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) === ' ') c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}

function eraseCookie (name) {
  document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

const regexReservedWords = /\b(ADD|ALTER|AND|AS|BETWEEN|BY|CASE|CREATE|DELETE|DESC|DISTINCT|DROP|EXISTS|FROM|GROUP|HAVING|IN|INSERT|INTO|IS|JOIN|LIKE|LIMIT|NOT|NULL|OR|ORDER|SELECT|SET|TABLE|UPDATE|VALUES|WHERE)\b/gmi;
// Alternative syntax using RegExp constructor
// const regex = new RegExp('\\b(ADD|ALTER|AND|AS|BETWEEN|BY|CASE|CREATE|DELETE|DESC|DISTINCT|DROP|EXISTS|FROM|GROUP|HAVING|IN|INSERT|INTO|IS|JOIN|LIKE|LIMIT|NOT|NULL|OR|ORDER|SELECT|SET|TABLE|UPDATE|VALUES|WHERE)\\b', 'gmi')

const findMatchReservedWords = (str) => {
  let m;
  let foundMatch = false;

  while ((m = regexReservedWords.exec(str)) !== null) {
    // This is necessary to avoid infinite loops with zero-width matches
    if (m.index === regexReservedWords.lastIndex) {
      regexReservedWords.lastIndex++;
    }

    // The result can be accessed through the `m`-variable.
    for (let i = 0; i < m.length; i++) {
      // const match = m[i];
      // console.log(`Found match, group ${i}: ${match}`);
      foundMatch = true;
      break;
    }
  }
  return foundMatch;
};

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
  registrationData.submitBtn = 'updatebtn';
  let dataStr = Object.values(registrationData).join(' ');
  if ((dataStr && dataStr !== '') && !findMatchReservedWords(dataStr)) {
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
      let locHref = location.href;
      let homePageLink = locHref.substring(0, locHref.lastIndexOf('/')) + '/index.php';
      window.location.replace(homePageLink);
      setCookie('is_admin', resp[1]);
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
      eraseCookie('is_admin');
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
  reservation.submitBtn = 'updatebtn'; // to exclude from reserved words
  let dataStr = Object.values(reservation).join(' ');
  if ((dataStr && dataStr !== '')) {
    console.log(findMatchReservedWords(reservation));
  }

  // if ((dataStr && dataStr !== '') && !findMatchReservedWords(reservation)) {
  //   $.ajax({
  //     url: 'app/process_reservation.php',
  //     type: 'post',
  //     data: reservation
  //   }).done(function (response) {
  //     $(formIds.reservation).find('.alert').remove();
  //     try {
  //       let out = JSON.parse(response);
  //       if (out.success === 'true') {
  //         $(formIds.reservation).prepend(out.response);
  //         $(formIds.reservation).find('input[type=submit]').prop('disabled', true);
  //       }
  //     } catch (string) {
  //       $(formIds.reservation).prepend(response);
  //     }
  //   });
  // } else {
  //   console.error('found reserved words');
  //   alert('Something went wrong!');
  // }
};

const updateProfileSubmit = function () {
  let updateData = formData.updateProfile();
  updateData.submitBtn = 'updatebtn'; // to exclude from reserved words
  let dataStr = Object.values(updateData).join(' ');
  // if ((dataStr && dataStr !== '') && !new UtilityFunctions().findMatchReservedWords(dataStr)) {
    $.ajax({
      url: 'app/process_update_profile.php',
      type: 'post',
      data: updateData
    }).done(function (response) {
      $(formIds.updateProfile).find('.alert').remove();
      $(formIds.updateProfile).prepend(response);
      $(formIds.updateProfile).find('input').prop('disabled', true);
    });
  // } else {
  //   console.error('found reserved words');
  //   alert('Something went wrong!');
  // }
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
