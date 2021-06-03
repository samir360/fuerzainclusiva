<script type="application/javascript">

    $("#change_password").change(function () {

        var value = $('#change_password').val();

        if (value == 'SI') {
            $('.new_password').show();
        }

        if (value == 'NO') {
            $('.new_password').hide();
            $('#new_password').val('');
        }
    });

    $("body").on('submit', '#frm-employer-profile', function (event) {

        event.preventDefault()
        if ($('#frm-employer-profile').valid()) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var formData = new FormData(document.getElementById("frm-employer-profile"));
            $('#loading').show();
            $('.btn-frm').attr('disabled', true);

            $.ajax({
                type: "POST",
                url: "{{ route('update-employer-profile') }}",
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
                            if (respuesta.edit) {
                                window.location.href = "{{route('company-list')}}";
                            } else {
                                location.reload();
                            }
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