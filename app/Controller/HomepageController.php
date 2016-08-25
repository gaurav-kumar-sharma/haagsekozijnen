<?php

App::uses('AppController', 'Controller');

class HomepageController extends AppController {

    public $components = array('Flash', 'PhpExcel.PhpExcel');
    public $helpers = array('Picker.PickerForm');

    public function isAuthorized($user) {

        if (isset($user['role_id']) && ($user['role_id'] == 1 || $user['role_id'] == 2)) {
            return true;
        }
        return false;
    }

    public function home() {
        $this->layout = 'admin';
    }

    public function form1() {
        $this->layout = 'admin';
    }

    public function form2() {
        $this->layout = 'admin';
    }

    public function form3() {
        $this->layout = 'admin';
    }

    public function form4() {
        $this->layout = 'admin';
    }

    public function form5() {
        $this->layout = 'admin';
    }

    public function form6() {
        $this->layout = 'admin';
    }

    public function form_process() {
        $this->layout = 'admin';
        $this->loadModel('Composition');
        if ($this->request->is(array('put', 'post'))) {
            if (isset($this->request->data['Composition'])) {
                if ($this->request->data['Composition']['composition_id'] == 1) {
                    if (($this->request->data['Composition']['sub_cat_id'] == 1 || $this->request->data['Composition']['sub_cat_id'] == 2) && ($this->request->data['Composition']['sub_sub_cat_id'] == 1 || $this->request->data['Composition']['sub_sub_cat_id'] == 2 || $this->request->data['Composition']['sub_sub_cat_id'] == 3 || $this->request->data['Composition']['sub_sub_cat_id'] == 4 || $this->request->data['Composition']['sub_sub_cat_id'] == 5 || $this->request->data['Composition']['sub_sub_cat_id'] == 6)) {
//                        $this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                    } else {
                        $this->Flash->error('Please Select Options Properly');
                        $this->redirect($this->referer());
                    }
                } else if ($this->request->data['Composition']['composition_id'] == 2) {
                    if ($this->request->data['Composition']['sub_cat_id'] == 3 || $this->request->data['Composition']['sub_cat_id'] == 4) {
                        //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                    } else {
                        $this->Flash->error('Please Select Options Properly');
                        $this->redirect($this->referer());
                    }
                } else if ($this->request->data['Composition']['composition_id'] == 3) {
                    if ($this->request->data['Composition']['sub_cat_id'] == 5 || $this->request->data['Composition']['sub_cat_id'] == 6 || $this->request->data['Composition']['sub_cat_id'] == 7) {
                        //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                    } else {
                        $this->Flash->error('Please Select Options Properly');
                        $this->redirect($this->referer());
                    }
                } else {
                    $this->Flash->error('Please Select Options Properly');
                    $this->redirect($this->referer());
                }
            } else {
                $this->Flash->error('Please Select Options Properly');
                $this->redirect($this->referer());
            }
            if ($this->request->data['Composition']['sub_sub_cat_id'] != '') {
                $this->redirect(array('controller' => 'homepage', 'action' => 'set_colors', $this->request->data['Composition']['composition_id'], $this->request->data['Composition']['sub_cat_id'], $this->request->data['Composition']['sub_sub_cat_id']));
            } else {
                $this->redirect(array('controller' => 'homepage', 'action' => 'set_colors', $this->request->data['Composition']['composition_id'], $this->request->data['Composition']['sub_cat_id']));
            }
        }
        $compositions = $this->Composition->find('list', array('fields' => array('id', 'composition_name')));
        $this->set(compact('compositions'));
    }

    public function set_colors($composition_id = null, $sub_cat_id = null, $sub_sub_cat_id = null) {
        $this->layout = 'admin';
        $this->loadModel('ColorType');
        $this->loadModel('CompositionColor');
        $this->loadModel('Composition');
        $this->loadModel('HoutType');
        $this->loadModel('SubCategory');
        $this->loadModel('SubSubCategory');
        $sub_cat_name = $this->SubCategory->find('first', array('conditions' => array('SubCategory.id' => $sub_cat_id)));
        if ($sub_sub_cat_id != '') {
            $sub_sub_cat_name = $this->SubSubCategory->find('first', array('conditions' => array('SubSubCategory.id' => $sub_cat_id)));
        }
        if ($this->request->is(array('post', 'put'))) {
                $this->loadModel('Composition');
        $this->loadModel('SubCategory');
        $this->loadModel('SubSubCategory');
        $this->loadModel('CompositionColor'); 
        $this->loadModel('HoutType');
        $this->loadModel('ColorType');
        $this->loadModel('Client');    
            if ($composition_id == 1) {
        
        $extraInfo = array();
        $extraInfo['composition'] = $this->Composition->find('first', array('conditions' => array("Composition.id" => $composition_id)));
        $extraInfo['sub_cat'] = $this->SubCategory->find('first', array('conditions' => array("SubCategory.id" => $sub_cat_id)));
        $extraInfo['sub_sub_cat'] = $this->SubSubCategory->find('first', array('conditions' => array("SubSubCategory.id" => $sub_sub_cat_id)));
        $extraInfo['buitenkader_color_type'] = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->data['Composition']['buitenkader_color_type_id'])));
        $extraInfo['buitenkader_composition_color'] = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->data['Composition']['buitenkader_composition_color_id'])));
        $extraInfo['draaidelen_buitenkader_color_type'] = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->data['Composition']['draaidelen_buitenkader_color_type_id'])));
        $extraInfo['binnenzijde_buitenkader_color_type'] = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->data['Composition']['binnenzijde_buitenkader_color_type_id'])));
        $extraInfo['draaidelen_buitenkader_composition_color'] = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->data['Composition']['draaidelen_buitenkader_composition_color_id'])));
        $extraInfo['binnenzijde_buitenkader_composition_color'] = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->data['Composition']['binnenzijde_buitenkader_composition_color_id'])));
        $extraInfo['draaidelen_binnenkader_color_type'] = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->data['Composition']['draaidelen_binnenkader_color_type_id'])));
       // $binnenzijde_binnenkader_color_type = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->query['binnenzijde_binnenkader_color_type_id'])));
        $extraInfo['draaidelen_binnenkader_composition_color'] = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->data['Composition']['draaidelen_binnenkader_composition_color_id'])));
        $this->Session->write('extraInfo', $extraInfo);
        $this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
