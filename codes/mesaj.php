<div id="chat-history" class="mt-3 p-2 chatH" style="overflow-x: hidden; overflow-y: scroll; height:500px; width:100%; background-color:bisque"></div>
<div class="navbarx" style="width:100%;">
  <div id="chat-container" class="mt-2 bg-white shadow-md">
      
  <input type=“text” id="chat-input" placeholder="mesajınızı buraya yazınız…" class="py-2 px-3 border border-gray sm:text-sm w-100 m-0 rounded-pill">
  
   </div>
      <button id="chat-fix" class="mt-2 px-4 py-2 bg-indigo-600 text-danger rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 rounded-3" >Al</button>
      <button id="chat-send" class="mt-2 px-4 py-2 bg-indigo-600 text-danger rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 rounded-3">Gönder</button>

</div>
  <script>
  const chatHistory = document.querySelector('#chat-history');
  const chatInput = document.querySelector('#chat-input');
  const chatSend = document.querySelector('#chat-send');
  const chatfix = document.querySelector('#chat-fix');
  function sendMessage(message, receiver) {
  const messageElement = document.createElement('div');
  messageElement.classList.add('message');
  messageElement.classList.add(receiver ? 'receiver' : 'sender');
  messageElement.textContent = message;
  messageElement.style.padding = '10px';
  messageElement.style.maxWidth = '60%';
  messageElement.style.backgroundColor = receiver ? 'lightblue' : 'lightgreen';
  messageElement.style.color = 'black';
  messageElement.style.display = 'inline-block';
  messageElement.style.textAlign = receiver ? 'left' : 'right';
  chatHistory.appendChild(messageElement);
  chatHistory.scrollTop = chatHistory.scrollHeight;
}
function sendMessages(message, sender) {
  const messageElement = document.createElement('div');
  messageElement.classList.add('message');
  messageElement.classList.add(sender ? 'sender' : 'receiver');
  messageElement.textContent = message;
  messageElement.style.padding = '10px';
  messageElement.style.maxWidth = '60%';
  messageElement.style.backgroundColor = sender ? 'lightgreen' : 'lightblue';
  messageElement.style.color = 'black';
  messageElement.style.display = 'inline-block';
  messageElement.style.textAlign = sender ? 'right' : 'left';
  chatHistory.appendChild(messageElement);
  chatHistory.scrollTop = chatHistory.scrollHeight;
}


chatSend.addEventListener('click', () => {
  const message = chatInput.value;
  if (message) { // mesaj boş değilse
    sendMessages(message, true);
    chatInput.value = '';
  }
});
chatfix.addEventListener('click', () => {
  const message = chatInput.value;  
  if (message) { // mesaj boş değilse
    sendMessage(message, true);
    chatInput.value = '';
  }
});
chatInput.addEventListener('keydown', (event) => {
  if (event.key === 'Enter') {
    const message = chatInput.value;
    if (message) { // mesaj boş değilse
      sendMessage(message, false);
      chatInput.value = '';
    }
  }
});
</script>



