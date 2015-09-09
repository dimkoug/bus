<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request extends CI_Controller {
public function __construct()
	{
		parent::__construct();
		$this->load->model('geo_model');
		
	}
	public function bus_route(){
		header('Content-type: application/json');
		$bus1=$this->input->post('bus1');
		$bus2=$this->input->post('bus2');
		$this->geo_model->getBusRoute($bus1,$bus2);
	}
	public function FindStation(){
		header('Content-type: application/json');
		$radius=$this->input->post('radius');
		$lat=$this->input->post('lat');
		$lng=$this->input->post('lng');
		$this->geo_model->FindStation($radius,$lat,$lng);
	}
	public function FindBus(){
		header('Content-type: application/json');
		$station=$this->input->post('station');
		$this->geo_model->FindBus($station);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */