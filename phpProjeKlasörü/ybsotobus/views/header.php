<!DOCTYPE HTML>
<html>
<head>

    <title>YBS TURİZM</title>
    <!--link for javascript defalt-->
    <script type="text/javascript" src="<?php echo URL; ?>public/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/default.js"></script>

    <!--link for javascript validation-->
    <script type="text/javascript" src="<?php echo URL; ?>public/js/form_validation/jquery.form-validator.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/form_validation/customValidation.js"></script>

    <!--link for javascript data table-->
    <script type="text/javascript" src="<?php echo URL; ?>public/js/table/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/table/customTables.js"></script>

    <!--link for javascript date&time-->
    <script type="text/javascript" src="<?php echo URL; ?>public/js/date&time/jQuery.ptTimeSelect.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/date&time/jquery-ui-1.8.22.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/date&time/jquery.ui.timepicker.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/date&time/customDateTime.js"></script>

    <!--link for javascript Parse-->
    <script type="text/javascript" src="<?php echo URL; ?>public/js/report.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/map/parse-1.2.18.min.js"></script>


    <!--link for stylesheet for defalt-->
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/report.css" />

    <!--link for stylesheet for booker-->
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/booker/seat.css" />

    <!--link for stylesheet for data table-->
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/table/demo_page.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/table/demo_table.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/table/demo_table_jui.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/table/jquery-ui-1.8.4.custom.css" />

    <!--link for stylesheet for date&time-->
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/date&time/jquery.ptTimeSelect.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/date&time/jquery.ui.timepicker.css" />

    <?php
    if (isset($this->js_1)) {
        foreach ($this->js_1 as $js) {
            echo '<script type="text/javascript" src="' . URL . $js . '"></script>';
        }
    }
    if (isset($this->js_2)) {
        foreach ($this->js_2 as $js) {
            echo '<script type="text/javascript" src="' . URL . $js . '"></script>';
        }
    }
    if (isset($this->js_3)) {
        foreach ($this->js_3 as $js) {
            echo '<script type="text/javascript" src="' . URL . $js . '"></script>';
        }
    }
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Green Wheels Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="<?php echo URL; ?>public/css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="<?php echo URL; ?>public/css/stylenew.css" rel='stylesheet' type='text/css' />
    <link href="<?php echo URL; ?>public/css/opensans.css" rel='stylesheet' type='text/css' />
    <link href="<?php echo URL; ?>public/css/roboto.css" rel='stylesheet' type='text/css' />
    <link href="<?php echo URL; ?>public/css/oswald.css" rel='stylesheet' type='text/css' />
    <link href="<?php echo URL; ?>public/css/font-awesome.css" rel="stylesheet">
    <!-- Custom Theme files -->

    <script src="<?php echo URL; ?>public/js/bootstrap.min.js"></script>
    <!--animate-->
    <link href="<?php echo URL; ?>public/css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="<?php echo URL; ?>public/js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <!--//end-animate-->
</head>
<body>
<!-- top-header -->
<div class="top-header">
    <div class="container">
        <ul class="tp-hd-lft wow fadeInLeft animated" data-wow-delay=".5s">
            <li class="hm"><a href="<?php echo URL; ?>"><i class="fa fa-home"></i></a></li>

        </ul>
        <ul class="tp-hd-rgt wow fadeInRight animated" data-wow-delay=".5s">
            <li >Tel No : +90-(123)-4568790</li>
            <?php if (Session::get('loggedIn') == true): ?>
                <li><a href="<?php echo URL; ?>login/logout">ÇIKIŞ YAP(<?php echo Session::get('userName'); ?>)</a></li>
            <?php else: ?>
                <li><a href="<?php echo URL; ?>login">GİRİŞ YAP</a></li>
            <?php endif; ?>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!--- /top-header ---->
<!--- header ---->
<div class="header">
    <div class="container">
        <div class="logo wow fadeInDown animated" data-wow-delay=".5s">
            <a href="<?php echo URL; ?>">YBS <span>OTOBÜS</span></a>
        </div>
        <div class="lock fadeInDown animated" data-wow-delay=".5s">
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!--- /header ---->
<!--- footer-btm ---->
<div class="footer-btm wow fadeInLeft animated" data-wow-delay=".5s">
    <div class="container">
        <div class="navigation">
            <nav class="navbar navbar-default">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
                    <nav class="cl-effect-1">
                        <ul class="nav navbar-nav">
                            <?php if (Session::get('privilege') != 'Admin' && Session::get('privilege') != 'Yonetici' && Session::get('privilege') != 'Muavin'): ?>
                                <li><a href="<?php echo URL; ?>index">ANASAYFA</a></li>
                            <?php endif; ?>
                            <?php if (Session::get('privilege') == 'Admin'): ?>
                                <li><a href="<?php echo URL; ?>systemUser">KULLANICILAR</a></li>
                                <li><a href="<?php echo URL; ?>report">RAPORLAR</a></li>
                            <?php endif; ?>
                            <?php if (Session::get('privilege') == 'Yonetici'): ?>
                                <li><a href="<?php echo URL; ?>systemUser">KULLANICILAR</a></li>
                                <li><a href="<?php echo URL; ?>bus">OTOBÜS</a></li>
                                <li><a href="<?php echo URL; ?>journey">SEFERLER</a></li>
                                <li><a href="<?php echo URL; ?>entryPoint">BİNİŞ NOKTASI</a></li>
                                <li><a href="<?php echo URL; ?>conductor">MUAVİN</a></li>
                            <?php endif; ?>
                            <?php if (Session::get('privilege') == 'Muavin'): ?>
                                <li><a href="<?php echo URL; ?>report">RAPORLAR</a></li>
                            <?php endif; ?>
                            <?php if (Session::get('loggedIn') == true): ?>
                                <li><a href="<?php echo URL; ?>systemUser/changePassword">ŞİFREMİ DEĞİŞTİR</a></li>
                            <?php else: ?>
                                <li><a href="<?php echo URL; ?>about/index">HAKKIMIZDA</a></li>
                            <?php endif; ?>
                            <div class="clearfix"></div>
                        </ul>
                    </nav>
                </div><!-- /.navbar-collapse -->
            </nav>
        </div>

        <div class="clearfix"></div>
    </div>
</div>
<!--- /footer-btm ---->
<!--- banner ---->
<div class="banner-1">
    <div class="container">
        <h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"> YÖNETİM BİLİŞİM SİSTEMLERİ BİTİRME PROJESİ - GÜROL İSPİROĞLU & ENES KARADAĞ</h1>
    </div>
</div>
<!--- /banner ---->