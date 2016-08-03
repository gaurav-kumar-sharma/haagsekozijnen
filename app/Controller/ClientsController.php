<?php

App::uses('AppController', 'Controller');

class ClientsController extends AppController {

    public $components = array('Paginator', 'Email', 'DataTable');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('register', 'login', 'logout', 'user_login', 'forget_password', 'reset', 'resetPassword');
    }

    public function isAuthorized($user) {
        if (isset($user['role_id']) && ($user['role_id'] == 1 || $user['role_id'] == 2)) {
            if($user['role_id'] == 2){
				if($this->request->params['action']=='index'){
					 return false;
				}
			}
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

    public function index() {
        $this->layout = 'admin';
    }

    public function view($id = null) {
        $this->layout = 'admin';
        if (!$this->Client->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
        $this->set('user', $this->Client->find('first', $options));
    }

    public function edit($id = null) {
        $this->layout = 'admin';
        if (!$this->Client->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['Client']['datum'] = date('Y-m-d', strtotime($this->request->data['Client']['datum']));
            if ($this->Client->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
            $this->request->data = $this->Client->find('first', $options);
            $this->loadModel('User');
            $users = $this->User->find('list', array('fields' => array('id', 'naam'), 'conditions' => array('User.role_id !=' => 1)));
            $this->set(compact('users', 'user_count'));
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
        $this->Client->id = $id;
        if (!$this->Client->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Client->delete()) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function dashboard() {
        $this->layout = 'admin';
    }

    public function add() {
        $this->layout = 'admin';
        if ($this->request->is('post')) {
            foreach ($this->request->data['Client'] as $key => $value) {
                if (!is_array($value)) {
                    $this->request->data['Client'][$key] = trim(strip_tags($value));
                }
            }
            $this->Client->set($this->request->data);
            if ($this->Client->validates()) {
                $this->Client->create();
                $this->request->data['Client']['datum'] = date('Y-m-d', strtotime($this->request->data['Client']['datum']));
                //debug($this->request->data);die;
                if ($this->Client->save($this->request->data, false)) {
                    $client_id = $this->Client->getLastInsertId();
                    $this->Session->write('current_client_id', $client_id);
                    $this->Flash->success(__('The Client has been saved.'));
                    return $this->redirect(array('controller' => 'homepage', 'action' => 'form_process'));
//                    $this->redirect(array('controller' => 'homepage', 'action' => 'kunststof_main'));
                } else {
                    $this->Flash->error(__('The client could not be saved. Please, try again.'));
                }
            } else {
                $this->Flash->error(__('The Client could not be saved due to validation failure. Please, try again.'));
            }
        }
        $user_count = sprintf("%04d", (1 + $this->Client->find('count')));
        $this->loadModel('User');
        $users = $this->User->find('list', array('fields' => array('id', 'naam'), 'conditions' => array('User.role_id !=' => 1)));
        $this->set(compact('users', 'user_count'));
    }

    public function user_details() {
        $this->autoRender = $this->layout = false;
        $this->paginate = array(
            'fields' => array('Client.naam', 'Client.email', 'Client.telephone', 'Client.ref_number', 'Client.id'),
            'conditions' => array('Client.id !=' => AuthComponent::user('id'))
        );
        $this->DataTable->mDataProp = true;
        $data1 = $this->DataTable->getResponse();
        $result = Hash::map($data1['aaData'], "{n}", function($newArr) {
                    $uniqID = uniqid();
                    $str = "<a class='btn green btn-xs green-stripe' href='/clients/edit/" . $newArr['Client']['id'] . "'>Edit</a>&nbsp;";
                    $str = $str . '<form action="/clients/delete/' . $newArr['Client']['id'] . '" name="post_' . $uniqID . '" id="post_' . $uniqID . '" style="display:none;" method="post"><input type="hidden" name="_method" value="POST"></form><a href="#" onclick="if (confirm(&quot;Are you sure?&quot;)) { document.post_' . $uniqID . '.submit(); } event.returnValue = false; return false;" class="btn red btn-xs red-stripe">Delete</a>';
                    $newArr['Client']['id'] = $str;
                    return $newArr;
                });
        $data1['aaData'] = $result;
        echo json_encode($data1);
    }

    public function client_dashboard() {
        $this->layout = 'admin';
    }

}
