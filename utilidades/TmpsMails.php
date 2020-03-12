<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace utilidades\TmpsMails;

/**
 * Description of TmpsMails
 *
 * @author Josglow
 */
//$x = new TmpsMails();
//$x->tmp_bsd_02(array('nombre_destino' => "", 'body' => "mi mensaje", 'atentamente_01' => '', 'atentamente_02' => 'Servium.mx', 'title_tmp' => 'Error de registro'));
class TmpsMails {

    public function tmp_directoresygerentesonline($param) {
        /*
          $nombre_destino
          $body
          $atentamente_01

         * example:
         * $str_template = $this->tmp_directoresygerentesonline(array('nombre_destino' => "", 'body' => $body_copy, 'atentamente_01' => 'Juan'));
         */
        extract($param);
        $cad = '';
        $cad = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<head>
    <meta name="viewport" content="width=device-width"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Directores y Gerentes Online</title>


    <style type="text/css">
        img {
            max-width: 100%;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100% !important;
            height: 100%;
            line-height: 1.6em;
        }

        body {
            background-color: #f6f6f6;
        }

        @media only screen and (max-width: 640px) {
            body {
                padding: 0 !important;
            }

            h1 {
                font-weight: 800 !important;
                margin: 20px 0 5px !important;
            }

            h2 {
                font-weight: 800 !important;
                margin: 20px 0 5px !important;
            }

            h3 {
                font-weight: 800 !important;
                margin: 20px 0 5px !important;
            }

            h4 {
                font-weight: 800 !important;
                margin: 20px 0 5px !important;
            }

            h1 {
                font-size: 22px !important;
            }

            h2 {
                font-size: 18px !important;
            }

            h3 {
                font-size: 16px !important;
            }

            .container {
                padding: 0 !important;
                width: 100% !important;
            }

            .content {
                padding: 0 !important;
            }

            .content-wrap {
                padding: 10px !important;
            }

            .invoice {
                width: 100% !important;
            }
        }
    </style>
</head>

<body style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;"
      bgcolor="#f6f6f6">

<table class="body-wrap"
       style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;"
       bgcolor="#f6f6f6">
    <tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <td style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;"
            valign="top"></td>
        <td class="container" width="600"
            style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;"
            valign="top">
            <div class="content"
                 style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope
                       itemtype="http://schema.org/ConfirmAction"
                       style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; margin: 0; border: none;"
                       >
                    <tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                        <td class="content-wrap"
                            style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;padding: 30px;border: 3px solid #F7931E;border-radius: 7px; background-color: #fff;"
                            valign="top">
                            <meta itemprop="name" content="Confirm Email"
                                  style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"/>
                            <table width="100%" cellpadding="0" cellspacing="0"
                                   style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <tr>
                                    <td style="text-align: center">
                                        <a href="http://directoresygerentesonline.com" style="display: block;margin-bottom: 10px;"> <img src="http://directoresygerentesonline.com/images/logo/logo.png" height="60" alt="Directores y Gerentes Online"/></a> <br/>
                                    </td>
                                </tr>
                                <tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                    <td class="content-block"
                                        style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;"
                                        valign="top">
                                        <h4>' . $nombre_destino . '</h4>
                                        ' . $body . '
                                    </td>
                                </tr>
                                <tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                    <td class="content-block"
                                        style="text-align: right;font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;color:#7d7979;"
                                        valign="top">
                                        ' . $atentamente_01 . '
                                    </td>
                                </tr>                                
                                
                            </table>
                        </td>
                    </tr>
                </table>
                <div class="footer"
                     style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">
                    <table width="100%"
                           style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                        <tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                            <td class="aligncenter content-block"
                                style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;"
                                align="center" valign="top"><a href="http://directoresygerentesonline.com/" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0;">directoresygerentesonline.com</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </td>
        <td style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;"
            valign="top"></td>
    </tr>
</table>
</body>
</html>
';
        return $cad;
    }

