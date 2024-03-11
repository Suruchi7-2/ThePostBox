<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

<!-- Latest minified bootstrap js -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- required sheet for using icon font  -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
    <!--required js axios library using cdn beacuse http request need this to make request to external api -->
    <script defer src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<style>
    /* Css file for Chatbbot */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

.chatbot-toggler {
    position: fixed;
    bottom: 30px;
    right: 35px;
    outline: none;
    border: none;
    height: 50px;
    width: 50px;
    display: flex;
    cursor: pointer;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #724ae8;
    transition: all 0.2s ease;
}

body.show-chatbot .chatbot-toggler {
    transform: rotate(90deg);
}

.chatbot-toggler span {
    color: #fff;
    position: absolute;
}

.chatbot-toggler span:last-child,
body.show-chatbot .chatbot-toggler span:first-child {
    opacity: 0;
}

body.show-chatbot .chatbot-toggler span:last-child {
    opacity: 1;
}

.chatbot {
    position: fixed;
    right: 35px;
    bottom: 90px;
    width: 420px;
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    opacity: 0;
    pointer-events: none;
    transform: scale(0.5);
    transform-origin: bottom right;
    box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1), 0 32px 64px -48px rgba(0, 0, 0, 0.5);
    transition: all 0.1s ease;
}

body.show-chatbot .chatbot {
    opacity: 1;
    pointer-events: auto;
    transform: scale(1);
}

.chatbot header {
    padding: 16px 0;
    position: relative;
    text-align: center;
    color: #fff;
    background: #724ae8;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.chatbot header span {
    position: absolute;
    right: 15px;
    top: 50%;
    display: none;
    cursor: pointer;
    transform: translateY(-50%);
}

header h2 {
    font-size: 1.4rem;
}

.chatbot .chatbox {
    overflow-y: auto;
    height: 510px;
    padding: 30px 20px 100px;
}

.chatbot :where(.chatbox,
textarea)::-webkit-scrollbar {
    width: 6px;
}

.chatbot :where(.chatbox,
textarea)::-webkit-scrollbar-track {
    background: #fff;
    border-radius: 25px;
}

.chatbot :where(.chatbox,
textarea)::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 25px;
}

.chatbox .chat {
    display: flex;
    list-style: none;
}

.chatbox .outgoing {
    margin: 20px 0;
    justify-content: flex-end;
}

.chatbox .incoming span {
    width: 32px;
    height: 32px;
    color: #fff;
    cursor: default;
    text-align: center;
    line-height: 32px;
    align-self: flex-end;
    background: #724ae8;
    border-radius: 4px;
    margin: 0 10px 7px 0;
}

.chatbox .chat p {
    white-space: pre-wrap;
    padding: 12px 16px;
    border-radius: 10px 10px 0 10px;
    max-width: 75%;
    color: #fff;
    font-size: 0.95rem;
    background: #724ae8;
}

.chatbox .incoming p {
    border-radius: 10px 10px 10px 0;
}

.chatbox .chat p.error {
    color: #721c24;
    background: #f8d7da;
}

.chatbox .incoming p {
    color: #000;
    background: #f2f2f2;
}

.chatbot .chat-input {
    display: flex;
    gap: 5px;
    position: absolute;
    bottom: 0;
    width: 100%;
    background: #fff;
    padding: 3px 20px;
    border-top: 1px solid #ddd;
}

.chat-input textarea {
    height: 55px;
    width: 100%;
    border: none;
    outline: none;
    resize: none;
    max-height: 180px;
    padding: 15px 15px 15px 0;
    font-size: 0.95rem;
}

.chat-input span {
    align-self: flex-end;
    color: #724ae8;
    cursor: pointer;
    height: 55px;
    display: flex;
    align-items: center;
    visibility: hidden;
    font-size: 1.35rem;
}

.chat-input textarea:valid~span {
    visibility: visible;
}

