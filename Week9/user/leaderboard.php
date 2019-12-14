<?php

SESSION_START();

include("../db.php"); // sertakan database.php untuk dapat menggunakan class database

$db = new Database(); // membuat objek baru dari class database agar dapat menggunakan fungsi didalamnya

$email = (isset($_SESSION['email'])) ? $_SESSION['email'] : "";

$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";

if($token && $nik)

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

PAGE : LEADERBOARD

<table border=1>

   <tr>

       <td>MENU</td>

       <td><a href="http://localhost/course_backend/user/">HOME</a></td>

       <td><a href="http://localhost/course_backend/user/statistik.php">STATISTIK</a></td>       

       <td><a href="http://localhost/course_backend/user/leaderboard.php">LEADERBOARD</a></td>

       <td><a href="http://localhost/course_backend/user/logout.php">LOGOUT</a></td>

   </tr>

</table>

<br>

<form action="http://localhost/course_backend/user/leaderboard.php" method='GET'>

       Pilih Game

       <select name="gameid">

           <?php

           $gamedata = $db->get("SELECT id,nama FROM game WHERE status=1");                                

           while($row = mysqli_fetch_assoc($gamedata))

           {

               ?>

               <option value="<?php echo $row['id']?>"><?php echo $row['nama']?></option>

               <?php

           }

           ?>

       </select>

       <input type="submit" value="Tampilkan Leaderboard">

</form>

<?php

if(isset($_GET['gameid']))

{

   echo "LEADERBOARD GAME ID :".$_GET['gameid'];

   ?>

   <table border=1>

   <tr><td>NO</td><td>NAMA</td><td>SCORE</td></tr>

   <?php

   $leaderboarddata = $db->get("SELECT user.nama as nama, max(user_game.score) as score FROM user, user_game WHERE user.email = user_game.email AND user_game.id = ".$_GET['id']." GROUP BY user.nik ORDER BY score DESC");

   $no = 0;

   while($row = mysqli_fetch_assoc($leaderboarddata))

   {

       $no++;

       ?>

       <tr>

       <td><?php echo $no?></td>

       <td><?php echo $row['nama']?></td>

       <td><?php echo $row['score']?></td>               

       </tr>

       <?php

   }

   ?>

   </table>

   <?php

}

?>

