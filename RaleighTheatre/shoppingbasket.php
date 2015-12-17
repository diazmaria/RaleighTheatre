<?php
ob_start();
session_start();
include("./includes/header.html");
include("./includes/database.php");
?> 			
<!--- SHOPPING BASKET HEADER --->
<h1  style="color:#d9534f">My Shopping Basket</h1><br><br><br><?php

if (isset($_SESSION['basket'])){
	
	if(isset($_GET['id'])){
		
		$arreglo = $_SESSION['basket'];
		$productionname =  "";
		$productionimage =  "";
		$performancedate = 0;
		$productionprice =  0;
		$performanceseat = "";
					
		$same = false;
		
		for($i=0; $i<count($arreglo); $i++){ 
		
		if ($arreglo[$i]['Id'] == $_GET['id'] && $arreglo[$i]['Performanceseat'] == $_GET['seat'])
					$same = true;}
				
		if(!$same)	{
				
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "select performancedate from performance where performanceid=".$_GET['id'];
			$q = $pdo->prepare($sql);
			$q->execute();
			$f =  $q-> fetch();
				
			$sql = "select productionname, productionimage, productionprice from production WHERE productionid=".$_GET['fk'];
			$q = $pdo->prepare($sql);
			$q->execute();
			$prod =  $q-> fetch();
			$pdo = Database::disconnect();
				
			$productionname =  $prod['productionname']; 
			$productionimage= $prod['productionimage'];
			$productionprice= $prod['productionprice'];
						
			$performancedate = $f['performancedate'];
			
			$newData = array('Id' => $_GET['id'],
			'Productionname' => $productionname,
			'Productionimage' => $productionimage,
			'Performancedate' => $performancedate,
			'Productionprice' => $productionprice,
			'Performanceseat' => $_GET['seat']);
						
			array_push($arreglo, $newData);
			$_SESSION['basket'] = $arreglo;
		}
	}
}
			
else{
		
	if (isset($_GET['id'])){
					
		$productionname="";
		$productionimage="";
		$performancedate = 0;
		$productionprice= 0;
					
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "select performancedate from performance where performanceid=".$_GET['id'];
			$q = $pdo->prepare($sql);
			$q->execute();
			$f =  $q-> fetch();
				$performancedate = $f['performancedate'];
			
			$sql = "select productionname, productionimage, productionprice from production WHERE productionid=".$_GET['fk'];
			$p = $pdo->prepare($sql);
			$p->execute();
			$prod =  $p-> fetch();

			$productionname =  $prod['productionname']; 
			$productionimage= $prod['productionimage'];
			$productionprice= $prod['productionprice'];
				
			$pdo = Database::disconnect();	

			$arreglo[] = array('Id' => $_GET['id'],
			'Productionname' => $productionname,
			'Productionimage' => $productionimage,
			'Performancedate' => $performancedate,
			'Productionprice' => $productionprice,
		    'Performanceseat' => $_GET['seat']);
					
			 $_SESSION['basket'] = $arreglo;
		}
}

if(isset($_SESSION['basket'])) {
			
	$data = $_SESSION ['basket'];
	$total = 0;
	
	for ($i=0; $i<count($data); $i++){
		?>
		<div class="col-lg-4">
			<center><img src = "<?php echo $data[$i]['Productionimage'];?>" width="120px"> <br>
			<span style="font-size:23px; font-weight:400; color:black"><?php echo $data[$i]['Productionname'];?></span><br>
			<span style="font-size:20px; font-weight:400; color:black;font-style:italic"><?php echo date("l jS \of F Y", strtotime($data[$i]['Performancedate']));?></span><br>
			<span style="font-size:20px; font-weight:400; color: black">18:00pm</span><br>
			<span style="font-size:20px; font-weight:400; color: black">Seat: <?php echo $data[$i]['Performanceseat'] ?></span><br>
			<span style="font-size:20px; font-weight:600; color:#D11111">£<?php echo $data[$i]['Productionprice'];?></span><br><br></center><br>
			
		</div>
		<?php
		$total += $data[$i]['Productionprice'];
		}
			
		$_SESSION['total'] = $total;

		?> 
				<div class="col-lg-4">
				<center><span style="font-size:21px; font-weight:600; color:#D11111">Total: £<?php echo $total;?></span><center><br>
				<center><a class="btn btn-danger" href="./customer.php" role="button"  style="font-size:18px">BOOK NOW</a></center><br>  
			
				<center><a href='shoppingbasket.php?empty=true' style="font-size:22px; font-weight:400; color:#D11111">Empty basket</a></center>  </div>
		<?php
} 
		
else{
	echo '<center><h2>The shopping basket is empty</h2>';
	echo '<br><center><a href="./index.php"  style="font-size:22px; font-weight:400; color:#D11111">Go to the Home Page</a></center>';
}

if (isset($_GET['empty'])) {
	unset($_SESSION['basket']);

	header( 'Location:  ./shoppingbasket.php' ) ;
}
ob_end_flush();
?>

</body>
</html>