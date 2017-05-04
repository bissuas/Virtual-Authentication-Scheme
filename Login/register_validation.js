    function formValidation()  
    {  
    var name = document.registration.fname;
	var secretpass = document.registration.spass;
	//var secstring = document.registration.sstring; 	
    var uemail = document.registration.email;  
	
	if(allLetter(name))  
    {  
    if(passid_validation(secretpass,3))  
    {    
    if(ValidateEmail(uemail))  
    {   
    }  
    }  
    }     
    return false;  
      
    } 

//name validation 
	function allLetter(name){
	var letters = /^[A-Za-z]+$/;  
	if(name.value.match(letters))  
	{  
		return true;  
	}  
	else  
	{  
		alert('Username must have alphabet characters only');  
		name.focus();  
		return false;  
	}	
	}
//secret password validation 

	function passid_validation(secretpass,3){
	var numbers = /^[0-9]+$/;
	var secretpass_len = secretpass.value.length;
	if(secretpass.value.match(numbers) || secretpass_len == 3)  
	{  
		return true;  
	}  
	else  
	{  
		alert('Password must have numeric value of 3 characters only');  
		secretpass.focus();  
		return false;  
	}
 	
	}
//email id validation	
    function ValidateEmail(email)  
    {  
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
    if(email.value.match(mailformat))  
    {  
    return true;  
    }  
    else  
    {  
    alert("You have entered an invalid email address!");  
    email.focus();  
    return false;  
    }  
    } 