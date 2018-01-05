$(function() {
    var tbu = $("#table-user");
    tbu.DataTable();
    $(".modal").modal();
    $('.modal').modal({
        dismissible: true,
        opacity: .5,
        inDuration: 300,
        outDuration: 200,
        startingTop: '4%',
        endingTop: '10%'
    });
    var loader = $('#loader');
    var loader1 = $('#loader1');
    var loader2 = $('#loader2');
    var loader3 = $('#loader3');
    var loader4 = $('#loader4');
    var loader5 = $('#loader5');
    var loader6 = $('#loader6');
    var spinner = '<div class="progress"><div class="indeterminate"></div></div>';

    $('#typeAccount').select2({
        placeholder: 'Tipo de Cuenta'
    });
    $('#_store').select2({
        placeholder: 'Clientes'
    });

    $("#link-new-user").click(function(event) {
        $('#tbs.tabs').tabs('select_tab', 'create');
    });

    var fu = $("#fus");
    fu.validate({
        rules: {
            _first_name: {
                required: true
            },
            _last_name: {
                required: true
            },
            _typeid: {
                required: true
            },
            _username: {
                required: true,
                remote: {
                    param: {
                        url: './validate-user',
                        type: 'POST',
                        data: {
                            username: function() {
                                return $("#_username").val();
                            }
                        },
                        beforeSend: function() {
                            preloader.on();
                            loader3.empty().append(spinner);
                        },
                        complete: function() {
                            preloader.off();
                            loader3.empty();
                        }
                    },
                    depends: function() {
                        return $("#_username").val() !== $("#_username_hidden").val();
                    }
                }
            },
            _mail: {
                required: true,
                email: true,
                remote: {
                    param: {
                        url: './validate-mail',
                        type: 'POST',
                        data: {
                            email: function() {
                                return $("#email_active").val();
                            }
                        },
                        beforeSend: function() {
                            preloader.on();
                            loader.empty().append(spinner);
                        },
                        complete: function() {
                            loader.empty();
                            preloader.off();
                        }
                    },
                    depends: function() {
                        return $("#_mail").val() !== $("#email_active_hidden").val();
                    }
                }
            },
            email_other: {
                required: true,
                email: true,
                remote: {
                    param: {
                        url: './validate-mail-recovery',
                        type: 'POST',
                        data: {
                            email_other: function() {
                                return $("#email_other").val();
                            }
                        },
                        beforeSend: function() {
                            preloader.on();
                            loader2.empty().append(spinner);
                        },
                        complete: function() {
                            loader2.empty();
                            preloader.off();
                        }
                    },
                    depends: function() {
                        return $("#email_other").val() !== $("#email_active_hidden").val();
                    }
                }
            },
            _idn: {
                required: true
            },
            _birthday: {
                required: true
            },
            _countryid: {
                required: true
            },
            _phone: {
                required: true
            },
            _website: {
                url: true
            },
            _facebook: {
                url: true
            }
        },
        messages: {
            _username: {
                required: lang["app_register_validation_user"],
                remote: lang["app_register_validation_user_exist"]
            },
            _mail: {
                required: lang['app_register_validation_email'],
                remote: lang['app_register_validation_email_exist'],
                email: lang['app_register_validation_email_exist']
            },
            email_other: {
                required: lang['app_register_validation_email'],
                remote: lang['app_register_validation_email_exist'],
                email: lang['app_register_validation_email_exist']
            },
            _first_name: {
                required: lang["app_user_validation_firtsname"]
            },
            _last_name: {
                required: lang["app_user_validation_lastname"]
            },
            _typeid: {
                required: lang["app_user_validation_typeid"]
            },
            _idn: {
                required: lang["app_user_validation_idn"]
            },
            _birthday: {
                required: lang["app_user_validation_brithday"]
            },
            _countryid: {
                required: lang["app_user_validation_country"]
            },
            _phone: {
                required: lang["app_user_validation_phone"]
            },
            _website: {
                url: lang["app_user_validation_url"]
            },
            _facebook: {
                url: lang["app_user_validation_url"]
            },
            required: lang['app_register_validation_email'],
            remote: lang['app_register_validation_email_exist'],
            email: lang['app_register_validation_email_exist']
        },
        submitHandler: function() {
            sevData();
        }
    });
    sevData = function() {
        $.ajax({
                url: './store-data',
                type: 'POST',
                data: fu.serialize(),
                beforeSend: function() {
                    preloader.on();
                    loader5.empty().append(spinner);
                }
            })
            .done(function() {
                preloader.off();
                loader5.empty();
                swal({
                    title: lang['app_msg_userinfo_title'],
                    text: lang['app_msg_userinfo_content_adm'],
                    type: "success",
                    timer: 2000,
                    showConfirmButton: false
                });
            })
            .fail(function() {
                preloader.off();
                loader5.empty();
                swal(lang['app_title_msg_error_server'], lang['app_content_msg_error_server'], "error");
            })
            .always(function() {
                preloader.off();
                loader5.empty();
                console.log("complete");
            });
    };
    gi = function(i) {
        preloader.on();
        $.getJSON('information-user-a', {
            id: i
        }, function(json, textStatus) {
            preloader.off();
            $("#modal1").modal('open');
            $('#idu').val('').val(json.id);
            $('#_typeid').val('').val(json._typeid);
            $('#_countryid').val('').val(json._country);
            $('#_first_name').val('').val(json._firts_name);
            $('#_last_name').val('').val(json._last_name);
            $('#_mail').val('').val(json._mail);
            $('#email_other').val('').val(json._mail_recovery);
            $('#email_active_hidden').val('').val(json._mail);
            $('#email_other_hidden').val('').val(json._mail_recovery);
            $('#_username_hidden').val('').val(json._nickname);
            $('#_username').val('').val(json._nickname);
            $('#_idn').val('').val(json._identity);
            $('#_birthday').val('').val(json._birthday);
            $('#_phone').val('').val(json._phone);
            $('#_website').val('').val(json._website);
            var serial = unserialize(json._social);
            $('#_instagram').val('').val(serial['_instagram']);
            $('#_twitter').val('').val(serial['_twitter']);
            $('#_facebook').val('').val(serial['_facebook']);
            $('#_linkedin').val('').val(serial['_linkedin']);
            $('#_youtube').val('').val(serial['_youtube']);
            $('#_vimeo').val('').val(serial['_vimeo']);
        });
    };

    rp = function(id) {
        swal({
            title: lang["app_msg_account_pwd_title"],
            text: lang["app_msg_account_pwd_content"],
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: lang["app_msg_account_pwd_b1"],
            closeOnConfirm: false
        }, function() {
            preloader.on();
            $.getJSON('change-keya', {
                id: id
            }, function(json, textStatus) {
                preloader.off();
                swal(lang['app_msg_forgot_success_title'], lang['app_msg_forgot_success_content_adm'], "success");
            });

        });
    };
    bcku = function(id) {


        swal({
            title: lang["app_msg_useradm_title1"],
            text: lang["app_msg_useradm_content1"],
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: lang["app_msg_account_pwd_b1"],
            closeOnConfirm: false
        }, function() {
            preloader.on();
            $.getJSON('./block-u', {
                id: id
            }, function(json, textStatus) {
                preloader.off();
                if (json.response == 'block') {
                    swal(lang['app_msg_useradm_title2'], lang['app_msg_useradm_content2'], "success");
                } else {
                    swal(lang['app_msg_useradm_title2'], lang['app_msg_useradm_content2'], "success");
                }
            });

        });

    };

    $("#_stores").select2({
        placeholder: 'Clientes',
        tokenSeparators: [',']
    });


    storeAsig = function(id) {

        $("#modal2").modal("open");
        $("#_hidden_user").val("").val(id);
        $("#tb-resutl").empty();

        $.getJSON('get-store-from-user', {
                id: id
            }, function(json, textStatus) {
                preloader.off();
                if (json.msg == 'empty') {
                    $("#tb-resutl").empty();
                    $("#_stores").select2('val', "");

                } else if (json.msg == 'all') {
                    $("#tb-resutl").empty();
                    $("#_stores").select2('val', "9999999");
                } else {

                    $("#_stores").select2('val', json.data.split(','));

                    tb = "";
                    tb += '<table id="table-products" class="display responsive-table datatable-example">' +
                        '<thead>' +
                        '<tr>' +
                        '<th>Cod/Cliente</th>' +
                        '<th>Cliente</th>' +
                        '<th>RUT</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody>';

                    $.each(json.result, function(index, val) {
                    tb += '<tr>' +
                        '<td align="center">' + val.id + '</td>' +
                        '<td align="right">' + val._store + '</td>' +
                        '<td>' + val._idn + '</td>' +
                        '</tr>';
                    });

                tb += '</tbody></table>';

                $("#tb-resutl").empty().append(tb);
                $("#table-products").DataTable({
                    "order": [
                        [0, "desc"]
                    ]
                });
            }
        });
};

$("#fastore").validate({
    ignore: [],
    rules: {
        '_stores[]': {
            required: true
        }
    },
    message: {
        '_stores[]': {
            required: "Campo Requerido"
        }
    },
    submitHandler: function() {
        swal({
            title: lang["app_msg_useradm_title1"],
            text: lang["app_msg_useradm_content1"],
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: lang["app_msg_account_pwd_b1"],
            closeOnConfirm: false
        }, function() {
            asigExec();
        });
    }
});


asigExec = function() {
    $.ajax({
            url: 'asigned-store-for-user',
            type: 'POST',
            dataType: 'json',
            data: $("#fastore").serialize(),
            beforeSend: function() {
                preloader.on();
            }
        })
        .done(function(response) {
            preloader.off();
            if (response == true) {
                $("#modal2").modal("close");
                swal(lang['app_msg_useradm_title2'], lang['app_msg_useradm_content2'], "success");
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });

};

var fusadm = $("#fusadm");

$.validator.addMethod('postalCode', function(value) {
    return /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value);
}, lang['app_register_validation_email_format']);

fusadm.validate({
    ignore: [],
    rules: {
        user: {
            required: true,
            remote: {
                url: 'validate-user',
                type: 'POST',
                data: {
                    username: function() {
                        return $("#user").val();
                    }
                },
                beforeSend: function() {
                    preloader.on();
                    loader1.empty().append(spinner);
                },
                complete: function() {
                    preloader.off();
                    loader1.empty();
                }
            }
        },
        email: {
            required: true,
            email: true,
            postalCode: true,
            remote: {
                url: 'validate-mail',
                type: 'POST',
                data: {
                    email: function() {
                        return $("#email").val();
                    }
                },
                beforeSend: function() {
                    preloader.on();
                    loader2.empty().append(spinner);
                },
                complete: function() {
                    preloader.off();
                    loader2.empty();
                }
            }
        },
        password: {
            required: true,
            minlength: 8
        },
        rpassword: {
            required: true,
            equalTo: "#password"
        },
        typeAccount: {
            required: true
        },
        country: {
            required: true
        }
    },
    messages: {
        user: {
            required: lang['app_register_validation_user'],
            remote: lang['app_register_validation_user_exist']
        },
        email: {
            required: lang['app_register_validation_email'],
            email: lang['app_register_validation_email_format'],
            remote: lang['app_register_validation_email_exist']
        },
        password: {
            required: lang['app_register_validation_pass'],
            minlength: lang['app_register_validation_rpass_min']
        },
        rpassword: {
            required: lang['app_register_validation_rpass'],
            equalTo: lang['app_register_validation_rpass_confirm']
        },
        typeAccount: {
            required: lang['app_register_validation_tpaccount']
        },
        country: {
            required: lang['app_register_validation_country']
        }
    },
    submitHandler: function() {


        swal({
            title: lang["app_content_msg_confirm_register_title"],
            text: lang["app_content_msg_confirm_register_content"],
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: lang["app_content_msg_confirm_register_btconfirm"],
            cancelButtonText: lang["app_content_msg_confirm_register_btcancel"],
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                svReg();
            } else {
                swal(lang["app_content_msg_cancel_register_title"], lang["app_content_msg_cancel_register_content"], "warning");
            }
        });

    }
});

svReg = function() {
    $.ajax({
            url: fusadm.attr('action'),
            type: 'POST',
            data: fusadm.serialize(),
            beforeSend: function() {
                preloader.on();
                loader3.empty().append(spinner);
            }
        })
        .done(function(response) {
            loader3.empty();
            if (response) {
                swal({
                    title: lang["app_content_msg_process_register_title"],
                    text: lang["app_content_msg_process_register_content"],
                    type: "success",
                    timer: 2000
                });

                document.getElementById('fusadm').reset();

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