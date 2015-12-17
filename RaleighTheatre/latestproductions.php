<?php
	include("./includes/header.html");
	include("./includes/database.php");
	
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM production ORDER BY productionid DESC LIMIT 3";
	$q = $pdo->prepare($sql);
	$q->execute();
	$rows = $q->fetchAll();
	Database::disconnect();	
	
    ?><span style="font-size:40px; font-weight:300; color:#d9534f">Latest Productions</span> <br><br><?php
	
	foreach ($rows as $f) {
	?><div class="col-sm-6 col-md-4">

<div class="thumbnail">
		<center>
                <a href="./performances.php?id=<?php echo $f['productionid'] ?>&name=<?php echo $f['productionname']?>"><img src="<?php echo $f['productionimage'];?>" style="width:40%; height:auto; margin-bottom:5px"></a>
			<div class="caption"><h3><?php echo $f['productionname'];?></h3>		
                           <h3>£<?php echo $f['productionprice'];?></h3>
			        <p><a href="./performances.php?id=<?php echo $f['productionid'] ?>&name=<?php echo $f['productionname']?>" style="color:#D11111; font-size:18px">View Performances</a></p>
                               </div>
		</center>
         </div>
</div><?php
	}?>

</div>
</body>
</html>