    public function tmp_bsd_02($param) {
        /*
          title_tmp
          nombre_destino
          body
          $atentamente_01
          $atentamente_02
         * example:
         * $str_template = $this->tmp_bsd_02(array('nombre_destino' => "", 'body' => $body_copy, 'atentamente_01' => '', 'atentamente_02' => 'Servium.mx', 'title_tmp' => 'Error de registro'));
         */
        extract($param);
        $cad = '';
        $cad = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
<meta name='format-detection' content='telephone=no' />
<title>Respmail is a response HTML email designed to work on all major email platforms and smartphones</title>
<style type='text/css'>/*<![CDATA[*/html{background-color:#e1e1e1;margin:0;padding:0}body,#bodyTable,#bodyCell,#bodyCell{height:100%!important;margin:0;padding:0;width:100%!important;font-family:Helvetica,Arial,\'Lucida Grande\', sans-serif;}
table{border-collapse:collapse;}
table[id=bodyTable] {width:100%!important;margin:auto;max-width:900px!important;color:#7A7A7A;font-weight:normal;}
img, a img{border:0; outline:none; text-decoration:none;height:auto; line-height:100%;}
a {text-decoration:none !important;border-bottom: 1px solid;}
h1, h2, h3, h4, h5, h6{color:#5F5F5F; font-weight:normal; font-family:Helvetica; font-size:20px; line-height:125%; text-align:Left; letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;}

/* CLIENT-SPECIFIC STYLES */
.ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail/Outlook.com to display emails at full width. */
.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;} /* Force Hotmail/Outlook.com to display line heights normally. */
table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up. */
#outlook a{padding:0;} /* Force Outlook 2007 and up to provide a 'view in browser' message. */
img{-ms-interpolation-mode: bicubic;display:block;outline:none; text-decoration:none;} /* Force IE to smoothly render resized images. */
body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%; font-weight:normal!important;} /* Prevent Windows- and Webkit-based mobile platforms from changing declared text sizes. */
.ExternalClass td[class='ecxflexibleContainerBox'] h3 {padding-top: 10px !important;} /* Force hotmail to push 2-grid sub headers down */

/* /\/\/\/\/\/\/\/\/ TEMPLATE STYLES /\/\/\/\/\/\/\/\/ */

/* ========== Page Styles ========== */
h1{display:block;font-size:26px;font-style:normal;font-weight:normal;line-height:100%;}
h2{display:block;font-size:20px;font-style:normal;font-weight:normal;line-height:120%;}
h3{display:block;font-size:17px;font-style:normal;font-weight:normal;line-height:110%;}
h4{display:block;font-size:18px;font-style:italic;font-weight:normal;line-height:100%;}
.flexibleImage{height:auto;}
.linkRemoveBorder{border-bottom:0 !important;}
table[class=flexibleContainerCellDivider] {padding-bottom:0 !important;padding-top:0 !important;}

body, #bodyTable{background-color:#E1E1E1;}
#emailHeader{background-color:#E1E1E1;}
#emailBody{background-color:#FFFFFF;}
#emailFooter{background-color:#E1E1E1;}
.nestedContainer{background-color:#F8F8F8; border:1px solid #CCCCCC;}
.emailButton{background-color:#205478; border-collapse:separate;}
.buttonContent{color:#FFFFFF; font-family:Helvetica; font-size:18px; font-weight:bold; line-height:100%; padding:15px; text-align:center;}
.buttonContent a{color:#FFFFFF; display:block; text-decoration:none!important; border:0!important;}
.emailCalendar{background-color:#FFFFFF; border:1px solid #CCCCCC;}
.emailCalendarMonth{background-color:#205478; color:#FFFFFF; font-family:Helvetica, Arial, sans-serif; font-size:16px; font-weight:bold; padding-top:10px; padding-bottom:10px; text-align:center;}
.emailCalendarDay{color:#205478; font-family:Helvetica, Arial, sans-serif; font-size:60px; font-weight:bold; line-height:100%; padding-top:20px; padding-bottom:20px; text-align:center;}
.imageContentText {margin-top: 10px;line-height:0;}
.imageContentText a {line-height:0;}
#invisibleIntroduction {display:none !important;} /* Removing the introduction text from the view */

/*FRAMEWORK HACKS & OVERRIDES */
span[class=ios-color-hack] a {color:#275100!important;text-decoration:none!important;} /* Remove all link colors in IOS (below are duplicates based on the color preference) */
span[class=ios-color-hack2] a {color:#205478!important;text-decoration:none!important;}
span[class=ios-color-hack3] a {color:#8B8B8B!important;text-decoration:none!important;}
/* A nice and clean way to target phone numbers you want clickable and avoid a mobile phone from linking other numbers that look like, but are not phone numbers.  Use these two blocks of code to 'unstyle' any numbers that may be linked.  The second block gives you a class to apply with a span tag to the numbers you would like linked and styled.
Inspired by Campaign Monitor's article on using phone numbers in email: http://www.campaignmonitor.com/blog/post/3571/using-phone-numbers-in-html-email/.
*/
.a[href^='tel'], a[href^='sms'] {text-decoration:none!important;color:#606060!important;pointer-events:none!important;cursor:default!important;}
.mobile_link a[href^='tel'], .mobile_link a[href^='sms'] {text-decoration:none!important;color:#606060!important;pointer-events:auto!important;cursor:default!important;}


/* MOBILE STYLES */
@media only screen and (max-width: 480px){
/*////// CLIENT-SPECIFIC STYLES //////*/
body{width:100% !important; min-width:100% !important;} /* Force iOS Mail to render the email at full width. */

/* FRAMEWORK STYLES */
/*
CSS selectors are written in attribute
selector format to prevent Yahoo Mail
from rendering media query styles on
desktop.
*/
/*td[class='textContent'], td[class='flexibleContainerCell'] { width: 100%; padding-left: 10px !important; padding-right: 10px !important; }*/
table[id='emailHeader'],
table[id='emailBody'],
table[id='emailFooter'],
table[class='flexibleContainer'],
td[class='flexibleContainerCell'] {width:100% !important;}
td[class='flexibleContainerBox'], td[class='flexibleContainerBox'] table {display: block;width: 100%;text-align: left;}
/*
The following style rule makes any
image classed with 'flexibleImage'
fluid when the query activates.
Make sure you add an inline max-width
to those images to prevent them
from blowing out.
*/
td[class='imageContent'] img {height:auto !important; width:100% !important; max-width:100% !important; }
img[class='flexibleImage']{height:auto !important; width:100% !important;max-width:100% !important;}
img[class='flexibleImageSmall']{height:auto !important; width:auto !important;}


/*
Create top space for every second element in a block
*/
table[class='flexibleContainerBoxNext']{padding-top: 10px !important;}

/*
Make buttons in the email span the
full width of their container, allowing
for left- or right-handed ease of use.
*/
table[class='emailButton']{width:100% !important;}
td[class='buttonContent']{padding:0 !important;}
td[class='buttonContent'] a{padding:15px!important}}/*]]>*/</style>
<!--[if mso 12]>
<style type='text/css'>.flexibleContainer{display:block!important;width:100%!important}</style>
<![endif]-->
<!--[if mso 14]>
<style type='text/css'>.flexibleContainer{display:block!important;width:100%!important}</style>
<![endif]-->
</head>
<body bgcolor='#E1E1E1' leftmargin='0' marginwidth='0' topmargin='0' marginheight='0' offset='0'>
<center style='background-color:#E1E1E1'>
<table border='0' cellpadding='0' cellspacing='0' height='100%' width='100%' id='bodyTable' style='table-layout:fixed;max-width:100%!important;width:100%!important;min-width:100%!important'>
<tr>
<td align='center' valign='top' id='bodyCell'>
<table bgcolor='#E1E1E1' border='0' cellpadding='0' cellspacing='0' width='900' id='emailHeader'>
<tr>
<td align='center' valign='top'>
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
<tr>
<td align='center' valign='top'>
<table border='0' cellpadding='10' cellspacing='0' width='900' class='flexibleContainer'>
<tr>
<td valign='top' width='900' class='flexibleContainerCell'>
<table align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>
<tr>
<td align='left' valign='middle' id='invisibleIntroduction' class='flexibleContainerBox' style='display:none!important;mso-hide:all'>
<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:100%'>
<tr>
    <td align='left' class='textContent'>
        <div style='font-family:Helvetica,Arial,sans-serif;font-size:13px;color:#828282;text-align:center;line-height:120%'>
            <!-- The introduction of your message preview goes here. Try to make it short. -->
        </div>
    </td>
</tr>
</table>
</td>
<td align='right' valign='middle' class='flexibleContainerBox'>
<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:100%'>
<tr>
    <td align='left' class='textContent'>
        <div style='font-family:Helvetica,Arial,sans-serif;font-size:13px;color:#828282;text-align:center;line-height:120%'>
            &nbsp;
        </div>
    </td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
<table bgcolor='#FFFFFF' border='0' cellpadding='0' cellspacing='0' width='900' id='emailBody'>
<tr>
<td align='center' valign='top'>
<table border='0' cellpadding='0' cellspacing='0' width='100%' style='color:#FFFFFF' bgcolor='#3c8dbc'>
<tr>
<td align='center' valign='top'>
<table border='0' cellpadding='0' cellspacing='0' width='900' class='flexibleContainer'>
<tr>
<td align='center' valign='top' width='900' class='flexibleContainerCell'>
<table border='0' cellpadding='15' cellspacing='0' width='100%'>
<tr>
<td align='left' valign='top' class='textContent'>
<img src='http://" . HOST_URL . "/" . PROJECT_NAME . "/img/logo/default_logo.png' width='190'></img>
</td>
<td align='left' valign='middle' class='textContent'>
<h1 style='color:#FFFFFF;line-height:100%;font-family:Helvetica,Arial,sans-serif;font-size:35px;font-weight:normal;margin-bottom:5px'>" . (isset($title_tmp) && trim($title_tmp) != '' ? $title_tmp : '') . " </h1>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align='center' valign='top'>
<table border='0' cellpadding='0' cellspacing='0' width='100%' bgcolor='#ffffff'>
<tr>
<td align='center' valign='top'>
<table border='0' cellpadding='0' cellspacing='0' width='900' class='flexibleContainer'>
<tr>
<td align='center' valign='top' width='900' class='flexibleContainerCell'>
<table border='0' cellpadding='30' cellspacing='0' width='100%'>
<tr>
<td align='center' valign='top'>
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
<tr>
    <td valign='top' class='textContent'>
        <h3 mc:edit='header' style='color:#5F5F5F;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left'>" . (isset($nombre_destino) && trim($nombre_destino) != '' ? $nombre_destino : 'Estimados (as)') . "</h3>
        <div mc:edit='body' style='text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#5F5F5F;line-height:135%'>
            " . (isset($body) && $body != '' ? $body : '') . "
        </div>
    </td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align='center' valign='top'>
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
<tr>
<td align='center' valign='top'>
<table border='0' cellpadding='30' cellspacing='0' width='900' class='flexibleContainer'>
<tr>
<td valign='top' width='900' class='flexibleContainerCell'>
<table align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>
<tr>
<td align='left' valign='top' class='flexibleContainerBox'>
<table border='0' cellpadding='0' cellspacing='0' width='210' style='max-width:100%'>
<tr>
    <td align='left' class='textContent'>
        <h3 style='color:#5F5F5F;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left'></h3>
        <div style='text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#5F5F5F;line-height:135%'></div>
    </td>
</tr>
</table>
</td>
<td align='right' valign='middle' class='flexibleContainerBox'>
<table class='flexibleContainerBoxNext' border='0' cellpadding='0' cellspacing='0' width='210' style='max-width:100%'>
<tr>
    <td align='left' class='textContent'>
        <h3 style='color:#5F5F5F;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:0px;text-align:left'>" . (isset($atentamente_01) && trim($atentamente_01) != '' ? $atentamente_01 : '') . "</h3>
        <div style='text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#5F5F5F;line-height:135%'>
            " . (isset($atentamente_02) && trim($atentamente_02) != '' ? $atentamente_02 : '') . "</div></td></tr></table></td></tr></table></td></tr></table></td></tr></table></td></tr></table><table bgcolor='#E1E1E1' border='0' cellpadding='0' cellspacing='0' width='900' id='emailFooter'><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%'><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' width='900' class='flexibleContainer'><tr><td align='center' valign='top' width='900' class='flexibleContainerCell'><table border='0' cellpadding='30' cellspacing='0' width='100%'><tr><td valign='top' bgcolor='#E1E1E1'><div style='font-family:Helvetica,Arial,sans-serif;font-size:13px;color:#828282;text-align:center;line-height:120%'><div>Copyright &#169; " . date("Y") . " <a href='http://directoresygerentesonline.com/' target='_blank' title='http://directoresygerentesonline.com/' style='text-decoration:none;color:#828282'><span style='color:#828282'>Directores y Gerentes Online</span></a>. Todos&nbsp;los&nbsp;derechos&nbsp;reservados.</div><div>Éste correo se ha generado automáticamente.</div></div></td></tr></table></td></tr></table></td></tr></table></td></tr></table></td></tr></table></center></body></html>";
        return $cad;
    }

    public function tmp_contratoIndividualTrabajoInd($params) {
        extract($params);
        $cad = "";
        $cad = '
<style type="text/css">
*{font-size: 13px; font-family: \'Arial\', Helvetica, sans-serif;}
.justify, p { text-align: justify; }
ol li{ text-align: justify; }
.center{ text-align: center; }
table{
    text-align: center;
    width: 100%;
}                
</style>

<h5 class="justify">
CONTRATO INDIVIDUAL DE TRABAJO POR TIEMPO INDETERMINADO (EN LO SUCESIVO EL “CONTRATO”) QUE CELEBRAN POR UNA PARTE [*] (EN LO SUCESIVO LA “EMPRESA”), REPRESENTADA EN ESTE ACTO POR [*], Y POR LA OTRA PARTE ' . $nombreTrabajador . ' (EN LO SUCESIVO EL “TRABAJADOR”), DE CONFORMIDAD CON LAS SIGUIENTES DECLARACIONES Y CLÁUSULAS:
</h5>
<h4 class="center">D E C L A R A C I O N E S</h4>
<h5>I. Por medio de su representante legal, declara la EMPRESA que:</h5>
<ol type="a">
<li>
Ser una sociedad mercantil constituida conforme a las leyes de Estados Unidos Mexicanos y cuyo objeto social consiste en [*].
</li>
<li>
Tener su domicilio en [*] y, cuyo Registro Federal de contribuyentes es [*].
</li>
<li>Que requiere los servicios del TRABAJADOR.</li>
</ol>
<h5>II. Por su propio derecho y bajo protesta de decir verdad, declara el TRABAJADOR:</h5>
<ol type="a">
<li>
Llamarse como ha quedado escrito en el proemio del presente Contrato.
</li>
<li>
Ser de nacionalidad mexicana, su estado civil ' . $estadoCivil . ', ser mayor de edad y encontrarse en buen estado de salud.
</li>
<li>
Tener su domicilio en ' . $direccionTrabajador . ', que es donde habita y que lo señala para recibir avisos y notificaciones por parte de la EMPRESA.
</li>
<li>
Que su número de Registro Federal de Causantes es ' . $rfcTrabajador . ', su número de afiliación ante el Instituto Mexicano del Seguro Social es ' . $nss . ' y su Clave Única de Registro de Población es ' . $curp . '.
</li>
<li>
Que no presta servicios subordinados o independientes en la actualidad para ninguna empresa, ni recibe percepción alguna de otra empresa.
</li>
<li>
Que no tiene enfermedad o incapacidad alguna que lo imposibilite para desempeñar el trabajo para el que se le contrata.
</li>
<li>
Que cuenta con los conocimientos, capacidades, experiencia, y habilidades necesarias para desempeñar y prestar sus servicios personales en los términos del presente Contrato.
</li>                    
</ol>
<h5>
III. Declaran ambas partes reconocerse mutuamente la personalidad con que se ostentan para la celebración del presente Contrato.
</h5>
<p>EN VIRTUD DE LO ANTERIOR, las partes de común acuerdo otorgan las siguientes:</p>
<h4 class="center">C L Á U S U L A S</h4>
<p>
<b>PRIMERA.</b>- El TRABAJADOR se obliga a prestar a la EMPRESA sus servicios personales y subordinados de manera exclusiva a la misma en el puesto de [*], teniendo como obligaciones las siguientes que se mencionan de manera enunciativa más no limitativa:
</p>
<p>
•Ejecutar los planes de trabajo que se le asignen de acuerdo con su categoría. •Asistir a sus superiores en el desarrollo de las actividades de la EMPRESA y que estén relacionados directamente con la actividad preponderante del mismo. •Acoplarse a los métodos informáticos, contables y administrativos que la empresa utilice para llevar a cabo la contabilidad, administración y operación de la EMPRESA. •Guardar confidencialidad respecto de cualquier información que por motivo de sus funciones tuviere. Asimismo y bajo ninguna circunstancia deberá proporcionar información o datos de ninguna especie, ni de manera verbal, escrita o por medios informáticos físicos o análogos a persona alguna, salvo autorización por escrito de su superior inmediato. •Sancionar de manera administrativa bajo las políticas establecidas a sus subordinados si los tuviere. •Reportar las irregularidades contables, administrativas o de cualquier especie considerada constitutiva de un delito, daño o conducta reprobable por cualquier persona y que llegare a conocer por motivo de sus funciones o dentro del horario de las mismas. •Realizar todas las gestiones necesarias que su función o categoría le permitan para el buen funcionamiento del establecimiento. •Poner en conocimiento de la EMPRESA cualquier acto que ponga en riesgo el buen funcionamiento del establecimiento o la integridad del personal, como la de los clientes del establecimiento. •Realizar los informes que le requiera su superior en el tiempo solicitado. •Asistir puntualmente a sus labores. •Dar cumplimiento cabal al artículo 134 de la Ley Federal del Trabajo en todas sus fracciones cuando estas le sean aplicables, mismo artículo que le fue leído y explicado. •Desempeñar en todo momento y lugar con honradez, eficacia, esmero, y responsabilidad, su trabajo, debiendo abstenerse de cualquier acto de corrupción, fraudulento en contra de la EMPRESA o con los clientes de éste último. •Observar un trato respetuoso en sus relaciones con las personas, debiendo abstenerse de todo acto de prepotencia •Obedecer las órdenes de sus superiores jerárquicos y cumplir con todas las obligaciones que tengan a su cargo, debiendo observar que al cumplirlas no signifique incurrir en ninguna especie de delito. •Abstenerse durante todo el tiempo que presten servicios para la EMPRESA de consumir sustancias psicotrópicas, estupefacientes, o cualquier clase de productos con efectos similares. •Abstenerse de laborar y prestar sus servicios en estado de ebriedad o bajo la influencia de cualquier tipo de droga. 
</p>
<p>
La inobservancia a tales disposiciones dará lugar a la aplicación de las sanciones previstas en La Ley Federal del Trabajo, el Reglamento Interior de Trabajo, Manual o Instructivo operativo aplicable, con independencia de las demás responsabilidades jurídicas que su conducta pudiera generar. Asimismo dichas sanciones serán aplicables en caso de que las declaraciones vertidas por el TRABAJADOR resultaren falsas.
</p>
<p>
<b>SEGUNDA.</b>- El TRABAJADOR se obliga a exhibir los documentos que se señalan en sus declaraciones, a más tardar dentro de los 5 días posteriores a la fecha de firma del presente Contrato y se obliga a dejar una copia fotostática de éstos a la EMPRESA en el entendido que, de no hacerlo en los términos y condiciones señalados en la presente cláusula, será rescisión sin responsabilidad para la EMPRESA. La EMPRESA nunca conservará originales y solo podrá pedir su presentación para cotejo en caso de estimarlo necesario.
</p>
<p>
<b>TERCERA.</b>- El TRABAJADOR se obliga a prestar sus servicios personales a la EMPRESA en cualquiera de sus oficinas o sucursales, por lo que otorga su expreso consentimiento para ello y para que pueda ser cambiado de su lugar de trabajo según las necesidades de la EMPRESA, lo anterior sin menoscabo de la retribución que le haya sido fijada. Para el caso de transferencia de centro de trabajo, bastará con que se le comunique al TRABAJADOR con una anticipación de dos días.
</p>
<p>
<b>CUARTA.</b>- Las partes convienen en términos de los artículos 35, 37 y 39-A de la Ley Federal del Trabajo, que este Contrato se celebra por tiempo indeterminado y bajo la modalidad de periodo a prueba, mismo que no podrá modificarse, suspenderse, rescindirse o terminarse sino por voluntad de las partes, falta de aprobación del periodo a prueba o en los términos previstos por la Ley Federal de Trabajo y sus reglamentos aplicables. 
</p>
<p>
El periodo a prueba señalado en el párrafo anterior podrá ser de hasta 180 días a partir de la fecha de firma del presente Contrato según corresponda a su categoría, en términos del artículo 39-A de la Ley Federal del Trabajo. La EMPRESA podrá verificar en cualquier tiempo que el TRABAJADOR cumpla con los requisitos y conocimientos necesarios para desarrollar el trabajo para el cual se le contrata sin necesidad de agotar el término de prueba. Dicho periodo es improrrogable en términos del artículo 39-D de la Ley Federal del Trabajo.
</p>
<p>
Durante el periodo de prueba se garantizará al TRABAJADOR todos los derechos y prerrogativas de carácter laboral y de seguridad social, en términos del artículo 39-A tercer párrafo de la Ley Federal del Trabajo, por tanto, el Contrato podrá darse por terminado en los siguientes términos: (i) Que al término del periodo de prueba el TRABAJADOR, a juicio de la EMPRESA, no acredite competencia y conocimientos necesarios para desarrollar sus labores; o (ii) Que durante el periodo de prueba el TRABAJADOR, a juicio de la EMPRESA, el TRABAJADOR no acredite competencia y conocimientos necesarios para desarrollar sus labores, es decir, que no es necesario tener que agotar el periodo de prueba si a juicio de la EMPRESA es suficiente el tiempo transcurrido para tener por no acreditado dicho periodo. En ambos casos tal determinación se hará tomando en cuenta la opinión de la Comisión Mixta De Productividad, Capacitación y Adiestramiento en los términos de ley, atendiendo a la naturaleza del puesto desempeñado durante ese periodo, y en su caso no habrá más responsabilidad para la EMPRESA que pagar los salarios devengados y partes proporcionales de prestaciones generados hasta esa fecha. Por el contrario, si el TRABAJADOR al término del periodo de prueba o durante éste, acredita satisfacer los requisitos, aptitudes y conocimientos necesarios para las labores a juicio de la EMPRESA, tomando en cuenta la opinión de la Comisión Mixta De Productividad, Capacitación y Adiestramiento en los términos de ley, atendiendo a la naturaleza del puesto desempeñado durante ese periodo, se entenderá superado el periodo a prueba y el presente Contrato se entenderá por tiempo indeterminado. Por tanto el TRABAJADOR  tiene estrictamente prohibido prestar sus servicios más allá del día prefijado sino hasta que la EMPRESA le indique que probó contar con los conocimientos, aptitudes y habilidades necesarios para el desempeño de sus funciones y para ello las partes pactan que durante el periodo de prueba o a su término la EMPRESA otorgue una constancia en donde exista la determinación de las capacidades y habilidades de la EMPRESA, es decir una constancia que le acredite haber superado el periodo a prueba. La falta de éste documento se entenderá que no superó el periodo de prueba por lo que sin éste el TRABAJADOR no podrá continuar laborando más allá del término probatorio fijado en el presente Contrato y se entenderá por terminada la relación laboral en los términos de ley. No obstante, lo anterior, si terminado el periodo de prueba se continúa la prestación del servicio y existe pago de salarios devengados posteriores a dicho periodo sin que medie la carta de acreditación, se presumirá la aprobación del periodo de prueba y el presente Contrato se entenderá por el tiempo indeterminado.
</p>
<p>
Las partes convienen en términos de los artículos 35 de la Ley Federal del Trabajo, que este Contrato se celebra por tiempo indeterminado una vez que el TRABAJADOR pase el periodo a prueba y no podrá modificarse, suspenderse, rescindirse o terminarse, sino por voluntad de las partes, o en los términos previstos por la Ley Federal del Trabajo y sus reglamentos aplicables.
</p>
<p>
<b>QUINTA.</b>- La retribución que la EMPRESA pagará al TRABAJADOR por la prestación de sus servicios a que se refiere este Contrato, consistirá en un salario mensual base (antes de impuestos) de $[*] ([*]). También acuerdan las partes que el salario le será cubierto al TRABAJADOR los días [*] y [*] de cada mes, en el entendido que de si el día de pago fuera inhábil o de descanso obligatorio en los Estados Unidos Mexicanos, dicha remuneración le será pagada el día hábil inmediato anterior, dicha retribución será pagada en moneda de curso legal de los Estados Unidos Mexicanos y se efectuará: (i) en las oficinas de la EMPRESA; o (ii) vía transferencia electrónica a la cuenta bancaria del TRABAJADOR, otorgando desde este momento el mismo su consentimiento para ello y señalando los datos de su cuenta bancaria a continuación:
</p>
<ul style="list-style-type:none">
<li>i.	Titular: El TRABAJADOR </li>
<li>ii.	Nombre del banco: [*]. </li>
<li>iii. Número de cuenta: [*].</li>
<li>iv.	CLABE Interbancaria: [*].</li>
</ul>
<p>
Asimismo el TRABAJADOR está obligado a firmar de conformidad las constancias de pago respectivas cuando se utilicen, teniendo en cuenta lo dispuesto en los artículos 108 y 109 de la Ley Federal del Trabajo, haciendo notar que si no aparece concepto alguno por tiempo extraordinario, es porque no lo laboró, pactando que la firma del recibo implica extender el más amplio finiquito que en derecho proceda a la EMPRESA de todas las prestaciones a las que tuvo derecho, por lo que cualquier aclaración o reclamación deberá hacerse antes de suscribir el recibo correspondiente. Asimismo la EMPRESA tiene el derecho de cambiar la forma y días de pago, siempre que la misma no contravenga la Ley Federal del Trabajo.
</p>
<p>
<b>SEXTA.</b>- Las partes pactan que en caso de no existir recibo de salario firmado, serán válidos para comprobación de pago, aquellos que se hayan declarado a las autoridades fiscales y/o los depósitos bancarios que la EMPRESA por ese concepto hubiera depositado al TRABAJADOR de la misma forma las partes pactan que bajo una política ambientalista y en términos de las disposiciones fiscales vigentes, los recibos de salarios podrán ser enviados al TRABAJADOR al siguiente correo electrónico ' . $emailTrabajador . ', teniendo 30 días subsecuentes para cualquier aclaración al respecto para interponer a la gerencia de recursos humanos un escrito con acuse de recibo en el que se inconforme o solicite aclaración en su caso, pasado este tiempo, se entenderá por consentido el contenido del recibo en cuestión.
</p>
<p>
<b>SÉPTIMA.</b>- La duración de la jornada será de 8 (ocho) horas diarias, contando con por lo menos 60 (sesenta) minutos cuando menos de descanso para tomar sus alimentos, lo cual hará fuera de las instalaciones de la EMPRESA, cuando por circunstancias extraordinarias la duración de la jornada deba cambiar se deberá de observar y respetar lo estipulado en la cláusula siguiente, es decir, fuera del centro de trabajo. El horario y día de descanso semanal, podrán variar de acuerdo a las necesidades del  proyecto que tenga a su cargo y a sus actividades y responsabilidades, facultando expresamente a la EMPRESA para modificar el horario a cualquiera de los turnos establecidos en las instalaciones de acuerdo a las necesidades del mismo y en los términos dispuestos por los artículos 59, 60, 61 y 62 de la Ley Federal del Trabajo dada la naturaleza del trabajo a desempeñar, con la salvedad de que solo podrán recorrerse las ocho horas de la jornada laboral, por lo que el TRABAJADOR manifiesta su entera conformidad con el contenido de esta cláusula.
</p>
<p>
<b>OCTAVA.</b>- Cuando por circunstancias extraordinarias se aumente la jornada de trabajo, los servicios prestados durante el tiempo excedente se considerarán como extraordinarios y se pagarán a razón de ciento por ciento más del salario establecido para las horas de trabajo normal. Tales servicios nunca podrán exceder de tres horas diarias ni de tres veces en una semana; en la inteligencia de que el TRABAJADOR no está autorizado para laborar en tiempo extraordinario, salvo que haya orden expresa, y por escrito del representante legal de la EMPRESA, autorización que deberá conservar para cualquier aclaración en su caso. Dicha autorización se firmará en dos tantos quedando una en poder del TRABAJADOR y la otra en la “relación de horario extraordinario” que al efecto lleve la EMPRESA. En caso de extravío del tanto original del TRABAJADOR, éste podrá solicitar una copia al representante de la EMPRESA y éste estará obligado a proporcionársela. Asimismo el TRABAJADOR está obligado a checar su tarjeta o a firmar las listas de asistencia, o someterse a cualquier tipo de control de asistencia que al efecto señale la EMPRESA a la entrada y salida de sus labores, así como al salir y entrar durante su periodo de descanso, por lo que el incumplimiento de ese requisito indicará la falta injustificada a sus labores, para todos los efectos legales. La EMPRESA tiene el derecho para cambiar el método de asistencia en cualquier momento.
</p>
<p>
<b>NOVENA.</b>- En cumplimiento al artículo 69 de la Ley Federal del Trabajo manifiestan las partes, por cada seis días de trabajo, tendrá el TRABAJADOR un descanso semanal de un día con pago de salario íntegro, conviniéndose en que dicho descanso lo disfrutará el día domingo de cada semana, facultando expresamente a la EMPRESA para modificar el día de descanso de acuerdo a las necesidades del mismo.  Asimismo, ambas partes acuerdan fijar un día de reposo adicional que será los días sábados de cada semana, siempre y cuando la necesidad del servicio lo permita.
</p>
<p>
<b>DÉCIMA.</b>- En caso de que su jornada laboral sea modificada de acuerdo al plan de trabajo, o cargo que desempeñare, y tuviera que laborar el día domingo, este será retribuido con un 25% adicional al salario diario por concepto de prima dominical. También disfrutará de descanso, con pago de salario íntegro, los días señalados en el artículo 74 de la Ley Federal del Trabajo al considerarse de descanso obligatorio.  De la misma manera, queda expresamente prohibido laborar días de descanso o de descanso obligatorio salvo que por las necesidades extremas y urgentes del servicio lo solicite la EMPRESA, teniendo la facultad el TRABAJADOR de decidir no laborarlos sin ninguna responsabilidad para éste, sin embargo si decide hacerlo solo se entenderá que queda autorizarlo para laborarlo si existe una orden expresa y por escrito del representante de la EMPRESA, autorización que deberá conservar el TRABAJADOR para cualquier aclaración en su caso. Dicha autorización se firmará en dos tantos quedando una en poder del  TRABAJADOR y la otra en la “relación de días de descanso laborados” que al efecto lleve la EMPRESA. En caso de extravío del tanto original del TRABAJADOR, éste podrá solicitar una copia al representante de la EMPRESA y éste estará obligado a proporcionársela.
</p>
<p>
<b>DÉCIMA PRIMERA.</b>- El TRABAJADOR después de un año de servicios continuos, disfrutará de un periodo anual de vacaciones, de seis días laborales, que aumentará en dos días laborales, hasta llegar a doce, por cada año subsiguiente de servicios. Después del cuarto año, el periodo de vacaciones aumentará dos días por cada cinco años de servicios. Los salarios correspondientes a las vacaciones se cubrirán con una prima del veinticinco por ciento sobre los mismos. En caso de faltas injustificadas de asistencia al trabajo, se podrán deducir dichas faltas del periodo de prestación de servicios computable para fijar las vacaciones, reduciéndose éstas proporcionalmente. Las vacaciones no podrán compensarse con una remuneración. Si la relación de trabajo termina antes de que se cumpla el año de servicios, el trabajador tendrá derecho a una remuneración proporcionada al tiempo de servicios prestados.
</p>
<p>
<b>DÉCIMA SEGUNDA.</b>- El TRABAJADOR percibirá un aguinaldo anual, que deberá pagársele antes del día veinte de diciembre, y que será equivalente a quince días del salario que percibe el mismo, cuando no haya cumplido el año de prestación de servicios, tendrá derecho el TRABAJADOR a que se le pague en proporción al tiempo trabajado.
</p>
<p>
<b>DÉCIMA TERCERA.</b>- Queda expresamente prohibido para el TRABAJADOR recibir órdenes de cualquiera de los clientes de la EMPRESA o ejecutar actividades similares o iguales a las de los trabajadores de éste. En caso de que observe tal situación deberá de ponerla en conocimiento de la EMPRESA.
</p>
<p>
<b>DÉCIMA CUARTA.</b>- Ambas partes convienen que por virtud del objeto social de la EMPRESA, cuando por el servicio para el cual se haya contratado, el TRABAJADOR realice o invente algún proceso, herramienta, sistema, planos, diseños, etc., manifiesta desde este momento que el único propietario de dicho trabajo es la EMPRESA, renunciando el TRABAJADOR a cualquier acción que de dicha ejecución de trabajos se pudiera desprender y reconoce que está bajo la subordinación de la EMPRESA y por tanto es de esta la propiedad y autoría tanto moral, comercial, como intelectual y legal del resultado del trabajo que realice al servicio de la EMPRESA, por lo que renuncia expresamente a cualquier remuneración adicional a su salario, regalías y/o derechos que pudiera haber tenido por este concepto.
</p>
<p>
Esto es, que el resultado que arroje la ejecución de servicios del TRABAJADOR pertenece en su autoría a la EMPRESA. En caso de que el TRABAJADOR obre en contra de esta cláusula se hará acreedor a una pena convencional, misma que será determinada por la EMPRESA, con independencia de los daños y perjuicios que dicha acción ocasione a la EMPRESA.
</p>
<p>
<b>DÉCIMA QUINTA.</b>- El TRABAJADOR conviene en someterse a los reconocimientos médicos que periódicamente ordene la EMPRESA en los términos de la fracción X del artículo 134 de la Ley Federal del Trabajo en la inteligencia de que el médico que los practique será designado y retribuido por la EMPRESA. Asimismo el TRABAJADOR se obliga a dar total cumplimiento al capítulo II artículo 134 de la ley de la materia.
</p>
<p>
<b>DÉCIMA SEXTA.</b>- El TRABAJADOR se obliga a no revelar a terceras personas, los nombres, información, papeles, cifras, análisis, planos, diseños, estudios, técnicas de operación o promoción recetas o cualquier otro dato relacionado con la labor que va a desempeñar o la que tenga conocimiento con motivo de sus funciones, inclusive la que esté desarrollando. Asimismo es su obligación guardar escrupulosamente los secretos técnicos, comerciales, contables y administrativos que puedan causar perjuicios a la EMPRESA. Se entiende como información confidencial, toda aquella que este a su disposición con motivo de las funciones que desempeñará al servicio de la EMPRESA así como también toda aquella que se origine con motivo de sus funciones.
</p>
<p>
<b>DÉCIMA SÉPTIMA.</b>- El TRABAJADOR se obliga a que, durante la vigencia del presente Contrato, no podrá prestar sus servicios en forma directa o indirecta a terceras personas, menos aún a terceros que tengan relación directa con el objeto social de la EMPRESA ya sea clientes o empresas competencia. En caso de que el TRABAJADOR obre en contra de esta cláusula se hará acreedor a una pena convencional, misma que será determinada por la EMPRESA, con independencia de los daños y perjuicios que dicha acción ocasione a la EMPRESA.
</p>
<p>
<b>DÉCIMA OCTAVA.</b>- El TRABAJADOR, reconoce que son propiedad de la EMPRESA todos los documentos, materiales, herramientas, equipos de cómputo y de comunicación e instrumentos en general que se le proporcione para el mejor desempeño de sus labores con motivo del presente Contrato, obligándose a conservarlos en buen estado y a entregarlos a la EMPRESA en el momento en el que éste los requiera, a razón por lo cual dichos instrumentos en ningún momento podrán ser considerados como parte íntegra del salario que devengue.
</p>
<p>
El TRABAJADOR se obliga expresa y formalmente a que durante la vigencia del presente Contrato, a no realizar, ocuparse o emprender por sí o por interpósita persona actividad igual a la de la EMPRESA, que se considere competencia, es decir, dedicarse al mismo giro o actividad alguna que implique competencia para éste.
</p>
<p>
<b>DÉCIMA NOVENA.</b>- El TRABAJADOR será capacitado o adiestrado en los términos de los planes y programas establecidos o que se establezcan, por la EMPRESA, conforme a lo dispuesto en el Capítulo III Bis, Título Cuarto de la Ley Federal del Trabajo. En caso de no asistir a las capacitaciones, será causal de rescisión de la relación de trabajo sin responsabilidad para la EMPRESA.
</p>
<p>
<b>VIGÉSIMA.</b>- El TRABAJADOR (en su carácter del “TITULAR”) declara que está informado del alcance y efectos de la Ley Federal de Protección de Datos Personales en Posesión de los Particulares y otorga su consentimiento expreso para que la EMPRESA (en su carácter del “RESPONSABLE”) obtenga, use, acceda, maneje, aproveche, transfiera, disponga, divulgue o almacene sus datos personales así como trate, administre y procese sus datos personales, aun aquellos denominados como datos personales sensibles (es decir que revelen aspectos como origen racial, étnico, estado de salud, características personales tomando en cuenta aptitudes características, información genética o creencias religiosas, filosóficas o morales, afiliación sindical, políticas y preferencia sexual), observando los principios de licitud, consentimiento, información, calidad, finalidad, lealtad, proporcionalidad y responsabilidad. Lo anterior en términos del Aviso de Privacidad publicado y actualizado por el RESPONSABLE en el domicilio señalado en el presente Contrato.
</p>
<p>
El TITULAR reconoce y acepta la obligación de guardar y mantener total confidencialidad de los datos personales a que tenga acceso con motivo de la relación de trabajo. En virtud de lo anterior, el TITULAR deberá abstenerse de revelar a terceros, directa o indirectamente, en todo o en parte, por medio alguno, los datos personales a que tenga acceso con motivo de la relación de trabajo, salvo aquellos que sean estrictamente necesarios para el desempeño de sus obligaciones laborales, previa notificación por escrito a dichos terceros de la obligación de cumplir con las disposiciones de la Ley Federal de Protección de Datos Personales en Posesión de los Particulares y contar con el respectivo “Aviso de Privacidad”. 
</p>
<p>
<b>VIGÉSIMA PRIMERA.</b>-Las partes convienen en que todo lo no previsto en el presente Contrato se regirá por lo dispuesto en la Ley Federal del Trabajo, y en que, para todo lo que se refiera a interpretación ejecución y cumplimiento del mismo, se someten expresamente a la jurisdicción y competencia de la Junta Local de Conciliación y Arbitraje de la Ciudad de México. Asimismo cualquier notificación derivada de la relación de trabajo, deberá hacerse en los domicilios que las partes han manifestado, bajo pena de nulidad. En consecuencia el TRABAJADOR se acoge al beneficio que estipula el inciso a) y b) del artículo 700 fracción II de la Ley Federal del Trabajo rechazando expresamente el que estipula el inciso c) del mismo ordenamiento. Asimismo señala el TRABAJADOR que podrá girarse instrucciones, órdenes, comunicados similares y conexos al correo electrónico señalado en el presente Contrato.
</p>
<p>
Leído que fue el presente Contrato por las partes, e impuestas de su contenido, alcance y fuerza legal, lo firmaron por duplicado a su más entera satisfacción y conocimiento y por su recibo, quedando un tanto en poder de cada una de las mismas el día de su firma.
</p>

<p>En la ciudad de ' . $ciudadTrabajador . ', a ' . $ContratoFecha_dia . ' de ' . $ContratoFecha_mes . ' de ' . $ContratoFecha_year . '.</p>
<table border="0">
<tr>
<td>
    El  TRABAJADOR
    <br/><br/><br/>
</td>
<td>
    LA EMPRESA
    <br/>[*]
    <br/><br/>
</td>
</tr>
<tr>
<td>
    ______________________________
    <br/>Por su propio derecho
</td>
<td><br/>______________________________
    <br/>[*]
    <br/>Representante legal

</td>
</tr>
</table>  
';
        return $cad;
    }

    public function tmp_avisoPrivacidad($array) {
        extract($array);
        $cad = "";
        $cad = '
        <style type="text/css">
            *{font-size: 13px; font-family: \'Arial\', Helvetica, sans-serif;}
            .justify, p { text-align: justify; }
            .center{ text-align: center; }
            ol li{ text-align: justify; }
            table{
                text-align: center;
                width: 100%;
            }                
        </style>
    
        <h5 class="center">
        AVISO DE PRIVACIDAD PARA CANDIDATOS Y/O EMPLEADOS DE
        <br/>STYLE ADVISER TECH & ASOCIADOS, S.C. 
        </h5>

        <p>
        En términos de los artículos 15, 16 y 17 de la Ley Federal de Protección de Datos Personales en Posesión de los Particulares, se emite el presente aviso de privacidad de STYLE ADVISER TECH & ASOCIADOS, S.C., en los términos siguientes:
        </p>
        <p>
        <b>IDENTIDAD Y DOMICILIO DEL RESPONSABLE.</b> STYLE ADVISER TECH & ASOCIADOS, S.C. (a quien en lo sucesivo se le denominará “RESPONSABLE”), mismo que será responsable de recabar sus datos personales, del uso que se le dé a los mismos y de su protección, quien tiene su domicilio en Av. Insurgentes Sur, 1793 Edificio Hauss, Int. 313 C, Col. Guadalupe Inn, Alcaldía Álvaro Obregón, Ciudad de México, C.P. 01020.
        </p>
        <p>
        <b>FORMAS DE CONTACTO.</b> Para el caso de que Usted quiera ejercer sus derechos de Acceso, Rectificación, Cancelación y Oposición conocidos como “derechos ARCO” o contactar al responsable para lo relativo al tratamiento de sus datos personales puede contactarse con nosotros mediante los siguientes canales:
        </p>
        <p>
        Domicilio: Av. Insurgentes Sur, 1793 Edificio Hauss, Int. 313 C, Col. Guadalupe Inn, Delegación Álvaro Obregón, Ciudad de México, C.P. 01020.<br/>
        Página web: http://directoresygerentesonline.com<br/>        
        Encargado del Departamento de Datos Personales: Edgar Bautista Salomón<br/>
        Correo electrónico: reclutamiento@directoresygerentesonline.com <br/>
        </p>
        <p>
        <b>FINALIDADES DEL TRATAMIENTO DE DATOS PERSONALES.</b> El RESPONSABLE, recopilará normalmente información personal directamente de Usted. Igualmente, la recopilación podría ocurrir mediante conversaciones personales, vía telefónica, e-mail, por solicitud de trabajo, por currículo; también podrá recopilar información de otra manera, como, a través de su interacción con sitios Web de reclutamiento y bolsas de trabajo, medios sociales de Internet, aplicaciones, y otros.
        </p>
        <p>
            Los datos personales que recabamos de Usted, los utilizaremos para las siguientes finalidades que son necesarias para el puesto que solicita.
        </p>
        <p>
        <b>FINALIDADES PRIMARIAS:</b> Reclutamiento laboral, información de contacto para entrevistas de trabajo o, en su caso, para contratarlo.
        </p>
        <p>Esta información tiene por objeto:</p>
        <ol type="1">
            <li>Fines de identificación;</li>
            <li>Evaluar si Usted está calificado para desempeñar un puesto o una función;</li>
            <li>Procesos de contratación laboral o de prestación de servicios independientes frente a terceros;</li>
            <li>Entrega de referencias en caso de que otra persona o empresa solicite informes sobre posibles candidatos a un puesto, trabajo, cargo o comisión;</li>
            <li>Publicarlos para posibles reclutadores;</li>
            <li>Para solicitar referencias laborales y/o educativas que validen la información que Usted nos proporciona acerca de sus conocimientos; </li>
            <li>Para contactarlo cuando sea necesario vía correo electrónico o teléfono con el fin de informarle que Usted continuará en el proceso de selección de las vacantes de nuestros Clientes y que éste nos ha solicitado iniciar el proceso de realizarle a Usted el estudio socioeconómico y/o pruebas, así como cualquier otra requerida por nuestros Clientes;</li>
            <li>Para contactarlo ya en su calidad de empleado en su caso;</li>
            <li>Para sacar estadísticas relativas a edad, domicilio, profesión, actividad, etc.</li>
            <li>Para que en el caso de que no continúe en el proceso de la vacante para la cual Usted inicialmente aplicó, lo podamos canalizar a otra u otras posibles vacantes mediante nuestros procesos de reclutamiento; </li>
            <li>Para comunicarnos con Usted en relación con los puestos que ofrecemos;</li>
            <li>Llevar a cabo investigaciones y análisis, realizar informes estadísticos, establecer esquemas de remuneración, evaluar el desempeño de empleados y el mercado laboral;</li>
            <li>Generar perfiles y estructuras laborales que permitan incrementar y mejorar la productividad, así como cualquier otro fin orientado para el mejoramiento de las condiciones de trabajo; y</li>
            <li>Para fines administrativos, para cumplir con obligaciones legales o para resolver o defender quejas y demandas legales.
        </ol>
        <p>
            De manera adicional, podremos utilizar su información personal para las siguientes finalidades que no son necesarias para el puesto solicitado y que permiten el desarrollo de nuestra operación. 
        </p>
        <p>
        <b>FINALIDADES SECUNDARIAS:</b> Para ofrecerle nuestros servicios, así como para la mejora del proceso comercial y mercadotecnia, esta información incluye el poder informar sobre cambios o novedades en nuestros procesos y políticas.
        </p>
        <p>
            En caso de que no desee que sus datos personales sean tratados para estos fines adicionales o secundarios, Usted puede presentar un escrito dirigido al RESPONSABLE, en la forma que se establece en el apartado de nominado DERECHO DE ACCESO, RECTIFICACIÓN, CANCELACIÓN U OPOSICIÓN (ARCO).
        </p>
        <p>
            La negativa para el uso de sus datos personales para estas finalidades no podrá ser un motivo para que le neguemos el acceso al proceso de reclutamiento. 
        </p>
        <p>
        <b>DATOS PERSONALES:</b> Para dar cumplimiento a las finalidades indicadas, el RESPONSABLE solicitará los siguientes datos personales: 
        </p>
        <ol type="1">
            <li>Nombre completo.</li>
            <li>Lugar y fecha de nacimiento.</li>
            <li>Domicilio actual.</li>
            <li>Correo electrónico.</li>
            <li>Estado Civil.</li>
            <li>Nacionalidad.</li>
            <li>Clave Única de Registro de Población (CURP).</li>
            <li>Registro Federal de Contribuyentes (RFC).</li>
            <li>Fecha de nacimiento.</li>
            <li>Firma autógrafa y electrónica.</li>
            <li>Número de cartilla militar.</li>
            <li>Edad.</li>
            <li>Puesto.</li>
            <li>Número telefónico del trabajo, casa y móvil.</li>
            <li>Información fiscal.</li>
            <li>Cuentas bancarias.</li>
            <li>Ingresos.</li>
            <li>Nivel académico.</li>
            <li>Trayectoria educativa.</li>
            <li>Nombres de dependientes y/o beneficiarios.</li>
            <li>Fotografía.</li>
            <li>Idioma.</li>
            <li>Datos de tránsito y movimientos migratorios.</li>
            <li>Datos personales de su cónyuge, hijos padres, herederos o legatarios.</li>
            <li>Número de Seguridad Social.</li>
            <li>Aviso de retención INFONAVIT.</li>
        </ol>
        <p>
        <b>DATOS PERSONALES SENSIBLES:</b> Le informamos que para cumplir con las finalidades indicadas en este aviso de privacidad, el RESPONSABLE podrá solicitarle datos personales sensibles como: (i) características físicas, (ii) origen étnico, (iii) origen racial, (iv) afiliación sindical, (v) posturas ideológicas o religiosas, así como (vi) enfermedades que padece, alergias y medicamentos que toma al momento de solicitar un puesto; religión que practica y partido político en el que milita o con el que simpatiza.  
        </p>
        <p>
        <b>DERECHO DE ACCESO, RECTIFICACIÓN, CANCELACIÓN U OPOSICIÓN (ARCO).</b> Usted tiene derecho a acceder a sus datos personales y los detalles del tratamiento de los mismos, así como a rectificarlos en caso de ser inexactos o incompletos, cancelarlos cuando considere que no se requieren para alguna de las finalidades señaladas en el presente aviso de privacidad o estén siendo utilizados para finalidades no consentidas, de igual forma, cuando haya finalizado la relación contractual o bien oponerse al tratamiento de los mismos para fines específicos.
        </p>
        <p>
            Puede ejercer sus derechos “ARCO”, mediante una solicitud por escrito, dirigida al departamento de privacidad, la cual deberá:
        </p>
        <ol>
            <li>Contener nombre y firma autógrafa del titular, así como un domicilio u otro medio para comunicarle la respuesta a su solicitud. </li>
            <li>Acompañar copia de los documentos oficiales que acrediten la identidad del titular. </li>
            <li>Incluir una descripción clara y precisa de los datos personales respecto de los cuales ejercitará los derechos que les confiere la Ley. </li>
            <li>Incluir cualquier elemento o documento que facilite la localización de los datos personales de que se traten.</li>

        </ol>
        <p>
            Puede enviar su solicitud a través de correo electrónico a la dirección a reclutamiento@directoresygerentesonline.com acompañando, en archivo adjunto, los documentos oficiales que acrediten su identidad, asimismo deberá atender los puntos señalados en los incisos a), c), y d), anteriores.
        </p>
        <p>
            Para los efectos precisados anteriormente, el RESPONSABLE dará respuesta a su petición dentro de los 20 días hábiles siguientes a la recepción de su escrito y le será entregada en el domicilio o correo electrónico que Usted proporcione para ello.  
        </p>
        <p>
        <b>TRANSFERENCIA DE DATOS.</b> El RESPONSABLE se compromete a no transmitir, vender, alquilar, revelar o utilizar su información personal a favor de terceras personas sin su consentimiento, con excepción de aquella información que sea necesaria o requerida por alguna autoridad, que funden y motiven su mandato en términos de las leyes aplicables y cuando la transferencia sea precisa para el mantenimiento o cumplimiento de una relación jurídica entre el responsable y el titular, lo anterior, en términos del artículo 37 de la Ley Federal de Protección de Datos Personales en Posesión de los Particulares.
        </p>
        <p>
            Para que el RESPONSABLE pueda cumplir con la relación que, en su caso, le une con Usted, transfiere datos personales a personas físicas o morales que podrán ser nacionales o extranjeras, empresas filiales o subsidiarias, incluyendo servidores de almacenamiento de información quienes quedarán obligados, a mantener la confidencialidad de los datos personales en términos del presente aviso de privacidad.
        </p>
        <p>
            Por otra parte, se hace de su conocimiento que el RESPONSABLE podría realizar transferencias en atención a la administración de recursos humanos, previsión social y prestaciones que otorga la empresa, por ejemplo: compañías aseguradoras, empresas administradoras de vales o tarjetas de descuento, de despensa, de gasolina, de alimentos, de planes de jubilación, cajas de ahorro, así como a instituciones bancarias. 
        </p>
        <p>
        <b>MODIFICACIONES AL AVISO DE PRIVACIDAD.</b> Nos reservamos el derecho de efectuar en cualquier momento modificaciones o actualizaciones al presente aviso de privacidad, para el cumplimiento adecuado de nuevas disposiciones legales, políticas internas o requerimientos. Las modificaciones que en su caso se llegarán a realizar, estarán disponibles a través de avisos visibles en nuestras oficinas o en nuestra página de internet.
        </p>
        <p>
        <b>QUEJAS.</b> Si Usted considera que su derecho a la protección de datos personales ha sido lesionado por alguna conducta de nuestros empleados, de nuestras actuaciones o respuestas o presume que en el tratamiento de sus datos personales existe alguna violación a las disposiciones previstas en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares, podrá interponer la queja o denuncia correspondiente ante el INAI, para mayor información visite www.inai.org.mx.
        </p>
        <p> Última fecha de actualización enero de 2019.</p>
        
        <br/><br/><br/>
        <table border="0">
        <tr>
            <td><br/><br/><br/>
                ____________________________________
                <br/>'.$nombreTrabajador.' <br/>' . $ContratoFecha_dia . ' de ' . $ContratoFecha_mes . ' de ' . $ContratoFecha_year . ' <br/>
            </td>    
        </tr>
        </table>  
        ';
        return $cad;
    }

}
