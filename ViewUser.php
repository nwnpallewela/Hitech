<?php
session_start();
include './ctrl/setUserPrivilege.php';
if (!isSessionAvailable()) {
    header('Location: ./Index.php');
}
if (!isAdmin()) {
    header('Location: ./ErrorPage.php');
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
        <title>HOVAEL</title>
        <link rel="shortcut icon" href="img/favicon.png">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.4 -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link href="dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
        <link href="css/hover.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
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
                        USERS<small>View User</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Home.php"><i class="fa fa-dashboard"></i> HOVAEL</a></li>
                        <li class="active">Home</li>
                    </ol>
                </section>

                <hr>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            <?php
                            if (isset($_GET["msg"])) {
                                if ($_GET["msg"] == "error") {
                                    ?>
                                    <div class="pad margin no-print">
                                        <div class="callout callout-danger" style="margin-bottom: 0!important;">												
                                            <h4><i class="fa fa-warning"></i> Warning:</h4>
                                            An error has occurred. Please try again.
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Custom Tabs -->
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab_1" data-toggle="tab">User Information</a></li>
                                            <li><a href="#tab_2" data-toggle="tab">User Login Sessions</a></li>
                                            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1">

                                                <table id="table_user" class="table table-bordered table-striped table-condensed">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>User Type</th>
                                                            <th>NIC</th>
                                                            <th>Name</th>
                                                            <th>DOB</th>
                                                            <th>Gender</th>
                                                            <th>Address</th>
                                                            <th>E-Mail</th>
                                                            <th>Mobile-1</th>
                                                            <th>Mobile-2</th>
                                                            <th>Fax-1</th>
                                                            <th>Fax-2</th>
                                                            <th>Status</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        include './DBCon.php';
                                                        $res = mysqli_query($con, "SELECT * FROM user JOIN type ON user.idtype=type.idtype");
                                                        while ($row = mysqli_fetch_array($res)) {
                                                            $iduser = $row[0];
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $row[0]; ?></td>
                                                                <td><?php echo $row['type']; ?></td>
                                                                <td><?php echo $row['nic']; ?></td>
                                                                <td><?php echo $row['name']; ?></td>
                                                                <td><?php echo $row['dob']; ?></td>
                                                                <td><?php echo $row['gender']; ?></td>
                                                                <td><?php echo $row['address']; ?></td>
                                                                <td><?php echo $row['email']; ?></td>
                                                                <td><?php echo $row['mobile1']; ?></td>
                                                                <td><?php echo $row['mobile2']; ?></td>
                                                                <td><?php echo $row['fax1']; ?></td>
                                                                <td><?php echo $row['fax2']; ?></td>
                                                                <td>
                                                                    <?php
                                                                    $user_status = $row['status'];
                                                                    if ($user_status == '1') {
                                                                        ?>
                                                                        <span class="label label-success">Approved</span>
                                                                    <?php } else if ($user_status == '0') { ?>
                                                                        <span class="label label-warning">Pending</span>
                                                                    <?php } else { ?>
                                                                        <span class="label label-danger">Denied</span>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['type'] != 'Admin') { ?>
                                                                        <form action="db/ChangeUserStatus.php" method="POST">
                                                                            <input type="hidden" name="iduser" value="<?php echo $iduser; ?>"/>
                                                                            <input type="hidden" name="userstatus" value="<?php echo $user_status; ?>"/>
                                                                            <div class="btn-group">
                                                                                <?php if ($user_status == '1') { ?>
                                                                                    <button type="submit" class="btn btn-xs btn-danger"><span class='glyphicon glyphicon-remove'></span></button>
                                                                                <?php } else { ?>
                                                                                    <button type="submit" class="btn btn-xs btn-danger"><span class='glyphicon glyphicon-ok'></span></button>
                                                                                <?php } ?>
                                                                            </div>
                                                                        </form>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>

                                            </div><!-- /.tab-pane -->
                                            <div class="tab-pane" id="tab_2">

                                                <table id="table_log" class="table table-bordered table-striped table-condensed">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>NIC</th>
                                                            <th>Name</th>
                                                            <th>User Type</th>
                                                            <th>In Time</th>
                                                            <th>Out Time</th>
                                                            <th>IP</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        include './DBCon.php';
                                                        $res = mysqli_query($con, "SELECT * FROM loghistory JOIN user ON loghistory.iduser = user.iduser JOIN type ON user.idtype = type.idtype ORDER BY loghistory.idloghistory DESC");
                                                        while ($row = mysqli_fetch_array($res)) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $row[0]; ?></td>
                                                                <td><?php echo $row['nic']; ?></td>
                                                                <td><?php echo $row['name']; ?></td>
                                                                <td><?php echo $row['type']; ?></td>
                                                                <td><?php echo $row['intime']; ?></td>
                                                                <td><?php echo $row['outtime']; ?></td>
                                                                <td><?php echo $row['ip']; ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>

                                            </div><!-- /.tab-pane -->
                                        </div><!-- /.tab-content -->
                                    </div><!-- nav-tabs-custom -->
                                </div><!-- /.col -->
                            </div>

                        </div>
                    </div>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <?php include './Footer.php'; ?>

        </div><!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.1.4 -->
        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="js/bootstrap.min.js"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js" type="text/javascript"></script>
        <!-- page script -->
        <script type="text/javascript">
            $(function () {
                $("#table_user").DataTable();
                $("#table_log").DataTable();
            });
        </script>

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
              Both of these plugins are recommended to enhance the
              user experience. Slimscroll is required when using the
              fixed layout. -->
    </body>
</html>