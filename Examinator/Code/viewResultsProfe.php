<?php
    include_once 'header.php';
    include_once 'includes/getResultDataProfe.inc.php';
?>
<body>
    <h1>Exam Review</h1>
    <?php
    if($nfilas === 0){
         echo "<h3>No one has participated in this exam yet.</h3>";
    }
    else
    {
        echo "<h2>" . $asig . "</h2>";
        ?>
        <table>
            <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Points</th>
            <th>Grade</th>
            </tr>
        <?php
        $sumOfGradesReal = 0;
        $sumOfGradesWithZero = 0;
        $sumOfSobresalientes = 0;
        $sumOfNotables = 0;
        $sumOfAprobados = 0;
        $sumOfSuspensos = 0;
        while($result = mysqli_fetch_assoc($resultData)){
            $grade = round($result['points']/$nQuestions,2)*10;
            $sumOfGradesReal = $sumOfGradesReal + $grade;
            if($grade >= 9){
                $sumOfSobresalientes = $sumOfSobresalientes + 1;
            }elseif($grade >= 7){
                $sumOfNotables = $sumOfNotables + 1;
            }elseif($grade >= 5){
                $sumOfAprobados = $sumOfAprobados + 1;
            }else{
                $sumOfSuspensos = $sumOfSuspensos + 1;
                $grade = 0;
            }
            $sumOfGradesWithZero = $sumOfGradesWithZero + $grade;
            echo "<tr>";
            echo "<td>" . $result['studId'] . "</td>";
            echo "<td>" . $result['usersName'] . "</td>";
            echo "<td>" . $result['usersEmail'] . "</td>";
            echo "<td>" . $result['points'] . "/" . $nQuestions . "</td>";
            echo "<td>" . $grade . "</td>";
            echo "</tr>";
        }
        echo"</table>";
        $avgGradeReal = $sumOfGradesReal/$nfilas;
        $avgGradeZero = $sumOfGradesWithZero/$nfilas;
        echo "<h3>average grade from 0 to 10: " . $avgGradeReal . "</h3>";
        echo "<h3>average grade of the actual final grades: " . $avgGradeZero . "</h3>";
        echo "<h3>Number of Sobresalientes: " . $sumOfSobresalientes . "/" . $nfilas . "</h3>";
        echo "<h3>Number of Notables: " . $sumOfNotables . "/" . $nfilas . "</h3>";
        echo "<h3>Number of Aprobados: " . $sumOfAprobados . "/" . $nfilas . "</h3>";
        echo "<h3>Number of Suspensos: " . $sumOfSuspensos . "/" . $nfilas . "</h3>";
    } ?>
</body>

<?php
    include_once 'footer.php';
?>