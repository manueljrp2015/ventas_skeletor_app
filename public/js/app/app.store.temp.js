$(function() {

    moment.locale('es');
    var fstore = $("#fmstore");
    var fmuser = $("#fmuser");
    var fmlistp = $("#fmlistp");
    var loader = $("#loader3");
    var loader4 = $("#loader4");
    var loader5 = $("#loader5");
    var loader6 = $("#loader6");
    var loader7 = $("#loader7");
    var loader8 = $("#loader8");
    var loader9 = $("#loader9");
    $("#save_store").attr('disabled', 'disabled');

    var spinner = '<div class="progress"><div class="indeterminate"></div></div>';

    $('#store').select2({
        placeholder: 'Tipo Tienda'
    });

    $('#send').select2({
        placeholder: 'Tipo Envio'
    });

    $('#ramal').select2({
        placeholder: 'Troncal'
    });

    $('#ccost').select2({
        placeholder: 'Centro de Costo'
    });

    $('#key').select2({
        placeholder: 'LLave'
    });

    $('#store_id').select2({
        placeholder: 'Tienda'
    });

    $('#store_id_2').select2({
        placeholder: 'Tienda'
    });

    $('#store_id_3').select2({
        placeholder: 'Tienda de Origen'
    });


    $('#store_id_4').select2({
        placeholder: 'Tienda de Destino'
    });

    $('#store_id_5').select2({
        placeholder: 'Tienda de Destino'
    });

    $('#ubicacion').select2({
        placeholder: 'Ubicación'
    });

    $('#storetp').select2({
        placeholder: 'Tipo de Usuario'
    });

    $('#giro').select2({
        placeholder: 'Giro'
    });

    $('#pais').select2({
        placeholder: 'Pais'
    });

    $('#region').select2({
        placeholder: 'Region'
    });



    $('#comuna').select2({
        placeholder: 'Comuna'
    });

    $('#ciudad').select2({
        placeholder: 'Ciudad'
    });

    $("#send").change(function(event) {

        if ($("#send").val() <= 1) {
            $(".div-country-tnt").empty();
            $(".div-pueblo-tnt").empty();

            $("#ramal_hiddden").empty().val("");
            $("#costo_hiddden").empty().val("");
        } else if ($("#send").val() >= 2) {
            $.getJSON('get-country-tnt', function(json, textStatus) {

                var sel = '<select name="_country_tnt" id="_country_tnt" class="js-states browser-default">';
                sel += '<option value=""></option>';
                $.each(json.data, function(index, val) {
                    sel += '<option value="' + val._ciudad + '">' + val._ciudad + '</option>';
                });

                sel += '</select><label for="send" style="margin-top: 50px;">Ciudad de Envio</label>';

                $(".div-country-tnt").empty().append(sel);
                $('#_country_tnt').select2({
                    placeholder: 'Ciudad'
                });

                $("#_country_tnt").change(function(event) {
                    $.getJSON('get-pueblo-tnt', {
                        country: $("#_country_tnt").val()
                    }, function(json, textStatus) {
                        var sel2 = '<select name="_pueblo_tnt" id="_pueblo_tnt" class="js-states browser-default">';
                        sel2 += '<option value=""></option>';
                        $.each(json.data, function(index, val) {
                            sel2 += '<option value="' + val._pueblos + '">' + val._pueblos + '</option>';
                        });

                        sel2 += '</select><label for="send" style="margin-top: 50px;">Pueblo de Envio</label>';

                        $(".div-pueblo-tnt").empty().append(sel2);
                        $('#_pueblo_tnt').select2({
                            placeholder: 'Pueblo'
                        });

                        $('#_pueblo_tnt').change(function(event) {
                            $.getJSON('get-cost-tnt', {
                                pueblo: $('#_pueblo_tnt').val()
                            }, function(json, textStatus) {
                                $("#ramal_hiddden").empty().val(json.data._row_costo);
                                $("#costo_hiddden").empty().val(json.data._costo_ciudad);
                            });
                        });

                    });
                });
            });
        }
    });


	$('#store').change(function (event) {
		if ($('#store').val() == "n") {
			$('#ccost').val("06-001").trigger("change");
		} else {
			$('#ccost').val(null).trigger("change");
		}
	});

    $('#ccost').change(function(event) {

        if ($('#ccost').val() == "o") {
            $("#other").empty().append('<input  id="other_cost" name="other_cost" type="text" placeholder="" class="validate"><span for="rut">Nuevo Centro de Costo</span>');
        } else {
            $("#other").empty();
        }

    });

    openModal5 = function() {
        $("#modal5").modal('open');
    };

    $("#tped").change(function() {
        vefiryRut();
    });

    $("#rut").blur(function() {
        vefiryRut();
    });

    vefiryRut = function() {
        window.setTimeout(function() {

                if ($("#rut").val() == "" || $("#rut").val() == null) {
                    swal("Error de Verificación!", "Ingrese un rut valido.", "error");
                    return false;
                } else {

                    var preped_rut = str_replace(".", "", $("#rut").val());
                    var exp = explode("-", preped_rut);
                    var rut = exp[0] + "-" + exp[1];
                    $("#rut").val(rut);

                    $.ajax({
                            url: 'verify-rut',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                rut: rut
                            },
                            beforeSend: function() {
                                preloader.on();
                            }
                        })
                        .done(function(response) {
                                preloader.off();
                                if (response.data.msg == "badrut") {
                                    swal("Error de Verificación!", "El Rut registrado tiene error en digito verificador por favor revise la información o consulte al propietario de la identificación.", "error");
                                    $("#save_store").attr('disabled', 'disabled');
                                    $("#area-softlan").attr('style', 'display: none;');
                                    $("#msii").attr('style', 'display: none;');
                                    $("#nstore").val("");
                                    $("#_razon_real").val("");
                                    $("#tb-sii").empty();
                                    $("#msg-cli").empty();
                                    $("#savesoft").val("");
                                } else if (response.data.msg == "notin") {



                                    if ($("#tped").is(':checked')) {
                                        $("#save_store").removeAttr('disabled');
                                        $("#area-softlan").attr('style', 'display: block;');
                                        $("#nstore").val("");
                                        $("#_razon_real").val("");
                                        $("#msg-cli").empty();
                                        $("#savesoft").val("save");
                                        $("#msii").attr('style', 'display: none;');

                                    } else {
                                        $("#savesoft").val("");
                                        $("#area-softlan").attr('style', 'display: none;');
                                        $("#msg-cli").empty().append('<label class="green-text">Este cliente se creara para generar pedidos el cual se facturan por boletas..</label>')
                                        $("#save_store").removeAttr('disabled');
                                        $("#msii").attr('style', 'display: none;');
                                        swal("Atención!", "Este cliente se creara para facturacion por boleta manual.", "info");

                                    }

                                } else if (response.data.msg == "in") {

                                    if ($("#tped").is(':checked')) {
                                        $("#savesoft").val("save");
                                        $("#msii").attr('style', 'display: none;');
                                        $("#area-softlan").attr('style', 'display: block;');
                                        $("#save_store").removeAttr('disabled');
                                    } else {
                                        $("#savesoft").val("");
                                        $("#msg-cli").empty().append('<label class="green-text">Este cliente se creara para generar pedidos el cual se facturan por boletas..</label>')
                                        $("#save_store").removeAttr('disabled');
                                        swal("Atención!", "Este cliente se creara para facturacion por boleta manual.", "info");
                                        $("#msii").attr('style', 'display: none;');
                                        $("#area-softlan").attr('style', 'display: none;');
                                    }
                                }

                        
                            console.log("success");
                        })
                .fail(function() {
                        console.log("error");
                    })
                    .always(function() {
                        console.log("complete");
                    });
            }

        }, 500);
};

selGiro = function(g) {
    preloader.on();
    $.getJSON('get-giro-relationship', {
        giro: g
    }, function(json, textStatus) {
        preloader.off();
        if (json.data == null) {
            swal("Giro no encontrado", "El giro seleccionada no tiene relación con los registrados en sofland contacte soporte tecnico para hacer siguimiento del problema.", "info");
        } else {
            $("#giro").val(json.data.GirCod).trigger('change');
            $("#modal5").modal("close");
        }
    });
};

$("#region").change(function(event) {

    $.getJSON('get-catalog-country', {
        id: $("#region").val()
    }, function(json, textStatus) {

        var ciu = "";
        var com = "";

        $.each(json.ciudad, function(index, val) {
            ciu += '<option value="' + val.CiuCod + '">' + val.CiuCod + ' - ' + val.CiuDes + ' </option>';
        });
        $("#ciudad").empty().append(ciu).trigger('change');

        $.each(json.comuna, function(index, val) {
            com += '<option value="' + val.ComCod + '">' + val.ComCod + ' - ' + val.ComDes + ' </option>';
        });
        $("#comuna").empty().append(com).trigger('change');
    });

});

fstore.validate({

    rules: {
        store: {
            required: true
        },
        nstore: {
            required: true
        },
        rut: {
            required: true
        },
        send: {
            required: true
        },
        ramal: {
            required: true
        },
        ccost: {
            required: true
        },
        _razon_real: {
            required: {
                depends: function() {
                    return $("#savesoft").val() == "save";
                }
            }
        },
        dirfact: {
            required: {
                depends: function() {
                    return $("#savesoft").val() == "save";
                }
            }
        },
        dirdesp: {
            required: {
                depends: function() {
                    return $("#savesoft").val() == "save";
                }
            }
        },
        emailcontacto: {
            email: {
                depends: function() {
                    return $("#savesoft").val() == "save";
                }
            }
        },
        emaildte: {
            email: {
                depends: function() {
                    return $("#savesoft").val() == "save";
                }
            }
        },
        giro: {
            required: {
                depends: function() {
                    return $("#savesoft").val() == "save";
                }
            }
        },
        pais: {
            required: {
                depends: function() {
                    return $("#savesoft").val() == "save";
                }
            }
        },
        region: {
            required: {
                depends: function() {
                    return $("#savesoft").val() == "save";
                }
            }
        },
        ciudad: {
            required: {
                depends: function() {
                    return $("#savesoft").val() == "save";
                }
            }
        },
        comuna: {
            required: {
                depends: function() {
                    return $("#savesoft").val() == "save";
                }
            }
        }
    },
    messages: {
        store: {
            required: "Campo Requerido"
        },
        nstore: {
            required: "Campo Requerido"
        },
        rut: {
            required: "Campo Requerido"
        },
        send: {
            required: "Campo Requerido"
        },
        ramal: {
            required: "Campo Requerido"
        },
        ccost: {
            required: "Campo Requerido"
        },
        _razon_real: {
            required: "Campo Requerido"
        },
        dirfact: {
            required: "Campo Requerido"
        },
        dirdesp: {
            required: "Campo Requerido"
        },
        emailcontacto: {
            email: "Ingrese un email valido"
        },
        emaildte: {
            email: "Ingrese un email valido"
        },
        giro: {
            required: "Campo Requerido"
        },
        pais: {
            required: "Campo Requerido"
        },
        region: {
            required: "Campo Requerido"
        },
        ciudad: {
            required: "Campo Requerido"
        },
        comuna: {
            required: "Campo Requerido"
        }
    },
    submitHandler: function() {
        swal({
            title: "Crear Tienda",
            text: "Está a punto de crear una tienda, está de acuerdo con este proceso.",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: lang["app_content_msg_confirm_register_btconfirm"],
            cancelButtonText: lang["app_content_msg_confirm_register_btcancel"],
            closeOnConfirm: false,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                createStore();
            } else {

            }
        });
    }
});