@media (max-width: 490px) {
    .chatbot-toggler {
        right: 20px;
        bottom: 20px;
    }
    .chatbot {
        right: 0;
        bottom: 0;
        height: 100%;
        border-radius: 0;
        width: 100%;
    }
    .chatbot .chatbox {
        height: 90%;
        padding: 25px 15px 100px;
    }
    .chatbot .chat-input {
        padding: 5px 15px;
    }
    .chatbot header span {
        display: block;
    }
}
</style>
<!-- ENd od css file for Chatbot toggle icon. -->
</head>
<body>
    <!-- Dashboard right side -->
<div class="dashboard d-flex justify-content-between">
  <!-- Slider lefft side -->
<div class="sidebar bg-dark sticky-top" style="top: 0; height: 100vh;">
            <h1 class="bg-primary p-4"><a href="dashboard.php"  class="text-light text-decoration-none">Dashboard</a></h1>
            <small class="text-light p-4 " style="font-family: 'Dancing Script', cursive"; >Welcome New User!</small><br><small class="text-light p-4 " style="font-family: 'Dancing Script', cursive"; >Let's Write,View nd more!!!.</small>
            <hr style="border-color: white; border-width: 4px;">
       
            
        <span class="menu p-2">
            <a href="create.php" class="text-light text-decoration-none btn btn-success" ><strong>Post Article</strong></a>
</span>
        <span class="menu p-2">
            <a href="logout.php" class="text-light text-decoration-none btn btn-danger" ><strong>Logout</strong></a>
</span>
<!-- Contact form -->
<br><br>
<div class="text-center">
<button class="btn btn-primary btn-lg" data-toggle="modal"  data-target="#modalForm">
    Contact Us
</button></div>

<!-- Modal -->
<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Contact Form</h4>
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" name="name" class="form-control" id="inputName" placeholder="Enter your name"/>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" name="email"  class="form-control" id="inputEmail" placeholder="Enter your email"/>
                    </div>
                    <div class="form-group">
                        <label for="inputMessage">Message</label>
                        <textarea class="form-control" name="message" id="inputMessage" placeholder="Enter your message"></textarea>
                    </div>
                </form>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitBtn" onclick="submitContactForm()">SUBMIT</button>
            </div>
            
        </div>
    </div>
</div>
</div>
    <!-- close -->
<!-- start chatbot -->
<br><br>

</div>  

