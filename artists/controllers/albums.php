<?php
	namespace Controllers;
	class Albums_Controller extends Master_Controller {
		public function __construct() {
			parent::__construct(get_class(), "album", "/views/albums/");
		}
		public function index() {
			$albums = $this->model->find();
			
			//var_dump($artists); die();/////
			
			$template_name = DX_ROOT_DIR.$this->views_dir.'index.php';
			include_once $this->layout;
		}
		public function view($id) {
			$albums = $this->model->get($id);
			var_dump($albums);
		}
	}
	
?>

