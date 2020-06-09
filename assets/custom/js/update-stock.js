$(function () {

    let productTable = $('#update-stock-body');
    let objarr = [];
    let rowid = 1;
    obj = {
        row_id: rowid,
        invoiceNumber: '',
        productCode: '',
        productBatch: '',
        closing: '',
        productDetails: '',
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

        {/* <input type="text" class="form-control product-batch no-border" id="produuct-batch" placeholder="Batch number" name="productbatch${list[i].row_id}" value="${list[i].producbatch}"></input> */ }
        {/* <input type="text" class="form-control fs-14 product-code no-border" id="produuct-code" placeholder="Code" name="productCode${list[i].row_id}" value="${list[i].producCode}"></input> */ }

        for (let i = 0; i < len; i++) {
            let rowTemplate = $(` <tr>
            <td><select id="product-batch${list[i].row_id}" class="form-control fs-14 product-batch no-border w-100">
            <option>Select batch no.</option>

            </select></td>

            <td><select class="form-control w-100 fs-14 product-code no-border" id="product-code${list[i].row_id}" disabled="disabled">
            <option>Select code.</option>
            </select></td>

            <td> <textarea disabled name="producDetails${list[i].row_id}" id="product-details${list[i].row_id}"  class="form-control product-details w-350 no-border" placeholder="Enter product details">${list[i].productDetails}</textarea> </td>

            <td> <input type="number" min=0 class="form-control no-border clsosing w-100 " disabled id="closing${list[i].row_id}" name="closing-stock${list[i].row_id}" value="${list[i].closing}"></td>

            <td> <input type="number" min=0 class="form-control no-border w-100 product-quantity" id="product-quantity" name="product-quantity${list[i].row_id}" placeholder="Quantity" value="${list[i].productQuantity}"></td>

            <td><input type="number" min=0 class="form-control w-100 no-border product-rate" id="product-rate" name="product-rate${list[i].row_id}" placeholder="00.00" value="${list[i].productRate}"></td>

            <td><input type="number" min=0 class="form-control no-border product-amount w-100" id="product-amount" name="product-amount${list[i].row_id}" placeholder="00.00" value="${list[i].productAmount}"></td>

            <td>
            <a href="#" class="btn btn-danger delete_row btn-sm" data-row-id="${list[i].row_id}" >
            <i class="fa fa-trash"></i>
            </a>
</td>
    </tr>`);

            productTable.append(rowTemplate);

            let delete_row = rowTemplate.find('.delete_row');
            delete_row.data("id", list[i].row_id);
            delete_row.click(deleterow_click);

            // code for fetch availble batches from database

            let producBatch = rowTemplate.find('.product-batch');
            producBatch.data("id", list[i].row_id);
            producBatch.data("item-key", 'productBatch');
            producBatch.data("item-key2", 'productCode');
            producBatch.data("item-key3", 'productDetails');
            producBatch.data("item-key4", 'invoiceNumber');
            producBatch.data("item-key5", 'closing');


            $.post(BaseUrl + "LondonControl/get_item_batch", function (data, status) {
                let batches = JSON.parse(data);
                // console.log(batches);
                let options = batches.map((bth) => {
                    let optionTemplate = $(`<option value="${bth.invoice_date}"  invoice-no="${bth.invoice_number}">${bth.invoice_date}</option>`);
                    // console.log(optionTemplate);
                    return optionTemplate;
                });
                // let options_code = batches.map((bth) => {
                //     let optionTemplate = $(`<option value="${bth.item_code}" description="${bth.item_description}">${bth.item_code}</option>`);
                //     // console.log(optionTemplate);
                //     return optionTemplate;
                // });

                producBatch.append(options);
                // appending option into the select box in batch
                // let product_code=$(`<option value="${batches[0]['item_code']}" invoice-no="${batches[0]['invoice_number']}">${batches[0]['item_code']}</option>`);

                // let textarea = $(batches[0]['item_description']);
                // // let code_id = $(`#product-code${1}`);
                // // code_id.empty();
                // // code_id.append(options_code);
                // // code_id.disabled(true);
                // let item_description = $(`#product-details1`);
                // item_description.empty();
                // item_description.append(batches[0]['item_description']);

            });

            producBatch.change(InputOption_keyup);

            let producCode = rowTemplate.find('.product-code');
            producCode.data("id", list[i].row_id);
            producCode.data("item-key", 'productCode');
            producCode.data("item-key1", 'productDetails');
            producCode.data("item-key2", 'closing');
            producCode.change(load_data);


            // let producDetails = rowTemplate.find('.product-details');
            // producDetails.data("id", list[i].row_id);
            // producDetails.data("item-key", 'productDetails');
            // producDetails.keyup(InputText_keyup);

            let productQuantity = rowTemplate.find('.product-quantity');
            productQuantity.data("id", list[i].row_id);
            productQuantity.data("item-key", 'productQuantity');
            productQuantity.keyup(InputText_keyup);

            let productRate = rowTemplate.find('.product-rate');
            productRate.data("id", list[i].row_id);
            productRate.data("item-key", 'productRate');
            productRate.keyup(InputText_keyup);

            let productAmount = rowTemplate.find('.product-amount');
            productAmount.data("id", list[i].row_id);
            productAmount.data("item-key", 'productAmount');
            productAmount.keyup(InputText_keyup);

        }
    }

 

    function load_data() {
        let Input = $(this);
        let description = $(this).children("option:selected").attr('data-description');
        let stock = $(this).children("option:selected").attr('stock');
        console.log(stock);
        let row_id = Input.data('id');
        let product_details = $(`#product-details${row_id}`);
        let stock_data = $(`#closing${row_id}`);

        let item_key = Input.data('item-key');
        let item_key1 = Input.data('item-key1');
        let item_key2 = Input.data('item-key2');

        let item = objarr.find((item) => item.row_id == row_id);
        item[item_key] = Input.val();
        item[item_key1] = description;
        item[item_key2] = stock;

        stock_data.val(stock);
        product_details.val(description);
        // console.log(inv);

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
        let inv = $(this).children("option:selected").attr('invoice-no');
        let row_id = Input.data('id');
        let item_key = Input.data('item-key');
        let item_key2 = Input.data('item-key2');
        let item_key3 = Input.data('item-key3');
        let item_key4 = Input.data('item-key4');
        let item_key5 = Input.data('item-key5');


        in_data = {
            inv: inv,
            batch: Input.val()
        }

        let code_id = $(`#product-code${row_id}`);
        let product_details = $(`#product-details${row_id}`);
        let closing_stock = $(`#closing${row_id}`);
        let items = objarr.find((item) => item.row_id == row_id);
        items[item_key] = Input.val();

        $.post(
            BaseUrl + "LondonControl/get_item_code",
            in_data,
            function (data, status) {
                let item = JSON.parse(data);
                console.log(item);
                let options = item.map((p) => {
                    let optionTemplate = $(
                        `<option 
                        data-description="${p.item_description}" 
                        value="${p.item_code}" 
                        item-code="${p.item_code}"
                        stock="${p.closing_stock}"
                        >${p.item_code}</option>`);
                    return optionTemplate;
                });

                code_id.removeAttr('disabled');

                code_id.html(options);

                let codeValue = $(`#product-code${row_id}`).children("option:selected").val();
                let code_description = $(`#product-code${row_id}`).children("option:selected").attr('data-description');

                let stock = $(`#product-code${row_id}`).children
                    ("option:selected").attr('stock');

                closing_stock.val(stock);
                product_details.val(code_description);

                items[item_key2] = codeValue;
                items[item_key3] = code_description;
                items[item_key4] = inv;
                items[item_key5] = stock;
                // appending option into the select box in batch
            });

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
            invoiceNumber: '',
            productCode: '',
            productBatch: '',
            productDetails: '',
            productQuantity: '',
            productRate: '',
            productAmount: ''
        }
        objarr.push(obj)
        loadTable(objarr);
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
    $('.update-sold-stock').click(function () {
        let error = false;
        let invoice = $('#invoice-number').val();
        let doi = $('#invoice-date').val();  //date of invoice (doi)
        let productList = objarr;
        // console.log(doi);
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
            ) {
                error = true;
            } else {
                error = false;
            }

        }

        if (!error) {
            if (confirm("Are you sure want to save ?")) {
                let url = BaseUrl + 'london/update-stock';
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


