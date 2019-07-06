<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

// use SendGrid\Mail\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email extends REST_Controller
{
    private $postData;
    private $header;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->postData = $this->request->body;
        $this->headers = $this->input->request_headers();
    }

    public function send_get(Type $var = null)
    {
        // $mail = new PHPMailer();   
        // try {
        //     //Server settings
        //     $mail->SMTPDebug = 2;                                       // Enable verbose debug output
        //     $mail->isSMTP();                                            // Set mailer to use SMTP
        //     $mail->Host       = '';  // Specify main and backup SMTP servers
        //     $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        //     $mail->Username   = '';                     // SMTP username
        //     $mail->Password   = '';                               // SMTP password
        //     $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        //     $mail->Port       = 587;                                    // TCP port to connect to
        
        //     //Recipients
        //     $mail->setFrom('', 'no reply');
        //     $mail->addAddress('', '');     // Add a recipient
           
        
        
        //     // Content
        //     $mail->isHTML(true);                                  // Set email format to HTML
        //     $mail->Subject = 'Here is the subject';
        //     $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        //     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
        //     $mail->send();
        //     echo 'Message has been sent';
        // } catch (Exception $e) {
        //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        // }     

        $m = new SimpleEmailServiceMessage();
        $m->addTo('rubby.star@hotmail.com');
        $m->setFrom('tutzejd29@gmail.com');
        $m->setSubject('Hello, world!');
        $m->setMessageFromString('This is the message body.');

        $ses = new SimpleEmailService('AKIA3HSX63WV6MIUX4EU', 'OjLKfHYMA7VEgpzvpQ6Q1VApFDERzibEy7Jl0/cX');
        print_r($ses->sendEmail($m));
    }
}