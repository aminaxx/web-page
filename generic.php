<?php  include "connection.php"; ?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Transaction</title>
    <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
			<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="icon" href="icon.png">
  
	</head>
	<body class="subpage">
		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="index.php" class="logo">Moowln</a>
					<nav id="nav">
							<nav id="nav">
									<a href="index.php">Home</a>
									<a href="generic.php">Currencies</a>
									<a href="add.php">Statistics</a>
							</nav>
					<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
					</nav>
				</div>
			</header>
<!-- main-->
	 
<div class="budget">
<div class="container budget-table">
	<br>
	<br>
        <h1 class="title" style="font-size: 2.5rem; font-family: sans-serif;">Here are your transactions, Mr.Musk</h1>
        <table id="Table" class="compact">
          <thead>
            <tr>
                <th scope="col">Category</th>
                <th scope="col">Amount</th>
                <th scope="col">Type</th>
                <th scope="col">Payment method</th>
                <th scope="col">Date</th>
            </tr>
          </thead>
          <tbody>
            <?php
                                 $query = "SELECT transactions.*, categories.category, categories.idAccounting, payments.paymentMethod FROM transactions, categories, payments WHERE transactions.idCategory = categories.idCategory AND transactions.idPayment = payments.idPayment";
																 $result = $mysqli->query($query);
																 $total = 0;
																 while($row = $result->fetch_assoc()){

																	 $transactionName   = $row['category'];
																	 $transactionAmount = intval($row['transactionAmount']);
																	 $transactionDate   = $row['transactionDate'];
																	 $paymentMethod     = $row['paymentMethod'];
																	 $idAccounting      = intval($row['idAccounting']);
																	 if($idAccounting == 1){
																		 $accountingType = "income";
																		 $coef = 1;
																	 } else {
																		 $accountingType = "expense";
																		 $coef = -1;
																	 }
                $total += $coef * $transactionAmount;
                $transactionAmount *= $coef;
                echo "<tr>";
                echo "<td>{$transactionName}</td>";
                echo "<td>{$transactionAmount}</td>";
                echo "<td>{$accountingType}</td>";
                echo "<td>{$paymentMethod}</td>";
                echo "<td>{$transactionDate}</td>";
                echo "</tr>";
              }
            ?>
          </tbody>
        </table>
			</div>
						</div>
		
		<script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
    
    <script>
        $(document).ready( function () {
            $('#Table').DataTable({
              responsive: true
            });
        } );
    </script>


<a href="add.php" class="btn btn-danger btn-lg btn-block" role="button" aria-pressed="true">See some statistics and more</a>


<footer id="footer">
				<div class="inner">
					<div class="flex">
						<div class="copyright">
							&copy; Amina Hajiyeva CS017
						</div>
						<ul class="icons">
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-linkedin"><span class="label">linkedIn</span></a></li>
							<li><a href="#" class="icon fa-pinterest-p"><span class="label">Pinterest</span></a></li>
							<li><a href="#" class="icon fa-vimeo"><span class="label">Vimeo</span></a></li>
						</ul>
					</div>
				</div>
			</footer>
	</body>
</html>