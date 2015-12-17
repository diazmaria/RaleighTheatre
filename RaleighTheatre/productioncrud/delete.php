<?php 
session_start();

if (isset($_SESSION['admin'])){
	
	require '../includes/database.php';
	include ("../includes/adminheader.html");

	$id = 0;
	
	if ( !empty($_GET['productionid'])) {
		$productionid = $_REQUEST['productionid'];
	}
	
	if ( !empty($_POST)) {
		// keep track post values
		$productionid = $_POST['productionid'];
		
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM production  WHERE productionid = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($productionid));
		Database::disconnect();
		header("Location: ../productioncrud/crud.php");
		
	} 
?>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Delete a Production</h3>
		    		</div>
		    		
	    			<form class="form-horizontal" action="delete.php" method="post">
	    			  <input type="hidden" name="productionid" value="<?php echo $productionid;?>"/>
					  <p class="alert alert-error">Are you sure to delete ?</p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-danger">Yes</button>
						  <a class="btn" href="crud.php">No</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>
<?php
}
?>