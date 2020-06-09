<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-info ib">Product list</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="col-sm-12">
                    <table class="table table-bordered dataTable" id="product-list-dataTable">
                        <thead>
                            <tr>
                                <th rowspan="1" colspan="1">Sr.No.</th>
                                <th rowspan="1" colspan="1">Product Code</th>
                                <th rowspan="1" colspan="1">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (!empty($product_list)) {
                                foreach ($product_list as $item) {
                            ?>
                                    <tr role="row">
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo RemoveSpecialChar($item['code']) ?></td>
                                        <td><?php echo RemoveSpecialChar($item['description']) ?></td>
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