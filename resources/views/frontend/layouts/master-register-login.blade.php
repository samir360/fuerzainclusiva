<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="https://fuerzainclusiva.com/Views/assets/images/favicon-fuerza.png" type="image/x-icon">
    <title>.:: FUERZA INCLUSIVA ::.</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('frontend.layouts.css')
</head>

<body>
<!-- Loader -->
<div id="preloader">
    <div id="status">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>
</div>
<!-- Loader -->

<div class="back-to-home rounded d-none d-sm-block">
    <a href="https://fuerzainclusiva.com" class="text-white rounded d-inline-block text-center"><i class="mdi mdi-home"></i></a>
</div>

@yield('content')

@include('frontend.layouts.js')

<script type="text/javascript">

    function showAlert(text, option) {

        if (option == 'success') {
            toastr.success(text)
        }

        if (option == 'fail') {
            toastr.error(text)
        }
    }

    $("body").on('submit', '#frm-register', function (event) {

        event.preventDefault()
        if ($('#frm-register').valid()) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var formData = new FormData(document.getElementById("frm-register"));

            $('#loading-register').show();
            $('.btn-frm').attr('disabled', true);
            $.ajax({
                type: "POST",
                url: "{{route('save-user')}}",
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                data: formData,
                success: function (respuesta) {

                    if (respuesta.status == 'success') {

                        showAlert(respuesta.alert, respuesta.status);

                        setTimeout(function () {
                            window.location.href = respuesta.route;
                        }, 2000);

                    }
                    if (respuesta.status == 'fail') {
                        $('#loading-register').hide();

                        showAlert(respuesta.alert, respuesta.status);

                        setTimeout(function () {
                            $('.btn-frm').attr('disabled', false);
                        }, 2000);
                    }
                }
            });
        }
    });


    $("body").on('submit', '#frm-login', function (event) {

        event.preventDefault()
        if ($('#frm-login').valid()) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var formData = new FormData(document.getElementById("frm-login"));

            $('#loading-login').show();
            $('.btn-frm').attr('disabled', true);
            $.ajax({
                type: "POST",
                url: "{{route('verfify-login-user')}}",
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                data: formData,
                success: function (respuesta) {

                    if (respuesta.status == 'success') {
                        window.location.href = respuesta.route;;
                    }
                    if (respuesta.status == 'fail') {
                        $('#loading-login').hide();

                        showAlert(respuesta.alert, respuesta.status);

                        setTimeout(function () {
                            $('.btn-frm').attr('disabled', false);
                        }, 2000);
                    }
                }
            });
        }
    });
</script>

</body>
</html>