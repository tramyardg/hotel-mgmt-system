const alertV1 = function (message, type) {
    $(".alert").remove();
    return `<div class="alert alert-${type}" role="alert">
                <span>${message}</span>
            </div>`;
};

