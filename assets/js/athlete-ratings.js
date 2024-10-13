$(document).ready(function () {
    const exportingCol = [0, 1, 2, 3, 4];
    const exportingTitle = 'Game Schedules';
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
                        title: exportingTitle,
                        exportOptions: {
                            columns: exportingCol
                        },
                        className: 'button button-s button-light',
                    },
                ]
            },
            topEnd: 'search',
            bottomStart: 'info',
            bottomEnd: 'paging'
        },
        pageLength: 5,
        ordering: false,
        columnDefs: [
            {
                target: [3, 4],
                searchable: false
            }
        ]
    });

    $("#myTable").show();

    // table.on('click', '.btn-del', function (e) {
    //     console.log($(e.target).data('id'));
    // });

});