<?php

if($module == "firebase" && $function == "notification"){
    notification();
}


function notification(){

    global $response;

    // Server key from Firebase Console
    define( 'API_ACCESS_KEY', 'AAAAVTMbpq0:APA91bHqQ7HlF_2CaZnXchJcs2DTgBlVSp1Gw1TTWvTJ3f8B7URCGnRI_CXv8-paD6iShi9sG5ZLq3mXkLCOTs9L8Z8HUJ7kDFVQNp0rI2JO8F9kgfTuzZzk2G7atZhTEMxcKuwEbrvW' ); // Replace YOUR FIREBASE CLOUD MESSAGING API KEY with your Firebase Cloud Messaging server Key

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {

    // POST values
    $token= $_POST["token"];
    $topic= $_POST['topic'];

    $title= $_POST["title"];
    $message= $_POST["message"];
    // $postlink= $_POST["postlink"];

    //$token = htmlspecialchars($token,ENT_COMPAT);
    // $title = htmlspecialchars($title,ENT_COMPAT);
    // $message = htmlspecialchars($message,ENT_COMPAT);
    // $postlink = htmlspecialchars($postlink,ENT_COMPAT);
    
    $to = "";

    if(isset($token)){
        $to = $token;
    }else{
        $to = "/topics/".$topic;
    }
    // Push Data's
    $data = array(
        "to" => "$to",
        "notification" => array( 
        "title" => "$title", 
        "body" => "$message"
        // , 
        // "icon" => "https://example.com/icon.png", // Replace https://example.com/icon.png with your PUSH ICON URL
        // "click_action" => "$postlink"
        )
        );

    // Print Output in JSON Format
    $data_string = json_encode($data); 
        
    // FCM API Token URL
    $url = "https://fcm.googleapis.com/fcm/send";

    //Curl Headers
    $headers = array
    (
        'Authorization: key=' . API_ACCESS_KEY, 
        'Content-Type: application/json'
    );  

    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL, $url);                                                                 
    curl_setopt($ch, CURLOPT_POST, 1);  
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);                                                                  
                                                                                                                        
    // Variable for Print the Result
    $result = curl_exec($ch);

    curl_close($ch);


    $response['responseInfo']['status'] = 'success';
    $response['responseInfo']['message'] = 'success';

    header('Content-Type: application/json');
    echo json_encode($response);
    }
}





?>