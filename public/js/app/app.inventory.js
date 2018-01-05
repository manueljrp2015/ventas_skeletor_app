$(function() {
    var loader3 = $('#loader3');
    var loader9 = $('#loader9');
    var spinner = '<div class="progress"><div class="indeterminate"></div></div>';
    var tbb = $("#table-warehouse");
    tbb.DataTable();

    $('.modal').modal({
        dismissible: true,
        opacity: .5,
        inDuration: 300,
        outDuration: 200,
        startingTop: '4%',
        endingTop: '10%'
    });

    var fware = $("#fware");
    var fware_edit = $("#fware_edit");
    $('#_IDTypew2').select2({
    	placeholder: 'Seleccione una opción'
    });

    w = function(i) {
    	preloader.on();
        $.getJSON('./get-warehouse-id', {
            id: i
        }, function(json, textStatus) {
        	preloader.off();
            $("#modal3").modal('open');
            $("#_warehouse2").val('').val(json._warehouse);
            $("#_IDTypew2").val(json._IDTypew).trigger('change');
            $("#_management2").val('').val(json._managment);
        });
    };

    fware.validate({
        ignore: [],
        rules: {
            _warehouse: {
                required: true
            },
            _management: {
                required: true
            },
            _IDTypew: {
                required: true
            }
        },
        messages: {
            _warehouse: {
                required: "Campo Requerido"
            },
            _management: {
                required: "Campo Requerido"
            },
            _IDTypew: {
                required: "Campo Requerido"
            }
        },
        submitHandler: function() {
            swal({
                title: "Crear Almacen",
                text: "Está a punto de crear un nuevo almacén.",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: lang["app_content_msg_confirm_register_btconfirm"],
                cancelButtonText: lang["app_content_msg_confirm_register_btcancel"],
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    svW();
                } else {
                    swal(lang["app_content_msg_cancel_register_title"], "", "warning");
                }
            });
        }
    });

    svW = function() {
        $.ajax({
                url: './store-warehouse',
                type: 'POST',
                data: fware.serialize(),
                beforeSend: function() {
                    preloader.on();
                    loader3.empty().append(spinner);
                }
            })
            .done(function() {
                loader3.empty();
                preloader.off();

                swal({
                    title: "Operación Exitosa",
                    text: "El almacen ha sido creado con éxito.!",
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
                loader3.empty();
                preloader.off();
                console.log("error");
            })
            .always(function() {
                loader3.empty();
                preloader.off();
                console.log("complete");
            });

    };

    fware_edit.validate({
        ignore: [],
        rules: {
            _warehouse2: {
                required: true
            },
            _management2: {
                required: true
            },
            _IDTypew2: {
                required: true
            }
        },
        messages: {
            _warehouse2: {
                required: "Campo Requerido"
            },
            _management2: {
                required: "Campo Requerido"
            },
            _IDTypew2: {
                required: "Campo Requerido"
            }
        },
        submitHandler: function() {
            swal({
                title: "Actualizar Almacen",
                text: "Está a punto de actualizar un almacén.",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: lang["app_content_msg_confirm_register_btconfirm"],
                cancelButtonText: lang["app_content_msg_confirm_register_btcancel"],
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    upW();
                } else {
                    swal(lang["app_content_msg_cancel_register_title"], "", "warning");
                }
            });
        }
    });

    upW = function() {
        $.ajax({
                url: './update-warehouse',
                type: 'POST',
                data: fware_edit.serialize(),
                beforeSend: function() {
                    preloader.on();
                    loader9.empty().append(spinner);
                }
            })
            .done(function() {
                loader3.empty();
                loader9.off();

                swal({
                    title: "Operación Exitosa",
                    text: "El almacen ha sido actualizado con éxito.!",
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
                loader9.empty();
                preloader.off();
                console.log("error");
            })
            .always(function() {
                loader9.empty();
                preloader.off();
                console.log("complete");
            });

    };
});