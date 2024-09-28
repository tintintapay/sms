$(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');

    $('.approve-athlete').on('click', function () {
        Swal.fire({
            title: "Approve",
            text: "Are you sure to approve this athlete?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Yes",
            confirmButtonColor: "#ff2c2c",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "athlete-approve",
                    type: "POST",
                    data: { id: id },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        if (data.success) {
                            $('.approve-athlete').remove();
                            Swal.fire({
                                title: "Approved!",
                                text: "Athlete has been added to list.",
                                icon: "success"
                            });
                        } else {
                            Swal.fire({
                                title: "500 Error!",
                                text: "Internal Server Error",
                                icon: "error"
                            });
                        }

                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            }
        });
    });

    // Delete request
    $('.delete-athlete').on('click', function () {
        Swal.fire({
            title: "Delete",
            text: "Are you sure to delete this athlete? You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
            confirmButtonColor: "#ff2c2c",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "athlete-delete",
                    type: "POST",
                    data: { id: id },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        if (data.success) {
                            $('.delete-athlete').remove();
                            Swal.fire({
                                title: "Deleted!",
                                text: "Athlete has been removed.",
                                icon: "success"
                            });
                        } else {
                            Swal.fire({
                                title: "500 Error!",
                                text: "Internal Server Error",
                                icon: "error"
                            });
                        }

                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            }
        });
    });
});