<?php 
defined("BASEURL") OR die("Direct access denied");

//header('Content-Type: text/plain; charset=utf-8');
/**
* imageHandler helper class
*------------------------------------------------------------------------------------------------
* $iName, $tmpName, $fType, $uLocation, $nName=FALSE, $folder=FALSE, $fSize=FALSE, $aSize=FALSE
* image data must be passed in associative array
*
* @param array(
*		"iName"=>"Image name",		 	  TRUE
*  		"tmpName"=>"Image temporary name",TRUE
*  		"nName"=>"image new name", 		  TRUE or FALSE
*  	    "fType"=>"file type",		 	  TRUE
*  	    "folder"=>"folder directory" 	  TRUE OR FALSE
*  	    "ulocation"=>"upload Location"    TRUE if ("folder" = FALSE), FALSE if ("folder" = TRUE);
*       "fsize"=>"File size",             TRUE or FALSE
*       "aSize"=>"allocated size"		  TRUE if ("fsize" = TRUE), FALSE if ("fsize" = FALSE),
*       "message"=>"message to display"   TRUE or FALSE
* 		)
**/

class imageHandler
{
	// Prevent autoloading or cloning class
	private function __construct() {}
	private function __clone() {}
	
	// upload image
	public static function upload(array $imageData) {
		//global $LANG;

		extract(sanitize::arry($imageData));


		// Only enable when testing image uploading naming convention.
		#self::Validate($iName,$nName,$tmpName,$uLocation,$folder,$fSize,$aSize, $fType);
		try {

			$imgAuthenticate = TRUE;
			$ext             = TRUE;

			// if user click upload without selecting any image image
			if ($iName == NULL) {
				throw new RuntimeException("Select an image from your device", 1);
			}

			
		
			// Validate Image authenticity
			if (getimagesize($tmpName) == FALSE) {
				throw new RuntimeException("FIle is not an image", 1);
			
				$imgAuthenticate = FALSE;
				$ext = False;
			}

			// image File limit
			if (isset($fSize) && isset($aSize)) {
				$aSize = sprintf("%d", $aSize);
				$fSize = sprintf("%d", $fSize);

				if ($imgAuthenticate == TRUE) {
					if ($fSize > $aSize) {
						throw new RuntimeException("File larger than"." " .($aSize/1000000)."mb", 1);
						
						$ext = FALSE;
						
					}
				}
			}

			// Validate file extension (mime type)
			 // Validate file extension
			switch ($fType) {
				case 'image/jpeg'  : // Both regular and progressive jpeg 
				case 'image/pjpeg' : $ext = "jpg"; break;
				case 'image/png'   : $ext = "png"; break;
				case 'image/tif'   : $ext = "tif"; break;
				case 'image/gif'   : $ext = "gif"; break;
				default            : 
					throw new RuntimeException("File not an image", 1);
				  	$imgAuthenticate = FALSE;
				  	$ext = FALSE;
				  	//exit();
				  	break; 
			}


			// If folder is specified.
			if ($folder) {
				if (is_dir($folder) === FALSE) {
					mkdir($folder, null, TRUE);
				}
			}

			// When image passes all validation, upload
			if ($ext == TRUE && $imgAuthenticate == TRUE) {
				if ($folder) {
					$dir = "$folder/$nName.jpg";
				}
				else {
					$dir = "$uLocation/$nName.jpg";
				}

				$image = self::fixOrientation($tmpName, $dir);
				if ($image == 1) {
					// return in array the message and file path.
					return ["message"=>$message, "src"=>$dir];
				}
				else {
					return FALSE;
				}		
			}


		}
		catch(RuntimeException $e) {
			if(isset($redirect)) 
			{
				
				header("Location: ". URL . "/$redirect/?error=".$e->getMessage());
				exit;

			}
			else 
			{
				die($e->getMessage());
			}
		}

	}


