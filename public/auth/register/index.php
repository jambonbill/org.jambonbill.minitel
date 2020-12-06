<?php
//register
header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__ . "/../../../vendor/autoload.php";

$admin = new LTE\Admin;
echo $admin->head();

//TODO
?>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Register</b></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">You know what to do</p>

      <form action="../../index.html" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" id=username placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <!--
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
        -->
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>



      <a href="/auth/login" class="text-center">Login</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

</body>


<script type="text/javascript">
  document.getElementById('username').focus();
</script>
