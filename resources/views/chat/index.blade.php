@extends('layouts.app')

<head>
				<!-- Font Awesome -->
				<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

				<!-- Additional Styles for Chat -->
				<style>
								/* Home View Styling */
								body {
												background-color: black;
												color: white;
								}

								/* Chat Container */
								.chat-container {
												max-width: 900px;
												background: black;
												padding: 20px;
												border-radius: 10px;
												box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.1);
												display: flex;
												flex-direction: column;
												height: 80vh;
												margin-top: 20px;
								}

								/* Chat Box */
								.chat-box {
												flex-grow: 1;
												overflow-y: auto;
												border: 1px solid #fff;
												border-radius: 10px;
												background: black;
												display: flex;
												flex-direction: column;
												padding: 15px;
								}

								/* Message Styling */
								.message {
												display: flex;
												align-items: center;
												margin-bottom: 10px;
								}

								.msg-bubble {
												max-width: 70%;
												padding: 10px;
												border-radius: 15px;
												word-wrap: break-word;
												display: flex;
												align-items: center;
												box-shadow: 2px 2px 5px rgba(255, 255, 255, 0.1);
								}

								/* Alternate Message Positions */
								.user {
												align-self: flex-end;
												justify-content: flex-end;
												min-width: 50%;
								}

								.bot {
												align-self: flex-start;
												justify-content: flex-start;
								}

								/* User Messages */
								.user .msg-bubble {
												background-color: #007bff;
												color: white;
												text-align: right;
								}

								.user .msg-bubble i {
												margin-left: 10px;
								}

								/* Bot Messages */
								.bot .msg-bubble {
												background-color: white;
												color: black;
												text-align: left;
								}

								.bot .msg-bubble i {
												margin-right: 10px;
								}

								/* Input Styling */
								.input-group input {
												border-radius: 20px;
												background-color: black;
												color: white;
												border: 1px solid white;
								}

								.input-group input::placeholder {
												color: #ccc;
								}

								.btn-primary {
												border-radius: 50%;
												background-color: white;
												color: black;
												border: 1px solid white;
								}

								.btn-primary:hover {
												background-color: #f8f9fa;
												color: black;
								}
				</style>
</head>


@section('content')
				<div class="container chat-container">
								<!-- Chat Window -->
								<div class="chat-box" id="chatBox">
												<div id="messages">
																<div class="message bot">
																				<div class="msg-bubble">
																								<i class="fas fa-robot"></i>
																								<p>Hello! How can I help you today?</p>
																				</div>
																</div>
												</div>
								</div>

								<!-- User Input -->
								<div class="input-group mt-3">
												<input id="userInput" type="text" class="form-control" placeholder="Type a message..." />
												<button id="sendBtn" class="btn btn-primary" onclick="">
																<i class="fas fa-paper-plane"></i>
												</button>
								</div>
				</div>


				{{--  @push('scripts')  --}}
				<script>
								document.addEventListener('DOMContentLoaded', function() {
												const sendButton = document.getElementById('sendBtn');
												const userInput = document.getElementById('userInput');
												const messagesDiv = document.getElementById('messages');
												const chatBox = document.getElementById('chatBox');

												sendButton.addEventListener('click', sendMessage);
												userInput.addEventListener('keyup', function(e) {
																if (e.key === 'Enter') sendMessage();
												});

												function sendMessage() {
																const inputText = userInput.value.trim();
																if (inputText !== "") {
																				// Add user message to chat
																				const userMessageDiv = document.createElement('div');
																				userMessageDiv.classList.add('message', 'user');
																				userMessageDiv.innerHTML = `
                <div class="msg-bubble">
                    <i class="fas fa-user"></i>
                    <p>${inputText}</p>
                </div>
            `;
																				messagesDiv.appendChild(userMessageDiv);

																				// Scroll to bottom of chat
																				chatBox.scrollTop = chatBox.scrollHeight;

																				// Send user message to backend (AJAX)
																				axios.post('/api/chat/send', {
																												message: inputText
																								})
																								.then(response => {
																												const botMessageDiv = document.createElement('div');
																												botMessageDiv.classList.add('message', 'bot');
																												botMessageDiv.innerHTML = `
                        <div class="msg-bubble">
                            <i class="fas fa-robot"></i>
                            <p>${response.data.message}</p>
                        </div>
                    `;
																												messagesDiv.appendChild(botMessageDiv);
																												chatBox.scrollTop = chatBox.scrollHeight; // Scroll to bottom again
																								})
																								.catch(error => {
																												console.error('Error sending message:', error);
																								});

																				// Clear input field
																				userInput.value = '';
																}
												}
								});
				</script>
				{{--  @endpush  --}}
@endsection
