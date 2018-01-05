$(function() {

    var fm = $("#fm-login");
    var loader = $('#loader');
    var spinner = '<div class="progress"><div class="indeterminate"></div></div>';

    fm.validate({
        rules: {
            user: {
                required: true
            },
            password: {
                required: true
            }
        },
        messages: {
            user: {
                required: lang["app_login_validation_user"]
            },
            password: {
                required: lang["app_login_validation_pass"]
            }
        },
        submitHandler: function() {
            le();
        }
    });

    le = function() {
        $.ajax({
                url: fm.attr('action'),
                type: 'POST',
                data: fm.serialize(),
                beforeSend: function() {
                    preloader.on();
                    loader.empty().append(spinner);
                }
            })
            .done(function(response) {
                preloader.off();
                loader.empty();
                if (response == "d") {
                    swal({
                        title: lang['app_title_msg_success_login'],
                        text: lang['app_content_msg_error_server'],
                        type: "success",
                        showConfirmButton: false,
                    });
                    window.setTimeout(function() {
                        window.location.href = "dashboard/welcome";
                    }, 2000);
                } else if (response == "empty-store") {
                    swal("Atención!", "Su cuenta de acceso no posee clientes o tiendas asociadas.", "warning");
                } else if (response == "badpass") {
                    swal(lang['app_msg_badpass_title'], lang['app_msg_badpass_content'], "warning");
                } else if (response == "i") {
                    swal({
                        title: lang['app_msg_inac_title'],
                        text: lang['app_msg_inac_content'],
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: lang['app_msg_inac_btconfir'],
                        cancelButtonText: lang['app_msg_inac_btcancel'],
                        closeOnConfirm: false
                    }, function() {
                        swal({
                            title: lang['app_msg_actived_title'],
                            text: lang['app_msg_actived_content'],
                            type: "success"
                        });
                    });
                } else if (response == "b") {
                    swal({
                        title: lang['app_msg_block_title'],
                        text: lang['app_msg_block_content'],
                        type: "error",
                        showConfirmButton: true
                    });
                } else if (response == "error") {
                    swal(lang['app_title_msg_error_server'], lang['app_content_msg_error_server'], "error");
                } else {
                    swal({
                        title: lang['app_msg_noexist_title'],
                        text: lang['app_msg_noexist_content'],
                        type: "error",
                        html: true
                    });
                }
            })
            .fail(function() {
                swal(lang['app_title_msg_error_server'], lang['app_content_msg_error_server'], "error");
                preloader.off();
                loader.empty()
            })
            .always(function() {
                console.log("complete");
                loader.empty()
            });
    };

    $("#forgotPass").click(function(event) {
        swal({
            title: lang['app_title_forgot_password'],
            text: lang['app_content_forgot_password'],
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: lang['app_btnsuccess_forgot_password'],
            cancelButtonText: lang['app_btncancel_forgot_password'],
            animation: "slide-from-top",
            inputPlaceholder: lang['app_placeholder_forgot_password']
        }, function(inputValue) {
            if (inputValue === false) return false;
            if (inputValue === "") {
                swal.showInputError(lang['app_msg_forgot_input_empty']);
                return false
            } else {
                fp(inputValue);
            }
        });
    });

    fp = function(d) {
        $.ajax({
                url: 'login/forgotPass',
                type: 'POST',
                data: {
                    u: d
                },
                beforeSend: function() {
                    preloader.on();
                }
            })
            .done(function(response) {
                if (response) {
                    preloader.off();
                    swal(lang['app_msg_forgot_success_title'], lang['app_msg_forgot_success_content'], "success");
                } else {
                    preloader.off();
                    swal(lang['app_msg_forgot_fail_title'], lang['app_msg_forgot_fail_content'], "error");
                }
            })
            .fail(function() {})
    };


});