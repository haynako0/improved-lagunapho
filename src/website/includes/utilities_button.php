<div class="utilities-container">
  <button id="utilitiesToggle" class="btn-utilities" title="Utilities">
    <i class="bi bi-tools"></i>
  </button>

  <div class="utilities-dropdown">
    <button class="utility-btn" id="darkModeBtn" title="Dark Mode">
      <i class="bi bi-moon-fill"></i>
      <span>Dark Mode</span>
    </button>

    <button class="utility-btn" id="chatbotBtn" title="Chatbot">
      <i class="bi bi-robot"></i>
      <span>Chatbot</span>
    </button>
  </div>

  <div class="chatbot-modal" id="chatbotModal">
    <div class="chatbot-header">
      <h5><i class="bi bi-robot"></i>PHO Assistant</h5>
      <div class="chatbot-controls">
        <button id="enlargeBtn" title="Enlarge"><i class="bi bi-arrows-angle-expand"></i></button>
        <button id="clearHistoryBtn" title="Clear History"><i class="bi bi-trash"></i></button>
        <button class="chatbot-close">&times;</button>
      </div>
    </div>
    <div class="chatbot-body">
      <div class="chatbot-messages">
        <div class="message bot">
          <p>Hello! How can I help you today?</p>
        </div>
      </div>
      <div class="chatbot-input">
        <input type="text" placeholder="Type your question...">
        <button><i class="bi bi-send-fill"></i></button>
      </div>
    </div>
  </div>
</div>

