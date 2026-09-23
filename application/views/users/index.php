<?php

$title = 'User Management';

$this->load->view('layouts/header');

?>

<div class="d-flex justify-content-between align-items-center mb-3">

    <h3>User Management</h3>

    <div>

        <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary">
            Dashboard
        </a>

        <?php if ($this->session->userdata('user_role') == 'ADMIN'): ?>

            <a href="<?= site_url('users/add') ?>" class="btn btn-primary">
                Add User
            </a>

        <?php endif; ?>

    </div>

</div>

<?php if ($this->session->flashdata('success')): ?>

    <div class="alert alert-success">

        <?= $this->session->flashdata('success'); ?>

    </div>

<?php endif; ?>

<form method="get" action="<?= site_url('users') ?>" class="row g-2 mb-3">

    <div class="col-md-4">
        <input type="text"
            name="search"
            class="form-control"
            placeholder="Search Name or Email"
            value="<?= $search; ?>">
    </div>

    <div class="col-md-2">
        <select name="role" class="form-select">
            <option value="">All Roles</option>
            <option value="ADMIN" <?= ($role == 'ADMIN') ? 'selected' : ''; ?>>ADMIN</option>
            <option value="OPERATOR" <?= ($role == 'OPERATOR') ? 'selected' : ''; ?>>OPERATOR</option>
        </select>
    </div>

    <div class="col-md-2">
        <select name="status" class="form-select">
            <option value="">All Status</option>
            <option value="ACTIVE" <?= ($status == 'ACTIVE') ? 'selected' : ''; ?>>ACTIVE</option>
            <option value="INACTIVE" <?= ($status == 'INACTIVE') ? 'selected' : ''; ?>>INACTIVE</option>
        </select>
    </div>

    <div class="col-md-2">
        <button type="submit" class="btn btn-success w-100">
            Search
        </button>
    </div>

    <div class="col-md-2">
        <a href="<?= site_url('users') ?>" class="btn btn-secondary w-100">
            Reset
        </a>
    </div>

</form>

<div class="table-responsive">

    <table class="table table-bordered table-hover">

        <thead class="table-dark">

            <tr>

                <th>Name</th>

                <th>Email</th>

                <th>Role</th>

                <th>Status</th>

                <th>Created</th>

                <th width="180">Action</th>

            </tr>

        </thead>

        <tbody>

            <?php if (!empty($users)): ?>

                <?php foreach ($users as $user): ?>

                    <tr>


                        <td><?= $user['name']; ?></td>

                        <td><?= $user['email']; ?></td>

                        <td>

                            <?php if ($user['role'] == 'ADMIN'): ?>

                                <span class="badge bg-primary">
                                    ADMIN
                                </span>

                            <?php else: ?>

                                <span class="badge bg-info text-dark">
                                    OPERATOR
                                </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <?php if ($this->session->userdata('user_role') == 'ADMIN'): ?>

                                <select
                                    class="form-select status"
                                    data-id="<?= $user['id']; ?>">

                                    <option value="ACTIVE"
                                        <?= ($user['status'] == 'ACTIVE') ? 'selected' : '' ?>>

                                        ACTIVE

                                    </option>

                                    <option value="INACTIVE"
                                        <?= ($user['status'] == 'INACTIVE') ? 'selected' : '' ?>>

                                        INACTIVE

                                    </option>

                                </select>

                            <?php else: ?>

                                <?= $user['status']; ?>

                            <?php endif; ?>

                        </td>

                        <td><?= date('d-m-Y', strtotime($user['created_at'])); ?></td>

                        <td>

                            <a href="<?= site_url('users/edit/' . $user['id']) ?>"
                                class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <?php if ($this->session->userdata('user_role') == 'ADMIN'): ?>

                                <a href="<?= site_url('users/delete/' . $user['id']) ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">

                                    Deactivate

                                </a>

                            <?php endif; ?>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="6" class="text-center">

                        No Records Found

                    </td>

                </tr>

            <?php endif; ?>

        </tbody>

    </table>
</div>

<div class="mt-3">
    <?= $links; ?>
</div>

</body>

<script>
    $(document).ready(function() {

        $('.status').change(function() {

            var id = $(this).data('id');
            var status = $(this).val();

            $.ajax({

                url: '<?= site_url("users/change-status") ?>',

                type: 'POST',

                data: {
                    id: id,
                    status: status
                },

                dataType: 'json',

                success: function(response) {

                    alert(response.message);

                },

                error: function() {

                    alert('Something went wrong.');

                }

            });

        });

    });
</script>

<?php $this->load->view('layouts/footer'); ?>