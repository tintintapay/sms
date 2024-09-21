$(document).ready(function () {
    const exportingCol = [0, 1, 2, 3, 4, 5, 6, 7, 8];
    const exportingTitle = 'Athletes';
    let table = $("#myTable").DataTable({
        responsive: true,
        layout: {
            topStart: {
                buttons: [
                    // {
                    //     extend: 'copy',
                    //     title: exportingTitle,
                    //     exportOptions: {
                    //         columns: exportingCol
                    //     },
                    // },
                    {
                        extend: 'csv',
                        title: exportingTitle,
                        exportOptions: {
                            columns: exportingCol
                        },
                        className: 'button button-s button-success',
                    },
                    // {
                    //     extend: 'pdfHtml5',
                    //     title: exportingTitle,
                    //     exportOptions: {
                    //         columns: exportingCol
                    //     },
                    // },
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
        columnDefs: [
            {
                target: [2, 3, 4, 5, 6, 8, 9],
                orderable: false,
                searchable: false
            },

            {
                target: [2, 3, 4, 5, 6],
                visible: false,
                searchable: false
            }
        ],
    });

    $("#myTable").show();

    table.on('click', '.btn-del', function (e) {
        let data = table.row(e.target.closest('tr')).data();
        console.log($(e.target).data('id'));

        // alert(data[0] + "'s salary is: " + data[5]);
    });


});