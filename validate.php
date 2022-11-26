<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="logo.png">
    <title>Not-so-Simple Quizzard Submission!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body style='margin: auto; text-align: center;'>
    <img class="banner" src="banner.png" alt="logo" class="logo">
    <h1>Hooray!!</h1>
    <?php
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $score = 0;
            $index = 0;
            $qnabank = "qbank.txt";
            if(file_exists($qnabank)) {
                $file = fopen($qnabank, "r");
                    while(!feof($file)) {
                        $line = trim(fgets($file));
                        if($line != "") {
                            $index++;
                            $qna = explode("|", $line);
                            $question = $qna[0];
                            $choice1 = $qna[1];
                            $choice2 = $qna[2];
                            $choice3 = $qna[3];
                            $choice4 = $qna[4];
                            $answer = explode("A##", $qna[5])[1];
                            if (isset($_POST["q$index"])) {
                                $useranswer = $_POST["q$index"];
                                // strtolower() can be used to make the comparison case-insensitive (still character-sensitive)
                                // $useranswer = strtolower($useranswer);
                                // $answer = strtolower($answer);
                                if ($useranswer == $answer) {
                                    $score++;
                                }
                            }
                        }
                    }
                fclose($file);
            }
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
            $data = array();
            for ($i = 0; $i < $queryResult->num_rows; $i++) {
                $row = $queryResult->fetch_assoc();
                $data[$i] = $row;
            }
            for ($i = 0; $i < count($data); $i++) {
                if ($name == $data[$i]["name"] && $email == $data[$i]["email"]) {
                    if ($score > $data[$i]["score"]) {
                        $sql = "UPDATE scores SET score = $score WHERE name = '$name' AND email = '$email'";
                        $query = mysqli_query($conn, $sql);
                    }
                    break;
                }
                else {
                    $sql = "INSERT INTO scores (name, email, score) VALUES ('$name', '$email', $score)";
                    $query = mysqli_query($conn, $sql);
                    break;
                }  
            }
            echo "<h2>Thank you for taking the quiz, $name!</h2>";
            echo "<h3>Your score is $score out of $index.</h3>";
            echo "<h3>View the <a href='scores.php' target='_blank'>Scoreboard</a>!</h3>";
        }
    ?>

        <center style="margin-top: 50px;">
        <button class="btn btn-primary" onclick="window.location.href='index.php'" style="background-color:red;border-color:red;">Back to the QUIZ!</button>
        </center>
</body>
</html>