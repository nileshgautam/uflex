$(function () {

    let productTable = $('#product-body');
    let objarr = [];
    let rowid = 1;
    obj = {
        row_id: rowid,
        producCode: '',
        producDetails: '',
        productQuantity: '',
        productRate: '',
        productAmount: ''
    }

    objarr.push(obj)

    loadTable(objarr);

    function loadTable(list) {
        let len = list.length;
        // console.log(list);
        productTable.empty();
        for (let i = 0; i < len; i++) {
            let rowTemplate = $(` <tr>
    <td> <input type="text" class="form-control product-code no-border" id="produuct-code" placeholder="Code" name="productCode${list[i].row_id}" value="${list[i].producCode}"></td>

    <td> <textarea name="producDetails${list[i].row_id}" id="product-details" cols="" rows=""  class="form-control product-details w-350 no-border" placeholder="Enter product details">${list[i].producDetails}</textarea></td>

    <td> <input type="number" min=0 class="form-control no-border product-quantity" id="product-quantity" name="product-quantity${list[i].row_id}" placeholder="Quantity" value="${list[i].productQuantity}"></td>

    <td><input type="number" min=0 class="form-control no-border product-rate" id="product-rate" name="product-rate${list[i].row_id}" placeholder="00.00" value="${list[i].productRate}"></td>

    <td><input type="number" min=0 class="form-control no-border product-amount w-100" id="product-amount" name="product-amount${list[i].row_id}" placeholder="00.00" value="${list[i].productAmount}"></td>

    <td>
    <a href="#" class="btn btn-danger delete_row" data-row-id="${list[i].row_id}" >
    <i class="fa fa-trash"></i>
    </a>
</td>
    </tr>`);

            productTable.append(rowTemplate);

            let delete_row = rowTemplate.find('.delete_row');
            delete_row.data("id", list[i].row_id);
            delete_row.click(deleterow_click);

            let producCode = rowTemplate.find('.product-code');
            producCode.data("id", list[i].row_id);
            producCode.data("item-key", 'producCode');
            producCode.keyup(InputOption_keyup);

            let producDetails = rowTemplate.find('.product-details');
            producDetails.data("id", list[i].row_id);
            producDetails.data("item-key", 'producDetails');
            producDetails.keyup(InputText_keyup);

            let productQuantity = rowTemplate.find('.product-quantity');
            productQuantity.data("id", list[i].row_id);
            productQuantity.data("item-key", 'productQuantity');
            productQuantity.keyup(InputOption_keyup);

            let productRate = rowTemplate.find('.product-rate');
            productRate.data("id", list[i].row_id);
            productRate.data("item-key", 'productRate');
            productRate.keyup(InputOption_keyup);

            let productAmount = rowTemplate.find('.product-amount');
            productAmount.data("id", list[i].row_id);
            productAmount.data("item-key", 'productAmount');
            productAmount.keyup(InputOption_keyup);

        }
    }


    function deleterow_click() {
        let delete_row = $(this);
        let row_id = delete_row.data('id');
        let itemIndex = objarr.findIndex((item) => item.row_id == row_id);
        objarr.splice(itemIndex, 1);
        loadTable(objarr)
    }

    function InputOption_keyup() {
        let Input = $(this);
        let row_id = Input.data('id');
        let item_key = Input.data('item-key');
        let item = objarr.find((item) => item.row_id == row_id);
        item[item_key] = Input.val();
    }

    function InputText_keyup() {
        let Input = $(this);
        let row_id = Input.data('id');
        let item_key = Input.data('item-key');
        let item = objarr.find((item) => item.row_id == row_id);
        item[item_key] = Input.val();
    }

    $('.add-more').click(function (e) {
        e.preventDefault();
        rowid++;
        obj = {
            row_id: rowid,
            producCode: '',
            producDetails: '',
            productQuantity: '',
            productRate: '',
            productAmount: ''
        }
        objarr.push(obj)
        loadTable(objarr);
    });

    // console.log(objarr);
    // Function to update india invoice
    $('.save-data').click(function () {
        let error = false;
        let invoice = $('#invoice-number').val();
        let doi = $('#invoice-date').val();  //date of invoice (doi)
        let productList = objarr;
        // let invoceResponce = validateIsEmpty(invoice);
        let dateResponce = validateIsEmpty(doi);

        if (invoice == '') {
            error = true;
            // invoice.focus();
            $('#invoice-number').focus();
            $('#invoice-number').css("border", '2px solid red');
        }
        if (doi == '') {
            error = true;
            // doi.focus();
            $('#invoice-date').focus();
            $('#invoice-date').css('border', '2px solid red')
        }
        for (let i = 0; i < objarr.length; i++) {
            if (objarr[i]['producCode'] == ''
                || objarr[i]['producDetails'] == ''
                || objarr[i]['productQuantity'] == ''
                || objarr[i]['productRate'] == ''
                || objarr[i]['productAmount'] == ''
            ) {
                error = true;
            } else {
                error = false;
            }

        }
        if (!error) {
            if (confirm("Are you sure want to submit ?")) {
                let url = BaseUrl + 'submit-invoice';
                let data = {
                    invoiceNumber: invoice,
                    dateOfinvoice: doi,
                    products: productList
                }
                $.post(url, data, function (data, status) {
                    let res = JSON.parse(data);
                    showAlert(res.messages, res.type);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                });
            }
        } else {
            showAlert('Empty field are not allowed', 'danger');
        }
        //   console.log(objarr);
    });

    // date picker function ot set date format 
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        startDate: '-3d',
        defaultViewDate: true
    });

    const validateIsEmpty = (key) => {
        let error = false;
        if (key == '') {
            error = true;
        }
        else {
            error = false;
        }
        return error;
    }
    
    // function to update stock for london outlate
    $('.update-stock').click(function () {
        let error = false;
        let invoice = $('#invoice-number').val();
        let doi = $('#invoice-date').val();  //date of invoice (doi)
        let productList = objarr;
        // let invoceResponce = validateIsEmpty(invoice);

        // console.log(productList[0]['producCode']);

        // let dateResponce = validateIsEmpty(doi);

        // console.log(objarr);



        if (invoice == '') {
            error = true;
            // invoice.focus();
            $('#invoice-number').focus();
            $('#invoice-number').css("border", '2px solid red');
        }
        if (doi == '') {
            error = true;
            // doi.focus();
            $('#invoice-date').focus();
            $('#invoice-date').css('border', '2px solid red')
        }
        for (let i = 0; i < objarr.length; i++) {
            if (objarr[i]['producCode'] == ''
                || objarr[i]['producDetails'] == ''
                || objarr[i]['productQuantity'] == ''
                || objarr[i]['productRate'] == ''
                || objarr[i]['productAmount'] == ''
            ) {
                error = true;
            } else {
                error = false;
            }

        }

        if (!error) {
            if (confirm("Are you sure want to submit ?")) {
                let url = BaseUrl + 'london/update-invoice';
                let data = {
                    invoiceNumber: invoice,
                    dateOfinvoice: doi,
                    products: productList
                }
                $.post(url, data, function (data, status) {
                    let res = JSON.parse(data);
                    showAlert(res.messages, res.type);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                });
            }
        } else {
            showAlert('Empty field are not allowed', 'danger');
        }
    });

});


