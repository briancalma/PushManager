<?php
App::uses('PushManagerAppController', 'PushManager.Controller');
# App::uses('Folder', 'Utility');
# App::uses('File', 'Utility');
/**
 * PushPandas Controller
 */
class PushPandaController extends PushManagerAppController 
{

/**
 * Scaffold
 *
 * @var mixed
 */
	
	public function beforeFilter()
    {
        /* You can uncomment this line below if you are using an Auth Component. */
        # $this->Auth->allow('index','login','dashboard','logout');
    }
	
    public function index()
    {
        # Redirection to the login page.
        return $this->redirect(['action' => 'login']);
    }
    
    public function login()
    {
        # If login form is submitted
        # check if the username and password is equal to admin
        # if so redirect to dashboard
        # if not show and error
         
        if($this->request->is('post'))
        {
            $username = $this->request->data['Push']['username'];
            $password = $this->request->data['Push']['password'];
            
            if($username == "admin" && $password == "admin")
            {
                $this->Flash->success(__('Login Success'));
                $this->Session->write('isLoginned',true);
                return $this->redirect(['action' => 'dashboard']);
            }
            
            $this->Flash->error(__('Username and Password is incorrect!'));
        }
    }
    
    public function dashboard()
    {
        # Checks if the users successfully loginned
        if(empty($this->Session->read('isLoginned')))
        {
            $this->Flash->error(__('You must Login First!'));
            return $this->redirect(['action' => 'login']);
        }
        
        # if the user sends the form with valid input
        # this will store the server key value to the 
        # webroot/files/serverKey.txt
        if($this->request->is('post'))
        {
            $serverKey = $this->request->data['Push']['serverKey'];
            
            if( !empty($serverKey) )
            {
                $file = WWW_ROOT."files/serverKey.txt";
                file_put_contents($file,$serverKey);
                $this->Flash->success(__('Success You Installed Push Panda Notification Plugin! You can close this tab now or just read the documentation page.'));    
            }
            else $this->Flash->error(__('Error Pls fill up the serverKey field!'));
        }
    }
    
    public function logout()
    {
        # logging out
        $this->Session->delete('isLoginned');
        return $this->redirect(['action' => 'login']);
    }

    public function generate_main_scr_file()
    {
        # Let the user type 
        # Auto Fill up things 
        # print filled up things 
        
        if($this->request->is('post'))
        {
            
            $sdk = $this->request->data['mainScript'];

            if( !empty($sdk) )
            {
                $file = WWW_ROOT."files/sdkKey.txt";
                file_put_contents($file,$sdk);
                # Creation of service worker
                $this->create_service_worker($sdk);
                $this->Flash->success(__('Success in Configuring your Request Permission Script And your Service Worker!'));        
            }

            $this->Flash->error(__('Error Please Fill Up the fields first'));
            return $this->redirect(['action' => 'dashboard']);   

        }

        exit();
    }

    public function create_service_worker($sdk)
    {
        # service worker file configurations 
        # just attaching those strings to each other 

        $script = "importScripts(\"https://www.gstatic.com/firebasejs/5.0.4/firebase-app.js\");\n";
        $script .= "importScripts(\"https://www.gstatic.com/firebasejs/5.0.4/firebase-messaging.js\");\n";
        
        # Appending the inserted fcm sdk config
        $config = file_get_contents(WWW_ROOT."files/sdkKey.txt");

        $script .= $config."\n";
        
        $script .= "const messaging = firebase.messaging();\n\n";

        $script .= "var target_url = '';\n\n";

        $script .= "messaging.setBackgroundMessageHandler( function(payload) {
                        
                       console.log('[SERVICE WORKER] : ',payload);
                        
                        var notificationTitle = payload.data.title;
                        
                        var notificationOption = {
                                                \"body\" : payload.data.body,
                                                \"icon\" : payload.data.icon,
                                                \"click_action\" : payload.data.click_action,
                                                \"image\" : payload.data.image
                        };
                    
                        target_url = payload.data.click_action;                
                                        
                        return self.registration.showNotification(notificationTitle,notificationOption);
                            
                   });\n\n";
                   
         $script .= "self.addEventListener('notificationclick',function(event) {
                        console.log('CLICK EVENT OCCURED!');
    
                        event.notification.close();
    
                        event.waitUntil( clients.openWindow(target_url) );
                    });";

        # Putting the final string to the webroot/js/sw.js file
        file_put_contents(WWW_ROOT."js/sw.js",$script);
    }
    
}
