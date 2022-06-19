<?php 
include "database.php";

if(isset($_POST["add_form"])){

    $name = $_POST["name"];
    $description = $_POST["description"];
    $is_active = $_POST["is_active"] == "on" ? 1 : 0;


    $sql = "INSERT INTO products (name, description, is_active)
    VALUES ('$name', '$description', '$is_active')";
    
    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
      header('Location: index.php');
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

$conn->close();

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
                <h1>Add Product - Bootstrap</h1>
            </div>
            <div class="col-md-8" style="margin: 0 auto;">
                <form action="" method="post">
                    <div class="mb-3">
                      <label for="name" class="form-label">Product Name</label>
                      <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp">
                      <div id="nameHelp" class="form-text">Name of the product.</div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <textarea name="description" class="form-control" placeholder="Product Description here" id="description" style="height: 100px"></textarea>
                            <label for="description">Description</label>
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                      <input type="checkbox" class="form-check-input" id="isActive" name="is_active">
                      <label class="form-check-label" for="isActive">Is Active</label>
                    </div>
                    <a href="index.php" type="button" class="btn btn-info">Back</a>
                    <button type="submit" name="add_form" class="btn btn-primary">Save</button>
                  </form>
            </div>
        </div>
    </body>
</html>
