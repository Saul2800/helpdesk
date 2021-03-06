<?php
include "../config/config.php";

if (isset($_FILES["file1"]))
{
    $file = $_FILES["file1"];
    $name = $file["name"];
    $type = $file["type"];
    $tmp_n = $file["tmp_name"];
    $size = $file["size"];
    $folder = "../images/helpTicket/";
    
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

       $query=mysqli_query($con, "UPDATE ticket set problem_imguno=\"$name\"");
       if($query){
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=dashboard.php'>";
       }
    }
}
?>