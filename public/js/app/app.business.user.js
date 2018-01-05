$(function() {
    $("#_phone1, #_phone2").inputmask({});

    var fmbus = $("#fmbus");
    var loader4 = $('#loader4');
    var spinner = '<div class="progress"><div class="indeterminate"></div></div>';

    fmbus.validate({
        rules: {
            _razon: {
                required: true
            },
            _rif: {
                required: true,
                remote: {
                    param: {
                        url: './validate-idb',
                        type: 'POST',
                        data: {
                            idb: function() {
                                return $("#_rif").val();
                            }
                        },
                        beforeSend: function() {
                            preloader.on();
                            loader4.empty().append(spinner);
                        },
                        complete: function() {
                            preloader.off();
                            loader4.empty();
                        }
                    },
                    depends: function() {
                        return $("#_rif").val() !== $("#_rif_hidden").val();
                    }
                }
            },
            _encargado: {
                required: true
            },
            _dir: {
                required: true
            },
            _mail: {
                required: true,
                email: true
            },
            _phone1: {
                required: true
            }
        },
        messages: {
            _razon: {
                required: lang['app_business_validation_razon']
            },
            _rif: {
                required: lang['app_business_validation_rif'],
                remote: lang['app_business_validation_rif_exist']
            },
            _encargado: {
                required: lang['app_business_validation_memb']
            },
            _dir: {
                required: lang['app_business_validation_dir']
            },
            _mail: {
                required: lang['app_business_validation_mail'],
                email: lang['app_register_validation_email_format']
            },
            _phone1: {
                required: lang['app_business_validation_phone1']
            }
        },
        submitHandler: function() {
            swal({
                title: lang["app_business_msg_title"],
                text: lang["app_business_msg_content"],
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: lang["app_content_msg_confirm_register_btconfirm"],
                cancelButtonText: lang["app_content_msg_confirm_register_btcancel"],
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    svEmp();
                } else {
                    swal(lang["app_content_msg_cancel_register_title"], lang["app_content_msg_cancel_register_content"], "warning");
                }
            });
        }
    });

    svEmp = function() {
        $.ajax({
                url: "./registrar-exec",
                type: 'POST',
                data: fmbus.serialize(),
                beforeSend: function() {
                    preloader.on();
                    loader3.empty().append(spinner);
                }
            })
            .done(function(response) {
                loader3.empty();
                if (response) {
                    swal({
                        title: lang["app_business_msg_title1"],
                        text: lang["app_business_msg_content1"],
                        type: "success",
                        timer: 2000
                    });



                    window.setTimeout(function() {
                       window.location.href = window.location.href;
                    }, 2500);

                } else {
                    swal(lang["app_title_msg_error_server"], lang["app_content_msg_error_server"], "warning");
                }
                preloader.off();
            })
            .fail(function() {
                preloader.off();
                loader3.empty()
            })
            .always(function() {
                preloader.off();
                loader3.empty()
            });

    };


});