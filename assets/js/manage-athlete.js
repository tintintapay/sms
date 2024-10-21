$(document).ready(function () {
    const exportingCol = [0, 1, 2, 3, 4, 5, 6, 7, 8];
    const exportingTitle = 'Athletes';
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
                target: [2, 3, 4, 5, 8],
                searchable: false
            },

            {
                target: [2, 3, 4, 5, 8],
                visible: false,
                searchable: false
            }
        ]
    });

    $("#myTable").show();

    table.on('click', '.btn-del', function (e) {
        console.log($(e.target).data('id'));
    });

});