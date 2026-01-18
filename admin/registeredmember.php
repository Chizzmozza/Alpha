<?php
include("navbar.php");
include("../database/connection.php"); // Database connection

// Default number of records per page
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Fetch total number of records
$totalQuery = "SELECT COUNT(*) as total FROM attendance";
$totalResult = mysqli_query($conn, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalRecords = $totalRow['total'];
$totalPages = ceil($totalRecords / $limit);

// Fetch data with limit and pagination
$query = "SELECT attendance_id, name, time_in, time_out FROM attendance ORDER BY attendance_id DESC LIMIT $start, $limit";
$result = mysqli_query($conn, $query);

// Handle AJAX request for table refresh
if (isset($_GET['ajax'])) {
    ob_start(); // Prevent headers or other HTML output
    ?>
    <tbody id="attendance-body">
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['attendance_id']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['time_in']}</td>";
            echo "<td>{$row['time_out']}</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No records found</td></tr>";
    }
    ?>
    </tbody>
    <?php
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
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <title>Registered Members</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            margin-left: 230px;
            height: 100vh;
            background-color: #d3d3d3;
            padding-top: 50px;
        }
        .container {
            width: 80%;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .table-container {
            width: 100%;
            display: flex;
            justify-content: center;
        }
        .pagination {
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Attendance Tracker</h2>

        <!-- Rows per page selection -->
        <form method="GET" class="mb-3 text-center">
            <label for="limit">Rows per page:</label>
            <select name="limit" id="limit" onchange="this.form.submit()">
                <option value="10" <?php if($limit == 10) echo 'selected'; ?>>10</option>
                <option value="15" <?php if($limit == 15) echo 'selected'; ?>>15</option>
                <option value="20" <?php if($limit == 20) echo 'selected'; ?>>20</option>
            </select>
        </form>

        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                        </tr>
                    </thead>
                    <tbody id="attendance-body">
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>{$row['attendance_id']}</td>";
                                echo "<td>{$row['name']}</td>";
                                echo "<td>{$row['time_in']}</td>";
                                echo "<td>{$row['time_out']}</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No records found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <nav>
            <ul class="pagination">
                <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=1&limit=<?php echo $limit; ?>">First</a>
                </li>
                <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo ($page - 1); ?>&limit=<?php echo $limit; ?>">Previous</a>
                </li>

                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&limit=<?php echo $limit; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo ($page + 1); ?>&limit=<?php echo $limit; ?>">Next</a>
                </li>
                <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $totalPages; ?>&limit=<?php echo $limit; ?>">Last</a>
                </li>
            </ul>
        </nav>

    </div>

    <?php mysqli_close($conn); ?>

    <script>
        // Function to fetch updated table content
        function fetchUpdatedTable() {
            const params = new URLSearchParams(window.location.search);
            const limit = params.get("limit") || 10;
            const page = params.get("page") || 1;

            // Make AJAX request to fetch updated table content
            fetch(`?page=${page}&limit=${limit}&ajax=1`)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newTbody = doc.querySelector('#attendance-body');
                    if (newTbody) {
                        document.getElementById('attendance-body').innerHTML = newTbody.innerHTML;
                    }
                });
        }

        // Auto-refresh table every 5 seconds
        setInterval(fetchUpdatedTable, 5000);
    </script>
</body>
</html>
