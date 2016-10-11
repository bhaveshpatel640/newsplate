<?php
require 'init.php';

if(logged_in()){
      $email=$_SESSION['email'];
      $user_id=$_SESSION['user_id'];
      
      $uploadOk = 1;

  // Check if image file is a actual image or fake image

  if(isset($_POST["submit"])) {

      $filename="noimage.jpg";
      $target_dir = "../uploads/";
      $tmp=$_FILES["fileToUpload"]["name"];
      $extension = explode(".", $tmp);

      $filename=$user_id.".".end($extension);
      $imageFileType=$extension[1];

      $profile = $target_dir .$filename;
      
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          echo "File is not an image.";
          header("Location: ../profile.php");
          $uploadOk = 0;
      }
  }


  // Check if file already exists
  if (file_exists($profile)) {
      unlink($profile);
      move_uploaded_file($tmp, $profile);
      $uploadOk = 1;
  }


  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 9000000) {
      echo "Sorry, your file is too large.";
      header("Location: ../profile.php");
      $uploadOk = 0;
  }


  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      header("Location: ../profile.php");
      $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.Try Again Later";
header("Location: ../profile.php");
  // if everything is ok, try to upload file
  } else if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $profile)) {

          echo "The file ".$filename. " has been uploaded.";

       if($result=$db->query("UPDATE  userdetails SET profile='$filename' WHERE email='$email'"))
      {
        header("Location: ../profile.php");
      }

  } else {
   
  echo "Sorry, there was an error uploading your file.";
header("Location: ../profile.php");
  }

 
}
else{
  
  header("Location: ../login.php?login=3");
}
?>
