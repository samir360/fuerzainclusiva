<script type="application/javascript">

    $(document).ready(function () {
        $('.select-multiple').select2();

        //EL CALENDARIO
        $(".fecha").datepicker({
            changeYear: true,
            endDate: new Date('2004'),
            format: "yyyy-mm-dd",
            language: "es",
            changeMonth: true,
            autoclose: true,
        });

        //Lista de instituciones del usuario
        institutionLists();

        experienceLists();

        referenceLists();
    });

    $("#change_password").change(function () {

        var value = $('#change_password').val();

        if (value == 'SI') {
            $('.edit_password').removeClass('col-md-4');
            $('.edit_password').addClass('col-md-3');
            $('.new_password').show();
        }

        if (value == 'NO') {
            $('.edit_password').removeClass('col-md-3');
            $('.edit_password').addClass('col-md-4');
            $('.new_password').hide();
            $('#new_password').val('');
        }
    });


    function institutionLists() {
        $('#institution-list').load("{{route('ajax-institution-lists')}}");
    }

    function experienceLists() {
        $('#experience-list').load("{{route('ajax-experience-lists')}}");
    }

    function referenceLists() {
        $('#reference-list').load("{{route('ajax-reference-lists')}}");
    }


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


    $("#photo").change(function () {
        $('#placeholder').hide();
        filePreview(this);
    });


    $("body").on('submit', '#frm-user-profile', function (event) {

        event.preventDefault()

        var checkInput = $('.required').val();

        if (!checkInput) {
            $('#error-frm').show();
        }

        if ($('#frm-user-profile').valid()) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var formData = new FormData(document.getElementById("frm-user-profile"));
            var route = $('#route').val();
            $('#loading').show();
            $('.btn-frm').attr('disabled', true);
            $('#error-frm').hide();

            if (route == 'store') {
                var routeController = "{{ route('save-candidate-profile') }}";
            } else {
                var routeController = "{{ route('update-candidate-profile') }}";
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


    $(".btn-intitution").click(function () {
        var input_institution = $('.input-institution').val();
        if (!input_institution) {
            $('#error-frm-institution').show();
            return false;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var routeController = "{{ route('save-institution-profile') }}";

        $('#error-frm-institution').hide();
        $('#loading-institution').show();

        $.ajax({
            type: "POST",
            url: routeController,
            cache: false,
            dataType: 'json',
            data: {'institution_name': $('#institution_name').val(), 'obtained_title': $('#obtained_title').val()},
            success: function (respuesta) {

                if (respuesta.status == 'success') {
                    $('#loading-institution').hide();
                    showAlert(respuesta.alert, respuesta.status);
                    $('.input-institution').val('');
                    institutionLists();
                }

                if (respuesta.status == 'fail') {
                    $('#loading-institution').hide();
                    showAlert(respuesta.alert, respuesta.status);
                }
            }
        });

    });


    function deleteInstituttion(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post('{{ route("delete-institution") }}', {id: id}, function () {
            institutionLists();
        });
    }


    $(".btn-experience").click(function () {
        var input_experience = $('.input-experience').val();
        if (!input_experience) {
            $('#error-frm-experience').show();
            return false;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var routeController = "{{ route('save-experience-profile') }}";

        $('#error-frm-experience').hide();
        $('#loading-experience').show();

        $.ajax({
            type: "POST",
            url: routeController,
            cache: false,
            dataType: 'json',
            data: {
                'company_name': $('#company_name').val(),
                'company_functions': $('#company_functions').val(),
                'industry_id': $('#industry_id').val(),
                'number_of_years': $('#number_of_years').val()
            },
            success: function (respuesta) {

                if (respuesta.status == 'success') {
                    $('#loading-experience').hide();
                    showAlert(respuesta.alert, respuesta.status);
                    $('.input-experience').val('');
                    experienceLists();
                }

                if (respuesta.status == 'fail') {
                    $('#loading-experience').hide();
                    showAlert(respuesta.alert, respuesta.status);
                }
            }
        });

    });


    function deleteExperience(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post('{{ route("delete-experience") }}', {id: id}, function () {
            experienceLists();
        });
    }


    $(".btn-reference").click(function () {
        var input_reference = $('.input-reference').val();
        if (!input_reference) {
            $('#error-frm-reference').show();
            return false;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var routeController = "{{ route('save-reference-profile') }}";

        $('#error-frm-reference').hide();
        $('#loading-reference').show();

        $.ajax({
            type: "POST",
            url: routeController,
            cache: false,
            dataType: 'json',
            data: {
                'full_name': $('#full_name').val(),
                'charge': $('#charge').val(),
                'reference_phone': $('#reference_phone').val(),
                'reference_email': $('#reference_email').val()
            },
            success: function (respuesta) {

                if (respuesta.status == 'success') {
                    $('#loading-reference').hide();
                    showAlert(respuesta.alert, respuesta.status);
                    $('.input-reference').val('');
                    referenceLists();
                }

                if (respuesta.status == 'fail') {
                    $('#loading-reference').hide();
                    showAlert(respuesta.alert, respuesta.status);
                }
            }
        });

    });


    function deleteReference(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post('{{ route("delete-reference") }}', {id: id}, function () {
            referenceLists();
        });
    }

</script>