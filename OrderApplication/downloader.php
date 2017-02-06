<?php 
    

    require './phpmailer/PHPMailerAutoload.php';
     require './phpmailer/class.phpmailer.php'; // path to the PHPMailer class
        require './phpmailer/class.smtp.php';

    $mail = new PHPMailer;

    //$mail->isSMTP(); 
    $mail->Host = 'gmail.com';
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'cgraham@greatapparelforyou.com';                 // SMTP username
    $mail->Password = '5HB7c9ut';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587; 
    
    $mail->setFrom('cgraham@greatapparelforyou.com', 'Mailer');
    $mail->addAddress('cgraham@greatapparelforyou.com', 'Joe User');     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
    
    
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
    if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }

    $json = urldecode($_POST["ords"]);
   $data = json_decode($json);
   //why does this fix the encoding issue?
   $data = json_decode($data);

   header("Content-type: text/plain");
   header("Content-Disposition: attachment; filename=".$data->{"company"}->{"name"}."_orders.txt");

  
   
    echo "company_id\t";
    echo "company_name\t";
    echo "order_id\t";
    echo "firstname\t";
    echo "lastname\t";
    echo "address1\t";
    echo "address2\t";
    echo "city\t";
    echo "state\t";
    echo "zip\t";
    echo "country\t";
    echo "email\t";
    echo "shipping_method\t";
    echo "insured\t";
    echo "gift_message\t";
    echo "design_id\t";
    echo "style_number\t";
    echo "color\t";
    echo "size\t";
    echo "quantity\t";
    echo "\r\n";


  foreach(  $data->{"company"}->{"orders"} as $order)
  {

      foreach($order->{"items"} as $item)
      {
          echo $data->{"company"}->{"name"};
          echo "\t";
          echo $data->{"company"}->{"id"};
          echo "\t";
          echo $order->{"orderId"};
          echo "\t";
          echo $order->{"firstName"};
          echo "\t";
          echo $order->{"lastName"};
          echo "\t";
          echo $order->{"address1"};
          echo "\t";
          echo $order->{"address2"};
          echo "\t ";
          echo $order->{"city"};
          echo "\t";
          echo $order->{"state"};
          echo "\t";
          echo $order->{"zip"};
          echo "\t";
          echo $order->{"countryValue"};
          echo "\t";
          echo $order->{"email"};
          echo "\t";
          echo $order->{"shippingValue"};
          echo "\t";
          echo $order->{"insuredValue"};
          echo "\t";
          echo $order->{"giftMessage"};
          echo "\t";
           echo $item->{"designValue"}->{"name"};
           echo "\t";
           echo $item->{"styleValue"}->{"name"};
           echo "\t ";
           echo $item->{"colorValue"}->{"name"};
           echo "\t ";
           echo $item->{"sizeValue"}->{"name"};
           echo "\t";
           echo $item->{"quantity"};
           echo "\r\n";
      }
  }
   

?>