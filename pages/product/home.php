<!-- <h1>List show</h1> -->
<div class="container mt-3">
    <div class="d-flex justify-content-between">
        <h3>Product list</h3>
        <div class=""><a href="./?page=product/create" class="btn btn-outline-success">Add Product</a></div>

    </div>
    <div class="card">
        <div class="body-card">
            <table class="table table-hover">
                <tr class="">
                    <th>No</th>
                    <td>Name</td>
                    <td>Slug</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Short Description</td>


                </tr>

                <?php
                $manage_products = getProducts();
                if (!empty($manage_products)) {
                    while ($row = $manage_products->fetch_object()) {
                ?>
                        <tr>
                            <td><?php echo $row->id_product ?></td>
                            <td><?php echo $row->name ?></td>
                            <td><?php echo $row->slug ?></td>
                            <td><?php echo $row->price ?></td>
                            <td><?php echo $row->qty ?></td>
                            <td><?php echo $row->short_des ?></td>


                            <td>
                                <a href="./?page=product/update&id=<?php echo $row->id_product ?>" type="button" class="btn btn-outline-success">Update</a>
                                <a href="./?page=product/delete&id=<?php echo $row->id_product ?>" type="button" class="btn btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>

            </table>
        </div>
    </div>
</div>
