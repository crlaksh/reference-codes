<?php
$browser = new COM("InternetExplorer.Application");
$handle = $browser->HWND;
$browser->Visible = true;
$browser->Navigate("http://localhost/test/test2.php");

/* Still working? */
while ($browser->Busy) {
    com_message_pump(4000);
}
$im = imagegrabwindow($handle, 0);
$browser->Quit();
imagepng($im, "iesnap.png");
imagedestroy($im);
?>



//For fullscreen browser



<?php
$browser = new COM("InternetExplorer.Application");
$handle = $browser->HWND;
$browser->Fullscreen = true;
$browser->Visible = true;
$browser->Navigate("http://localhost/test/test2.php");

/* Still working? */
while ($browser->Busy) {
    com_message_pump(4000);
}
$im = imagegrabwindow($handle, 0);
$browser->Quit();
imagepng($im, "iesnap.png");
imagedestroy($im);
?>



//For this to work your Apache service must be set to 'Allow service to interact with desktop' otherwise you will just get a blank image. To fix this right-click My Computer, select Manage/Services and Applications/Services - find the apache service (like Apache2) and right-click, select Properties - choose the Log on tab and check the 'Allow service to interact with desktop' checkbox. Restart Apache.
