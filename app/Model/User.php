<?php

App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

    public $displayField = 'name';
    public $validate = array(
        'role_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Please Select Role',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'naam' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Please Enter Full Name',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'password' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Please Enter Password',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'email' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'Please Enter Your Valid Email',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'This Email Is already Exists !'
            )
        ),
        
        'phone' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Please Enter Contact Number',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        
        'address' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Please Enter Address',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );
    public $belongsTo = array(
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'role_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );
    public $hasMany = array(
        'Client' => array(
            'className' => 'Client',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

    public function beforeSave($option = null) {
        if (isset($this->data['User']['password'])) {
            $password = new SimplePasswordHasher();
            $this->data['User']['password'] = $password->hash($this->data['User']['password']);
        }
        return true;
    }

    public function matchPasswords2($data) {
        if ($data['password'] == $this->data['User']['password_confirmation']) {
            // unset($this->data['User']['password_confirmation']);
            return true;
        } else {
            $this->invalidate('password_confirmation', 'Password does not match');
            return false;
        }
    }

}
