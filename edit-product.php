<?php
include('includes/header.php');
?>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Edit & Update Products
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                            include('dbcon.php');

                            if (isset($_GET['id'])) 
                            {
                                $key_child = $_GET['id'];
                                $ref_table = "product/Food";
                                $getdata = $database->getReference($ref_table)->getChild($key_child)->getValue();   

                                if ($getdata > 0) 
                                {
                                    ?>

                        <form action="code.php" method="POST">

                            <input type="hidden" name="key"> value="<?=$key_child;?>">

                            <div class="form-group mb-3">
                                <label>Price (In KSH)</label>
                                <input type="number" name="price" value="<?=$getdata['price'];?>" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label>Quantity</label>
                                <input type="number" name="quantity" value="<?=$getdata['quantity'];?>" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label>Expiry</label>
                                <input type="text" name="expired" value="<?=$getdata['expired'];?>" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label>Image</label>
                                <input type="text" name="image" value="<?=$getdata['image'];?>" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="update_product" class="btn btn-primary">Update Product</button>
                            </div>

                        </form>
                         <?php
                                }
                                else
                                {
                                    $_SESSION['status'] = "Invalid Found";
                                    header('Location: index.php');
                                    exit();
                                }

                            }
                            else
                            {
                                $_SESSION['status'] = "Not Found";
                                header('Location: index.php');
                                exit();
                            }
                             
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include('includes/footer.php');
?>
   