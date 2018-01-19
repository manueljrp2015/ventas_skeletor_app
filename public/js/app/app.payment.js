$(function() {

    getPay = function() {
        $.getJSON('get-pay',  function(json, textStatus) {
            var tb = '<table class="table striped" id="table-payment" style="font-size: 14px;">' +
                '<thead>' +
                '<tr>' +
                '<th style="text-align: right;">CLIENTE</th>' +
                '<th style="text-align: center;">PEDIDO</th>' +
                '<th style="text-align: right;">MONTO</th>' +
                '<th style="text-align: center;">FECHA/PEDIDO</th>' +
                '<th style="text-align: center;">VENCE</th>' +
                '<th style="text-align: center;">FECHA/PAGO</th>' +
                '<th style="text-align: center;">#</th>' +
                '</tr>' +
                '</thead>' +
                '<tfoot>' +
                '<tr>' +
                '<th style="text-align: right;">CLIENTE</th>' +
                '<th style="text-align: center;">PEDIDO</th>' +
                '<th style="text-align: right;">MONTO</th>' +
                '<th style="text-align: center;">FECHA/PEDIDO</th>' +
                '<th style="text-align: center;">VENCE</th>' +
                '<th style="text-align: center;">FECHA/PAGO</th>' +
                '<th style="text-align: center;">#</th>' +
                '</tr>' +
                '</tfoot>' +
                '<tbody>';

            $.each(json, function(index, val) {
                var b = moment();
                var a = moment(val._date_create).add(val._paying_to, 'days');

                if(a.diff(b, 'days').toString() == 0 && val._state_pay < 11){
                    var msgs = '<label style="padding: 6px;background: #bf360c; color: white; font-size: 14px;" >Vencido no Pagado</label>';
                }
                else if(a.diff(b, 'days').toString() > 0 && val._state_pay <= 11){
                    var msgs = '<label style="padding: 6px;background: #f57f17; color: white; font-size: 14px;" >Pendiente por pago</label>';
                }
                else if(a.diff(b, 'days').toString() >  0 && val._state_pay >= 12){
                    var msgs = '<label style="padding: 6px;background: #2e7d32; color: white; font-size: 14px;" >Pagado</label>';
                }
                else if(a.diff(b, 'days').toString() == 0 && val._state_pay >= 11){
                    var msgs = '<label style="padding: 6px;background: #e53935; color: white; font-size: 14px;" >Pagado ya vencido</label>';
                }
                tb += '<tr>' +
                '<td style = "text-align: right;">'+val._store+'</td>' +
                '<td style = "text-align: center;"> '+val._order_id+' </td>'+
                '<td style = "text-align: right;">$'+number_format(val._total_order,2,",",".")+'</td>' +
                '<td style = "text-align: center;">'+moment(val._date_create).format("DD-MM-YYYY")+'</td>' +
                '<td style = "text-align: center;">'+a.format("DD-MM-YYYY")+'</td>' +
                '<td style = "text-align: center;">'+moment(val._date_approved).format("DD-MM-YYYY")+'</td>' +
                '<td style = "text-align: right;">'+msgs+'</td>' +
                '</tr>';
            });

            tb += '</tbody></table>'

            $("#tbpay").empty().append(tb);

            $('#table-payment tfoot th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" style="text-align: center;" placeholder="' + title + '" />');
            });


            var table = $("#table-payment").DataTable({
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
        });
    };

    getPay();



});