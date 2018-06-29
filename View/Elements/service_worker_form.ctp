<br>
<h1>Service Worker File</h1>
<p>This Service Worker Will handle everything on the background</p>
<?php
    echo $this->Form->create('Push');
    echo $this->Form->input('serviceWorker',['rows' => '10','placeholder' => 'Enter YOUR FCM SDK']);
    echo $this->Form->submit('GENERATE CODE');
    echo $this->Form->end();
  