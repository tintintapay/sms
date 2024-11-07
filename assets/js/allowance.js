$(function () {

    const exportingCol = [0, 1, 2, 3, 4, 5];
    const exportingTitle = 'Allowances';
    let table = $("#myTable").DataTable({
        responsive: true,
        layout: {
            topStart: {
                buttons: [
                    {
                        extend: 'csv',
                        title: exportingTitle,
                        exportOptions: {
                            columns: exportingCol
                        },
                        className: 'button button-s button-success',
                    },
                    {
                        extend: 'print',
                        title: '',
                        exportOptions: {
                            columns: exportingCol
                        },
                        className: 'button button-s button-light',
                        customize: function (win) {
                            $(win.document.body).prepend(`<h2>${exportingTitle}</h2>`);

                            $(win.document.body).prepend('<div><img src="../assets/images/header.png" style="width:100%" /></div>');
                        }
                    },
                ]
            },
            topEnd: 'search',
            bottomStart: 'info',
            bottomEnd: {
                paging: {
                    firstLast: false
                }
            },
        },
        pageLength: 5,
        ordering: false,
        columnDefs: [
            {
                target: [5],
                searchable: false
            },
        ]
    });
    $("#myTable").show();

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