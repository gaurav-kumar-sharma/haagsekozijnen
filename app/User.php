<?php

App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

/**
 * User Model
 *
 * @property Role $Role
 * @property State $State
 * @property City $City
 */
class User extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';

    /**
     * Validation rules
     *
     * @var array
     */
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
        'name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Please Enter Full Name',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'state_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Please Select Your State',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'city_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Please Select Your City',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'district_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Please Select Your Disctrict',
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
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Please Enter Your Contact Number',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'address' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Please Enter Your Address',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
            /* 'photo' => array(
              'extension' => array(
              'rule' => array('extension', array('jpeg', 'jpg', 'png', 'gif')),
              'message' => 'Invalid Extension',
              ),
              'Invalid Size' => array(
              'rule' => array('checksize'),
              'message' => 'Invalid Size'
              ),
              'Invalid Image' => array(
              'allowEmpty' => false,
              'message' => 'Please Choose Your profile Pic'
              )
              ), */
    );
    public $belongsTo = array(
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'role_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'State' => array(
            'className' => 'State',
            'foreignKey' => 'state_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'District' => array(
            'className' => 'District',
            'foreignKey' => 'district_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'City' => array(
            'className' => 'City',
            'foreignKey' => 'city_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public function changePassWord() {
        $passwordHasher = new SimplePasswordHasher();
        $currentPassword = $passwordHasher->hash($this->data['User']['current_password']);
        $existingPass = $this->field('password', array('id' => CakeSession::read("Auth.User.id")));
        if ($existingPass != $currentPassword) {
            return false;
        } else {
            return true;
        }
    }

    public function matchNewPassword() {
        if ($this->data['User']['new_password'] == $this->data['User']['confirm_new_password']) {
            return true;
        }
        $this->invalidate('confirm_password', 'Password does not match');
        return false;
    }

    public function beforeSave($option = null) {
        if (isset($this->data['User']['photo'])) {
            if (isset($this->data['User']['photo']['name'])) {
                if ($this->data['User']['photo']['name'] == '') {
                    unset($this->data['User']['photo']);
                }
            } else if ($this->data['User']['photo'] != '') {
                
            }
        }
        //debug($this->data['User']['password']);die;
        if (isset($this->data['User']['password'])) {
            $password = new SimplePasswordHasher();
            $this->data['User']['password'] = $password->hash($this->data['User']['password']);
        }
        return true;
    }

    public function checksize($options) {

        if ($options['photo']['size'] > 2048576) {
            return false;
        } else {
            return true;
        }
    }

    public function beforeValidate($options = array()) {
        if (isset($this->data['User']['photo'])) {
            if ($this->data['User']['photo']['name'] == '') {
                $this->validator()->remove('photo');
            }
        }
    }

    public function getTableData() {
        $aColumns = array('users.name', 'users.email', 'users.phone', 'users.address', 'users.id');
        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "users.id";
        /* DB table to use */
        $sTable = " users ";
        $sJoinTable = ' LEFT JOIN roles ON roles.id=users.role_id ';
        $sConditions = ' users.role_id!=' . AuthComponent::user('role_id').'';
        $outs = $this->getAllUsersData(array('columns' => $aColumns, 'index_column' => $sIndexColumn, 'table' => $sTable, 'join' => $sJoinTable, 'conditions' => $sConditions));
        return $outs;
    }

    public function getAllUsersData($config = array()) {
        if (!isset($config['columns']) || !isset($config['index_column']) || !isset($config['table'])) {
            return array();
        }
        $aColumns = $config['columns'];
        $sIndexColumn = $config['index_column'];
        $sTable = $config['table'];
        $sJoinTable = isset($config['join']) ? $config['join'] : '';

        $sCondition = isset($config['conditions']) ? $config['conditions'] : '';
        App::uses('ConnectionManager', 'Model');
        $dataSource = ConnectionManager::getDataSource('default');

        /* Database connection information */
        $gaSql['user'] = $dataSource->config['login'];
        $gaSql['password'] = $dataSource->config['password'];
        $gaSql['db'] = $dataSource->config['database'];
        $gaSql['server'] = $dataSource->config['host'];


        /*         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP server-side, there is
         * no need to edit below this line
         */

        /*
         * Local functions
         */

        function fatal_error($sErrorMessage = '') {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
            die($sErrorMessage);
        }

        /*
         * MySQL connection
         */
        if (!$gaSql['link'] = mysql_pconnect($gaSql['server'], $gaSql['user'], $gaSql['password'])) {
            fatal_error('Could not open connection to server');
        }

        if (!mysql_select_db($gaSql['db'], $gaSql['link'])) {
            fatal_error('Could not select database ');
        }


        /*
         * Paging
         */
        $sLimit = "";
        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " .
                    intval($_GET['iDisplayLength']);
        }


        /*
         * Ordering
         */
        $sOrder = "";
        if (isset($_GET['iSortCol_0'])) {
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
                if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
                    $sOrder .= $aColumns[intval($_GET['iSortCol_' . $i])] . " " .
                            ($_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }

        /*
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        $sWhere = "";
        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $sWhere = "WHERE (";
            for ($i = 0; $i < count($aColumns); $i++) {
                $sWhere .= $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }

        /* Individual column filtering */
        for ($i = 0; $i < count($aColumns); $i++) {
            if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
                if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $sWhere .= $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch_' . $i]) . "%' ";
            }
        }
        /*
         * Custom conditions 
         */
        if ($sCondition != '') {
            if ($sWhere == "") {
                $sWhere = "WHERE " . $sCondition . " ";
            } else {
                $sWhere .=" AND " . $sCondition . " ";
            }
        }

        /*
         * SQL queries
         * Get data to display
         */
        $sQuery = "
    SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
            FROM   $sTable $sJoinTable 
            $sWhere
            $sOrder
            $sLimit
            ";

        $rResult = mysql_query($sQuery) or fatal_error('MySQL Error: ' . mysql_errno());

        /* Data set length after filtering */
        $sQuery = "
    SELECT FOUND_ROWS()
