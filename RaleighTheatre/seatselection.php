<?php
include("./includes/header.html");
?>
<div class="col-lg-6">
	<br><br><img src="http://s13.postimg.org/5wn7yp8uv/SEATING_LAYOUT.png">
</div>

<div class="col-lg-6">
	<h1 style="color:#d9534f">Seat selection</h1>
	
	<?php
	$seat = "";
		
	if(isset($_POST['SubmitButton'])){
		$seat .= $_POST['row'];
		$seat .= $_POST['number'];
			
		include("./includes/database.php");
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * from booking WHERE performancefk=".$_GET['performanceid']." AND seatfk= :seat";
		$q = $pdo->prepare($sql);
		$q->bindParam(':seat', $seat, PDO::PARAM_STR);
		$q->execute();
		$booked = $q-> rowCount();
		Database::disconnect();

		if($booked){ 
			echo '<span  style="font-size:20px; font-weight:600; color: #D11111">Sorry the seat '.$seat.' is already booked.</span><br><br>'; }
			 
		else{ 
			?>
			<span  style="font-size:20px; font-weight:600; color: #21D13E">The seat <?php echo $seat ?> is free.</span>&emsp;&emsp;
			<a href="./shoppingbasket.php?id=<?php echo  $_GET['performanceid'] ?>&fk=<?php echo $_GET['productionid'] ?>&seat=<?php echo $seat?>"  style="font-size:20px; font-weight:500; color:#D11111">Add to my basket</a>&nbsp&nbsp&nbsp
			<a href="./shoppingbasket.php?id=<?php echo  $_GET['performanceid'] ?>&fk=<?php echo $_GET['productionid'] ?>&seat=<?php echo $seat?>"><img src="./images/shopping_bag.png" width="35px" style="margin-top:-14px"></a><br><br>
		<?php }
	} ?>
		
	<!-- Seat selection form -->
	<span  style="font-size:20px; font-weight:500; color: black">Select seat:</span>
	<form action="" method="post">
		<select name="row">
			 <option value="A"<?php echo (isset($_POST['row']) && $_POST['row'] == 'A') ? ' selected="selected"' : '' ; ?>>A</option>
			 <option value="B"<?php echo (isset($_POST['row']) && $_POST['row'] == 'B') ? ' selected="selected"' : '' ; ?>>B</option>
			 <option value="C"<?php echo (isset($_POST['row']) && $_POST['row'] == 'C') ? ' selected="selected"' : '' ; ?>>C</option>
		</select>
			
		<select name="number">
			 <option value="1"<?php echo (isset($_POST['number']) && $_POST['number'] == 1) ? ' selected="selected"' : '' ; ?>>1</option>
			 <option value="2"<?php echo (isset($_POST['number']) && $_POST['number'] == 2) ? ' selected="selected"' : '' ; ?>>2</option>
			 <option value="3"<?php echo (isset($_POST['number']) && $_POST['number'] == 3) ? ' selected="selected"' : '' ; ?>>3</option>
			 <option value="4"<?php echo (isset($_POST['number']) && $_POST['number'] == 4) ? ' selected="selected"' : '' ; ?>>4</option>
			 <option value="5"<?php echo (isset($_POST['number']) && $_POST['number'] ==  5) ? ' selected="selected"' : '' ; ?>>5</option>
			 <option value="6"<?php echo (isset($_POST['number']) && $_POST['number'] == 6) ? ' selected="selected"' : '' ; ?>>6</option>
		</select>
		
		<br><br><input type="submit" class="btn btn-danger" name="SubmitButton" value="CHECK AVAILABILITY" style="font-size:18px">			
	  </form> 
	  
</div>
</div>
</body>
</html>