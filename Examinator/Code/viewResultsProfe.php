<?php
    include_once 'header.php';
    include_once 'includes/getResultDataProfe.inc.php';
?>
<body>
    <h1>Exam Review</h1>
    <?php
    if($nfilas === 0){
         echo "<h3>You have not participated in this exam yet.</h3>";
    }
    else
    {
        echo "<h2>" . $asig . "</h2>";
        ?>
        <table>
            <tr>
            <th>Topic</th>
            <th>Question</th>
            <th>1. Answer</th>
            <th>2. Answer</th>
            <th>3. Answer</th>
            <th>4. Answer</th>
            <th>Your Answer</th>
            <th>Correct Answer</th>
            </tr>
        <?php
        $correct = 0;
        while($result = mysqli_fetch_assoc($resultData)){
            echo "<tr>";
            echo "<td>" . $result['questionsTopic'] . "</td>";
            echo "<td>" . $result['questionsQuestion'] . "</td>";
            echo "<td>" . $result['questionsAnswer_1'] . "</td>";
            echo "<td>" . $result['questionsAnswer_2'] . "</td>";
            echo "<td>" . $result['questionsAnswer_3'] . "</td>";
            echo "<td>" . $result['questionsAnswer_4'] . "</td>";
            echo "<td>" . $result['answersAnswer'] . "</td>";
            echo "<td>" . $result['questionsCorrect_answer'] . "</td>";
            echo "</tr>";
            if($result['answersAnswer'] === $result['questionsCorrect_answer']){
                $correct = $correct+1;
            }
        }
        echo"</table>";
        $percent = round(($correct/$nfilas), 2)*100;
        $grade = 0;
        if($percent>50){
            $grade = $percent/10;
        }
        echo "<h5> You have answered " . $correct . " questions out of " . $nfilas . " correctly. That are " . $percent . "%.</h5>";
        echo "<h3>Grade : " . $grade . "</h3>";
    } ?>
</body>

<?php
    include_once 'footer.php';
?>