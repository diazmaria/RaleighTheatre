<?php
session_start();

if (isset($_SESSION['admin'])){
	
	require '../includes/database.php';
	include ("../includes/adminheader.html");

    $id = null;
    if ( !empty($_GET['performanceid'])) {
        $performanceid = $_REQUEST['performanceid'];
    }
     
    if ( null==$performanceid ) {
          header("Location: ../performancecrud/crud.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM performance where performanceid = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($performanceid));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Read a Performance</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Performance Date</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['performancedate'];?>
                            </label>
                        </div>
                      </div>
                      <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Production Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['productionfk'];?>
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