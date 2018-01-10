$(function() {

    getRecordMonth = function() {
        $.getJSON('get-analisis-store', function(json, textStatus) {
            $(".buy").empty().append(number_format(json.data.torder, 2, ",", "."));
            $(".items").empty().append(json.data.coorr);
            $(".prod").empty().append(json.data.item);

            $(".c_week_b").empty().append(number_format(json.salesW.semana_anterior, 2, ",", "."));
            $(".c_week_a").empty().append(number_format(json.salesW.semana_actual, 2, ",", "."));

            var tb = '<table id="tborder" class="responsive-table bordered">' +
                '<thead>' +
                '<tr>' +
                '<th data-field="id">#</th>' +
                '<th data-field="number">Cliente</th>' +
                '<th data-field="company">Items</th>' +
                '<th data-field="total">Total</th>' +
                '<th data-field="progress">Fecha</th>' +
                '<th data-field="progress">Estatus</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';

            $.each(json.oweek, function(index, val) {
                tb += '<tr>' +
                    '<td data-field="id">' + val._order_id + '</td>' +
                    '<td data-field="number">' + val._store + '</td>' +
                    '<td data-field="company">' + val._item + '</td>' +
                    '<td data-field="date">$ ' + number_format(val._total_order, 2, ",", ".") + '</td>' +
                    '<td data-field="progress">' + val._date_create + '</td>' +
                    '<td data-field="progress">' + val._description_state + '</td>' +
                    '</tr>';
            });

            $("#tb1").empty().append(tb);

            $("#tborder").DataTable({
                "pageLength": 30,
                "dom": '<"top"flp<"clear">>rt<"bottom"ifp<"clear">>',
                "order": [
                    [0, "asc"]
                ]
            });

            var rank = 1;
            var d = "";
            $.each(json.rank, function(index, v) {
                d += '<li>' + v._store + '<p>' + number_format(v.t, 2, ",", ".") + '</p><div class="percent-info green-text right" style="margin-top: -40px; font-size: 25px;">#' + rank + '</div></li>';
                rank++;
            });

            $(".rank").empty().append(d);

            var s = "";
            $.each(json.sales, function(index, values) {
                s += '<li>' + values.mes_full + '<div class="percent-info green-text right">$ ' + number_format(values.t, 2, ",", ".") + '</div></li>';
            });

            $("#sales").empty().append(s);
            $("#t").empty().append("$ " + number_format(json.salesY.torder, 2, ",", "."));
            $("#c").empty().append(json.salesY.coorr);
            $("#p").empty().append(json.salesY.item);

            var array = $.map(json.salesGraph, function(value, index) {
                return [value];
            });

            var array2 = $.map(json.salesGraphDay, function(value, index) {
                return [value];
            });

            var array3 = $.map(json.productGraphYear, function(value, index) {
                return [value];
            });

             var array4 = $.map(json.salesGraphWeek, function(value, index) {
                return [value];
            });

            

            FusionCharts.ready(function() {
                var fusioncharts = new FusionCharts({
                    type: 'spline',
                    renderAt: 'chart-container',
                    width: '100%',
                    height: '400',
                    dataFormat: 'json',
                    dataSource: {
                        "chart": {
                            "caption": "Total de compras por este año",
                            "subCaption": "Anual",
                            "xAxisName": "Mes",
                            "yAxisName": "Compras",
                            "exportenabled": "1",
                            "exportatclient": "1",
                            "exporthandler": "http://export.api3.fusioncharts.com",
                            "html5exporthandler": "http://export.api3.fusioncharts.com",
                            "lineThickness": "5",
                            "paletteColors": "#0075c2",
                            "baseFontColor": "#333333",
                            "baseFont": "Helvetica Neue,Arial",
                            "captionFontSize": "14",
                            "subcaptionFontSize": "14",
                            "subcaptionFontBold": "0",
                            "numberPrefix": "$",
                            "showBorder": "1",
                            "bgColor": "#ffffff",
                            "showShadow": "0",
                            "canvasBgColor": "#ffffff",
                            "canvasBorderAlpha": "0",
                            "divlineAlpha": "100",
                            "divlineColor": "#999999",
                            "divlineThickness": "1",
                            "divLineIsDashed": "1",
                            "divLineDashLen": "1",
                            "divLineGapLen": "1",
                            "showXAxisLine": "1",
                            "xAxisLineThickness": "1",
                            "xAxisLineColor": "#999999",
                            "showAlternateHGridColor": "0",
                            "formatNumberScale": "0",
                            "decimalSeparator": ",",
                            "thousandSeparator": "."

                        },
                        "data": array,

                    }
                });

                var fusioncharts_pie = new FusionCharts({
                    type: 'pie3d',
                    renderAt: 'pieproduct',
                    width: '100%',
                    height: '400',
                    dataFormat: 'json',
                    dataSource: {
                        "chart": {
                            "caption": "Los 10 Productos Mas Adquiridos",
                            "subCaption": "Ultimo Año",
                            "numberPrefix": "U-",
                            "exportenabled": "1",
                            "exportatclient": "1",
                            "exporthandler": "http://export.api3.fusioncharts.com",
                            "html5exporthandler": "http://export.api3.fusioncharts.com",
                            "paletteColors": "#0075c2,#1aaf5d,#f2c500,#f45b00,#8e0000",
                            "bgColor": "#ffffff",
                            "showBorder": "0",
                            "use3DLighting": "0",
                            "showShadow": "0",
                            "enableSmartLabels": "0",
                            "startingAngle": "310",
                            "showLabels": "1",
                            "showPercentValues": "0",
                            "showLegend": "1",
                            "legendShadow": "0",
                            "legendBorderAlpha": "0",
                            "decimals": "0",
                            "captionFontSize": "14",
                            "subcaptionFontSize": "14",
                            "subcaptionFontBold": "0",
                            "toolTipColor": "#ffffff",
                            "toolTipBorderThickness": "0",
                            "toolTipBgColor": "#000000",
                            "toolTipBgAlpha": "80",
                            "toolTipBorderRadius": "2",
                            "toolTipPadding": "5",
                            "useDataPlotColorForLabels": "1"
                        },
                        "data": array3
                    }
                });

                

                var fusioncharts_week = new FusionCharts({
                    type: 'column2d',
                    renderAt: 'chart-week',
                    width: '100%',
                    height: '100%',
                    dataFormat: 'json',
                    dataSource: {
                        "chart": {
                            "caption": "Compras por semana",
                            "subCaption": "Ultimo mes",
                            "numberPrefix": "$",
                            "paletteColors": "#0075c2",
                            "exportenabled": "1",
                            "exportatclient": "1",
                            "exporthandler": "http://export.api3.fusioncharts.com",
                            "html5exporthandler": "http://export.api3.fusioncharts.com",
                            "subCaption": "Mes",
                            "xAxisName": "Semanas",
                            "yAxisName": "Compras",
                            "bgColor": "#ffffff",
                            "showBorder": "0",
                            "use3DLighting": "0",
                            "showShadow": "0",
                            "enableSmartLabels": "0",
                            "startingAngle": "310",
                            "showLabels": "1",
                            "showPercentValues": "0",
                            "showLegend": "1",
                            "legendShadow": "0",
                            "legendBorderAlpha": "0",
                            "decimals": "0",
                            "captionFontSize": "14",
                            "subcaptionFontSize": "14",
                            "subcaptionFontBold": "0",
                            "toolTipColor": "#ffffff",
                            "toolTipBorderThickness": "0",
                            "toolTipBgColor": "#000000",
                            "toolTipBgAlpha": "80",
                            "toolTipBorderRadius": "2",
                            "toolTipPadding": "5",
                            "useDataPlotColorForLabels": "1",
                            "formatNumberScale": "0",
                            "decimalSeparator": ",",
                            "thousandSeparator": "."
                        },
                        "data": array4
                    }
                });

                fusioncharts_week.render();
                fusioncharts.render();
                fusioncharts_pie.render();

            });

            FusionCharts.ready(function() {
                var fusioncharts_2 = new FusionCharts({
                    type: 'column2d',
                    renderAt: 'flotchart2',
                    width: '100%',
                    height: '100%',
                    dataFormat: 'json',
                    dataSource: {
                        "chart": {
                            "caption": "Total de compras por este mes",
                            "subCaption": "Anual",
                            "xAxisName": "Mes",
                            "yAxisName": "Compras",
                            "lineThickness": "5",
                            "exportenabled": "1",
                            "exportatclient": "1",
                            "exporthandler": "http://export.api3.fusioncharts.com",
                            "html5exporthandler": "http://export.api3.fusioncharts.com",
                            "paletteColors": "#0075c2",
                            "baseFontColor": "#333333",
                            "baseFont": "Helvetica Neue,Arial",
                            "captionFontSize": "14",
                            "subcaptionFontSize": "14",
                            "subcaptionFontBold": "0",
                            "numberPrefix": "$",
                            "showValues": "0",
                            "showBorder": "0",
                            "bgColor": "#ffffff",
                            "showShadow": "1",
                            "canvasBgColor": "#ffffff",
                            "canvasBorderAlpha": "0",
                            "divlineAlpha": "100",
                            "divlineColor": "#999999",
                            "divlineThickness": "1",
                            "divLineIsDashed": "1",
                            "divLineDashLen": "1",
                            "divLineGapLen": "1",
                            "showXAxisLine": "1",
                            "xAxisLineThickness": "1",
                            "xAxisLineColor": "#999999",
                            "showAlternateHGridColor": "0",
                            "formatNumberScale": "0",
                            "decimalSeparator": ",",
                            "thousandSeparator": "."

                        },
                        "data": array2,
                    }
                });
                fusioncharts_2.render();
            });
        });
    };
    getRecordMonth();
});