";
        $rResultFilterTotal = mysql_query($sQuery) or fatal_error('MySQL Error: ' . mysql_errno());
        $aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
        $iFilteredTotal = $aResultFilterTotal[0];

        /* Total data set length */
        $sQuery = "
    SELECT COUNT(" . $sIndexColumn . ")
            FROM   $sTable $sJoinTable
            ";
        $rResultTotal = mysql_query($sQuery) or fatal_error('MySQL Error: ' . mysql_errno());
        $aResultTotal = mysql_fetch_array($rResultTotal);
        $iTotal = $aResultTotal[0];

        /*
         * Output
         */
        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );

        while ($aRow = mysql_fetch_array($rResult)) {
            //debug($aRow);die; 
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {

                if (count(explode('.', $aColumns[$i])) == 2) {
                    $aColumns[$i] = explode('.', $aColumns[$i]);
                    $aColumns[$i] = $aColumns[$i][1];
                }
                if ($aColumns[$i] == "version") {
                    /* Special output formatting for 'version' column */
                    $row[] = ($aRow[$aColumns[$i]] == "0") ? '-' : $aRow[$aColumns[$i]];
                } else if ($aColumns[$i] != ' ') {
                    if ($aColumns[$i] == "id") {
                        $str = "<a class='btn green btn-xs green-stripe' href='/users/edit/" . $aRow[$aColumns[$i]] . "'>Edit</a>&nbsp;
                                      &nbsp;<a class='btn default btn-xs green-stripe' href='/users/view/" . $aRow[$aColumns[$i]] . "'>View</a>&nbsp;
                                      <form action='/users/delete/" . $aRow[$aColumns[$i]] . "' style='display:none;' method='post' name='post_" . $aRow[$aColumns[$i]] . "' id='post_" . $aRow[$aColumns[$i]] . "'  ><input name='_method' value='POST' type='hidden'></form>
                         <a href='#' class='btn red btn-xs red-stripe' onclick='if (confirm(&quot;Are you sure you want to delete this record ?&quot;)) { document.post_" . $aRow[$aColumns[$i]] . ".submit(); }  event.returnValue = false; return false;'>Delete</a> ";


                        $row[] = $str;
                    } else {
                        $row[] = $aRow[$aColumns[$i]];
                    }
                }
            }
            $output['aaData'][] = $row;
        }

        return $output;
    }

}
