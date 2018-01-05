$(function() {

    var frmtnt = $("frmtnt");

    $("#saveTnt").click(function(event) {
        if ($("#_pay").val().length < 1) {
            alert("Sfsdfas");
            return false;
        } else {

            swal({
                title: "Ejecutar Proceso",
                text: "Estas seguro de realizar este proceso?.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Agragar Despacho",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {
                    saveCourier();
                } else {}
            });
        }
    });


    saveCourier = function() {
        preloader.on();
        $.getJSON('save-courier-order', {
            cost: $("#_pay").val(),
            courier_id: $("#_type_courier").val(),
            total_weight: $("#_total_weight").val(),
            factor: $("#_factor").val(),
            param: $("#_param").val(),
            order_id: $("#order_id").val(),
            store_id: $("#store_id").val(),
        }, function(json, textStatus) {
            preloader.off();
            window.location.href = window.location.href;
        });
    };

    $("#calculate").click(function(event) {
        preloader.on();
        $.getJSON('calculate-tnt', {
            order: $("#_order_id").val(),
            tipo: $("#_type_courier").val()
        }, function(json, textStatus) {
            preloader.off();
            if (json.data.config_c > 0) {
                $("#_factor").val(json.data.factor);
                $("#_param").val(json.data.config_c);
                $("#_total_weight").val(json.data.real_weight);
                $("#order_id").val(json.data.order);
                $("#store_id").val(json.data.store_id);
                $("#msgcour1").empty().html("Monto a cancelar por concepto de despacho por TNT, este monto fue calculado en base a su pedido.");
            } else {
                $("#_factor").val(json.data.factor);
                $("#_param").val(json.data.config_c);
                $("#_total_weight").val(json.data.real_weight);
                $("#order_id").val(json.data.order);
                $("#store_id").val(json.data.store_id);
                $("#msgcour1").empty().html("Por la configuración de su tienda se han echo deducciones del calculo de envio por TNT");
            }
            $("#_pay").val(json.data.cost);
        });
    });


    var frmbodega = $("#frmbodega");

    frmbodega.validate({
        ignore: [],
        rules: {
            _date_courier: {
                required: true
            },
            _horario: {
                required: true
            },
            _contact: {
                required: true
            },
            _cel_contact: {
                required: true
            }
        },
        messages: {
            _date_courier: {
                required: "Campo requerido"
            },
            _horario: {
                required: "Campo requerido"
            },
            _contact: {
                required: "Campo requerido"
            },
            _cel_contact: {
                required: "Campo requerido"
            }
        },
        submitHandler: function() {

            swal({
                title: "Ejecutar Proceso",
                text: "Estas seguro de realizar este proceso?.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Agragar Despacho",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {
                    saveCourierTime();
                } else {}
            });

        }
    });

    saveCourierTime = function() {
        preloader.on();
        $.getJSON('save-courier-order', frmbodega.serialize() + "&courier_id=" + $("#_type_courier2").val(), function(json, textStatus) {
            preloader.on();
            window.location.href = window.location.href;
        });
    };


    var frmotros = $("#frmotros");

    frmotros.validate({
        ignore: [],
        rules: {
            _contact: {
                required: true
            },
            _cel_contact: {
                required: true
            },
            _dir: {
                required: true
            },
            _emp: {
                required: true
            }
        },
        messages: {
            _contact: {
                required: "Campo requerido"
            },
            _cel_contact: {
                required: "Campo requerido"
            },
            _dir: {
                required: "Campo requerido"
            },
            _emp: {
                required: "Campo requerido"
            }
        },
        submitHandler: function() {
            swal({
                title: "Ejecutar Proceso",
                text: "Estas seguro de realizar este proceso?.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Agragar Despacho",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {
                    saveCourierOther();
                } else {}
            });
        }
    });

    saveCourierOther = function() {
        preloader.on();
        $.getJSON('save-courier-order', frmotros.serialize() + "&courier_id=" + $("#_type_courier3").val(), function(json, textStatus) {
            preloader.on();
            window.location.href = window.location.href;
        });
    };

    $("#btaccording").click(function(event) {
        swal({
            title: "Ejecutar Proceso",
            text: "Estas seguro de realizar este proceso?.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Conformar",
            cancelButtonText: "salir",
            closeOnConfirm: true,
            closeOnCancel: true,
            type: "input",
            animation: "slide-from-top",  
            inputPlaceholder: "quiere hacer algun comentario?" 
        }, function(inputValue) {
                accordingOrder(inputValue);
            
        });
    });


    accordingOrder = function(v) {
        preloader.on();
        $.getJSON('according-order', {
            order: $("#_order_id").val(), comment: v 
        }, function(json, textStatus) {
            preloader.off();
            swal({
                title: "Enhorabuena!",
                text: "has estado conforme con tu pedido y procederemos a prepararlo podras ver el estatus en la session mis compras..",
                timer: 4000,
                showConfirmButton: false
            });
            window.setTimeout(function(){
            	window.location.href = "../mis-compras/purchases";
            },4500)
        });
    };
});