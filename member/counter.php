<?php
session_start();
include("navbar.php");
include("../database/connection.php");

if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$user_id = $_SESSION['user_id'];
$message = []; // Initialize message array

$select = mysqli_query($conn, "SELECT * FROM `user` WHERE user_id = '$user_id'") or die('Query failed');
if (mysqli_num_rows($select) > 0) {
    $fetch = mysqli_fetch_assoc($select);
} else {
    die("User not found in database.");
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_changes'])) {
    $update_first_name = mysqli_real_escape_string($conn, $_POST['Fname']);
    $update_last_name = mysqli_real_escape_string($conn, $_POST['Lname']);

    // Update user information
    $query = "UPDATE `user` SET Fname = '$update_first_name', Lname = '$update_last_name' WHERE user_id = '$user_id'";

    if (!mysqli_query($conn, $query)) {
        die("Error updating profile: " . mysqli_error($conn));
    }

    // Handle Password Change
    if (!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Get the stored hashed password
        $select_user = mysqli_query($conn, "SELECT password FROM user WHERE user_id = '$user_id'") or die('Query failed');
        $user_data = mysqli_fetch_assoc($select_user);
        $stored_password = $user_data['password'];

        if (!password_verify($current_password, $stored_password)) {
            $message[] = 'Old password does not match!';
        } elseif ($new_password !== $confirm_password) {
            $message[] = 'New passwords do not match!';
        } else {
            // Hash the new password before updating
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $password_query = "UPDATE user SET password = '$hashed_password' WHERE user_id = '$user_id'";
            if (!mysqli_query($conn, $password_query)) {
                die("Error updating password: " . mysqli_error($conn));
            }
            $message[] = 'Password updated successfully!';
        }
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if a file was uploaded
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
            $profile_pic = $_FILES['profile_picture']['name'];
            $profile_pic_size = $_FILES['profile_picture']['size'];
            $profile_pic_tmp_name = $_FILES['profile_picture']['tmp_name'];
            $profile_pic_folder = '../images/' . $profile_pic; // Update path to match second HTML

            if ($profile_pic_size > 2000000) {
                $message[] = 'Image is too large!';
            } else {
                $image_update_query = mysqli_query($conn, "UPDATE `user` SET image = '$profile_pic' WHERE user_id = '$user_id'") or die('Query failed');
                if ($image_update_query) {
                    move_uploaded_file($profile_pic_tmp_name, $profile_pic_folder);
                    $message[] = 'Image updated successfully!';
                }
            }
        } else {
            $message[] = 'No file uploaded!';
        }
    }

    // Display messages if any
    // if (!empty($message)) {
    //     foreach ($message as $msg) {
    //         echo "<p>$msg</p>";
    //     }
    // }


}
?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1c4966;
            --secondary-color: #296d98;
            --background-color: #f5f7fa;
            --text-color: #333;
            --card-background: #ffffff;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {

            background-color: var(--background-color);
            color: var(--text-color);
        }
        .profile-section {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .header {
            background: #0E86D4;
            color: black;
            padding: 2rem 0 4rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        .header-text {
            flex: 1;
            min-width: 200px;
        }
        .avatar-container {
            width: 100px;
            height: 100px;
        }
        .avatar {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 3px solid white;
            object-fit: cover;
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        .content {
            margin-top: -2rem;
            padding-bottom: 2rem;
        }
        .card {
            background-color: var(--card-background);
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        .form-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .left-side, .right-side {
            width: 48%;
        }
        .form-group label {
            font-size: 1rem;
            display: block;
            margin-bottom: 0.5rem;
        }
        input[type="text"] {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
        }
        button {
            display: inline-block;
            padding: 0.75rem 2rem;
            background-color: var(--secondary-color);
            color: white;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            border: none;
        }
        button:hover {
            background-color: var(--primary-color);
        }
    </style>
</head>
<body>
<section class="profile-section">
    <div class="header">
        <div class="container">
            <div class="header-content">
                <div class="header-text">
                  <h1>Welcome, <?php echo $fetch['Fname'] . " " . $fetch['Lname']; ?></h1>
                    <p>Update your gym profile and preferences.</p>
                    <button id="editProfileBtn">Edit Profile</button>  <button id="membership">Membership</button>  <button  id="schedules">Schedules</button> <button  id="counter">Calorie & Protein Counter</button>
                </div>
                <!-- <div class="avatar-container">
                    <img class="avatar" src="../uploads/default.jpg" alt="ProfilePicture">
                </div> -->
                <div class="avatar-container">
    <?php
    $select = mysqli_query($conn, "SELECT * FROM `user` WHERE user_id = '$user_id'") or die('Query failed');
    if (mysqli_num_rows($select) > 0) {
        $fetch = mysqli_fetch_assoc($select);
    }
    if (!empty($fetch['image'])) {
        echo '<img class="avatar" src="../images/' . $fetch['image'] . '" alt="Profile Picture">';
    } else {
        echo '<img class="avatar" src="../pictures/userlogo.png" alt="Default Profile Picture">';
    }
    ?>
</div>

            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="card">
                <div class="card-body">
                  <div class="card-body">
    <h3 class="fw-bold">Calorie & Protein Counter</h3>
    <form id="nutritionForm" method="POST">
        <div class="form-container d-flex flex-wrap">
            <div class="left-side w-50 p-2">
                <div class="mb-3">
                    <label for="foodName" class="form-label">Food Item</label>
                    <input type="text" class="form-control" id="foodName" name="foodName" required>
                </div>
                <div class="mb-3">
                    <label for="calories" class="form-label">Calories</label>
                    <input type="number" class="form-control" id="calories" name="calories" required>
                </div>
            </div>
            <div class="right-side w-50 p-2">
                <div class="mb-3">
                    <label for="protein" class="form-label">Protein (g)</label>
                    <input type="number" class="form-control" id="protein" name="protein" required>
                </div>
                <div class="mb-3">
                    <label for="servingSize" class="form-label">Serving Size</label>
                    <input type="text" class="form-control" id="servingSize" name="servingSize">
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary" onclick="addEntry()">Add Entry</button>
    </form>
    <hr>
    <h5>Entries</h5>
    <ul class="list-group" id="entryList"></ul>
    <hr>
    <h5>Total Calories: <span id="totalCalories">0</span> kcal</h5>
    <h5>Total Protein: <span id="totalProtein">0</span> g</h5>
</div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.getElementById("editProfileBtn").addEventListener("click", function() {
        window.location.href = "profile.php";
    });
    document.getElementById("membership").addEventListener("click", function() {
        window.location.href = "membership.php";
    });
    document.getElementById("schedules").addEventListener("click", function() {
        window.location.href = "schedules.php";
    });
</script>

<script>
    let totalCalories = 0;
    let totalProtein = 0;

    function addEntry() {
        let foodName = document.getElementById("foodName").value;
        let calories = parseInt(document.getElementById("calories").value);
        let protein = parseInt(document.getElementById("protein").value);
        let servingSize = document.getElementById("servingSize").value;

        if (!foodName || isNaN(calories) || isNaN(protein)) {
            alert("Please enter valid inputs.");
            return;
        }

        totalCalories += calories;
        totalProtein += protein;

        document.getElementById("totalCalories").innerText = totalCalories;
        document.getElementById("totalProtein").innerText = totalProtein;

        let entryList = document.getElementById("entryList");
        let listItem = document.createElement("li");
        listItem.className = "list-group-item";
        listItem.innerHTML = `${foodName} - ${calories} kcal, ${protein}g protein, Serving: ${servingSize}`;
        entryList.appendChild(listItem);

        document.getElementById("nutritionForm").reset();
    }
</script>


  </body>
</html>
