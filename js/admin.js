const getTblContainer = function () {
  return $("#tableContainer");
};

const confirmBtn = function () {
    return $("#confirm-booking");
};

const cancelBtn = function () {
    return $("#cancel-booking");
};

const getConfirmModal = function () {
    return $("#confirmModal");
};

const getCancelModal = function () {
    return $("#cancelModal");
};

const getSelectedItems = function () {
    return $("#reservationDataTable tr.selected");
};

const getBookIdFromSelected = function () {
    let id = [];
    getSelectedItems().each(function () {
        id.push($(this).find("td").attr("data-id"));
    });
    return id;
};

const confirmReservation = function () {
    confirmBtn().click(function () {
        if (getSelectedItems().length === 0) {
            alert("nothing selected");
            return false;
        }
        getConfirmModal().modal("show");
        getConfirmModal().find("#confirmTrue").click(function (e) {
            console.log(getBookIdFromSelected());
            e.preventDefault();
            let item = getBookIdFromSelected();
            $.ajax({
                url: "app/admin/confirm_reservation.php",
                type: "post",
                data: {item: item, confirm: true},
                success: function (data) {
                    if (data === "1") {
                        getConfirmModal().modal("hide");
                        let msg = "You have successfully confirmed your selection(s). This page will reload to reflect changes.";
                        getTblContainer().prepend(alertV1(msg, "info"));
                        setTimeout(location.reload.bind(location), 5000);
                    } else {
                        getConfirmModal().modal("hide");
                        let msg = "There must be an error processing your request. Please try again later.";
                        getTblContainer().prepend(alertV1(msg, "warning"));
                        setTimeout(location.reload.bind(location), 5000);
                    }
                }
            });
        });
    });
};

const cancelReservation = function () {
    cancelBtn().click(function () {
        if (getSelectedItems().length === 0) {
            alert("nothing selected");
            return false;
        }
        getCancelModal().modal("show");
        getCancelModal().find("#cancelTrue").click(function () {
            // cancelled
        });
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
        "pageLength": 3
    });

    confirmReservation();
    cancelReservation();

});



