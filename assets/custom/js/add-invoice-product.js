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
    <td> <input type="text" class="form-control product-code" id="produuct-code" placeholder="Enter product code" name="productCode${list[i].row_id}" value="${list[i].producCode}"></td>

    <td> <textarea name="producDetails${list[i].row_id}" id="product-details" cols="" rows=""  class="form-control product-details" placeholder="Enter product details">${list[i].producDetails}</textarea></td>

    <td> <input type="text" class="form-control product-quantity" id="product-quantity" name="product-quantity${list[i].row_id}" placeholder="Enter product quantity" value="${list[i].productQuantity}"></td>

    <td> <input type="text" class="form-control product-rate" id="product-rate" name="product-rate${list[i].row_id}" placeholder="Enter product rate" value="${list[i].productRate}"></td>

    <td><input type="text" class="form-control product-amount" id="product-amount" name="product-amount${list[i].row_id}" placeholder="Enter product amount" value="${list[i].productAmount}"></td>

    <td>
    <a href="#" class="btn btn-danger delete_row btn-block" data-row-id="${list[i].row_id}" >
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

    function addoption() {
        let Input = $(this);
        let row_id = Input.data('id');
        let item = selected_container_list.find((item) => item.item_id == row_id);
        option_id++;
        var options_ob = {
            optionsid: option_id,
            option_key: "",
            option_value: ""
        };
        selected_options_container_list.push(options_ob);
        item['other_info'] = selected_options_container_list;
        console.log(selected_container_list);
        optionList(selected_options_container_list, selected_options_container);
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

    $('.save-data').click(function () {
        console.log(objarr);
    });

});