<style>
  .utilities-container {
    position: fixed;
    bottom: 20px;
    left: 20px;
    z-index: 9999;
  }

  .btn-utilities {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: var(--accent-color, #4154f1);
    color: white;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
    font-size: 1.2rem;
  }

  .btn-utilities:hover {
    transform: scale(1.1);
    background: var(--accent-hover, #6576ff);
  }

  .utilities-dropdown {
    position: absolute;
    bottom: 60px;
    left: 0;
    width: 160px;
    background: white;
    border-radius: 10px;
    padding: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: all 0.3s ease;
  }

  .utilities-container.active .utilities-dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
  }

  .utility-btn {
    width: 100%;
    padding: 8px 12px;
    margin: 4px 0;
    border: none;
    border-radius: 6px;
    background: transparent;
    color: #333;
    text-align: left;
    display: flex;
    align-items: center;
    cursor: pointer;
    transition: all 0.2s;
  }

  .utility-btn:hover {
    background: #f0f0f0;
  }

  .utility-btn i {
    margin-right: 10px;
    font-size: 1rem;
  }

  .chatbot-modal {
    position: fixed;
    bottom: 80px;
    left: 20px;
    width: 380px;
    height: 420px;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    display: none;
    z-index: 10000;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .chatbot-modal.enlarged {
    width: 900px;
    height: 600px;
  }

  .chatbot-header {
    padding: 16px;
    background: linear-gradient(135deg, #4154f1 0%, #6576ff 100%);
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 16px 16px 0 0;
  }

  .chatbot-header h5 {
    margin: 0;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .chatbot-controls {
    display: flex;
    gap: 8px;
    align-items: center;
  }

  .chatbot-controls button {
    background: rgba(255, 255, 255, 0.1);
    border: none;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    color: white;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .chatbot-controls button:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: scale(1.1);
  }

  .chatbot-body {
    padding: 12px;
    height: calc(100% - 56px);
    display: flex;
    flex-direction: column;
  }

  .chatbot-messages {
    flex-grow: 1;
    overflow-y: auto;
    padding: 8px;
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .message {
    padding: 12px 16px;
    border-radius: 16px;
    max-width: 85%;
    font-size: 0.9rem;
    line-height: 1.4;
    animation: messageAppear 0.3s ease forwards;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  }

  @keyframes messageAppear {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .message.bot {
    background: #ffffff;
    border: 1px solid #e0e0e0;
    align-self: flex-start;
  }

  .message.user {
    background: #4154f1;
    color: white;
    align-self: flex-end;
  }

  .chatbot-input {
    display: flex;
    gap: 8px;
    padding: 16px;
  }

  .chatbot-input input {
    flex-grow: 1;
    padding: 12px 16px;
    border: 1px solid #e0e0e0;
    border-radius: 20px;
    outline: none;
    transition: all 0.2s ease;
  }

  .chatbot-input input:focus {
    border-color: #4154f1;
    box-shadow: 0 0 0 3px rgba(65, 84, 241, 0.1);
  }

  .chatbot-input button {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: none;
    background: #4154f1;
    color: white;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .chatbot-input button:hover {
    background: #6576ff;
    transform: scale(1.05);
  }

  .chatbot-messages::-webkit-scrollbar {
    width: 6px;
  }

  .chatbot-messages::-webkit-scrollbar-track {
    background: #f8f9fa;
  }

  .chatbot-messages::-webkit-scrollbar-thumb {
    background: #4154f1;
    border-radius: 4px;
  }

  .chatbot-modal.enlarged .chatbot-messages .message {
    font-size: 1rem; /* larger text */
    padding: 16px 20px;
    max-width: 90%;
  }

  .dark-mode .chatbot-modal {
    background: rgba(36, 36, 36, 0.95);
    border: 1px solid #333;
  }

  .dark-mode .message.bot {
    background: #1e1e1e;
    border-color: #333;
    color: #e0e0e0;
  }

  .dark-mode .chatbot-input input {
    background: #1e1e1e;
    border-color: #333;
    color: #e0e0e0;
  }

  .dark-mode {
    --icon-color: #fff;
  }

  .dark-mode * {
    color: #fff !important;
  }

  .dark-mode .utility-btn i,
  .dark-mode .chatbot-controls button i {
    color: var(--icon-color) !important;
  }

  .dark-mode .btn-utilities:hover,
  .dark-mode .chatbot-input button:hover {
    background: #6576ff !important;
  }

  .dark-mode .utilities-dropdown {
    background: rgba(36, 36, 36, 0.95);
    border: 1px solid #333;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
  }

  .dark-mode .utility-btn {
    color: #e0e0e0 !important;
  }

  .dark-mode .utility-btn:hover {
    background: rgba(255, 255, 255, 0.1) !important;
  }

  .dark-mode .card {
    background-color: rgba(36, 36, 36, 0.95) !important;
    border: 1px solid #333 !important;
  }

  .dark-mode .btn-primary {
    background-color: var(--accent-color, #4154f1) !important;
    border-color: var(--accent-color, #4154f1) !important;
    color: white !important; /* Explicitly set text color */
  }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const utilitiesContainer = document.querySelector('.utilities-container');
  const utilitiesToggle = document.getElementById('utilitiesToggle');
  const darkModeBtn = document.getElementById('darkModeBtn');
  const chatbotBtn = document.getElementById('chatbotBtn');
  const chatbotModal = document.getElementById('chatbotModal');
  const chatMessages = document.querySelector('.chatbot-messages');
  const chatInput = document.querySelector('.chatbot-input input');
  const chatSendBtn = document.querySelector('.chatbot-input button');
  const enlargeBtn = document.getElementById('enlargeBtn');
  const clearHistoryBtn = document.getElementById('clearHistoryBtn');

  // Toggle utilities dropdown
  utilitiesToggle.addEventListener('click', () => {
    if (chatbotModal.style.display === 'block') {
      chatbotModal.style.display = 'none';
      utilitiesContainer.classList.add('active');
    } else {
      utilitiesContainer.classList.toggle('active');
    }
  });

  // Dark mode toggle
  darkModeBtn.addEventListener('click', () => {
    document.documentElement.classList.toggle('dark-mode');
    const isDark = document.documentElement.classList.contains('dark-mode');
    localStorage.setItem('darkMode', isDark ? 'enabled' : 'disabled');
    darkModeBtn.querySelector('i').classList.toggle('bi-moon-fill');
    darkModeBtn.querySelector('i').classList.toggle('bi-sun-fill');
    utilitiesContainer.classList.remove('active');
  });

  // Initialize dark mode
  if (localStorage.getItem('darkMode') === 'enabled') {
    document.documentElement.classList.add('dark-mode');
    darkModeBtn.querySelector('i').classList.replace('bi-moon-fill', 'bi-sun-fill');
  }

  // Chatbot toggle
  chatbotBtn.addEventListener('click', () => {
    chatbotModal.style.display = 'block';
    utilitiesContainer.classList.remove('active');
  });

  // Close chatbot
  document.querySelector('.chatbot-close').addEventListener('click', () => {
    chatbotModal.style.display = 'none';
  });

  // Chat message handling
  function appendMessage(text, isBot) {
    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${isBot ? 'bot' : 'user'}`;
    messageDiv.innerHTML = `<p>${text}</p>`;
    chatMessages.appendChild(messageDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;
    saveChatHistory();
  }

  async function handleSend() {
    const message = chatInput.value.trim();
    if (!message) return;

    appendMessage(message, false);
    chatInput.value = '';

    try {
      const response = await fetch('http://localhost:5000/predict', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ message })
      });
      const data = await response.json();
      appendMessage(data.answer, true);
    } catch (error) {
      console.error('Error:', error);
      appendMessage('Oops! Something went wrong.', true);
    }
  }

  // Chat history management
  function saveChatHistory() {
    const messages = Array.from(chatMessages.children).map(message => ({
      text: message.querySelector('p').innerHTML,
      isBot: message.classList.contains('bot')
    }));
    localStorage.setItem('chatHistory', JSON.stringify(messages));
  }

  function loadChatHistory() {
    const history = JSON.parse(localStorage.getItem('chatHistory')) || [];
    chatMessages.innerHTML = '';
    history.forEach(msg => appendMessage(msg.text, msg.isBot));
    if (history.length === 0) appendMessage('Hello! How can I help you today?', true);
  }

  function clearChatHistory() {
    if (confirm('Are you sure you want to clear all chat history?')) {
      localStorage.removeItem('chatHistory');
      chatMessages.innerHTML = '';
      appendMessage('Hello! How can I help you today?', true);
    }
  }

  // Enlarge functionality
  function toggleChatSize() {
    chatbotModal.classList.toggle('enlarged');
    enlargeBtn.querySelector('i').classList.toggle('bi-arrows-angle-expand');
    enlargeBtn.querySelector('i').classList.toggle('bi-arrows-angle-contract');
    localStorage.setItem('chatSize', chatbotModal.classList.contains('enlarged') ? 'enlarged' : 'normal');
  }

  // Initialize chat
  loadChatHistory();
  if (localStorage.getItem('chatSize') === 'enlarged') toggleChatSize();

  // Event listeners
  chatSendBtn.addEventListener('click', handleSend);
  chatInput.addEventListener('keypress', e => e.key === 'Enter' && handleSend());
  enlargeBtn.addEventListener('click', toggleChatSize);
  clearHistoryBtn.addEventListener('click', clearChatHistory);

  // Close dropdown when clicking outside
  document.addEventListener('click', e => {
    if (!utilitiesContainer.contains(e.target)) {
      utilitiesContainer.classList.remove('active');
    }
  });
});
</script>