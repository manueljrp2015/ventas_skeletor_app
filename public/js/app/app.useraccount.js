$(function() {

    var loader = $('#loader');
    var loader2 = $('#loader2');
    var loader3 = $('#loader3');
    var loader4 = $('#loader4');
    var loader5 = $('#loader5');
    var loader6 = $('#loader6');
    var spinner = '<div class="progress"><div class="indeterminate"></div></div>';


    $("#_phone").inputmask();


    selectCountry = function(c) {
        $("#_countryid").val(c);
    };

    selectIdentity = function(i) {
        $("#_typeid").val(i);
    };

    var fu = $("#fu");

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
            }
        },
        submitHandler: function() {
            sevData();
        }
    });

    sevData = function() {
        $.ajax({
                url: 'myaccount/store-data',
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
                    text: lang['app_msg_userinfo_content'],
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#26a69a",
                    confirmButtonText: "Ok",
                    closeOnConfirm: false
                }, function() {
                    window.location.href = window.location.href;
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

    var fus = $("#fus");

    fus.validate({
        rules: {
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
            }
        },
        messages: {
            _username: {
                required: lang["app_register_validation_user"],
                remote: lang["app_register_validation_user_exist"]
            }
        },
        submitHandler: function() {

            swal({
                title: lang["app_msg_account_nick_title"],
                text: lang["app_msg_account_nick_content"],
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: lang["app_msg_account_nick_b1"],
                closeOnConfirm: false
            }, function() {
                sevUs();

            });

        }
    });

    sevUs = function() {
        $.ajax({
                url: 'change-user',
                type: 'POST',
                data: fus.serialize(),
                beforeSend: function() {
                    preloader.on();
                    loader3.empty().append(spinner);
                }
            })
            .done(function() {
                preloader.off();
                loader3.empty();
                swal({
                    title: lang['app_msg_userinfo_title'],
                    text: lang['app_msg_userinfo_content'],
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#26a69a",
                    confirmButtonText: "Ok",
                    closeOnConfirm: false
                }, function() {
                    window.location.href = window.location.href;
                });

            })
            .fail(function() {
                preloader.off();
                loader3.empty();
            })
            .always(function() {
                preloader.off();
                loader3.empty();
            });

    };


    var fpw = $("#fpw");

    fpw.validate({
        rules: {
            _pwd: {
                required: true
            },
            _pwd_new: {
                required: true,
                minlength: 8
            },
            _pwd_rpt: {
                required: true,
                equalTo: "#_pwd_new"
            }
        },
        messages: {
            _pwd: {
                required: lang['app_msg_account_pwd_validate1']
            },
            _pwd_new: {
                required: lang['app_msg_account_pwd_validate2'],
                minlength: lang['app_msg_account_pwd_validate3']
            },
            _pwd_rpt: {
                required: lang['app_msg_account_pwd_validate2'],
                equalTo: lang['app_msg_account_pwd_validate4']
            }
        },
        submitHandler: function() {

            swal({
                title: lang["app_msg_account_pwd_title"],
                text: lang["app_msg_account_pwd_content"],
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: lang["app_msg_account_pwd_b1"],
                closeOnConfirm: false
            }, function() {
                svPass();

            });


        }
    });


    svPass = function() {
        $.ajax({
                url: 'change-key',
                type: 'POST',
                data: fpw.serialize(),
                beforeSend: function() {
                    preloader.on();
                    loader4.empty().append(spinner);
                }
            })
            .done(function() {
                preloader.off();
                loader4.empty();
                swal({
                    title: lang['app_msg_account_pwd_title2'],
                    text: lang['app_msg_account_pwd_content2'],
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#26a69a",
                    confirmButtonText: "Ok",
                    closeOnConfirm: false
                }, function() {
                    window.location.href = window.location.href;
                });
            })
            .fail(function() {
                preloader.off();
                loader4.empty();
                console.log("error");
            })
            .always(function() {
                preloader.off();
                loader4.empty();
                console.log("complete");
            });

    };

    var femp = $("#femp");

    femp.validate({
        rules: {
            email_active: {
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
                        return $("#email_active").val() !== $("#email_active_hidden").val();
                    }
                }
            }
        },
        messages: {
            email_active: {
                required: lang['app_register_validation_email'],
                remote: lang['app_register_validation_email_exist'],
                email: lang['app_register_validation_email_exist']
            }
        },
        submitHandler: function() {

            if ($("#email_active").val() !== $("#email_active_hidden").val()) {

                swal({
                    title: lang["app_msg_account_email_title2"],
                    text: lang["app_msg_account_email_content2"],
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: lang["app_msg_account_pwd_b1"],
                    closeOnConfirm: false
                }, function() {
                    svEmail();
                });

            } else {
                swal(lang['app_msg_account_email_title1'], lang['app_msg_account_email_content1'], "info");
            }

        }
    });

    svEmail = function() {
        $.ajax({
                url: 'change-mail',
                type: 'POST',
                data: femp.serialize(),
                beforeSend: function() {
                    preloader.on();
                    loader.empty().append(spinner);
                }
            })
            .done(function() {

                preloader.off();
                loader.empty();

                swal({
                    title: lang['app_msg_account_email_title3'],
                    text: lang['app_msg_account_email_content3'],
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#26a69a",
                    confirmButtonText: "Ok",
                    closeOnConfirm: false
                }, function() {
                    window.location.href = window.location.href;
                });

                console.log("success");
            })
            .fail(function() {
                loader.empty();
                console.log("error");
            })
            .always(function() {
                loader.empty();
                console.log("complete");
            });

    };


    var fema = $("#fema");


    fema.validate({
        rules: {
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
                            preloader.off();
                            loader2.empty();
                        }
                    },
                    depends: function() {
                        return $("#email_other").val() !== $("#email_other_hidden").val();
                    }
                }
            }
        },
        messages: {
            email_other: {
                required: lang['app_register_validation_email'],
                remote: lang['app_register_validation_email_exist'],
                email: lang['app_register_validation_email_exist']
            }
        },
        submitHandler: function() {

            if ($("#email_other").val() !== $("#email_other_hidden").val()) {

                swal({
                    title: lang["app_msg_account_email_title4"],
                    text: lang["app_msg_account_email_content4"],
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: lang["app_msg_account_pwd_b1"],
                    closeOnConfirm: false
                }, function() {
                    svEmailRecovery();
                });

            } else {
                swal(lang['app_msg_account_email_title1'], lang['app_msg_account_email_content1'], "info");
            }

        }
    });

    svEmailRecovery = function() {
        $.ajax({
                url: 'change-mail-recovery',
                type: 'POST',
                data: fema.serialize(),
                beforeSend: function() {
                    preloader.on();
                    loader2.empty().append(spinner);
                }
            })
            .done(function() {
                preloader.off();
                loader2.empty();

                swal({
                    title: lang['app_msg_account_email_title3'],
                    text: lang['app_msg_account_email_content3'],
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#26a69a",
                    confirmButtonText: "Ok",
                    closeOnConfirm: false
                }, function() {
                    window.location.href = window.location.href;
                });

                console.log("success");
            })
            .fail(function() {
                loader2.empty();
                console.log("error");
            })
            .always(function() {
                loader2.empty();
                console.log("complete");
            });

    };


    $("#gnp").click(function() {
        preloader.on();
        loader4.empty().append(spinner);
        $.getJSON('generate-key', function(json, textStatus) {
            $("#_pwd_new").attr("type", "text").val(json.key);
            $("#_pwd_rpt").attr("type", "text").val(json.key);
            preloader.off();
            loader4.empty();
        });
    });

    $(".option1, .option6").attr('disabled', 'disabled');
    openFile = function(event) {

        $("#preview").cropper('destroy');
        $(".option1, .option6").attr('disabled', 'disabled');

        var input = event.target;
        var output = document.getElementById('preview');
        var accept = ['image/jpeg', 'image/gif', 'image/png', 'image/jpg'];

        if (parseFloat(input.files[0].size / 1024) > 2048) {
            swal({
                title: lang["app_msg_account_avatar_title1"],
                text: lang["app_msg_account_avatar_content1"],
                type: "error",
                showConfirmButton: true,
            });

            return false;
        } else if (accept.indexOf(input.files[0].type) < 0) {
            swal({
                title: lang["app_msg_account_avatar_title2"],
                text: lang["app_msg_account_avatar_title2"],
                type: "error",
                showConfirmButton: true,
            });

            return false;
        } else {
            var reader = new FileReader();

            reader.onload = function() {
                var dataURL = reader.result;
                output.src = dataURL;
            };
            reader.readAsDataURL(input.files[0]);

            $(".option1").removeAttr('disabled');

            window.setTimeout(function() {
                cropActivate();
            }, 600);
        }


    };

    $("#edit_image").click(function(event) {
        cropActivate();
    });

    cropActivate = function() {
        $(".option6").removeAttr('disabled');
        $("#preview").cropper({
            aspectRatio: 16 / 16,
            autoCropArea: 0.65,
            autoCrop: true,
            strict: true,
            responsive: true,
            guides: true,
            highlight: true,
            dragCrop: true,
            cropBoxMovable: true,
            cropBoxResizable: true,
            preview: ".img-preview",
            checkImageOrigin: true,
            minContainerWidth: 350,
            minContainerHeight: 350,
            minCanvasWidth: 350,
            minCanvasHeight: 350,
            minCropBoxWidth: 100,
            minCropBoxHeight: 100
        });
    };

    $('.scale-pic-in').click(function() {
        $('#preview').cropper('zoom', 0.1);
    });

    $('.scale-pic-out').click(function() {
        $('#preview').cropper('zoom', -0.1);
    });

    $('.rotate-degree-right').click(function() {
        $('#preview').cropper('rotate', 90);
    });

    $('.rotate-degree-left').click(function() {
        $('#preview').cropper('rotate', -90);
    });

    var process = $("#process");

    $("#upload").click(function(event) {
        $('#preview').cropper('getCroppedCanvas').toBlob(function(blob) {

            var formData = new FormData();
            formData.append('croppedImage', blob);

            $.ajax({
                    url: 'upload-avatar',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        preloader.on();
                        
                    },
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                               $('#porcent').empty().html(Math.round(percentComplete * 100) + "%");
                               process.attr("style", "width:" + Math.round(percentComplete * 100) + "%");
                            }
                            
                        }, false);
                        return xhr;
                    }
                })
                .done(function() {
                    preloader.off();
                    loader6.empty();

                    swal({
                        title: lang['app_msg_account_avatar_title3'],
                        text: lang['app_msg_account_avatar_content3'],
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#26a69a",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    }, function() {
                        window.location.href = window.location.href;
                    });
                })
                .fail(function() {
                    console.log("error");
                    preloader.off();
                    loader6.empty();
                })
                .always(function() {
                    console.log("complete");
                    preloader.off();
                    loader6.empty();
                });
        });
    });
});