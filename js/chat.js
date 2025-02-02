const chatBox = document.getElementById('chat-box');
const userInput = document.getElementById('user-input');
const sendBtn = document.getElementById('send-btn');
const loading = document.getElementById('loading');

const API_URL = `https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=AIzaSyDL7UFLduxrTfwQVqU9eZ-gX68JW0He0DI`; // Replace with your actual API key

// Function to format the bot's response
function formatBotMessage(message) {
    // Example of formatting: adding bullet points
    const formattedMessage = message
        .replace(/•/g, '<li>') // Replace bullet points with list items
        .replace(/\n/g, '<br>'); // Replace new lines with line breaks
    return `<ul>${formattedMessage}</ul>`;
}

// Function to add a message to the chat box
function addMessageToChatBox(message, isUser) {
    const messageElement = document.createElement('div');
    messageElement.classList.add('message');
    messageElement.classList.add(isUser ? 'user-message' : 'bot-message');
    messageElement.innerHTML = message; // Use innerHTML to allow HTML formatting
    chatBox.appendChild(messageElement);
    chatBox.scrollTop = chatBox.scrollHeight; // Auto-scroll to the latest message
}

// Function to send user input to the Gemini API
async function sendMessageToGemini(message) {
    loading.style.display = 'block'; // Show loading animation
    const requestBody = {
        contents: [
            {
                parts: [
                    {
                        text: message,
                    },
                ],
            },
        ],
    };

    try {
        console.log('Sending request to API:', requestBody);
        const response = await fetch(API_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(requestBody),
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        console.log('Received response from API:', data);
        if (data.candidates && data.candidates.length > 0) {
            const botMessage = data.candidates[0].content.parts[0].text;
            const formattedMessage = formatBotMessage(botMessage);
            addMessageToChatBox(formattedMessage, false);
        } else {
            addMessageToChatBox('Sorry, no response from the bot.', false);
        }
    } catch (error) {
        console.error('Error:', error);
        addMessageToChatBox('Sorry, something went wrong. Please try again.', false);
    } finally {
        loading.style.display = 'none'; // Hide loading animation
    }
}

// Event listener for the send button
sendBtn.addEventListener('click', () => {
    const userMessage = userInput.value.trim();
    if (userMessage) {
        console.log('User message:', userMessage);
        addMessageToChatBox(userMessage, true);
        userInput.value = ''; // Clear input field
        sendMessageToGemini(userMessage);
    } else {
        console.log('No user message to send.');
    }
});

// Event listener for the Enter key
userInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        sendBtn.click();
    }
});