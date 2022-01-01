<?php
include('includes/header.php')
?>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Add Products
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="code.php" method="POST">

                            <div class="form-group mb-3">
                                <label>Price (In KSH)</label>
                                <input type="number" name="price" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label>Quantity</label>
                                <input type="number" name="quantity" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label>Expiry</label>
                                <input type="text" name="expired" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label>Image</label>
                                <input type="text" name="image" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="save_product" class="btn btn-primary">Save Product</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include('includes/footer.php')
?>
   