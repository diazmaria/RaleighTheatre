<?php
session_start();

if (isset($_SESSION['admin'])){
	
	require '../includes/database.php';
	include ("../includes/adminheader.html");
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $performancedateError = null;
        $productionfkError = null;
         
        // keep track post values
        $performancedate = $_POST['performancedate'];
        $productionfk = $_POST['productionfk'];
         
        // validate input
        $valid = true;
        if (empty($performancedate)) {
            $performancedateError = 'Please enter Performace Date';
            $valid = false;
        }

         $valid = true;
        if (empty($productionfk)) {
            $productionfkError = 'Please enter Production Name';
            $valid = false;
        }


        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO performance (performancedate, productionfk) values(?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($performancedate, $productionfk));
            Database::disconnect();
            header("Location: ../performancecrud/crud.php");
        }
    }
?>


<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Create a Performance</h3>
                    </div>
             
                    <form class="form-horizontal" action="perfcreate.php" method="post">
                      <div class="control-group <?php echo !empty($performancedateError)?'error':'';?>">
                        <label class="control-label">Performace Date</label>
                        <div class="controls">
                            <input name="performancedate" type="text"  placeholder="Performance Date" value="<?php echo !empty($performancedate)?$performancedate:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($productionfkError)?'error':'';?>">
                        <label class="control-label">Performace Name</label>
                        <div class="controls">
                            <input name="productionfk" type="text"  placeholder="productionfk" value="<?php echo !empty($productionfk)?$productionfk:'';?>">
                            <?php if (!empty($productionfkError)): ?>
                                <span class="help-inline"><?php echo $productionfkError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="form-actions">
            <br>
                          <button type="submit" class="btn btn-success">Create</button>
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
