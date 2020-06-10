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
                                <th rowspan="1" colspan="1">Gender</th>
                                <th rowspan="1" colspan="1">DOB</th>
                                <th rowspan="1" colspan="1">Email</th>
                                <th rowspan="1" colspan="1">Role</th>
                                <th rowspan="1" colspan="1">Joining Date</th>
                                <th rowspan="1" colspan="1">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (!empty($users)) {
                                foreach ($users as $item) {
                                    $dob = ddmmyy($item['dob']);
                                    $jod = ddmmyy($item['joining_date']);
                            ?>
                                    <tr role="row">
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo ucfirst($item['first_name'] . ' ' . $item['last_name']) ?></td>
                                        <td><?php echo ucfirst($item['gender']) ?></td>
                                        <td><?php echo $dob ?></td>
                                        <td><?php echo $item['email'] ?></td>
                                        <td><?php echo $item['role'] ?></td>
                                        <td><?php echo $jod ?></td>
                                        <td><a href="<?php echo base_url('admin/edit-user/') . '/' . base64_encode($item['id']) ?>" class="btn btn-warning btn-circle align-center btn-sm btn-space" title="edit">
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