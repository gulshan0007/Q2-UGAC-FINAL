<!DOCTYPE html>
<html>
<head>
    <title>Add New Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 4px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .button-container {
            text-align: center;
        }

        .button-container button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #A344DC;
            color: #fff;
            cursor: pointer;
        }

        .button-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add New Student</h1>

        <form action="insert.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="roll_number">Roll Number:</label>
                <input type="text" id="roll_number" name="roll_number" required>
            </div>

            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" id="department" name="department" required>
            </div>

            <div class="form-group">
                <label for="hostel">Hostel:</label>
                <input type="text" id="hostel" name="hostel" required>
            </div>

            <div class="button-container">
                <button type="submit">Add Student</button>
            </div>
        </form>
    </div>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $rollNumber = $_POST["roll_number"];
            $department = $_POST["department"];
            $hostel = $_POST["hostel"];

            $studentData = array($name, $rollNumber, $department, $hostel);
            $file = fopen('students.csv', 'a');
            fputcsv($file, $studentData);
            fclose($file);

            header("Location: index.php");
        }
    ?>
</body>
</html>
