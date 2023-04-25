<?php

namespace app\api\controller\v1\send;

use app\api\controller\v1\captcha\SetCode;
use app\admin\model\AdminEmailConfig;
use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use think\facade\Cache;

class Email extends SetCode
{
    /**
     * 调用SetCode类的构造方法生成验证码并且存放在redis中 键为邮箱 值为验证码
     */
    public function __construct($email)
    {
        parent::__construct($email);
    }

    public function sendEmail($receiver='', $content='')
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
            // $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->Body = $content;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return $this->returnJson(0, [], '邮件发送成功'.Cache::get($receiver));
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
