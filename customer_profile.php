<?php
  session_start();
  $host = "localhost"; /* Host name */
  $user = "root"; /* User */
  $password = ""; /* Password */
  $dbname = "onlinebanking"; /* Database name */

  $conn = mysqli_connect($host, $user, $password,$dbname);
  // Check connection
  if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
  }
  $_SESSION['user'] = $_POST['user'];
  $_SESSION['sender'] = $_SESSION['user'];

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content = "width=device-width, initial-scale = 1">
  <title>Online Banking</title>
  <link rel="stylesheet" type="text/css" href="Home.css">
  <style type="text/css">
    .footer_div {
      margin-top: 350px;
    }
    .bg-img 
    {
      background: url('images/background.jpg') no-repeat center center fixed;
      background-size: cover;
      padding-bottom: 0;
    }
    .center {
      margin: auto;
      width: 35%;
      padding: 5px;
      margin-top: -275px;
      margin-bottom: -275px;
    }
    .title 
    {
      font-family: poppins;
      text-align: left;
      font-weight: bold;
      width: 100%;
      padding: 5px;
      margin: auto;
      color: skyblue;
      text-transform: uppercase;
    }
    .customer_profile 
    { 
      font-family: poppins;
      font-size: 16.5px;
      text-align: center;
      font-weight: bold;
      background: rgba(75, 75, 75, 0.7);
      width: 100%;
      border: 1px solid black;
      padding: 5px;
      margin: 2px;
      color: white;
      text-align: left;
      padding-left: 50px;
      padding-top: 40px;
      padding-bottom: 40px;
    }

    .textbox
    {
      height: 25px;
      background-color: white;
      color: black;
      font-size: 16px;
      font-weight: bold;
    }

    .button
    {
      font-weight: bold;
      font-size: 16px;
      width: 190px;
      height: 44px;
      display: flex;
      justify-content: center;
      align-items: center;
      color: white;
      background-color: #28bbffd8;
      border-radius: 20px;
      box-shadow: 5px 10px 30px rgba(24, 139, 119, 0.2);
    }

    .button:hover 
    {
      background-color: #28bbffa4;
      transition: all ease 0.2s;
    }
  </style>
  <script type="text/javascript">
  function toggletable() 
  {
    document.getElementById("table").classList.toggle("hidden");
  }
  </script>
</head>
<body>
  <div class="bg-img">
  <section id="main">
      <nav>
        <a href="home.php" class="logo">
          <img src="images/yoro bank.png" alt="The logo of bank">
        </a>

        <span class="menu-space"></span>

        <ul class="menu">
          <li><a href="home.php">Home</a></li>
          <li><a class="active" href="view_customers.php">View Customers</a></li>
          <li><a href="view_transactions.php">View Transactions</a></li>
      </ul>
      </nav>
  </section>

  <section>
  <div class="center">
  <div class="customer_profile">
    <h2 class="title">Customer Profile</h2>
    
    <?php
      if(isset($_SESSION['user']))
      {
        $user = $_SESSION['user'];
        $result = mysqli_query($conn,"SELECT * FROM customer WHERE name = '$user'");
        while($row = mysqli_fetch_array($result)) 
        {
          echo "<p><b>User Id &nbsp&nbsp&nbsp:</b>&nbsp&nbsp&nbsp" . $row['userid'] . "</p>";
          echo "<p name='sender'><b>Name &nbsp&nbsp&nbsp&nbsp&nbsp</b> : &nbsp " . $row['name'] . "</p>";
          echo "<p><b>Email Id</b>&nbsp : &nbsp" . $row['email'] . "</p>";
          echo "<p><b>A/C No</b>&nbsp&nbsp&nbsp : &nbsp&nbsp" . $row['acc_number']."</p>";
          echo "<p><b>IFSC</b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp : &nbsp&nbsp" . $row['ifsc']."</p>";
          echo "<p><b class='font-weight-bold'>Balance</b>&nbsp&nbsp: <b>&nbsp&nbsp&#8377;</b>" . $row['balance']."</p>";
        }
      }
    ?>
    <br>
    <form action="moneysent.php" method="POST">
      <h2 class="title">Make Transaction</h2><br>
      To&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp&nbsp&nbsp
      <select name="reciever" id="dropdown" class="textbox" required="Please Select Recipient";>
        <option value="" disabled selected hidden>Select Recipient</option>
        <?php
          $db = mysqli_connect("localhost", "root", "", "onlinebanking");
          $res = mysqli_query($db, "SELECT * FROM customer WHERE name != '$user'");
          while ($row = mysqli_fetch_array($res)) {
            echo("<option>"."  ".$row['name']."</option>");
          }
        ?>
      </select>
      <br><br>
        From&nbsp&nbsp&nbsp&nbsp :&nbsp&nbsp&nbsp <span style="font-size: 1.2em;"><input id="myinput" name="sender" class="textbox" disabled type="text" value='<?php echo "$user"; ?>'></input></span>
      <br><br>

      <b>Amount :  &#8377;</b>
      <input type="number" name="amount" min="100" class="textbox" required><br><br><br>
      <a><button id="transfer" name="transfer" class="button" ; >Transfer</button></a>
    </form>
  </div>
  </div>
  </section>
  <div class="footer_div">
      <?php include('footer.php')?>  
  </div> 
  </div>
</body>
</html>