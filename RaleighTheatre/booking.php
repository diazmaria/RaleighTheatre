<?php
session_start();
include("./includes/header.html");
include("./includes/database.php");

if ( isset($_SESSION['basket']) && isset ($_SESSION['customer']) ){
	
	$arreglo = $_SESSION['basket'];
	$customer = $_SESSION['customer'];

	$count = 0;
	$message = true;

	for($i=0; $i<count($arreglo);$i++){
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * from booking WHERE performancefk=".$arreglo[$i]['Id']." AND seatfk= :var";
		$q = $pdo->prepare($sql);
		$q->bindParam(':var', $arreglo[$i]['Performanceseat'], PDO::PARAM_STR);
		$q->execute();
		$same =  $q-> rowCount();

		if ($same){
				if ($message) {?> <div class="row"><div class="col-lg-12"><span style="font-size:23px; font-weight:400; color:black">Sorry but the following tickets weren't booked because someone else booked them while you were browsing the site.<br></span><br></div></div><?php
					$message = false;}?>
			
				<div class="col-lg-4">
					<center><img src = "<?php echo $arreglo[$i]['Productionimage'];?>" width="120px"> <br>
						<span style="font-size:23px; font-weight:400; color:black"><?php echo $arreglo[$i]['Productionname'];?></span><br>
						<span style="font-size:20px; font-weight:400; color:black;font-style:italic"><?php echo date("l jS \of F Y", strtotime($arreglo[$i]['Performancedate']));?></span><br>
						<span style="font-size:20px; font-weight:400; color: black">18:00pm</span><br>
						<span style="font-size:20px; font-weight:400; color: black">Seat: <?php echo $arreglo[$i]['Performanceseat'] ?></span><br>
						<span style="font-size:20px; font-weight:600; color:#D11111">£<?php echo $arreglo[$i]['Productionprice'];?></span></center><br><br>
				</div><?php
			} 
			else $count++;
	}
	
	if($count){
		?><div class="col-lg-12"><div class="row"> </div><span style="font-size:40px; font-weight:300; color:#D11111">Purchase summary<br></span><br>
		<span style="font-size:23px; font-weight:400; color:black">Your tickets have been successfully booked! <br>Now you can collect them at the theatre showing your ticket ID. An email has been also sent to you with the details of your purchase.<br>THANK YOU!<br><br></span>
		</div><?php
		
		$sql = "insert into customers (customerid, firstname, lastname, street, town, postcode, phonenumber, email) values(
				'',	
				'".$customer['Firstname']."',
				'".$customer['Lastname']."',
				'".$customer['Street']."',
				'".$customer['Town']."',
				'".$customer['Postcode']."',
				'".$customer['Phonenumber']."',
				'".$customer['Email']."')";
		$q = $pdo->prepare($sql);
		$q->execute();
	
		$customernumber = $pdo-> lastInsertId();
		
		for($i=0; $i<count($arreglo);$i++){
			
			if(!$same)
			{
				$sql = "insert into booking (bookingid, bookingdate, customerfk, performancefk, seatfk) values(
				'',
				NOW(),
				'".$customernumber."',	
				'".$arreglo[$i]['Id']."',
				'".$arreglo[$i]['Performanceseat']."')";
				
				$q = $pdo->prepare($sql);
				$q->execute();
				
				$ticketreference = $arreglo[$i]['Id'];
				$ticketreference .= $arreglo[$i]['Performanceseat'];
				
				$bookingnumber =  $pdo-> lastInsertId();
				
				$sql = "insert into ticket (ticketid, performancefk, seatfk, bookingfk, ticketreference) values(
				'',
				'".$arreglo[$i]['Id']."',
				'".$arreglo[$i]['Performanceseat']."',
				'".$bookingnumber."',
				'".$ticketreference."')";
				
				$q = $pdo->prepare($sql);
				$q->execute();
				Database::disconnect();
				?>
				
				<div class="col-lg-4">
						<center><img src = "<?php echo $arreglo[$i]['Productionimage'];?>" width="120px"> <br>
						<span style="font-size:23px; font-weight:400; color:black"><?php echo $arreglo[$i]['Productionname'];?></span><br>
						<span style="font-size:20px; font-weight:400; color:black;font-style:italic"><?php echo date("l jS \of F Y", strtotime($arreglo[$i]['Performancedate']));?></span><br>
						<span style="font-size:20px; font-weight:400; color: black">18:00pm</span><br>
						<span style="font-size:20px; font-weight:400; color: black">Seat: <?php echo $arreglo[$i]['Performanceseat'] ?></span><br>
						<span style="font-size:20px; font-weight:600; color:#D11111"><img src="http://icons.iconarchive.com/icons/umar123/build/48/0025-Ticket-icon.png" width="40px">Ticket ID: <?php echo $ticketreference;?></span><br><br></center><br>
				</div><?php
				
			} 
		} $_SESSION['email'] = $customer['Email']; $_SESSION['reference'] = $ticketreference; include("sendemail.php"); unset($_SESSION['basket']);
		echo '<div class="row"></div><center><a href="./index.php"  style="font-size:22px; font-weight:400; color:#D11111">Go to the Home Page</a></center>';
	}
}
