<?php

require_once 'config.php';

if(isset($_COOKIE['username']) && isset($_COOKIE['userid'])){
    $username = $_COOKIE['username'];
    $userid = $_COOKIE['userid'];

     $json = file_get_contents('php://input',true);

    if(isset($json)){
      
        $data = json_decode($json);
        //why does this fix the encoding issue?
        $data = json_decode($data);
        foreach(  $data->{"company"}->{"orders"} as $order)
        {
                //grab orderid
                $orderid = $order->{"orderId"};
                //grab customer order information 
                $email = $order->{"orderId"};
                $firstname = $order->{"orderId"};
                $lastname = $order->{"orderId"};
                $address1 = $order->{"orderId"};
                $address2 = $order->{"orderId"};
                $city = $order->{"orderId"};
                $state = $order->{"orderId"};
                $zip = $order->{"orderId"};
                $country = $order->{"orderId"};
                $giftmessage = $order->{"orderId"};
                $insured = $order->{"orderId"};
                $shipping = $order->{"orderId"};
                //check to see if the orderid already exists
                $companyid = $data->{"company"}->{"companyid"};

                $sql = "SELECT * FROM gafyorder ";
                $sql .= "WHERE companyid = ?";


                //create an order record

                //get id's for style, design, color,sizeo
                
                //create items to go in order record
        }
    }

}