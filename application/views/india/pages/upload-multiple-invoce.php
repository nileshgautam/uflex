      <!-- Begin Page Content -->
      <div class="container">
            <div class="card">
                  <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-info ib">Upload Invoices</h6>
                        <a href="<?php echo base_url('invoice') ?>" class="btn btn-warning btn-circle btn-invoice" title="Back">
                              <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </a>
                  </div>
                  <div class="card-body">
                        <form method="post" id="import_csv" enctype="multipart/form-data">
                              <div class="custom-file col-md-3 inp-file">
                                    <input type="file" name="csv_file" id="csv_file" class="custom-file-input" required accept=".csv" />
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                              </div>
                              <div class="form-group">
                                    <button type="submit" name="import_csv" class="btn btn-info btn-sm btn-flx" id="import_csv_btn">Import CSV</button>
                              </div>
                        </form>
                  </div>
            </div>
            <div>
                  <div id="imported_csv_data"></div>
            </div>
      </div>

      <script src="<?php echo base_url('assets/custom/js/upload_csv.js') ?>">
            $('.dataTable').dataTable();
      </script>