<?php 
defined("BASEURL") OR die("Direct access denied");
/**
* ---------------------------------------------------------------------------------------------------------------------------/
* Helper Classes                                    																		 /
*----------------------------------------------------------------------------------------------------------------------------/
* 																															 /
* All static class function __construct() and __clone() are set to private to prevent class duplication and auto execution.  /
* To use class:- call class name add :: prefix then the static method.														 /
*	@example className::staticMethod($parameter);																			 /
*      																														 /
* Some function used in the classes are from function_helper																 /
* @see function_helper.																										 /
*****************************************************************************************************************************/


/**
* cookie class
*---------------------------------------------------------
* set cookies name and variables.
* 	@return cookie name.
* destroy cookie variables or all cookies in the server.
* @param- $key represents the cookie name.
* @param- $value represents the cookie value.
*/
class cookie 
{
	private function __construct() { }
	private function __clone() { }

	//set cookie to 1 month.
	public static function set($key, $value) {
		setcookie($key, $value, time() + 60 * 60 * 24 * 31, "/");
	}
	//get cookie.
	public static function get($key) {
		if (isset($_COOKIE[$key])) {
			return $_COOKIE[$key];
		}
	}
	//destroy selected cookie.
	public static function terminate($key, $value) {
		if (isset($_COOKIE[$key])) {
			setcookie($key, $value, time() - 60 * 60 * 24 * 31, "/");
		}
	}
	//destroy all cookie. (Should be use for debugging purposes only.) 
	public static function terminateAll() {
		if (isset($_SERVER['HTTP_COOKIE'])) {
		    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
		    foreach($cookies as $cookie) {
		        $parts = explode('=', $cookie);
		        $name = trim($parts[0]);
		        setcookie($name, '', time() - 60 * 60 * 24 * 31);
		        setcookie($name, '', time() - 60 * 60 * 24 * 31, '/');
		    }
		}
	}
}

/**
* session class
*---------------------------------------------------------
* set session name and variables.
* 	@return session name.
* destroy session variables or all session in the server.
* @param- $key represents the session name.
* @param- $value represents the session value.
**/
class session 
{
	private function __construct() { }
	private function __clone() { }
	
	//Initialize session.
	public static function init() {
		session_start();
	}
	//set session
	public static function set($key, $value) {
		$_SESSION[$key] = $value;
	}
	//get session
	public static function get($key) {
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		}
	}
	//terminate selected session
	public static function terminate($key) {
		if (isset($_SESSION[$key])) {
			unset($_SESSION[$key]);
		}
	}
	//terminate all session. (Should be use for debugging purposes only.)
	public static function terminateAll() {
		session_destroy();
	}
}

/**
* sanitize class
*------------------------------------------
* Remove all illegal characters from @param.
* @return a sanitized value.
* 	@see function_helper for sanitizeString();
**/ 
class sanitize 
{
	private function __construct() {}
	private function __clone() {}
	// clean strings
	public static function string($var) {
		$var = filter_var($var, FILTER_SANITIZE_STRING);
		$var = self::spaces($var);
		$var = sanitizeString($var);

		return $var;
	}
	// clean in array
	public static function arry(array $var) {
		$filterValue = [];
		$valueKey    = [];

		foreach ($var as $key => $value) {
			$value = filter_var($value, FILTER_SANITIZE_STRING);
			$value = self::spaces($value);
			$value = sanitizeString($value);

			array_push($valueKey, $key);
			array_push($filterValue, $value);
		}
			
		$filtered = array_combine($valueKey, $filterValue);
		return $filtered;
	}
	// clean email
	public static function email($email) {
		$email = self::spaces($email);
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		return $email;
	}
	// clean url
	public static function url($url) {
		$url = self::spaces($url);
		$url = filter_var($url, FILTER_SANITIZE_URL);
		return $url;
	}
	// enforce integer
	public static function int($num) {
		$num = (int)$num;
		$num = filter_var($num, FILTER_SANITIZE_NUMBER_INT);
		return $num;
	}
	// clean html post
	public static function html($str) {
		$str = self::spaces($str);
		$str = sanitizeHtml($str);
		return $str;
	}

	public static function spaces($var) {
		$var = preg_replace("/\s\s+/", "", $var);
		$var = trim($var);
		return $var;
	}
}

/**
* encrypt class
*------------------------------------
* Get inputed password
* Get user browser and IP address
* convert to 32 hexadecimal characters
* @return converted characters.
*	@see function_helper for hasher();
*
* None of the salt must be changed;
**/
class encrypt 
{
	private function __construct() {}
	private function __clone() {}

	public static function str($var) {
		$salt1  = "!@#)0$$^%)))977&$&&##G((**++(*^T+12&54/*sRGA^&";
		$salt2  = "@%%78999))__^^*@*((@())^^Y**@((@))//***";
		$token  = hasher("$salt1$var$salt2");  
		return $token;
	}

	public static function pass($pass) {
		return  password_hash($pass, PASSWORD_DEFAULT);
	}

	public static function verifypass($pass, $hash) {
		
		if (password_verify($pass, $hash)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public static function ip() {
		$browser   = $_SERVER["HTTP_USER_AGENT"];
		$visitorIp = $_SERVER["REMOTE_ADDR"];
		$token 	   = hasher("$browser$visitorIp");
		return $token;
	}
}


class uploadError 
{
	private function __construct() {}
	private function __clone() {}

	public static function message($err) {
		switch ($code) {

            case UPLOAD_ERR_INI_SIZE:
                $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                break;
            case UPLOAD_ERR_PARTIAL:
                $message = "The uploaded file was only partially uploaded";
                break;
            case UPLOAD_ERR_NO_FILE:
                $message = "No file was uploaded";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $message = "Missing a temporary folder";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $message = "Failed to write file to disk";
                break;
            case UPLOAD_ERR_EXTENSION:
                $message = "File upload stopped by extension";
                break;

            default:
                $message = "Unknown upload error";
                break;
        }
        return $message; 
	}
}

?>