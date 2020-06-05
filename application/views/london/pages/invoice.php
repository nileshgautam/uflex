<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary ib">Send by India invoice list</h6>            
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
                        <tbody id="data-invoice">
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
                                        <td>
                                            <div class="btn-send">

                                            
                                        <a href="#" data-id="<?php echo base64_encode($item['id'])?>" class="btn btn-danger btn-sm btn-circle btn-invoice btn-space reject-invoice 
                                        " title="Reject">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        <a href="#" data-id="<?php echo base64_encode($item['id'])?>" class="btn btn-success btn-sm btn-circle btn-invoice btn-space accept-invoice" title="Accept">
                                                <i class="fas fa-check"></i>
                                            </a>
                                            </div>
                                        </td>
                                    </tr>
                            <?php }
                            }
                            ?>
                        </tbody>
                    </table>
                    <form id="london-invoice-form">
                        <div class="btn-send">
                            <button type="submit" id="btn-accept" class="btn btn-success" title="Accept">Accept</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>