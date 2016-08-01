<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {

    public $components = array('Flash', 'Auth' => array(
            'authorize' => array('Controller'),
        ), 'Session');

    public function isAuthorized($user) {
        if (isset($user['role_id']) && $user['role_id'] === 1) {
            return true;
        }
        return false;
    }
}
