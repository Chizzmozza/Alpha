<?php
include("navbar.php");
include("../database/connection.php"); // Database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>Membership Request</title>
</head>
<body>

<section class="main-content">
<div class="container mt-4">
    <h2 class="mb-3">Membership Request</h2>

    <table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Full name</th>
            <th>Email</th>
            <th>Membership Type</th>
            <th>Submitted At</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM memberships ORDER BY created_at DESC";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr id='row-" . $row['membership_id'] . "'>";
              echo "<td>" . htmlspecialchars($row['membership_id']) . "</td>";
              echo "<td>" . htmlspecialchars($row['full_name']) . "</td>";
              echo "<td>" . htmlspecialchars($row['email']) . "</td>";
              echo "<td>" . htmlspecialchars($row['membership_type']) . "</td>";
              echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
              echo "<td>" . htmlspecialchars($row['status']) . "</td>";
              echo "<td>";
              if (strtolower($row['status']) === 'approved') {
                  echo "<button class='btn btn-secondary btn-sm' disabled>Approved</button>";
              } else {
                  echo "<button class='btn btn-success btn-sm approve-btn' data-id='" . $row['membership_id'] . "'>Approve</button>";
              }
              echo "</td>";
              echo "</tr>";

            }
        } else {
            echo "<tr><td colspan='6' class='text-center'>No membership requests found</td></tr>";
        }

        mysqli_close($conn);
        ?>
    </tbody>
</table>

   </div>
</section>
</body>
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".approve-btn").forEach(function(button) {
        button.addEventListener("click", function () {
            const membershipId = this.getAttribute("data-id");

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to approve this request?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('approve.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'membership_id=' + membershipId
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (data.trim() === "success") {
                            const row = document.getElementById('row-' + membershipId);
                            const statusCell = row.cells[5];
                            statusCell.textContent = "approved";

                            const button = row.querySelector('.approve-btn');
                            button.disabled = true;
                            button.textContent = "Approved";
                            button.classList.remove("btn-success");
                            button.classList.add("btn-secondary");

                            Swal.fire(
                                'Approved!',
                                'The membership request has been approved and an email has been sent.',
                                'success'
                            );
                        } else {
                            Swal.fire('Oops!', 'Already approved or failed.', 'info');
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


</html>
