const getTblContainer = function () {
  return $('#tableContainer');
};
const appendResponse = function (response) {
  getTblContainer().find('.alert').remove();
  getTblContainer().prepend(response);
};
const getSelectedItems = function () {
  return $('#reservationDataTable tr.selected');
};
const actions = {
  confirm: function () {
    return {
      mainBtn: $('#confirm-booking'),
      modalId: $('#confirmModal'),
      modalYesBtn: $('#confirmTrue')
    };
  },
  cancel: function () {
    return {
      mainBtn: $('#cancel-booking'),
      modalId: $('#cancelModal'),
      modalYesBtn: $('#cancelTrue')
    };
  }
};
const getBookIdFromSelected = function () {
  let id = [];
  getSelectedItems().each(function () {
    id.push($(this).find('td').attr('data-id'));
  });
  return id;
};
const confirmReservation = function () {
  actions.confirm().mainBtn.click(function () {
    if (getSelectedItems().length === 0) {
      alert('nothing selected');
      return false;
    }
    actions.confirm().modalId.modal('show');
    actions.confirm().modalYesBtn.click(function (e) {
      e.preventDefault();
      confirmAjaxRequest(getBookIdFromSelected());
    });
  });
};
const confirmAjaxRequest = function (selectedItems) {
  $.ajax({
    url: 'app/admin/manage_reservation.php',
    type: 'post',
    data: {item: selectedItems, confirm: true}
  }).done(function (response) {
    actions.confirm().modalId.modal('hide');
    appendResponse(response);
    setTimeout(location.reload.bind(location), 3000);
  });
};
const cancelReservation = function () {
  actions.cancel().mainBtn.click(function () {
    if (getSelectedItems().length === 0) {
      alert('nothing selected');
      return false;
    }
    actions.cancel().modalId.modal('show');
    actions.cancel().modalYesBtn.click(function (e) {
      e.preventDefault();
      cancelAjaxRequest(getBookIdFromSelected());
    });
  });
};
const cancelAjaxRequest = function (selectedItems) {
  $.ajax({
    url: 'app/admin/manage_reservation.php',
    type: 'post',
    data: {item: selectedItems, cancel: true}
  }).done(function (response) {
    actions.cancel().modalId.modal('hide');
    appendResponse(response);
    setTimeout(location.reload.bind(location), 3000);
  });
};
const viewRSVProws = {
  tableId: null,
  viewOption: null,
  setConstruct: function (tableId, viewOption) {
    viewRSVProws.tableId = tableId;
    viewRSVProws.viewOption = viewOption;
  },
  defaultConfig: function () {
    $(viewRSVProws.tableId).DataTable({
      select: {style: 'multi'},
      'pageLength': 6
    });
  },
  main: function () {
    $(viewRSVProws.viewOption).change(function () {
      if (this.checked) {
        if (this.value === 'confirmed') {
          $(viewRSVProws.tableId).DataTable().search('CONFIRMED').draw();
        } else if (this.value === 'pending') {
          $(viewRSVProws.tableId).DataTable().search('PENDING').draw();
        } else {
          $(viewRSVProws.tableId).DataTable({
            destroy: true,
            select: {style: 'multi'},
            paging: false
          });
        }
      }
    });
  }
};

$(document).ready(function () {
  $('.card-footer').on('click', function (e) {
    e.preventDefault();
    let aHref = $(this).attr('href');
    $('#adminTab a[href="' + aHref + '"]').tab('show');
  });
  viewRSVProws.setConstruct('#reservationDataTable', 'input[type=radio][name=viewOption]');
  viewRSVProws.defaultConfig();
  viewRSVProws.main();
  $('#customerTable').DataTable();
  confirmReservation();
  cancelReservation();
});
