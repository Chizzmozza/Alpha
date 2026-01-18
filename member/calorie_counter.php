<?php
session_start();
include '../database/connection.php'; // Ensure this path is correct

// Nutritionix API credentials
define('NUTRITIONIX_APP_ID', '5ae7fd0a');
define('NUTRITIONIX_APP_KEY', '21bfa474152f016a7cc927c3f486c420');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// User authentication check
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header('location:../guest/index.php');
    exit();
}

// Handle Logout
if (isset($_GET['Logout'])) {
    session_unset();
    session_destroy();
    header('location:../guest/index.php');
    exit();
}

// Handle AJAX Food Search
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['food_name']) && isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    $food = $_POST['food_name'];
    $url = "https://trackapi.nutritionix.com/v2/natural/nutrients";
    $headers = [
        "x-app-id: " . NUTRITIONIX_APP_ID,
        "x-app-key: " . NUTRITIONIX_APP_KEY,
        "Content-Type: application/json"
    ];
    $body = json_encode(["query" => $food]);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo json_encode(['error' => 'cURL error: ' . curl_error($ch)]);
    } else {
        $data = json_decode($response, true);
        if (!empty($data['foods'][0])) {
            $item = $data['foods'][0];
            echo json_encode([
                'food_name' => $item['food_name'],
                'calories' => $item['nf_calories'],
                'protein' => $item['nf_protein'],
                'fat' => $item['nf_total_fat'],
                'carbs' => $item['nf_total_carbohydrate'],
                'photo' => $item['photo']['thumb']
            ]);
        } else {
            echo json_encode(['error' => 'No food found']);
        }
    }
    curl_close($ch);
    exit; // Exit after handling AJAX request
}

// Handle Manual Food Logging
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    $foodImage = null;
    if (isset($_FILES['food_image']) && $_FILES['food_image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['food_image']['tmp_name'];
        $imageName = time() . '_' . basename($_FILES['food_image']['name']);
        $uploadDir = 'uploads/';
        $imagePath = $uploadDir . $imageName;

        if (!is_dir($uploadDir)) mkdir($uploadDir);
        if (move_uploaded_file($imageTmpPath, $imagePath)) {
            $foodImage = $imagePath;
        }
    }

    $stmt = $pdo->prepare("INSERT INTO food_history (food_name, calories, protein, fat, carbs, category, image_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['food_name'], $_POST['calories'], $_POST['protein'], $_POST['fat'], $_POST['carbs'], $_POST['category'], $foodImage
    ]);

    header("Location: index.php");
    exit; // Exit after manual logging
}

// Get Weekly Calorie Data
$calorieQuery = "SELECT DATE(created_at) as day, SUM(calories) as total_calories
                 FROM food_history
                 GROUP BY day
                 ORDER BY day DESC
                 LIMIT 7";
$calorieStmt = $pdo->query($calorieQuery);
$calorieData = $calorieStmt->fetchAll(PDO::FETCH_ASSOC);

