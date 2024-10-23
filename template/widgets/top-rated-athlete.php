<div id="topAthletes"></div>

<script>

    var options = {
        series: [{
            name: 'Data',
            data: <?= $data ?>
        }],
        chart: {
            height: 350,
            type: 'bar',
        },
        plotOptions: {
            bar: {
                borderRadius: 0,
                dataLabels: {
                    position: 'center', // top, center, bottom
                },
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val + "";
            },
            offsetY: -20,
            style: {
                fontSize: '12px',
                colors: ["#304758"]
            }
        },

        xaxis: {
            categories: <?= $names ?>,
            position: 'top',
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            crosshairs: {
                fill: {
                    type: 'gradient',
                    gradient: {
                        colorFrom: '#D8E3F0',
                        colorTo: '#BED1E6',
                        stops: [0, 100],
                        opacityFrom: 0.4,
                        opacityTo: 0.5,
                    }
                }
            },
            tooltip: {
                enabled: true,
            }
        },
        yaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false,
            },
            labels: {
                show: false,
                formatter: function (val) {
                    return val + "";
                }
            }

        },
        title: {
            text: '<?= date('F') ?> Top Rated Athletes',
            floating: true,
            offsetY: 0,
            align: 'center',
            style: {
                color: '#444',
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#topAthletes"), options);
    chart.render();
</script>