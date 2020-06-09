<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-info ib">Users Administration</h6>
            <a href="<?php echo base_url('admin/add-user') ?>" class="btn btn-info btn-circle btn-invoice btn-space" title="Add Invoice">
                <i class="fas fa-plus"></i>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="col-sm-12">
                    <table class="table table-bordered dataTable" id="users-dataTable">
                        <thead>
                            <tr> 
                                <th rowspan="1" colspan="1">Sr.No.</th>
                                <th rowspan="1" colspan="1">Name</th>
                                <th rowspan="1" colspan="1">DOB</th>
                                <th rowspan="1" colspan="1">Email</th>
                                <th rowspan="1" colspan="1">Role</th>
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
                                        
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo RemoveSpecialChar($item['invoice_number']) ?></td>
                                        <td><?php echo  $date ?></td>
                                        <td><?php echo RemoveSpecialChar($item['product_code']) ?></td>
                                        <td><?php echo RemoveSpecialChar($item['product_description']) ?></td>
                                        <td><a href="<?php echo base_url('IndiaControl/eiditinvoce').'/'.base64_encode($item['invoice_number']).'/'.base64_encode( $item['product_code']) ?>" class="btn btn-warning btn-circle btn-invoice btn-space" title="edit">
                                                <i class="fas fa-edit"></i>
                                            </a></td>
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