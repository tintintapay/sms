$(function () {

    $('#send_allowance_notice').on('submit', function (e) {
        e.preventDefault();

        const form = $(this).serialize()

        $.ajax({
            url: 'send-allowance-notice',
            type: 'post',
            data: form,
            dataType: 'json',
            beforeSend: function () {
                $('#submit').prop('disabled', true);
                $('#submit').html('Sending...');
            },
            success: function (data) {
                console.log(data);
                if (data.success) {
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
                        title: "Message sent!"
                    });

                    $('#submit').prop('disabled', false);
                    $('#submit').html('Send Notice');
                }
            },
            error: function (err) {
                console.log(err.responseText);
                $('#submit').prop('disabled', false);
                $('#submit').html('Send Notice');
            }
        })
    })
})