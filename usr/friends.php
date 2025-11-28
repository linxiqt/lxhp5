<?php
include_once '../usr/inc.php';
require(__DIR__ . '/tool/mail.php');
header('Content-Type: application/json');
function escape_POST_params()
{
    foreach ($_POST as $key => $value) {
        $_POST[$key] = str_replace("'", "''", $value);
    }
}
escape_POST_params();
if (isset($_POST['name'], $_POST['mail'], $_POST['des'], $_POST['ico'], $_POST['href'])) {
    $name = $_POST['name'];
    $des = $_POST['des'];
    $ico = $_POST['ico'];
    $mail = $_POST['mail'];
    $href = $_POST['href'];
    $sql = "INSERT INTO zyyo_friends (mail,name,des,ico,href,status) 
            VALUES ('$mail','$name','$des','$ico','$href',0)";
    if (@DB::query($sql)) {
        $adminEmail = $data['mail'];
        $content = '<html><meta charset="UTF-8"> <body>';
        $content .= '<h3>新的友情链接申请通知</h3>';
        $content .= '<table>';
        $content .= '<tr><td>网站名称：</td><td>' . htmlspecialchars($name) . '</td></tr>';
        $content .= '<tr><td>网站URL：</td><td><a href="' . htmlspecialchars($href) . '">' . htmlspecialchars($href) . '</a></td></tr>';
        $content .= '<tr><td>站点描述：</td><td>' . htmlspecialchars($des) . '</td></tr>';
        $content .= '<tr><td>联系邮箱：</td><td>' . htmlspecialchars($mail) . '</td></tr>';
        $content .= '<tr><td>图标地址：</td><td>' . htmlspecialchars($ico) . '</td></tr>';
        $content .= '</table></body></html>';
        $title = '【友情链接】' . htmlspecialchars($name) . ' 申请收录';
        sendmail($adminEmail, $content, $title);
        json(['code' => 1, 'msg' => '申请已提交，请等待审核']);
    } else {
        json(['code' => 0, 'msg' => '数据库错误：' . DB::error()]);
    }
} else {
    json(['code' => 0, 'msg' => '缺少必要参数']);
}