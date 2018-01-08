$(document).ready(function() {
    $(".modal").modal();
    $('.modal').modal({
        dismissible: true,
        opacity: .5,
        inDuration: 300,
        outDuration: 200,
        startingTop: '4%',
        endingTop: '10%'
    });

    moment.locale('es');

    $('#_store_pay').select2({
        placeholder: 'Seleccione Cliente...'
    });

    $("#_store_pay").change(function(event) {
        getPaymentForClient($("#_store_pay").val().toString());
    });


    modalChangeState = function(o) {
        $("#modal12").modal("open");
        changeState(o);
    };



    $("#btChangeState").click(function(event) {
        swal({
            title: "Ejecutar Proceso",
            text: "Esta seguro de realizar este proceso!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, Seguro",
            closeOnConfirm: true
        }, function() {
            $("#loader9").empty().append(loaderCustom(50, "Cambiando Estado"));
            $.post('change-state-pay', {
                id: $("#_state").val(),
                order: $("#order_id").val()
            }, function(data, textStatus, xhr) {
                console.log(textStatus);
                $("#loader9").empty();
                getPaymentMonth();
                $("#modal12").modal("close");
            });
        });
    });


    changeState = function(o) {
        $.ajax({
                url: 'get-state-pay',
                type: 'POST',
                dataType: 'json',
                data: {
                    order: o
                },
                beforeSend: function() {
                    preloader.on();
                }
            })
            .done(function(response) {
                preloader.off();

                var select = '<input type="hidden" name="order_id" id="order_id" value="' + o + '"><select name="_state" id="_state" class="js-states browser-default" style="width: 100%">';

                $.each(response.data, function(index, val) {
                    select += '<option value="' + val.id + '">' + val._description_state + '</option>'
                });

                select += '</select>';
                $(".statess").empty().append(select);
                $('#_state').select2({
                    placeholder: 'Seleccione Estado...'
                });
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    };


    getPaymentForClient = function(c) {
        $.getJSON('get-pay-client', {
            client: c
        }, function(json, textStatus) {
            createTable(json);
        });
    };

    getPaymentMonth = function() {
        $.getJSON('get-pay-month', {}, function(json, textStatus) {
            createTable(json);
        });
    };

    getPaymentForClientId = function(id) {
        $.getJSON('get-pay-id', {
            id: id
        }, function(json, textStatus) {
            var tbinfo = '<table class="striped">' +
             '<tr>' +
                '<td>Pago:</td>' +
                '<td>'+json.data.paym+'</td>' +
                '</tr>' +
                '<tr>' +
                '<tr>' +
                '<td>Origen:</td>' +
                '<td>'+json.data.bank_ori+'</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Destino</td>' +
                '<td>'+json.data.bank_dest+'</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Transacción</td>' +
                '<td>'+json.data._transaccion+'</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Monto</td>' +
                '<td>'+json.data._rode+'</td>' +
                '</tr>' +
                '</table>';

                var a = moment(json.data._create_at);
                var b = moment(json.data._date_verify);
                var c = moment(json.data._date_verify);
                var d = moment(json.data._date_approved);

            var tbtime = '	<table class="striped">' +
                '<tr>' +
                '<td>Fecha:</td>' +
                '<td>' + moment(json.data._create_at).format("DD-MM-YYYY / h:m:s a") + '</td>' +
                '<td>Declaración de Pago</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Verificación:</td>' +
                '<td>' + moment(json.data._date_verify).format("DD-MM-YYYY / h:m:s a") + '</td>' +
                '<td><strong style="color: #b71c1c">' + moment.duration(b - a).humanize() + '</strong> desde declaración</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Aprobación:</td>' +
                '<td>' + moment(json.data._date_approved).format("DD-MM-YYYY / h:m:s a") + '</td>' +
                '<td><strong style="color: #1b5e20">' + moment.duration(d - c).humanize() + '</strong> desde Verificación</td>' +
                '</tr>' +
                '</table>';

            var tbattach = '<table class="striped" style="border: 1px solid black;">' +
                '<tr>' +
                '<td style="text-align: center;"><a href="../public/files/support-payment/"' + json.data._Athachment + '" target="_blank"><i class="material-icons large">cloud_download</i></a><br>Soporte</td>' +
                '</tr>' +
                '</table>';

            $("#tbinfo").empty().append(tbinfo);
            $("#tbtime").empty().append(tbtime);
            $("#tbattach").empty().append(tbattach);


            $("#modal13").modal("open");
        });
    };

    createTable = function(obj) {
        var tb = '<table id="table-payment" class="display responsive-table datatable-exampl striped">' +
            '<thead>' +
            '<tr>' +
            '<th style="text-align: center;">#</th>' +
            '<th style="text-align: center;">#</th>' +
            '<th style="text-align: center;">Estado</th>' +
            '<th style="text-align: center;">ID#PAGO</th>' +
            '<th style="text-align: center;">CLIENTE</th>' +
            '<th style="text-align: center;">FECHA</th>' +
            '</tr>' +
            '</thead>' +
            '<tfoot>' +
            '<tr>' +
            '<th></th>' +
            '<th style="text-align: center;">#</th>' +
            '<th style="text-align: center;">Estado</th>' +
            '<th>ID#PAGO</th>' +
            '<th>#CLIENTE</th>' +
            '<th>#FECHA</th>' +
            '</tr>' +
            '</tfoot>';

        var i = 1;
        var st;
        var color;


        $.each(obj.data, function(index, val) {

            if (val._state_pay < 11) {
                color = "";
            } else if (val._state_pay == 11) {
                color = "#fff9c4";
            } else if (val._state_pay == 12) {
                color = "#81c784";
            }


            tb += '<tr>' +
                '<td style="text-align: center;"><a href="javascript: void(0)" title="información sobre el pago" onclick="getPaymentForClientId(' + val.id + ')""><i class="material-icons">info</i></a></td>' +
                '<td style="text-align: center;"><a href="javascript: void(0)" title="Cambiar Estado del Pago" onclick="modalChangeState(' + val._order_id + ')""><i class="material-icons">flag</i></a></td>' +
                '<td style="text-align: center; border-bottom: 2px solid #cfd8dc; background-color: ' + color + ';">' + val._description_state + '</td>' +
                '<td style="width: 80px; text-align: center; border-bottom: 2px solid #cfd8dc;">' + parseInt(val.id) + '</div></td>' +
                '<th style="text-align: center; border-bottom: 2px solid #cfd8dc;">' + val._store + '</th>' +
                '<th style="text-align: center; border-bottom: 2px solid #cfd8dc;" id="avai' + i + '">' + moment(val._create_at).format("DD-MM-YYYY h:m:s a") + '</th>' +
                '</tr>';
            i++;

        });
        tb += '</tbody></table>';
        $("#tbpay").empty().append(tb);

        $('#table-payment tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" style="text-align: center;" placeholder="' + title + '" />');
        });


        var table = $("#table-payment").DataTable({
            "pageLength": 50,
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
    };

    getPaymentMonth();

});