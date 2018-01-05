$(document).ready(function() {

    var loader = '<div class="preloader-wrapper small active">' +
        '<div class="spinner-layer spinner-blue-only">' +
        '<div class="circle-clipper left">' +
        '<div class="circle"></div>' +
        '</div><div class="gap-patch">' +
        '<div class="circle"></div>' +
        '</div><div class="circle-clipper right">' +
        '<div class="circle"></div>' +
        '</div>' +
        '</div>' +
        '</div>';

    var getRecordMonth = function() {

        $(".buy").empty().append(loader);
        $(".items").empty().append(loader);
        $(".prod").empty().append(loader);
        $(".c_week_b").empty().append(loader);
        $("#tb1").empty().append(loader);
        $(".c_week_a").empty().append(loader);


        $("#sales").empty().append(loader);
        $("#t").empty().append(loader);
        $("#c").empty().append(loader);
        $("#p").empty().append(loader);

        $("#chart-container").empty().append(loader);
        $("#pie_product").empty().append(loader);
        $("#pieproduct").empty().append(loader);
        $("#chart-week").empty().append(loader);
        $("#flotchart2").empty().append(loader);

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

            var array5 = $.map(json.salesGraphB, function(value, index) {
                return [value];
            });

            var array6 = $.map(json.productGraphMonth, function(value, index) {
                return [value];
            });

            var array7 = $.map(json.productGraphYearAfter, function(value, index) {
                return [value];
            });

            var array8 = $.map(json.productGraphYearBefore, function(value, index) {
                return [value];
            });

            var array9 = $.map(json.salesGraphForWeek, function (value, index) {
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
                            "exportenabled": "1",
                            "exportatclient": "1",
                            "exporthandler": "http://export.api3.fusioncharts.com",
                            "html5exporthandler": "http://export.api3.fusioncharts.com",
                            "xAxisName": "Mes",
                            "yAxisName": "Compras",
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
                        "dataset": [{
                            "seriesname": "Samsung",
                            "data": array
                        }]
                    }
                });
                var date = new Date();

                var fusioncharts_compare = new FusionCharts({
                    type: 'msspline',
                    renderAt: 'line-compare',
                    width: '100%',
                    height: '400',
                    dataFormat: 'json',
                    dataSource: {
                        "chart": {
                            "caption": "Comparativa de ventas "+parseInt(date.getFullYear()-1) +" - "+date.getFullYear(),
                            "subCaption": "Recurso Tamy SPA",
                            "captionFontSize": "14",
                            "subcaptionFontSize": "14",
                            "baseFontColor": "#333333",
                            "baseFont": "Helvetica Neue,Arial",
                            "subcaptionFontBold": "0",
                            "xAxisName": "Day",
                            "yAxisName": "No. of Visitor",
                            "showValues": "1",
                            "paletteColors": ",#1aaf5d,#0075c2",
                            "bgColor": "#ffffff",
                            "showBorder": "0",
                            "showShadow": "0",
                            "showAlternateHGridColor": "0",
                            "showCanvasBorder": "0",
                            "showXAxisLine": "1",
                            "xAxisLineThickness": "1",
                            "xAxisLineColor": "#999999",
                            "canvasBgColor": "#ffffff",
                            "legendBorderAlpha": "0",
                            "legendShadow": "0",
                            "divlineAlpha": "100",
                            "divlineColor": "#999999",
                            "divlineThickness": "1",
                            "divLineDashed": "1",
                            "divLineDashLen": "1",
                            "formatNumberScale": "0",
                            "decimalSeparator": ",",
                            "thousandSeparator": ".",
                            "numberPrefix": "$",
                        },
                        "categories": [{
                            "category": [{
                                "label": "Ene"
                            }, {
                                "label": "Feb"
                            }, {
                                "label": "Mar"
                            }, {
                                "label": "Abr"
                            }, {
                                "label": "May"
                            }, {
                                "label": "Jun"
                            }, {
                                "label": "Jul"
                            }, {
                                "label": "Ago"
                            }, {
                                "label": "Sep"
                            }, {
                                "label": "Oct"
                            }, {
                                "label": "Nov"
                            }, {
                                "label": "Dic"
                            }]
                        }],
                        "dataset": [{
                            "seriesname": "Año "+parseInt(date.getFullYear()-1),
                            "data": array7
                        }, {
                            "seriesname": "Año "+date.getFullYear(),
                            "data": array8
                        }]
                    }
                });

                fusioncharts_compare.render()

                var fusioncharts_pie_p = new FusionCharts({
                    type: 'pie3d',
                    renderAt: 'pie_product',
                    width: '100%',
                    height: '400',
                    dataFormat: 'json',
                    dataSource: {
                        "chart": {
                            "caption": "Los 10 Productos Mas Adquiridos este mes",
                            "subCaption": "Ultimo Mes",
                            "numberPrefix": "U-",
                            "paletteColors": "#0075c2,#1aaf5d,#f2c500,#f45b00,#8e0000",
                            "bgColor": "#ffffff",
                            "showBorder": "0",
                            "use3DLighting": "0",
                            "exportenabled": "1",
                            "exportatclient": "1",
                            "exporthandler": "http://export.api3.fusioncharts.com",
                            "html5exporthandler": "http://export.api3.fusioncharts.com",
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
                        "data": array6
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
                            "paletteColors": "#0075c2,#1aaf5d,#f2c500,#f45b00,#8e0000",
                            "bgColor": "#ffffff",
                            "showBorder": "0",
                            "use3DLighting": "0",
                            "exportenabled": "1",
                            "exportatclient": "1",
                            "exporthandler": "http://export.api3.fusioncharts.com",
                            "html5exporthandler": "http://export.api3.fusioncharts.com",
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
                            "subCaption": "Mes",
                            "xAxisName": "Semanas",
                            "exportenabled": "1",
                            "exportatclient": "1",
                            "exporthandler": "http://export.api3.fusioncharts.com",
                            "html5exporthandler": "http://export.api3.fusioncharts.com",
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


                var fusioncharts_sales_week = new FusionCharts({
                    type: 'column2d',
                    renderAt: 'chart-container-2',
                    width: '100%',
                    height: '400',
                    dataFormat: 'json',
                    dataSource: {
                        "chart": {
                            "caption": "Compras por semana",
                            "subCaption": "Ultimo mes",
                            "numberPrefix": "$",
                            "paletteColors": "#0075c2",
                            "subCaption": "Mes",
                            "xAxisName": "Semanas",
                            "exportenabled": "1",
                            "exportatclient": "1",
                            "exporthandler": "http://export.api3.fusioncharts.com",
                            "html5exporthandler": "http://export.api3.fusioncharts.com",
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
                        "data": array9
                    }
                });

                fusioncharts_week.render();
                fusioncharts.render();
                fusioncharts_pie.render();
                fusioncharts_pie_p.render();
                fusioncharts_sales_week.render();

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
                            "paletteColors": "#0075c2",
                            "baseFontColor": "#333333",
                            "baseFont": "Helvetica Neue,Arial",
                            "captionFontSize": "14",
                            "subcaptionFontSize": "14",
                            "subcaptionFontBold": "0",
                            "numberPrefix": "$",
                            "showValues": "0",
                            "showBorder": "0",
                            "exportenabled": "1",
                            "exportatclient": "1",
                            "exporthandler": "http://export.api3.fusioncharts.com",
                            "html5exporthandler": "http://export.api3.fusioncharts.com",
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