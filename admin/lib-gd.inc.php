<?

$phpAds_GDImageFormat = '';


function phpAds_GDImageFormat()
{
	global $phpAds_GDImageFormat;
	
	// Determine if GD is installed
	if (extension_loaded("gd"))
	{
		// Determine php version
		$phpversion = ereg_replace ("([^0-9])", "", phpversion());
		$phpversion = $phpversion / pow (10, strlen($phpversion) - 1);
		
		if ($phpversion >= 4.02)
		{ 
		    // Use ImageTypes() to dermine image format
		    if (ImageTypes() & IMG_PNG)
		        $phpAds_GDImageFormat = "png";
		    
		    elseif (ImageTypes() & IMG_JPG)
		        $phpAds_GDImageFormat = "jpeg";
		    
		    elseif (ImageTypes() & IMG_GIF)
		        $phpAds_GDImageFormat = "gif";
		    
		    else 
		        $phpAds_GDImageFormat = "none";
		}
		elseif ($phpversion >= 4)
		{
			// No way to determine image format
			$phpAds_GDImageFormat = "gif"; // assume gif?
		}
		else
		{ 
		    // Use Function_Exists to determine image format
		    if (function_exists("imagepng"))
		        $phpAds_GDImageFormat = "png"; 
		    
		    elseif (function_exists("imagejpeg"))
		        $phpAds_GDImageFormat = "jpeg"; 
		    
		    elseif (function_exists("imagegif"))
		        $phpAds_GDImageFormat = "gif";
		    
		    else
		        $phpAds_GDImageFormat = "none";
		}
	}
	else
	{
		$phpAds_GDImageFormat = "none";
	}
	
	return ($phpAds_GDImageFormat);
}


function phpAds_GDContentType()
{
	global $phpAds_GDImageFormat;
	
	if ($phpAds_GDImageFormat == '') $phpAds_GDImageFormat = phpAds_GDImageFormat();
	
	Header("Content-type: $phpAds_GDImageFormat");
}


function phpAds_GDShowImage(&$im)
{
	global $phpAds_GDImageFormat;
	
	if ($phpAds_GDImageFormat == '') $phpAds_GDImageFormat = phpAds_GDImageFormat();
	
	switch ($phpAds_GDImageFormat)
	{ 
		case "gif":
			ImageGIF($im);
			break;
		case "jpeg":
			ImageJPEG($im);
			break;
		case "png":
			ImagePNG($im);
			break;
		default:
			break; 	// No GD installed
	}
}

?>
