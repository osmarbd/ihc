<?php
/**
 * Created by PhpStorm.
 * User: osmar
 * Date: 06/02/2019
 * Time: 13:12
 */
//upload.php

if(isset($_POST["image"]))
{
    $data = $_POST["image"];

    $image_array_1 = explode(";", $data);

    $image_array_2 = explode(",", $image_array_1[1]);

    $data = base64_decode($image_array_2[1]);

    $imageName = time() . '.png';

    $dir = "../img/avatar/";

    file_put_contents($dir.$imageName, $data);

    //echo '<img src="'.$imageName.'" class="img-thumbnail" />';
    echo '<img class="profile-user-img img-responsive img-circle" src="'.$dir.$imageName.'" alt="User profile picture"><input type="hidden" name="imagem_db" value="'.$imageName.'">';
}

?>