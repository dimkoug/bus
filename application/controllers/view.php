<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('geo_model');
		
	}
	public function home()
	{
		$data['busdata']=$this->geo_model->GetBus();
		$data['script']="<script type=\"text/javascript\" src=\"/public/js/jquery-1.11.1.min.js\"></script>";
		$data['script'].="<script type=\"text/javascript\" src=\"/public/js/jquery.form.min.js\"></script>";
		$data['script'].="<script type=\"text/javascript\" src=\"/public/js/bootstrap.min.js\"></script>";
		$data['script'].="<script type=\"text/javascript\" src=\"http://maps.googleapis.com/maps/api/js?&sensor=false\"></script>";
		$data['script'].="<script type=\"text/javascript\" src=\"/public/js/map.js\"></script>";
		#$data['script'].="<script type=\"text/javascript\" src=\"public/js/markerclusterer.js\"></script>";
		$data['css']="<link rel=\"stylesheet\" type=\"text/css\" href=\"/public/css/bootstrap.min.css\" media=\"screen\" />";
		$data['css'].="<link rel=\"stylesheet\" type=\"text/css\" href=\"/public/css/mystyle.css\" media=\"screen\" />";
		$data['css'].="<link rel=\"stylesheet\" type=\"text/css\" href=\"/public/css/navbar-static-top.css\" media=\"screen\" />";
		$data['css'].="<link rel=\"stylesheet\" type=\"text/css\" href=\"/public/font-awesome-4.1.0/css/font-awesome.css\" media=\"screen\" />";
		#$data['css'].="<link rel=\"stylesheet\" type=\"text/css\" href=\"public/css/map.css\" media=\"screen\" />";
		#$data['link']="<a href=\"public/view/userview\">Επιλογή Πολυγώνου</a>";
		#$data['link'].="<a href=\"public/view/lineview\">Επιλογή Διαδρομής</a>";
		$this->load->view('common/header.php',$data);
		$this->load->view('common/nav.php',$data);
		$this->load->view('home/home.php',$data);
		$this->load->view('common/footer.php');
	
	}
	public function user_loc()
	{
		$data['busdata']=$this->geo_model->GetBus();
		$data['script']="<script type=\"text/javascript\" src=\"/public/js/jquery-1.11.1.min.js\"></script>";
		$data['script'].="<script type=\"text/javascript\" src=\"/public/js/jquery.form.min.js\"></script>";
		$data['script'].="<script type=\"text/javascript\" src=\"/public/js/bootstrap.min.js\"></script>";
		$data['script'].="<script type=\"text/javascript\" src=\"http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false&json\"></script>";
		$data['script'].="<script type=\"text/javascript\" src=\"/public/js/user.js\"></script>";
		#$data['script'].="<script type=\"text/javascript\" src=\"public/js/markerclusterer.js\"></script>";
		$data['css']="<link rel=\"stylesheet\" type=\"text/css\" href=\"/public/css/bootstrap.min.css\" media=\"screen\" />";
		$data['css'].="<link rel=\"stylesheet\" type=\"text/css\" href=\"/public/css/mystyle.css\" media=\"screen\" />";
		$data['css'].="<link rel=\"stylesheet\" type=\"text/css\" href=\"/public/css/navbar-static-top.css\" media=\"screen\" />";
		$data['css'].="<link rel=\"stylesheet\" type=\"text/css\" href=\"/public/font-awesome-4.1.0/css/font-awesome.css\" media=\"screen\" />";
		#$data['css'].="<link rel=\"stylesheet\" type=\"text/css\" href=\"public/css/map.css\" media=\"screen\" />";
		#$data['link']="<a href=\"public/view/userview\">Επιλογή Πολυγώνου</a>";
		#$data['link'].="<a href=\"public/view/lineview\">Επιλογή Διαδρομής</a>";
		$this->load->view('common/header.php',$data);
		$this->load->view('common/nav.php',$data);
		$this->load->view('user/user.php',$data);
		$this->load->view('common/footer.php');
	
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */