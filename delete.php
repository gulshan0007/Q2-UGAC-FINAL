<?php
    if (isset($_GET['roll_number'])) {
        $rollNumber = $_GET['roll_number'];

        $students = array_map('str_getcsv', file('students.csv'));

        $updatedStudents = array_filter($students, function($student) use ($rollNumber) {
            return $student[1] !== $rollNumber;
        });

        $file = fopen('students.csv', 'w');
        foreach ($updatedStudents as $student) {
            fputcsv($file, $student);
        }
        fclose($file);

        header("Location: index.php");
    }
?>