$labels = array_reverse(array_column($calorieData, 'day'));
$calories = array_reverse(array_column($calorieData, 'total_calories'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../member/navbar.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> <!-- FontAwesome -->
   <title>Calorie Counter</title>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

   <style>
       body { font-family: Arial; background: #f0f0f0; padding: 30px; }
       .container { max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
       input, select, button { width: 100%; margin-top: 10px; padding: 10px; border-radius: 8px; }
       button { background: #4a78a6; color: white; border: none; }
       nav { margin-bottom: 20px; }
       img.thumb { width: 120px; border-radius: 10px; margin-bottom: 10px; }
   </style>

</head>
<body>


<nav class="navbar navbar-expand-lg">
   <a class="navbar-brand d-flex align-items-center" href="#">
       <img src="../pictures/alphalogonew.png" alt="Logo">
   </a>
   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
       <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
       <div class="d-flex justify-content-center w-100">
           <ul class="navbar-nav align-items-center">
               <li class="nav-item"><a class="nav-link" href="../member/index.php">Home</a></li>
               <li class="nav-item"><a class="nav-link" href="../member/index.php#courses">Courses</a></li>
               <li class="nav-item"><a class="nav-link" href="../member/index.php#products">Products</a></li>
               <li class="nav-item"><a class="nav-link" href="../member/aboutus.php">About Us</a></li>
           </ul>
       </div>
       <ul class="navbar-nav ms-auto">
           <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                   <?php
                   $select = mysqli_query($conn, "SELECT image FROM user WHERE user_id = '$user_id'") or die('Query failed');
                   if (mysqli_num_rows($select) > 0) {
                       $fetch = mysqli_fetch_assoc($select);
                   }
                   if (!empty($fetch['image'])) {
                       echo '<img class="rounded-circle" src="../images/' . $fetch['image'] . '" alt="Profile Picture" width="50" height="50">';
                   } else {
                       echo '<img class="rounded-circle" src="../pictures/userlogo.png" alt="Default Profile Picture" width="50" height="50">';
                   }
                   ?>
               </a>
               <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                   <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
                   <li><hr class="dropdown-divider"></li>
                   <li><a class="dropdown-item text-danger" href="?Logout=true"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
               </ul>
           </li>
       </ul>
   </div>
</nav>

<div class="container">
   <h2><i class="fas fa-fire"></i> Calorie Counter</h2>

   <!-- Food Search Form -->
   <form id="calorieForm">
       <input type="text" name="food_name" id="foodInput" placeholder="e.g. banana, rice" required>
       <button type="submit"><i class="fas fa-search"></i> Analyze</button>
   </form>

   <!-- Weekly Chart -->
   <div class="mt-5">
     <h3 class="text-center mb-4">📊 Weekly Calorie Stats</h3>
<canvas id="weeklyChart" height="120"></canvas>
</div>

<!-- Manual Food Logging Form -->
<form method="POST" enctype="multipart/form-data">
<h3>Log Food</h3>
<input type="text" name="food_name" placeholder="Food Name" required>
<input type="number" name="calories" placeholder="Calories" required>
<input type="number" name="protein" placeholder="Protein (g)" required>
<input type="number" name="fat" placeholder="Fat (g)" required>
<input type="number" name="carbs" placeholder="Carbs (g)" required>
<select name="category" required>
  <option value="" disabled selected>Select Category</option>
  <option value="breakfast">Breakfast</option>
  <option value="lunch">Lunch</option>
  <option value="dinner">Dinner</option>
</select>
<input type="file" name="food_image" accept="image/*" required>
<button type="submit"><i class="fas fa-plus"></i> Log Food</button>
</form>
<!-- View Food History Button -->
<form>
    <input type="button" value="View Food History" onclick="window.location.href='food_history.php'" class="btn btn-primary" style="margin-top: 10px;">
</form>
</div>

<script>
// Weekly Chart
const ctx = document.getElementById('weeklyChart').getContext('2d');
const weeklyChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($labels) ?>,
        datasets: [{
            label: 'Total Calories per Day',
            data: <?= json_encode($calories) ?>,
            backgroundColor: '#4a78a6',
            borderRadius: 6
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true },
            x: { ticks: { color: '#1b2232' } }
        },
        plugins: {
            legend: {
                labels: { color: '#1b2232' }
            }
        }
    }
});

// Food Search Logic
document.getElementById('calorieForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const food = document.getElementById('foodInput').value;

    Swal.fire({ title: 'Analyzing...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

    fetch('calorie_counter.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: 'food_name=' + encodeURIComponent(food)
    })
    .then(res => res.json())
    .then(data => {
        if (data.error) {
            Swal.fire('Oops!', data.error, 'error');
        } else {
            Swal.fire({
                title: `Info for ${data.food_name}`,
                html: `
                    <img src="${data.photo}" class="thumb"><br>
                    Calories: ${data.calories} kcal<br>
                    Protein: ${data.protein}g<br>
                    Carbs: ${data.carbs}g<br>
                    Fat: ${data.fat}g
                `,
                icon: 'info'
            });
            document.getElementById('foodInput').value = '';
        }
    })
    .catch(() => Swal.fire('Oops!', 'Error fetching food data', 'error'));
});
</script>

<!-- Bootstrap & jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>