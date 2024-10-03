$(function () {

    $('.approve-evaluation').on('click', function () {
        var ele = $(this);
        var id = ele.data('id');
        Swal.fire({
            title: "Approve!",
            text: "Are you sure to approve this athlete?",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: 'No',
            confirmButtonText: "Yes"
        }).then((result) => {
            if (result.isConfirmed) {
                const action = 'approve';

                $.ajax({
                    url: 'evaluations-approve-disapprove',
                    data: { action: action, id: id },
                    type: 'post',
                    dataType: 'json',
                    beforeSend: function () {
                        ele.prop('disabled', true);
                    },
                    success: function (data) {
                        location.reload();
                    },
                    error: function (err) {
                        ele.prop('disabled', false);
                        console.log(err.responseText)
                    }
                })

            }
        });
    });

    $('.disapprove-evaluation').on('click', function () {
        var ele = $(this);
        var id = ele.data('id');
        Swal.fire({
            title: "Disapprove!",
            text: "Are you sure to disapprove this athlete?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: 'No',
            confirmButtonText: "Yes Disapprove!"
        }).then((result) => {
            if (result.isConfirmed) {

                if (result.isConfirmed) {
                    const action = 'disapprove';
                    $.ajax({
                        url: 'evaluations-approve-disapprove',
                        data: { action: action, id: id },
                        type: 'post',
                        dataType: 'json',
                        beforeSend: function () {
                            ele.prop('disabled', true);
                        },
                        success: function (data) {
                            location.reload();
                        },
                        error: function (err) {
                            ele.prop('disabled', false);
                            console.log(err)
                        }
                    })

                }
            }
        });
    });


});