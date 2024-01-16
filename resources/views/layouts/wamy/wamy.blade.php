<!doctype html>
<html lang="ar" dir="rtl">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="البوابة الداخلية - الندوة العالمية للشباب الإسلامي">
    <meta name="author" content="Mohanad Abusbib">
    <meta name="keywords" content="البوابة الداخلية,الندوة العالمية للشباب الإسلامي">

    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@700&display=swap" rel="stylesheet"> --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@700&display=swap" rel="stylesheet">

    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lalezar&display=swap" rel="stylesheet"> --}}
    <!-- TITLE -->
    @yield('title')


    @include('layouts.wamy.head')

</head>

<body class="app sidebar-mini rtl">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="{{asset('public/assets/images/loader.svg')}}" class="loader-img" alt="Loader">

    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
                @include('layouts.wamy.app-Header')
            <!-- /app-Header -->
            <!--APP-SIDEBAR-->
                @include('layouts.wamy.main-sidebar')
            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">
                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">
                        @yield('content')

                    </div>
                    <!-- CONTAINER CLOSED -->
                </div>
            </div>
            <!--app-content closed-->
        </div>

        <!-- FOOTER -->
            @include('layouts.wamy.footer')
        <!-- FOOTER CLOSED -->
    </div>

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    @include('sweetalert::alert')
    @include('layouts.wamy.footer-js')


    {{-- <script>
        $('#approvalsponsor').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')

            var modal = $(this)

            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
        })
    </script> --}}


</body>

</html>
