
<?php
// Fetch existing membership packages
$query = "SELECT * FROM descriptions ORDER BY description_id ASC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

$packages = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<?php
// Fetch products from database
$sql = "SELECT product, description, price, product_type, image FROM products";
$result = $conn->query($sql);

// Group products by category
$categories = ["Gear" => [], "Supplements" => []];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[$row["product_type"]][] = $row;
    }
}

 ?>
