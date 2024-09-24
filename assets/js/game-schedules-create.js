$(document).ready(function () {
    let selectedIds = [];

    let table = $("#myTable").DataTable({
        responsive: true,
        select: {
            style: 'multi',
            selector: 'td:first-child',
            headerCheckbox: false
        },
        order: [[1, 'asc']],
        layout: {
            topStart: '',
            topEnd: 'search',
            bottomStart: 'info',
            bottomEnd: 'paging',
        },
        pageLength: 1,
        paging: true,
        ordering: false,
        columnDefs: [
            {
                targets: 0,
                orderable: false,
                searchable: false,
                render: DataTable.render.select(),
                className: 'select-all'
            },
            {
                targets: [0, 4],
                searchable: false
            },
        ],
    });

    $("#myTable").show();

    table
        .on('select', function (e, dt, type, indexes) {
            table.rows({ selected: true }).nodes().each(function (node) {
                var id = $(node).data('id');
                if (!selectedIds.includes(id)) {
                    selectedIds.push(id);
                }
            });
            console.log('Selected IDs:', selectedIds);
        })
        .on('deselect', function (e, dt, type, indexes) {
            table.rows(indexes).nodes().each(function (node) {
                var id = $(node).data('id');
                selectedIds = selectedIds.filter(function (value) {
                    return value !== id;
                });
            });
            console.log('Selected IDs:', selectedIds);
        });

    // Get selected IDs on button click
    $('#get-selected-ids').on('click', function () {
        console.log('Selected IDs:', selectedIds);
    });


});