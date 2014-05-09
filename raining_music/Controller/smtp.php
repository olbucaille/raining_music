<?php
 
// cette fonction gere le serveur et retourne les codes/erreur si besoins
//si pb -> demande à olivier ;) 
function server_parse($socket, $expected_response)
{
    $server_response = '';
    while (substr($server_response, 3, 1) != ' ')
    {
        if (!($server_response = fgets($socket, 256)))
            echo 'Couldn\'t get mail server response codes. Please contact the forum administrator.', __FILE__, __LINE__;
    }
 
    if (!(substr($server_response, 0, 3) == $expected_response))
        echo 'Unable to send e-mail. Please contact the forum administrator with the following error message reported by the SMTP server: "'.$server_response.'"', __FILE__, __LINE__;
}
 
 
//
// à la base la fonction fait partie de phpBB Group forum software phpBB2 un peu modifié depuis ;)
//
function smtp_mail($to, $subject, $message, $headers = 'Content-Type: text/html; charset=\"iso-8859-1\"')
{
    $recipients = explode(',', $to);
    $user = 'rainingmusic.isep@gmail.com';
    $pass = 'ISEPA1G4a';
    $smtp_host = 'ssl://smtp.gmail.com';
    $smtp_port = 465;
 
 
    if (!($socket = fsockopen($smtp_host, $smtp_port, $errno, $errstr, 15)))
        echo "Could not connect to smtp host '$smtp_host' ($errno) ($errstr)", __FILE__, __LINE__;
 
   server_parse($socket, '220');
 
    fwrite($socket, 'EHLO '.$smtp_host."\r\n");
    server_parse($socket, '250');
 
    fwrite($socket, 'AUTH LOGIN'."\r\n");
server_parse($socket, '334');
 
    fwrite($socket, base64_encode($user)."\r\n");
    server_parse($socket, '334');
 
    fwrite($socket, base64_encode($pass)."\r\n");
    server_parse($socket, '235');
 
 
 
    fwrite($socket, 'MAIL FROM: <websiteform@atlantic.ac>'."\r\n");
    server_parse($socket, '250');
 
    foreach ($recipients as $email)
    {
        fwrite($socket, 'RCPT TO: <'.$email.'>'."\r\n");
        server_parse($socket, '250');
    }
 
    fwrite($socket, 'DATA'."\r\n");
    server_parse($socket, '354');
 
    fwrite($socket, 'Subject: '.$subject."\r\n".'To: <'.implode('>, <', $recipients).'>'."\r\n".$headers."\r\n\r\n".$message."\r\n");
 
    fwrite($socket, '.'."\r\n");
    server_parse($socket, '250');
 
    fwrite($socket, 'QUIT'."\r\n");
    fclose($socket);
 
    return true;
}
 

?>