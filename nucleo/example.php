<?php
/*************************************************************
 * This script is developed by Arturs Sosins aka ar2rsawseen, http://webcodingeasy.com
 * Fee free to distribute and modify code, but keep reference to its creator
 *
 * This class generate QR [Quick Response] codes with proper metadata for mobile  phones
 * using google chart api http://chart.apis.google.com
 * Here are sources with free QR code reading software for mobile phones:
 * http://reader.kaywa.com/
 * http://www.quickmark.com.tw/En/basic/download.asp
 * http://code.google.com/p/zxing/
 *
 * For more information, examples and online documentation visit: 
 * http://webcodingeasy.com/PHP-classes/QR-code-generator-class
 **************************************************************/

include("qrcode.php");

$qr = new qrcode();

//link
$qr->link("10-09-20");
echo "<p>Link</p>";
echo "<p><img src='".$qr->get_link()."' border='0'/></p>";



?>