<?php
$im = imagegrabscreen();
imagepng($im, "myscreenshot.png");
imagedestroy($im);
?>

//For this to work your Apache service must be set to 'Allow service to interact with desktop' otherwise you will just get a blank image. To fix this right-click My Computer, select Manage/Services and Applications/Services - find the apache service (like Apache2) and right-click, select Properties - choose the Log on tab and check the 'Allow service to interact with desktop' checkbox. Restart Apache. 