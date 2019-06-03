<?php
class Math
{
    public function __construct($x)
    {
        echo "What is the result?";
    }
}

class Primary extends Math
{
    public function calculation()
    {
        $z = 5;
        return $x + $z . "<br/>";
    }
}

class High extends Math
{
    public function calculation()
    {
        $z = 5;
        $x = 3;
        return $y . "<br/>";
    }
}

$primary = new Primary('3');
echo $primary->calculation();
$high = new High('3');
echo $high->calculation();