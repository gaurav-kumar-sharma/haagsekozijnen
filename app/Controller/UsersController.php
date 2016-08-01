<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public $components = array('Paginator', 'Email', 'DataTable');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('register', 'login', 'logout', 'user_login', 'forget_password', 'reset', 'resetPassword');
    }

    public function isAuthorized($user) {
        if (isset($user['role_id']) && ($user['role_id'] == 1 || $user['role_id'] == 2)) {
            return true;
        }
        return false;
    }

    public function logout() {
        $this->layout = $this->autoRender = false;
        if ($this->Auth->logout()) {
            $this->redirect('/');
        }
    }

    public function forget_password() {
        $this->layout = 'admin';
        $this->loadModel('User');
        $this->User->recursive = -1;
        $response = array();
        if ($this->request->is('Post')) {

            $this->User->set($this->request->data);
            $validationArray = array();
            $validationArray = array(
                'email' => array(
                    'Email Required' => array(
                        'rule' => 'notBlank',
                        'required' => true,
                        'message' => 'Please Enter Email'
                    ),
                    'Email Invalid' => array(
                        'rule' => 'email',
                        'required' => true,
                        'message' => 'Please Enter a Valid Email'
                    )
                )
            );
            $this->User->validate = $validationArray;
            $this->User->set($this->request->data);
            if ($this->User->validates()) {
                $email = $this->request->data['User']['email'];
                $userDetails = $this->User->find('first', array('conditions' => array('User.email' => $email)));
                if ($userDetails) {
                    $key = Security::hash(uniqid(), 'sha512', true);
                    $hash = sha1($userDetails['User']['email'] . rand(0, 60));
                    $url = Router::url(array('controller' => 'users', 'action' => 'reset'), true) . '/' . $key . '#' . $hash;
                    $ms = $url;
                    $ms = wordwrap($ms, 1000);
                    $dt = new DateTime();
                    $currentDateTime = $dt->format('Y-m-d H:i:s');
                    $saveUser['User']['id'] = $userDetails['User']['id'];
                    $saveUser['User']['tokenhash'] = $key;
                    $saveUser['User']['tokentime'] = $currentDateTime;
                    if ($this->User->save($saveUser, false)) {
                        $this->Email->template = 'resetpw';
                        $this->Email->from = 'Kozijnen <noreply@' . $_SERVER['HTTP_HOST'] . '>';
                        $this->Email->to = $userDetails['User']['naam'] . '<' . $userDetails['User']['email'] . '>';
                        $this->Email->subject = 'Reset uw wachtwoord Kozijnen';
                        $this->Email->sendAs = 'both';
                        $this->Email->delivery = 'Mail';
                        $this->set('ms', $ms);
                        try {
                            if ($this->Email->send()) {
                                $this->Flash->success('Controleer uw e-mail om uw wachtwoord opnieuw');
                            }
                        } catch (Exception $e) {
                            $this->Flash->error('E-mail verzenden is mislukt Probeer het later');
                        }
                    } else {
                        $this->Flash->error("Fout genereren Reset koppeling");
                    }
                } else {
                    $this->Flash->error('Gelieve e-mail die u heeft gebruikt om te registreren met ons');
                }
            }
        }
    }

    public function reset($token = null) {
        $this->layout = "admin";
        $this->User->recursive = -1;
        $resetUser = $this->User->findBytokenhash($token);
        if ($resetUser) {
            $dt = new DateTime();
            $currentDateTime = $dt->format('Y-m-d H:i:s');
            $diff = strtotime($currentDateTime) - strtotime($resetUser['User']['tokentime']);
            $diff_in_hrs = $diff / 3600;

            if ($diff_in_hrs <= 6) {
                $this->Session->write('userId', $resetUser['User']['id']);
                $this->redirect(array('action' => 'resetPassword'));
            } else {
                 $this->Flash->error('Link Verlopen Probeer het opnieuw');
            }
        } else {
            $this->Flash->error('Link Verlopen Probeer het opnieuw');
        }
    }

    public function resetPassword() {
        $this->layout = "admin";
        $userId = $this->Session->read('userId');
        if ($this->request->is(array('post'))) {
            //debug($this->request->data);die;
            $this->request->data['User']['id'] = $userId;
            $this->request->data['User']['tokenhash'] = null;
            $this->User->set($this->request->data);
            $this->User->validate = array(
                'password' => array(
                    'No spaces allowed, Only ~`!@#$%^&.* allowed' => array('rule' => array('custom', '/^[a-zA-Z0-9~`!@#$%^&*.]*$/'), 'required' => false, 'allowEmpty' => false),
                    'matchPasswords2' => array('rule' => 'matchPasswords2', 'message' => 'Password does not match'),
                    'Minimum Length' => array('rule' => array('minLength', 6), 'message' => 'Minimum 6 characters required')
                ),
                'password_confirmation' => array(
                    'rule' => array('minLength', 6), 'message' => 'Minimum 6 characters required', 'required' => true
                )
            );
            if ($this->User->validates()) {
                //debug($this->request->data);die;
                if ($this->User->save($this->request->data, false)) {
                    $this->Session->delete('userId');
                    $this->Flash->success('Password Has been Updated', 'success');
                    $this->redirect(array('action' => 'login'));
                }
            } else {
                $this->Flash->error('Validation Error');
            }
        }
        $this->set(compact('userId'));
    }

    public function index() {
        $this->layout = 'admin';
    }

    public function view($id = null) {
        $this->layout = 'admin';
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    public function edit($id = null) {
        $this->layout = 'admin';
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['User']['datum'] = date('Y-m-d', strtotime($this->request->data['User']['datum']));
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
            $this->loadModel('Adviser');
            $advisers = $this->Adviser->find('list', array('fields' => array('id', 'adviser_name')));
            $this->set(compact('advisers'));
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->User->delete()) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function login() {
        if ($this->Auth->loggedIn()) {
            $this->Flash->success(__('Je bent al ingelogd'));
            $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
        }
        $this->layout = 'admin';
        if ($this->Auth->loggedIn()) {
            if (AuthComponent::user('role_id') == '1') {
                $this->redirect(array('action' => 'index'));
            } else if (AuthComponent::user('role_id') == '2') {
                $this->redirect(array('controller' => 'clients', 'action' => 'add'));
            }
        }
        if ($this->request->is('Post')) {
            $this->Auth->authenticate = array('Form' => array('fields' => array('username' => 'email')));
            if ($this->Auth->login()) {
                if (AuthComponent::user('role_id') == '1') {
                    $this->redirect(array('action' => 'index'));
                }
                if (AuthComponent::user('role_id') == '2') {
                    $this->redirect(array('controller' => 'clients', 'action' => 'add'));
                }
            } else {
                $this->Flash->error('Incorrect Email/Password,Please try again!', 'error');
            }
        }
    }

    public function dashboard() {
        $this->layout = 'admin';
    }

    public function register() {
        $this->layout = 'admin';
        if ($this->request->is('post')) {
            unset($this->request->data['User']['confirm_password']);
            foreach ($this->request->data['User'] as $key => $value) {
                if (!is_array($value)) {
                    $this->request->data['User'][$key] = trim(strip_tags($value));
                }
            }
            $this->User->set($this->request->data);
            if ($this->User->validates()) {
                $this->User->create();
                $this->request->data['User']['role_id'] = 2;
                $user_password = $this->request->data['User']['password'];
                if ($this->User->save($this->request->data, false)) {
                    $this->Email->template = 'new_registration';
                    $this->Email->from = 'Kozijnen<noreply@' . $_SERVER['HTTP_HOST'] . '>';
                    $this->Email->to = $this->request->data['User']['email'];
                    $this->Email->subject = 'haagsekozijnen New Registration';
                    $this->Email->sendAs = 'html';
                    $this->Email->delivery = 'Mail';
                    $this->set('userDetails', $this->request->data);
                    $this->set('user_password', $user_password);
                    if ($this->Email->send()) {
                        $this->Flash->success(__('De gebruiker is opgeslagen.'));
                        return $this->redirect(array('controller' => 'users', 'action' => 'index'));
                    }
                } else {
                    $this->Flash->error(__('De gebruiker kan niet worden opgeslagen . Alsjeblieft, probeer het opnieuw'));
                }
            } else {
                $this->Flash->error(__('The user could not be saved due to validation failure. Please, try again.'));
            }
        }
    }
 
    public function user_details() {
        $this->autoRender = $this->layout = false;
        $this->paginate = array(
            'fields' => array('User.naam', 'User.email', 'User.phone', 'User.id'),
            'conditions' => array('User.role_id !=' => 1)
        );
        $this->DataTable->mDataProp = true;
        $data1 = $this->DataTable->getResponse();
        $result = Hash::map($data1['aaData'], "{n}", function($newArr) {
                    $uniqID = uniqid();
                    $str = "<a class='btn green btn-xs green-stripe' href='/users/edit/" . $newArr['User']['id'] . "'>Edit</a>&nbsp;";
                    $str .="&nbsp;<a class='btn default btn-xs ' href='/users/view/" . $newArr['User']['id'] . "'>View</a>&nbsp;";
                    $str = $str . '<form action="/users/delete/' . $newArr['User']['id'] . '" name="post_' . $uniqID . '" id="post_' . $uniqID . '" style="display:none;" method="post"><input type="hidden" name="_method" value="POST"></form><a href="#" onclick="if (confirm(&quot;Are you sure?&quot;)) { document.post_' . $uniqID . '.submit(); } event.returnValue = false; return false;" class="btn red btn-xs red-stripe">Delete</a>';
                    $newArr['User']['id'] = $str;
                    return $newArr;
                });
        $data1['aaData'] = $result;
        echo json_encode($data1);
    }

    public function client_dashboard() {
        $this->layout = 'admin';
    }

}
