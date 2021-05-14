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
      background-color: skyblue;
      text-transform: uppercase;
    }

    td
    {
      color: white;
      padding: 25px;
      font-weight: bold;
      font-size: 17px;
      text-align: center;
      vertical-align: middle;
    }

    .row_hover:hover {
      color: black;
      background-color: black;
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

    @media screen and (max-width: 481px;)
    {
      div.table {
        width: 100px;
        margin-left: 0%;
        margin-right: 0%;
        padding: 0px;
        margin: 0px;
      }
      table {
        padding: 0px;
        margin: 0px;
      }
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
          <li><a href="view_customers.php">View Customers</a></li>
          <li><a class="active" href="view_transactions.php">View Transactions</a></li>
      </ul>
      </nav>
  </section>

  <section>
    <div class="table">
      <h2>Transaction History</h2>
      <table>
        <tr id="row-1">
          <th>Sender</th>
          <th>Sender A/C</th>
          <th>Reciever</th>
          <th>Reciever A/C</th>
          <th>Amount</th>
          <th>Date and Time</th>
        </tr>

        <?php
          $sql = "SELECT s_name, s_accno, r_name, r_accno, amount, date_time FROM transfer";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo "<tr class='row_hover'>";
              echo "<td>" . $row["s_name"]. "</td><td>" . $row["s_accno"] . "</td><td>" . $row["r_name"] . "</td><td>" . $row["r_accno"] . "</td><td>" . $row["amount"] . "</td><td>" . $row["date_time"];
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