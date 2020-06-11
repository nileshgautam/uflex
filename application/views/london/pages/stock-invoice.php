<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary ib">Availble Stock</h6>
            <a href="<?php echo base_url('london/upload-invoice')?>" class="btn btn-warning btn-circle btn-invoice btn-space" title="Upload multiple invoice">
                <i class="fa fa-upload" aria-hidden="true"></i>
            </a>
            <a href="<?php echo base_url('london/add-invoice')?>" class="btn btn-primary btn-circle btn-invoice btn-space" title="Add Invoice">
                <i class="fas fa-plus"></i>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="col-sm-12">
                    <table class="table table-bordered dataTable" id="invoice-dataTable">
                        <thead>
                            <tr>
                                <th><input name="select_all" value="1" type="checkbox"></th>
                                <th rowspan="1" colspan="1">Sr.No.</th>
                                <th rowspan="1" colspan="1">Invoice</th>
                                <th rowspan="1" colspan="1">DOI</th>
                                <th rowspan="1" colspan="1">Item Code</th>
                                <th rowspan="1" colspan="1">Description</th>
                                <th rowspan="1" colspan="1">Qty.</th>
                                <th rowspan="1" colspan="1">Rate</th>
                                <th rowspan="1" colspan="1">Amount</th>
                              

                            </tr>
                        </thead>
                        <tbody id="data-invoice">
                            <?php

                            $i = 1;

                            if (!empty($invoice)) {
                                foreach ($invoice as $item) {
                                    $date = ddmmyy($item['invoice_date']);
                            ?>
                                    <tr role="row">
                                        <td></td>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $item['invoice_number'] ?></td>
                                        <td><?php echo  $date ?></td>
                                        <td><?php echo $item['item_code'] ?></td>
                                        <td><?php echo $item['item_description']?></td>
                                        <td><?php echo $item['qty'] ?></td>
                                        <td><?php echo $item['rate'] ?></td>
                                        <td><?php echo $item['amount'] ?></td>                                   
                                    </tr>
                            <?php }
                            }

                            ?>
                        </tbody>
                    </table>
                 
                </div>
            </div>
        </div>
    </div>
</div>