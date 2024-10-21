$(document).ready(function () {
    // Add query param
    const params = new URLSearchParams(window.location.search);
    params.set('token', $('#token').val());
    const newUrl = `${window.location.pathname}?${params.toString()}`;

    window.history.pushState({ path: newUrl }, '', newUrl);


    // Set the end date and time
    const endDate = new Date(startDate).getTime() + 5 * 60 * 1000;

    function updateTimer() {
        // Get today's date and time
        const now = new Date().getTime();

        // Find the distance between now and the end date
        const distance = endDate - now;

        // Time calculations for minutes and seconds
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        var minsText = minutes === 0 ? "" : minutes + "m ";
        // Display the result in the element with id="timer"
        $('#timer').text(minsText + seconds + "s ");

        // If the countdown is finished, display "EXPIRED"
        if (distance < 0) {
            clearInterval(timerInterval);
            $('#timer').text("code expired");
        }
    }

    // Update the countdown every second
    const timerInterval = setInterval(updateTimer, 1000);

    // Initial call to display the timer right away
    updateTimer();
});