<!-- Begin Page Content -->
<div class="container-fluid">
      <!-- Nested Row within Card Body -->
      <div class="card">
            <div class="card-header">
                  <h6 class="m-0 font-weight-bold text-info ib">Update invoice</h6>
                  <a href="<?php echo base_url('london/stock-invoice') ?>" class="btn btn-warning btn-circle btn-invoice" title="Back">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                  </a>
            </div>
            <div class="card-body">
                  <div class="p-2">
                        <form class="add-invoice">
                              <div class="row align-center">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                          <label for="invoice-number">Invoice number</label>
                                          <input type="text" class="form-control" id="invoice-number" name="invoice-number" placeholder="Enter invoice number">
                                    </div>
                                    <div class="col-sm-2">
                                          <label for="invoice-date">Date</label>
                                          <input type="text" class="form-control datepicker" id="invoice-date" name="invoice-date" placeholder=" DD-MM-YYYY">
                                    </div>
                              </div>
                              <div class="row">
                                    <div class="col-lg-12 p-2">
                                          <div class="">
                                                <h5 class="text-gray-900 mb-2">Product details</h5>
                                          </div>
                                    </div>
                              </div>
                              <div class="table-responsive">
                             
                              <table class="table table-bordered" id="update-product-table">
                                    <thead class="bg-gray">
                                          <th class="fs-14">Batch</th>
                                          <th class="fs-14">Code</th>
                                          <th class="fs-14">Description</th>
                                          <th class="fs-14">Opening Stock</th>
                                          <th class="fs-14">Sold Units</th>
                                          <th class="fs-14">Rate</th>
                                          <th class="fs-14">Amount</th>
                                          <th>Action</th>
                                    </thead>
                                    <tbody id="update-stock-body">
                                    </tbody>
                              </table>
                              </div>
                              <div class="btn-container-add-inv">
                                    <a href="#" class="btn btn-success update-sold-stock btn-sm btn-space">
                                          Save
                                    </a>
                                    <a href="#" class="btn btn-info add-more btn-sm btn-space">
                                          Add more
                                    </a>
                              </div>
                        </form>
                  </div>
            </div>
      </div>
</div>

