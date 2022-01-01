<?php
include('authentication.php');
include('includes/header.php');
?>


    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php

                if(isset($_SESSION['status']))
                {
                    echo "<h5 class='alert alert-success'>".$_SESSION['status']."</h5>";
                    unset($_SESSION['status']);
                }

                 ?>

                <div class="card">
                    <div class="card-header">
                        <h4>
                            Kutana Admin Panel
                            <a href="add-product.php" class="btn btn-primary float-end">Add Products</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-stripped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Expiry Date</th>
                                    <th>Image</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    include('dbcon.php');

                                    $ref_table = "product/Food/";
                                    $fetchdata = $database->getReference($ref_table)->getValue(); 

                                    if ($fetchdata > 0)
                                    {
                                        $i=1;
                                        foreach($fetchdata as $key => $row)
                                        {
                                            ?>
                                            <tr>
                                                <td><?=$key;?></td>
                                                <td><?=$row['price'];?></td>
                                                <td><?=$row['quantity'];?></td>
                                                <td><?=$row['expired'];?></td>
                                                <td><?=$row['image'];?></td>
                                                <td>
                                                    <a href="edit-product.php?id=<?=$key?>" class="btn btn-primary btn-sm">Edit</a>
                                                </td>
                                                <td>
                                                    <!--<a href="delete-product.php" class="btn btn-danger btn-sm">Delete</a>-->
                                                    <form action="code.php" method="POST">
                                                        <button type="submit" name="delete_btn" value="<?=$key?>" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                            <tr>
                                                <td colspan="7">No Record Found</td>
                                            </tr>
                                        <?php
                                    }
                                ?>

                                <tr>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include('includes/footer.php');
?>
   