createStore = function() {
    $.ajax({
            url: 'create-store-temp',
            type: 'POST',
            dataType: 'json',
            data: fstore.serialize() + "&namestore=" + $("#send option:selected").html(),
            beforeSend: function() {
                preloader.on();
            }
        })
        .done(function(response) {
            preloader.off();
            console.log(response.data.mmsgodbc);
            if (response.data.msgodbc == "con-done" && response.data.msgprocess == "done") {
                swal({
                        title: "Tienda Creada",
                        text: "La tienda " + $("#nstore").val() + " ha sido creada, e importada a softland, se han enviado emails a los involucrados a dicha creación",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ok",
                        closeOnConfirm: true
                    },
                    function() {
                        window.location.href = window.location.href;
                    });
            } else if (response.data.msgodbc == "con-fail" && response.data.msgprocess == "done") {
                swal({
                        title: "Tienda Creada",
                        text: "La tienda " + $("#nstore").val() + " ha sido creada, pero no pudo importarse a softland, se han enviado emails con el archivo de importación a los involucrados a dicha creación",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ok",
                        closeOnConfirm: true
                    },
                    function() {
                        window.location.href = window.location.href;
                    });
            } else if (response.data.msgodbc == "not-apply" && response.data.msgprocess == "done") {
                swal({
                        title: "Tienda Creada",
                        text: "La tienda " + $("#nstore").val() + " ha sido creada, pero ya existe en softland, se han enviado emails a los involucrados a dicha creación",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ok",
                        closeOnConfirm: true
                    },
                    function() {
                        window.location.href = window.location.href;
                    });
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });

};

$('#store_id').change(function(event) {
    loader4.empty().append(spinner);
    $.getJSON('verify-user', {
        id: $('#store_id').val()
    }, function(json, textStatus) {

        loader4.empty();

        if (json.data.t == 1) {
            swal({
                    title: "Atencion!!",
                    text: "hay un usuario asociado a esta tienda en la tabla de relaciones, no podra continuar con el proceso",
                    type: "warning",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "ok",
                    cancelButtonText: lang["app_content_msg_confirm_register_btcancel"],
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $("#rewrite").val("ok:" + json.data.id_usuario);
                        $("#save_user_new").attr('disabled', 'disabled');

                        loader4.empty().append('<span class="green-text text-darken-2 parpadea">Tienda con usuario asociado</span>');
                    } else {
                        loader4.empty();

                        $("#rewrite").val("")
                    }
                });

        } else {
            $("#user").val(json.data.rut);
            $("#save_user_new").removeAttr('disabled');
        }
    });
});

