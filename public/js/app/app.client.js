$(function() {


    $('#_type_pay').select2({
        placeholder: 'Tipo de Pago'
    });

    $('#_form_pay').select2({
        placeholder: 'Forma de Pago'
    });

    $('#send').select2({
        placeholder: 'Courier'
    });

    $('#giro').select2({
        placeholder: 'Giro'
    })

    $('#pais').select2({
        placeholder: 'Pais'
    });

    $('#region').select2({
        placeholder: 'Region'
    });

    $('#_region_c').select2({
        placeholder: 'Region del cliente'
    });

    $('#ciudad').select2({
        placeholder: 'Ciudad'
    });

    $('#comuna').select2({
        placeholder: 'Comuna'
    });

    $(".modal").modal();
    $('.modal').modal({
        dismissible: true,
        opacity: .5,
        inDuration: 300,
        outDuration: 200,
        startingTop: '4%',
        endingTop: '10%'
    });

    $("#_name").on({
        change: function() {
            $("#_name").val($("#_name").val().toUpperCase());
        }
    });

    $("#_dir").on({
        change: function() {
            $("#_dir").val($("#_dir").val().toUpperCase());
        }
    });

    $("#dirdesp").on({
        change: function() {
            $("#dirdesp").val($("#dirdesp").val().toUpperCase());
        }
    });

    $("#_razon_real").on({
        change: function() {
            $("#_razon_real").val($("#_razon_real").val().toUpperCase());
        }
    });

    $("#dirfact").on({
        change: function() {
            $("#dirfact").val($("#dirfact").val().toUpperCase());
        }
    });

    $("#_phone").inputmask();

    $('#tbstores tfoot th').each(function() {
        var title = $(this).text();
        $(this).html('<input type="text" style="text-align: center;" placeholder="' + title + '" />');
    });


    var table = $("#tbstores").DataTable({
        "pageLength": 30,
        "dom": '<"top"flp<"clear">>rt<"bottom"ifp<"clear">>',
        "order": [
            [0, "asc"]
        ]
    });

    table.columns().every(function() {
        var that = this;

        $('input', this.footer()).on('keyup change', function() {
            if (that.search() !== this.value) {
                that
                    .search(this.value)
                    .draw();
            }
        });
    });



    editStore = function(id) {
        preloader.on()
        $.getJSON('get-store-id', {
            id: id
        }, function(json, textStatus) {
            preloader.off();
            $("#id_2").val(json.data.id);
            $("#_store_2").val(json.data._store);
            $("#_rut_2").val(json.data._idn);
            $("#_center").val(json.data._cost_center);
            $("#_email_2").val(json.data._email);
            $("#_phone_2").val(json.data._phone);
            $("#modal7").modal('open');
        });
    }

    var frmUpdate = $("#frm-update-store");

    frmUpdate.validate({
        rules: {
            _store_2: {
                required: true
            },
            _rut_2: {
                required: true
            },
            _center: {
                required: true
            },
            _email_2: {
                required: true,
                email: true
            },
            _phone_2: {
                required: true
            }
        },
        messages: {
            _store_2: {
                required: "Campor Requerido"
            },
            _rut_2: {
                required: "Campor Requerido"
            },
            _center: {
                required: "Campor Requerido"
            },
            _email_2: {
                required: "Campor Requerido",
                email: "Email incorrecto"
            },
            _phone_2: {
                required: "Campor Requerido"
            }
        },
        submitHandler: function() {

            swal({
                title: "Actualizar Cliente o Tienda",
                text: "Esta seguro de realizar este proceso!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, Seguro",
                closeOnConfirm: false
            }, function() {
                updateStore();
            });

        }
    });

    updateStore = function() {

        $.ajax({
                url: 'store-update',
                type: 'POST',
                dataType: 'json',
                data: frmUpdate.serialize(),
                beforeSend: function() {
                    preloader.on();
                }
            })
            .done(function(response) {
                preloader.off();
                swal({
                        title: "Proceso Ejecutado",
                        text: "Se ha ejecutado el proceso satisfactoriamente",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ok",
                        closeOnConfirm: true
                    },
                    function() {
                        $("#modal7").modal("close");
                    });
            })
            .fail(function() {})
            .always(function() {});
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

    $("#_rut").on({
        change: function() {
            evefiryRut();
        },
        blur: function() {
            evefiryRut();
        }
    });


    evefiryRut = function() {
        window.setTimeout(function() {

            if ($("#_rut").val() == "" || $("#_rut").val() == null) {
                swal("Error de Verificación!", "Ingrese un rut valido.", "error");
                return false;
            } else {

                var preped_rut = str_replace(".", "", $("#_rut").val());
                var exp = explode("-", preped_rut);
                var rut = exp[0] + "-" + exp[1];
                $("#_rut").val(rut);


                $.ajax({
                        url: 'verify-rut',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            rut: rut
                        },
                        beforeSend: function() {
                            preloader.on();
                            $("#loader").empty().append(loaderCustom(55, "Validando Rut"));
                        }
                    })
                    .done(function(response) {
                        preloader.off();
                        if (response.data.msg == "badrut") {
                            $("#loader").empty();
                            swal("Error de Verificación!", "El Rut registrado tiene error en digito verificador por favor revise la información o consulte al propietario de la identificación.", "error");
                            $("#save_store").attr('disabled', 'disabled');


                        } else if (response.data.msg == "notin") {

                            var preped_rut = str_replace(".", "", $("#_rut").val());
                            var exp = explode("-", preped_rut);
                            var rut = number_format(exp[0], 0, ".", ".") + "-" + exp[1];
                            jQuery.getJSON('https://siichile.herokuapp.com/consulta', {
                                rut: rut
                            }, function(result) {
                                if (result.actividades.length > 0) {
                                    $("#loader").empty();
                                    swal("SII", "Este RUT se encuentra en nuestra base de datos asociado a una tienda o cliente y posee información de inicio de actividades en SII, por lo cual no podra ser registrado.", "error");
                                    $("#save_store").attr('disabled', 'disabled');
                                    $("#loader").empty();

                                } else {
                                    swal("SII", "Este RUT se encuentra en nuestra base de datos asociado a una tienda o cliente y no posee inicio de actividades dentro del servicio de impuestos internos.", "error");
                                    $("#save_store").attr('disabled', 'disabled');
                                    $("#loader").empty();
                                }
                            });

                        } else if (response.data.msg == "in") {

                            var preped_rut = str_replace(".", "", $("#_rut").val());
                            var exp = explode("-", preped_rut);
                            var rut = number_format(exp[0], 0, ".", ".") + "-" + exp[1];
                            jQuery.getJSON('https://siichile.herokuapp.com/consulta', {
                                rut: rut
                            }, function(result) {
                                if (result.actividades.length > 0) {
                                    $("#loader").empty();
                                    $("#_name").val("").val(result.razon_social);
                                    $("#_razon_real").val("").val(result.razon_social);
                                    $("#_band").val("").val("X");
                                    $("#msg-cli").empty().append('<label class="green-text" style="font-size: 16px;">Información de inicio de actividades en SII, de click sobre Ver Giros y seleccione el giro que realiza el cliente.</label>');
                                    $("#save_store").removeAttr('disabled');
                                    var afecta;


                                    var tbps = '<table class="display responsive-table datatable-example highlight">' +
                                        '<thead>' +
                                        '<tr>' +
                                        '<th align="center" style="border-right: 1px solid #cfd8dc;">Codigo</th>' +
                                        '<th align="center" style="border-right: 1px solid #cfd8dc;">Giro</th>' +
                                        '<th align="center" style="border-right: 1px solid #cfd8dc;">Categoria</th>' +
                                        '<th align="center" style="border-right: 1px solid #cfd8dc;">Afecta</th>' +
                                        '</tr></thead><tbody>';
                                    $.each(result.actividades, function(index, val) {

                                        if (val.afecta == true) {
                                            afecta = "SI";
                                        } else {
                                            afecta = "NO";
                                        };

                                        tbps += '<tr>' +
                                            '<td align="center" style="border-right: 1px solid #cfd8dc; border-bottom: 1px solid #cfd8dc;"><a href="javascript: void(0)" onclick="selGiro(' + val.codigo + ')">' + val.codigo + '</a></td>' +
                                            '<td align="center" style="border-right: 1px solid #cfd8dc; border-bottom: 1px solid #cfd8dc;">' + val.giro + '</td>' +
                                            '<td align="center" style="border-right: 1px solid #cfd8dc; border-bottom: 1px solid #cfd8dc;">' + val.categoria + '</td>' +
                                            '<td align="center" style="border-right: 1px solid #cfd8dc; border-bottom: 1px solid #cfd8dc;">' + afecta + '</td>' +
                                            '</tr>';
                                    });

                                    tbps += "</body></table><br>";
                                    $("#bt-giro").empty().append('<blockquote><h5>SII</h5></blockquote><br><a class="waves-effect waves-light btn indigo m-b-xs" id="clicksed">Ver Giros</a>');
                                    $("#clicksed").click(function(event) {
                                        $("#slideGiro").slideDown(2000, function() {
                                            $("#tb-sii").empty().append(tbps);
                                        });
                                    });
                                } else {
                                    swal("SII", "Este RUT no posee inicion de actividades dentro del servicio de impuestos internos. Pero puede registrarse para hacer compras por boletas manual.", "error");
                                    $("#save_store").removeAttr('disabled');
                                    $("#loader").empty();
                                }
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
            }

        }, 500);
    };


    selGiro = function(g) {
        preloader.on();
        $("#loader").empty().append(loaderCustom(55, "Validando Giro"));
        $.getJSON('get-giro-relationship', {
            giro: g
        }, function(json, textStatus) {
            preloader.off();
            if (json.data == null) {
                $("#loader").empty();
                swal("Giro no encontrado", "El giro seleccionada no tiene relación con los registrados en sofland contacte soporte tecnico para hacer siguimiento del problema.", "info");
            } else {;
                $("#loader").empty();
                $("#giro").val(json.data.GirCod).trigger('change');
            }
        });
    };

    var fmclient = $("#fmclient");

    fmclient.validate({
        rules: {
            _rut: {
                required: true
            },
            _name: {
                required: true
            },
            _phone: {
                required: true
            },
            _email: {
                required: true
            },
            _dir: {
                required: true
            },
            _credit: {
                required: {
                    depends: function(element) {
                        return ($("#_band").val() == "");
                    }
                }
            },
            _type_pay: {
                required: {
                    depends: function(element) {
                        return ($("#_band").val() == "");
                    }
                }
            },
            _form_pay: {
                required: {
                    depends: function(element) {
                        return ($("#_band").val() == "");
                    }
                }
            },
            _factor: {
                required: true
            },
            dirdesp: {
                required: true
            },
            _razon_real: {
                required: {
                    depends: function(element) {
                        return ($("#_band").val() == "X");
                    }
                }
            }
        },
        messages: {

        },
        submitHandler: function() {


            swal({
                title: "Ejecutar Proceso",
                text: "Está a punto de realizar una operación, está de acuerdo con este proceso.",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: lang["app_content_msg_confirm_register_btconfirm"],
                cancelButtonText: lang["app_content_msg_confirm_register_btcancel"],
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {
                    putClient();
                } else {

                }
            });
        }
    });

    putClient = function() {
        $.ajax({
                url: fmclient.attr('action'),
                type: fmclient.attr('method'),
                dataType: 'json',
                data: fmclient.serialize(),
                beforeSend: function() {
                    preloader.on();
                }
            })
            .done(function(response) {
                preloader.off();
                if (response.data.msgodbc == "con-done" && response.data.msgprocess == "done") {
                    swal({
                            title: "Tienda Creada",
                            text: "La tienda " + $("#_name").val() + " ha sido creada, e importada a softland, se han enviado emails a los involucrados a dicha creación",
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
                            text: "La tienda " + $("#_name").val() + " ha sido creada, pero no pudo importarse a softland, se han enviado emails con el archivo de importación a los involucrados a dicha creación",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ok",
                            closeOnConfirm: true
                        },
                        function() {
                            window.location.href = window.location.href;
                        });
                } else if(response.data.msgodbc == "con-done" && response.data.msgprocess == "done-update"){
                  swal({
                            title: "Cliente Actualziado",
                            text: "La tienda o cliente " + $("#_name").val() + " ha sido actualizado en la plataforma web y en sistema softland.",
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

    }

    $('#_pueblo_tnt').select2({
        placeholder: 'Pueblo'
    });

    $('#_country_tnt').select2({
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
                var sel = '';
                $.each(json.data, function(index, val) {
                    sel += '<option value="' + val._ciudad + '">' + val._ciudad + '</option>';
                });
                $("#_country_tnt").empty().append(sel);
                $("#_country_tnt").change(function(event) {
                    $.getJSON('get-pueblo-tnt', {
                        country: $("#_country_tnt").val()
                    }, function(json, textStatus) {
                        var sel2 = '';
                        $.each(json.data, function(index, val) {
                            sel2 += '<option value="' + val._pueblos + '">' + val._pueblos + '</option>';
                        });
                        $("#_pueblo_tnt").append(sel2);
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

    getClientUpdate = function(i, elem) {
        $("#tb_" + elem).empty().append(loaderCustom(30, ""));
        $.getJSON('get-client-update', {
            id: i
        }, function(json, textStatus) {

            var serial;
            $("#id").val(json.data.id);
            $("#_rut").val(json.data._idn);
            $("#_name").val(json.data._store);
            $("#_phone").val(json.data._phone);
            $("#_email").val(json.data._email);
            $("#_dir").val(json.data._dir);
            $("#_region_c").val(json.data._region_id).trigger('change');
            $("#_credit").val(json.data._credit);
            $("#_credit").attr('readonly', 'readonly');
            $("#_type_pay").val(json.data._type_pay).trigger('change');
            $('#_type_pay').select2("enable",false);
            $("#_form_pay").val(json.data._paying_to).trigger('change');
            $('#_form_pay').select2("enable",false);
            $("#_type_pay").attr('readonly', 'readonly');
            $("#_factor").val(json.data._courier_factor);
            $("#dirdesp").val(json.data._dirdesp);
            $("#_razon_real").val(json.data._razon_social);
            $("#dirfact").val(json.data._dirfact);
            $("#_band").val("update");
            $("#giro").val(json.data._giro_id).trigger('change');
            $("#pais").val(json.data._pais_id).trigger('change');
            $("#region").val(json.data.region).trigger('change');

            serial = unserialize(json.data._values);
            if (serial == null) {

            } else {
                $("#send").val(serial["_type_courier"]).trigger('change');
                window.setTimeout(function() {
                    $("#_country_tnt").val(serial["_city"]).trigger('change');
                }, 500);
                window.setTimeout(function() {
                    $("#_pueblo_tnt").val(serial["_country"]).trigger('change');
                }, 1000);
            }


            window.setTimeout(function() {
                $("#ciudad").val(json.data._ciudad_id).trigger('change');
                $("#comuna").val(json.data._comuna_id).trigger('change');
            }, 1000);


            $("#tb_" + elem).empty();
            $('ul.tabs').tabs('select_tab', 'test4');
            $("#save_store").text('actualizar');
            fmclient.removeAttr('action').attr('action', 'update-client');
            $("#save_store").removeAttr('disabled');
        });
    };
});