@include('templates.header')

<style>
    body {
      background-color: #f4f4f4; /* Background color for the whole page */
    }

    .announcement-title {
      text-align: center;
      margin: 20px 0;
      font-size: 2rem;
      font-weight: bold;
      color: #007bff; /* Change to your preferred color */
    }

    .chat-container {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-top: 20px; /* Spacing above the chat box */
    }

    .chat-header {
      background-color: #007bff;
      color: white;
      padding: 15px;
      text-align: center;
      font-weight: bold;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
    }

    .chat-window {
      overflow-y: auto;
      padding: 20px;
      background-color: #f9f9f9;
      max-height: 400px; /* Fixed height for chat messages */
    }

    .comment {
      display: flex;
      align-items: flex-start;
      margin-bottom: 15px;
      border-bottom: 1px solid #e9ecef;
      padding-bottom: 10px;
    }

    .comment:last-child {
      border-bottom: none; /* Remove border from last comment */
    }

    .comment .user-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      margin-right: 15px;
    }

    .comment .message-content {
      background-color: #e9ecef;
      padding: 10px 15px;
      border-radius: 10px;
      flex-grow: 1;
      width: 100%;
    }

    .chat-footer {
      display: flex;
      padding: 15px;
      background-color: #f8f9fa;
      border-bottom-left-radius: 10px;
      border-bottom-right-radius: 10px;
      align-items: center;
    }

    .chat-footer .form-control {
      border-radius: 30px;
      flex-grow: 1;
    }

    .chat-footer button {
      margin-left: 10px;
      border-radius: 30px;
    }
  </style>

<div id="layoutSidenav_content">
    <main>
        <div class="container">
            <div class="announcement-title">Comments</div>
          
            <!-- Chat Component -->
            <div class="chat-container">
              <div class="chat-window" id="chat-window"></div>
              <div class="chat-footer">
                <input type="text" autocomplete="off" class="form-control" id="comment-input" placeholder="Add a comment...">
                <button class="btn btn-primary" id="send-button">Send</button>
              </div>
            </div>
          </div>
    </main>
@include('templates.footer')

<script>
   // Helper function to format date and time
    function formatDateTime(dateString) {
      const date = new Date(dateString);
      const options = { year: 'numeric', month: 'short', day: 'numeric' }; // e.g., October 17, 2024
      const timeOptions = { hour: 'numeric', minute: 'numeric', hour12: true }; // e.g., 10:30 AM
      
      const formattedDate = date.toLocaleDateString(undefined, options);
      const formattedTime = date.toLocaleTimeString(undefined, timeOptions);
      
      return `${formattedDate} at ${formattedTime}`;
    }
    // Function to render comments to the chat window
    function renderComments(comments) {
      const chatWindow = document.getElementById('chat-window');
      chatWindow.innerHTML = ''; // Clear the chat window
  
      comments.forEach(comment => {
        const commentDiv = document.createElement('div');
        commentDiv.classList.add('comment');

        const userAvatar = document.createElement('img');
        userAvatar.src = '{{ asset("assets/img/user.png") }}';
        userAvatar.alt = 'User Avatar';
        userAvatar.classList.add('user-avatar');

        const messageContent = document.createElement('div');
        messageContent.classList.add('message-content');

        // Modified HTML structure to have name, time, and message in the desired order
        messageContent.innerHTML = `
          <strong>${comment.user.name}</strong>
          <div class="comment-time text-muted">${formatDateTime(comment.created_at)}</div>
          <p class="comment-text">${comment.comment}</p>
        `;

        commentDiv.appendChild(userAvatar);
        commentDiv.appendChild(messageContent);

        chatWindow.appendChild(commentDiv);
      });
    }
  
    // Fetch comments from the Laravel API
    function loadComments() {
      fetch('/getcomments')
        .then(response => response.json())
        .then(data => renderComments(data))
        .catch(error => console.error('Error fetching comments:', error));
    }
  
    // Call loadComments on page load
    window.onload = loadComments;
    // Automatically reload comments every 1 minute (60000 ms)
    setInterval(loadComments, 10000);

    // Add event listener to "Send" button
  document.getElementById('send-button').addEventListener('click', function() {
    const commentInput = document.getElementById('comment-input');
    const newComment = commentInput.value;

    if (newComment.trim()) {
      // Prepare data to send to the backend
      const data = {
        message: newComment
      };

      // Send comment to the Laravel API
      fetch('/comments', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
      })
      .then(response => response.json())
      .then(data => {
        // Clear the input field
        commentInput.value = '';

        // Reload comments after saving
        loadComments();
      })
      .catch(error => console.error('Error saving comment:', error));
    }
  });
  </script>
  
  
