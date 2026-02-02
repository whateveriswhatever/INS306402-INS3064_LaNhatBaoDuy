<?php
    $student_list = [
        [
            "ID" => 1,
            "name" => "Khanh",
            "major" => "ICE"
        ],
        [
            "ID" => 2,
            "name" => "Bach",
            "major" => "ICE"
        ],
        [
            "ID" => 3,
            "name" => "Giang",
            "major" => "FDB"
        ]
    ];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="heading" style="text-align: center;">
        <h1>Student List</h1>
    </div>

    <div id="table" style="display: flex; text-align: center; justify-content: center;">
        <table border="1px">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Major</th>
            </tr>

            <?php
                foreach ($student_list as $student) {
                    echo "<tr>
                        <td>{$student['ID']}</td>
                        <td>{$student['name']}</td>
                        <td>{$student['major']}</td>
                    </tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>