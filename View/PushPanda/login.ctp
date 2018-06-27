<h1>LOGIN</h1>
<?php 
    echo $this->Form->create('Push');
    echo $this->Form->input('username');
    echo $this->Form->input('password');
    echo $this->Form->submit('LOGIN');
    echo $this->Form->end();
?>