<script>
function submitContactForm(){
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var name = $('#inputName').val();
    var email = $('#inputEmail').val();
    var message = $('#inputMessage').val();
    if(name.trim() == '' ){
        alert('Please enter your name.');
        $('#inputName').focus();
        return false;
    }else if(email.trim() == '' ){
        alert('Please enter your email.');
        $('#inputEmail').focus();
        return false;
    }else if(email.trim() != '' && !reg.test(email)){
        alert('Please enter valid email.');
        $('#inputEmail').focus();
        return false;
    }else if(message.trim() == '' ){
        alert('Please enter your message.');
        $('#inputMessage').focus();
        return false;
    }else{
        $.ajax({
            type:'POST',
            url:'submit_form.php',
            data:'contactFrmSubmit=1&name='+name+'&email='+email+'&message='+message,
            beforeSend: function () {
                $('.submitBtn').attr("disabled","disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success:function(msg){
                if(msg == 'ok'){
                    $('#inputName').val('');
                    $('#inputEmail').val('');
                    $('#inputMessage').val('');
                    $('.statusMsg').html('<span style="color:green;">Thanks for contacting us, we\'ll get back to you soon.</p>');
                }else{
                    $('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
                }
                $('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });
    }
}
 </script>
<!-- Chatbot html code -->
<div class="text-center"><button class="chatbot-toggler">
     Ask <span class="material-symbols-rounded">mode_comment</span>
      <span class="material-symbols-outlined">close</span>
    </button></div>
    <div class="chatbot">
        <header>
            <h2>Chatbot</h2>
            <span class="close-btn material-symbols-outlined">close</span>
        </header>
        <ul class="chatbox">
            <li class="chat incoming">
                <span class="material-symbols-outlined">smart_toy</span>
                <p>Hi there 👋<br>How can I help you today?</p>
            </li>
        </ul>
        <div class="chat-input">
            <textarea placeholder="Enter a message..." spellcheck="false" required></textarea>
            <span id="send-btn" class="material-symbols-rounded">send</span>
        </div>
    </div>
    <!-- end of html code for chatbot. -->
    <!-- This will be script file for chatbot where In real data will be sent to API server by converting into json file and sending http request with model an dbearer authorization .
 -->
    <script>
    const chatbotToggler = document.querySelector(".chatbot-toggler");
 const closeBtn = document.querySelector(".close-btn");
 const chatbox = document.querySelector(".chatbox");
 const chatInput = document.querySelector(".chat-input textarea");
 const sendChatBtn = document.querySelector(".chat-input span");

 let userMessage = null; // Variable to store user's message
 const API_KEY = ""; // Paste your API key here
 const inputInitHeight = chatInput.scrollHeight;

 const createChatLi = (message, className) => {
     // Create a chat <li> element with passed message and className
     const chatLi = document.createElement("li");
     chatLi.classList.add("chat", `${className}`);
     let chatContent = className === "outgoing" ? `<p> </p>` : `<span class="material-symbols-outlined">smart_toy</span > <p> </p>`;
     chatLi.innerHTML = chatContent;
     chatLi.querySelector("p").textContent = message;
     return chatLi; // return chat <li> element
 }

 const generateResponse = (chatElement) => {
     const API_URL = "https://api.openai.com/v1/chat/completions";
     const messageElement = chatElement.querySelector("p");

     // Define the properties and message for the API request
     const requestOptions = {
         method: "POST",
         headers: {
             "Content-Type": "application/json",
             "Authorization": `Bearer ${API_KEY}` // Move API key here
         },
         body: JSON.stringify({
             model: "gpt-3.5-turbo",
             messages: [{
                 role: "user",
                 content: userMessage
             }]
         })
     }

     // Send POST request to API, get response and set the reponse as paragraph text
     fetch(API_URL, requestOptions).then(res => res.json()).then(data => {
             messageElement.textContent = data.choices[0].message.content.trim();
         })
         .catch((error) => {
             console.error(error); // Log the error for debugging
             messageElement.classList.add("error");
             messageElement.textContent = "An error occurred while fetching the response. Please try again later.";
         })
         .finally(() => chatbox.scrollTo(0, chatbox.scrollHeight));
 }


 const handleChat = () => {
     userMessage = chatInput.value.trim(); // Get user entered message and remove extra whitespace
     if (!userMessage) return;

     // Clear the input textarea and set its height to default
     chatInput.value = "";
     chatInput.style.height = `${inputInitHeight}px`;

     // Append the user's message to the chatbox
     chatbox.appendChild(createChatLi(userMessage, "outgoing"));
     chatbox.scrollTo(0, chatbox.scrollHeight);

     setTimeout(() => {
         // Display "Thinking..." message while waiting for the response
         const incomingChatLi = createChatLi("Thinking...", "incoming");
         chatbox.appendChild(incomingChatLi);
         chatbox.scrollTo(0, chatbox.scrollHeight);
         generateResponse(incomingChatLi);
     }, 600);
 }

 chatInput.addEventListener("input", () => {
     // Adjust the height of the input textarea based on its content
     chatInput.style.height = `${inputInitHeight}px`;
     chatInput.style.height = `${chatInput.scrollHeight}px`;
 });

 chatInput.addEventListener("keydown", (e) => {
     // If Enter key is pressed without Shift key and the window 
     // width is greater than 800px, handle the chat
     if (e.key === "Enter" && !e.shiftKey && window.innerWidth > 800) {
         e.preventDefault();
         handleChat();
     }
 });

 sendChatBtn.addEventListener("click", handleChat);
 closeBtn.addEventListener("click", () => document.body.classList.remove("show-chatbot"));
 chatbotToggler.addEventListener("click", () => document.body.classList.toggle("show-chatbot")); 
</script>
<!-- End of chatbot script file -->
</body>
</html>