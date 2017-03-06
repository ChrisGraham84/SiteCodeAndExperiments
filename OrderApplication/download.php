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
    
   $json = file_get_contents('php://input',true);
   $data = json_decode($json);

    $companyid = $data->{"company"}->{"id"};
     $mysqli = new mysqli("127.0.0.1","chrisush_dev","ph@th3@d","chrisush_GAFYDatabase");
       if($mysqli->connect_errno){
           echo "Sorry, this website is experiencing problems.";

           echo "Error: Failed to make a MySQL connection, here is why: \n";
            echo "Errno: " . $mysqli->connect_errno . "\n";
            echo "Error: " . $mysqli->connect_error . "\n";
        }
         $sql = "SELECT companycontactemail ";
        $sql .= "FROM  `Company` ";
        $sql .= "WHERE gafyid = ? ";

         if(!($stmt= $mysqli->prepare($sql))) {
            echo "Prepare Failed";
            echo printf("Errormessage: %s\n", $mysqli->error);
        }
        if(!$stmt->bind_param("s",$companyid)){
            echo "Binding Param Failed";
        }
         $stmt->execute();
         $result = $stmt->get_result();
         $row = $result->fetch_assoc();
         $companyemail = $row[0];
         $mail->addAddress($companyemail, $data->{"company"}->{"name"});

   //print_r($data);
   echo $json;
  
  // $orders = $data->{"company"}->{"orders"};
  $orders = "";
   
    $orders .= "company_id\t";
    $orders .= "order_id\t";
    $orders .= "customers_email_address\t";
    $orders .= "first_name\t";
    $orders .= "last_name\t";
    $orders .= "delivery_address_1\t";
    $orders .= "delivery_address_2\t";
    $orders .= "delivery_city\t";
    $orders .= "delivery_state\t";
    $orders .= "delivery_zipcode\t";
    $orders .= "country\t";
    $orders .= "design_number\t";
    $orders .= "design_description\t";
    $orders .= "print_location\t";
    $orders .= "style_number\t";
    $orders .= "style_description\t";
    $orders .= "color\t";
    $orders .= "size\t";
    $orders .= "product_quantity\t";
    $orders .= "gift_message\t";
    $orders .= "Insured_Order\t";
    $orders .= "shipping_method\t";
    $orders .= "orders_status\t";
    $orders .= "\r\n";


  foreach(  $data->{"company"}->{"orders"} as $order)
  {

      foreach($order->{"items"} as $item)
      {
          $orders .= $data->{"company"}->{"id"};
          $orders .= "\t";
          $orders .= $order->{"orderId"};
          $orders .= "\t";
          $orders .= $order->{"email"};
          $orders .= "\t";
          $orders .= $order->{"firstName"};
          $orders .= "\t";
          $orders .= $order->{"lastName"};
          $orders .= "\t";
          $orders .= $order->{"address1"};
          $orders .= "\t";
          $orders .= $order->{"address2"};
          $orders .= "\t ";
          $orders .= $order->{"city"};
          $orders .= "\t";
          $orders .= $order->{"state"};
          $orders .= "\t";
          $orders .= $order->{"zip"};
          $orders .= "\t";
          $orders .= $order->{"countryValue"};
          $orders .= "\t";
          $orders .= $item->{"designValue"}->{"designid"};
          $orders .= "\t";
          $orders .= $item->{"designValue"}->{"name"};
          $orders .= "\t";
          $orders .= $item->{"designValue"}->{"printposition"};
          $orders .= "\t";
          $orders .= $item->{"styleValue"}->{"stylenumber"};
          $orders .= "\t ";
          $orders .= $item->{"styleValue"}->{"name"};
          $orders .= "\t ";
          $orders .= $item->{"colorValue"}->{"name"};
          $orders .= "\t ";
          $orders .= $item->{"sizeValue"}->{"name"};
          $orders .= "\t";
           $orders .= $item->{"quantity"};
           $orders .= "\t";
          $orders .= $order->{"giftMessage"};
           $orders .= "\t";
           $orders .= $order->{"insuredValue"};
           $orders .= "\t";
          $orders .= $order->{"shippingValue"};
          $orders .= "\t";
          $orders .= "2";
          $orders .= "\r\n";
      }
  }
   echo $orders;

    $mail->Subject = 'Orders From Online Order Form For ' . $data->{"company"}->{"name"};
    $mail->Body    = 'These are orders that have ben sent from the online order form';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->addStringAttachment($orders, 'orders.txt');

    if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }


?>