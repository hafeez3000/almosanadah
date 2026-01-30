<?php require_once 'conf/mainconf.php'; ?>


<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title> <?php echo $company_name . " -  ERP 3.0 - Welcome Menu"; ?> </title>
    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="assets/css/bootmetro.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootmetro-tiles.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootmetro-charms.css">
    <link rel="stylesheet" type="text/css" href="assets/css/metro-ui-light.css">
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/icomoon.css"> -->

    <!--  these two css are to use only for documentation -->
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/demo.css">
        <link rel="stylesheet" type="text/css" href="assets/css/prettify.css" > -->

    <link href="assets/css/fontcustom.css" rel="stylesheet">

    <link href="../src/output.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <table width="100%">
            <tr>
                <td>
                    <div class="flex items-center justify-center"><img src="images/logo.jpg" height="56"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="flex items-center justify-center"><img src="images/arname.jpg"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="flex content-center justify-center font-bold">

                        <?php echo $company_name; ?>

                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="flex content-center justify-center font-bold">
                        ERP 3.0
                    </div>
                </td>
            </tr>

        </table>
        <br>
        <!-- Main hero unit for a primary marketing message or call to action -->
            <div class="hero-unit hero-unit-p-4">
                <div id="home-titles" class="container-fluid metro">
                    <div class="row-fluid">
                        <div class="span4">
                            <a class="tile wide imagetext bg-color-orange first" href="sr/login.php">
                                <div class="image-wrapper">
                                    <span class="icon-reservation size-72"></span>
                                </div>
                                <div class="column-text">
                                      <div class="text-header3">Sales & Reservation</div>
                                </div>
                            </a>
                        </div>
                        <div class="span4">
                            <a class="tile wide imagetext bg-color-green middle" href="umrah/login.php">
                                <div class="image-wrapper">
                                    <!--<img src="content/img/metro-tiles.jpg" alt="demo"/>-->
                                    <span class="icon-umrah size-72"></span>
                                </div>
                                <div class="column-text">
                                    <div class="text-header3">Umrah Department</div>
                                </div>
                            </a>
                        </div>
                        <div class="span4">
                            <a class="tile wide imagetext bg-color-blue last" href="operations/login.php">
                                <div class="image-wrapper">
                                    <span class="icon-operations size-72"></span>
                                </div>
                                <div class="column-text">
                                    <div class="text-header3">Operations Department</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="home-titles" class="container-fluid metro">
                    <div class="row-fluid">
                        <div class="span4">
                            <a class="tile wide imagetext bg-color-purple first" href="management/login.php">
                                <div class="image-wrapper">
                                    <span class="icon-admin size-72"></span>
                                </div>
                                <div class="column-text">
                                    <div class="text-header3">Admin Department</div>
                                </div>
                            </a>
                        </div>
                        <div class="span4">
                            <a class="tile wide imagetext bg-color-red middle" href="accounts/login.php">
                                <div class="image-wrapper">
                                <!--<img src="content/img/metro-tiles.jpg" alt="demo"/>-->
                                <span class="icon-accounts size-72"></span>
                                </div>
                                <div class="column-text">
                                    <div class="text-header3">Accounts Department</div>
                                </div>
                            </a>
                        </div>
                    <div class="span4">
                        <a class="tile wide imagetext bg-color-yellow  last" href="hrm/login.php">
                            <div class="image-wrapper">
                                <span class="icon-hr size-72"></span>
                            </div>
                            <div class="column-text">
                                <div class="text-header3">HRM  Department </div>
                            </div>
                        </a>
                    </div>
                    </div>
                </div>
            </div>
 
    <hr>
    <footer>
        <p>© <?php echo $company_name . '&nbsp; ' . date('Y'); ?> </p>
    </footer>
    </div>
</body>

</html>