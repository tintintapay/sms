document.addEventListener("DOMContentLoaded", function () {


    // Filter buttons functionality (for Coordinators and Athletes)
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function () {
            const filterType = this.textContent.trim();
            filterList(filterType); // Apply the filtering function
        });
    });

    // View button functionality
    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', function () {
            const coordinatorName = this.parentElement.querySelector('.coordinator-name').textContent;
            viewCoordinator(coordinatorName); // Call function to view coordinator details
        });
    });


    // Example Chart.js update function
    function updateChart() {
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar', // Example chart type
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3], // Example data
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
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
    } updateChart();

    // Function to filter the list based on criteria
    function filterList(criteria) {
        alert(`Filtering list by: ${criteria}`);
        // Implement your filtering logic here
        // Example: Show/Hide specific items based on criteria
    }

    // Function to view coordinator details
    function viewCoordinator(name) {
        alert(`Viewing details for: ${name}`);
        // Implement the logic to display coordinator details
        // Example: Open a modal or redirect to another page
    }
});
