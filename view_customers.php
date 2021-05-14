<?php
  $host = "localhost"; /* Host name */
  $user = "root"; /* User */
  $password = ""; /* Password */
  $dbname = "onlinebanking"; /* Database name */

  $conn = mysqli_connect($host, $user, $password,$dbname);
  // Check connection
  if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Online Banking</title>
  <meta charset="utf-8">
  <meta name="viewport" content = "width=device-width, initial-scale = 1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="Home.css">
  <style type="text/css">
    #main-customer {
      width: 100%;
      height: 35vh;
      position: relative;
    }
   .footer_div {
    margin-top: 225px;
   }
    .bg-img 
    {
      background: url('images/background.jpg') no-repeat center center fixed;
      background-size: cover;
      padding-bottom: 0;
    }

    .table 
    {
      float: center;
      padding: 5px;
      margin-top: -150px;
      margin-bottom: -150px;
      width: 70%;
      margin-right: 15%;
      margin-left: 15%; 
    }

    table
    {
      font-family: poppins;
      font-weight: bold;
      background: rgba(75, 75, 75, 0.7);
      width: 100%;
      border: 1px solid black;
      padding: 5px;
      margin: 2px;
    }

    th
    {
      padding: 20px 20px;
      text-align: center;
      font-weight: bold;
      font-size: 20px;
      color: darkblue;
      text-transform: uppercase;
      background-color: skyblue;
    }

    td
    {
      color: white;
      padding: 20px;
      font-weight: bold;
      font-size: 17px;
      text-align: center;
      vertical-align: middle;
    }

    .table h2 
    {
      font-family: poppins;
      text-align: center;
      font-weight: bold;
      background: rgba(75, 75, 75, 0.7);
      width: 100%;
      height: 70px;
      border: 1px solid black;
      padding: 20px;
      margin: 2px;
      color: skyblue;
      text-transform: uppercase;
      letter-spacing: 2px;
      word-spacing: 6px;
    }
      .hover_row:hover {
        background-color: black;
      }

    .button 
    {
      width: 170px;
      height: 40px;
      justify-content: center;
      align-items: center;
      color: white;
      background-color: #28bbffd8;
      border-radius: 20px;
      box-shadow: 5px 10px 30px rgba(24, 139, 119, 0.2);
      border: none;
    }

    .button:hover 
    {
      background-color: #28bbffa4;
      transition: all ease 0.2s;
    }

    @media screen and (max-width: 700px;)
        { 
          nav
          
        }
   </style>
</head>
<body>
  <div class="bg-img">
  <section id="main-customer">
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
    <div class="table">
      <h2>Customer Information</h2>
      <table>
        <tr id="row-1">
          <th>Name</th>
          <th>Account Number</th>
          <th>View Profile</th>
        </tr>

        <?php
          $sql = "SELECT name, acc_number FROM customer";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo "<tr class='hover_row'>";
              echo "<form method ='post' action = 'customer_profile.php'>";
              echo "<td>" . $row["name"]. "</td><td>" . $row["acc_number"] . "</td>";
              echo "<td ><a href='customer_profile.php'><button type='submit'' name='user'  id='user' class='button' value= '{$row['name']}' ><span>View Profile</span></button></a></td>";
              echo "</tr>";
          }
          echo "</table>";
          } else { echo "0 results"; }
          $conn->close();
        ?>
    
      </table>
    </div>
  </section>
  <div class="footer_div">
      <?php include('footer.php')?>  
  </div> 
  </div>

 </body>
</html>