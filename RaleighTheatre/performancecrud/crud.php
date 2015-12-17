<?php
session_start();

if (isset($_SESSION['admin'])){
	
	require '../includes/database.php';
	include ("../includes/adminheader.html");
?>
<body>
    <div class="container">
    		<div class="row">
    				<h1  style="color:#d9534f; font-weight:200">Performance CRUD</h1><br>
				<center><a href="../index.php"  style="font-size:22px; font-weight:400; color:#D11111">Go to the Home Page</a></center>
    		</div>
			<div class="row">
				<p>
					<a href="perfcreate.php" class="btn btn-success">Create</a>
				</p>
				
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Performance ID</th>
		                  <th>Performance Date</th>
		                  <th>Production Name</th>
		                  <th>Action</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 

					   $pdo = Database::connect();
					   $sql = 'SELECT * FROM performance ORDER BY performanceid ASC';
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
						   		echo '<td>'. $row['performanceid'] . '</td>';
							   	echo '<td>'. $row['performancedate'] . '</td>';
							   	echo '<td>'. $row['productionfk'] . '</td>';
							   	echo '<td width=250>';
							   	echo '<a class="btn" href="../performancecrud/perfread.php?performanceid='.$row['performanceid'].'">Read</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-success" href="../performancecrud/perfupdate.php?performanceid='.$row['performanceid'].'">Update</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-danger" href="../performancecrud/perfdelete.php?performanceid='.$row['performanceid'].'">Delete</a>';
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