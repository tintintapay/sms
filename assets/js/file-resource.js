$(document).ready(function() {
    // Delete file
    $('.del-file').on('click', function () {
        Swal.fire({
            title: "Delete",
            text: "Are you sure to delete this file? You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
            confirmButtonColor: "#ff2c2c",
        }).then((result) => {
            const fileName = $(this).data('name');
            const rowId = $(this).data('id');
            if (result.isConfirmed) {
                $.ajax({
                    url: "file-delete",
                    type: "POST",
                    data: { file: fileName },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        if (data.success) {
                            $(`#${rowId}`).remove();
                            Swal.fire({
                                title: "Deleted!",
                                text: "File has been removed.",
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
                        console.log(err.responseText);
                    }
                });
            }
        });
    });
})