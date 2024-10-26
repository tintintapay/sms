$(document).ready(function() {
    // Add query param
    const params = new URLSearchParams(window.location.search);
    var value = $('#id').val()
    params.set('id', value);
    const newUrl = `${window.location.pathname}?${params.toString()}`;

    window.history.pushState({ path: newUrl }, '', newUrl);
});