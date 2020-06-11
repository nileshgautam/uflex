<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-info ib">Invoice List</h6>
            <a href="<?php echo base_url('india/upload-multiple-invoce') ?>" class="btn btn-warning btn-circle btn-invoice btn-space" title="Upload multiple invoice">
                <i class="fa fa-upload" aria-hidden="true"></i>
            </a>
            <a href="<?php echo base_url('india/add-invoice') ?>" class="btn btn-info btn-circle btn-invoice btn-space" title="Add Invoice">
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
                                <th rowspan="1" colspan="1">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (!empty($invoice)) {
                                foreach ($invoice as $item) {
                                    $date = ddmmyy($item['doi']);
                            ?>
                                    <tr role="row">
                                        <td></td>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo RemoveSpecialChar($item['invoice_number']) ?></td>
                                        <td><?php echo  $date ?></td>
                                        <td><?php echo RemoveSpecialChar($item['product_code']) ?></td>
                                        <td><?php echo RemoveSpecialChar($item['product_description']) ?></td>
                                        <td><?php echo $item['product_qty'] ?></td>
                                        <td><?php echo $item['product_rate'] ?></td>
                                        <td><?php echo $item['product_amount'] ?></td>
                                        <td><a href="<?php echo base_url('IndiaControl/eiditinvoce').'/'.base64_encode($item['invoice_number']).'/'.base64_encode( $item['product_code']) ?>" class="btn btn-warning btn-circle btn-invoice btn-space" title="edit">
                                                <i class="fas fa-edit"></i>
                                            </a></td>
                                    </tr>

                            <?php }
                            }
                            ?>
                        </tbody>
                    </table>
                    <form id="invoice-form">
                        <div class="btn-send">
                            <button type="submit" id="btn-send" class="btn btn-success" title="Send">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>