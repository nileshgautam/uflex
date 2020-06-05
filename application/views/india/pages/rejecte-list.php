<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-info ib">Rejected inovice</h6>
                <a href="<?php echo base_url('sent-invoice') ?>" class="btn btn-warning btn-circle btn-invoice" title="Back">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </a>
            </div>
            <div class="card-body">
                <div>
                    <h4 class="font-weight-bold text-info">Invocie Number</h4><p><?php print_r($rejected[0]['invoice_number']) ?></p>
                    <h6 class="font-weight-bold text-info">Remark</h6>
                    <h6><?php print_r($rejected[0]['reject_reason']) ?></h6>
                    <a href="" class="btn btn-success">Re-send</a>
                </div>
            </div>
        </div>
    </div>
</div>