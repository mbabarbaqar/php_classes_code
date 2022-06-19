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
        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
      }
    } else {
      echo "0 results";
    }
}else{
    die("Product id is empty.");
}


if(isset($_POST["edit_form"])){
    $name = $_POST["name"];
    $description = $_POST["description"];
    $is_active = $_POST["is_active"] == "on" ? 1 : 0;


    $sql = "UPDATE products SET name='$name', description='$description', is_active=$is_active WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
      echo "Record updated successfully";
      header('Location: index.php');
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

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
                <h1>Edit Product - Bootstrap</h1>
            </div>
            <div class="col-md-8" style="margin: 0 auto;">
                <form action="" method="post">
                    <div class="mb-3">
                      <label for="name" class="form-label">Product Name</label>
                      <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" value="<?php echo $product['name']; ?>">
                      <div id="nameHelp" class="form-text">Name of the product.</div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <textarea name="description" class="form-control" placeholder="Product Description here" id="description" style="height: 100px"><?php echo $product['description']; ?></textarea>
                            <label for="description">Description</label>
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                      <input type="checkbox" class="form-check-input" id="isActive" name="is_active" <?php echo $product['is_active'] == 1 ? "checked": ""; ?>>
                      <label class="form-check-label" for="isActive">Is Active</label>
                    </div>
                    <a href="index.php" type="button" class="btn btn-info">Back</a>
                    <button type="submit" name="edit_form" class="btn btn-primary">Update</button>
                  </form>
            </div>
        </div>
    </body>
</html>