$("#gnp").click(function() {
    preloader.on();
    loader7.empty().append(spinner);
    $.getJSON('generate-key', function(json, textStatus) {
        $("#pass").val(json.key);
        preloader.off();
        loader7.empty();
    });
});

fmuser.validate({
    ignore: [],
    rules: {
        store_id: {
            required: true
        },
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
                    loader5.empty().append(spinner);
                },
                complete: function() {
                    preloader.off();
                    loader5.empty();
                }
            }
        },
        pass: {
            required: true
        },
        email: {
            required: true,
            email: true,
            remote: {
                url: 'validate-email',
                type: 'POST',
                data: {
                    email: function() {
                        return $("#email").val();
                    }
                },
                beforeSend: function() {
                    preloader.on();
                    loader6.empty().append(spinner);
                },
                complete: function() {
                    preloader.off();
                    loader6.empty();
                }
            }
        },
        nombre: {
            required: true
        },
        key: {
            required: true
        },
        ubicacion: {
            required: true
        },
        storetp: {
            required: true
        }
    },
    messages: {
        store_id: {
            required: "Campo Requerido"
        },
        user: {
            required: "Campo Requerido",
            remote: "<span class='parpadea'>Usuario ya existente en la base de datos</span>"
        },
        pass: {
            required: "Campo Requerido"
        },
        email: {
            required: "Campo Requerido",
            email: "coloque un email valido",
            remote: "<span class='parpadea'>Correo  existente en la base de datos</span>"
        },
        nombre: {
            required: "Campo Requerido"
        },
        key: {
            required: "Campo Requerido"
        },
        ubicacion: {
            required: "Campo Requerido"
        },
        storetp: {
            required: "Campo Requerido"
        }
    },
    submitHandler: function() {
        swal({
                title: "Atencion!!",
                text: "esta a punto de crear un nuevo usuario, desea continuar con el proceso?",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: lang["app_content_msg_confirm_register_btconfirm"],
                cancelButtonText: lang["app_content_msg_confirm_register_btcancel"],
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    createUser();
                } else {

                }
            });
    }
});

