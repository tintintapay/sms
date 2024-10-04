$(function () {
    // DELETE
    $('.delete-announcement').on('click', function () {
        Swal.fire({
            title: "Delete",
            text: "Are you sure to delete this announcement? You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
            confirmButtonColor: "#ff2c2c",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "announcement-delete",
                    type: "POST",
                    data: { id: $('#id').val() },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        if (data.success) {
                            $('.delete-game-schedule').remove();
                            Swal.fire({
                                title: "Deleted!",
                                text: "Announcement has been removed.",
                                icon: "success"
                            });
                            setTimeout(() => {
                                window.location.href = "announcements";
                            }, 3000);
                        } else {
                            Swal.fire({
                                title: "500 Error!",
                                text: "Internal Server Error",
                                icon: "error"
                            });
                        }

                    },
                    error: function (err) {
                        console.log(err.responseText);
                    }
                });
            }
        });
    });
});