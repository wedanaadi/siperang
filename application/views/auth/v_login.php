<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>siperang | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/fontawesome-free/css/all.min.css' ?>">
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/adminlte.min.css' ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html"><b>SIPER</b>ANG</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form id="loginForm" action="" method="post">
          <div class="input-group mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            <small id="username" class="error_msg invalid-feedback"></small>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            <small id="password" class="error_msg invalid-feedback"></small>
          </div>
          <div class="row">
            <div class="col-8">
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <div id="form_result" style="margin-top: 10px"></div>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <script src="<?php echo base_url() . 'assets/plugins/jquery/jquery.min.js' ?>"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url() . 'assets/plugins/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>

</body>

</html>

<script>
  $(function() {
    $(document).on('submit', '#loginForm', function(e) {
      e.preventDefault();
      let _data = {
        username: $('[name=username]').val(),
        password: $('[name=password]').val(),
      };

      $.ajax({
        url: "<?php echo base_url() . 'c_auth/prosesLogin' ?>",
        type: "POST",
        method: "POST",
        dataType: "JSON",
        data: _data,
        success: function(respon) {
          $('.error_msg').html('');
          $('.form-control').removeClass('is-invalid');
          if (respon.errors) {
            jQuery.each(respon.errors, function(key, value) {
              $('[name=' + key + ']').addClass('is-invalid');
              $('#' + key).fadeIn(0, 300);
              $('#' + key).html(value);
            });
          }

          if (respon.success === false) {
            $("#form_result").fadeIn(1000, function() {
              $("#form_result").removeClass().addClass("alert alert-danger");
              $('#form_result').html("<i class='fa fa-warning'></i> User tidak ditemukan!");
              $("input[name=username]").val('');
              $("input[name=password]").val('');
              $("input[name=username]").focus();
            });
          }

          if (respon.success === true) {
            if (respon.pesan === 0) {
              $("#form_result").fadeIn(1000, function() {
                $("#form_result").removeClass().addClass("alert alert-warning");
                $('#form_result').html("<i class='fa fa-warning'></i> Password salah!");
                $("input[name=password]").val('');
                $("input[name=password]").focus();
              });
            } else {
              $("#form_result").removeClass().addClass("alert alert-success");
              $("#form_result").html("<i class='fa fa-unlock'></i> Login Success ...");
              window.location = respon.url;
            }
          }
        }
      })
      return false;
    });
  });
</script>