createUser = function() {
    $.ajax({
            url: 'create-user-temp',
            type: 'POST',
            dataType: 'json',
            data: fmuser.serialize(),
            beforeSend: function() {
                preloader.on();
            }
        })
        .done(function(response) {
            preloader.off();
            if (response.data == true) {
                swal({
                        title: "Usuario Creado",
                        text: "El Usuario " + $("#user").val() + " ha sido creado con exito!",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ok",
                        closeOnConfirm: true
                    },
                    function() {
                        window.location.href = window.location.href;
                    });
            }
            console.log("success");
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });

};

$(".modal").modal(); $('.modal').modal({
    dismissible: true,
    opacity: .3,
    inDuration: 300,
    outDuration: 200,
    startingTop: '4%',
    endingTop: '10%'
});

openModalIn = function(c, p, n) {
    $("#codproduct").val(c);
    $("#product").val(n);
    $("#price").val(p);
    $("#range").val(0);
    $("#price_new").attr('style', 'display: none;').val("empty");
    $("#range").attr('style', 'display: none;');
    $("#factor").attr('disabled', 'disabled');
    $("#actprice").removeAttr('checked');
    $('#modal1').modal('open');
};

$("#actprice").click(function(event) {
    if ($('#actprice').prop('checked')) {
        $("#price_new").attr('style', 'display: block;').val("");
        $("#range").attr('style', 'display: block;');
        $("#factor").removeAttr("disabled");
        $("#range").val(0);
    } else {
        $("#range").val(0);
        $("#price_new").attr('style', 'display: none;').val("empty");
        $("#range").attr('style', 'display: none;');
        $("#factor").attr('disabled', 'disabled');
    }
});

