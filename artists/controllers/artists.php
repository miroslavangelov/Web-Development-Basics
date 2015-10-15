<?php
	namespace Controllers;
	class Artists_Controller extends Master_Controller{
		public function __construct() {
			parent::__construct(get_class(), "artists", "/views/artists/");
		}
		public function index() {
			$artists = $this->model->find();
			
			//var_dump($artists); die();/////
			
			$template_name = DX_ROOT_DIR.$this->views_dir.'index.php';
			include_once $this->layout;
		}
	}
?>

