products.php
<?php
include ("navbar.php");
include("../database/connection.php");
include("../database/query.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles.css">
    <title>Products</title>
</head>
<body>

    <!-- Hero Section -->
    <section id="main-content" class="d-flex flex-column justify-content-center align-items-center text-center">
        <div class="container">
            <h2 class="display-3 fw-bold text-white">Alpha Grind Lab</h2>
            <p class="fw-bold text-white">MAKE THAT FIRST STEP, YOU WILL NEVER WANT TO STOP.</p>
        </div>
    </section>

    <section class="container py-5">
        <h2 class="text-center fw-bold">PRODUCTS</h2>

        <?php foreach ($categories as $product_type => $items): ?>
            <?php if (!empty($items)): ?>
                <div class="mt-5">
                    <h4 class="fw-bold"> <?= $product_type === "Gear" ? "Fitness Gears" : "Supplements"; ?> </h4>
                    <br><br>
                    <div class="row">
                        <?php foreach ($items as $item): ?>
                            <div class="col-md-4 text-center mb-4 d-flex">
                                <div class="p-3 border rounded shadow-sm d-flex flex-column w-100" style="min-height: 500px; height: 100%;">
                                    <div class="bg-light d-flex justify-content-center align-items-center" style="width: 100%; height: 250px; overflow: hidden;">
                                        <?php if (!empty($item["image"])): ?>
                                            <img src="<?= htmlspecialchars($item["image"]); ?>"
                                                 alt="<?= htmlspecialchars($item["product"]); ?>"
                                                 class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="bg-secondary w-100 h-100 d-flex justify-content-center align-items-center text-white">
                                                <span>No Image Available</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-grow-1 d-flex flex-column justify-content-between">
                                        <p class="fw-bold mt-3"> <?= htmlspecialchars($item["product"]); ?> </p>
                                        <p class="flex-grow-1"> <?= nl2br(htmlspecialchars($item["description"])); ?> </p>
                                        <p class="fw-bold text-primary">PHP <?= number_format($item["price"], 2); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </section>




    <?php include ("footer.php"); ?>

</body>
</html>
