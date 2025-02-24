<?php
$name_err = $slug_err = $price_err = $short_des_err = $long_des_err = '';

if (
    isset($_POST['name']) &&
    isset($_POST['slug']) &&
    isset($_POST['price']) &&
    isset($_POST['short_des']) &&
    isset($_POST['long_des'])
) {
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $price = $_POST['price'];
    $short_des = $_POST['short_des'];
    $long_des = $_POST['long_des'];
    $id_categories = isset($_POST['id_categories']) ? $_POST['id_categories'] : [];

    if (empty($name)) {
        $name_err = 'Name is required';
    } elseif (productNameExit($name)) {
        $name_err = 'Name already exists!';
    }

    if (empty($slug)) {
        $slug_err = 'Slug is required';
    } elseif (productNameExit($slug)) {
        $slug_err = 'Slug already exists!';
    }

    if (empty($price)) {
        $price_err = 'Price is required';
    } elseif ($price < 0) {
        $price_err = 'Price must not be lower than zero!';
    }

    if (empty($short_des)) {
        $short_des_err = 'Short Description is required';
    }

    if (empty($long_des)) {
        $long_des_err = 'Long Description is required';
    }

    if (empty($name_err) && empty($slug_err) && empty($price_err) && empty($short_des_err) && empty($long_des_err) && !empty($id_categories)) {
        if (createProduct($name, $slug, $price, $short_des, $long_des, $id_categories)) {
            echo '<div class="alert alert-success" role="alert">
                Product created successfully. <a href="./?page=product/home">Product Page!</a>
                </div>';
            unset($_POST['name']);
            unset($_POST['slug']);
            unset($_POST['price']);
            unset($_POST['short_des']);
            unset($_POST['long_des']);
            unset($_POST['id_categories']);
        } else {
            echo '<div class="alert alert-danger" role="alert">
                Product created failed.
                </div>';
        }
    }
}
?>

<!-- Login Form -->
<form action="./?page=product/create" method="post" style="max-width: 500px; margin-top: 50px;" class="mx-auto p-4">
    <h1 class="text-center mb-4">Create Product</h1>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name"
            class="form-control <?php echo !empty($name_err) ? 'is-invalid' : ''; ?>"
            value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" placeholder="Enter your name">
        <div class="invalid-feedback">
            <?php echo $name_err; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control <?php echo !empty($slug_err) ? 'is-invalid' : ''; ?>"
            value="<?php echo htmlspecialchars($_POST['slug'] ?? ''); ?>"
            placeholder="Enter your slug">
        <div class="invalid-feedback">
            <?php echo $slug_err; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" name="price" class="form-control <?php echo !empty($price_err) ? 'is-invalid' : ''; ?>"
            value="<?php echo htmlspecialchars($_POST['price'] ?? ''); ?>"
            placeholder="Enter your price">
        <div class="invalid-feedback">
            <?php echo $price_err; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="short_des" class="form-label">Short Description</label>
        <textarea name="short_des" class="form-control <?php echo !empty($short_des_err) ? 'is-invalid' : ''; ?>" placeholder="Enter short description"><?php echo htmlspecialchars($_POST['short_des'] ?? ''); ?></textarea>
        <div class="invalid-feedback">
            <?php echo $short_des_err; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="long_des" class="form-label">Long Description</label>
        <textarea name="long_des" class="form-control <?php echo !empty($long_des_err) ? 'is-invalid' : ''; ?>" placeholder="Enter long description"><?php echo htmlspecialchars($_POST['long_des'] ?? ''); ?></textarea>
        <div class="invalid-feedback">
            <?php echo $long_des_err; ?>
        </div>
    </div>
    <div class="mb-3">
        <?php
        $manage_categories = getCategories();
        if (!empty($manage_categories)) {
            while ($row = $manage_categories->fetch_object()) {
        ?>
                <div class="form-check">
                    <input name="id_categories[]" class="form-check-input" type="checkbox" value="<?php echo $row->id_category ?>" id="category-<?php echo $row->id_category ?>">
                    <label class="form-check-label" for="category-<?php echo $row->id_category ?>">
                        <?php echo $row->name ?>
                    </label>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <div class="d-flex justify-content-between">
        <a href="./?page=product/home" class="btn btn-outline-danger">Cancel</a>
        <button type="submit" class="btn btn-outline-success">Create</button>
    </div>
</form>
<!-- End Login Form -->