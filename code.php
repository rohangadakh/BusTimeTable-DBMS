<?php
$conn = new mysqli('localhost', 'root', '', 'bus_timetable');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bus_name = $_POST['bus_name'];
    $arrival_time = $_POST['arrival_time'];
    $departure_time = $_POST['departure_time'];
    $destination = $_POST['destination'];
    $conn->query("INSERT INTO timetable (bus_name, arrival_time, departure_time, destination) VALUES ('$bus_name', '$arrival_time', '$departure_time', '$destination')");
    header('Location: ' . $_SERVER['PHP_SELF']);
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM timetable WHERE id = $id");
    header('Location: ' . $_SERVER['PHP_SELF']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Timetable</title>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Rubik', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f3e8ff;
        }
        footer {
            background-color: #d1c4e9;
        }
        .footer-content {
            color: #5e35b1;
        }
    </style>
</head>
<body class="bg-purple-100 flex flex-col justify-between">
    <div class="container mx-auto mt-10 mb-auto">
        <h1 class="text-3xl font-bold mb-6 text-center text-purple-700">Bus Timetable</h1>
        <form action="" method="POST" class="mb-6 bg-white p-6 rounded-lg shadow-md">
            <div class="grid grid-cols-4 gap-4">
                <input type="text" name="bus_name" placeholder="Bus Name" class="p-2 border rounded-md focus:outline-none" required>
                <input type="text" name="destination" placeholder="Destination" class="p-2 border rounded-md focus:outline-none" required>
                <input type="time" name="arrival_time" class="p-2 border rounded-md focus:outline-none" required>
                <input type="time" name="departure_time" class="p-2 border rounded-md focus:outline-none" required>
            </div>
            <button type="submit" class="mt-4 px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-500">Add Bus</button>
        </form>

        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-purple-200 text-left">
                    <th class="py-2 px-4 text-purple-700">Bus Name</th>
                    <th class="py-2 px-4 text-purple-700">Destination</th>
                    <th class="py-2 px-4 text-purple-700">Arrival Time</th>
                    <th class="py-2 px-4 text-purple-700">Departure Time</th>
                    <th class="py-2 px-4 text-purple-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $result = $conn->query("SELECT * FROM timetable");
                    while ($row = $result->fetch_assoc()):
                ?>
                <tr class="hover:bg-purple-100">
                    <td class="border px-4 py-2"><?php echo $row['bus_name']; ?></td>
                    <td class="border px-4 py-2"><?php echo $row['destination']; ?></td>
                    <td class="border px-4 py-2"><?php echo $row['arrival_time']; ?></td>
                    <td class="border px-4 py-2"><?php echo $row['departure_time']; ?></td>
                    <td class="border px-4 py-2">
                        <a href="?delete=<?php echo $row['id']; ?>" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-400">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <footer class="w-full py-4">
        <div class="container mx-auto text-center footer-content">
            <a href="https://github.com/rohangadakh/" target="_blank" class="flex items-center justify-center">
                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 16 16"><path d="M8 0a8 8 0 0 0-2.56 15.5c.4.075.55-.173.55-.385 0-.19-.007-.868-.013-1.576-2.29.497-2.775-1.102-2.775-1.102-.375-.95-.915-1.204-.915-1.204-.748-.511.056-.5.056-.5.826.058 1.36.847 1.36.847.735 1.256 1.926.892 2.397.683.074-.532.288-.892.525-1.098-1.83-.208-3.75-.914-3.75-4.06 0-.896.319-1.628.845-2.204-.085-.208-.366-1.049.08-2.185 0 0 .692-.221 2.27.84a7.902 7.902 0 0 1 2.065-.277c.7 0 1.406.094 2.065.277 1.578-1.06 2.27-.84 2.27-.84.446 1.136.165 1.977.08 2.185.526.576.845 1.308.845 2.204 0 3.154-1.921 3.85-3.754 4.057.297.256.563.76.563 1.53 0 1.104-.01 1.996-.01 2.26 0 .215.15.464.558.384A8 8 0 0 0 8 0"></path></svg>
                @rohangadakh
            </a>
        </div>
    </footer>
</body>
</html>

<!-- 
CREATE DATABASE bus_timetable;

USE bus_timetable;

CREATE TABLE timetable (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bus_name VARCHAR(255) NOT NULL,
    destination VARCHAR(255) NOT NULL,
    arrival_time TIME NOT NULL,
    departure_time TIME NOT NULL
); 
-->