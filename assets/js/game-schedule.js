$(function () {
    // Add query param
    const params = new URLSearchParams(window.location.search);
    params.set('id', $('#id').val());
    const newUrl = `${window.location.pathname}?${params.toString()}`;

    window.history.pushState({ path: newUrl }, '', newUrl);

    // Datatable 
    let selectedIds = [];
    let sportSelected = $('#sport').find(":selected").val();
    // Store selected athlete to selected from database
    $('.athlete-selected').each(function () {
        selectedIds.push(parseInt(this.value));
    })
    
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
            // insert athlete id to row elements
            $(row).attr('data-id', data[0]);
            
            // auto select row if data[0] is in the selected list
            if (selectedIds.includes(data[0])) {
                table.row(row).select();
            }
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
    });

    // Delete request
    $('.delete-game-schedule').on('click', function () {
        Swal.fire({
            title: "Delete",
            text: "Are you sure to delete this game schedule? You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
            confirmButtonColor: "#ff2c2c",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "game-schedule-delete",
                    type: "POST",
                    data: { id: $('#id').val() },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        if (data.success) {
                            $('.delete-game-schedule').remove();
                            Swal.fire({
                                title: "Deleted!",
                                text: "Game Schedule has been removed.",
                                icon: "success"
                            });
                        } else {
                            Swal.fire({
                                title: "500 Error!",
                                text: "Internal Server Error",
                                icon: "error"
                            });
                        }

                    },
                    error: function (err) {
                        console.log(err.responseText);
                    }
                });
            }
        });
    });
});