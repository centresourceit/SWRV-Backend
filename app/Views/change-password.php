<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SWRV</title>
  <!-- Bootstrap 3 CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
  <!-- W3CSS -->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/fontawesome-free/css/all.min.css" />
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>/public/dist/css/adminlte.min.css" />
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-orange">
    <div class="card-header text-center">
      <a href="<?= base_url(); ?>" class="h1">
        <b>SWRV </b>
      </a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Change Password</p>
      <?php $data = ((!isset($data) || is_null($data)) ? ([]) : ($data)); ?>
      <?php $data['userId'] = ((!isset($data['userId']) || is_null($data['userId'])) ? ("0") : ($data['userId'])); ?>
      <?php $userId = ((set_value("userId") == false) ? ($data['userId']) : (set_value("userId"))); ?>
      <?php $data['otpNo'] = ((!isset($data['otpNo']) || is_null($data['otpNo'])) ? ("0") : ($data['otpNo'])); ?>
      <?php $otpNo = ((set_value("otpNo") == false) ? ($data['otpNo']) : (set_value("otpNo"))); ?>
      <form action="<?= base_url(); ?>/api/change-password/<?= $userId; ?>/<?= $otpNo; ?>" method="post">
        <?php if (isset($success)): ?>
            <div class="alert alert-success animation__shake"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;&nbsp;<?= $success; ?></div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger animation__shake"><i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;<?= $error; ?></div>
        <?php endif; ?>
        <div class="input-group mb-3">
          <input type="hidden" name="userId" value="<?= $userId; ?>" />
          <input type="hidden" name="otpNo" value="<?= $otpNo; ?>" />
          <input type="password" class="form-control" placeholder="Old Password" id="opassword" name="opassword" required="required" />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="New Password" id="password" name="password" required="required" />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirm New Password" id="cpassword" name="cpassword" required="required" />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">&nbsp;</div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-success bg-olive btn-block">Submit</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url(); ?>/public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 3 Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>/public/dist/js/adminlte.min.js"></script>
</body>
</html>
