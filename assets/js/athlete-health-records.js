$(document).ready(function () {
    const exportingTitle = `Health History`;
    const exportingCol = [0, 1, 2, 3];
    let table = $("#myTable").DataTable({
        // responsive: true,
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
                        title: '',
                        exportOptions: {
                            columns: exportingCol
                        },
                        className: 'button button-s button-light',
                        customize: function (win) {
                            var athlete = `<div style="border:2px solid gray;margin-top:20px">
                                                <div style="border-right:2px solid gray; padding:5px;display:inline-block">Athlete:</div>
                                                <div style="padding:5px;display:inline-block">
                                                    ${$('#full_name').val()} 
                                                </div>
                                            </div>`;
                            $(win.document.body).prepend(athlete);

                            $(win.document.body).prepend(`<h2>${exportingTitle}</h2>`);

                            $(win.document.body).prepend('<div><img src="../assets/images/header.png" style="width:100%" /></div>');

                        }
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
                target: [1, 2, 3],
                searchable: true
            },
            {
                target: [0],
                searchable: false,
            },
        ]
    });

    $("#myTable").show();

});