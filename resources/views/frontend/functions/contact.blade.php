<script type="application/javascript">

    $("body").on('submit', '#contact-form', function (event) {

        event.preventDefault()

        if ($('#contact-form').valid()) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var formData = new FormData(document.getElementById("contact-form"));

            $('#loading').show();
            $('.btn-frm').attr('disabled', true);


            $.ajax({
                type: "POST",
                url: "{{ route('save-contact') }}",
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                data: formData,
                success: function (respuesta) {

                    if (respuesta.status == 'success') {
                        $('#loading').hide();
                        showAlert(respuesta.alert, respuesta.status);
                        setTimeout(function () {
                                location.reload();
                        }, 2000);
                    }
                    if (respuesta.status == 'fail') {
                        $('#loading').hide();
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