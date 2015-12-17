<?php
include("./index.php");

if (isset($_GET['searcher'])){
	if ($_GET['searcher'])
	{
		$search = $_GET['terms'];

		if (empty($search))
		{
			echo '<h2>No search terms. Total of results: 0</h2>';
		}
		else
		{
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM production WHERE productionname LIKE '%$search%'";
			$q = $pdo->prepare($sql);
			$q->execute();
			$total = $q-> rowCount();
			$rows = $q->fetchAll();
			Database::disconnect();

			if ($total) {
				?><div class="col-sm-6" style="margin-top: 20px"><h1 style="color:#d9534f;display:inline">Results for:</h1>&nbsp <h2 style="display:inline"><?php echo $search?></h2>
				<br><br><span style="font-size:22px; color:#D11111"">Total of results: <?php echo $total ?></span><br><br><?php

				foreach ($rows as $row) {
				?>
					<div class="col-lg-6">
					<div class="thumbnail"><div class="caption" style="text-align:center; height:300px">
						
							<img src = "<?php echo $row['productionimage'];?>" width="100px"><br><br>
							<h3 style="font-size:19px; font-weight:300; color:black"><?php echo $row['productionname'];?></h3><br>
							<a href="./performances.php?id=<?php echo $row['productionid'] ?>&name=<?php echo $row['productionname']?>"  style="font-size:18px; font-weight:400; color:#D11111">View performances</a><br><br><br>
						</div></div>
					</div><?php
				}
				
				?>
				</div>
				<?php
			}
			else
			{
				?><h2>No results where found for: <?php echo $search ?> </h2><?php
			}
		}
	}
}?>
</div>
</body>
</html>