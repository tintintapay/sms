$(function () {
    // Add query param
    // const params = new URLSearchParams(window.location.search);
    // params.set('game_id', $('#game_id').val());
    // const newUrl = `${window.location.pathname}?${params.toString()}`;

    // window.history.pushState({ path: newUrl }, '', newUrl);

    $('.save-btn').on('click', function () {
        var id = $(this).data('id');
        var game_id = $('#game_id').val();
        var athlete_id = $('#athlete_id_' + id).val();
        var teamwork = $('#teamwork_' + id).val();
        var sportsmanship = $('#sportsmanship_' + id).val();
        var technical_skills = $('#technical_skills_' + id).val();
        var adaptability = $('#adaptability_' + id).val();
        var game_sense = $('#game_sense_' + id).val();
        var remarks = $('#remarks_' + id).val();

        $.ajax({
            url: "athlete-rating-save",
            method: "POST",
            dataType: "json",
            data: {
                game_id: game_id,
                athlete_id: athlete_id,
                teamwork: teamwork,
                sportsmanship: sportsmanship,
                technical_skills: technical_skills,
                adaptability: adaptability,
                game_sense: game_sense,
                remarks: remarks
            },
            success: function (data) {
                if (data.success) {
                    $('.msg_' + id).hide();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "success",
                        title: "Data saved!"
                    });
                } else {
                    $('.msg_' + id).show();
                    $('.msg_' + id).html(data.message);
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
});