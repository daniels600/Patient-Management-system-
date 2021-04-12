<?php 


if(isset($_GET['error'])){
  $msg = "User does not exist";
}



?>



<html>
<header>
  <meta charset="UTF-8">
  <script src="script.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style2.css">
  <nav>
    <div class="float-right">
      <button onclick="window.location.href='login.php'">ADMIN</button>
      <button onclick="window.location.href='../index.php'">HOME</button>
    </div>
  </nav>
</header>

<body>
  <form action="./retrival.php" method="post">

    <div class="container display">
      <h1>UNIVERSAL DATA</h1>
      <p>
        Use this Universal Data protocol to access data from our database about a patient. To use this data you accept
        the Terms and conditions in relation to the use and access of Information.
      </p>
      <p>
        All database access is logged and will be surrendered in case it the appropriate authorities ask for it.
      </p>
      <p>
        By using this data you are accepting that you are well aware of Ghana and International privacy laws.
      </p>
      <p>Your Health is our priority</p>
    </div>
    <div class="container forma">
      <div class="inputbox">
        <!-- Showing a message if any -->
      <?php if(isset($msg)): ?>
        <?php echo '<p style="text-align:center; color: red; margin-bottom: 0%;">'. $msg .'</p>'?>
      <?php endif; ?>
        <h1>RETRIVE DATA</h1>
        <div>
          <label>UserID</label><br>
          <input type="text" name="p_id">
        </div>
        <div>
          <label>Mobile Number</label><br>
          <input type="text" name="phone">
        </div>
        <button name="submit">Retrieve</button>
      </div>
    </div>

  </form>
</body>

</html>