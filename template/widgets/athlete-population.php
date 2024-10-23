<!-- <p><strong>Total: </strong><?= $totalPopulation ?></p> -->
<div id="sportDistribution"></div>
<script>
    var options = {
        title: {
            text: 'Population: <?= $totalPopulation ?>', // Here you set the title
            align: 'center', // Title alignment (left, center, right)
            style: {
                fontSize: '20px', // Title font size
                fontWeight: 'bold', // Title font weight
                color: '#263238' // Title color
            }
        },
        series: <?= $data ?>,
        chart: {
            width: 380,
            type: 'pie',
            toolbar: {
                show: true,
                offsetX: 0,
                offsetY: 0,
                tools: {
                    download: true,
                    selection: true,
                    zoom: true,
                    zoomin: true,
                    zoomout: true,
                    pan: true,
                    reset: true | '<img src="/static/icons/reset.png" width="20">',
                    customIcons: []
                },
                export: {
                    svg: {
                        filename: undefined,
                    },
                    png: {
                        filename: undefined,
                    }
                },
                autoSelected: 'zoom'
            },
        },
        dataLabels: {
            enabled: true,
            offsetX: -30
        },
        labels: <?= $sport ?>,
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#sportDistribution"), options);
    chart.render();
</script>