<?php
  $upload_dir  = $_POST['folder'];
  $upload_name = $_FILES["upfile"]["name"];
  $maxfilesize = 102400000;

  if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
    if($_FILES["upfile"]["size"] <= $maxfilesize) { 
      if (move_uploaded_file($_FILES["upfile"]["tmp_name"], $upload_dir."/".$upload_name)) {
          chmod("$upload_dir/$upload_name", 0644);
          echo $upload_name . " upload ok!";
      } else {
        echo $upload_name . " upload failed!";
      }      
    } else {
      echo " max file size over!"; 
    }  
  } else {
    echo " no file selection!";        
  }
?>