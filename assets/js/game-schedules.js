$(document).ready(function () {
    const exportingCol = [0, 1, 2, 3, 4, 5];
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
                        title: '',
                        exportOptions: {
                            columns: exportingCol
                        },
                        className: 'button button-s button-light',
                        customize: function (win) {
                            $(win.document.body).prepend(`<h2>${exportingTitle}</h2>`);

                            $(win.document.body).prepend('<div><img src="../assets/images/header.png" style="width:100%" /></div>');
                        }
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
                target: [5, 6],
                searchable: false
            }
        ]
    });

    $("#myTable").show();

    // table.on('click', '.btn-del', function (e) {
    //     console.log($(e.target).data('id'));
    // });

    if (window.location.search.includes('saved')) {
        Swal.fire({
            title: "Game Event",
            text: "New game event has been saved!",
            icon: "success"
        });

        // Remove the "saved" parameter from the URL
        const url = new URL(window.location.href);
        url.searchParams.delete('saved');
        window.history.pushState({}, '', url.href);
    }

});