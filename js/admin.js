const getTblContainer = function () {
    return $("#tableContainer");
};

const getSelectedItems = function () {
    return $("#reservationDataTable tr.selected");
};

const actions = {
    confirm: function () {
        return {
            mainBtn: $("#confirm-booking"),
            modalId: $("#confirmModal"),
            modalYesBtn: $("#confirmTrue")
        }
    },
    cancel: function () {
        return {
            mainBtn: $("#cancel-booking"),
            modalId: $("#cancelModal"),
            modalYesBtn: $("#cancelTrue")
        }
    }
};

const getBookIdFromSelected = function () {
    let id = [];
    getSelectedItems().each(function () {
        id.push($(this).find("td").attr("data-id"));
    });
    return id;
};

const confirmReservation = function () {
    actions.confirm().mainBtn.click(function () {
        if (getSelectedItems().length === 0) {
            alert("nothing selected");
            return false;
        }
        actions.confirm().modalId.modal("show");
        actions.confirm().modalYesBtn.click(function (e) {
            e.preventDefault();
            confirmAjaxRequest(getBookIdFromSelected());
        });
    });
};

const confirmAjaxRequest = function (selectedItems) {
    $.ajax({
        url: "app/admin/manage_reservation.php",
        type: "post",
        data: {item: selectedItems, confirm: true}
    }).done(function (response) {
        if (response === "1") {
            actions.confirm().modalId.modal("hide");
            let msg = "You have successfully confirmed your selection(s). This page will reload to reflect changes.";
            getTblContainer().prepend(alertV1(msg, "info"));
            setTimeout(location.reload.bind(location), 2000);
        } else {
            actions.confirm().modalId.modal("hide");
            let msg = "There must be an error processing your request. Please try again later.";
            getTblContainer().prepend(alertV1(msg, "warning"));
            setTimeout(location.reload.bind(location), 2000);
        }
    });
};

const cancelReservation = function () {
    actions.cancel().mainBtn.click(function () {
        if (getSelectedItems().length === 0) {
            alert("nothing selected");
            return false;
        }
        actions.cancel().modalId.modal("show");
        actions.cancel().modalYesBtn.click(function (e) {
            e.preventDefault();
            cancelAjaxRequest(getBookIdFromSelected());
        });
    });
};

const cancelAjaxRequest = function (selectedItems) {
    $.ajax({
        url: "app/admin/manage_reservation.php",
        type: "post",
        data: {item: selectedItems, cancel: true}
    }).done(function (response) {
        if (response === "1") {
            actions.cancel().modalId.modal("hide");
            let msg = "The task has completed. This page will reload to reflect changes.";
            getTblContainer().prepend(alertV1(msg, "info"));
            setTimeout(location.reload.bind(location), 3000);
        } else {
            actions.cancel().modalId.modal("hide");
            let msg = "There must be an error processing your request. Please try again later.";
            getTblContainer().prepend(alertV1(msg, "warning"));
            setTimeout(location.reload.bind(location), 3000);
        }
    });
};

$(document).ready(function () {
    $('.card-footer').on('click', function (e) {
        e.preventDefault();
        let aHref = $(this).attr('href');
        $('#adminTab a[href="' + aHref + '"]').tab('show')
    });

    // data table plugin for reservation table
    $('#reservationDataTable').DataTable({
        select: {
            style: 'multi'
        },
        "pageLength": 6
    });

    $('#customerTable').DataTable();

    confirmReservation();
    cancelReservation();

});



