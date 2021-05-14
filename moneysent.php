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
  
  $timestamp = time();
  date_default_timezone_set("Asia/Kolkata"); 
  $date_time =  date("Y-m-d H:i:s", $timestamp); 
  

  $flag=false;

  if (isset($_POST['transfer']))
  {
    $sender=$_SESSION['sender'];
    $receiver=$_POST["reciever"];
    $amount=$_POST["amount"];
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content = "width=device-width, initial-scale = 1">
  <title>Online Banking</title>
  <link rel="stylesheet" type="text/css" href="Home.css">
  <style type="text/css">
    a {
      text-decoration: none;
    }
    .bg-img 
    {
      background: url('images/background.jpg') no-repeat center center fixed;
      background-size: cover;
      padding-bottom: 40%;
    }
    .center {
      margin: auto;
      width: 35%;
      padding: 5px;
      margin-top: -275px;
      margin-bottom: -275px;
    }
    .title1 
    {
      font-family: poppins;
      text-align: left;
      font-weight: bold;
      width: 100%;
      padding: 5px;
      margin: auto;
      color: blue;
      text-transform: uppercase;
      padding-top: 10px;
      font-size: 40px;
    }
    .title2
    {
      font-family: poppins;
      text-align: left;
      font-weight: bold;
      width: 100%;
      padding: 5px;
      margin: auto;
      color: blue;
      padding-top: 13px;
      font-size: 23px; 
    }
    .customer_profile 
    { 
      font-family: poppins;
      font-size: 16.5px;
      text-align: center;
      font-weight: bold;
      background: rgb(123, 211, 247, 0.7);
      width: 100%;
      border: 1px solid black;
      padding: 5px;
      margin: 2px;
      color: white;
      text-align: left;
      padding-left: 15px;
      padding-top: 15px;
      padding-bottom: 20px;
      padding-right: 15px;
    }
    .image {
      width: 20%;
      height: 20%;
    }
    .hr1 {
        border:none;
        height: 20px;
        width: 100%;
        height: 50px;
        margin-top: 0;
        border-bottom: 1px solid #1f1209;
        box-shadow: 0 20px 20px -20px #00BFFF;
        margin: -35px auto 10px;  
        border-color: white;
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
      background-color: blue;
      border-radius: 20px;
      box-shadow: 5px 10px 30px rgba(24, 139, 119, 0.2);
    }

    .button:hover 
    {
      background-color: black;
      transition: all ease 0.2s;
    }
    p {
      color: black;
      font-size: 18px;
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

  <?php
    $sql = "SELECT balance FROM customer WHERE name='$sender'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
        while($row = $result->fetch_assoc()) {
            if($amount>$row["balance"] or $row["balance"]-$amount<100)
            {                
              ?>
                    <section>
                    <div class="center">
                      <div class="customer_profile">
                        <div class="image">
                          <img src="images/wrong.png">
                        </div>
                        <hr class="hr1">
                        <h2 style="color: red; font-size: 40px; text-transform: uppercase;">Transaction Denied</h2>
                        
                        <form action="transfer.php" method="POST">
                          <h2 style="color: red; font-size: 28px;">Insufficient Balance!</h2><br>
                          <br>
                          <a href="view_customers.php" class="button">OK</a>
                        </form>
                      </div>
                    </div>
                    </section>
              <?php
       
            }
            else{
                $sql = "UPDATE `customer` SET balance=(balance-$amount) WHERE name='$sender'";
    
                if ($conn->query($sql) === TRUE) {
                    $flag=true;
                } else {
                  ?>
                    <section>
                    <div class="center">
                      <div class="customer_profile">
                        <div class="image">
                          <img src="images/error.png">
                        </div>
                        <hr class="hr1">
                        <h2 style="color: red; font-size: 40px; text-transform: uppercase;">Error</h2>
                        
                        <form action="transfer.php" method="POST">
                          <h2 style="color: red; font-size: 28px;">Error in Updating Record!</h2><br>
                          <br>
                          <a href="view_customers.php" class="button">Done</a>
                        </form>
                      </div>
                    </div>
                    </section>
                  <?php
                }
            }
     
        }
    } 
    else {
        echo "0 results";
    } 

    if($flag==true)
    {
        $sql = "UPDATE `customer` SET balance=(balance+$amount) WHERE name='$receiver'";

        if ($conn->query($sql) === TRUE) {
            $flag=true;  
        } 
        else {
            echo "Error in updating record: " . $conn->error;
        }
    }
    if($flag==true)
    {
        $sql = "SELECT * from customer where name='$sender'";
        $result = $conn-> query($sql);
        while($row = $result->fetch_assoc())
        {
             $s_acc=$row['acc_number'];
        }
        $sql = "SELECT * from customer where name='$receiver'";
        $result = $conn-> query($sql);
        while($row = $result->fetch_assoc())
        {
            $r_acc=$row['acc_number'];
        }        
        $sql = "INSERT INTO `transfer`(s_name,s_accno,r_name,r_accno,amount,date_time) VALUES ('$sender','$s_acc','$receiver','$r_acc','$amount','$date_time')";   
        if ($conn->query($sql) === TRUE) 
        {
        } 
        else 
        {
            echo "Error updating record: " . $conn->error;
        }
    }

    if($flag==true)
    {
     ?>
      <section>
      <div class="center">
        <div class="customer_profile">
          <div class="image">
            <img src="images/true.png">
          </div>
          <hr class="hr1">
          <h2 class="title1">Success</h2>
          
          <form action="transfer.php" method="POST">
            <h2 class="title2">Your Payment has been Processed Successfully!</h2><br>
            <p>From : <span> <?php echo $sender; ?> </span></p>
            <hr>
            <p>To : <span> <?php echo $receiver; ?> </span></p>
            <hr>
            <p>Amount : <span>&#8377; <?php echo "" . $amount; ?> </span></p>
            <hr>
            <br>
            <a href="view_customers.php" class="button">Done</a>
            <br>
            <p><?php echo $date_time; ?></p>
          </form>
        </div>
      </div>
      </section>
      <?php
      }
      elseif($flag==false)
      {
          echo "<script>
              $('not sent').show()
           </script>";
      }
  ?>
  </div>
</body>
</html>