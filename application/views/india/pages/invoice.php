<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-info ib">Invoice List</h6>
            <a href="<?php echo base_url('upload-multiple-invoce')?>" class="btn btn-warning btn-circle btn-invoice btn-space" title="Upload multiple invoice">
                  <i class="fa fa-upload" aria-hidden="true"></i>
                  </a> 
            <a href="<?php echo base_url('add-invoice')?>" class="btn btn-info btn-circle btn-invoice btn-space" title="Add Invoice">
                    <i class="fas fa-plus-circle"></i>
                  </a> 
                        
                </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="col-sm-12">
                    <table class="table table-bordered dataTable" id="invoice-dataTable">
                        <thead>
                            <tr>
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
                                    ?>
                                    <tr role="row">
                                        <td><?php echo $i ++; ?></td>
                                        <td><?php echo $item['invoice_number'] ?></td>
                                        <td><?php echo $item['doi'] ?></td>
                                        <td><?php echo $item['product_code'] ?></td>
                                        <td><?php echo $item['product_description'] ?></td>
                                        <td><?php echo $item['product_qty'] ?></td>
                                        <td><?php echo $item['product_rate'] ?></td>
                                        <td><?php echo $item['product_amount'] ?></td>
                                        <td></td>

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

<script>
    $(function() {
        $('.dataTable').dataTable();
    });
</script>