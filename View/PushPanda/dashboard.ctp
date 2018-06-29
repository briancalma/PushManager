<h1>Dashboard</h1>
<?php echo $this->element('PushManager.server_key_form'); ?>
<?php echo $this->element('PushManager.main_script_form'); ?>
<?php # echo $this->element('PushManager.service_worker_form'); ?>
<?php echo $this->Html->link('LOGOUT',['action' => 'logout']); ?>