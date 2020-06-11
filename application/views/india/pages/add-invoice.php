      <!-- Begin Page Content -->
      <div class="container-fluid">
            <!-- Nested Row within Card Body -->
            <div class="card">
                  <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-info ib">Add invoice</h6>

                        <a href="<?php echo base_url('india/invoice') ?>" class="btn btn-warning btn-circle btn-invoice" title="Back">
                              <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </a>
                  </div>
                  <div class="card-body">
                        <div class="p-2">
                              <form class="add-invoice">
                                    <div class="form-group row">

                                          <div class="col-sm-2">
                                                <label for="invoice-date">Invoice date</label>
                                                <input type="text" class="form-control datepicker" id="invoice-date" name="invoice-date" placeholder=" DD-MM-YYYY">
                                          </div>
                                          <div class="col-sm-4 mb-3 mb-sm-0">
                                                <label for="invoice-number">Invoice number</label>
                                                <input type="text" class="form-control" id="invoice-number" name="invoice-number" placeholder="Enter invoice number">
                                          </div>
                                    </div>
                                    <div class="row">
                                          <div class="col-lg-12 p-2">
                                                <div class="">
                                                      <h5 class="text-gray-900 mb-2">Product details</h5>
                                                </div>
                                          </div>
                                    </div>
                                    <table class="table table-bordered" id="product-table">
                                          <thead class="bg-info text-white">
                                                <th>Code</th>
                                                <th class="w-350">Description</th>
                                                <th>Qty.</th>
                                                <th>Rate</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                          </thead>
                                          <tbody id="product-body">
                                          </tbody>
                                    </table>
                                    <div class="btn-container-add-inv">
                                          <a href="#" class="btn btn-success  save-data btn-sm btn-space">
                                                Submit
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


      