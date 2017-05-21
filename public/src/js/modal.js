function modalOpen(event) {							  //this function is for modal opening 
	event.preventDefault();							  //prevents default clicking
	var background = document.createElement('div');   //creating new div for modal background
	background.className = "modal-background";		  //giving div a class
	var width = window.innerWidth;					  //setting to the width of window screen
	var height = window.innerHeight;				  //setting to the height of window screen
	background.style.width = width + "px";
	background.style.height = height + "px";		  //showing effect in windows screen
	document.body.appendChild(background);

	var modal = document.getElementsByClassName('modal')[0];	//selecting the created modal with class (This modal is created in admin's index.blade.php and other/contact-messages.blade.php )
	modal.style.display = "block";			//block was hidden earlier, setting it visible
	setTimeout(function() {					//this function sets the position of the modal(i.e. keeping it centered)
		modal.style.top = height/2 - modal.offsetHeight/2 + "px";
	}, 10);

}

function modalClose(event) {							//this function is for modal closing 
	event.preventDefault();								//prevents default clicking
	var modal = document.getElementsByClassName('modal')[0];	//selecting modal
	while (modal.firstElementChild.tagName !== "BUTTON") {		//removing all content of selected item, but close button in modal
		modal.firstElementChild.remove();		    //removing that selected info
	}
	modal.style.top = '10%';
	modal.style.display = 'none';					//setting display:none property in order to remove it
	var background = document.getElementsByClassName('modal-background')[0];   //selecting background inorder to remove for close modal
	background.remove();		//removing above seected background
}

