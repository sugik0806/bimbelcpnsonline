<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/dist/css/mystyle.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/plugins/iCheck/square/blue.css">
    <link rel="icon" href="<?=base_url()?>assets/dist/img/b.png" type="png">
    <style>
    .login 
    {
        background-image:url(<?= base_url('assets/dist/img/lab-mac.jpg') ?>);
        /*background: rgba(77, 228, 228, 0.3)*/ /* Green background with 30% opacity */
    }
    </style>
        <script src="<?=base_url()?>assets/bower_components/sweetalert2/sweetalert2.all.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?=base_url()?>assets/bower_components/jquery/jquery-3.3.1.min.js"></script>
</head>
<body class="hold-transition login-page login">