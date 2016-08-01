<?php

App::uses('AppModel', 'Model');

class Client extends AppModel {


    public $displayField = 'name';

    public $validate = array(
       
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
        'titel' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Please Enter Your Title',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        
        'geslacht' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Please Enter Gaslacht',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'number' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Please Enter Three Digit Number',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'postcode' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Please Enter Postcode',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'woonplaats' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Please Enter Woonplaats',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'telephone' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Please Enter Telephone Number',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'adviseur_id' => array(
            'notBlank' => array(
                'rule' => array('numeric'),
                'message' => 'Please Select Adviseur',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'email_adviseur' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Please Enter Email Adviseur',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'ref_number' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Please Enter Ref. Number',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
            
    );
    public $belongsTo = array(
        
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

}
