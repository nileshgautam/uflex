      <!-- Begin Page Content -->
      <div class="container-fluid">
            <div class="card-body p-0">
                  <!-- Nested Row within Card Body -->
                  <div class="row">
                        <div class="col-lg-12">
                              <div class="">
                                    <h1 class="h4 text-gray-900 mb-2">Add invoice</h1>
                              </div>
                        </div>
                        <div class="col-lg-12">
                              <div class="p-2">
                                    <form class="add-invoice">
                                          <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                      <label for="invoice-number">Invoice number</label>
                                                      <input type="text" class="form-control" id="invoice-number" placeholder="Enter invoice number">
                                                </div>
                                                <div class="col-sm-6">
                                                      <label for="invoice-date">Invoice date</label>
                                                      <input type="text" class="form-control" id="invoice-date" placeholder="Enter invoice date">
                                                </div>
                                          </div>
                                          <div class="row">
                                                <div class="col-lg-12 p-2">
                                                      <div class="">
                                                            <h3 class="h4 text-gray-900 mb-2">Product details</h3>
                                                      </div>
                                                </div>
                                          </div>
                                          <table class="table" id="product-table">
                                                <thead class="bg-primary text-white">
                                                      <th>Product code</th>
                                                      <th>Product details</th>
                                                      <th>Product qty</th>
                                                      <th>Product rate</th>
                                                      <th>Product amount</th>
                                                      <th>Action</th>
                                                </thead>
                                                <tbody id="product-body">
                                                </tbody>
                                          </table>


                                          <div class="col-sm-2 float-right">
                                                <a href="#" class="btn btn-primary btn-user btn-block save-data">
                                                      Submit
                                                </a>

                                          </div>
                                          <div class="col-sm-2 float-right">
                                                <a href="#" class="btn btn-info add-more btn-user btn-block">
                                                      Add more
                                                </a>
                                          </div>



                                          <!-- </div> -->
                                    </form>
                              </div>
                        </div>
                  </div>
            </div>
      </div>

      <!-- <script src="<?php echo base_url() ?>assets/custom/js/login.js"></script> -->