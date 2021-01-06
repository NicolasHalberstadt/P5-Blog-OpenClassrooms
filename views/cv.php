<?php
/* User: nicolashalberstadt 
* Date: 02/01/2021 
* Time: 20:36
*/
?>

<?php

// Store the file name into variable
$file = 'assets/img/cv.pdf';
$filename = 'cv.pdf';

// Header content type
header('Content-type: application/pdf');

header('Content-Disposition: inline; filename="' . $filename . '"');

header('Content-Transfer-Encoding: binary');

header('Accept-Ranges: bytes');

// Read the file
?>
<div class="container"><?php @readfile($file); ?></div>
