<br>
<h1>Main Script File</h1>
<p>This file will trigger permisions for notification and also responsible for Service Worker Installion</p>
<?php
    echo $this->Form->create(false,['url' => 'generate_main_scr_file']);
    echo $this->Form->input('mainScript',['rows' => '10','placeholder' => 'Enter YOUR FCM SDK']);
    echo $this->Form->submit('GENERATE CODE');
    echo $this->Form->end();
  