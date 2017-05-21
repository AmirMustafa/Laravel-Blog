var tid = setInterval(function () {             //This function automatically gets automatically gets executed after 100 milliseconds
    if (document.readyState !== "complete") {
        return;
    }
    clearInterval(tid);             //This clears the time interval set by setInterval
                                    //selecting below class to get array of contact messages

    var contactMessages = document.getElementsByClassName('contact-message');      //see admin/other/contact-messages.js Line 18 (accessing that class)

    for (i = 0; i < contactMessages.length; i++) {     //looping through the array - we will fire three event listeners i.e. modalOpen, modalContent, deleteContactMessage
        contactMessages[i].getElementsByTagName('li')[0].firstElementChild.addEventListener('click', modalOpen);
        contactMessages[i].getElementsByTagName('li')[0].firstElementChild.addEventListener('click', modalContent);
        contactMessages[i].getElementsByTagName('li')[1].firstElementChild.addEventListener('click', deleteContactMessage);
    }

    document.getElementById('modal-close').addEventListener('click', modalClose);


}, 100);

function modalContent(event) {  //This function will inject modal actual message
    event.preventDefault();
    var subject = event.path[5].firstElementChild.firstElementChild.innerText; //admin/other/contact-messages.blade.php line 26 to 18 and its two immediate child to access {{ $contact_message->subject }}
    var sender = event.path[5].lastElementChild.firstElementChild.innerText;    //getting sending info like above line same page
    var messageBody = event.path[5].dataset['message'];                         //getting sending info like above line same page
    var modal = document.getElementsByClassName('modal')[0];       //selecting modal
    var modalSubject = document.createElement('h1');        //creating h1 tag through js for modal subject
    var modalSender = document.createElement('h3');         //creating h3 tag through js for modal sender
    var modalMessage = document.createElement('p');         //creating p tag through js for modal message
   
    modalSubject.innerText = subject;   //assigning all the three values in new element ie. h1, h3 and p created
    modalSender.innerText = sender;
    modalMessage.innerText = messageBody;
   
    modal.insertBefore(modalMessage, modal.childNodes[0]);  //message must be added before sender
    modal.insertBefore(modalSender, modal.childNodes[0]);   //sender must be added before subject
    modal.insertBefore(modalSubject, modal.childNodes[0]);  //subject must be in the end
}

function deleteContactMessage(event) {            //function for delete message
    event.preventDefault();                       //prevents default action
    event.target.removeEventListener('click', deleteContactMessage);    //removing event listeners
    var messageId = event.path[5].dataset['id'];
    ajax("GET", "/admin/contact/message/" + messageId + "/delete", null, messageDeleted, [event.path[5]]);
}                                                       //calling ajax with messageDeleted callback function

function messageDeleted(params, success, responseObj) { //here we will set delete animation
    var article = params[0];        //article will be the first params passed in this function
    if (success) {
        article.style.backgroundColor = "#ffc4be";  //setting background color
        setTimeout(function() {
            article.remove();       //wait for remove after transition flash effect
        }, 300);
    }
}

function ajax(method, url, params, callback, callbackParams) {  //definition of ajax
    var http;

    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        http = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        http = new ActiveXObject("Microsoft.XMLHTTP");
    }

    http.onreadystatechange = function() {
        if (http.readyState == XMLHttpRequest.DONE ) {
            if(http.status == 200){                            // good case
                var obj = JSON.parse(http.responseText);
                callback(callbackParams, true, obj);
            }
            else if(http.status == 400) {                       //error case
                alert("Category could not be saved. Please try again!");
                callback(callbackParams, false);

            }
            else {                                              //validation error case
                var obj = JSON.parse(http.responseText);
                if (obj.message) {               //if message is received that message is definitely validation error message.
                    alert(obj.message);         // i.e show validation error
                } else {
                    alert("Please check the name");
                }
                callback(callbackParams, false);
            }
        }
    };

    http.open(method, baseUrl + url, true);         //this baseUrl is coming from views/layouts/admin-master.blade.php
    http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    http.setRequestHeader('X-Requested-With', 'XMLHttpRequest');//Line 42 helps Laravel to identify as a AJAX Request and thus send appropriate response
    http.send(params + "&_token=" + token);     //we must send params and token for Laravel
}