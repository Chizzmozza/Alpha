<?php
// Include database connection first
include("../database/connection.php");

// Determine if this is an AJAX/API request
$isAjax = (
    isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
) || isset($_GET['action']) || isset($_POST['query']) || isset($_POST['registerUser']);

// HANDLE ALL AJAX/API REQUESTS FIRST - BEFORE ANY OUTPUT OR INCLUDES

// RFID API SECTION
if (isset($_GET['action'])) {
    header('Content-Type: application/json');
    $action = $_GET['action'];

    // Handle register request from ESP32
    if ($action === 'register') {
        // Get the raw POST data
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (isset($data['uid'])) {
            // Store the UID in a file for latest endpoint to access
            $uid = $data['uid'];

            // Store in a file with timestamp
            file_put_contents(dirname(__FILE__) . '/latest_uid.txt', json_encode([
                'uid' => $uid,
                'timestamp' => time()
            ]));

            // Return success response
            echo json_encode([
                'status' => 'success',
                'message' => 'UID received and stored'
            ]);
        } else {
            // Return error response
            echo json_encode([
                'status' => 'error',
                'message' => 'No UID provided'
            ]);
        }
        exit;
    }

    // Handle latest request from frontend
    if ($action === 'latest') {
        $file_path = dirname(__FILE__) . '/latest_uid.txt';

        // Check if file exists and is readable
        if (file_exists($file_path) && is_readable($file_path)) {
            $content = file_get_contents($file_path);
            $data = json_decode($content, true);

            // Check if the UID is recent (within the last 30 seconds)
            if ($data && isset($data['timestamp']) && time() - $data['timestamp'] < 30) {
                echo json_encode(['uid' => $data['uid']]);
            } else {
                echo json_encode(['uid' => '']);
            }
        } else {
            echo json_encode(['uid' => '']);
        }
        exit;
    }

    // Handle clear request from frontend
    if ($action === 'clear') {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (isset($data['action']) && $data['action'] === 'CLEAR_LCD') {
            // Clear the stored UID or mark it as processed
            file_put_contents(dirname(__FILE__) . '/latest_uid.txt', json_encode([
                'uid' => '',
                'timestamp' => 0
            ]));

            echo json_encode([
                'status' => 'success',
                'message' => 'LCD cleared'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid action'
            ]);
        }
        exit;
    }
}

// Handle user search request (AJAX)
if (isset($_POST['query'])) {
    $search = mysqli_real_escape_string($conn, $_POST['query']);
    $sql = "SELECT user_id, Fname, Lname FROM user WHERE Fname LIKE '%$search%' OR Lname LIKE '%$search%' LIMIT 5";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li class='list-group-item list-item' data-id='" . $row['user_id'] . "'>" . htmlspecialchars($row['Fname'] . " " . $row['Lname']) . "</li>";
        }
    } else {
        echo "<li class='list-group-item'>No results found</li>";
    }
    exit;
}

// Handle Serial Card & Expiration Date submission (AJAX)
if (isset($_POST['registerUser'])) {
    header('Content-Type: text/plain'); // Plain text response
    
    $userId = mysqli_real_escape_string($conn, $_POST['userId']);
    $serialCard = mysqli_real_escape_string($conn, $_POST['serialCard']);
    $expirationDate = mysqli_real_escape_string($conn, $_POST['computedExpirationDate']);

    // Check if user exists
    $checkQuery = "SELECT * FROM user WHERE user_id = '$userId'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Update user record with computed expiration date
        $updateQuery = "UPDATE user SET
            SerialCard = '$serialCard',
            CardExpiration = '$expirationDate',
            DateRegistered = CURDATE()  -- Stores only the current date (YYYY-MM-DD)
            WHERE user_id = '$userId'";

        if (mysqli_query($conn, $updateQuery)) {
            echo "✅ Registration successful!";
        } else {
            echo "❌ Error: " . mysqli_error($conn);
        }
    } else {
        echo "❌ User not found!";
    }
    exit;
}

// REGULAR PAGE DISPLAY STARTS HERE
// Only include the navbar for non-AJAX requests
if (!$isAjax) {
    include("navbar.php");
}

// ORIGINAL MEMBER.PHP CODE BELOW
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
$select = mysqli_query($conn, "SELECT * FROM `user` WHERE user_id = '$user_id'") or die('Query failed');
if (mysqli_num_rows($select) > 0) {
    $fetch = mysqli_fetch_assoc($select);
} else {
    // Only die if not an AJAX request - otherwise it might interrupt AJAX responses
    if (!$isAjax) {
        die("User not found in database.");
    }
}

