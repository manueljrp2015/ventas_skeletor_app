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


    getPaymentMonth = function(o) {

        $.getJSON('get-pay-month', {}, function(json, textStatus) {

            var tb = '<table id="table-payment" class="display responsive-table datatable-exampl striped">' +
                '<thead>' +
                '<tr>' +
                '<th style="text-align: center;">ID#PAGO</th>' +
                '<th style="text-align: center;">CLIENTE</th>' +
                '<th style="text-align: center;">PAGO</th>' +
                '<th style="text-align: center;">BANCO/ORG</th>' +
                '<th style="text-align: center;">BANCO/DES</th>' +
                '<th style="text-align: center;">TRANSACCIÓN</th>' +
                '<th style="text-align: center;">MONTO</th>' +
                '<th style="text-align: center;">FECHA</th>' +
                '<th style="text-align: center;">SOPORTE</th>' +
                '</tr>' +
                '</thead>' +
                '<tfoot>' +
                '<tr>' +
                '<th>ID#PAGO</th>' +
                '<th>#CLIENTE</th>' +
                '<th>#PAGO</th>' +
                '<th>#BANCO/ORG</th>' +
                '<th>#BANCO/DES</th>' +
                '<th>#TRANSACCIÓN</th>' +
                '<th>#MONTO</th>' +
                '<th>#FECHA</th>' +
                '<th style="text-align: center;">#SOPORTE</th>' +
                '</tr>' +
                '</tfoot>';

            var i = 1;
            var st;
            var color;


            $.each(json.data, function(index, val) {


                tb += '<tr>' +
                    '<td style="width: 80px; text-align: center; border-bottom: 2px solid #cfd8dc;">' + parseInt(val.id) + '</div></td>' +
                    '<th style="text-align: center; border-bottom: 2px solid #cfd8dc;">' + val._store + '</th>' +
                    '<th style="text-align: center; border-bottom: 2px solid #cfd8dc;">' + val.paym + '</th>' +
                    '<th style="text-align: center; border-bottom: 2px solid #cfd8dc;">' + val.bank_ori + '</th>' +
                    '<th style="text-align: center; border-bottom: 2px solid #cfd8dc;">' + val.bank_dest + '</th>' +
                    '<th style="text-align: right; border-bottom: 2px solid #cfd8dc;">' + val._transaccion + '</th>' +
                    '<th style="text-align: right; border-bottom: 2px solid #cfd8dc;">' + val._rode + '</th>' +
                    '<th style="text-align: right; border-bottom: 2px solid #cfd8dc;" id="avai' + i + '">' + val._date_pay + '</th>' +
                    '<td style="width: 80px; text-align: center; border-bottom: 2px solid #cfd8dc;"><a href="../public/files/support-payment/"' + val._Athachment + '" target="_blank"><i class="material-icons small">cloud_download</i></a></div></td>' +
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
        });
    };

    getPaymentMonth();

});