$("#range").click(function(event) {
    if ($('#factor').prop('checked')) {
        var new_price = parseInt($("#range").val()) * parseInt($("#price").val()) / 100;
        $("#price_new").val(parseInt(parseInt($("#price").val()) + new_price));
    } else {
        var new_price = parseInt($("#range").val()) * parseInt($("#price").val()) / 100;
        $("#price_new").val(parseInt(parseInt($("#price").val()) - new_price));

    }
});

$("#factor").click(function(event) {
    $("#range").val(0);
});


$("#inprice").click(function(event) {

    if ($("#price_new").val() <= 0) {
        swal("Error de Precio!", "El precio nuevo es inferior al precio real.", "error");
        return false;
    } else {
        swal({
                title: "Atencion!!",
                text: "esta a punto de incluir un producto a la lista de precios de " + $("#store_id_4 option:checked").html() + ", desea continuar con el proceso?",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: lang["app_content_msg_confirm_register_btconfirm"],
                cancelButtonText: lang["app_content_msg_confirm_register_btcancel"],
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    if ($('#actprice').prop('checked')) {
                        if ($("#store_id_4").val() == null || $("#store_id_4").val() == '') {
                            swal("Error de Proceso!", "Tienda de destino vacia.", "error");
                        } else {
                            inPrice($("#price_new").val(), $("#codproduct").val(), $("#store_id_4").val(), $("#obs").val());
                        }
                    } else {
                        if ($("#store_id_4").val() == null || $("#store_id_4").val() == '') {
                            swal("Error de Proceso!", "Tienda de destino vacia.", "error");
                        } else {
                            inPrice($("#price").val(), $("#codproduct").val(), $("#store_id_4").val(), $("#obs").val());
                        }
                    }
                } else {

                }
            });
    }
});

inPrice = function(p, pro, store, ob) {
    $.ajax({
            url: 'inprice',
            type: 'POST',
            dataType: 'json',
            data: {
                precio: p,
                tienda: store,
                code: pro,
                obj: ob
            },
            beforeSend: function() {
                preloader.on();
            }
        })
        .done(function(response) {
            preloader.off();
            if (response.data.msg == "exist") {
                swal("Producto ya existente!", "Este Producto ya existe en la lista de precios de la tienda.", "error");
            } else {
                swal("Producto Agregado!", "Este Productoha sido agregado a la lista de precios de la tienda.", "success");
            }
            $('#modal1').modal('close');
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });

};


openModalUpdate = function(c, p, n) {
    $("#codproduct2").val(c);
    $("#product2").val(n);
    $("#price2").val(p);
    $("#range2").val(0);
    $("#price_new2").attr('style', 'display: none;').val("empty");
    $("#range2").attr('style', 'display: none;');
    $("#factor2").attr('disabled', 'disabled');
    $("#actprice2").removeAttr('checked');
    $('#modal2').modal('open');
};

$("#actprice2").click(function(event) {
    if ($('#actprice2').prop('checked')) {
        $("#price_new2").attr('style', 'display: block;').val("");
        $("#range2").attr('style', 'display: block;');
        $("#factor2").removeAttr("disabled");
        $("#range2").val(0);
    } else {
        $("#range2").val(0);
        $("#price_new2").attr('style', 'display: none;').val("empty");
        $("#range2").attr('style', 'display: none;');
        $("#factor2").attr('disabled', 'disabled');
    }
});

$("#range2").click(function(event) {
    if ($('#factor2').prop('checked')) {
        var new_price = parseInt($("#range2").val()) * parseInt($("#price2").val()) / 100;
        $("#price_new2").val(parseInt(parseInt($("#price2").val()) + new_price));
    } else {
        var new_price = parseInt($("#range2").val()) * parseInt($("#price2").val()) / 100;
        $("#price_new2").val(parseInt(parseInt($("#price2").val()) - new_price));

    }
});

$("#factor2").click(function(event) {
    $("#range2").val(0);
});


