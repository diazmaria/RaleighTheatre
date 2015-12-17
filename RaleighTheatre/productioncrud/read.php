<?php
session_start();

if (isset($_SESSION['admin'])){
	
	require '../includes/database.php';
	include ("../includes/adminheader.html");

    $id = null;
    if ( !empty($_GET['productionid'])) {
        $productionid = $_REQUEST['productionid'];
    }
     
    if ( null==$productionid ) {
        	header("Location: ../productioncrud/crud.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM production where productionid = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($productionid));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Read a Production</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Production Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['productionname'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Production Type</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['productiontypefk'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Production Date</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['productiondate'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Production Price</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['productionprice'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Production Image</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['productionimage'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="crud.php">Back</a>
                       </div>
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
<?php
}
?>