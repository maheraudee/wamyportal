<!doctype html>
<html lang="en" dir="rtl">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sash – Bootstrap 5  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="public/assets//images/brand/favicon.ico" />

    <!-- TITLE -->
    <title> البوابة الداخلية – الندوة العالمية للشباب الإسلامي</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="public/assets//plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="public/assets//css/style.css" rel="stylesheet" />
    <link href="public/assets//css/dark-style.css" rel="stylesheet" />
    <link href="public/assets//css/transparent-style.css" rel="stylesheet">
    <link href="public/assets//css/skin-modes.css" rel="stylesheet" />
    <link href="public/assets//css/mystyle.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="public/assets//css/icons.css" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="public/assets//colors/color1.css" />

</head>

<body class="app sidebar-mini rtl">

    <!-- BACKGROUND-IMAGE -->
    <div class="login-img">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="public/assets//images/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">
                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto mt-7">
                    <div class="text-center">
                        <img src="public/assets//images/brand/logo-white.png" class="header-brand-img" alt="">
                    </div>
                </div>
                @yield('content')
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="public/assets//js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="public/assets//plugins/bootstrap/js/popper.min.js"></script>
    <script src="public/assets//plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- SHOW PASSWORD JS -->
    <script src="public/assets//js/show-password.min.js"></script>

    <!-- GENERATE OTP JS -->
    <script src="public/assets//js/generate-otp.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="public/assets//plugins/p-scroll/perfect-scrollbar.js"></script>

    <!-- Color Theme js -->
    <script src="public/assets//js/themeColors.js"></script>

    <!-- CUSTOM JS -->
    <script src="public/assets//js/custom.js"></script>

</body>

</html>