$("#inprice2").click(function(event) {

    if ($("#price_new2").val() <= 0) {
        swal("Error de Precio!", "El precio nuevo es inferior al precio real.", "error");
        return false;
    } else {
        swal({
                title: "Atencion!!",
                text: "esta a punto de actualizar un producto de la lista de precios " + $("#store_id_3 option:checked").html() + ", desea continuar con el proceso?",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: lang["app_content_msg_confirm_register_btconfirm"],
                cancelButtonText: lang["app_content_msg_confirm_register_btcancel"],
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    if ($('#actprice2').prop('checked')) {

                        upPrice($("#price_new2").val(), $("#codproduct2").val(), $("#store_id_3").val(), $("#obs2").val());

                    } else {

                        upPrice($("#price2").val(), $("#codproduct2").val(), $("#store_id_3").val(), $("#obs2").val());

                    }
                } else {

                }
            });
    }
});

upPrice = function(p, pro, store, ob) {
    $.ajax({
            url: 'upprice',
            type: 'POST',
            dataType: 'json',
            data: {
                precio: p,
                tienda: store,
                code: pro,
                obj: ob
            },
            beforeSend: function() {
                preloader.on();
            }
        })
        .done(function(response) {
            preloader.off();
            if (response.data.msg == true) {
                swal("Producto Actualizado!", "Este Producto fue actualizado.", "success");
                changeListiew($('#store_id_3').val());
            }
            $('#modal2').modal('close');
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });

};

$('#store_id_3').change(function(event) {
    changeListiew($('#store_id_3').val());
});

changeListiew = function(store) {
    loader8.empty().append(spinner);
    $.getJSON('find-produt-store', {
        id: store
    }, function(json, textStatus) {

        loader8.empty();

        var tbp = '<table class="display responsive-table datatable-example highlight">' +
            '<thead>' +
            '<tr>' +
            '<th align="center">Total/Productos</th>' +
            '<th align="center">Productos/Activos</th>' +
            '<th align="center">Productos/Inactivos</th>' +
            '</tr></thead><tbody>' +
            '<tr>' +
            '<td align="center">' + json.analisis.tp + '</td>' +
            '<td align="center">' + json.analisis.tac + '</td>' +
            '<td align="center">' + json.analisis.tinac + '</td>' +
            '</tr></body></table>';

        $("#tb-analisis-store").empty().append(tbp);

        tb = "";


        tb += '<table id="table-products" class="display responsive-table datatable-example">' +
            '<thead>' +
            '<tr>' +
            '<th>Codigo</th>' +
            '<th>Producto</th>' +
            '<th>Estado</th>' +
            '<th>Grupo</th>' +
            '<th>Subgrupo</th>' +
            '<th>Precio</th>' +
            '<th>#</th>' +
            '</tr>' +
            '</thead>' +
            '<tbody>';

        var state;
        var icon;
        var color;
        var title;
        $.each(json.list, function(index, val) {

            if (val.activo == "0") {
                state = "<h5 class='red-text'>inactivo</h5>";
                icon = 'playlist_add_check';
                color = 'green';
                title = "Activar Producto";
            } else {
                state = "<h5 class='green-text'>activo</h5>";
                icon = 'delete';
                color = 'red';
                title = "Desactivar Producto";
            }


            tb += '<tr>' +
                '<td align="center">' + val.codigo + '</td>' +
                '<td align="right">' + val.nombre + '</td>' +
                '<td align="right">' + state + '</td>' +
                '<td align="right">' + val.ngrupo + '</td>' +
                '<td align="right">' + val.sub_grupo + '</td>' +
                '<td>' + number_format(val.precio_franquiciado, 2, ",", ".") + '</td>' +
                '<td align="right"><a href="javascript: void(0)" onclick=openModalIn("' + val.codigo + '","' + val.precio_franquiciado + '","' + str_replace(' ', '_', val.nombre) + '") class="btn-floating waves-effect waves btn indigo" title="Transferir Producto"><i class="material-icons">compare_arrows</i></a><a href="javascript: void(0)" onclick=inProd("' + val.codigo + '","' + val.activo + '") class="btn-floating waves-effect btn ' + color + '" title="' + title + '"><i class="material-icons">' + icon + '</i></a><a href="javascript: void(0)" onclick=openModalUpdate("' + val.codigo + '","' + val.precio_franquiciado + '","' + str_replace(' ', '_', val.nombre) + '") class="btn-floating waves-effect btn yellow" title="Actualizar Producto"><i class="material-icons">update</i></a></td>' +
                '</tr>';


        });
        tb += '</tbody></table>';

        $("#tb-list-store").empty().append(tb);
        $("#table-products").DataTable({
            "order": [
                [0, "desc"]
            ]
        });
    });
};

