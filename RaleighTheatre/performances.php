<?php
include("./includes/header.html");

if (isset($_GET['id'])){
	
	include("./includes/database.php");
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "select * from performance WHERE productionfk=".$_GET['id']."";
	$q = $pdo->prepare($sql);
	$q->execute();
	$rows = $q->fetchAll();

	$sql = "select productionimage from production WHERE productionid=".$_GET['id']."";
	$q = $pdo->prepare($sql);
	$q->execute();
	$image = $q->fetch();
	Database::disconnect();

	?><h1  style="color:#d9534f"><?php echo$_GET['name']; ?></h1>
	<span style="font-size:30px; font-weight:300; color: black; padding-left:20px">Performances:</span><br><br> 
					 
	<?php
	foreach ($rows as $f){
		?><div class="col-sm-6 col-md-4">

<div class="thumbnail">
			<center>
				<img src="<?php 	echo $image['productionimage'];?>" style="width:40%; height:auto; margin-bottom:5px"><br>
				<div class="caption"><h3><?php echo date("l jS \of F Y", strtotime($f['performancedate']));?></h3>
				<h3>18:00pm</h3>
				<p><a href="./seatselection.php?productionid=<?php echo $_GET['id']?>&performanceid=<?php echo $f['performanceid'] ?>"  style="color:#D11111; font-size:18px">Select seat</a></p>
				</center>
		</div></div><?php 
} }?>
<br><br>
</div>
</body>
</html>