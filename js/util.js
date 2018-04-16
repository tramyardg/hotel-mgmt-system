let util = {
    isEmpty: function (field) {
        return field.length === 0 || field === "";
    },
    modalSel: function () {
        return {
            reservation: {
                div: ".book-now-modal-lg",
                body: "#reservationModalBody"
            }
        }
    }
};