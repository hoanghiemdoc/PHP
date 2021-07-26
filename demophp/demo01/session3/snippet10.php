<?php
 $let1 = 0;
  function sum() {
      static $let1 = 9;
      $let2 = $let1 +12;

      echo 'the value of the variable is: $let1<br>';
      echo 'the addittion value of 9+12 =';
      echo "$let2<br>";
  }

  sum();
?>
