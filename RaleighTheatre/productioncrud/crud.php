<?php
session_start();

if (isset($_SESSION['admin'])){
	
	require '../includes/database.php';
	include ("../includes/adminheader.html");
?>

<body>
    <div class="container">
    		<div class="row"><br>
    			<h1  style="color:#d9534f; font-weight:200">Production CRUD</h1><br>
				<center><a href="../index.php"  style="font-size:22px; font-weight:400; color:#D11111">Go to the Home Page</a></center>
    		</div>
			<div class="row">
				<p>
					<a href="create.php" class="btn btn-success">Create</a>
				</p>
				
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Production ID</th>
		                  <th>Production Name</th>
		                  <th>Production Type</th>
		                  <th>Production Date</th>
		                  <th>Production Price</th>
		                  <th>Production Image</th>
		                  <th>Action</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					   $pdo = Database::connect();
					   $sql = 'SELECT * FROM production ORDER BY productionid ASC';
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
						   		echo '<td>'. $row['productionid'] . '</td>';
							   	echo '<td>'. $row['productionname'] . '</td>';
							   	echo '<td>'. $row['productiontypefk'] . '</td>';
							   	echo '<td>'. $row['productiondate'] . '</td>';
							   	echo '<td>'. $row['productionprice'] . '</td>';
							   	echo '<td><img src="'. $row['productionimage'] . '" width="100px"></td>';
							   	echo '<td width=250>';
							   	echo '<a class="btn" href="../productioncrud/read.php?productionid='.$row['productionid'].'">Read</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-success" href="../productioncrud/update.php?productionid='.$row['productionid'].'">Update</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-danger" href="../productioncrud/delete.php?productionid='.$row['productionid'].'">Delete</a>';
							   	echo '</td>';
							   	echo '</tr>';
					   }
					   Database::disconnect();
					  ?>
				      </tbody>
	            </table>
    	</div>
    </div> <!-- /container -->
  </body>
</html>
<?php
}
?>