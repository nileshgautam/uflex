<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<!-- ============================================================== -->
<!-- wrapper  -->
<!-- ============================================================== -->
<div class="dashboard-wrapper">
    <div class="container dashboard-content">
        <div class="card">
            <div class="card-header">
                <?php echo (isset($users)) ? 'Edit User' : ' New User' ?>
                <a href="<?php echo base_url('admin/users') ?>" class="btn btn-warning btn-circle btn-invoice" title="Back">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </a>
            </div>
            <div class="card-body">
                <form id="user-form" method="post">
                    <div class="row container">
                        <div class="form-group col-md-6">
                            <label for="inputUserName">First Name <span class="text-danger">*</span></label>
                            <input id="inputUserName" type="text" name="first-name" placeholder="Enter first name" autocomplete="off" class="form-control" value="<?php echo (isset($users)) ? $users[0]['first_name'] : "" ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last-name">Last Name <span class="text-danger">*</span></label>
                            <input id="last-name" type="text" name="last-name" placeholder="Enter last name" autocomplete="off" class="form-control" value="<?php echo (isset($users)) ? $users[0]['last_name'] : "" ?>" required>
                        </div>
                        <div class="form-group col-md-4 gender-resize">
                            <label for="last-name">Gender <span class="text-danger">*</span></label>
                            <label class="radio-inline">

                                <input type="radio" value="male" class="form-control rs-22" name="gender" <?php if (isset($users)) {
                                                                                                                if ($users[0]['gender'] == 'male') {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                            } ?> checked> Male
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="female" class="form-control rs-22" name="gender" <?php if (isset($users)) {
                                                                                                                if ($users[0]['gender'] == 'female') {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                            } ?>> Female
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="other" class="form-control rs-22" name="gender" <?php if (isset($users)) {
                                                                                                                if ($users[0]['gender'] == 'other') {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                            } ?>> Other
                            </label>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="last-name">Date of Birth<span class="text-danger">*</span></label>
                            <input type="date" format="DD/MM/YYYY" class="date form-control" value="<?php echo (isset($users)) ? $users[0]['dob']: "" ?>" name="dob" id="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="last-name">Joining Date<span class="text-danger">*</span></label>
                            <input type="date" class="date form-control" value="<?php echo (isset($users)) ? $users[0]['joining_date']: "" ?>" name="doj" id="">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="address">Address <span class="text-danger">*</span></label>
                            <textarea name="address" id="" cols="60" rows="3" class='form-control' placeholder="Address..."><?php echo (isset($users)) ? $users[0]['address'] : "" ?></textarea>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="selectcountry">Country <span class="text-danger">*</span></label>
                            <select name="country" id="country" placeholder="Select state" autocomplete="off" class="form-control" data-state="<?php echo (isset($users) ? $users[0]['state'] : '') ?>">
                                <option>Select country</option>
                                <?php if (!empty($country)) {
                                    foreach ($country as $countries) { ?>

                                        <option id='<?php echo $countries['id'] ?>' <?php if (!empty($users)) {
                                                                                        echo ($countries['name'] ==  $users[0]['country']) ? ' selected' : '';
                                                                                    } else {
                                                                                        echo ($countries['name'] == "India") ? "selected" : '';
                                                                                    }

                                                                                    ?>>

                                            <?php echo $countries['name']; ?>
                                        </option>


                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="state">State <span class="text-danger">*</span></label>
                            <select name="state" id="state" placeholder="Select state" autocomplete="off" class="form-control" data-city="<?php echo (isset($users) ? $users[0]['city'] : '') ?>">
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="city">City <span class="text-danger">*</span></label>
                            <select name="city" id="city" autocomplete="off" class="form-control">
                                <option value="<?php echo isset($users) ? $users[0]['city'] : '' ?>">

                                    <?php echo isset($users) ? $users[0]['city'] : 'Select State' ?>
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="zip-pin-code">Zip/Pin Code<span class="text-danger">*</span></label>
                            <input id="zip-pin-code" type="text" name="zip-pin-code" placeholder="Zip/Pin Code" autocomplete="off" class="form-control" value="<?php echo (isset($users)) ? $users[0]['zip_pin'] : "" ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="input-email">Email address <span class="text-danger">*</span></label>
                            <input id="input-user-email" type="email" name="email" placeholder="Enter email" autocomplete="off" class="form-control" value="<?php echo (isset($users)) ? $users[0]['email'] : "" ?>" required>
                            <small id="user-error-email" class="">We'll never share your email with anyone else.</small>

                        </div>
                        <div class="form-group col-md-4">
                            <label for="mobile-no">Mobile No. <span class="text-danger">*</span></label>
                            <input id="input-user-mobile" type="number" name="mobile-no" placeholder="Enter mobile no." autocomplete="off" class="form-control" value="<?php echo (isset($users)) ? $users[0]['mobile'] : "" ?>" required>
                            <small id="user-error-mobile">We'll never share your mobile with anyone else.</small>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="password">Role</label>
                            <select name="role" id="role" autocomplete="off" class="form-control">
                                <option>Select Role <span class="text-danger">*</span></option>
                                <?php if (!empty($role)) {
                                    // echo '<pre>';
                                    // print_r($role);
                                    foreach ($role as $user_role) {
                                ?>
                                        <option <?php if (isset($users)) {
                                                    echo ($users[0]['role'] ==  $user_role['description']) ? ' selected="selected"' : '';
                                                } ?>>
                                            <?php echo $user_role['description'] ?>

                                        </option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <div class="input-group show_hide_password" id="">
                                <input id="password" type="password" name="password" placeholder="Enter password." autocomplete="off" class="form-control" value="<?php echo (isset($users)) ? $users[0]['password'] : "" ?>" required>
                                <div class="input-group-addon">
                                    <a href='#'><i class="fa fa-eye-slash" aria-hidden="true" style="padding: 10px; border: 1px solid #d3cfcf;"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="password"> Confirm Password <span class="text-danger">*</span></label>
                            <div class="input-group show_hide_password" id="">
                                <input id="cnf-password" type="cnfpassword" name="confirm-password" placeholder="Re-enter password." autocomplete="off" class="form-control" value="<?php echo (isset($users)) ? $users[0]['password'] : "" ?>" required>
                                <div class="input-group-addon">
                                    <a href='#'><i class="fa fa-eye-slash" aria-hidden="true" style="padding: 10px; border: 1px solid #d3cfcf;"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- button section -->
                    <div class="user-btn">
                        <input type="hidden" id="user-id" name="id" value="<?php echo (isset($users) ? $users[0]['id'] : '') ?>">
                        <button type="submit" class="btn btn-space  btn-xs btn-success">Submit</button>
                        <button type="button" class="btn btn-space btn-warning btn-xs " id="back-to-users">Back</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->