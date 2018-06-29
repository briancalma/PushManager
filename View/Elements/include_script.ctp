<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase.js"></script>
<script>
       // Get the sdk Key on the file  
      <?php echo file_get_contents(WWW_ROOT."files/sdkKey.txt")?>

	  const messaging = firebase.messaging();
	
	  if('serviceWorker' in navigator) 
	  {
	       var ext = Date.now();
           
           var base_url = "<?php echo $this->webroot;?>";

           // console.log(base_url);

	       navigator.serviceWorker.register( base_url + "/app/webroot/js/sw.js?v=" + ext)
	       .then(function(swReg){
	           console.log('[SERVICE WORKER] is successfully registered');
	           console.log(swReg);
	   
	           messaging.useServiceWorker(swReg);
	           
	           messaging.requestPermission()
	           .then(function(){
	               console.log('[PUSH NOTIFICATION] is granted');
	               return messaging.getToken();
	           })
	           .then(function(token){
	               console.log('[TOKEN] ' + token);
                   
                   // Token Saving . . . 

	               // token = encodeURI(token);
	               // dataString = 'token=' + token + "&user_id=" + "";
	               
                    // $.ajax({
                    //             type : 'POST',
                    //             url : "/tokens/save_token",
                    //             data : dataString,
                    //             success : function(data) {
                                   
                    //                 // data = JSON.parse(data);
                    //                 console.log(data);
                    //             }
                    //        }); 
	           })
	           .catch(function(err) {
	               console.log('[Error] ' + err);
	           })
	       })
	       
      }
      
      messaging.onMessage(function(payload) {
        console.log('[onMessage] : ',payload); 
        // alert('Someone send you a message!');
        
        var notifTitle = payload.data.title;
        
        var notifOptions = {
                                "body" : payload.data.body,
                                "icon" : payload.data.icon,
                                "click_action" : payload.data.click_action,
                                "image" : payload.data.image
                          };
                           
        // console.log(payload.data.click_action);
        
        var notif = new Notification(notifTitle,notifOptions);
        
      });
</script>
