<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">



    <!-- Latest compiled and minified CSS FOR SELECT-->
    <link href="{{ asset('assets/vendor/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Calendar -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap-4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/calendar/css/datepicker.min.css') }}" rel="stylesheet">
    {{-- <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" /> --}}

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">



    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/alertify/css/default.min.css') }}" />


</head>

<body>

    @include('layout.header')

    @include('layout.sidebar')

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                @yield('content')
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    {{-- <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script> --}}
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script> --}}
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script> --}}

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/popper/popper.min.js') }}"></script>

    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script> --}}

    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Select input -->
    <script src="{{ asset('assets/vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>


    <!-- Calendar -->
    {{-- <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script> --}}
    <script src="{{ asset('assets/vendor/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/calendar/js/datetimepicker.min.js') }}"></script>

    <!-- JavaScript -->
    <script src="{{ asset('assets/vendor/alertify/js/alertify.min.js') }}"></script>

    <script>
        // SELECT DROPDOWN
        $(function() {
            $('.selectpicker').selectpicker();
        });

        // DATEPICKER
        // $('#datepicker').datepicker({
        //     uiLibrary: 'bootstrap4'
        // });


        // $('#datetimepicker').datetimepicker({
        //     format: 'YYYY-MM-DD HH:mm:ss'

        // });

        $('#datepicker').datetimepicker({
            format: 'MM/DD/YYYY',
            icons: {
                up: 'fa fa-angle-up',
                down: 'fa fa-angle-down'
            },
        });

        // $('.date').datetimepicker({
        //     format: 'YYYY-MM-DD'
        // });





        alertify.set('notifier', 'position', 'top-right');

        $('.delete-btn').click(function() {
            const [action, row_id] = $(this).attr('id').split('_')
            console.log(row_id)
            $("#record-id").val(row_id);
            $("#deleteModalForm").attr('action', '/' + action);
        })
    </script>

    @if (Session::has('message'))
        <script>
            var msg = '{{ Session::get('message') }}';
            var status = '{{ Session::get('status') }}';

            if (msg) {
                if (status == 'error') {
                    alertify.error(msg);
                } else {
                    alertify.success(msg);
                }

            }
        </script>
    @endif
    @yield('scripts')
</body>

</html>