	// image compression
	public static function compress($source, $destination, $qaulity) {
		//global $LANG;
		// get image size
		$info = getimagesize($source);

		if ($info == FALSE) {
			die(LANG["upload_error"]);
		}

		switch ($info["mime"]) {
			case 'image/jpeg'  : // Both regular and progressive jpeg 
			case 'image/pjpeg' : $image = imagecreatefromjpeg($source); break;
			case 'image/png'   : $image = imagecreatefrompng($source); break;
			case 'image/tif'   : $image = imagecreatefromtif($source); break;
			case 'image/gif'   : $image = imagecreatefromgif($source); break;
			
			default:
				die("Unexpected error.");
				break;
		}

		$w = $info[0];
		$h = $info[1];

		$tmp = imagecreatetruecolor($w, $h);
		imagecopyresampled($tmp, $image, 0, 0, 0, 0, $w, $h, $w, $h);
		// compress image size
		$newImg = imagejpeg($tmp, $destination, $qaulity);

		imagedestroy($tmp); 
        imagedestroy($image);

		if ($newImg == TRUE) {
			return $destination;
		}
		else {
			die("Unexpected error.");
		}

	}


	// fix image orientation when uploaded
	private static function fixOrientation($tmpName, $dir) {
	    $image = imagecreatefromstring(file_get_contents($tmpName));
	    $exif = exif_read_data($tmpName);

	   if (!empty($exif['Orientation'])) {
	       switch ($exif['Orientation']) {
		        case 3:
		            $image = imagerotate($image, 180, 0);
		            break;
		        case 6:
		            $image = imagerotate($image, - 90, 0);
		            break;
		        case 8:
		            $image = imagerotate($image, 90, 0);
		            break;
		    }

		    // move correctly oriented image into the directoty
		   $moveImg = imagejpeg($image, $dir);
	    } 
	    else {
	    	// move image to directory
	    	$moveImg = move_uploaded_file($tmpName, $dir);
	    }
	    
	   if ($moveImg == TRUE) {
			return 1;	
		}
		else {
			return 0;
		}
	}


	// Validate array naming convention. @Should be use for debug purposes only.
	private static function Validate($iName,$nName,$tmpName,$uLocation,$folder,$fSize,$aSize, $fType) {
		if($iName==FALSE || $nName==FALSE || $tmpName==FALSE || $fType==FALSE) {
			echo "check the manual and see how to use image upload handler";
			echo self::manual();
			exit();
		}
		if($uLocation==FALSE && $folder==FALSE) {
			echo "please specify upload directory or path";
			echo self::manual();
			exit();
		}
		if($uLocation==TRUE && $folder==TRUE) {
			echo "You should use either uLocation or folder";
			echo self::manual();
			exit();
		}
		if ($fSize==TRUE && $aSize==FALSE) {
			echo "Both file size and allowed size must be specified";
			echo self::manual();
			exit();
		}  
		if ($fSize==FALSE && $aSize==TRUE) {
			echo "Both file size and allowed size must be specified";
			echo self::manual();
			exit();
		}

	}

	// manual
	private static function manual() {
		$manual = <<<END
<br>
<strong>Manual</strong>
<pre>
"iName"=>"Image name" <strong>(TRUE)</strong>

"tmpName"=>"Image temporary name" <strong>(TRUE)</strong>

"nName"=>"image new name"  <strong>(TRUE)</strong>

"fType"=>"file type" <strong>(TRUE)</strong>

"folder"=>"folder directory" <strong>(TRUE OR FALSE)</strong>

"ulocation"=>"upload Location" <strong>(TRUE if ("folder" = FALSE) and FALSE if ("folder" = TRUE))</strong>

"fSize"=>"File size" <strong>(TRUE or FALSE)</strong>

"aSize"=>"allocated size" <strong>(TRUE if ("fsize" = TRUE) and FALSE if ("fsize" = FALSE))</strong>

"message"=>"message to display after successful upload" <strong>(TRUE or FALSE)</strong>
</pre>
END;
	return $manual;
	}
}
?>