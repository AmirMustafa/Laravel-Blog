var docReady = setInterval(function() {         //This function automatically gets automatically gets executed after 100 milliseconds
    if(document.readyState !== "complete") {
        return;
    }
    clearInterval(docReady);                    //This clears the time interval set by setInterval

    var editSections = document.getElementsByClassName('edit'); //receiving the edit section button by class

    var i = 0;
    for(i=0; i<editSections.length; i++) {                                  //startEdit is the function edit 
        editSections[i].firstElementChild.firstElementChild.children[1].firstChild.addEventListener('click', startEdit);
                /*as inside div.edit > ul > li (2nd element)> Its first element > oncicking this action will triger in category.blade.php page*/
         editSections[i].firstElementChild.firstElementChild.children[2].firstChild.addEventListener('click', startDelete);        
        
    }

    document.getElementsByClassName('btn')[0].addEventListener('click', createNewCategory);
                                                    //adding event on click with core js, fetching class of category button

}, 100);

function createNewCategory(event) {
    event.preventDefault();                     //This prevent the default action and form dosen't gets submitted
    var name = event.target.previousElementSibling.value;  //This will get just the previous field before button i.e. input field 

    if(name.length === 0) {
        alert("Please enter a valid category name");
        return;
    }
        //method, route address, parameter, callback, callbackparameters
    ajax("POST", "/admin/blog/category/create", "name=" + name, newCategoryCreated, [name]);
}                                       //calling ajax function and passing values


function newCategoryCreated(params, success, responseObj) {
    location.reload();
}

function startEdit(event) {
    event.preventDefault();                             //This will prevent default action
    event.target.innerText = "Save";                    //Changing the text of Edit to save on clicking edit as i/p field will come and instead of edit save option will show
    var li = event.path[2].children[0];     //my pointer is in edit link, my i/p field is two element up and its first child is i/p field

    li.children[0].value = event.path[4].previousElementSibling.children[0].innerText;
        //i/p value = category.blade.php we have to go from line 30 to line(i.e. i/p box) to line25(where we are getting    value i.e. {{ $category->name }})
        //actually before editing we want to fill i/p box with current value, therefore moved 4 path/element up and its first child

    li.style.display = "inline-block";  //now once we get the data we want to style to inline-block(earlier i/p box was hidden defined that in css file)

    setTimeout(function() {     //This function is for sliding i/p box effect while clicking edit button
        li.children[0].style.maxWidth = '110px';    //changing i/p box width to 110px
    }, 1);                      //This function will execute after 1 millisecond

    event.target.removeEventListener('click', startEdit); //remove event listener on click and calling startEdit function
    event.target.addEventListener('click', saveEdit);     // creating new event listener for save onclick and caling saveEdit function
}

function saveEdit(event) {      //This function is called from above function last line
    event.preventDefault();
    var li = event.path[2].children[0];     //my pointer is in edit link, my i/p field is two element up and its first child is i/p field
    var categoryName = li.children[0].value;
    var categoryId = event.path[4].previousElementSibling.dataset['id'];
    if(categoryName.length === 0) {
        alert("Please enter a valid category name");
        return;
    }

    ajax("POST", "/admin/blog/categories/update", "name=" + categoryName + "&category_id=" + categoryId, endEdit, [event]);


}

function endEdit(params, success, responseObj) {    //This function is called on above last line(this function is called whether response returns success or fail)
    var event = params[0];     //extracting events from line 67 i.e. ajax calls
    if(success) {              // if call was success
        var newName = responseObj.new_name; //extracting name from response object i.e. new_name
        var article = event.path[5];        //selecting article <a> link to article node in categories.blade.php
        article.style.backgroundColor = '#afefac';  //for giving flashy green color on clicking edit link

        setTimeout(function() {             //now transition of color is defined in categories.css
            article.style.backgroundColor = 'white';    //setting color to white after white effect
        }, 300);    //since transition in css is 300 millisecond, therefore turn white after that time

        article.firstElementChild.firstElementChild.innerHTML = newName; //replacing the name by the new name
    }

    event.target.innerHTML = "Edit";        //whether success or not after that hiding i/p field back
    var li = event.path[2].children[0];     //and changing Save to Edit name again
    li.children[0].style.maxWidth = '0px';  //i/p width 0 again i.e. hidden

    setTimeout(function() {
        li.style.display = "none";
    }, 310);    //giving 10milliseconds more than falsy effect

    event.target.removeEventListener('click', saveEdit);    //close save Edit
    event.target.addEventListener('click', startEdit);      //start startEdit (i.e. 1st function line 38)

}

function startDelete(event) {
    //Open Modal to ask if user is sure

    deleteCategory(event);  //calling delete category below function
}

function deleteCategory(event) {
    event.preventDefault();
    event.target.removeEventListener('click', startDelete);
    var categoryId = event.path[4].previousElementSibling.dataset['id'];
    ajax("GET", "/admin/blog/category/" + categoryId + "/delete", null, categoryDeleted, [event.path[5]]);
}

function categoryDeleted(params, success, responseObj) {
        var article = params[0];
        if(success) { //If we are success
                article.style.backgroundColor = '#ffc4be';
                setTimeout(function() {     //function that will do the actual delete operations
                        article.remove();   // remove that id's article
                        location.reload();  //reload the browser
                }, 300)    
        }
}



function ajax(method, url, params, callback, callbackParams) {      //definition of ajax
    var http;

    if(window.XMLHttpRequest) {
        http = new XMLHttpRequest();
    }
    else {
        http = new ActiveXObject("Microsoft.XMLHTTP");
    }

    http.onreadystatechange = function() {
        if(http.readyState == XMLHttpRequest.DONE) {
            if(http.status == 200) {                            // good case
                var obj = JSON.parse(http.responseText);
                callback(callbackParams, true, obj);
            }
            else if(http.status == 400) {                       //error case
                alert("Categories could not be saved. Please try again.");
                callback(callbackParams, false);
            }
            else {                                              //validation error case
                var obj = JSON.parse(http.responseText);
                if(obj.message) {               //if message is received that message is definitely validation error message.
                    alert(obj.message);         // i.e show validation error
                }
                else {
                    alert("Please check the name");
                }
            }
        }
    }

    http.open(method, baseUrl + url, true);         //this baseUrl is coming from views/layouts/admin-master.blade.php
    http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    http.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                            //Line 42 helps Laravel to identify as a AJAX Request and thus send appropriate response
    http.send(params + "&_token=" + token);     //we must send params and token for Laravel
}
