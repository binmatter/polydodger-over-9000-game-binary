<?php
    header('Access-Control-Allow-Origin: *'); 
    header("Access-Control-Allow-Credentials: true");
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        if (empty($_POST["app"])) {
            die("app field required");
        } 
        else {
            $input['app'] = ($_POST["app"]);

            if ($input['app'] != 'polydodger') {
                die("invalid app");
            }
        }

        if (empty($_POST["image"])) {
            die("image field required");
        } 
        else {
            $input['image'] = $_POST["image"];
        } 

        $img = $input['image'];

        $image_parts = explode(";base64,", $img);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $folderPath = getcwd() .'/media/';
        $file_name = uniqid() . '.png';

        $file = $folderPath . $file_name;

        file_put_contents($file, $image_base64);

        $response['path'] = 'http://www.binmatter.com/polydodger/media/'.$file_name;

        echo json_encode($response);
    }

?>