<?php
class UsersController extends AppController {
   
    public function getUsername(){
        return $this->Auth->user('username');
    }

    public function getSuccess(){
        return $this->Session->check('Auth.User');
    } 
    
    public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('User.username' => 'asc' ) 
    );
             
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','add'); 
    }

    public function login() {
        if($this->Session->check('Auth.User')){
          $this->redirect(array('action' => 'index'));      
        }
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash(__(' username o password Invalidos'));
            }
        }
    }
 
    public function logout() {
        $this->redirect($this->Auth->logout());
    }
 
    public function index() {
        $this->paginate = array(
            'limit' => 6,
            'order' => array('User.username' => 'asc' )
        );
        $users = $this->paginate('User');
        $this->set(compact('users'));
        
    }
     public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Usuario creado'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('No se ha podido añadir el usuario'));
            }   
        }
    }
 
    public function edit($id = null) {
 
            if (!$id) {
                $this->Session->setFlash('Ingrese Id');
                $this->redirect(array('action'=>'index'));
            }
 
            $user = $this->User->findById($id);
            if (!$user) {
                $this->Session->setFlash('ID Erronea');
                $this->redirect(array('action'=>'index'));
            }
 
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->User->id = $id;
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('Se han actualizado los datos'));
                    $this->redirect(array('action' => 'edit', $id));
                }else{
                    $this->Session->setFlash(__('No se ha podido actualizar los datos.'));
                }
            }
 
            if (!$this->request->data) {
                $this->request->data = $user;
            }
    }
 
    public function delete($id = null) {

        if($this->Auth->user('id') != $id){
        
            if (!$id) {
                $this->Session->setFlash('Adquirir Id');
                $this->redirect(array('action'=>'index'));
            }
             
            $this->User->id = $id;
            if (!$this->User->exists()) {
                $this->Session->setFlash('ID invalida');
                $this->redirect(array('action'=>'index'));
            }
            if ($this->User->saveField('status', 0)) {
                $this->User->delete();
                $this->Session->setFlash(__('Usuario Eliminado'));
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Usuario no se ha podido Eliminar'));
            $this->redirect(array('action' => 'index'));
            }
        else{
             $this->Session->setFlash(__('No se puede eliminar el usuario en sesion'));
            $this->redirect(array('action'=>'index'));
        }
    }
     
    public function activate($id = null) {
         
        if (!$id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'index'));
        }
         
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('status', 1)) {
            $this->Session->setFlash(__('User re-activated'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not re-activated'));
        $this->redirect(array('action' => 'index'));
    }
 
}
?>