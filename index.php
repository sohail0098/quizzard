<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="logo.png">
        <title>Not-so-Simple Quizzard!</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <img class="banner" src="banner.png" alt="logo" class="logo">
        <form method="post" action="validate.php">
            <label for="name">Name:</label><br />
            <input type="text"  id="name" name="name" placeholder="Enter your name" required>
            <br />
            <label for="email" style="margin-top:20px;">Email address:</label><br />
            <input type="email"  id="email" name="email" placeholder="Enter your email">
            <br />

            <table class="quizform">
                
                <?php
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
                                    echo "<tr><td>$index) $question</td></tr>";
                                    echo "<tr><td>";
                                    echo "<input type='radio' name='q$index' value='$choice1'> $choice1 <br />";
                                    echo "<input type='radio' name='q$index' value='$choice2'> $choice2 <br />";
                                    echo "<input type='radio' name='q$index' value='$choice3'> $choice3 <br />";
                                    echo "<input type='radio' name='q$index' value='$choice4'> $choice4 <br />";
                                    echo "</td></tr>";
                                }
                            }
                        fclose($file);
                    }
                ?>
            </table>
            <input style="margin-top: 50px;" class="btn btn-primary" type="submit" value="Get Quizzed!">
            
        </form>
        <br />
        <div class="scoreboard">
            <h2>View the Scoreboard!</h2>
            <a id="breathing-button" href="scores.php" class="btn btn-primary" target="_blank" style="background-color: #1a7d35; border-color: #1a7d35;">Quiz Leaderboard</a>
        </div>
            <a class="btn btn-primary refresh" onclick="window.location.reload();" class="btn btn-primary" style="background-color: brown; border-color: brown;">Refresh Quiz</a>
    </body>
</html>