# PushPanda Notification Plugin
PushPanda is a  CakePHP 2.x Plugin that is intended to give an easy way of sending push messages to your FCM Server(Firebase Cloud Messaging). 
It sends push notification configured messages to your FCM server using CURL and allow clean flow with a minimal need of installation, with just few minutes you can see your Push Notification up running. 

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites
1. Be sure that you have an FCM (Firebase Cloud Messaging App), If you dont have go to : https://console.firebase.google.com/
2. Install CURL https://curl.haxx.se/
3. Clone or download this project :).
4. CakePHP 2.x App 

### Installing
1. Extract the zip version of this project. 
2. Put it on your app/Plugin folder.

===========================================

### Enabling the plugin
1. Go to your app/Config/bootstrap.php and paste this line: 
    
    CakePlugin::load('PushManager', array('bootstrap' => false, 'routes' => false));

2. Next go to your AppController.php and add this as component. Your code will look something like this.
    
    public $components = ['PushManager.Push'];

3. Go to this url : https://Your Host/push_manager/push_panda/login

4. A login form will show asking for your username and password:
   username : admin
   password : admin

5. After logging in you are redirect to the dashboard and another form will show asking for your FCM server key. 

6. Fill up the field and submit take note that the server key must is a string created by FCM. Go to your FCM console for more details. 

7. After fillingup the field a message will show that "You successfully installed PushPanda Notification Plugin"
   - if for some reasons an error occured during this phase please make sure that your apache server and your app/webroot/files folder are writable. 

8. You can then logout. Congrats you successfully installed the plugin!


Now you can use PushPanda Notification plugin in any controller in your application.

==========================================
Example: 
      public function sendNotif()
      {
           $data = [
            			"title" => 'Your Awesome Title Here',
            		    "body" => 'Some cool body you want to share to the world!',
            		    "icon" => 'the location of your icon',
            		    "image" => 'the location of your image',
            		    "click_action" => 'when the client click your notification this will redirect to what url?'
   	                 ];
            
            $this->Push->send($token_list,$data);
      }


Push::send(array[],array[]) sends a message to your FCM 

$token_list - holds the tokens of your desired recievers. 

$data - contains your message information like title,body,icon,image and landing url. Take note that you must not change the keys to avoid any errors.

## Built With

* [CakePHP] (https://cakephp.org/) - PHP framework used.
* [Firebase Cloud Messaging](https://firebase.google.com/docs/cloud-messaging/) - The one that sends push notifications to the clients

## Authors

* **Brian Calma** - *Initial work* - [PushPanda](https://github.com/PushPanda)

## Acknowledgments
* Thanks a lot to sir Ado for giving me insights and lectures upon doing this project. 