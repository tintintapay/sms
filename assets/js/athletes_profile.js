document.addEventListener('DOMContentLoaded', function() {
  const userRoleElement = document.getElementById('userRole');
  const userRole = userRoleElement.textContent.split(': ')[1].toLowerCase();

  // Show/Hide forms content based on role
  if (userRole !== 'admin' && userRole !== 'coordinator') {
      document.getElementById('formsContent').style.display = 'none';
  }

  // Disable star rating for non-admin/coordinator users
  if (userRole !== 'admin' && userRole !== 'coordinator') {
      const stars = document.querySelectorAll('.star');
      stars.forEach(star => {
          star.style.pointerEvents = 'none'; // Disable click events
          star.style.opacity = '0.5'; // Dim the stars to indicate they are not interactive
      });

      document.getElementById('allowance').style.pointerEvents = 'none'; // Disable click event
      document.getElementById('allowance').style.opacity = '0.5'; // Dim the text to indicate it is not interactive
  }
});

function rateStar(rating) {
  const userRole = document.getElementById('userRole').textContent.split(': ')[1].toLowerCase();
  if (userRole === 'admin' || userRole === 'coordinator') {
      const stars = document.querySelectorAll('.star');
      stars.forEach((star, index) => {
          if (index < rating) {
              star.classList.add('checked');
          } else {
              star.classList.remove('checked');
          }
      });
  } else {
      alert('You do not have permission to rate.');
  }
}

function withdrawAllowance() {
  const userRole = document.getElementById('userRole').textContent.split(': ')[1].toLowerCase();
  if (userRole === 'admin' || userRole === 'coordinator') {
      document.getElementById('updateAllowanceButton').style.display = 'block';
  } else {
      alert('You do not have permission to withdraw allowance.');
  }
}

function updateAllowance() {
  const userRole = document.getElementById('userRole').textContent.split(': ')[1].toLowerCase();
  if (userRole === 'admin' || userRole === 'coordinator') {
      const allowance = prompt('Enter new allowance amount:');
      if (allowance !== null) {
          document.getElementById('allowance').textContent = `Allowance: $${allowance}`;
          document.getElementById('updateAllowanceButton').style.display = 'none';
      }
  } else {
      alert('You do not have permission to update allowance.');
  }
}

function signOut() {
  alert('You have signed out.');
  window.location.href = 'login.html';
}

function validateCredentialUpload() {
  const fileInput = document.getElementById('uploadCredential');
  const uploadButton = document.getElementById('uploadCredentialButton');
  uploadButton.disabled = !fileInput.files.length;
}

function uploadCredential() {
  const fileInput = document.getElementById('uploadCredential');
  const fileList = document.getElementById('credentialFileList');
  const fileName = fileInput.files[0].name;
  const option = document.createElement('option');
  option.value = fileName;
  option.textContent = fileName;
  fileList.appendChild(option);
  fileInput.value = '';
  document.getElementById('uploadCredentialButton').disabled = true;
}

function printSelectedFile(listId) {
  const fileList = document.getElementById(listId);
  const selectedFile = fileList.options[fileList.selectedIndex];
  if (selectedFile) {
      alert(`Printing: ${selectedFile.value}`);
      // Implement print logic
  } else {
      alert('No file selected for printing.');
  }
}

function downloadSelectedFile(listId) {
  const fileList = document.getElementById(listId);
  const selectedFile = fileList.options[fileList.selectedIndex];
  if (selectedFile) {
      alert(`Downloading: ${selectedFile.value}`);
      // Implement download logic
  } else {
      alert('No file selected for downloading.');
  }
}

function printSchedule() {
  const scheduleImage = document.getElementById('scheduleImage');
  const newWindow = window.open();
  newWindow.document.write(`<img src="${scheduleImage.src}" alt="Basketball Schedule" width="100%" height="auto">`);
  newWindow.print();
  newWindow.close();
}

function applyEvaluation() {
  window.location.href = 'evaluation.html'; // Redirect to evaluation.html
}

function toggleDrawer() {
  const drawer = document.getElementById('drawer');
  drawer.classList.toggle('open');
}

function approve() {
  alert('Approval granted.');
  // Implement approval logic
}

function reject() {
  alert('Rejection issued.');
  // Implement rejection logic
}
