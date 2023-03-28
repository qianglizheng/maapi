<?php

namespace app\api\controller\v1\captcha;

use app\common\model\AdminEmailConfig;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email extends SetCode
{
    public function send($receiver='', $content='')
    {
        $mail = new PHPMailer(true);
        $config = AdminEmailConfig::find(1);
        try {
            //服务器设置
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //启用详细调试输出
            $mail->isSMTP();                                              //使用SMTP发送
            $mail->Host       = $config['host'];                          //将SMTP服务器设置为通过
            $mail->SMTPAuth   = true;                                     //启用SMTP身份验证
            $mail->Username   = $config['username'];                      //SMTP username
            $mail->Password   = $config['password'];                      //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;              //启用隐式TLS加密
            $mail->Port       = $config['port'];                          //要连接的TCP端口;如果已设置“SMTPSecure = PHPMailer：：ENCRYPTION_STARTTLS”，则使用587

            //接收者
            $mail->setFrom($config['username'], '');
            $mail->addAddress($receiver, '');                             //添加收件人 名字是可选的
            $mail->addReplyTo($config['username'], $config['username']);

            //附件
            // $mail->addAttachment('http://www.tp6.com/static/images/bg.jpg', 'new.jpg');         //添加附件 可选名称

            //内容
            $mail->isHTML(true);     //将电子邮件格式设置为HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return $this->return_json(0, [], '邮件发送成功');
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
