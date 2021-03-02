<?php
session_start(); //Iniciamos la sesión actual
$id_user = $_SESSION['user_id'];
include "../config/config.php";

if (isset($_FILES["file"]))
{
    $file = $_FILES["file"];
    $name = $file["name"];
    $type = $file["type"];
    $tmp_n = $file["tmp_name"];
    $size = $file["size"];
    $folder = "../images/profiles/";
    
    if ($type != 'image/jpg' && $type != 'image/jpeg' && $type != 'image/png' && $type != 'image/gif')
    {
      echo "Error, el archivo no es una imagen"; 
    }
    else if ($size > 1024*1024)
    {
      echo "Error, el tamaño máximo permitido es un 1MB";
    }
    else
    {
        $src = $folder.$name;
       @move_uploaded_file($tmp_n, $src);

       /*$query=mysqli_query($con, "UPDATE user set profile_pic=\"$name\"");*/
       $query=mysqli_query($con, "UPDATE user set profile_pic=\"$name\" WHERE id = \"$id_user\"");
       echo "Hola".$id_user."como estan xd";
       if($query){
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=dashboard.php'>";
       }
    }
}