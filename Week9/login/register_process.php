<?php

   SESSION_START();

   include("../db.php"); // sertakan database.php untuk dapat menggunakan class database

   $db = new Database(); // membuat objek baru dari class database agar dapat menggunakan fungsi didalamnya   

   $nama = $_POST['nama'];

   $email = $_POST['email'];

   $kota_id = $_POST['kota_id'];

   $token = ""; // dikosongkan untuk awal

   $status = 1; // status aktif

   $password = md5($_POST['password']);

   $password2 = md5($_POST['password2']);   

   if($password == $password2)

   {

       if($nama && $email && $kota_id)

       {

           $result = $db->execute("INSERT INTO user(
                                                        nama,
                                                        email,
                                                        kota_id,
                                                        token,
                                                        status,
                                                        password

                                                       ) VALUES(

                                                       '".$nama."',

                                                       '".$email."',

                                                       ".$kota_id.",

                                                       '".$token."',

                                                       ".$status.",

                                                       '".$password."'

                                                   )");

           if($result){    $_SESSION["notification"] = "Register User Berhasil";    }

           else{    $_SESSION["notification"] = "Register User Gagal";     }

       }

   }

   header("Location: http://localhost/course_backend/");   

?>

 