<div class="container-fluid">
    <div class="card shadow mb-4">

        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-info ib">Edit</h6>
                <a href="<?php echo base_url('invoice') ?>" class="btn btn-warning btn-circle btn-invoice" title="Back">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </a>
            </div>
            <div class="card-body">
                <form id="edit-invoice-form">
                    <div class="form-group">
                        <label for="invoice-number">Inoice number</label>
                        <input type="text" class="form-control" id="invoice-number" placeholder="invoice-number" name="invoice-number" value="<?php echo (isset($invoice) ? $invoice[0]['invoice_number'] : ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="doi">Date of Invoice</label>
                        <input type="date" class="form-control" id="doi" format="dd/mm/yyyy" placeholder="Date" name="doi" value="<?php echo (isset($invoice) ? $invoice[0]['doi'] : ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="icode">Item code</label>
                        <input type="text" class="form-control" id="icode" placeholder="Item code" name="icode" value="<?php echo (isset($invoice) ? $invoice[0]['product_code'] : ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="idec">Description</label>
                        <textarea name="idec" class="form-control" id="idec" cols="30" rows="2"><?php echo (isset($invoice) ? $invoice[0]['product_description'] : ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="iqty">Qty.</label>
                        <input type="number" class="form-control" id="iqty" placeholder="Qty" name="iqty" value="<?php echo (isset($invoice) ? $invoice[0]['product_qty'] : ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="irate">Rate</label>
                        <input type="number" class="form-control" id="irate" placeholder="Rate" name="irate" value="<?php echo (isset($invoice) ? $invoice[0]['product_rate'] : ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" id="amount" placeholder="Amount" name="amount" value="<?php echo (isset($invoice) ? $invoice[0]['product_amount'] : ''); ?>">
                    </div>

                    <input type="hidden" name="invoice-id" value="<?php echo (isset($invoice) ? $invoice[0]['id'] : ''); ?>">
                    <div class="btn-send">
                        <button type="submit" class="btn btn-success btn-space">Submit</button>
                        <a href="<?php echo base_url('invoice') ?>" class="btn btn-danger btn-space text-white">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>