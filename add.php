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
									<a href="https://tradingeconomics.com/currencies">Currency Rates</a>
							</nav>
					<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
					</nav>
				</div>
            </header>
            

	<!-- Lasst Month -->
	<?php
                        $totalLastMonth = 0;
                        $dayFirst   = date('Y-m-01');
                        $dayCurrent = date('Y-m-d');
                        $queryLastMonth = "SELECT transactions.transactionAmount, categories.category, categories.idAccounting FROM transactions, categories WHERE transactions.idCategory = categories.idCategory AND `transactionDate` BETWEEN '{$dayFirst}' AND '{$dayCurrent}'";
                        $resultLastMonth = $mysqli->query($queryLastMonth);
                        while($row = $resultLastMonth->fetch_assoc()){
                          $amount       = intval($row['transactionAmount']);
                          $idAccounting = intval($row['idAccounting']);
                          if($idAccounting == 1){
                            $coef = 1;
                          } else {
                            $coef = -1;
                          }
                          $totalLastMonth += $coef * $amount;
                        }
                        if($totalLastMonth > 0){
                          $className = "badge-success";
                        } else if($totalLastMonth < 0){
                          $className = "badge-danger";
                        } else {
                          $className = "badge-warning";
                        }
					  ?>
					  
					  <?php
                       $cyear = date('Y');
                       


                        $totalLastYear=0;
                        $queryLastYear = "SELECT transactions.transactionAmount, categories.category, categories.idAccounting FROM transactions, categories WHERE transactions.idCategory = categories.idCategory
                         AND year(transactionDate) = '{$cyear}'";
                        $resultLastYear = $mysqli->query($queryLastYear);
                        while($row = $resultLastYear->fetch_assoc()){
                          $amountLastYear= intval($row['transactionAmount']);
                          $idAccounting   = intval($row['idAccounting']);
                          if($idAccounting == 1){
                            $coef = 1;
                            
                          } else {
							$coef = -1;
							
                          }
                          $totalLastYear += $coef * $amountLastYear;
                        }
                      ?>


	<div class="row" style="margin-top: 50px;">
			<div class="col-md-12">
					<div class="row">
						
							<div class="col-md-6 my-4 p-3">
									 <div class="card text-center">
											<div class="card-header bg-danger" style="color: white;">
													Last Year
											</div>
											<div class="card-body py-5">
													<h3 class="card-title">
														<?php echo "{$totalLastYear}₼" ?>
													</h3>
											</div>
									</div>
							</div>
							<div class="col-md-6 my-4 p-3">
									 <div class="card text-center">
											<div class="card-header bg-danger " style="color: white;">
													Last month
											</div>
											<div class="card-body py-5">
													<h3 class="card-title">
													<?php echo "{$totalLastMonth}₼"  ?>
                             
													</h3>
											</div>
									</div>
							</div>
							<?php
                        $queryExpenses = "SELECT COUNT(categories.idAccounting) AS Expenses FROm categories, transactions WHERE categories.idCategory = transactions.idCategory AND categories.idAccounting = 2";
                        $resultExpenses = $mysqli->query($queryExpenses);
                        $row = $resultExpenses->fetch_assoc();
                        $expense = $row['Expenses'];
                      ?>

							<div class="col-md-6 my-4 p-3">
											<div class="card text-center">
												 <div class="card-header bg-danger" style="color: white;">
														 Expence transactions
												 </div>
												 <div class="card-body py-5">
														 <h3 class="card-title"><?php echo "{$expense}₼"; ?></h3>
												 </div>
										 </div>
							</div>
							<!-- income php -->
							<?php
                        $queryIncomes = "SELECT COUNT(categories.idAccounting) AS Incomes FROm categories, transactions WHERE categories.idCategory = transactions.idCategory AND categories.idAccounting = 1";
                        $resultIncomes = $mysqli->query($queryIncomes);
                        $row = $resultIncomes->fetch_assoc();
                        $income = $row['Incomes'];
                      ?>
							<div class="col-md-6 my-4 p-3">
									<div class="card text-center">
											<div class="card-header bg-danger" style="color: white;">
													Income transactions
											</div>
											<div class="card-body py-5">
													<h3 class="card-title"><?php echo "{$income}₼"; ?></h3>
											</div>
									</div>
							</div>
							<?php
                    //today
                        $tdate=date('Y-m-d');
                        $totalToday = 0;
                        $queryToday = "SELECT transactions.transactionAmount, categories.category, categories.idAccounting FROM transactions, categories WHERE transactions.idCategory = categories.idCategory
                         AND `transactionDate` = '{$tdate}'";
                        $resultToday = $mysqli->query($queryToday);
                        while($row = $resultToday->fetch_assoc()){
                          $amountToday = intval($row['transactionAmount']);
                          $idAccounting   = intval($row['idAccounting']);
                          if($idAccounting == 1){
                            $coef = 1;
                          } else {
                            $coef = -1;
                          }
                          $totalToday += $coef * $amountToday;
                        }

                      ?>
							<div class="col-md-6 my-4 p-3" style="color: #c20b0b;">
									<div class="card text-center">
										   <div class="card-header">
												   Today
										   </div>
										   <div class="card-body py-5 bg-danger" style="color: white;">
												   <h3 class="card-title"><?php echo "{$totalToday} ₼"; ?></h3>
										   </div>
								   </div>
						   </div>

						   <div class="col-md-6 my-4 p-3" style="color: #c20b0b;">
								<div class="card text-center">
									   <div class="card-header">
										 We go beyond in it - Tips for managing your money
									   </div>
									   <div class="card-body py-5 bg-danger">
											   <h6 class="card-title">
												 <a href="https://americasaves.org/for-savers/make-a-plan-how-to-save-money/54-ways-to-save-money" class="card link">54 ways to save your money</a>
												 <br>
												 <a href="https://www.ruleoneinvesting.com/blog/financial-control/spending-money-wisely/" class="card link">Spending your money wisely</a>
												 </h6>
									   </div>
							   </div>
					   </div>
					</div>
			</div>
	</div>

</div>

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
            