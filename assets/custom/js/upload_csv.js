$(function () {

    // load_data();

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
                // console.log(res.inv);
                if (res.inv) {
                    load_data(res.inv);
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
                console.log(res);
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
        var btn = document.createElement("a");   // Create a <button> element
        // btn.innerText = "Show error list";
        // btn.setAttribute('href', "#");
        // btn.setAttribute('class', "text-danger");
        // let header = document.getElementById('upload-multiple-invoice');
        // header.appendChild(btn);
        // console.log(header);    
        $('#imported_csv_data').empty();


        let html = `<h6 class="m-0 font-weight-bold text-danger text-center my-2">All ready exist in Database</h6>
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
        // html += `<div><button data-inv='${btoa(JSON.stringify(obj))}' class="btn-info btn-sm btn-flx send-invoice">Upload</button></div>`;
        $('#imported_csv_data').html(html);
       
    }

});

