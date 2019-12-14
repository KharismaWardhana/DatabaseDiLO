<?php

SESSION_START();

include("./db.php"); // sertakan database.php untuk dapat menggunakan class database

$db = new Database(); // membuat objek baru dari class database agar dapat menggunakan fungsi didalamnya

$email = (isset($_SESSION['email'])) ? $_SESSION['email'] : "";

$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";

if($token && $email)

{

  $result = $db->execute("SELECT * FROM user WHERE email = '".$email."' AND token = '".$token."' AND status = 1 ");

  if($result)

  {

      // redirect ke halaman user, token valid

      header("Location: http://localhost/course_backend/user/");

  }

  // abaikan jika token tidak valid

}

// token tidak tersedia

$notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";

if($notification)

{

   echo $notification;

   unset($_SESSION['notification']);   

}

?>

PAGE : REGISTER

<form action="login/register_process.php" method="POST">

<table>

  <tr>

      <td>nama</td><td>:</td><td><input type="text" name="nama" required></td>

  </tr>

  <tr>

      <td>password</td><td>:</td><td><input type="password" name="password" required></td>

  </tr>

  <tr>

      <td>password(again)</td><td>:</td><td><input type="password" name="password2" required></td>

  </tr>  

  <tr>

      <td>email</td><td>:</td><td><input type="text" name="email" required></td>

  </tr>  

  <tr>

      <td>kota</td><td>:</td>

      <td>

          <select name="kota_id" required>

              <option value="">- SELECT -</option>

          <?php

          $kota = $db->get("SELECT id,nama FROM kota WHERE status = 1");

          if($kota)

          {

              while($row = mysqli_fetch_assoc($kota))

              {

                  ?>

                  <option value="<?php echo $row['id'] ?>"><?php echo $row['nama']?></option>

                  <?php

              }

          }

          ?>

          </select>

      </td>

  </tr>   

  <tr>

      <td colspan=3><input type="submit" value="REGISTER"></td>

  </tr>      

</table>

</form>

<button><a href="http://localhost/course_backend/">Back to Login</button>