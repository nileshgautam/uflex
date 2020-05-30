// Updates "Select all" control in a data table
//
function updateDataTableSelectAllCtrl(table) {
    var $table = table.table().node();
    var $chkbox_all = $('tbody input[type="checkbox"]', $table);
    var $chkbox_checked = $('tbody input[type="checkbox"]:checked', $table);
    var chkbox_select_all = $('thead input[name="select_all"]', $table).get(0);

    // If none of the checkboxes are checked
    if ($chkbox_checked.length === 0) {
        chkbox_select_all.checked = false;
        if ('indeterminate' in chkbox_select_all) {
            chkbox_select_all.indeterminate = false;
        }

        // If all of the checkboxes are checked
    } else if ($chkbox_checked.length === $chkbox_all.length) {
        chkbox_select_all.checked = true;
        if ('indeterminate' in chkbox_select_all) {
            chkbox_select_all.indeterminate = false;
        }

        // If some of the checkboxes are checked
    } else {
        chkbox_select_all.checked = true;
        if ('indeterminate' in chkbox_select_all) {
            chkbox_select_all.indeterminate = true;
        }
    }
}

$(document).ready(function () {
    // Array holding selected row IDs
    var rows_selected = [];
    var table = $('#invoice-dataTable').DataTable({
        'columnDefs': [{
            'targets': 0,
            'searchable': false,
            'orderable': false,
            'width': '1%',
            'className': 'dt-body-center',
            'render': function (data, type, full, meta) {
                return '<input type="checkbox">';
            }
        }],
        'order': [
            [1, 'asc']
        ],
        'rowCallback': function (row, data, dataIndex) {
            // Get row ID
            var rowId = data[0];

            // If row ID is in the list of selected row IDs
            if ($.inArray(rowId, rows_selected) !== -1) {
                $(row).find('input[type="checkbox"]').prop('checked', true);
                $(row).addClass('selected');
            }
        }
    });

    // Handle click on checkbox
    $('#invoice-dataTable tbody').on('click', 'input[type="checkbox"]', function (e) {
        let $row = $(this).closest('tr');

        // Get row data
        let data = table.row($row).data();

        // console.log(data);

        // Get row ID
        let rowId = {
            invoice_number: data[2],
            doi: data[3],
            product_code: data[4]
        };

        // Determine whether row ID is in the list of selected row IDs
        let index = $.inArray(rowId, rows_selected);

        // If checkbox is checked and row ID is not in list of selected row IDs
        if (this.checked && index === -1) {
            rows_selected.push(rowId);

            // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
        } else if (!this.checked && index !== -1) {
            rows_selected.splice(index, 1);
        }

        if (this.checked) {
            $row.addClass('selected');
        } else {
            $row.removeClass('selected');
        }

        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);

        // Prevent click event from propagating to parent
        e.stopPropagation();
    });

    // Handle click on table cells with checkboxes
    $('#invoice-dataTable').on('click', 'tbody td, thead th:first-child', function (e) {
        $(this).parent().find('input[type="checkbox"]').trigger('click');
    });

    // Handle click on "Select all" control
    $('thead input[name="select_all"]', table.table().container()).on('click', function (e) {
        if (this.checked) {
            $('#invoice-dataTable tbody input[type="checkbox"]:not(:checked)').trigger('click');
        } else {
            $('#invoice-dataTable tbody input[type="checkbox"]:checked').trigger('click');
        }

        // Prevent click event from propagating to parent
        e.stopPropagation();
    });

    // Handle table draw event
    table.on('draw', function () {
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
    });

    // Handle form submission event
    $('#invoice-form').on('submit', function (e) {
        e.preventDefault();
        // console.log(rows_selected);
        let selected_invoice = {
            invoice_numbers: rows_selected
        };
        if (rows_selected.length != 0) {
            $.ajax({
                url: BaseUrl + "Csv_import/send_invoice",
                method: "POST",
                data: selected_invoice,
                beforeSend: function () {
                    $('#btn-send').html('Sending...');
                },
                success: function (data) {
                    res = JSON.parse(data);
                    console.log(res);
                    // if()
                    $('#btn-send').attr('disabled', false);
                    $('#btn-send').html('Sent');

                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                    // let res = JSON.parse(data)
                    // console.log(data);
                    // if (res.inv) {
                    //     load_data(res.inv);
                    // }
                }
            })
        } else {
            showAlert('Warning! Select invoice.', 'warning');
        }
    });

});


$('#invoice-dataTable').on('click', '.edit-invoice', function (e) {
    e.preventDefault();
    // console.log(this);
    let invoice_number = $(this).attr('data-invoice');
    let product_code = $(this).attr('data-pid');

    if (invoice_number != '' && product_code != '') {
        console.log(invoice_number)
        console.log(product_code)
        let obj = {
            invoice_number: invoice_number,
            product_code: product_code
        }
        $.ajax({
            url: BaseUrl + "Csv_import/edit_invoice",
            method: "POST",
            data: obj,
            success: function (data) {
                res = JSON.parse(data);
                if (res.data.length != 0) {
                    // let obj=JSON.parse(res.data);
                    // console.log(res.data);
                    // // res.data[0]['id']
                    // $('#invoice-number').val(res.data[0]['invoice_number']);
                    // $('#doi').val(res.data[0]['doi']);
                    // $('#icode').val(res.data[0]['product_code']);
                    // $('#idec').val(res.data[0]['product_description']);
                    // $('#iqty').val(res.data[0]['product_qty']);
                    // $('#irate').val(res.data[0]['product_rate']);
                    // $('#amount').val(res.data[0]['product_amount']);
                    window.location.href = BaseUrl + res.path;

                    // setTimeout(function () {
                    // }, 1000);


                    // console.log(res.data[0]['id']
                    // );

                }
                else {
                    showAlert('OOPs! something went wrong Contact IT', 'danger');
                }

            }
        })

    }
});