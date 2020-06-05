$(function () {

    // ***********************India invoice function ***********************//
    // start
    function load_data(obj) {

        let html = `<h6 class="m-0 font-weight-bold text-info text-center my-2">Imported Invoice Details from CSV File</h6>
        <div class="table-responsive">
         <table class="table table-bordered dataTable table-striped">
          <tr>
		   <th>Sr. No</th>
		   <th>Invoice Number</th>
		   <th>Date Of Invoice</th>
           <th>Product Code</th>
           <th>Product Description
		   </th>
		   <th>Product Qty</th>
		   <th>Product Rate </th>
		   <th>Product Amount</th>
          </tr>
     `;
        let count = 0;
        if (obj.length > 0) {
            for (let i = 0; i < obj.length; i++) {
                // print_r($row);die;
                html += `
             <tr>
             <td>${i + 1}</td>
             <td>${obj[i]['invoice_number']}</td>
             <td>${obj[i]['doi']}</td>
             <td>${obj[i]['product_code']}</td>
             <td>${obj[i]['product_description']}</td>
             <td>${obj[i]['product_qty']}</td>
             <td>${obj[i]['product_rate']}</td>
             <td>${obj[i]['product_amount']}</td>
             </tr>`;

            }
        } else {
            html += `<tr>;
      <td colspan="7" >Data not Available</td>
      </tr>`;
        }
        html += `</table></div>`;
        html += `<div><button data-inv='${btoa(JSON.stringify(obj))}' class="btn-info btn-sm btn-flx send-invoice">Upload</button></div>`;
        $('#imported_csv_data').html(html);
    }

    $('#import_csv').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url: BaseUrl + "csv_import/import",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $('#import_csv_btn').html('Importing...');
            },
            success: function (data) {
                $('#import_csv')[0].reset();
                $('#import_csv_btn').attr('disabled', false);
                $('#import_csv_btn').html('Import Done');
                let res = JSON.parse(data)
                console.log(res);
                if (res.inv) {
                    load_data(res.inv);
                    // console.log(res);
                } if (res.type == 'danger') {
                    // console.log(res);
                    showAlert(res.message, res.type);
                }
            }
        })
    });

    $('#imported_csv_data').click('.send-invoice', function () {
        let data = $(this).children('div').children('button').attr('data-inv');
        invoice = JSON.parse(atob(data));
        let inv_data = { invoice: invoice }
        $.ajax({
            url: BaseUrl + "csv_import/insert_invoice",
            method: "POST",
            data: inv_data,
            success: function (data) {
                let res = JSON.parse(data);
                // console.log(res);
                if (res.errorlist.length == 0) {
                    // console.log(res);
                    loaderror(res.errorlist);
                } else if (res.errorlist.length != 0) {
                    loaderror(res.errorlist);
                }
            }
        });
    });
    const loaderror = (obj) => {
        // var btn = document.createElement("a");   // Create a <button> element
        // btn.innerText = "Show error list";
        // btn.setAttribute('href', "#");
        // btn.setAttribute('class', "text-danger");
        // let header = document.getElementById('upload-multiple-invoice');
        // header.appendChild(btn);
        // console.log(header);    
        $('#imported_csv_data').empty();

        let message
        if (obj.length > 0) {
            message = `<h6 class="m-0 font-weight-bold text-danger text-center my-2">All ready exist in Database</h6>`;
        } else {
            message = `<h6 class="m-0 font-weight-bold text-success text-center my-2">Successfuly uploaded</h6>`;
        }

        let html = `${message}
        <div class="table-responsive">
         <table class="table table-bordered dataTable table-striped">
          <tr>
		   <th>Sr. No</th>
		   <th>Invoice Number</th>
		   <th>Date Of Invoice</th>
           <th>Product Code</th>
           <th>Product Description
		   </th>
		   <th>Product Qty</th>
		   <th>Product Rate </th>
		   <th>Product Amount</th>
          </tr>
     `;
        let count = 0;
        if (obj.length > 0) {
            for (let i = 0; i < obj.length; i++) {
                // print_r($row);die;
                html += `
             <tr>
             <td>${i + 1}</td>
             <td>${obj[i]['invoice_number']}</td>
             <td>${obj[i]['doi']}</td>
             <td>${obj[i]['product_code']}</td>
             <td>${obj[i]['product_description']}</td>
             <td>${obj[i]['product_qty']}</td>
             <td>${obj[i]['product_rate']}</td>
             <td>${obj[i]['product_amount']}</td>
             </tr>`;

            }
        } else {
            html += `<tr>;
      <td colspan="8" class="text-center">Data not Available</td>
      </tr>`;
        }
        html += `</table></div>`;
        // html += `<div><button data-inv='${btoa(JSON.stringify(obj))}' class="btn-info btn-sm btn-flx send-invoice">Upload</button></div>`;
        $('#imported_csv_data').html(html);

    }
    // end
    // ***********************London invoice function ***********************//
    // start

    $('#load_csv').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url: BaseUrl + "Csv_import/london_invoice",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $('#load_file').html('Importing...');
            },
            success: function (data) {
                $('#load_csv')[0].reset();
                $('#load_file').attr('disabled', false);
                $('#load_file').html('Import Done');
                let res = JSON.parse(data);
                if (res.inv) {
                    load_london_invoice(res.inv);
                }
                if (res.type == 'danger') {
                    showAlert(res.message, res.type);
                }
            }
        })
    });

    function load_london_invoice(obj) {

        let html = `<h6 class="m-0 font-weight-bold text-info text-center my-2">Imported Invoice Details from CSV File</h6>
        <div class="table-responsive">
         <table class="table table-bordered dataTable table-striped">
          <tr>
		   <th>Sr. No</th>
		   <th>Invoice Number</th>
		   <th>Date Of Invoice</th>
           <th>Product Code</th>
           <th>Product Description
		   </th>
		   <th>Product Qty</th>
		   <th>Product Rate </th>
		   <th>Product Amount</th>
          </tr>
     `;
        let count = 0;
        if (obj.length > 0) {
            for (let i = 0; i < obj.length; i++) {
                // print_r($row);die;
                html += `
             <tr>
             <td>${i + 1}</td>
             <td>${obj[i]['invoice_number']}</td>
             <td>${obj[i]['invoice_date']}</td>
             <td>${obj[i]['code']}</td>
             <td>${obj[i]['description']}</td>
             <td>${obj[i]['qty']}</td>
             <td>${obj[i]['rate']}</td>
             <td>${obj[i]['amount']}</td>
             </tr>`;

            }
        } else {
            html += `<tr>;
      <td colspan="7" >Data not Available</td>
      </tr>`;
        }
        html += `</table></div>`;
        html += `<div><button data-inv='${btoa(JSON.stringify(obj))}' class="btn-info btn-sm btn-flx update-invoice">Upload</button></div>`;
        $('#london_inovice_csv_data').html(html);
    }

    // imorting data into the database
    $('#london_inovice_csv_data').click('.update-invoice', function () {
        let data = $(this).children('div').children('button').attr('data-inv');
        invoice = JSON.parse(atob(data));
        let inv_data = { invoice: invoice }
        $.ajax({
            url: BaseUrl + "csv_import/insert_london_invoice",
            method: "POST",
            data: inv_data,
            success: function (data) {
                let res = JSON.parse(data);
                // console.log(res);
                if (res.errorlist.length == 0) {
                    // console.log(res);
                    invoiceError_ldn(res.errorlist);
                } else if (res.errorlist.length != 0) {
                    invoiceError_ldn(res.errorlist);
                }
            }
        });
    });
    // load london invice error list
    const invoiceError_ldn = (obj) => {

        $('#london_inovice_csv_data').empty();
        let message;
        if (obj.length > 0) {
            message = `<h6 class="m-0 font-weight-bold text-danger text-center my-2">All ready exist in Database</h6>`;
        } else {
            message = `<h6 class="m-0 font-weight-bold text-success text-center my-2">Successfuly uploaded</h6>`;
        }

        let html = `${message}
        <div class="table-responsive">
         <table class="table table-bordered dataTable table-striped">
          <tr>
		   <th>Sr. No</th>
		   <th>Invoice Number</th>
		   <th>Date Of Invoice</th>
           <th>Product Code</th>
           <th>Product Description
		   </th>
		   <th>Product Qty</th>
		   <th>Product Rate </th>
		   <th>Product Amount</th>
          </tr>
     `;
        let count = 0;
        if (obj.length > 0) {
            for (let i = 0; i < obj.length; i++) {
                // print_r($row);die;
                html += `
             <tr>
             <td>${i + 1}</td>
             <td>${obj[i]['invoice_number']}</td>
             <td>${obj[i]['invoice_date']}</td>
             <td>${obj[i]['code']}</td>
             <td>${obj[i]['description']}</td>
             <td>${obj[i]['qty']}</td>
             <td>${obj[i]['rate']}</td>
             <td>${obj[i]['amount']}</td>
             </tr>`;

            }
        } else {
            html += `<tr>;
      <td colspan="8" class="text-center">Data not Available</td>
      </tr>`;
        }
        html += `</table></div>`;
        // html += `<div><button data-inv='${btoa(JSON.stringify(obj))}' class="btn-info btn-sm btn-flx send-invoice">Upload</button></div>`;
        $('#london_inovice_csv_data').html(html);

    }
    // end
});

