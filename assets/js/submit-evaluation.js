$(function () {
    // Add query param
    const params = new URLSearchParams(window.location.search);
    params.set('game-id', $('#game_schedules_id').val());
    const newUrl = `${window.location.pathname}?${params.toString()}`;

    window.history.pushState({ path: newUrl }, '', newUrl);
});