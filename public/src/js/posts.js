var addedCategoriesText;
var addedCategoriesIDs;

var tid = setInterval(function () {             //This function automatically gets automatically gets executed after 100 milliseconds
    if (document.readyState !== "complete") {
        return;
    }
    clearInterval(tid);             //This clears the time interval set by setInterval

    var addCategoryBtn = document.getElementsByClassName('btn')[0];//accessing button in the new post page admin(to give category effect)
    addedCategoriesIDs = document.getElementById('categories');    //setting reference to hidden i/p field in edit_post.blade.php (Search hidden)
    addCategoryBtn.addEventListener('click', addCategoryToPost);   //calling event listener
    addedCategoriesText = document.getElementsByClassName('added-categories')[0];  //search this class in edit_post.blade.php
                                                                                   //reference to empty unordered ist where we will insert category in edit_post.blade.php
    for (i = 0; i < addedCategoriesText.firstElementChild.children.length; i++) {  //Looping through the addedCategoryText to see how many categories it has
        addedCategoriesText.firstElementChild.children[i].firstElementChild.addEventListener('click', removeCategoryFromPost);
    }

}, 100);


function addCategoryToPost(event) {
    event.preventDefault();
    var select = document.getElementById('category_select');        //selecting category-select from category-select from edit_post.blade.php
    var selectedCategoryID = select.options[select.selectedIndex].value;        //code for currently selected options in select list (you can remember this)
    var selectedCategoryName = select.options[select.selectedIndex].text;       
    if (parseCategories().indexOf(selectedCategoryID) != -1) {              //if categories is already present
        return;
    }
    if (addedCategoriesIDs.value.length > 0) {          //for case of adding categories
        addedCategoriesIDs.value = addedCategoriesIDs.value + "," + selectedCategoryID; //if we have ids we will append , as well
    }
    else {
        addedCategoriesIDs.value = selectedCategoryID;                      //if no id is present simply write the current category id
    }

    //below code is for visual effect in the dropdown

    var newCategoryLi = document.createElement('li');              //creating li for empty unordered list in edit_post.blade.php
    var newCategoryLink = document.createElement('a');             //creating link for empty unordered list in edit_post.blade.php
    newCategoryLink.href = "#";                                    //setting link to #
    newCategoryLink.innerText = selectedCategoryName;              //setting text of li
    newCategoryLink.dataset['category_id'] = selectedCategoryID;   //sending some extra info/congiguration
    newCategoryLink.addEventListener('click', removeCategoryFromPost); //adding event listeners
    newCategoryLi.appendChild(newCategoryLink);
    addedCategoriesText.firstElementChild.appendChild(newCategoryLi);
}

function removeCategoryFromPost(event) {
    event.preventDefault();
    event.target.removeEventListener('click', removeCategoryFromPost);
    var categoryId = event.target.dataset['category_id'];      //as we can traverse through category_id created in addCategoryToPost() function (Line 43)
    var categoryIDArray = parseCategories();
    var index = categoryIDArray.indexOf(categoryId);
    categoryIDArray.splice(index, 1);                //here used splice function to remove specific selected element  
    var newCategoriesIDs = categoryIDArray.join(',');     //to overwrite the i/p field in value section so that the removed item is deleted
    addedCategoriesIDs.value = newCategoriesIDs;          //this string is put back to the hidden i/p field
    event.target.parentElement.remove();                  //remove <li> of the removed element
}                                       //splice() method adds/removes items to/from an array, and returns the removed item(s).

function parseCategories() {
    return addedCategoriesIDs.value.split(",");
}