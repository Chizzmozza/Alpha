<?php
include '../member/navbar.php';
include '../database/connection.php';

$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

$query = "SELECT * FROM food_history WHERE 1";
$params = [];

if (!empty($search)) {
    $query .= " AND food_name LIKE ?";
    $params[] = "%$search%";
}

if (!empty($category)) {
    $query .= " AND category = ?";
    $params[] = $category;
}

$query .= " ORDER BY id DESC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$foodLogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Add flags for alerts
$searchTriggered = !empty($search) || !empty($category);
$resultsFound = count($foodLogs) > 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Food History</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/style.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      font-family: Arial;
      background: #f0f0f0;
      padding: 30px;
    }

    .container {
      max-width: 800px;
      margin: auto;
      background: white;
      padding: 20px;
      border-radius: 12px;
    }

    .food-item {
      display: flex;
      align-items: center;
      border-bottom: 1px solid #ddd;
      padding: 10px 0;
    }

    .food-item img {
      width: 60px;
      height: 60px;
      border-radius: 10px;
      object-fit: cover;
      margin-right: 15px;
    }

    .food-info h4 {
      margin: 0;
      font-size: 16px;
    }

    .food-info small {
      color: gray;
    }

    nav a {
      margin-right: 15px;
      text-decoration: none;
      color: #4a78a6;
      font-size: 14px;
    }

    .filter-form {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }

    .filter-form input,
    .filter-form select,
    .filter-form button {
      padding: 8px 12px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 14px;
      width: 100%;
      max-width: 200px;
    }

    .filter-form button {
      background-color: #4a78a6;
      color: white;
      border: none;
      cursor: pointer;
    }

    @media (max-width: 600px) {
      .food-item {
        flex-direction: column;
        align-items: flex-start;
      }

      .food-item img {
        margin-bottom: 10px;
      }

      .filter-form input,
      .filter-form select,
      .filter-form button {
        max-width: 100%;
      }
    }
  </style>
</head>
<body>
  <nav>
    <a href="calorie_counter.php"><i class="fas fa-arrow-left"></i> Back to Log</a>
  </nav>

  <div class="container">
    <h2><i class="fas fa-book"></i> Food History</h2>

    <form method="GET" class="filter-form">
      <input type="text" name="search" placeholder="Search food..." value="<?= htmlspecialchars($search) ?>">
      <select name="category">
        <option value="">All Categories</option>
        <option value="breakfast" <?= $category === 'breakfast' ? 'selected' : '' ?>>Breakfast</option>
        <option value="lunch" <?= $category === 'lunch' ? 'selected' : '' ?>>Lunch</option>
        <option value="dinner" <?= $category === 'dinner' ? 'selected' : '' ?>>Dinner</option>
      </select>
      <button type="submit"><i class="fas fa-filter"></i> Filter</button>
    </form>

    <?php if ($resultsFound): ?>
      <?php foreach ($foodLogs as $food): ?>
        <div class="food-item">
          <img src="<?= htmlspecialchars($food['image_path']) ?>" alt="Food">
          <div class="food-info">
            <h4><?= htmlspecialchars($food['food_name']) ?> (<?= ucfirst($food['category']) ?>)</h4>
            <small>
              Calories: <?= $food['calories'] ?> |
              Protein: <?= $food['protein'] ?>g |
              Carbs: <?= $food['carbs'] ?>g |
              Fat: <?= $food['fat'] ?>g
            </small>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
    <!-- View Food History Button -->
    <!-- Back to Calorie Counter Button -->
    <form>
        <input type="button" value="Back to Calorie Counter" onclick="window.location.href='calorie_counter.php'" class="btn btn-primary" style="margin-top: 10px; width: 100%;">
    </form>
  </div>

  <?php if ($searchTriggered): ?>
    <script>
      Swal.fire({
        icon: '<?= $resultsFound ? 'success' : 'info' ?>',
        title: '<?= $resultsFound ? 'Results Found!' : 'No Results' ?>',
        text: '<?= $resultsFound ? 'Here are your search results.' : 'Try different keywords or filter.' ?>',
        confirmButtonColor: '#4a78a6'
      });
    </script>
  <?php endif; ?>
</body>
</html>