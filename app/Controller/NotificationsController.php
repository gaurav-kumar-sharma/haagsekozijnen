<?php

App::uses('AppController', 'Controller');


class NotificationsController extends AppController {

   public $user_array = array('add');

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('notifications');
    }
     public function isAuthorized($user) {

        if (isset($user['role_id']) && $user['role_id'] == 1) { 
            return true;
        } else {
            if (in_array($this->action, $this->user_array)) {
                return true;
            } else {
                $this->Flash->error('You Can Not Access This Page');
                return false;
            }
        }
        return false;
    }
    public $components = array('Email');
    public function notifications() {   
       $this->layout = FALSE;  
       $allNotifications=$this->Notification->find('all',array('conditions'=>array('seen'=>0),'order'=>array('Notification.id'=>'DESC')));
     
       $this->set(compact('allNotifications'));
    }

   
}
