<?php

App::uses('AppController', 'Controller');

class ExcelFilesController extends AppController {

    public $components = array('Flash','DataTable');
  

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
    
    public function index($id=null){
		if($id){	
			$this->loadModel('Notification');
			$this->Notification->id=$id;
			$this->Notification->saveField('seen',1);
		}
		$this->layout='admin';
	}
	public function get_files_table(){
		  $this->autoRender = $this->layout = false;
        $this->paginate = array(
            'fields' => array('User.naam', 'Client.naam', 'ExcelFile.created', 'ExcelFile.filename'),
			'joins'=>array(
							array(
								  'table'=>'users',
								  'alias'=>'User',
								  'type'=>'LEFT',
								  'conditions'=>array(
									'ExcelFile.user_id=User.id'
								  )
							),
							array(
								  'table'=>'clients',
								  'alias'=>'Client',
								  'type'=>'LEFT',
								  'conditions'=>array(
									'ExcelFile.client_id=Client.id'
								  )
							)
			
			),
			'order'=>array('ExcelFile.id'=>'DESC')
        );
        $this->DataTable->mDataProp = true;
        $data1 = $this->DataTable->getResponse();
        //debug($data1);die;
        $result = Hash::map($data1['aaData'], "{n}", function($newArr) {
					if (date('Y-m-d') == date('Y-m-d', strtotime($newArr['ExcelFile']['created']))) {
						$newArr['ExcelFile']['created']=$newArr['ExcelFile']['created'].' <span class="label label-sm label-danger">nieuwe</span>';
					}
					$newArr['ExcelFile']['filename']='<a href="/files/ExcelFiles/'.$newArr['ExcelFile']['filename'].'">downloaden</a>';
          
                    return $newArr;
                });
        $data1['aaData'] = $result;
        echo json_encode($data1);
	}
    
}
