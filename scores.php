<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new mysqli($servername, $username, $password);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "use quizdb";
    $query = mysqli_query($conn, $sql);
    $sql = "SELECT * FROM scores ORDER BY score DESC";
    $queryResult = mysqli_query($conn, $sql);
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="logo.png">
    <title>Not-so-Simple Quizzard Scorebaord!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <a href="index.php"><img class="banner" src="banner.png" alt="logo"></a>
    <h1>Leaderboard!</h1>    
    <table style="background: pink;">
        <tr>
            <td><b>S.No.</b></td>
            <td><b>Player Name</b></td>
            <td><b>E-mail</b></td>
            <td><b>Score</b></td>
        </tr>
        <?php
        for ($i = 0; $i < $queryResult->num_rows; $i++) {
            $row = $queryResult->fetch_assoc();
            $email = $row['email'];
            if ($email != "") {
                $out_email = substr($email, 0, 3) . "*****" . substr($email, strpos($email, "@"));
            }
            else {
                $out_email = "";
            }
            echo "<tr><td>" . $i+1 . "</td><td>" . $row["name"] . "</td><td>" . $out_email . "</td><td>" . $row["score"] . "</td></tr>";
        }
        ?>
    </table>
    <div class="scoreboard">
        <h2>Close!</h2>
        <a onclick="window.close()" class="btn btn-primary" style="background-color: red; border-color: red;">x Close!</a>
    </div>
</body>
</html>