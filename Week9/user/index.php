<?php

SESSION_START();

include("../db.php"); // sertakan database.php untuk dapat menggunakan class database

$db = new Database(); // membuat objek baru dari class database agar dapat menggunakan fungsi didalamnya

$email = (isset($_SESSION['email'])) ? $_SESSION['email'] : "";

$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";

if($token && $email)

{

   $result = $db->execute("SELECT * FROM user WHERE email = '".$email."' AND token = '".$token."' AND status = 1 ");

   if(!$result)

   {

       // redirect ke halaman login, data tidak valid

       header("Location: http://localhost/course_backend/");

   }

   // abaikan jika token valid

   $userdata = $db->get("SELECT user.email as email, user.nama as nama, kota.nama as nama_kota,

                       provinsi.nama as nama_provinsi

                       from user,kota, provinsi WHERE user.email = '".$email."' AND

                       user.kota = kota.id AND kota.provinsi = provinsi.id");               

   $userdata = mysqli_fetch_assoc($userdata);                       

}

else

{

   header("Location: http://localhost/course_backend/");

}

$notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";

if($notification)

{

   echo $notification;

   unset($_SESSION['notification']);   

}

?>

PAGE : HOME

<table border=1>

   <tr>

       <td>MENU</td>

       <td><a href="http://localhost/course_backend/user/">HOME</a></td>

       <td><a href="http://localhost/course_backend/user/statistik.php">STATISTIK</a></td>       

       <td><a href="http://localhost/course_backend/user/leaderboard.php">LEADERBOARD</a></td>

       <td><a href="http://localhost/course_backend/user/logout.php">LOGOUT</a></td>

   </tr>

   <tr><td align="center" colspan=5>Profile</td></tr>

   <tr><td>Email</td><td colspan=4><?php echo $userdata['email'];?></td></tr>

   <tr><td>Nama</td><td colspan=4><?php echo $userdata['nama'];?></td></tr>

   <tr><td>Kota</td><td colspan=4><?php echo $userdata['nama_kota'];?></td></tr>   

   <tr><td>Provinsi</td><td colspan=4><?php echo $userdata['nama_provinsi'];?></td></tr>

</table>