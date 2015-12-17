<?php 
session_start();

if (isset($_SESSION['admin'])){
	
	require '../includes/database.php';
	include ("../includes/adminheader.html");

	$productionid = null;
	if ( !empty($_GET['productionid'])) {
		$productionid = $_REQUEST['productionid'];
	}
	
	if ( null==$productionid ) {
			header("Location: ../productioncrud/crud.php");
	}
	
	if ( !empty($_POST)) 
	{
		// keep track validation errors
		$productionnameError = null;
		$productiontypefkError = null;
		$productiondateError = null;
		$productionpriceError = null;
		$productionimageError = null;
		
		// keep track post values
		$productionname = $_POST['productionname'];
		$productiontypefk = $_POST['productiontypefk'];
		$productiondate = $_POST['productiondate'];
		$productionprice = $_POST['productionprice'];
		$productionimage = $_POST['productionimage'];
		
		// validate input
		$valid = true;
		if (empty($productionname)) {
			$productionnameError = 'Please enter a production name.';
			$valid = false;
		}
		
		if (empty($productiontypefk)) {
			$productiontypefkError = 'Please enter the production type.';
			$valid = false;
		}

		if (empty($productiondate)) {
			$productiondateError = 'Please enter the production date.';
			$valid = false;
		}

		if (empty($productionprice)) {
            $productionpriceError = 'Please enter Production Price';
            $valid = false;
        } 

        if (empty($productionimage)) {
            $productionimageError = 'Please enter Production Image';
            $valid = false;
        } 
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE production SET productionname = ?, productiontypefk = ?, productiondate = ?, productionprice = ?, productionimage = ? WHERE productionid = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($productionname,$productiontypefk,$productiondate,$productionprice,$productionimage,$productionid));
			Database::disconnect();
			header("Location: ../productioncrud/crud.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM production where productionid = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($productionid));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$productionname = $data['productionname'];
		$productiontypefk = $data['productiontypefk'];
		$productiondate = $data['productiondate'];
		$productionprice = $data['productionprice'];
		$productionimage = $data['productionimage'];
		Database::disconnect();
	}
?>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Update a Production</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="update.php?productionid=<?php echo $productionid?>" method="post">
					  <div class="control-group <?php echo !empty($productionnameError)?'error':'';?>">
					    <label class="control-label">Production Name</label>
					    <div class="controls">
					      	<input name="productionname" type="text"  placeholder="Production Name" value="<?php echo !empty($productionname)?$productionname:'';?>">
					      	<?php if (!empty($productionnameError)): ?>
					      		<span class="help-inline"><?php echo $productionnameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($productiontypefkError)?'error':'';?>">
                        <label class="control-label">Production Type</label>
                        <div class="controls">
                            <input name="productiontypefk" type="text" placeholder="Production Type" value="<?php echo !empty($productiontypefk)?$productiontypefk:'';?>">
                            <?php if (!empty($productiontypefkError)): ?>
                                <span class="help-inline"><?php echo $productiontypefkError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($productiondateError)?'error':'';?>">
                        <label class="control-label">Production Date</label>
                        <div class="controls">
                            <input name="productiondate" type="text" placeholder="Production Date" value="<?php echo !empty($productiondate)?$productiondate:'';?>">
                            <?php if (!empty($productiondateError)): ?>
                                <span class="help-inline"><?php echo $productiondateError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					   <div class="control-group <?php echo !empty($productionpriceError)?'error':'';?>">
                        <label class="control-label">Production Price</label>
                        <div class="controls">
                            <input name="productionprice" type="text" placeholder="Production Price" value="<?php echo !empty($productionprice)?$productionprice:'';?>">
                            <?php if (!empty($productionpriceError)): ?>
                                <span class="help-inline"><?php echo $productionpriceError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                       <div class="control-group <?php echo !empty($productionimageError)?'error':'';?>">
                        <label class="control-label">Production Image</label>
                        <div class="controls">
                            <input name="productionimage" type="text" placeholder="Production Image" value="<?php echo !empty($productionimage)?$productionimage:'';?>">
                            <?php if (!empty($productionimageError)): ?>
                                <span class="help-inline"><?php echo $productionimageError;?></span>
                            <?php endif;?>
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