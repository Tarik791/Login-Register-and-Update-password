

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUIZ</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <div class="quiz-container" id="quiz">
        <div class="quiz-header">
            <h2 id="question">Question text</h2>
            <ul>
                <li>
                    <input type="radio" id="a" name="answer" class="answer">
                    <label id="a_text" for="a">Question</label>
                </li>
                <li>
                    <input type="radio" id="b" name="answer" class="answer">
                    <label  id="b_text" for="b">Question</label>
                </li>
                <li>
                    <input type="radio" id="c" name="answer" class="answer">
                    <label id="c_text" for="c">Question</label>
                </li>
                <li>
                    <input type="radio" id="d" name="answer" class="answer"> 
                    <label id="d_text" for="d">Question</label>
                </li>  
            </ul>
        </div>        
        <button id="submit">Sbumit</button>    
    </div>
  
</body>
</html>