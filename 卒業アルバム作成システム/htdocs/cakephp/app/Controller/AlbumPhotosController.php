<?php
App::uses('AppController', 'Controller');
/**
 * AlbumPhotos Controller
 *
 * @property AlbumPhoto $AlbumPhoto
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class AlbumPhotosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->AlbumPhoto->recursive = 0;
		$this->set('albumPhotos', $this->Paginator->paginate());
		//リクエストの値がpostかどうか
		if ($this->request->is('post')) {
			$this->AlbumPhoto->create();
			if ($this->AlbumPhoto->save($this->request->data)) {
		//		$this->Flash->success(__('The album photo has been saved.'));
				return $this->redirect(array('action' => 'album_check'));
			} else {
				$this->Flash->error(__('The album photo could not be saved. Please, try again.'));
			}
		}
	}

	public function album_check(){
		//SQLでDBからデータ取得
		$sql_album_name = "select album_name from album_photos where id = (select max(id) from album_photos);";
		//取得したクエリを変数に格納
		$res01 = $this->AlbumPhoto->query($sql_album_name);
		//[0]配列の中のテーブルの中のカラムの値を指定して変数に格納
		$res02 = $res01[0]['album_photos']['album_name'];
		//dataを変数名を指定してsetする
		$this->set('alname', $res02);

		$sql_model_name = "select model_name from album_photos where id = (select max(id) from album_photos);";
		$res03 = $this->AlbumPhoto->query($sql_model_name);
		$res04 = $res03[0]['album_photos']['model_name'];
		$this->set('moname', $res04);

	}

	public function album_result(){
		//SQLでDBからデータ取得
		$sql_album_name = "select album_name from album_photos where id = (select max(id) from album_photos);";
		$res01 = $this->AlbumPhoto->query($sql_album_name);
		$res02 = $res01[0]['album_photos']['album_name'];
		$this->set('alname', $res02);
	}

	public function album_result2(){
		//SQLでDBからデータ取得
		$sql_album_name = "select album_name from album_photos where id = (select max(id) from album_photos);";
		$res01 = $this->AlbumPhoto->query($sql_album_name);
		$res02 = $res01[0]['album_photos']['album_name'];
		$this->set('alname', $res02);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AlbumPhoto->exists($id)) {
			throw new NotFoundException(__('Invalid album photo'));
		}
		$options = array('conditions' => array('AlbumPhoto.' . $this->AlbumPhoto->primaryKey => $id));
		$this->set('albumPhoto', $this->AlbumPhoto->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AlbumPhoto->create();
			if ($this->AlbumPhoto->save($this->request->data)) {
		//		$this->Flash->success(__('The album photo has been saved.'));
				return $this->redirect(array('action' => 'album_check'));
			} else {
				$this->Flash->error(__('The album photo could not be saved. Please, try again.'));
			}
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
		if (!$this->AlbumPhoto->exists($id)) {
			throw new NotFoundException(__('Invalid album photo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AlbumPhoto->save($this->request->data)) {
				$this->Flash->success(__('The album photo has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The album photo could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AlbumPhoto.' . $this->AlbumPhoto->primaryKey => $id));
			$this->request->data = $this->AlbumPhoto->find('first', $options);
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
		if (!$this->AlbumPhoto->exists($id)) {
			throw new NotFoundException(__('Invalid album photo'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->AlbumPhoto->delete($id)) {
			$this->Flash->success(__('The album photo has been deleted.'));
		} else {
			$this->Flash->error(__('The album photo could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
