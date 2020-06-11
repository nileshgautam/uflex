<div class="dashboard-wrapper">
    <div class="container dashboard-content">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-info ib">Change Password</h6>
                <a href="<?php echo base_url('london/stock-invoice') ?>" class="btn btn-warning btn-circle btn-invoice" title="Back">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </a>
            </div>

            <div class="card-body">
                <form id="change-password" method="post">
                    <div class="box">
                        <div class="form-group col-md-12">
                            <label for="currentPassword"> Current Password<span class="text-danger">*</span><span id="current-password-message" class="text-danger"></span></label>
                            <input id="currentPassword" type="password" name="currentPassword" placeholder="Enter current password" autocomplete="off" class="form-control" value="" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="new-password">New Password<span class="text-danger">*</span></label>
                            <input id="new-password" type="password" name="new-password" placeholder="Enter new password" autocomplete="off" class="form-control " value="" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="confirm-password">Confirm Password<span class="text-danger">*</span> <span id="cnfp-errmsg" class="text-danger"></label>
                            <input id="confirm-password" type="password" name="confirm-password" placeholder="Confirm password" autocomplete="off" class="form-control" value="" required>
                        </div>
                        <div class="user-btn col-md-12">
                            <button type="submit" class="btn btn-space  btn-xs btn-success">Change</button>

                            <a href="<?php echo base_url('london/stock-invoice') ?>" class="btn btn-space btn-warning btn-xs" title="Back">
                                Back
                            </a>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>