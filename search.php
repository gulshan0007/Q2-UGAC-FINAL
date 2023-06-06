<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .back-link {
            text-align: right;
        }

        .back-link a {
            color: #A344DC;
            text-decoration: none;
        }

        .search-results {
            background-color: #fff;
            padding: 20px;
            border-radius: 4px;
        }

        .search-table {
            width: 100%;
            border-collapse: collapse;
        }

        .search-table th,
        .search-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        .search-table th {
            background-color: #A344DC;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Search Results</h1>

        <div class="back-link">
            <a href="index.php">&larr; Back to All Students</a>
        </div>

        <div class="search-results">
            <table class="search-table">
                <tr>
                    <th>Name</th>
                    <th>Roll Number</th>
                    <th>Department</th>
                    <th>Hostel</th>
                    <th>Actions</th>
                </tr>
                <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search_query'])) {
        $searchQuery = $_GET['search_query'];

        $students = array_map('str_getcsv', file('students.csv'));

        $filteredStudents = array_filter($students, function($student) use ($searchQuery) {
            return stripos($student[0], $searchQuery) !== false || stripos($student[1], $searchQuery) !== false;
        });

        foreach ($filteredStudents as $student) {
            echo "<tr>";
            echo "<td>".$student[0]."</td>";
            echo "<td>".$student[1]."</td>";
            echo "<td>".$student[2]."</td>";
            echo "<td>".$student[3]."</td>";
            echo "<td><a href='edit.php?roll_number=".$student[1]."'>Edit</a> | <a href='delete.php?roll_number=".$student[1]."'>Delete</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        header("Location: index.php");
    }
?>

            </table>
        </div>
    </div>
</body>
</html>
