const DELUXE_PER_NIGHT = 250;
const DOUBLE_PER_NIGHT = 180;
const SINGLE_PER_NIGHT = 150;

// rsvn multi steps
let currentTab = 0;
showTab(currentTab);

function showTab (n) {
  let x = document.getElementsByClassName('rsvnTab');
  x[n].style.display = 'block';
  if (n === 0) {
    document.getElementById('rsvnPrevBtn').style.display = 'none';
  } else {
    document.getElementById('rsvnPrevBtn').style.display = 'inline';
  }
  if (n === (x.length - 1)) {
    document.getElementById('rsvnNextBtn').innerHTML = 'Submit';
  } else {
    document.getElementById('rsvnNextBtn').innerHTML = 'Next';
  }
  fixStepIndicator(n);
}

function fixStepIndicator (n) {
  let i;
  let x = document.getElementsByClassName('step');
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(' active', '');
  }
  x[n].className += ' active';
}

function rsvnNextPrev (n) {
  let x = document.getElementsByClassName('rsvnTab');
  if (n === 1 && !validateRsvnForm()) return false;
  x[currentTab].style.display = 'none';
  currentTab = currentTab + n;
  showTab(currentTab);
}

function validateRsvnForm () {
  let tab = document.getElementsByClassName('rsvnTab');
  let valid = true;
  let inputs = tab[currentTab].getElementsByTagName('input');
  for (let i = 0; i < inputs.length; i++) {
    if (inputs[i].hasAttribute('required')) {
      if (inputs[i].value === '') {
        inputs[i].className += ' invalid';
        valid = false;
      }
    }
  }

  let selects = tab[currentTab].getElementsByTagName('select');
  for (let i = 0; i < selects.length; i++) {
    if (selects[i].hasAttribute('required')) {
      if (selects[i].value === '') {
        selects[i].className += ' invalid';
        valid = false;
      }
    }
  }

  if (valid) {
    console.log({
      cid: $('input[name="cid"][isForTest="true"]').val(),
      start: $('input[name="startDate"][isForTest="true"]').val(),
      end: $('input[name="endDate"][isForTest="true"]').val(),
      type: $('select[name="roomType"][isForTest="true"]').val(),
      requirement: $('select[name="roomRequirement"][isForTest="true"]').val(),
      adults: $('select[name="adults"][isForTest="true"]').val(),
      children: $('select[name="children"][isForTest="true"]').val(),
      requests: $('textarea[name="specialRequests"][isForTest="true"]').val()
    });
    document.getElementsByClassName('step')[currentTab].className += ' finish';
    let today = new Date();
    let bookDate = today.toDateString();
    const rsvnCostSummary = new ReservationCost(bookDate, null, null, null);
    console.log(rsvnCostSummary);
    rsvnCostSummary.displayBookedDate();
  }
  return valid;
}

class ReservationCost {
  constructor(bookDate, roomPrice, numNights, fromTo) {
    this.bookDate = bookDate;
    this.roomPrice = roomPrice;
    this.numNights = numNights;
    this.fromTo = fromTo;
  }

  displayBookedDate() {
    document.getElementsByClassName('bookedDateTxt')[0].innerHTML = this.bookDate;
  }

}

// todo
// [x] - validate inputs in the current tab on click next
// calculate difference between dates
