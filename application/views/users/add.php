<?php

$title = 'User Management';

$this->load->view('layouts/header');

?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <h3>Add User</h3>

    <a href="<?= site_url('users') ?>" class="btn btn-secondary">
        Back
    </a>

</div>

<div class="card">

    <div class="card-body">

        <form method="post" action="<?= site_url('users/store') ?>">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?= set_value('name') ?>">
                    <?= form_error('name', '<small class="text-danger">', '</small>') ?>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?= set_value('email') ?>">
                    <?= form_error('email', '<small class="text-danger">', '</small>') ?>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                    <?= form_error('password', '<small class="text-danger">', '</small>') ?>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control">
                    <?= form_error('confirm_password', '<small class="text-danger">', '</small>') ?>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Role</label>

                    <select name="role" class="form-select">

                        <option value="">Select</option>
                        <option value="ADMIN"
                            <?= set_select('role', 'ADMIN'); ?>>

                            ADMIN

                        </option>

                        <option value="OPERATOR"
                            <?= set_select('role', 'OPERATOR'); ?>>

                            OPERATOR

                        </option>

                    </select>

                    <?= form_error('role', '<small class="text-danger">', '</small>') ?>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Status</label>

                    <select name="status" class="form-select">

                        <option value="">Select</option>
                        <option value="ACTIVE"
                            <?= set_select('status', 'ACTIVE'); ?>>

                            ACTIVE

                        </option>

                        <option value="INACTIVE"
                            <?= set_select('status', 'INACTIVE'); ?>>

                            INACTIVE

                        </option>

                    </select>

                    <?= form_error('status', '<small class="text-danger">', '</small>') ?>

                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                Save User
            </button>

            <a href="<?= site_url('users') ?>" class="btn btn-secondary">
                Cancel
            </a>

        </form>
    </div>

</div>

<?php $this->load->view('layouts/footer'); ?>