$(function() {
	var DrawSparkline = function() {
        
        var linePoints = [0, 1, 3, 2, 1, 1, 4];
        $('#sparkline-line').sparkline(linePoints, {
            type: 'line',
            width: 'calc(100% + 4px)',
            height: '45',
            chartRangeMax: 13,
            lineColor: '#ffb74d',
            fillColor: 'rgba(255,183,77,0.3)',
            highlightLineColor: 'rgba(0,0,0,0)',
            highlightSpotColor: 'rgba(0,0,0,.2)',
            tooltip: false
        });
        
        var barParent = $('#sparkline-bar').closest('.card');
        var barPoints = [0, 1, 3, 2, 1, 1, 4];
        var barWidth = 6;
        $('#sparkline-bar').sparkline(barPoints, {
            type: 'bar',
            height: $('#sparkline-bar').height() + 'px',
            width: '100%',
            barWidth: barWidth,
            barSpacing: (barParent.width() - (barPoints.length * barWidth)) / barPoints.length,
            barColor: 'rgba(0,0,0,.07)',
            tooltipFormat: ' <span style="color: #ccc">&#9679;</span> {{value}}</span>'
        });
        
    };

    DrawSparkline();

    var flot1 = function () {
        var data = [[0, 50], [1, 42], [2, 40], [3, 65], [4, 48], [5, 56], [6, 80]];
        var data2 = [[0, 25], [1, 19], [2, 20], [3, 35], [4, 23], [5, 28], [6, 45]];
        var dataset =  [
            {
                data: data,
                color: "#E0E0E0",
                lines: {
                    show: true,
                    fill: 0.4,
                },
                shadowSize: 0,
            }, {
                data: data,
                color: "#E0E0E0",
                lines: {
                    show: false,
                },
                points: {
                    show: true,
                    fill: true,
                    radius: 4,
                    fillColor: "#fff",
                    lineWidth: 2
                },
                curvedLines: {
                    apply: false,
                },
                shadowSize: 0
            }, {
                data: data2,
                color: "#26A69A",
                lines: {
                    show: true,
                    fill: 0.4,
                },
                shadowSize: 0,
            },{
                data: data2,
                color: "#26A69A",
                lines: {
                    show: false,
                },
                curvedLines: {
                    apply: false,
                },
                points: {
                    show: true,
                    fill: true,
                    radius: 4,
                    fillColor: "#fff",
                    lineWidth: 2
                },
                shadowSize: 0
            }
        ];
        
        var ticks = [[0, "Mon"], [1, "Tue"], [2, "Wed"], [3, "Thu"], [4, "Fri"], [5, "Sat"], [6, "Sun"]];

        var plot1 = $.plot("#flotchart1", dataset, {
            series: {
                color: "#14D1BD",
                lines: {
                    show: true,
                    fill: 0.2
                },
                shadowSize: 0,
                curvedLines: {
                    apply: true,
                    active: true
                }
            },
            xaxis: {
                ticks: ticks,
            },
            legend: {
                show: false
            },
            grid: {
                color: "#AFAFAF",
                hoverable: true,
                borderWidth: 0,
                backgroundColor: '#FFF'
            },
            tooltip: true,
            tooltipOpts: {
                content: "%yK",
                defaultTheme: false
            }
        });
        
    };
    
    flot1();

});