//                $this->redirect(
//                        array(
//                            'action' => 'final_view', $composition_id, $sub_cat_id, $sub_sub_cat_id,
//                            '?' => array(
//                                'composition_id' =>  $composition_id,
//                                'sub_cat_id' => $sub_cat_id,
//                                'sub_sub_cat_id' => $sub_sub_cat_id,
//                                'buitenkader_color_type_id' => $this->request->data['Composition']['buitenkader_color_type_id'],
//                                'buitenkader_composition_color_id' => $this->request->data['Composition']['buitenkader_composition_color_id'],
//                                'draaidelen_buitenkader_color_type_id' => $this->request->data['Composition']['draaidelen_buitenkader_color_type_id'],
//                                'draaidelen_buitenkader_composition_color_id' => $this->request->data['Composition']['draaidelen_buitenkader_composition_color_id'],
//                                'binnenzijde_buitenkader_color_type_id' => $this->request->data['Composition']['binnenzijde_buitenkader_color_type_id'],
//                                'binnenzijde_buitenkader_composition_color_id' => $this->request->data['Composition']['binnenzijde_buitenkader_composition_color_id'],
//                                'draaidelen_binnenkader_color_type_id' => $this->request->data['Composition']['draaidelen_binnenkader_color_type_id'],
//                                'draaidelen_binnenkader_composition_color_id' => $this->request->data['Composition']['draaidelen_binnenkader_composition_color_id'],
//                                'binnenzijde_binnenkader_color_type_id' => $this->request->data['Composition']['draaidelen_binnenkader_color_type_id'],
//                                'binnenzijde_binnenkader_composition_color_id' => $this->request->data['Composition']['binnenzijde_binnenkader_composition_color_id'],
//                            )
//                        )
//                );
            } else if ($composition_id == 2) {
                         $extraInfo = array();
        $extraInfo['composition'] = $this->Composition->find('first', array('conditions' => array("Composition.id" => $composition_id)));
//        $extraInfo['sub_cat'] = $this->SubCategory->find('first', array('conditions' => array("SubCategory.id" => $sub_cat_id)));
        $extraInfo['sub_sub_cat'] = $this->SubSubCategory->find('first', array('conditions' => array("SubSubCategory.id" => ($sub_sub_cat_id+1))));
//        $extraInfo['buitenkader_color_type'] = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->data['Composition']['buitenkader_color_type_id'])));
        $extraInfo['buitenkader_composition_color'] = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->data['Composition']['buitenkader_composition_color_id'])));
//        $extraInfo['draaidelen_buitenkader_color_type'] = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->data['Composition']['draaidelen_buitenkader_color_type_id'])));
//        $extraInfo['binnenzijde_buitenkader_color_type'] = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->data['Composition']['binnenzijde_buitenkader_color_type_id'])));
        $extraInfo['draaidelen_buitenkader_composition_color'] = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->data['Composition']['draaidelen_buitenkader_composition_color_id'])));
        $extraInfo['binnenzijde_buitenkader_composition_color'] = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->data['Composition']['binnenzijde_buitenkader_composition_color_id'])));
//        $extraInfo['draaidelen_binnenkader_color_type'] = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->data['Composition']['draaidelen_binnenkader_color_type_id'])));
       // $binnenzijde_binnenkader_color_type = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->query['binnenzijde_binnenkader_color_type_id'])));
        $extraInfo['draaidelen_binnenkader_composition_color'] = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->data['Composition']['draaidelen_binnenkader_composition_color_id'])));
        //EXTRA
        $extraInfo['draaidelen_buitenkader_color_type'] = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => 1)));
        $this->Session->write('extraInfo', $extraInfo);
        $this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                print $composition_id;die;
                $this->redirect(
                        array(
                            'action' => 'final_view', $composition_id, $sub_cat_id, $sub_sub_cat_id,
                            '?' => array(
                                'buitenkader_composition_color_id' => $this->request->data['Composition']['buitenkader_composition_color_id'],
                                'draaidelen_buitenkader_composition_color_id' => $this->request->data['Composition']['draaidelen_buitenkader_composition_color_id'],
                                'binnenzijde_buitenkader_composition_color_id' => $this->request->data['Composition']['binnenzijde_buitenkader_composition_color_id'],
                                'draaidelen_binnenkader_composition_color_id' => $this->request->data['Composition']['draaidelen_binnenkader_composition_color_id'],
                               // 'binnenzijde_binnenkader_composition_color_id' => $this->request->data['Composition']['binnenzijde_binnenkader_composition_color_id'],
                            )
                        )
                );
            } else {
//                print_r($this->request->data);die;
//                print_r($sub_cat_id);die;
                $extraInfo = array();
        $extraInfo['composition'] = $this->Composition->find('first', array('conditions' => array("Composition.id" => $composition_id)));
        $extraInfo['sub_sub_cat'] = $this->SubCategory->find('first', array('conditions' => array("SubCategory.id" => $sub_cat_id)));
//        $extraInfo['sub_sub_cat'] = $this->SubSubCategory->find('first', array('conditions' => array("SubSubCategory.id" => $sub_sub_cat_id)));
//        $extraInfo['buitenkader_color_type'] = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->data['Composition']['buitenkader_color_type_id'])));
        $extraInfo['buitenkader_composition_color'] = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->data['Composition']['buitenkader_composition_color_id'])));
//        $extraInfo['draaidelen_buitenkader_color_type'] = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->data['Composition']['draaidelen_buitenkader_color_type_id'])));
//        $extraInfo['binnenzijde_buitenkader_color_type'] = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->data['Composition']['binnenzijde_buitenkader_color_type_id'])));
        $extraInfo['draaidelen_buitenkader_composition_color'] = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->data['Composition']['draaidelen_buitenkader_composition_color_id'])));
        $extraInfo['binnenzijde_buitenkader_composition_color'] = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->data['Composition']['binnenzijde_buitenkader_composition_color_id'])));
