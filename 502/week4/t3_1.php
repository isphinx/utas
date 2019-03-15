<html>
    <head>

    </head>

    <body>
        
<?php

$grades=array(
    array("","KIT502", "KIT503","KIT707", "KIT707"),
    array("David", 55,60, 65,70),
    array("Jason", 40,70, 55,60),
    array("Lucia", 80,94, 75,72),
    array("Mary", 47,55, 62,65),
    array("John", 77,86, 90,85),
 );
 echo "Final result for semester 1<br><br><br>";

 for($i=1;$i<6;$i++){

    echo "<b>";
    echo $grades[$i][0]."<br>";
    echo "</b>";
    for($j=1;$j<5;$j++){
        echo $grades[0][$j].":";
        if ($grades[$i][$j]<=50){
            echo "Fail";
        }else if($grades[$i][$j]<60){
            echo "Pass";
        }else if($grades[$i][$j]<70){
            echo "Credit";
        }else if($grades[$i][$j]<80){
            echo "Distinction";
        }else if($grades[$i][$j]<100){
            echo "High Distinction";
        }
        echo "(".$grades[$i][$j].")<br>";
    }
    echo "<br>";
 }

?>
    </body>
</html>