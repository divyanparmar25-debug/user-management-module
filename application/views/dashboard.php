<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h3>Welcome <?= $this->session->userdata('user_name'); ?></h3>

<p>Role : <?= $this->session->userdata('user_role'); ?></p>

<a href="<?= site_url('users'); ?>" class="btn btn-success">
    User Management
</a>

<a href="<?= site_url('logout') ?>" class="btn btn-danger">
Logout
</a>

</div>

</body>
</html>