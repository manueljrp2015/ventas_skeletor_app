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


    $('#_store_verify').select2({
        placeholder: 'Seleccione Cliente...'
    });

    $('#_store_verify').change(function(event) {
        getOrderForVerify($('#_store_verify').val());
    });

    $("#search_o").click(function(event) {
        if ($('#_store_verify').val() == null) {
            return false;
        } else {
            getOrderForVerify($('#_store_verify').val());
        }
    });

    getOrderForVerify = function(o) {
        $.ajax({
                url: 'get-order-for-verify',
                type: 'POST',
                dataType: 'json',
                data: {
                    store: o
                },
                beforeSend: function() {
                    preloader.on();
                    $("#tbpick").empty().append(loaderCustom(50, "Buscando Pedidos"));
                }
            })
            .done(function(response) {
                preloader.off();

                table = '<table id="table-picking" class="display responsive-table datatable-example striped">' +
                    '<thead>' +
                    '<tr>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">#</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">Orden</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">Cliente</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">Items</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">Cantidad</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">Picking</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">Resto</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">Inicio</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">Fin</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">Duración</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">Nro.Doc</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">Estado</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">Acción</th>' +
                    '</tr></thead>';

                var result;
                var color;
                var disabled;

                $.each(response.data, function(index, val) {

                    if ((val.t - parseInt(val.p)) == 0) {
                        result = 'Completado';
                        color = '#2e7d32';
                        disabled = "Disabled=disabled";
                    } else {
                        result = 'Diferencia';
                        color = '#d84315';
                        disabled = "";
                    }

                    var a = moment(val._start);
                    var b = moment(val._end);
      
                    table += '<tr>' +
                        '<td style="text-align: center;">' + val.id + '</td>' +
                        '<td style="text-align: center;">' + val._order_id + '</td>' +
                        '<td style="text-align: right;">' + val._store + '</td>' +
                        '<td style="text-align: center;">' + val._item + '</td>' +
                        '<td style="text-align: center; color: #3949ab;">' + val.t + '</td>' +
                        '<td style="text-align: center; color: #ffab00;">' + val.p + '</td>' +
                        '<td style="text-align: center; color: #bf360c;">' + (val.t - parseInt(val.p)) + '</td>' +
                        '<td style="text-align: center; color: #3949ab;">' + moment(val._start).format("MM-DD-YYYY h:m:s") + '</td>' +
                        '<td style="text-align: center; color: #3949ab;">' + moment(val._end).format("MM-DD-YYYY h:m:s") + '</td>' +
                        '<td style="text-align: right; color: #3949ab;">' +  moment.duration(b - a).humanize() + '</td>' +
                        '<td style="text-align: center; color: #3949ab;">' + val._nroverify + '</td>' +
                        '<td style="text-align: center; color: ' + color + ';">' + result + '</td>' +
                        '<td style="text-align: center;">' +
                        '<button class="waves-effect waves-light btn indigo" onclick="verify(' + val._order_id + ', ' + val._store_id + ')" ' + disabled + '><i class="material-icons left">verified_user</i>Verify</button>' +
                        '<button class="waves-effect waves-light btn red darken-3" onclick="checklistVerify(' + val._order_id + ')"><i class="material-icons left">verified_user</i>Checklist</button>' +
                        '</td>' +
                        '</tr>';
                });

                table += '</table>';
                $("#tbpick").empty().append(table);

            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });

    };

    verify = function(o, s) {
        window.open("verify?order=" + o +"&store="+s, "_blank", "toolbar=no,scrollbars=yes,resizable=no,top=0,left=0,width=auto,height=auto");
    };

    checklistVerify = function(o) {
        window.open("checklist-verify?order=" + base64_encode(o), "_blank", "toolbar=no,scrollbars=yes,resizable=no,top=0,left=0,width=auto,height=auto");
    };
});