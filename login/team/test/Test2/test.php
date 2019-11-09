<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Test2</title>
  </head>
  <body>
    <?php
    $timestamp = time();
    $datum = date("d.m", $timestamp);
    echo $datum;
     ?>
     <?php
     if($datum == 28.10)
     {
       echo "Heute ist Heute";
     }
     ?>
     <?php
     if($datum == 29.10)
     {
       echo "Heute ist NICHT Heute";
     }
     ?>
  </body>
</html>