//        $extraInfo['draaidelen_binnenkader_color_type'] = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->data['Composition']['draaidelen_binnenkader_color_type_id'])));
       // $binnenzijde_binnenkader_color_type = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->query['binnenzijde_binnenkader_color_type_id'])));
        $extraInfo['draaidelen_binnenkader_composition_color'] = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->data['Composition']['draaidelen_binnenkader_composition_color_id'])));
        //EXTRA
        $extraInfo['draaidelen_buitenkader_color_type'] = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => 1)));
        
        $extraInfo['buitenkader_hout_type'] = $this->HoutType->find('first', array('conditions' => array('HoutType.id' => $this->request->data['Composition']['buitenkader_hout_type_id'])));
        $extraInfo['draaidelen_buitenkader_hout_type'] = $this->HoutType->find('first', array('conditions' => array('HoutType.id' => $this->request->data['Composition']['draaidelen_buitenkader_hout_type_id'])));
        $extraInfo['binnenzijde_buitenkader_hout_type'] = $this->HoutType->find('first', array('conditions' => array('HoutType.id' => $this->request->data['Composition']['draaidelen_buitenkader_hout_type_id'])));
        $extraInfo['draaidelen_binnenkader_hout_type'] = $this->HoutType->find('first', array('conditions' => array('HoutType.id' => $this->request->data['Composition']['draaidelen_buitenkader_hout_type_id'])));
        $extraInfo['buitenkader_hout_type'] = $this->HoutType->find('first', array('conditions' => array('HoutType.id' => $this->request->data['Composition']['draaidelen_buitenkader_hout_type_id'])));
//                print_r($extraInfo);die;
        $this->Session->write('extraInfo', $extraInfo);
        $this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                $this->redirect(
                        array(
                            'action' => 'final_view', $composition_id, $sub_cat_id, $sub_sub_cat_id,
                            '?' => array(
                                'buitenkader_hout_type_id' => $this->request->data['Composition']['buitenkader_hout_type_id'],
                                'buitenkader_composition_color_id' => $this->request->data['Composition']['buitenkader_composition_color_id'],
                                'draaidelen_buitenkader_hout_type_id' => $this->request->data['Composition']['draaidelen_buitenkader_hout_type_id'],
                                'draaidelen_buitenkader_composition_color_id' => $this->request->data['Composition']['draaidelen_buitenkader_composition_color_id'],
                                'binnenzijde_buitenkader_hout_type_id' => $this->request->data['Composition']['binnenzijde_buitenkader_hout_type_id'],
                                'binnenzijde_buitenkader_composition_color_id' => $this->request->data['Composition']['binnenzijde_buitenkader_composition_color_id'],
                                'draaidelen_binnenkader_hout_type_id' => $this->request->data['Composition']['draaidelen_binnenkader_hout_type_id'],
                                'draaidelen_binnenkader_composition_color_id' => $this->request->data['Composition']['draaidelen_binnenkader_composition_color_id'],
                                //'binnenzijde_binnenkader_hout_type_id' => $this->request->data['Composition']['binnenzijde_binnenkader_hout_type_id'],
                               // 'binnenzijde_binnenkader_composition_color_id' => $this->request->data['Composition']['binnenzijde_binnenkader_composition_color_id'],
                            )
                        )
                );
            }
        }
        if ($composition_id == 1 || $composition_id == 2) {
            $color_types = $this->ColorType->find('list', array('fields' => array('id', 'color_type')));
            $composition_colors = $this->CompositionColor->find('list', array('fields' => array('id', 'composition_color'),'conditions'=>array('id !='=>11)));
            $this->set(compact('color_types', 'composition_colors'));
        } else {
            $hout_types = $this->HoutType->find('list', array('fields' => array('id', 'hout_type')));
            $composition_colors = $this->CompositionColor->find('list', array('fields' => array('id', 'composition_color')));
            $this->set(compact('hout_types', 'composition_colors'));
        }
        $compositions = $this->Composition->find('list', array('fields' => array('id', 'composition_name')));
        $this->set(compact('composition_id', 'compositions', 'sub_sub_cat_name', 'sub_cat_name'));
    }
    
    public function generateExcelKunststof() {
        $total = 0;
        if (isset($this->request->query['total'])) {
            $total = $this->request->query['total'];
        }
        
        $extraInfo  = $this->Session->read('extraInfo');
        $excel2=$this->PhpExcel->loadWorksheet(WWW_ROOT.'/files/worksheet-nieuw.xlsx');
        $this->loadModel('Client');
        $client_data = $this->Client->find('first', array('conditions' => array('Client.id' => $this->Session->read('current_client_id'))));
        if (empty($client_data)) {
            $this->redirect(array('controller' => 'clients', 'action' => 'add'));
        }
        $composition = $extraInfo['composition'];
        $sub_category = $extraInfo['sub_cat'];
        $sub_sub_category = $extraInfo['sub_sub_cat'];
       
        $excel2->getActiveSheet()->setCellValue('B13', $client_data['Client']['titel'])
                                ->setCellValue('D13', $client_data['Client']['geslacht'])
                                ->setCellValue('B15', $client_data['Client']['naam'])
                                ->setCellValue('D15', $client_data['User']['naam'] . " " . $client_data['User']['phone'])
                                ->setCellValue('B17', $client_data['Client']['postcode'])
                                ->setCellValue('D17', $client_data['User']['email'])
                                ->setCellValue('B19', $client_data['Client']['straat'] . " " . $client_data['Client']['number'])
                                ->setCellValue('D19', $composition['Composition']['composition_name'])
                                ->setCellValue('B21', $client_data['Client']['straat'])
                                ->setCellValue('D21', $sub_category['SubCategory']['sub_cat_name'])
                                ->setCellValue('B23', $client_data['Client']['telephone'])
                                ->setCellValue('D23', $sub_sub_category['SubSubCategory']['sub_sub_cat_name'])
                                ->setCellValue('B25', $client_data['Client']['email'])
                                ->setCellValue('D25', date('m-d-Y', strtotime($client_data['Client']['datum'])))
                                ->setCellValue('B27', $client_data['Client']['ref_number']);
        
        if ($composition =='Kunststof') {
        
            $buitenkader_color_type = $extraInfo['buitenkader_color_type'];
            $buitenkader_composition_color = $extraInfo['buitenkader_composition_color'];
            $draaidelen_buitenkader_color_type = $extraInfo['draaidelen_buitenkader_color_type'];
            $binnenzijde_buitenkader_color_type = $extraInfo['binnenzijde_buitenkader_color_type'];
            $draaidelen_buitenkader_composition_color = $extraInfo['draaidelen_buitenkader_composition_color'];
            $binnenzijde_buitenkader_composition_color = $extraInfo['binnenzijde_buitenkader_composition_color'];
            $draaidelen_binnenkader_color_type = $extraInfo['draaidelen_binnenkader_color_type'];
            $draaidelen_binnenkader_composition_color = $extraInfo['draaidelen_binnenkader_composition_color'];
            $excel2->getActiveSheet()->setCellValue('B29',  $buitenkader_color_type)
                                    ->setCellValue('D29', $buitenkader_composition_color);

            $excel2->getActiveSheet()->setCellValue('B30',  $draaidelen_buitenkader_color_type)
                                    ->setCellValue('D30', $draaidelen_buitenkader_composition_color);

            $excel2->getActiveSheet()->setCellValue('B31',  $draaidelen_binnenkader_color_type)
                                    ->setCellValue('D31',  $draaidelen_binnenkader_composition_color);

            $excel2->getActiveSheet()->setCellValue('B32', $binnenzijde_buitenkader_color_type)
                                ->setCellValue('D32', $binnenzijde_buitenkader_composition_color);
        } else if($composition =='Aluminium') {
            $buitenkader_composition_color = $extraInfo['buitenkader_composition_color'];
            $draaidelen_buitenkader_composition_color = $extraInfo['draaidelen_buitenkader_composition_color'];
            $binnenzijde_buitenkader_composition_color = $extraInfo['binnenzijde_buitenkader_composition_color'];
            $draaidelen_binnenkader_composition_color = $extraInfo['draaidelen_binnenkader_composition_color'];
            
            $excel2->getActiveSheet()->setCellValue('D29', $buitenkader_composition_color);
            $excel2->getActiveSheet()->setCellValue('D30', $draaidelen_buitenkader_composition_color);
            $excel2->getActiveSheet()->setCellValue('D31',  $draaidelen_binnenkader_composition_color);
            $excel2->getActiveSheet()->setCellValue('D32', $binnenzijde_buitenkader_composition_color);
        } elseif ($composition =='Hout') {
            $buitenkader_hout_type = $extraInfo['buitenkader_hout_type'];
            $buitenkader_composition_color = $extraInfo['buitenkader_composition_color'];
            $draaidelen_buitenkader_hout_type = $extraInfo['draaidelen_buitenkader_hout_type'];
            $binnenzijde_buitenkader_hout_type = $extraInfo['binnenzijde_buitenkader_hout_type'];
            $draaidelen_buitenkader_composition_color = $extraInfo['draaidelen_buitenkader_composition_color'];
            $binnenzijde_buitenkader_composition_color = $extraInfo['binnenzijde_buitenkader_composition_color  '];
            $draaidelen_binnenkader_hout_type = $extraInfo['draaidelen_binnenkader_hout_type'];
            $draaidelen_binnenkader_composition_color = $extraInfo['draaidelen_binnenkader_composition_color'];
            $excel2->getActiveSheet()->setCellValue('B29',  $buitenkader_hout_type)
						->setCellValue('D29', $buitenkader_composition_color);
            $excel2->getActiveSheet()->setCellValue('B30',  $draaidelen_buitenkader_hout_type)
				->setCellValue('D30', $draaidelen_buitenkader_composition_color);
            
            $excel2->getActiveSheet()->setCellValue('B31',   $draaidelen_binnenkader_hout_type)
                                ->setCellValue('D31',  $draaidelen_binnenkader_composition_color);

            $excel2->getActiveSheet()->setCellValue('B32', $binnenzijde_buitenkader_hout_type)
                                   ->setCellValue('D32', $binnenzijde_buitenkader_composition_color);
        }
        $file_name =  time() . ".xlsx";
	$this->loadModel('ExcelFile');
        $this->loadModel('Notification');
        $arr['ExcelFile']=array(
                'client_id'=>$client_data['Client']['id'],
                'user_id'=>AuthComponent::user('id'),
                'filename'=>$file_name
        );
        if($this->ExcelFile->save($arr)){
            $notification['Notification']=array(
                'message'=>'Een nieuw Excel-bestand is gegenereerd voor de klant: '.$client_data['Client']['naam']
            );
            $this->Notification->save($notification);
        }
        if($this->PhpExcel->output_to_file($file_name)){
            $this->Flash->success('Een nieuw Excel-bestand is gegenereerd voor de klant: '.$client_data['Client']['naam']);
            $this->redirect('/clients/add');
        }
        
    }

    public function final_view($composition_id = null, $sub_cat_id = null, $sub_sub_cat_id = null) {
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '-1');
		$this->loadModel('Composition');
        $this->loadModel('SubCategory');
        $this->loadModel('SubSubCategory');
        $this->loadModel('CompositionColor'); 
        $this->loadModel('HoutType');
        $this->loadModel('ColorType');
        $this->loadModel('Client');
