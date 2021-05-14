<html>
<head>
	<title>Online Banking</title>
  <meta name="viewport" content = "width=device-width, initial-scale = 1">
  <link rel="stylesheet" type="text/css" href="Home.css">
  <style type="text/css">
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
  <section id="main">
      <nav>
        <a href="home.php" class="logo">
          <img src="images/Yoro Bank.png" alt="The logo of bank">
        </a>

        <span class="menu-space"></span>

        <ul class="menu">
          <li><a class="active" href="home.php">Home</a></li>
          <li><a href="view_customers.php">View Customers</a></li>
          <li><a href="view_transactions.php">View Transactions</a></li>
    	</ul>
      </nav>
  </section>

  <section class="content">
    <div class="main-text">
      <h1>ONLINE BANKING</h1>
      <p>Your Perfect Banking Partner !</p><br>
      <a href="view_customers.php" class="btn">View Customers</a> <br>
      <a href="view_transactions.php" class="btn">View Transactions</a>
    </div>
    <div class="image">
      <img src="images/bgimage.jpg" alt="Banking System">
    </div>
  </section>
  <section class="footer">
    <?php include('footer.php')?>  
  </section>
</body>
</html>