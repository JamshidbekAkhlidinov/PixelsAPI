# PixelsAPI

**Installing**

    composer require jamshidbekakhlidinov/pixels-api

Example code

    <?php
        include "vendor/autoload.php";
        use jamshidbekakhlidinov\PixelsAPI;

        $api = new PixelsAPI();
        $api->page = rand(1,$api->per_page);
        $text = "wolf";
        $json_photos = $api->search($text);
        $photos = json_decode($json_photos, true);
        print_r($photos);
    ?>