<?php
include '../database/connection.php';
$sql = "SELECT * FROM bookings ORDER BY Booking_id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Bookings</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="styles.css">
  <style>
    body {
      background-color: #f8f9fa;
      display: flex;
    }
    .sidebar {
      width: 250px;
      background: #A6D1E6;
      color: white;
      height: 100vh;
      padding: 20px;
      position: fixed;
    }
    .content {
      margin-left: 260px;
      padding: 20px;
      width: 100%;
    }
    .table-container {
      background: white;
      padding: 20px;
      border-radius: 10px;
    }
  </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<section class="main-content">
  <div class="container">
    <h2 class="text-center mb-4">Manage Bookings</h2>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead class="table-dark">
          <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Training</th>
            <th>Coach</th>
            <th>Session</th>
            <th>Price</th>
            <th>Payment Status</th>
            <th>Payment Mode</th>
            <th>Transaction ID</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()) { ?>
            <tr id="row-<?= $row['Booking_id'] ?>">
              <td><?= htmlspecialchars($row['fullname']) ?></td>
              <td><?= htmlspecialchars($row['date']) ?></td>
              <td><?= htmlspecialchars($row['training']) ?></td>
              <td><?= htmlspecialchars($row['coach']) ?></td>
              <td><?= htmlspecialchars($row['session']) ?></td>
              <td><?= htmlspecialchars($row['price']) ?></td>
              <td><?= htmlspecialchars($row['paymentStatus']) ?></td>
              <td><?= htmlspecialchars($row['paymentMode']) ?></td>
              <td><?= htmlspecialchars($row['transactionID']) ?></td>
              <td class="status-cell"><?= htmlspecialchars($row['status']) ?></td>
              <td>
                <?php if (strtolower($row['status']) === 'approved') { ?>
                  <button class="btn btn-secondary btn-sm" disabled>Approved</button>
                <?php } else { ?>
                  <button class="btn btn-success btn-sm approve-btn" data-id="<?= $row['Booking_id'] ?>">Approve</button>
                <?php } ?>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".approve-btn").forEach(function (button) {
    button.addEventListener("click", function () {
      const bookingId = this.getAttribute("data-id");

      Swal.fire({
        title: 'Approve Booking?',
        text: "This action will approve the booking.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, approve it!'
      }).then((result) => {
        if (result.isConfirmed) {
          fetch('bookingapproval.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'Booking_id=' + bookingId
          })
          .then(response => response.text())
          .then(data => {
            if (data.trim() === "success") {
              const row = document.getElementById('row-' + bookingId);
              row.querySelector('.status-cell').textContent = "approved";

              const button = row.querySelector('.approve-btn');
              button.disabled = true;
              button.textContent = "Approved";
              button.classList.remove("btn-success");
              button.classList.add("btn-secondary");

              Swal.fire('Approved!', 'The booking has been approved.', 'success');
            } else {
              Swal.fire('Oops!', 'Booking was already approved or failed.', 'info');
            }
          })
          .catch(error => {
            console.error("Error:", error);
            Swal.fire('Error!', 'Something went wrong.', 'error');
          });
        }
      });
    });
  });
});
</script>

</body>
</html>

<?php $conn->close(); ?>
