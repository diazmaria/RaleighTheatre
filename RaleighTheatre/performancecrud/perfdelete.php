<?php
session_start();

if (isset($_SESSION['admin'])){
	
	require '../includes/database.php';
	include ("../includes/adminheader.html");

	$id = 0;
	
	if ( !empty($_GET['performanceid'])) {
		$performanceid = $_REQUEST['performanceid'];
	}
	
	if ( !empty($_POST)) {
		// keep track post values
		$performanceid = $_POST['performanceid'];
		
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM performance WHERE performanceid = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($performanceid));
		Database::disconnect();
		     header("Location: ../performancecrud/crud.php");
		
	} 
?>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Delete a Performance</h3>
		    		</div>
		    		
	    			<form class="form-horizontal" action="perfdelete.php" method="post">
	    			  <input type="hidden" name="performanceid" value="<?php echo $performanceid;?>"/>
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