//        $this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
        $excel2=$this->PhpExcel->loadWorksheet(WWW_ROOT.'/files/worksheet-nieuw.xlsx');
		$client_data = $this->Client->find('first', array('conditions' => array('Client.id' => $this->Session->read('current_client_id'))));
        if (empty($client_data)) {
            $this->redirect(array('controller' => 'clients', 'action' => 'add'));
        }
        $composition = $this->Composition->find('first', array('conditions' => array('Composition.id' => $composition_id)));
        $sub_category = $this->SubCategory->find('first', array('conditions' => array('SubCategory.id' => $sub_cat_id)));
        if ($sub_sub_cat_id != null) {
            $sub_sub_category = $this->SubSubCategory->find('first', array('conditions' => array('SubSubCategory.id' => $sub_sub_cat_id)));
        }
			$excel2->getActiveSheet()->setCellValue('B13', $client_data['Client']['titel'])
								->setCellValue('D13', $client_data['Client']['geslacht'])
								->setCellValue('B15', $client_data['Client']['naam'])
								->setCellValue('D15', $client_data['User']['naam'] . " " . $client_data['User']['phone'])
								->setCellValue('B17', $client_data['Client']['postcode'])
								->setCellValue('D17', $client_data['User']['email'])
								->setCellValue('B19', $client_data['Client']['straat'] . " " . $client_data['Client']['number'])
								->setCellValue('D19', $composition['Composition']['composition_name'])
								->setCellValue('B21', $client_data['Client']['straat'])
								->setCellValue('D21', $sub_category['SubCategory']['sub_cat_name'])
								->setCellValue('B23', $client_data['Client']['telephone'])
								->setCellValue('D23', $sub_sub_cat_id?$sub_sub_category['SubSubCategory']['sub_sub_cat_name']:'None')
								->setCellValue('B25', $client_data['Client']['email'])
								->setCellValue('D25', date('m-d-Y', strtotime($client_data['Client']['datum'])))
								->setCellValue('B27', $client_data['Client']['ref_number'])
								;
		 if ($composition_id == 1) {
            $buitenkader_color_type = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->query['buitenkader_color_type_id'])));
            $buitenkader_composition_color = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->query['buitenkader_composition_color_id'])));
            $draaidelen_buitenkader_color_type = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->query['draaidelen_buitenkader_color_type_id'])));
            $binnenzijde_buitenkader_color_type = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->query['binnenzijde_buitenkader_color_type_id'])));
            $draaidelen_buitenkader_composition_color = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->query['draaidelen_buitenkader_composition_color_id'])));
            $binnenzijde_buitenkader_composition_color = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->query['binnenzijde_buitenkader_composition_color_id'])));
            $draaidelen_binnenkader_color_type = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->query['draaidelen_binnenkader_color_type_id'])));
           // $binnenzijde_binnenkader_color_type = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->query['binnenzijde_binnenkader_color_type_id'])));
            $draaidelen_binnenkader_composition_color = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->query['draaidelen_binnenkader_composition_color_id'])));
            // $binnenzijde_binnenkader_composition_color = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->query['binnenzijde_binnenkader_composition_color_id'])));
			$excel2->getActiveSheet()->setCellValue('B29',  $buitenkader_color_type['ColorType']['color_type'])
									  ->setCellValue('D29', $buitenkader_composition_color['CompositionColor']['composition_color']);
            $excel2->getActiveSheet()->setCellValue('B30',  $draaidelen_buitenkader_color_type['ColorType']['color_type'])
									  ->setCellValue('D30', $draaidelen_buitenkader_composition_color['CompositionColor']['composition_color']);
            
            $excel2->getActiveSheet()->setCellValue('B31',  $draaidelen_binnenkader_color_type['ColorType']['color_type'])
									  ->setCellValue('D31',  $draaidelen_binnenkader_composition_color['CompositionColor']['composition_color']);

			 $excel2->getActiveSheet()->setCellValue('B32', $binnenzijde_buitenkader_color_type['ColorType']['color_type'])
									  ->setCellValue('D32', $binnenzijde_buitenkader_composition_color['CompositionColor']['composition_color']);
           
           /* $this->PhpExcel->addTableRow(array(
                'Binnenzide buitenkader type',
                $binnenzijde_binnenkader_color_type['ColorType']['color_type'],
                'kleur',
                $binnenzijde_binnenkader_composition_color['CompositionColor']['composition_color'],
                    )
            );*/
        } else if ($composition_id == 2) {
            
            $buitenkader_composition_color = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->query['buitenkader_composition_color_id'])));
            $draaidelen_buitenkader_composition_color = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->query['draaidelen_buitenkader_composition_color_id'])));
            $binnenzijde_buitenkader_composition_color = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->query['binnenzijde_buitenkader_composition_color_id'])));
            $draaidelen_binnenkader_composition_color = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->query['draaidelen_binnenkader_composition_color_id'])));
            //$binnenzijde_binnenkader_composition_color = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->query['binnenzijde_binnenkader_composition_color_id'])));
            
            $excel2->getActiveSheet()->setCellValue('D29', $buitenkader_composition_color['CompositionColor']['composition_color']);
            $excel2->getActiveSheet()->setCellValue('D30', $draaidelen_buitenkader_composition_color['CompositionColor']['composition_color']);
            
            $excel2->getActiveSheet()->setCellValue('D31',  $draaidelen_binnenkader_composition_color['CompositionColor']['composition_color']);

			 $excel2->getActiveSheet()->setCellValue('D32', $binnenzijde_buitenkader_composition_color['CompositionColor']['composition_color']);
            
           
           /* $this->PhpExcel->addTableRow(array(
                'binnenzijde buitenkader kleur',
                $binnenzijde_buitenkader_composition_color['CompositionColor']['composition_color'],
                    )
            );*/
        } else {
            $buitenkader_hout_type = $this->HoutType->find('first', array('conditions' => array('HoutType.id' => $this->request->query['buitenkader_hout_type_id'])));
            $buitenkader_composition_color = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->query['buitenkader_composition_color_id'])));
            $draaidelen_buitenkader_hout_type = $this->HoutType->find('first', array('conditions' => array('HoutType.id' => $this->request->query['draaidelen_buitenkader_hout_type_id'])));
            $binnenzijde_buitenkader_hout_type = $this->HoutType->find('first', array('conditions' => array('HoutType.id' => $this->request->query['binnenzijde_buitenkader_hout_type_id'])));
            $draaidelen_buitenkader_composition_color = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->query['draaidelen_buitenkader_composition_color_id'])));
            $binnenzijde_buitenkader_composition_color = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->query['binnenzijde_buitenkader_composition_color_id'])));
            $draaidelen_binnenkader_hout_type = $this->HoutType->find('first', array('conditions' => array('HoutType.id' => $this->request->query['draaidelen_binnenkader_hout_type_id'])));
            //$binnenzijde_binnenkader_hout_type = $this->HoutType->find('first', array('conditions' => array('HoutType.id' => $this->request->query['binnenzijde_binnenkader_hout_type_id'])));
            $draaidelen_binnenkader_composition_color = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->query['draaidelen_binnenkader_composition_color_id'])));
            //$binnenzijde_binnenkader_composition_color = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->query['binnenzijde_binnenkader_composition_color_id'])));
			$excel2->getActiveSheet()->setCellValue('B29',  $buitenkader_hout_type['HoutType']['hout_type'])
									  ->setCellValue('D29', $buitenkader_composition_color['CompositionColor']['composition_color']);
            $excel2->getActiveSheet()->setCellValue('B30',  $draaidelen_buitenkader_hout_type['HoutType']['hout_type'])
									  ->setCellValue('D30', $draaidelen_buitenkader_composition_color['CompositionColor']['composition_color']);
            
            $excel2->getActiveSheet()->setCellValue('B31',   $draaidelen_binnenkader_hout_type['HoutType']['hout_type'])
									  ->setCellValue('D31',  $draaidelen_binnenkader_composition_color['CompositionColor']['composition_color']);

			 $excel2->getActiveSheet()->setCellValue('B32', $binnenzijde_buitenkader_hout_type['HoutType']['hout_type'])
									  ->setCellValue('D32', $binnenzijde_buitenkader_composition_color['CompositionColor']['composition_color']);

            
           
          /*  $this->PhpExcel->addTableRow(array(
                'binnenzijde binnenkader Type',
                $binnenzijde_binnenkader_hout_type['HoutType']['hout_type'],
                'kleur',
                $binnenzijde_binnenkader_composition_color['CompositionColor']['composition_color'],
                    )
            );*/
        }
		 $file_name =  time() . ".xlsx";
		$this->loadModel('ExcelFile');
        $this->loadModel('Notification');
        $arr['ExcelFile']=array(
								'client_id'=>$client_data['Client']['id'],
								'user_id'=>AuthComponent::user('id'),
								'filename'=>$file_name
        );
        if($this->ExcelFile->save($arr)){
				$notification['Notification']=array(
													'message'=>'Een nieuw Excel-bestand is gegenereerd voor de klant: '.$client_data['Client']['naam']
				);
				$this->Notification->save($notification);
		}
         if($this->PhpExcel->output_to_file($file_name)){
			 $this->Flash->success('Een nieuw Excel-bestand is gegenereerd voor de klant: '.$client_data['Client']['naam']);
			$this->redirect('/clients/add');
		}
    }

    public function get_sub_cats() {
        $this->layout = $this->autoRender = false;
        $this->loadModel('SubCategory');
        $sub_cats = $this->SubCategory->find('list', array('conditions' => array('SubCategory.composition_id' => $this->request->query['composition_id']), 'fields' => array('id', 'sub_cat_name')));
        if ($sub_cats) {
            $data = array('status' => true, 'data' => $sub_cats);
        } else {
            $data = array('status' => false);
        }
        echo json_encode($data);
    }

    public function get_sub_sub_cats() {
        $this->layout = $this->autoRender = false;
        $this->loadModel('SubSubCategory');
        $sub_sub_cats = $this->SubSubCategory->find('list', array('conditions' => array('SubSubCategory.sub_category_id' => $this->request->query['sub_category_id']), 'fields' => array('id', 'sub_sub_cat_name')));
        if ($sub_sub_cats) {
            $data = array('status' => true, 'data' => $sub_sub_cats);
        } else {
            $data = array('status' => false);
        }
        echo json_encode($data);
    }

    public function form_wizard() {
        $this->layout = 'admin';
        if ($this->request->is(array('put', 'post'))) {
            if ($this->request->data['choice']) {
                if (count($this->request->data['choice']) > 1) {

                    $this->Flash->error('Plese Check Only one checkbox');
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard'));
                } else {
                    $this->Flash->success('Step 1 Completed');
                }
                if ($this->request->data['choice'] == 3) {
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_hout'));
                } else if ($this->request->data['choice'] == 2) {
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_aluminium'));
                } else if ($this->request->data['choice'] == 1) {
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_kunststof'));
                } else {
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard'));
                }
            } else {
                $this->Flash->error('Plese Check one checkbox');
                $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard'));
            }
        }
    }

    public function new_customer() {
        $this->layout = 'admin';
    }

    public function register() {
        $this->layout = 'admin';
        if ($this->request->is(array('put', 'post'))) {
            $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard'));
        }
    }

    public function form_wizard_hout() {
        $this->layout = 'admin';
        $this->Session->write('first_c', 'Hout');
        if ($this->request->is(array('put', 'post'))) {
            if ($this->request->data['choice']) {
                if (count($this->request->data['choice']) > 1) {
                    $this->Flash->error('Plese Check Only one checkbox');
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_hout'));
                } else {
                    $this->Flash->success('Step 2 Completed');
                }
                if ($this->request->data['choice'] == 3) {

                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_hout_verhuislook'));
                } else if ($this->request->data['choice'] == 2) {
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_hout_verdiept'));
                } else if ($this->request->data['choice'] == 1) {
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_hout_valk'));
                } else {
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_hout'));
                }
            } else {
                $this->Flash->error('Plese Check one checkbox');
                $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_hout'));
            }
        }
    }

    public function form_wizard_aluminium() {
        $this->layout = 'admin';
        $this->Session->write('first_c', 'Aluminium');
        if ($this->request->is(array('put', 'post'))) {
            if ($this->request->data['choice']) {
                if (count($this->request->data['choice']) > 1) {
                    $this->Flash->error('Plese Check Only one checkbox');
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_aluminium'));
                } else {
                    $this->Flash->success('Step 2 Completed');
                }

                if ($this->request->data['choice'] == 1) {
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_aluminium_alutec'));
                } else if ($this->request->data['choice'] == 2) {
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_aluminium_steellook'));
                } else {
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_aluminium'));
                }
            } else {
                $this->Flash->error('Plese Check one checkbox');
                $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_aluminium'));
            }
        }
    }

    public function form_wizard_kunststof() {
        $this->layout = 'admin';
        $this->Session->write('first_c', 'Kunststof');
        if ($this->request->is(array('put', 'post'))) {

            if ($this->request->data['choice']) {
                if (count($this->request->data['choice']) > 1) {
                    $this->Flash->error('Plese Check Only one checkbox');
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_kunststof'));
                } else {
                    $this->Flash->success('Step 2 Completed');
                }

                if ($this->request->data['choice'] == 2) {
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_kunststof_isotec_pro'));
                } else if ($this->request->data['choice'] == 1) {
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_kunststof_isotec'));
                } else {
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_kunststof'));
                }
            } else {
                $this->Flash->error('Plese Check one checkbox');
                $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_kunststof'));
            }
        }
    }

    public function form_wizard_kunststof_isotec() {
        $this->layout = 'admin';
        $this->Session->write('second_c', 'Isotec');
        if ($this->request->is(array('put', 'post'))) {
            if ($this->request->data['choice']) {
                if (count($this->request->data['choice']) > 1) {
                    $this->Flash->error('Plese Check Only one checkbox');
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_kunststof_isotec'));
                } else {
                    $this->Flash->success('Step 3 Completed');
                }
                if ($this->request->data['choice'] == 3) {
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_kunststof_isotec_verhuislook'));
                } else if ($this->request->data['choice'] == 2) {
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_kunststof_isotec_verdiept'));
                } else if ($this->request->data['choice'] == 1) {
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_kunststof_isotec_vlak'));
                } else {
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_kunststof_isotec'));
                }
            } else {
                $this->Flash->error('Plese Check one checkbox');
                $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_kunststof_isotec'));
            }
        }
    }

    public function form_wizard_kunststof_isotec_vlak() {
        $this->layout = 'admin';
        $this->Session->write('third_c', 'Vlak');
    }

    public function form_wizard_kunststof_isotec_verdiept() {
        $this->layout = 'admin';
        $this->Session->write('third_c', 'Verdiept');
    }

    public function form_wizard_kunststof_isotec_verhuislook() {
        $this->layout = 'admin';
        $this->Session->write('third_c', 'Verhuislook');
    }

    public function form_wizard_kunststof_isotec_pro() {
        $this->layout = 'admin';
        $this->Session->write('second_c', 'Isotecpro');
        if ($this->request->is(array('put', 'post'))) {

            if ($this->request->data['choice']) {
                //debug($this->request->data);die;
                if (count($this->request->data['choice']) > 1) {
                    $this->Flash->error('Plese Check Only one checkbox');
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_kunststof_isotec_pro'));
                } else {
                    $this->Flash->success('Step 3 Completed');
                }
                if ($this->request->data['choice'] == 3) {
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_kunststof_isotec_pro_verhuislook'));
                } else if ($this->request->data['choice'] == 2) {
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_kunststof_isotec_pro_verdiept'));
                } else if ($this->request->data['choice'] == 1) {
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_kunststof_isotec_pro_vlak'));
                } else {
                    $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_kunststof_isotec_pro'));
                }
            } else {
                $this->Flash->error('Plese Check one checkbox');
                $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard_kunststof_isotec_pro'));
            }
        }
    }

    public function form_wizard_kunststof_isotec_pro_vlak() {
        $this->layout = 'admin';
        $this->Session->write('third_c', 'Vlak');
    }

    public function form_wizard_kunststof_isotec_pro_verdiept() {
        $this->layout = 'admin';
        $this->Session->write('third_c', 'Verdiept');
    }

    public function form_wizard_kunststof_isotec_pro_verhuislook() {
        $this->layout = 'admin';
        $this->Session->write('third_c', 'Verhuislook');
    }

    public function form_wizard_aluminium_alutec() {
        $this->layout = 'admin';
        $this->Session->write('second_c', 'Alutec');
    }

    public function form_wizard_aluminium_steellook() {
        $this->layout = 'admin';
        $this->Session->write('second_c', 'Steellook');
    }

    public function form_wizard_hout_valk() {
        $this->layout = 'admin';
        $this->Session->write('second_c', 'Vlak');
    }

    public function form_wizard_hout_verdiept() {
        $this->layout = 'admin';
        $this->Session->write('second_c', 'Verdiept');
    }

    public function form_wizard_hout_verhuislook() {
        $this->layout = 'admin';
        $this->Session->write('second_c', 'Verhuislook');
    }

    public function kunststof_main() {
//        echo "<pre>"; print_r($this->request->query);
        $this->layout = 'drag';
        if (!empty($this->request->query)) {
            if (isset($this->request->query['breedle'])) {
                if ($this->request->query['breedle'] > 8000) {
                    $this->Flash->Error("Width Should Be less than 8000 mm");
                    $this->redirect(array('controller' => 'homepage', 'action' => 'kunststof_main'));
                }
                if (isset($this->request->query['hoogte'])) { 
                    if ($this->request->query['hoogte'] > 7000) {
                        $this->Flash->Error("Height Should Be less than  7000 mm");
                        $this->redirect(array('controller' => 'homepage', 'action' => 'kunststof_main'));
                    }
                    if (isset($this->request->query['kleur_buit'])) {
                        if (isset($this->request->query['kleur_buit'])) {
                            
                        } else {
                            //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                        }
                    } else {
                        //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                    }
                } else {
                    //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                }
            } else {
                //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
            }
        } else {
            //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
        }
        
//        $this->loadModel('Composition');
//        $this->loadModel('SubCategory');
//        $this->loadModel('SubSubCategory');
//        $this->loadModel('CompositionColor'); 
//        $this->loadModel('HoutType');
//        $this->loadModel('ColorType');
//        $this->loadModel('Client');
//        $extraInfo = array();
//        $this->Session->write('extraInfo', $extraInfo);
//        if (isset($this->request->query['composition_id'])){
//        $extraInfo['buitenkader_color_type'] = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->query['buitenkader_color_type_id'])));
//        $extraInfo['buitenkader_composition_color'] = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->query['buitenkader_composition_color_id'])));
//        $extraInfo['draaidelen_buitenkader_color_type'] = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->query['draaidelen_buitenkader_color_type_id'])));
//        $extraInfo['binnenzijde_buitenkader_color_type'] = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->query['binnenzijde_buitenkader_color_type_id'])));
//        $extraInfo['draaidelen_buitenkader_composition_color'] = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->query['draaidelen_buitenkader_composition_color_id'])));
//        $extraInfo['binnenzijde_buitenkader_composition_color'] = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->query['binnenzijde_buitenkader_composition_color_id'])));
//        $extraInfo['draaidelen_binnenkader_color_type'] = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->query['draaidelen_binnenkader_color_type_id'])));
//       // $binnenzijde_binnenkader_color_type = $this->ColorType->find('first', array('conditions' => array('ColorType.id' => $this->request->query['binnenzijde_binnenkader_color_type_id'])));
//        $extraInfo['draaidelen_binnenkader_composition_color'] = $this->CompositionColor->find('first', array('conditions' => array('CompositionColor.id' => $this->request->query['draaidelen_binnenkader_composition_color_id'])));
//        $this->Session->write('extraInfo', $extraInfo);
//        
//        } else {
//            $extraInfo  = $this->Session->read('extraInfo');
//        }
        $extraInfo  = $this->Session->read('extraInfo');
        $formattedInfo = array();
        foreach ($extraInfo as $mainKey=> $values) {
            $formattedInfo[$mainKey] = '';
            foreach ($values as $key => $value) {
                if ($mainKey== 'sub_sub_cat' && isset($value['sub_cat_name']) )
                    $formattedInfo[$mainKey] = $value['sub_cat_name'];
                if (isset($value['color_type'])) {
                    $formattedInfo[$mainKey] = $value['color_type'];
                } else if (isset($value['composition_color'])) {
                    $formattedInfo[$mainKey] = $value['composition_color'];
                } else if (isset($value[$mainKey.'_name'])) {
                    $formattedInfo[$mainKey] = $value[$mainKey.'_name'];
                } else if (isset($value['hout_type'])) {
                    $formattedInfo[$mainKey] = $value['hout_type'];
                } else if (isset($value['hout_type'])) {
                    $formattedInfo[$mainKey] = $value['hout_type'];
                } 
            } 
        }
        $priceList = Configure::read('priceList');
        $catList = Configure::read('CategoryList');
//        echo "<pre>";print_r($formattedInfo);die;
//        echo "<pre>";print_r($priceList);die;
//        $this->Session->write(extraInfo, $value);
        
        $this->loadModel('Color');
        $colors = $this->Color->find('list', array('fields' => array('color_code', 'color_name')));
        $this->set(compact('colors'));
        $this->set('info', $this->request->query);
        $this->set('second_c', $this->Session->read('second_c'));
        $this->set('third_c', $this->Session->read('third_c'));
        $this->set('first_c', $this->Session->read('first_c'));
        $this->set('extraInfo', $formattedInfo);
        $this->set('priceList', $priceList);
        $this->set('catList', $catList);
    }

    public function new_f() {
        $this->layout = 'admin';
    }

    public function add_color() {
        $this->layout = 'admin';
        if ($this->request->is('post')) {
            $this->loadModel('Color');

            if ($this->Color->save($this->request->data)) {
                $this->Flash->success("Color has been saaved");
                $this->redirect(array('controller' => 'homepage', 'action' => 'all_colors'));
            } else {
                $this->Flash->error("Color has not been saaved");
            }
        }
    }

    public function all_colors() {
        $this->layout = 'admin';
        $this->loadModel('Color');
        $colors = $this->Color->find('all');
        $this->set(compact('colors'));
    }

    public function delete_color($id = null) {
        //$this->layout = 'admin';
        if ($this->request->is('post')) {
            $this->loadModel('Color');
            if ($this->Color->delete($id)) {
                $this->Flash->success("Color has been deleted");
                $this->redirect(array('controller' => 'homepage', 'action' => 'all_colors'));
            }
        }
    }

    public function finish_frame() {
        $this->layout = 'admin';
        if ($this->request->is('post')) {

            if ($this->request->data['choice'] == 2) {
                $this->Flash->success('Data has been sent to server');
                $this->redirect(array('controller' => 'homepage', 'action' => 'new_customer'));
            } else if ($this->request->data['choice'] == 1) {
                //$this->Flash->success('');
                $this->redirect(array('controller' => 'homepage', 'action' => 'form_wizard'));
            } else {
                
            }
        }
    }

    public function hout_verhuislook() {
        $this->layout = 'drag';
        if (!empty($this->request->query)) {
            if (isset($this->request->query['breedle'])) {
                if (isset($this->request->query['hoogte'])) {
                    if (isset($this->request->query['kleur_buit'])) {
                        if (isset($this->request->query['kleur_buit'])) {
                            
                        } else {
                            //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                        }
                    } else {
                        //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                    }
                } else {
                    //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                }
            } else {
                //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
            }
        } else {
            //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
        }
        $this->loadModel('Color');
        $colors = $this->Color->find('list', array('fields' => array('color_code', 'color_name')));
        $this->set(compact('colors'));
        $this->set('info', $this->request->query);
    }

    public function hout_verdiept() {
        $this->layout = 'drag';
        if (!empty($this->request->query)) {
            if (isset($this->request->query['breedle'])) {
                if (isset($this->request->query['hoogte'])) {
                    if (isset($this->request->query['kleur_buit'])) {
                        if (isset($this->request->query['kleur_buit'])) {
                            
                        } else {
                            //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                        }
                    } else {
                        //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                    }
                } else {
                    //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                }
            } else {
                //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
            }
        } else {
            //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
        }
        $this->loadModel('Color');
        $colors = $this->Color->find('list', array('fields' => array('color_code', 'color_name')));
        $this->set(compact('colors'));
        $this->set('info', $this->request->query);
    }

    public function hout_vlak() {
        $this->layout = 'drag';
        if (!empty($this->request->query)) {
            if (isset($this->request->query['breedle'])) {
                if (isset($this->request->query['hoogte'])) {
                    if (isset($this->request->query['kleur_buit'])) {
                        if (isset($this->request->query['kleur_buit'])) {
                            
                        } else {
                            //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                        }
                    } else {
                        //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                    }
                } else {
                    //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                }
            } else {
                //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
            }
        } else {
            //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
        }
        $this->loadModel('Color');
        $colors = $this->Color->find('list', array('fields' => array('color_code', 'color_name')));
        $this->set(compact('colors'));
        $this->set('info', $this->request->query);
    }

    public function aluminium_alutec() {
        $this->layout = 'drag';
        if (!empty($this->request->query)) {
            if (isset($this->request->query['breedle'])) {
                if (isset($this->request->query['hoogte'])) {
                    if (isset($this->request->query['kleur_buit'])) {
                        if (isset($this->request->query['kleur_buit'])) {
                            
                        } else {
                            //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                        }
                    } else {
                        //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                    }
                } else {
                    //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                }
            } else {
                //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
            }
        } else {
            //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
        }
        $this->loadModel('Color');
        $colors = $this->Color->find('list', array('fields' => array('color_code', 'color_name')));
        $this->set(compact('colors'));
        $this->set('info', $this->request->query);
    }

    public function aluminium_steellook() {
        $this->layout = 'drag';
        if (!empty($this->request->query)) {
            if (isset($this->request->query['breedle'])) {
                if (isset($this->request->query['hoogte'])) {
                    if (isset($this->request->query['kleur_buit'])) {
                        if (isset($this->request->query['kleur_buit'])) {
                            
                        } else {
                            //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                        }
                    } else {
                        //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                    }
                } else {
                    //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                }
            } else {
                //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
            }
        } else {
            //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
        }
        $this->loadModel('Color');
        $colors = $this->Color->find('list', array('fields' => array('color_code', 'color_name')));
        $this->set(compact('colors'));
        $this->set('info', $this->request->query);
    }

    public function testing() {
        $this->layout = 'drag';
        if (!empty($this->request->query)) {
            if (isset($this->request->query['breedle'])) {
                if ($this->request->query['breedle'] > 8000) {
                    $this->Flash->Error("Width Should Be less than 190mm");
                    $this->redirect(array('controller' => 'homepage', 'action' => 'testing'));
                }
                if (isset($this->request->query['hoogte'])) {
                    if ($this->request->query['hoogte'] > 7000) {
                        $this->Flash->Error("Height Should Be less than 100mm");
                        $this->redirect(array('controller' => 'homepage', 'action' => 'testing'));
                    }
                    if (isset($this->request->query['kleur_buit'])) {
                        if (isset($this->request->query['kleur_buit'])) {
                            
                        } else {
                            //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                        }
                    } else {
                        //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                    }
                } else {
                    //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
                }
            } else {
                //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
            }
        } else {
            //$this->redirect(array('controller'=>'homepage','action'=>'kunststof_main'));
        }
        $this->loadModel('Color');
        $colors = $this->Color->find('list', array('fields' => array('color_code', 'color_name')));
        $this->set(compact('colors'));
        $this->set('info', $this->request->query);
        $this->set('second_c', $this->Session->read('second_c'));
        $this->set('third_c', $this->Session->read('third_c'));
        $this->set('first_c', $this->Session->read('first_c'));
    }

}
