<!-- <h1>List show</h1> -->
<div class="container mt-3">
    <div class="d-flex justify-content-between">
        <h3>Category list</h3>
        <div class=""><a href="./?page=category/create" class="btn btn-outline-success">Add Category</a></div>

    </div>
    <div class="card">
        <div class="body-card">
            <table class="table table-hover">
                <tr class="">
                    <th>No</th>
                    <td>Name</td>
                    <td>Slug</td>
                </tr>

                <?php
                $manage_categories = getCategories();
                if (!empty($manage_categories)) {
                    while ($row = $manage_categories->fetch_object()) {
                ?>
                        <tr>
                            <td><?php echo $row->id_category ?></td>
                            <td><?php echo $row->name ?></td>
                            <td><?php echo $row->slug ?></td>
                            <td>
                                <a href="./?page=category/update&id=<?php echo $row->id_category ?>" type="button" class="btn btn-outline-success">Update</a>
                                <a href="./?page=category/delete&id=<?php echo $row->id_category ?>" type="button" class="btn btn-outline-danger">Delete</a>
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
