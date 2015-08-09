<?php
session_start();
include './ctrl/setUserPrivilege.php';
if (!isSessionAvailable()) {
    header('Location: ./Index.php');
}
?>
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
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.4 -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link href="dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <style>
            .example-modal .modal {
                position: relative;
                top: auto;
                bottom: auto;
                right: auto;
                left: auto;
                display: block;
                z-index: 1;
            }
            .example-modal .modal {
                background: transparent!important;
            }
        </style>
    </head>

    <body class="skin-blue sidebar-mini">
        <div class="wrapper">

            <?php include './Header.php'; ?>
            <?php include './SideBar.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Profile<small>Update Profile</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Home.php"><i class="fa fa-dashboard"></i> HOVAEL</a></li>
                        <li class="active">Profile</li>
                    </ol>
                </section>

                <hr>

                <?php
                $iduser = $_SESSION['iduser'];
                ?>

                <!-- Main content -->
                <section class="content">

                    <?php
                    if (isset($_GET["msg"])) {
                        if ($_GET["msg"] == "error") {
                            ?>
                            <div class="pad margin no-print">
                                <div class="callout callout-danger" style="margin-bottom: 0!important;">												
                                    <h4><i class="fa fa-warning"></i> Warning:</h4>
                                    An error has occurred when updating. Please try again.
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>

                    <div class="example-modal">
                        <div class="modal modal-primary">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Profile</h4>
                                    </div>
                                    <form id="reg_form" action="db/UpdateUser.php" method="POST">
                                        <div class="modal-body">
                                            <div class="box box-info">
                                                <div class="register-box-body">
                                                    <?php
                                                    include './DBCon.php';
                                                    $res = mysqli_query($con, "SELECT * FROM user JOIN type ON user.idtype=type.idtype WHERE user.iduser='$iduser'");
                                                    if ($rowMain = mysqli_fetch_array($res)) {
                                                        ?>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">User Type</label>
                                                            <div class="col-sm-9 input-group">
                                                                <input name="type" type="text" class="form-control" value="<?php echo $rowMain['type']; ?>" disabled>
                                                                <span class="input-group-addon"><i class="fa fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">NIC</label>
                                                            <div class="col-sm-9 input-group">
                                                                <input name="nic" type="text" class="form-control" placeholder="NIC" value="<?php echo $rowMain['nic']; ?>" maxlength="10" required>
                                                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Name</label>
                                                            <div class="col-sm-9 input-group">
                                                                <input name="name" type="text" class="form-control" placeholder="Name" value="<?php echo $rowMain['name']; ?>" required>
                                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">DOB</label>
                                                            <div class="col-sm-9 input-group">
                                                                <input name="dob" type="date" class="form-control" placeholder="DOB" value="<?php echo $rowMain['dob']; ?>" required>
                                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Gender</label>
                                                            <div class="col-sm-9 input-group">
                                                                <select name="gender" class="form-control" required>
                                                                    <option value="select" disabled="">Select Gender</option>
                                                                    <?php if ('male' == $rowMain['gender']) { ?>
                                                                        <option value="male" selected> Male</option>
                                                                        <option value="female"> Female</option>
                                                                    <?php } else { ?>
                                                                        <option value="male"> Male</option>
                                                                        <option value="female" selected> Female</option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Address</label>
                                                            <div class="col-sm-9 input-group">
                                                                <input name="address" type="text" class="form-control" placeholder="Mobile No" value="<?php echo $rowMain['address']; ?>" required>
                                                                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">E-Mail</label>
                                                            <div class="col-sm-9 input-group">
                                                                <input name="email" type="email" class="form-control" placeholder="E-Mail" value="<?php echo $rowMain['email']; ?>" required>
                                                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Mobile No - 1</label>
                                                            <div class="col-sm-9 input-group">
                                                                <input name="mobile1" type="text" class="form-control" placeholder="Mobile No - 1" value="<?php echo $rowMain['mobile1']; ?>">
                                                                <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Mobile No - 2</label>
                                                            <div class="col-sm-9 input-group">
                                                                <input name="mobile2" type="text" class="form-control" placeholder="Mobile No - 2" value="<?php echo $rowMain['mobile2']; ?>">
                                                                <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Fax No - 1</label>
                                                            <div class="col-sm-9 input-group">
                                                                <input name="fax1" type="text" class="form-control" placeholder="Fax No - 1" value="<?php echo $rowMain['fax1']; ?>">
                                                                <span class="input-group-addon"><i class="fa fa-fax"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Fax No - 2</label>
                                                            <div class="col-sm-9 input-group">
                                                                <input name="fax2" type="text" class="form-control" placeholder="Fax No - 2" value="<?php echo $rowMain['fax2']; ?>">
                                                                <span class="input-group-addon"><i class="fa fa-fax"></i></span>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div><!-- /.form-box -->
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="PasswordChangeForm.php"><button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Change Password</button></a>
                                            <button type="submit" class="btn btn-outline">Update</button>
                                        </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div><!-- /.example-modal -->

                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <?php include './Footer.php'; ?>

        </div><!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.1.4 -->
        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js" type="text/javascript"></script>

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
              Both of these plugins are recommended to enhance the
              user experience. Slimscroll is required when using the
              fixed layout. -->
    </body>
</html>