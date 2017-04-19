<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotosController extends Controller
{
	
    public function getPhoto($filename) {
      $addmins = strtotime('+30 minutes');
	    $image_cache_expires = date('D, d M Y H:i:s \G\M\T',$addmins);
      $path = storage_path() . '/app/public/uploads/';

      if($filename) // Column where user's photo name is stored in DB
      {
        $photo_path = $path . $filename; // eg: "file_name"
        
        $response = response()->file($photo_path);
        $file_extension = strtolower(substr(strrchr($filename,"."),1));
        switch( $file_extension ) {
		    case "gif": $ctype="image/gif"; break;
		    case "png": $ctype="image/png"; break;
		    case "jpeg":
		    case "jpg": $ctype="image/jpeg"; break;
		    default:
		}
        $response->headers->set("Content-Type", $ctype);
        $response->headers->set("Expires", $image_cache_expires);
        return $response;
      }
      abort("404");
    }

}
