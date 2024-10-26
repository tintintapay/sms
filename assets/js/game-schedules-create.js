$(function () {

    let selectedIds = [];
    let sportSelected;

    let table = $("#myTable").DataTable({
        responsive: true,
        select: {
            style: "multi",
            selector: "td:first-child",
            headerCheckbox: false,
        },
        order: [[1, "asc"]],
        layout: {
            topStart: "",
            topEnd: "search",
            bottomStart: "info",
            bottomEnd: {
                paging: {
                    firstLast: false
                }
            },
        },
        pageLength: 5,
        paging: true,
        ordering: false,
        columnDefs: [
            {
                targets: 0,
                orderable: false,
                searchable: false,
                render: DataTable.render.select(),
                className: "select-all",
            },
            {
                targets: [0],
                searchable: false,
            },
        ],
        processing: true,
        serverSide: true,
        fixedColumns: {
            "leftColumns": 0
        },
        ajax: {
            url: "target-athlete",
            type: 'POST',
            data: function (data) {
                data.sport = sportSelected ?? '';
            },
            error: function (e) {
                console.log(e.responseText);
            }
        },
        stateSave: true,
        bDestroy: true,
        createdRow: function (row, data, dataIndex) {
            $(row).attr('data-id', data[0]);
        }
    });


    $("#myTable").show();

    table
        .on("select", function (e, dt, type, indexes) {
            table
                .rows(indexes)
                .nodes()
                .each(function (node) {
                    var id = $(node).data("id");
                    if (!selectedIds.includes(id)) {
                        selectedIds.push(id);
                        $("#targetAthletes").append(
                            '<input class="athlete-selected" type="hidden" name="athletes[]" id="athlete-' +
                            id +
                            '" value="' +
                            id +
                            '">',
                        );
                    }
                });
        })
        .on("deselect", function (e, dt, type, indexes) {
            table
                .rows(indexes)
                .nodes()
                .each(function (node) {
                    var id = $(node).data("id");
                    selectedIds = selectedIds.filter(function (value) {
                        return value !== id;
                    });
                    $("#athlete-" + id).remove();
                });
        });

    $('select#sport').on('change', function () {
        sportSelected = $(this).val();
        // clear list
        selectedIds = [];
        // remove created input
        $('.athlete-selected').remove();
        // refresh list
        table.ajax.reload();
    })
});