<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__ . "/../../../vendor/autoload.php";

$admin = new LTE\Admin;
echo $admin->head();
?>

<body class="hold-transition login-page">

  <div class="login-box">



  <div class="card">
    <div class="card-body login-card-body">
      <div class="login-logo d-none d-sm-block">
        <img src="/dist/img/minitel.png">
      </div>

      <form action="login.php" method="post" autocomplete="off">
        <div class="input-group mb-3">
          <input type="email" name=email id="inputEmail" class="form-control" placeholder="Email" autocomplete="off" required>
          <div class="input-group-append">
              <span class="fas fa-user input-group-text"></span>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" name=password id="inputPassword" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">

          <div class="col-8"></div>

          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>

        <div class="row">
          <div class="social-auth-links text-center mb-0">
            <!--
            <a href="#" class="btn btn-block btn-primary">
              <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
              <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
            </a>
          -->
            <p class="mb-0">
              <a href="/auth/register" class="text-center">Register</a>
            </p>

          </div>



        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>

<script type="text/javascript">
  document.getElementById('inputEmail').focus();
</script>
</body>
