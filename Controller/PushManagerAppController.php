<?php

App::uses('AppController', 'Controller');

class PushManagerAppController extends AppController 
{
    public $components = ['PushManager.Push','Flash'];
    public $helpers = ['Form','Html'];
}
