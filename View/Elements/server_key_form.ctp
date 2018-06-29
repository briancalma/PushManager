<?php
    echo $this->Form->create('Push');
    echo $this->Form->input('serverKey',['rows' => '3','placeholder' => 'Enter YOUR FIREBASE SERVER KEY']);
    echo $this->Form->submit('SAVE SERVER KEY');
    echo $this->Form->end();