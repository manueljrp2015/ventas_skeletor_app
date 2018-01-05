$(function() {
    var tbb = $("#table-business");
    tbb.DataTable();
    var loader5 = $('#loader5');
    var loader4 = $('#loader4');
    var loader3 = $('#loader3');
    var loader6 = $('#loader6');
    $("#_phone1, #_phone2").inputmask({});
    var spinner = '<div class="progress"><div class="indeterminate"></div></div>';
    $('.modal').modal({
        dismissible: true,
        opacity: .5,
        inDuration: 300,
        outDuration: 200,
        startingTop: '4%',
        endingTop: '10%'
    });

    var fcf = $("#fcf");
    var fmbus = $("#fbus");
    var fblock = $("#fblock");

    $("#link-new-client").click(function(event) {
        $('#tbs.tabs').tabs('select_tab', 'create');
    });

    inf = function(id) {
        preloader.on();
        $.getJSON('information-business', {
            id: id
        }, function(json, textStatus) {
            preloader.off();
            $("#modal2").modal('open');
            $("#name_business1").empty().html(json._business + " - " + json._idb);
            $("#_razon").val('').val(json._business);
            $("#_rif_hidden").val('').val(json._idb);
            $("#_rif").val('').val(json._idb);
            $("#_encargado").val('').val(json._member);
            $("#_dir").val('').val(json._direcction);
            $("#_mail").val('').val(json._mail);
            $("#_phone1").val('').val(json._phone1);
            $("#_phone2").val('').val(json._phone2);
            $("#_IDBusiness2").val('').val(json.id);
            $("#_mails").val('').val(json._mail);
        });
    };

    cfg = function(id) {
        preloader.on();
        $.getJSON('configuration-business', {
            id: id
        }, function(json, textStatus) {

            preloader.off();

            $("#modal1").modal('open');
            $("#name_business2").empty().html(json._business + " - " + json._idb);
            $("#min-buy").attr('value', json._minbuy);
            $("#vmin").empty().html(json._minbuy);
            $("#max-buy").attr('value', json._maxbuy);
            $("#vmax").empty().html(json._maxbuy);
            $("#_IDBusiness").empty().val(json.id);

            if (json._daybuy == 1) {
                $("#day1").attr('checked', 'checked');
            } else if (json._daybuy == 2) {
                $("#day2").attr('checked', 'checked');
            } else if (json._daybuy == 3) {
                $("#day3").attr('checked', 'checked');
            } else if (json._daybuy == 4) {
                $("#day4").attr('checked', 'checked');
            } else if (json._daybuy == 5) {
                $("#day5").attr('checked', 'checked');
            } else if (json._daybuy == 6) {
                $("#day6").attr('checked', 'checked');
            } else if (json._daybuy == 7) {
                $("#day7").attr('checked', 'checked');
            }
            if (json._frequency == "fija") {
                $("#frequency1").attr('checked', 'checked');
            } else if (json._frequency == "eventual") {
                $("#frequency2").attr('checked', 'checked');
            }

        });
    };

    fcf.validate({
        rules: {
            _minbuy: {
                required: true
            },
            _maxbuy: {
                required: true
            },
            group1: {
                required: true
            },
            group2: {
                required: true
            }
        },
        messages: {
            _minbuy: {
                required: lang['app_validatio_generic']
            },
            _maxbuy: {
                required: lang['app_validatio_generic']
            },
            group1: {
                required: lang['app_validatio_generic']
            },
            group2: {
                required: lang['app_validatio_generic']
            }
        },
        submitHandler: function() {
            svCfg();
        }
    });

    svCfg = function() {
        $.ajax({
                url: './register-cfg',
                type: 'POST',
                data: fcf.serialize(),
                beforeSend: function() {
                    preloader.on();
                    loader5.empty().append(spinner);
                }
            })
            .done(function() {
                loader5.empty();
                preloader.off();
                swal("Configuración Procesada", "La configuración de la razón social fue ejecutada correctamente.!", "success");
            })
            .fail(function() {
                loader5.empty();
                preloader.off();
            })
            .always(function() {
                loader5.empty();
                preloader.off();
            });

    };

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
                title: "Actualizar Cliente",
                text: "Está a punto de actualizar un cliente, está de acuerdo con este proceso.",
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
                url: "./update-business-exec",
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
                        title: "Cliente Actualizado",
                        text: "Cliente actualizado con éxito!",
                        type: "success",
                        timer: 5000
                    });

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

    block = function(id) {
        preloader.on();
        $.getJSON('information-business', {
            id: id
        }, function(json, textStatus) {
            preloader.off();

            $("#modal3").modal('open');
            $("#name_business3").empty().html(json._business + " - " + json._idb);
            $("#_IDBusiness3").empty().val(json.id);
            $("#_mails2").empty().val(json._mail);
            if (json._status_business == 'block') {
                $("#msg").val('UNBLOCK').attr('readonly', 'readonly');
            } else {
                $("#msg").val('');
            }
        });
    };

    fblock.validate({
        rules: {
            msg: {
                required: true
            }
        },
        messages: {
            msg: {
                required: "Mensaje Requerido"
            }
        },
        submitHandler: function() {
            swal({
                title: "Bloquear Cliente",
                text: "Está a punto de bloquear un cliente, está de acuerdo con este proceso.",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: lang["app_content_msg_confirm_register_btconfirm"],
                cancelButtonText: lang["app_content_msg_confirm_register_btcancel"],
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    svBlock();
                } else {
                    swal(lang["app_content_msg_cancel_register_title"], "", "warning");
                }
            });
        }
    });

    svBlock = function() {
        $.ajax({
                url: './block-business',
                type: 'POST',
                dataType: 'json',
                data: fblock.serialize(),
                beforeSend: function() {
                    preloader.on();
                    loader6.empty().append(spinner);
                }
            })
            .done(function(response) {
                loader6.empty();
                preloader.off();
                if(response.response == "block"){
                    swal({
                        title: "Cliente Bloqueado",
                        text: "El cliente ha sido bloqueado",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#26a69a",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    }, function() {
                        window.location.href = window.location.href;
                    });
                }
                else{
                    swal({
                        title: "Cliente Desbloqueado",
                        text: "El cliente ha sido desbloqueado y debe activarlo",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#26a69a",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    }, function() {
                        window.location.href = window.location.href;
                    });
                }

            })
            .fail(function() {
                loader6.empty();
                preloader.off();
                console.log("error");
            })
            .always(function() {
                loader6.empty();
                preloader.off();
                console.log("complete");
            });

    };

    ac = function(id) {
        swal({
            title: lang["app_businessadm_msg_title1"],
            text: lang["app_businessadm_msg_content1"],
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: lang["app_msg_account_pwd_b1"],
            closeOnConfirm: false
        }, function() {
            preloader.on();
            $.getJSON('activate-business', {
                id: id
            }, function(json, textStatus) {
                preloader.off();
                if (json.response == 'done') {
                    swal(lang['app_businessadm_msg_title2'], lang['app_businessadm_msg_content2'] + json.code, "success");
                    swal({
                        title: lang['app_businessadm_msg_title2'],
                        text: lang['app_businessadm_msg_content2'] + json.code,
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#26a69a",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    }, function() {
                        window.location.href = window.location.href;
                    });
                } else if (json.response == 'exist') {
                    swal(lang['app_businessadm_msg_title3'], lang['app_businessadm_msg_content3'] + json.code, "warning");
                }
            });
        });
    };
});