<script type="application/javascript">

    function filePreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#uploadForm + img').remove();
                $('#uploadForm').after('<img src="' + e.target.result + '" width="150" height="150"  style="border-radius: 90px!important; margin:auto;' +
                    '"/>');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }


    $("#logo_company").change(function () {
        $('#placeholder').hide();
        filePreview(this);
    });

    $("body").on('submit', '#frm-company-profile', function (event) {

        event.preventDefault()
        if ($('#frm-company-profile').valid()) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var formData = new FormData(document.getElementById("frm-company-profile"));
            var route = $('#route').val();
            $('#loading').show();
            $('.btn-frm').attr('disabled', true);

            if (route == 'store') {
                var routeController = "{{ route('save-company-profile') }}";
            } else {
                var routeController = "{{ route('update-company-profile') }}";
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