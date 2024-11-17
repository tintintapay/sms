$(function() {

    $('.claim-button').on('click', function() {
        Swal.fire({
            title: "Claim Allowance",
            text: "Are you sure to claim this allowance? You won't be able to edit this once claimed!",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            confirmButtonText: "Claim!",
        }).then((result) => {
            if (result.isConfirmed) {
                $('#allowance-claim-form').submit();
            }
        });
    })
})