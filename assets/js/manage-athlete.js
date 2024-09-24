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
                    {
                        extend: 'selected',
                        text:'With Selected',
                        action: function (e, dt, node, config) {
                            var rows = dt.rows({ selected: true }).count();

                            alert('There are ' + rows + '(s) selected in the table');
                        }
                    }
                ]
            },
            top: {
                buttons: [
                    {
                        extend: 'searchPanes',
                        config: {
                            cascadePanes: true
                        }
                    }
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
                target: [2, 3, 4, 5, 8, 9],
                searchable: false
            },

            {
                target: [2, 3, 4, 5, 8],
                visible: false,
                searchable: false
            }
        ],
        select: true,
    });

    $("#myTable").show();

    table.on('click', '.btn-del', function (e) {
        console.log($(e.target).data('id'));
    });

});