inProd = function(pro, act) {
    swal({
            title: "Atencion!!",
            text: "Esta a punto de alterar el producto " + pro + ", desea continuar con el proceso?",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: lang["app_content_msg_confirm_register_btconfirm"],
            cancelButtonText: lang["app_content_msg_confirm_register_btcancel"],
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {

                $.ajax({
                        url: 'delete-prod',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            prod: pro,
                            activo: act,
                            store: $("#store_id_3").val()
                        },
                        beforeSend: function() {
                            preloader.on();
                        }
                    })
                    .done(function(response) {
                        preloader.off();

                        if (response.data.msg == "i") {
                            swal("Producto inactivo!", "Este ha sido desactivado.", "success");
                            changeListiew($('#store_id_3').val())
                        } else {
                            swal("Producto activo!", "Este ha sido activado", "success");
                            changeListiew($('#store_id_3').val())
                        }
                    })
                    .fail(function() {
                        console.log("error");
                    })
                    .always(function() {
                        console.log("complete");
                    });


            } else {

            }
        });
}

fmlistp.validate({
    ignore: [],
    rules: {
        store_id_3: {
            required: true
        },
        store_id_4: {
            required: true
        }
    },
    messages: {
        store_id_3: {
            required: "Debe seleccionar un origen"
        },
        store_id_4: {
            required: "Debe seleccionar un destino"
        }
    },
    submitHandler: function() {
        swal({
                title: "Atencion!!",
                text: "Esta a punto de cargar la lista de  " + $("#store_id_3 option:selected").html() + " hacia " + $("#store_id_4 option:selected").html() + ", desea continuar con el proceso?",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: lang["app_content_msg_confirm_register_btconfirm"],
                cancelButtonText: lang["app_content_msg_confirm_register_btcancel"],
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {

                    if ($("#store_id_3").val() == $("#store_id_4").val()) {
                        swal("Proceso Fallido!", "Esta tratando de enviar productos entre una misma tienda!", "error");
                        return false;
                    } else {
                        chargeList();
                    }

                } else {

                }
            });
    }
});


