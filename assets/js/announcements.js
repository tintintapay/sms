$(document).ready(function () {
    let table = $("#myTable").DataTable({
        responsive: true,
        layout: {
            topStart: {
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
                target: [0, 1, 2],
                searchable: true
            },
        ]
    });

    $("#myTable").show();

    table.on('click', '.btn-del', function (e) {
        console.log($(e.target).data('id'));
    });

});