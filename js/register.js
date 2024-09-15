document.addEventListener('DOMContentLoaded', () => {
  const sportsDropdown = document.getElementById('sports-dropdown');
  const sportsInput = document.getElementById('sports');

  const sportsOptions = [
    'Basketball',
    'Football',
    'Volleyball',
    'Tennis',
    'Badminton',
    'Swimming',
    'Table Tennis',
    'Baseball'
  ];

  sportsInput.addEventListener('input', () => {
    const inputValue = sportsInput.value.toLowerCase();
    sportsDropdown.innerHTML = '';

    if (inputValue) {
      const filteredOptions = sportsOptions.filter(sport => 
        sport.toLowerCase().includes(inputValue)
      );

      filteredOptions.forEach(option => {
        const div = document.createElement('div');
        div.textContent = option;
        div.addEventListener('click', () => {
          sportsInput.value = option;
          sportsDropdown.innerHTML = '';
          sportsInput.focus();
        });
        sportsDropdown.appendChild(div);
      });

      sportsDropdown.classList.add('active');
    } else {
      sportsDropdown.classList.remove('active');
    }
  });

  document.addEventListener('click', (e) => {
    if (!sportsDropdown.contains(e.target) && e.target !== sportsInput) {
      sportsDropdown.classList.remove('active');
    }
  });

  const form = document.querySelector('form'); // Ensure the form selector matches your HTML
  form.addEventListener('submit', (e) => {
    e.preventDefault(); // Prevent form submission for demonstration

    // Show the validation message
    alert('Please wait for 24 hours for registration approval.');

    // Redirect to login page
    window.location.href = 'athletes-login.html';
  });
});
