<h1>Dashboard</h1>
<?php 
    echo $this->Form->create('Push');
    echo $this->Form->input('serverKey',['rows' => '3','placeholder' => 'Enter YOUR FIREBASE SERVER KEY']);
    echo $this->Form->submit('SAVE');
    echo $this->Form->end();
    echo $this->Html->link('LOGOUT',['action' => 'logout']);
?>