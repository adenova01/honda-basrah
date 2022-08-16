<?php


class EmailConfiguration
{
    public function config($host, $port, $username, $password, $encrypt)
    {
        $transport = (new Swift_SmtpTransport($host, $port, $encrypt))
        ->setUsername($username)
        ->setPassword($password);

        $configMailler = new Swift_Mailer($transport);
        return $configMailler;
    }

    public function sendMessage($data, $smtp)
    {
        $swiftMessage = (new Swift_Message('Reminder'))
        ->setFrom($data['from'])
        ->setTo($data['to'])
        ->addPart($data['layout'], 'text/html');
        $result = $this->config($smtp['host'], $smtp['port'], $smtp['username'], $smtp['password'], $smtp['encrypt'])->send($swiftMessage);

        if($result){
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
