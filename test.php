<?php

use jamshidbekakhlidinov\PixelsAPI;

include "vendor/autoload.php";

try{
    
    $api = new PixelsAPI();
    $api->page = rand(1,$api->per_page);
    $text = "wolf";
    $json_photos = $api->search($text);
    $photos = json_decode($json_photos, true);

    if(isset($photos['photos'])){

        if(!is_dir('img')){
            mkdir('img');
        }
        if(!is_dir('img/'.$text)){
            mkdir("img/".$text);
        }

        $photos =  $photos['photos'];
        foreach($photos as $photo){
            $extions = strrev(explode('.',strrev($photo['src']['original']))[0]);
            $name = rand(10000,99999).".".$extions;
            $img = file_get_contents($photo['src']['large2x']);
            file_put_contents("img/".$text."/".$name, $img);
        }
        echo "Done";
    }else{
        echo "No pictures available";
    }
}catch(Exception $ex){
    print_r($ex);
}
?>