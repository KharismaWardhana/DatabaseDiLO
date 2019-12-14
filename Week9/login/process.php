<?php

   SESSION_START();

   include("../db.php"); // sertakan database.php untuk dapat menggunakan class database

   $db = new Database(); // membuat objek baru dari class database agar dapat menggunakan fungsi didalamnya   

   $email = $_POST['email'];

   $password = md5($_POST['password']);

   $result = $db->get("SELECT email FROM user WHERE email= '".$nik."' AND password='".$password."' ");

   if($result)

   {

       $_SESSION['notification'] = "Berhasil Login, Selamat Datang";

       $token = md5($nik."coursebackend".date("Y-m-d H:i:s"));

       $db->execute("UPDATE user SET token = '".$token."' WHERE email  = '".$email."'"); // update token to user

       $_SESSION['token'] = $token;

       $_SESSION['email'] = $email;

       header("Location: http://localhost/course_backend/user/");

   }

   $_SESSION['notification'] = "Gagal Login, Coba lagi";

   header("Location: http://localhost/course_backend/");

?>