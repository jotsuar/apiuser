<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');


	private function getHttp(){
		return new HttpSocket(
            array("ssl_verify_peer" => false, 'ssl_verify_host' => false, "ssl_allow_self_signed" => false)
        );
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {

		$users = array();

		try {  

          $HttpSocket = $this->getHttp();
          $results    = $HttpSocket->get("https://reqres.in/api/users"); 

          $results    = json_decode($results->body);


		  $users = $results->data;
  
         
        } catch (Exception $e) {}

        if (!is_null($this->Session->read("user"))) {
        	$deleted = $this->Session->read("user");
        	$this->Session->delete("user");
        	$this->set('deleted', $deleted);
        	
        }

        $this->set('users', $users);
		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$user = array();

		try {  

          $HttpSocket = $this->getHttp();
          $results    = $HttpSocket->get("https://reqres.in/api/users/$id"); 

          $results    = json_decode($results->body);

		  $user = $results->data;
  
         
        } catch (Exception $e) {}

        $this->set('user', $user);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {

			try {  
			  $data = array("name" => $this->request->data["User"]["name"],"job" => $this->request->data["User"]["job"] );
	          $HttpSocket = $this->getHttp();
	          $results    = $HttpSocket->post("https://reqres.in/api/users/",$data); 
	          $results    = json_decode($results->body);

	            if ($results->id) {
					$this->Flash->success(__('The user has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Flash->error(__('The user could not be saved. Please, try again.'));
				}

	         
	        } catch (Exception $e) {}
			
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {

		$HttpSocket = $this->getHttp();
          $results    = $HttpSocket->get("https://reqres.in/api/users/$id"); 

          $results    = json_decode($results->body);

		  $user = $results->data;

		  $this->request->data["User"]["name"] = $user->first_name." ".$user->last_name;

		if ($this->request->is(array('post', 'put'))) {
			try {  
			  $data = array("name" => $this->request->data["User"]["name"],"job" => $this->request->data["User"]["job"] );
	          $HttpSocket = $this->getHttp();
	          $results    = $HttpSocket->put("https://reqres.in/api/users/",$data); 
	          $results    = json_decode($results->body);

	            if ($results->updatedAt) {
					$this->Flash->success(__('The user has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Flash->error(__('The user could not be saved. Please, try again.'));
				}

	         
	        } catch (Exception $e) {}
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
		try {  

          $HttpSocket = $this->getHttp();
          $results    = $HttpSocket->delete("https://reqres.in/api/users/$id"); 

          if ($results->code == "204") {
          	$this->Flash->success(__('The user has been deleted.'));
          	$this->Session->write("user",$id);
          }else{
          	$this->Flash->error(__('The user could not be deleted. Please, try again.'));
          }
 
         
        } catch (Exception $e) {}
		return $this->redirect(array('action' => 'index'));
	}
}
