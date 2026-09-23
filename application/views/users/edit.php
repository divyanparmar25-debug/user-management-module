<?php

$title = 'User Management';

$this->load->view('layouts/header');

?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <h3>Edit User</h3>

    <a href="<?= site_url('users') ?>" class="btn btn-secondary">
        Back
    </a>

</div>

<div class="card">

    <div class="card-body">

        <form method="post" action="<?= site_url('users/update/' . $user['id']) ?>">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control"
                        value="<?= set_value('name', $user['name']) ?>">
                    <?= form_error('name', '<small class="text-danger">', '</small>') ?>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control"
                        value="<?= set_value('email', $user['email']) ?>">
                    <?= form_error('email', '<small class="text-danger">', '</small>') ?>
                </div>

                <?php if ($this->session->userdata('user_role') == 'ADMIN'): ?>

                    <div class="col-md-6 mb-3">

                        <label>Role</label>

                        <select name="role" class="form-select">

                            <option value="ADMIN"
                                <?= set_select('role', 'ADMIN', $user['role'] == 'ADMIN'); ?>>
                                ADMIN
                            </option>

                            <option value="OPERATOR"
                                <?= set_select('role', 'OPERATOR', $user['role'] == 'OPERATOR'); ?>>
                                OPERATOR
                            </option>

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Status</label>

                        <select name="status" class="form-select">

                            <option value="ACTIVE"
                                <?= set_select('status', 'ACTIVE', $user['status'] == 'ACTIVE'); ?>>
                                ACTIVE
                            </option>

                            <option value="INACTIVE"
                                <?= set_select('status', 'INACTIVE', $user['status'] == 'INACTIVE'); ?>>
                                INACTIVE
                            </option>

                        </select>

                    </div>
            </div>

        <?php endif; ?>

        <button type="submit" class="btn btn-primary">
            Update User
        </button>

        <a href="<?= site_url('users') ?>" class="btn btn-secondary">
            Cancel
        </a>

        </form>
    </div>

</div>

<?php $this->load->view('layouts/footer'); ?>