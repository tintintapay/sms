var modal = '';
var span = $(".close");

function openModal(target) {
    modal = $(target);
    modal.fadeIn(); // Smooth fade in
}

span.on("click", function () {
    modal.fadeOut(); // Smooth fade out
});

$(document).on("click", function (event) {
    if ($(event.target).is('.modal')) {
        modal.fadeOut();
    }
});