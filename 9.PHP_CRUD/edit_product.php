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
                <form>
                    <div class="mb-3">
                      <label for="name" class="form-label">Product Name</label>
                      <input type="text" class="form-control" id="name" aria-describedby="emailHelp">
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
                    <a href="index.html" type="button" class="btn btn-info">Back</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                  </form>
            </div>
        </div>
    </body>
</html>