<?php  include "connection.php"; ?>

<?php
function escape($string){
	global $mysqli;
	return $mysqli->real_escape_string(trim($string));
}

if(isset($_POST['submit'])){
	$amount    = $_POST['amount'];
	$method    = $_POST['method'];
	$category  = $_POST['category'];
    $date      = $_POST['date'];
    echo $date;
    
	$query_data = "INSERT INTO transactions(transactionAmount, transactionDate, idCategory, idPayment) VALUES('{$amount}' , '{$date}' , '{$category}' , '{$method}')";
	$result_data = $mysqli->query($query_data);
}
?>



<!DOCTYPE HTML>
<html>
	<head>
		<title>Moowln</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="icon" href="icon.png">
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<nav id="nav">
						<a href="index.php">Home</a>
						<a href="generic.php">Transactions</a>
						<a href="https://www.wsj.com/market-data">Market Data</a>
					</nav>
					<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
				</div>
			</header>

		<!-- Banner -->
			<section id="banner">
				<h1>Moowln will assest your budget</h1>
				<p>Just join Moowln and use your time efficiently</p>
			</section>

		<!-- One -->
			<section class="wrapper">
					<section>
							<div class="inner">
								<div class="row">
									<div class="col-md-6 py-5">
										<form action="generic.php" method="POST">
											<div class="form-group row">
												<div class="col-md-6">
													<label for="firstName">First Name of the Owner</label>
													<input type="text" class="form-control" id="firstName" name="firstName" value="Xavier">
												</div>
												<div class="col-md-6">
													<label for="lastName">Last Name of the Owner</label>
													<input type="text" class="form-control" id="lastName" name="lastName" value="Musk">
												</div>	
											</div>
										
										  <div class="form-group">	
											<label for="Name">Type of the transaction</label>
											<select name="category" class="form-control">		
											
											<?php
															$query_method = "SELECT * FROM categories";
															$result_method = $mysqli->query($query_method);
															while($row = $result_method->fetch_assoc()){
																$methodId   = $row['idCategory'];
																$methodName = $row['category'];
																echo "<option value='{$methodId}'>{$methodName}</option>";
															}
													?>		
                       						</select>
													
										  </div>
										  <div class="form-group">
											<label for="amount">Amount:   </label>
											<input type="number" name="amount" placeholder="1" id="amount" class="validate"> 
											<select>
												
											<?php
                                $query_method = "SELECT * FROM payments";
                                $result_method = $mysqli->query($query_method);
                                while($row = $result_method->fetch_assoc()){
                                    $methodId   = $row['idPayment'];
                                    $methodName = $row['paymentMethod'];
                                    echo "<option value='{$methodId}'>{$methodName}</option>";
                                }
                            ?>
														</select>
										</div>	
									</div>
									<div class="col-md-6 py-5">
										<div class="form-group">
											<label for="type">Accounting</label>
											<select class="form-control" id="type" name="accounting">
													<option value="Income" selected>Income</option> 
													<option value="Expence">Expence</option> 
													<?php
 
								?>
											</select>
										</div>
										<div class="form-group">
															
										</div>
										<div class="form-group">
											<label for="date">Date</label>
											<?php 
							$date =  date("Y-m-d");
							echo "<input type='date' class='form-control' id='date' name='date' value='{$date}'>";
						?>
									  </div>
									</div>
									<button type="submit" class="btn btn-danger w-75 mx-auto my-4 btn-lg" name="submit">Submit</button>
									<!-- </form> -->
								</div>
							</div>
					</section>
				</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					<div class="flex">
						<div class="copyright">
							&copy; By Hajiyeva Amina from CS017
						</div>
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
							<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
							<li><a href="#" class="icon fa-tumblr"><span class="label">Tumblr</span></a></li>
						</ul>
					</div>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
