LARAVEL:
         $html = '<img src="'.asset(''.$img_name.'').'" />';

          $doc = new DOMDocument();
          $doc->loadHTML($html);
          $xpath = new DOMXPath($doc);
          $img =  $xpath->evaluate("string(//img/@src)");  

          $orginal_filename = $img;
          $modified_filename = 'img/'.$used_cars_value->id.'_430x296.jpg';
          $imgformat = true;

          //Get the width, height and type values of the original image
            list($width, $height, $type) = getimagesize($orginal_filename);

            if ($type == IMAGETYPE_JPEG)
               $img = imagecreatefromjpeg($orginal_filename);
            elseif ($type == IMAGETYPE_PNG)
               $img = imagecreatefrompng($orginal_filename);
            elseif ($type == IMAGETYPE_GIF)
               $img = imagecreatefromgif($orginal_filename);
            else
               $imgformat = false;

            if($imgformat && $width != 430 && $height != 296)
            {
              $n_width = 430;
              $n_height = 296;

             $nimg = imagecreatetruecolor($n_width, $n_height);
             $img_crop = imagecopyresized($nimg, $img, 0, 0, 0, 0, $n_width, $n_height, $width, $height);

             imagejpeg($nimg,$modified_filename);
             imagedestroy($nimg);
            }
            else
            {
              $modified_filename = $img_name;
            }
