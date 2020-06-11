<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-info ib">Sent Invoice List</h6>
            <a href="<?php echo base_url('india/invoice') ?>" class="btn btn-warning btn-circle btn-invoice" title="Back">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
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
                                <th rowspan="1" colspan="1">Status</th>

                            </tr>
                        </thead>
                        <tbody id="sent-status">
                            <?php

                            $i = 1;

                            if (!empty($invoice)) {
                                foreach ($invoice as $item) {
                                    $date=ddmmyy($item['doi']);
                                    $status='';
                                    if($item['send_status']==REJECTED){
                                        $status.='<a href="'.base_url("IndiaControl/reject_list/").base64_encode($item['id']).'" ><span class="text-danger ">Rejected</span><a>';  
                                    }else if($item['send_status']==SENT){
                                        $status.='<span class="text-success">Sent</span>'; 
                                    }
                                    else if($item['send_status']==ACCEPT){
                                        $status.='<span class="text-success">Accepted</span>'; 
                                    }
                            ?>
                                    <tr role="row">
                                        <td></td>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo RemoveSpecialChar($item['invoice_number']) ?></td>
                                        <td colspan="1"><?php echo $date ?></td>
                                        <td><?php echo RemoveSpecialChar( $item['product_code']) ?></td>
                                        <td><?php echo RemoveSpecialChar( $item['product_description']) ?></td>
                                        <td><?php echo $item['product_qty'] ?></td>
                                        <td><?php echo $item['product_rate'] ?></td>
                                        <td><?php echo $item['product_amount'] ?></td>
                                        <td><?php echo $status ?></td>

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

