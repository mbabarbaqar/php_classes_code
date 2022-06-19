<?php 
include "database.php";

if(isset($_GET['delete'])){
    $deleteID = $_GET['delete'];
    $sqlDelete = "DELETE FROM products WHERE id = $deleteID";
    $conn->query($sqlDelete);
}

//Slect All products
$allProducts = array();
$sql = "SELECT * FROM products";
$productResult = $conn->query($sql);

if ($productResult->num_rows > 0) {
  // output data of each row
  while($row = $productResult->fetch_assoc()) {
    $allProducts[] = $row;
  }
} else {
  echo "0 results";
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
            &nbsp;
        </div>
        <div class="row">
            <div class="col-md-8" style="margin: 0 auto;">
                <h1>PHP CRUD - Bootstrap</h1>
            </div>
            <div class="col-md-8" style="margin: 0 auto;">
                <div class="row">
                    <div class="col-md-4">
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                          </form>
                    </div>
                    <div class="col-md-4">
                        <a href="add_product.php" type="button" class="btn btn-outline-primary pull-right">Add Product</a>
                    </div>
                </div>
                
            </div>
            <div class="col-md-8" style="margin: 0 auto;">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Is Active</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
                         foreach($allProducts as $allProduct){
                        ?>
                            <tr>
                                <th scope="row"><?php echo $allProduct["id"]; ?></th>
                                <td><?php echo $allProduct["name"]; ?></td>
                                <td><?php echo $allProduct["description"]; ?></td>
                                <td>
                                    <?php
                                        if($allProduct["is_active"] == 1){
                                    ?>
                                        <span class="badge bg-primary">Yes</span>
                                    <?php
                                        }else{
                                    ?>
                                        <span class="badge bg-danger">No</span>
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td>
                                    <a href="edit_product.php?id=<?php echo $allProduct["id"]; ?>" type="button" class="btn btn-outline-primary">Edit</a>
                                    <a href="view_product.php?id=<?php echo $allProduct["id"]; ?>" type="button" class="btn btn-outline-info">View</a>
                                    <a href="index.php?delete=<?php echo $allProduct["id"]; ?>" type="button" class="btn btn-outline-danger">Delete</a>

                                </td>
                            </tr>
                        <?php
                         }
                        ?>
                    </tbody>
                  </table>
            </div>

            <div class="col-md-8" style="margin:0 auto;">
                <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item disabled">
                        <a class="page-link">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </body>
</html>
