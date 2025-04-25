<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "throughtheages");

// Protect page (simple session check)
if (!isset($_SESSION['username'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch all reservations
$reservations = [];
$sql = "SELECT * FROM reservations ORDER BY date DESC, time DESC";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $reservations = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            padding: 20px;
        }

        h1,
        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #444;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .logout-btn {
            margin-top: 10px;
        }

        .btn-danger {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .logout-button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 16px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>

    <h1>Welcome, <?= htmlspecialchars($_SESSION['username']) ?> </h1>
    <form action="logout.php" method="POST" class="logout-btn">
        <button type="submit" class="logout-button">Logout</button>
    </form>

    <h2>Reservation List</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Phone</th>
                <th>People</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($reservations)): ?>
                <tr>
                    <td colspan="8">No reservations found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($reservations as $res): ?>
                    <tr>
                        <td><?= $res['id'] ?></td>
                        <td><?= htmlspecialchars($res['name']) ?></td>
                        <td><?= $res['date'] ?></td>
                        <td><?= $res['time'] ?></td>
                        <td><?= $res['phone'] ?></td>
                        <td><?= $res['people'] ?></td>
                        <td><?= htmlspecialchars($res['message']) ?></td>
                        <td>
                            <form method="POST" action="delete_reservation.php" onsubmit="return confirm('Delete this reservation?')">
                                <input type="hidden" name="id" value="<?= $res['id'] ?>">
                                <button type="submit" class="btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>