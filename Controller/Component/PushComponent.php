<?php 
App::uses('Component', 'Controller');

class PushComponent extends Component 
{
   # public $server_api_key;
	
   public function send($recievers = [], $data = []) 
   {
   	   # SERVER_API_KEY is unique key from your PUSH NOTIFICATION PROVIDER 
   	   # In this part i am using Firebase Cloud Messaging 
       // define('SERVER_API_KEY', 'AAAAXFELzjY:APA91bFhUDAJCHXPA7ayb0Y9xSyOe6K6uZbOwg4zbOeeMvkn3DQXnhfyn2Ja1s7VGIIMj9spSb8krkkDaj8Fi5xLauH0jtzIQcGQ3giDIFCTUuSnjJgMg1ppQorMx6pHLgxW3li1qhnuTm4mIuWzACJ-JGj3N-a_Fg');
       define('SERVER_API_KEY',file_get_contents(WWW_ROOT."files/serverKey.txt"));
       define('TITLE','Notification');
       define('BODY','For those who beleive there is no need of Proof for those who don\'t there is no reason to beleive!');
       define('ICON','/img/panda.png'); 
       define('CLICK_ACTION','https://bodycrew.blobby.xyz/users/my_profile');
       
       # HEADER CONFIGURATIONS
       $headers = [
					'Authorization : Key='.SERVER_API_KEY,
					'Content-Type: application/json'
			   	   ];	
 		
 	   # Calling a helper function that validates message data.
 	   
 	   $data = $this->validate_data($data);
 	   
 	   # debug($data);
 	   
 	   # MESSAGE CONFIGURATION 
	   $message = [
        			"title" => $data['title'],
        		    "body" =>  $data['body'],
        		    "icon" => $data['icon'],
        		    // "image" => $dat['image'],
        		    "click_action" => $data['click_action'],
        		    "image" => $data["image"]
   		          ];
		# debug($recievers);


	   # Payload is the data that is send to the target url 
	   # In this part the payload array holds the tokens / registration_ids of the users 
	   # Take note the tokens as unique id that is created by FCM 
	   $payload = [
					   'registration_ids' => $recievers,
					   //'to' => $token,
					   'data' => $message
		  		  ];
	   
	   # CURL COMMAND CONFIG 
	   $curl = curl_init();
	   curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => json_encode($payload),
		  CURLOPT_HTTPHEADER => $headers,
	  ));

      # CURL COMMAND EXECUTION
	   $response = curl_exec($curl);
	   $err = curl_error($curl);
       
      # CLOSING OF CURL COMMAND
	   curl_close($curl);

	  # Output	   	
	   if ($err) {
		  echo "cURL Error #:" . $err;
	   } else {
	   	  echo SERVER_API_KEY."\n";
		  echo $response;
		  // header("location:notifier.php");
	   }
	   
	   exit();
   }
   
   public function validate_data( $data )
   {
   		# This is a function that checks if a data field is empty / null 
   		# and fillup a default value for the missing data field
   		# returns the process data.
   		
		if( empty($data['title']) ) 
		   $data['title'] = TITLE;
		
		if( empty($data['body']) )
		   $data['body'] = BODY;
		   
		if( empty($data['icon']) )
		   $data['icon'] = ICON;
		   
		if( empty($data['click_action']) )
		   $data['click_action'] = CLICK_ACTION;
		   
		return $data;
   }
   
   public function generate_data($title = null,$body = null, $icon = null, $click_action = null)
   {
   	   $data = [
        			"title" => $title,
        		    "body" =>  $body,
        		    "icon" => $icon,
        		    // "image" => $dat['image'],
        		    "click_action" => $click_action
   	           ];
   	           
   	   return $data;     
   }
}