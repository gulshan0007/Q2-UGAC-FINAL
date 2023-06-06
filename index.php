<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            
            background-image: url('bg4.jpg'); 
            background-repeat: no-repeat;
            background-size: cover;
            
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            
        }

        h1 {
            text-align: center;
            color: white;
        }

        .add-button {
            text-align: right;
            margin-bottom: 20px;
        }

        .search-form {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-input {
            padding: 8px;
            width: 250px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-button {
            padding: 8px 16px;
            font-size: 16px;
            border: none;
            background-color: blue;
            color: white;
            cursor: pointer;
        }

        .student-table {
            width: 100%;
            border-collapse: collapse;
        }

        .student-table th,
        .student-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
            color: white;
        }

        .student-table th {
            background-color: #A344DC;
            color: white;
        }

        @media only screen and (max-width: 600px) {
            .container {
                padding: 10px;
            }

            .search-form {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }

            .search-input {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
     <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this student?");
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Student Management System</h1>

        <button class="add-button" >
            <a href="add.php">Add New Student</a>
    </button>

        <div class="search-form">
            <form action="search.php" method="get">
                <input type="text" class="search-input" name="search_query" placeholder="Search by name or roll number">
                <button type="submit" class="search-button">Search</button>
            </form>
        </div>

        <table class="student-table">
            <tr>
                <th>Name</th>
                <th>Roll Number</th>
                <th>Department</th>
                <th>Hostel</th>
                <th>Actions</th>
            </tr>
            <?php
                $students = array_map('str_getcsv', file('students.csv'));
                foreach ($students as $student) {
                    echo "<tr>";
                    echo "<td>".$student[0]."</td>";
                    echo "<td>".$student[1]."</td>";
                    echo "<td>".$student[2]."</td>";
                    echo "<td>".$student[3]."</td>";
                    echo "<td>";
                        echo "<a href='edit.php?roll_number=".$student[1]."' >Edit</a> | " ;
                        echo "<a href='delete.php?roll_number=".$student[1]."' onclick='return confirmDelete();'>Delete</a>" ;
                        echo "</td>";

                        echo "</tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>