chargeList = function() {
    $.ajax({
            url: 'process-charge-list',
            type: 'POST',
            dataType: 'json',
            data: fmlistp.serialize(),
            beforeSend: function() {
                preloader.on();
            }
        })
        .done(function(response) {

            preloader.off();
            if (response.data.msg == true) {

                swal({
                        title: "Proceso Ejecutado",
                        text: "Se ha cargado la lista de precios con exito",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ok",
                        closeOnConfirm: true
                    },
                    function() {
                        window.location.href = window.location.href;
                    });

            } else if (response.data.msg == "fail") {
                swal("Proceso Fallido!", "ya hay productos asociados a la tienda!", "error");
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });

};

$("#upload-button").click(function(event) {

    if ($("#store_id_5").val() == null || $("#file").val() == "") {
        swal("Proceso Fallido!", "complete la informacion requerida probablemente a omitido alguno!", "warning");
        return false
    } else {
        uploadFile();
    }

});

var fmfile = $("#fmfile");
var process = $("#process");

onLoadFile = function(event) {
    var input = event.target;
    var file = input.files[0];


        var tbp = '<table class="display responsive-table datatable-example highlight striped">' +
        '<thead>' +
        '<tr>' +
        '<th align="center">Archivo</th>' +
        '<th align="center">Tamaño</th>' +
        '<th align="center">Tipo</th>' +
        '<th align="center">F/modificación</th>' +
        '</tr></thead><tbody>' +
        '<tr>' +
        '<td align="center">' + file.name + '</td>' +
        '<td align="center">' + Math.ceil(parseFloat(file.size / 1024)) + ' Kb</td>' +
        '<td align="center">' + file.type + '</td>' +
        '<td align="center">' + moment(file.lastModified).format('LLLL') + '</td>' +
        '</tr></body></table>';

        $("#info-file").empty().append(tbp);
    
}



uploadFile = function() {

    var file = document.getElementById("file");
    var formData = new FormData();
    formData.append('fileexcel', file.files[0]);
    formData.append('id_store', $("#store_id_5").val().toString());

    $.ajax({
            url: 'upload-files-excel',
            type: 'POST',
            processData: false,
            contentType: false,
            async: true,
            dataType: 'json',
            data: formData,
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
        .done(function(response) {
            preloader.off();
            console.log("success");

            var tbp = '<table class="display responsive-table datatable-example highlight striped">' +
                '<thead>' +
                '<tr>' +
                '<th align="center">Respuesta</th>' +
                '</tr></thead><tbody>' +
                '<tr>' +
                '<td align="center"><a href="' + response.data.file + '" download="log-response.txt" >Click aqui para descargar la respuesta</a></td>' +
                

            $("#info-file").empty().append(tbp);



            swal({
                    title: "Proceso Ejecutado",
                    text: "Se ha cargado la lista de precios con exito, puede descargar el log de resultado",
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ok",
                    closeOnConfirm: true
                },
                function() {
                    //window.location.href = window.location.href;
                });
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });

};

downloadURI = function(uri, name) {
    var link = document.createElement("a");
    link.download = name;
    link.href = uri;
    link.click();
};

/*relationships*/

$('#store_id_rel1').select2({
    placeholder: 'Tienda de Origen'
});

$('#user_id_rel1').select2({
    placeholder: 'Usuarios'
});




var loader10 = $("#loader-user-rel");

$('#store_id_rel1').change(function(event) {
    loader10.empty().append(spinner);
    $.getJSON('verify-user', {
        id: $('#store_id_rel1').val()
    }, function(json, textStatus) {

        loader10.empty();

        if (json.data.t == 1) {
            swal({
                    title: "Atencion!!",
                    text: "hay un usuario asociado a esta tienda en la tabla de relaciones, no podra continuar con el proceso",
                    type: "warning",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "ok",
                    cancelButtonText: lang["app_content_msg_confirm_register_btcancel"],
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $("#rewrite").val("ok:" + json.data.id_usuario);
                        $("#save_user_new").attr('disabled', 'disabled');
                        loader10.empty().append('<span class="green-text text-darken-2 parpadea">Tienda con usuario asociado</span>');

                        var tbp = '<table class="display responsive-table datatable-example highlight striped">' +
                            '<thead>' +
                            '<tr>' +
                            '<th align="center">Usuario</th>' +
                            '<th align="center">Nombre</th>' +
                            '<th align="center">Rut</th>' +
                            '</tr></thead><tbody>' +
                            '<tr>' +
                            '<td align="center">' + json.data.usuario + '</td>' +
                            '<td align="center">' + json.data.nombres + '</td>' +
                            '<td align="center">' + json.data.rut + '</td>' +
                            '</tr></body></table>';

                        $("#loader-user-reltab").empty().append(tbp);

                        $("#user_id_rel1").prop("disabled", false);

                        $("#save_list_new_q").removeAttr('disabled');

                    } else {
                        loader10.empty();

                        $("#rewrite").val("")
                    }
                });

        } else {
            $("#rewrite").val("ok:new");
        }
    });
});


$("#save_list_new_q").click(function(event) {

    if ($('#user_id_rel1').val() == null || $('#store_id_rel1').val() == null) {
        swal("Proceso Fallido!", "complete los campos requeridos", "error");
        return false;
    } else {

        swal({
                title: "Atencion!!",
                text: "Esta a punto de relacionar el usuario  " + $("#user_id_rel1 option:selected").html() + " a la tienda " + $("#store_id_rel1 option:selected").html() + ", desea continuar con el proceso?",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: lang["app_content_msg_confirm_register_btconfirm"],
                cancelButtonText: lang["app_content_msg_confirm_register_btcancel"],
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    processChangeUser();
                } else {

                }
            });
    }
});



processChangeUser = function() {


    $.ajax({
            url: 'process-change-user',
            type: 'POST',
            dataType: 'json',
            data: $("#fmchange").serialize(),
            beforeSend: function() {
                preloader.on();
            }
        })
        .done(function(response) {
            preloader.off();
            if (response.data.msg == "done") {
                swal({
                        title: "Proceso Ejecutado",
                        text: "Se ha realizado la relación del usuario",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ok",
                        closeOnConfirm: true
                    },
                    function() {
                        window.location.href = window.location.href;
                    });
            } else if (response.data.msg == "exist") {
                swal("Proceso Fallido!", "el usuario esta relacionado a esta tienda!", "warning");
            }
            console.log("success");
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });


};

});
