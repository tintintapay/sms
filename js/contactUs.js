document.addEventListener('DOMContentLoaded', () => {
  const contactButton = document.getElementById('contactButton');
  const chatbot = document.getElementById('chatbot');
  const sendMessageButton = document.getElementById('sendMessage');
  const messageInput = document.getElementById('messageInput');
  const chatbotBody = document.getElementById('chatbotBody');
  const exitButton = document.getElementById('exitChatbot');

  // Check if elements are correctly selected
  console.log({ contactButton, chatbot, sendMessageButton, messageInput, chatbotBody, exitButton });

  if (!contactButton || !chatbot || !sendMessageButton || !messageInput || !chatbotBody || !exitButton) {
    console.error('One or more elements are not found.');
    return;
  }

  // Toggle chatbot visibility and display welcome message
  contactButton.addEventListener('click', () => {
    if (chatbot.style.display === 'none' || chatbot.style.display === '') {
      chatbot.style.display = 'flex';
      displayWelcomeMessage(); // Show welcome message when chatbot is opened
    } else {
      chatbot.style.display = 'none';
    }
  });

  // Send message when send button is clicked
  sendMessageButton.addEventListener('click', () => {
    sendMessage();
  });

  // Send message when Enter key is pressed
  messageInput.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
      event.preventDefault(); // Prevent newline in the input field
      sendMessage();
    }
  });

  // Exit chatbot when exit button is clicked
  exitButton.addEventListener('click', () => {
    chatbot.style.display = 'none';
  });

  // Function to send a message
  function sendMessage() {
    const message = messageInput.value.trim();
    if (message) {
      addMessageToChat('user-message', message);
      messageInput.value = '';
      chatbotBody.scrollTop = chatbotBody.scrollHeight; // Scroll to bottom
      simulateBotResponse();
    }
  }

  // Add message to chat
  function addMessageToChat(type, message) {
    const timestamp = new Date().toLocaleString(); // Get real-time date and time
    const messageElement = document.createElement('div');
    messageElement.className = `chatbot-message ${type}`;
    messageElement.innerHTML = `
      <div class="chatbot-text">${message}</div>
      <div class="chatbot-time">${timestamp}</div>
    `;
    chatbotBody.appendChild(messageElement);
  }

  // Simulate a bot response
  function simulateBotResponse() {
    setTimeout(() => {
      addMessageToChat('bot-message', 'Thank you for reaching out! How can I assist you today?');
    }, 1000);
  }

  // Function to display welcome message with contact information
  function displayWelcomeMessage() {
    const email = '21_67906@gmail.com';
    const phone = '09123456789';
    const welcomeMessage = `
      Welcome! You can reach us at <strong>${email}</strong> or <strong>${phone}</strong>.
    `;
    addMessageToChat('bot-message', welcomeMessage);
  }

  // Initialize chatbot to be hidden
  chatbot.style.display = 'none';
});
