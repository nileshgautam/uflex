      <!-- Begin Page Content -->
      <div class="container">
            <div class="card">
                  <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-info ib">Upload Invoices</h6>
                        <a href="<?php echo base_url('sample_file/londoninvoice_format.csv')?>" class="font-weight-bold text-success ml-25">Download Sample file for Invoices
                        <i class="fa fa-download" aria-hidden="true"></i>
                        </a>
                        <a href="<?php echo base_url('london/stock-invoice') ?>" class="btn btn-warning btn-circle btn-invoice" title="Back">
                              <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </a>
                  </div>
                  <div class="card-body" id="upload-multiple-invoice">
                        <form method="post" id="load_csv" enctype="multipart/form-data">
                              <div class="custom-file col-md-3 inp-file">
                                    <input type="file" name="csv_file" id="csv_file" class="custom-file-input" required accept=".csv" />
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                              </div>
                              <div class="form-group">
                                    <button type="submit" name="import_csv" class="btn btn-info btn-sm btn-flx" id="load_file">Import CSV</button>
                              </div>
                        </form>
                  </div>
            </div>
            <div>
                  <div id="london_inovice_csv_data"></div>
            </div>
      </div>

