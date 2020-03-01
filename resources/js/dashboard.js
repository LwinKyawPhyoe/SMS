import Highcharts from 'highcharts';
import Exporting from 'highcharts/modules/exporting';
Exporting(Highcharts);

export const Dashboard = {
    generatePieChart(id, d) 
    {
        Highcharts.setOptions({
            lang: {
              thousandsSep: ','
          }
        });

        Highcharts.chart(id,
            {
                chart : { plotBackgroundColor : null, plotBorderWidth : null, plotShadow : false, type : 'pie' },
                title : { text : '' },
                tooltip : { pointFormat : '</b>{point.y:,.0f}</b>' },
                plotOptions : {
                    pie : {
                        innerSize: 80,
                        depth: 45,
                        allowPointSelect : true,
                        cursor : 'pointer',
                        dataLabels : {
                            enabled : false,
                            format : '{point.y:,.0f}',
                            style : { color : (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black' }
                        },
                        showInLegend : true
                    }
                },
                exporting: { enabled: false },
                credits : { enabled : false },
                series : [{ name : 'Brands', colorByPoint : true, data : d }]
            }
        );
    },

    generateLineChart(id, d)
    {
        Highcharts.setOptions({
            lang: {
              thousandsSep: ','
          }
        });

        Highcharts.chart(id, 
            {
                title: { text: 'Total Attendance In A Year'},
                yAxis: {
                    title: { text: 'Attendance(%)'},
                    labels: {
                        format: '{value}%'
                    }
                },
                xAxis: {
                    categories: ['Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec','Jan','Feb','Mar'],
                    crosshair: true
                },
                tooltip : { pointFormat : '<b>{point.y:,.0f}%</b>' },
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                },
                exporting: { enabled: false },
                credits : { enabled : false },
                series: d,
            }
        );
    }
}