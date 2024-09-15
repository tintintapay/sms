function fetchAthletes(school, sport) {
    const approvalInput = document.getElementById('approvalInput');
    
    // Clear the input field
    approvalInput.value = '';

    fetch(`fetch_athletes.php?school=${encodeURIComponent(school)}&sport=${encodeURIComponent(sport)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.length > 0) {
                approvalInput.value = data.map(athlete => `${athlete.first_name} ${athlete.middle_name ? athlete.middle_name + ' ' : ''}${athlete.last_name}`).join(', ');
            } else {
                approvalInput.value = 'No athletes found';
            }
        })
        .catch(error => {
            console.error('Error fetching athletes:', error);
        });
}
