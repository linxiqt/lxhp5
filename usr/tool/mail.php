<?php
require __DIR__ . '/phpmailer/src/PHPMailer.php';
require __DIR__ . '/phpmailer/src/SMTP.php';
require __DIR__ . '/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;           // 新增
use PHPMailer\PHPMailer\Exception;      // 新增

function sendmail($to, $content, $title)
{
    global $data;
    try {
        $mail = new PHPMailer(true); // 启用异常模式

        $mail->isSMTP();
        $mail->Host = $data['smtp'];
        $mail->SMTPAuth = true;
        $mail->CharSet = 'UTF-8';

        $mail->Username = $data['mailuser'];
        $mail->Password = $data['mailpwd'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom($data['mailuser'], '网站管理员');
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = $title;
        $mail->Body = $content;

        $mail->send();
    } catch (Exception $e) {
     //   error_log("邮件发送失败: " . $e->getMessage());
      //  http_response_code(500);
       // exit("通知邮件发送失败，但状态已更新" . $mail->ErrorInfo);
    }
}


?>