<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Vigenere_Cipher</title>
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
    <div class="login-box">
      <h2>VIGENERE CIPHER FOR PHP</h2>
      <form method="POST">
        <div class="user-box">
          <input
            type="text"
            name="kunci" 
            value="<?php echo isset($_POST['kunci']) ? $_POST['kunci'] : '';?>"
          />
          <label>Kunci</label>
        </div>
        <div class="user-box">
          <?php echo isset($_POST['pesan']) ? $_POST['pesan'] : '';?>
          <textarea name="pesan" cols="10" rows="1"></textarea>
          <label>pesan</label>
        </div>
        <div class="en-de-btn">
          <input type="radio" name="type" value="en"> Engkripsi
        </div>
        <div class="en-de-btn">
          <input type="radio" name="type" value="de" id="post"> Dekripsi <?php
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
            include 'Vigenere_Cipher.php';
            $my = new Vigenere_Cipher;

            echo "<strong> Hasilnya</strong><br/>";
            
            $kunci = strtoupper($_POST['kunci']);
            $pesan = strtoupper($_POST['pesan']);
            if($_POST['type'] == 'de'){
              echo $my->decrypt($kunci,$pesan);
            }else{
              echo $my->encrypt($kunci,$pesan);
            }
          }
          ?>
        </div>
        <input type="submit" value="Eksekusi" />
      </form>
    </div>
  </body>
</html>
