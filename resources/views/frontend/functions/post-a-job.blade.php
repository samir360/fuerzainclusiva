<script type="application/javascript">
    $(document).ready(function () {
        $('.select-multiple').select2();
    });


    $("body").on('submit', '#frm-job', function (event) {

        event.preventDefault()
        if ($('#frm-job').valid()) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var formData = new FormData(document.getElementById("frm-job"));
            var route = $('#route').val();
            $('#loading').show();
            $('.btn-frm').attr('disabled', true);

            if(route=='store'){
                var routeController="{{ route('save-job') }}";
            }else{
                var routeController="{{ route('edit-job') }}";
            }

            $.ajax({
                type: "POST",
                url: routeController,
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
                                window.location.href = "{{route('my-posts')}}";
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