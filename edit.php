<?php
    if (isset($_GET['roll_number'])) {
        $rollNumber = $_GET['roll_number'];

        $students = array_map('str_getcsv', file('students.csv'));

        $student = array_filter($students, function($student) use ($rollNumber) {
            return $student[1] === $rollNumber;
        });

        if (count($student) === 1) {
            $student = current($student);
        } else {
            die("Student not found.");
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $rollNumber = $_POST["roll_number"];
        $department = $_POST["department"];
        $hostel = $_POST["hostel"];

        $updatedStudents = array_map(function($student) use ($name, $rollNumber, $department, $hostel) {
            if ($student[1] === $rollNumber) {
                return array($name, $rollNumber, $department, $hostel);
            }
            return $student;
        }, $students);

        $file = fopen('students.csv', 'w');
        foreach ($updatedStudents as $student) {
            fputcsv($file, $student);
        }
        fclose($file);

        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
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
        <h1>Edit Student</h1>

        <form action=" " method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $student[0]; ?>" required>
            </div>

            <div class="form-group">
                <label for="roll_number">Roll Number:</label>
                <input type="text" id="roll_number" name="roll_number" value="<?php echo $student[1]; ?>" readonlyrequired>
            </div>

            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" id="department" name="department" value="<?php echo $student[2]; ?>" required>
            </div>

            <div class="form-group">
                <label for="hostel">Hostel:</label>
                <input type="text" id="hostel" name="hostel" value="<?php echo $student[3]; ?>" required>
            </div>

            <div class="button-container">
                <button type="submit">Update Student</button>
            </div>
        </form>
    </div>
</body>
</html> 

