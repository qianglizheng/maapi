<?php

namespace app\api\controller\v1;

use app\common\controller\Common;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailCode extends Common
{
    public function send()
    {
        $mail = new PHPMailer(true);

        try {
            //服务器设置
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //启用详细调试输出
            $mail->isSMTP();                                            //使用SMTP发送
            $mail->Host       = 'smtp.qq.com';                          //将SMTP服务器设置为通过
            $mail->SMTPAuth   = true;                                   //启用SMTP身份验证
            $mail->Username   = '647551725@qq.com';                     //SMTP username
            $mail->Password   = 'bvrgijazcfnqbcfg';                     //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //启用隐式TLS加密
            $mail->Port       = 465;                                    //要连接的TCP端口;如果已设置“SMTPSecure = PHPMailer：：ENCRYPTION_STARTTLS”，则使用587

            //接收者
            $mail->setFrom('647551725@qq.com', 'Mailer');
            $mail->addAddress('2325727631@qq.com', '');     //添加收件人 名字是可选的
            $mail->addReplyTo('647551725@qq.com', '647551725@qq.com');

            //附件
            $mail->addAttachment('http://www.tp6.com/static/images/bg.jpg', 'new.jpg');         //添加附件 可选名称

            //内容
            $mail->isHTML(true);     //将电子邮件格式设置为HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
