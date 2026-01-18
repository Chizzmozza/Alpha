<?php
session_start();
include 'navbar.php';
include '../database/connection.php';

// Fetch products
$query = "SELECT * FROM products ORDER BY product_id ASC";
$result = mysqli_query($conn, $query);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Insert a new product only if all required fields are provided
    if (!empty($_POST['new_product']) && !empty($_POST['new_description']) && !empty($_POST['new_category']) && isset($_POST['new_price']) && $_POST['new_price'] !== '') {
        $new_product = mysqli_real_escape_string($conn, $_POST['new_product']);
        $new_description = mysqli_real_escape_string($conn, $_POST['new_description']);
        $new_category = mysqli_real_escape_string($conn, $_POST['new_category']);
        $new_price = floatval($_POST['new_price']); // Convert to a valid decimal number

        // Store the last selected category in session
        $_SESSION['last_selected_category']['new'] = $new_category;

        // Handle image upload with default image
        $image_path = '../pictures/alphalogo.png';
        if (!empty($_FILES['new_image']['name'])) {
            $target_dir = "../pictures/";
            $target_file = $target_dir . basename($_FILES['new_image']['name']);
            if (move_uploaded_file($_FILES['new_image']['tmp_name'], $target_file)) {
                $image_path = $target_file;
            }
        }

        $insert_query = "INSERT INTO products (product, description, product_type, price, image) VALUES ('$new_product', '$new_description', '$new_category', '$new_price', '$image_path')";
        mysqli_query($conn, $insert_query);
    }

    // Update existing products
    foreach ($_POST['products'] as $id => $product) {
        $updates = [];

        if (!empty($product['name'])) {
            $name = mysqli_real_escape_string($conn, $product['name']);
            $updates[] = "product='$name'";
        }
        if (!empty($product['description'])) {
            $description = mysqli_real_escape_string($conn, $product['description']);
            $updates[] = "description='$description'";
        }
        if (!empty($product['category'])) {
            $category = mysqli_real_escape_string($conn, $product['category']);
            $updates[] = "product_type='$category'";

            // Store last selected category for this product
            $_SESSION['last_selected_category'][$id] = $category;
        }
        if (isset($product['price']) && $product['price'] !== '') {
            $price = floatval($product['price']);
            $updates[] = "price='$price'";
        }

        // Handle image upload
        if (!empty($_FILES['products']['name'][$id]['image'])) {
            $target_dir = "../images/";
            $target_file = $target_dir . basename($_FILES['products']['name'][$id]['image']);
            if (move_uploaded_file($_FILES['products']['tmp_name'][$id]['image'], $target_file)) {
                $updates[] = "image='$target_file'";
            }
        }

        // Update only if there are fields to update
        if (!empty($updates)) {
            $update_query = "UPDATE products SET " . implode(', ', $updates) . " WHERE product_id='$id'";
            mysqli_query($conn, $update_query);
        }
    }

    header('Location: products.php?success=1');
    exit;
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = mysqli_real_escape_string($conn, $_GET['delete_id']);
    mysqli_query($conn, "DELETE FROM products WHERE product_id='$delete_id'");
    header('Location: products.php?success=1');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>Admin - Manage Products</title>
</head>
<body>
  <section class="main-content">
<div class="container mt-5">
      <h1 class="fw-bold mb-3 text-center">Manage Products</h1>



    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success text-center">Products updated successfully.</div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" class="bg-light p-4 rounded shadow">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Price (PHP)</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><input type="text" name="products[<?php echo $product['product_id']; ?>][name]" value="<?php echo htmlspecialchars($product['product']); ?>" class="form-control"></td>
                        <td><input type="text" name="products[<?php echo $product['product_id']; ?>][description]" value="<?php echo htmlspecialchars($product['description']); ?>" class="form-control"></td>
                        <td>
                            <select name="products[<?php echo $product['product_id']; ?>][category]" class="form-control">
                                <?php
                                $selected_category = $_SESSION['last_selected_category'][$product['product_id']] ?? $product['product_type'];
                                ?>
                                <option value="Gear" <?php echo ($selected_category == 'Gear') ? 'selected' : ''; ?>>Gear</option>
                                <option value="Supplements" <?php echo ($selected_category == 'Supplements') ? 'selected' : ''; ?>>Supplements</option>
                            </select>
                        </td>
                        <td><input type="number" step="0.01" name="products[<?php echo $product['product_id']; ?>][price]" value="<?php echo htmlspecialchars($product['price']); ?>" class="form-control"></td>
                        <td>
                            <input type="file" name="products[<?php echo $product['product_id']; ?>][image]" class="form-control">
                            <?php if (!empty($product['image'])): ?>
                                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image" class="mt-2" width="80">
                            <?php else: ?>
                                <img src="../pictures/alphalogo.png" alt="Default Image" class="mt-2" width="80">
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="products.php?delete_id=<?php echo $package['description_id']; ?>"
                                class="btn delete-icon-btn btn-danger"
                                title="Delete Package"
                                onclick="return confirm('Are you sure you want to delete this package?');">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td><input type="text" name="new_product" placeholder="New Product Name" class="form-control"></td>
                    <td><input type="text" name="new_description" placeholder="New Product Description" class="form-control"></td>
                    <td>
                        <select name="new_category" class="form-control">
                            <option value="">Select Category</option>
                            <option value="Gear" <?php echo ($_SESSION['last_selected_category']['new'] ?? '') == 'Gear' ? 'selected' : ''; ?>>Gear</option>
                            <option value="Supplements" <?php echo ($_SESSION['last_selected_category']['new'] ?? '') == 'Supplements' ? 'selected' : ''; ?>>Supplements</option>
                        </select>
                    </td>
                    <td><input type="number" step="0.01" name="new_price" placeholder="Price" class="form-control"></td>
                    <td><input type="file" name="new_image" class="form-control"></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-success save-icon-btn" title="Save">
                <i class="fas fa-save"></i>
            </button>
        </div>
        <script>
            // Save button confirmation
            document.querySelector('.save-icon-btn').addEventListener('click', function (event) {
                var confirmSave = confirm("Are you sure you want to save the changes?");
                if (!confirmSave) {
                    event.preventDefault(); // Prevent form submission if user cancels
                }
            });

            // Delete button confirmation
            const deleteButtons = document.querySelectorAll('.delete-icon-btn');
            deleteButtons.forEach(function (deleteButton) {
                deleteButton.addEventListener('click', function (event) {
                    var confirmDelete = confirm("Are you sure you want to delete this package?");
                    if (!confirmDelete) {
                        event.preventDefault(); // Prevent delete action if user cancels
                    }
                });
            });
        </script>
    </form>
</div>
</section>
</body>
</html>
