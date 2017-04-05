<?php
defined("BASEURL") OR die("Direct access denied");

// password validation
function validatePassword($field) {
	
	if (strlen($field) < 5) {
		return "password should be more than five characters";
	}
	return "";
}

// validation username 
function validateUsername($field) {
	
	if (preg_match("/[^a-zA-Z0-9_.-]/", $field)) {
		return "The username must consists only from letters, numbers or characters(-_.)";
	}
	elseif (strlen($field) < 4) {
		return "username must be at least 4 characters.";
	} 
	return "";
}

// validate email address.
function validateEmail($field) {
	
	if (!((strpos($field, "@") > 1) &&
	          (strpos($field, ".") > 0)) ||
	          preg_match("/[^a-zA-Z0-9.@_-]/", $field)){
	  return "Invalid email address.";
	}
	return "";
}


?>