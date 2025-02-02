<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gemini Chatbot</title>
  <link rel="stylesheet" href="../css/chat.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <div class="chat-container">
    <div class="chat-header">
      <h2><i class="fas fa-robot"></i> Umrah Guide Assistant</h2>
    </div>
    <div class="chat-box" id="chat-box">
      <!-- Chat messages will appear here -->
    </div>
    <div class="chat-input">
      <input type="text" id="user-input" placeholder="Type a message..." />
      <button id="send-btn" title="Send"><i class="fas fa-paper-plane"></i></button>
    </div>
    <div class="loading" id="loading">
      <div class="dot-flashing"></div>
    </div>
  </div>
  <script src="../js/chat.js"></script>
</body>
</html>