// Handle form submissions (regular POST, not AJAX)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id']) && !$isAjax) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $Fname = mysqli_real_escape_string($conn, $_POST['Fname']);
    $Lname = mysqli_real_escape_string($conn, $_POST['Lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $points = mysqli_real_escape_string($conn, $_POST['points']);

    // Update query
    $sql = "UPDATE user SET Fname='$Fname', Lname='$Lname', email='$email', address='$address', contact='$contact', role='$role', points ='$points' WHERE user_id='$user_id'";

    if (mysqli_query($conn, $sql)) {
        header("Location:member.php"); // Redirect back to the user list
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// If this is an AJAX request, exit here - don't render the HTML
if ($isAjax) {
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <title>User Management</title>
</head>
<body>
<section class="main-content">
  <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="mb-0">Member List</h2>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#userModal">
          <i class="fas fa-user-plus"></i> Register
      </button>
  </div>

  <table class="table table-bordered table-hover">
      <thead class="table-dark">
          <tr>
              <th>ID</th>
              <th>Full name</th>
              <th>Email</th>
              <th>Address</th>
              <th>Contact</th>
              <th>Role</th>
              <th>Points</th>
              <th>Serial Card</th>
              <th>Registered Date</th>
              <th>Card Expiration</th>
              <th>Actions</th>
          </tr>
      </thead>
      <tbody>
          <?php
          $sql = "SELECT * FROM user WHERE role = 'member' ORDER BY role_updated_at DESC";

          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<form action='member.php' method='POST' id='updateForm_" . $row['user_id'] . "'>";
                  echo "<input type='hidden' name='user_id' value='" . $row['user_id'] . "'>";

                  // Add hidden inputs for non-editable fields
                  echo "<input type='hidden' name='Fname' value='" . htmlspecialchars($row['Fname']) . "'>";
                  echo "<input type='hidden' name='Lname' value='" . htmlspecialchars($row['Lname']) . "'>";
                  echo "<input type='hidden' name='email' value='" . htmlspecialchars($row['email']) . "'>";
                  echo "<input type='hidden' name='address' value='" . htmlspecialchars($row['address']) . "'>";
                  echo "<input type='hidden' name='contact' value='" . htmlspecialchars($row['contact']) . "'>";

                  echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['Fname'] . ' ' . $row['Lname']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['contact']) . "</td>";

                  // Editable role dropdown
                  echo "<td style='width:12%;'>
                          <select name='role' class='form-select'>
                              <option value='user' " . ($row['role'] == 'user' ? 'selected' : '') . ">User</option>
                              <option value='member' " . ($row['role'] == 'member' ? 'selected' : '') . ">Member</option>
                              <option value='admin' " . ($row['role'] == 'admin' ? 'selected' : '') . ">Admin</option>
                          </select>
                        </td>";

                  // Editable points field
                  echo "<td style='width:12%;'><input type='number' class='form-control' name='points' value='" . htmlspecialchars($row['points']) . "'></td>";

                  // Other non-editable data
                  echo "<td>" . htmlspecialchars($row['SerialCard']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['DateRegistered']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['CardExpiration']) . "</td>";

                  // Submit button
                  echo "<td>
                          <button type='button' class='btn btn-sm btn-success' onclick='confirmUpdate(" . $row['user_id'] . ")'>
                              <i class='fa-solid fa-floppy-disk'></i> Update
                          </button>
                        </td>";

                  echo "</form>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='11' class='text-center'>No users found</td></tr>";
          }

          // Only close the connection if it's not an AJAX request
          if (!$isAjax) {
              mysqli_close($conn);
          }
          ?>
      </tbody>
  </table>
  <script>
      function confirmUpdate(userId) {
          Swal.fire({
              title: 'Are you sure?',
              text: 'Do you want to update this user\'s information?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, update it!',
              cancelButtonText: 'No, cancel',
              reverseButtons: false,
              customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
              }
          }).then((result) => {
              if (result.isConfirmed) {
                  document.getElementById('updateForm_' + userId).submit();
              }
          });
      }
  </script>

<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userModalLabel">Register Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="userForm">
          <div class="mb-3 position-relative">
            <label for="accountName" class="form-label">Account Name</label>
            <input type="text" class="form-control" id="accountName" name="accountName" autocomplete="off" required>
            <ul id="userList" class="list-group position-absolute w-100"></ul>
          </div>
          <div class="mb-3">
            <label for="serialCard" class="form-label">Serial Card</label>
            <input type="text" class="form-control" id="serialCard" name="serialCard" required>
          </div>
          <div class="mb-3">
            <label for="expirationDate" class="form-label">Expiration Date</label>
            <select class="form-control" id="expirationDate" name="expirationDate" required>
              <option value="">Select Membership Period</option>
              <option value="3">3 Months</option>
              <option value="6">6 Months</option>
              <option value="12">1 Year</option>
            </select>
          </div>

          <!-- Hidden input for computed expiration date -->
          <input type="hidden" id="computedExpirationDate" name="computedExpirationDate">

          <button type="submit" class="btn btn-primary">Register</button>
        </form>
      </div>
    </div>
  </div>
</div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    let selectedUserId = ""; // Store selected user ID
    let lastUID = ""; // Track the last RFID UID received

    // Function to check for new RFID UIDs - updated with new URL
    async function checkForNewUID() {
        try {
            const response = await fetch("member.php?action=latest");
            const data = await response.json();

            if (data && data.uid && data.uid !== lastUID) {
                lastUID = data.uid;
                console.log("Received RFID:", data.uid);

                // Fill the serialCard input with the RFID value
                $("#serialCard").val(data.uid);

                // Show the registration modal
                let modalElement = document.getElementById("userModal");
                let modal = new bootstrap.Modal(modalElement);
                modal.show();

                // Add listener to clear the UID when modal is closed
                modalElement.addEventListener("hidden.bs.modal", async function () {
                    console.log("Sending CLEAR_LCD to server");
                    await fetch("member.php?action=clear", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({ action: "CLEAR_LCD" })
                    });
                }, { once: true });
            }
        } catch (error) {
            console.error("Error fetching UID:", error);
        }
    }

    // Check for new UID every second
    setInterval(checkForNewUID, 1000);

    // Live search for users
    $("#accountName").on("input", function () {
        let query = $(this).val();
        if (query.length > 0) {
            $.ajax({
                url: "", // Same page request
                method: "POST",
                data: { query: query },
                success: function (data) {
                    $("#userList").html(data).show();
                }
            });
        } else {
            $("#userList").hide();
        }
    });

    // Select a user from the dropdown
    $(document).on("click", ".list-item", function () {
        selectedUserId = $(this).data("id"); // Capture user ID
        let fullName = $(this).text();

        $("#accountName").val(fullName);
        $("#userList").hide();
    });

    // Hide dropdown when clicking outside
    $(document).click(function (e) {
        if (!$(e.target).closest("#accountName, #userList").length) {
            $("#userList").hide();
        }
    });

    // Compute expiration date when membership period is selected
    $("#expirationDate").change(function () {
        let selectedMonths = parseInt($(this).val());
        if (!selectedMonths) {
            $("#computedExpirationDate").val("");
            return;
        }

        let today = new Date();
        today.setMonth(today.getMonth() + selectedMonths);

        let formattedDate = today.toISOString().split('T')[0];
        $("#computedExpirationDate").val(formattedDate);
    });

    // Handle form submission
    $("#userForm").on("submit", function (event) {
        event.preventDefault(); // Prevent page reload

        let serialCard = $("#serialCard").val();
        let computedExpirationDate = $("#computedExpirationDate").val();

        if (!selectedUserId) {
            alert("Please select a valid user before registering!");
            return;
        }

        $.ajax({
            url: "", // Same page request
            method: "POST",
            data: {
                registerUser: true,
                userId: selectedUserId,
                serialCard: serialCard,
                computedExpirationDate: computedExpirationDate
            },
            success: function (response) {
                // Attempt to extract a message from HTML (if wrapped)
                var tempDiv = document.createElement("div");
                tempDiv.innerHTML = response;
                var message = tempDiv.textContent || tempDiv.innerText || "Success";

                Swal.fire({
                    title: 'Registration Response',
                    text: message.trim(),
                    icon: message.includes("✅") ? 'success' : 'error',
                    confirmButtonText: 'OK'
                });

                var modal = bootstrap.Modal.getInstance(document.getElementById('userModal'));
                modal.hide();
                $("#userForm")[0].reset();
                
                // Refresh the page to show the updated data (optional)
                setTimeout(function() {
                    location.reload();
                }, 1500);
            }
        });
    });
});
</script>
</body>
</html>