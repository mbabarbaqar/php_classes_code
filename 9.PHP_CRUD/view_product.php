<?php 
include "database.php";

$id = "";
if(isset($_GET['id'])){
    $id = $_GET['id'];
}

$product = array();
if(!empty($id)){
    $sqlSelect = "SELECT * FROM products WHERE id='$id' ";
    
    $result = $conn->query($sqlSelect);
    
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $product = $row;
      }
    } else {
      echo "0 results";
    }
}else{
    die("Product id is empty.");
}
$conn->close();

//var_dump($product);exit;


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Botstrap CRUD</title>
        <link href="./assets/plugins/bootstrap.5.1/bootstrap.min.css" rel="stylesheet">
        <script src="./assets/plugins/bootstrap.5.1/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="row">
            <div class="col-md-8" style="margin: 0 auto;">
                <h1>Product Information</h1>
            </div>
            <div class="col-md-8" style="margin: 0 auto;">
                <form>
                    <div class="mb-3">
                      <label for="name" class="form-label"><strong>Product Name</strong></label>
                      <label for="name" class="form-label"><?php echo $product['name'] ?></label>
                      
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label"><strong>Product Description</strong></label>
                        <label for="name" class="form-label"><?php echo $product['description'] ?></label>
                        
                      </div>
                    <div class="mb-3">
                        <label for="name" class="form-label"><strong>Is Active</strong></label>
                        <?php
                                        if($product["is_active"] == 1){
                                    ?>
                                        <span class="badge bg-primary">Yes</span>
                                    <?php
                                        }else{
                                    ?>
                                        <span class="badge bg-danger">No</span>
                                    <?php
                                        }
                                    ?>
                    </div>
                    <a href="index.php" type="button" class="btn btn-info">Back</a>
                  </form>
            </div>
        </div>
    </body>
</html>
