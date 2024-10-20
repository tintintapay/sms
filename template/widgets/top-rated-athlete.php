<canvas id="topAthletes"></canvas>

<script>
    const ctx7 = document.getElementById('topAthletes').getContext('2d');
    new Chart(ctx7, {
        type: 'bar',
        data: {
            labels: <?= $names ?>,
            datasets: [{
                label: 'Overall Rating',
                data: <?= $data ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>