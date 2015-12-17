<?php
session_start();

if (isset($_SESSION['admin'])){
	
	require '../includes/database.php';
	include ("../includes/adminheader.html");

	$performanceid = null;
	if ( !empty($_GET['performanceid'])) {
		$performanceid = $_REQUEST['performanceid'];
	}
	
	if ( null==$performanceid ) {
   header("Location: ../performancecrud/crud.php");
	}
	
	if ( !empty($_POST)) 
	{
		// keep track validation errors
		$performancedateError = null;
		$productionfkError = null;
		
		// keep track post values
		$performancedate = $_POST['performancedate'];
		$productionfk = $_POST['productionfk'];
		
		// validate input
		$valid = true;
		if (empty($performancedate)) {
			$performanceError = 'Please enter a performance date.';
			$valid = false;
		}
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE performance SET performancedate = ?, productionfk = ? WHERE performanceid = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($performancedate, $productionfk, $performanceid));
			Database::disconnect();
			header("Location: ../performancecrud/crud.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM performance where performanceid = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($performanceid));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$performancedate = $data['performancedate'];
		$productionfk = $data['productionfk'];
		Database::disconnect();
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Update a Performance</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="perfupdate.php?performanceid=<?php echo $performanceid?>" method="post">
					  <div class="control-group <?php echo !empty($performancedateError)?'error':'';?>">
					    <label class="control-label">Performance Date</label>
					    <div class="controls">
					      	<input name="performancedate" type="text"  placeholder="Performance Date" value="<?php echo !empty($performancedate)?$performancedate:'';?>">
					      	<?php if (!empty($nameError)): ?>
					      		<span class="help-inline"><?php echo $nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($productionfkError)?'error':'';?>">
					    <label class="control-label">Production Name</label>
					    <div class="controls">
					      	<input name="productionfk" type="text"  placeholder="Production Name" value="<?php echo !empty($productionfk)?$productionfk:'';?>">
					      	<?php if (!empty($productionfkError)): ?>
					      		<span class="help-inline"><?php echo $productionfkError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>

					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="crud.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>
<?php
}
?>
