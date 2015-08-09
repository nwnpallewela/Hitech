<?php session_start(); ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hitech Solutions</title>
        <link rel="shortcut icon" href="img/favicon.png">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.4 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="register-page">
        <div class="register-box">

            <?php
            if (isset($_GET["msg"])) {
                if ($_GET["msg"] == "error") {
                    ?>
                    <div class="pad margin no-print">
                        <div class="callout callout-danger" style="margin-bottom: 0!important;">												
                            <h4><i class="fa fa-warning"></i> Warning:</h4>
                            Some of your data seemed to be incorrect. Please try again.
                        </div>
                    </div>
                    <?php
                }
            }
            ?>

            <div class="register-logo text-info">
                <b>HITECH</b> Solutions
            </div>
            <div class="box box-info">
                <div class="register-box-body">
                    <p class="login-box-msg">Register to HITECH Solutions</p>
                    <form id="reg_form" action="db/SaveUser.php" method="POST">
                        <div class="form-group input-group">
                            <select id="type" name="type" class="form-control" required>
                                <option value="select" selected="" disabled="">Select User Type</option>
                                <?php
                                include './DBCon.php';
                                $res = mysqli_query($con, "SELECT * FROM type");
                                while ($row = mysqli_fetch_array($res)) {
                                    ?>
                                    <option value="<?php echo $row['idtype']; ?>"> <?php echo $row['type']; ?></option>
                                <?php } ?>
                            </select>
                            <span class="input-group-addon"><i class="fa fa-star"></i></span>
                        </div>
                        <div class="form-group input-group">
                            <input name="nic" type="text" class="form-control" placeholder="NIC" maxlength="10" required>
                            <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                        </div>
                        <div class="form-group input-group">
                            <input name="name" type="text" class="form-control" placeholder="Name" required>
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        </div>
                        <div class="form-group input-group">
                            <input name="dob" type="date" class="form-control" placeholder="DOB" required>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                        <div class="form-group input-group">
                            <select name="gender" class="form-control" required="">
                                <option value="select" selected="" disabled="">Select Gender</option>
                                <option value="male"> Male</option>
                                <option value="female"> Female</option>
                            </select>
                            <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                        </div>
                        <div class="form-group input-group">
                            <input name="address" type="text" class="form-control" placeholder="Address" required>
                            <span class="input-group-addon"><i class="fa fa-building"></i></span>
                        </div>
                        <div class="form-group input-group">
                            <input name="email" type="email" class="form-control" placeholder="E-Mail" required>
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        </div>
                        <div class="form-group input-group">
                            <input name="mobile1" type="text" class="form-control" placeholder="Mobile No - 1" maxlength="10">
                            <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                        </div>
                        <div class="form-group input-group">
                            <input name="mobile2" type="text" class="form-control" placeholder="Mobile No - 2" maxlength="10">
                            <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                        </div>
                        <div class="form-group input-group">
                            <input name="fax1" type="text" class="form-control" placeholder="Fax No - 1" maxlength="10">
                            <span class="input-group-addon"><i class="fa fa-fax"></i></span>
                        </div>
                        <div class="form-group input-group">
                            <input name="fax1" type="text" class="form-control" placeholder="Fax No - 2" maxlength="10">
                            <span class="input-group-addon"><i class="fa fa-fax"></i></span>
                        </div>
                        <hr>
                        <div class="form-group input-group">
                            <input name="pw" type="password" class="form-control" placeholder="Password" required>
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </form>        
                    <br/>
                    <a href="Index.php" class="center-block text-center">I already have a account</a>
                </div><!-- /.form-box -->
            </div>
        </div><!-- /.register-box -->

        <script src="js/validateForm.js"></script>
        <!-- jQuery 2.1.4 -->
        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>
