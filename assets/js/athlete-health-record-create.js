$(document).ready(function() {
    // Add query param
    const params = new URLSearchParams(window.location.search);
    params.set('athlete_id', $('#athlete_id').val());
    const newUrl = `${window.location.pathname}?${params.toString()}`;

    window.history.pushState({ path: newUrl }, '', newUrl);
});