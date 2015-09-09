<?php

class Geo_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	public function getBus()
	{
		$query = $this->db->query('SELECT distinct route_id,short_name,long_name from routes order by short_name asc  ;'); 
		return  $query->result_array();
	}

	public function getBusRoute($bus1,$bus2)
	{
		header('Content-type: application/json');
		$poi1 = "";

		$query1 = $this->db->query('select  distinct s.stop_id as stop_id,s.lat as lat ,s.lng as lng ,s.name as name from stops as s,routes as r ,stop_times as st,trips as t
									where t.route_id=r.route_id and t.trip_id=st.trip_id and st.stop_id=s.stop_id and  r.route_id=\'' . $bus1 .'\'  group by s.name ;'); 
		$query2 = $this->db->query('select  distinct s.stop_id as stop_id,s.lat as lat ,s.lng as lng ,s.name as name from stops as s,routes as r ,stop_times as st,trips as t
									where t.route_id=r.route_id and t.trip_id=st.trip_id and st.stop_id=s.stop_id  and r.route_id=\'' . $bus2 .'\' group by s.name ;'); 
		$bus1_data =  $query1->result();
		$bus2_data =  $query2->result();
		$result=array_map('unserialize', array_intersect(array_map('serialize', $bus1_data), array_map('serialize', $bus2_data)) );
		//print_r($result);
		//die;

		foreach ($result as $row)
		{
			$poi1[]= array('stopname'=>$row->name,'lat'=>$row->lat,'lng'=>$row->lng);
		}
		echo json_encode($poi1);
	}
	
		public function FindBus($station)
	{
		header('Content-type: application/json');
		$poi1 = "";

		$query1 = $this->db->query('select   s.name as station ,r.short_name as busname,r.long_name as longname from stops as s,stop_times as st ,trips as tr,routes as r where s.stop_id=st.stop_id and st.trip_id=tr.trip_id and tr.route_id=r.route_id  and   s.stop_id=\'' . $station .'\'  group by s.name ;'); 
		

		foreach ($query1->result() as $row)
		{
			$poi1[]= array('station'=>$row->station,'busname'=>$row->busname,'longname'=>$row->longname);
		}
		echo json_encode($poi1);
	}
		public function FindStation($radius,$lat,$lng)
	{
		header('Content-type: application/json');
		$poi1 = "";
		/*SELECT id, ( 3959 * acos( cos( radians(37) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(-122) ) + sin( radians(37) ) * sin( radians( lat ) ) ) ) AS distance FROM markers HAVING distance < 25 ORDER BY distance LIMIT 0 , 20*/
		$q3 ="SELECT s.stop_id as station_id,s.name as station,s.lat as lat,s.lng as lng, 
   				111.1111 * DEGREES(ACOS(COS(RADIANS(s.lat))* COS(RADIANS($lat))* COS(RADIANS(s.lng - $lng))+ SIN(RADIANS(s.lat))* SIN(RADIANS($lat)))) AS distance_in_km  FROM stops as s HAVING distance_in_km  <= $radius*0.001 ORDER BY distance_in_km  ASC;";
			
		$query1 = $this->db->query($q3); 
		

		foreach ($query1->result() as $row)
		{
			$poi1[]= array('station_id'=>$row->station_id,'name'=>$row->station,'lat'=>$row->lat,'lng'=>$row->lng);
		}
		echo json_encode($poi1);
	}

	public function getSector()
	{
		header('Content-type: application/json');
		$query = $this->db->query('select st_asgeojson(st_centroid(s_geom)::geometry) as center,st_asgeojson(s_geom::geometry) as sector from services.sector  ;');
		$land=array();
		foreach ($query->result() as $row)
		{	
			array_push($land,json_decode($row->sector,true));
			array_push($land,json_decode($row->center,true));
		}
		echo json_encode($land);
		
	}

	public function getPoiType()
	{
		$query = $this->db->query('SELECT distinct p_type from services.poi ;'); 
		return  $query->result_array();
	}
	
	public function getPoi($poi)
	{
		header('Content-type: application/json');
		$query = $this->db->query('select  p.p_name,p.p_type,st_asgeojson(s.s_geom) as sector,st_asgeojson(p.p_geom) as poi,p.p_address,p.p_telephone
									from  services.poi as p,services.sector as s
									where  s.s_id=p.s_id and   p.p_type=\'' . $poi .'\';'); 
		foreach ($query->result() as $row)
		{
			$poi1[]= array('name'=>$row->p_name,'type'=>$row->p_type,'sector'=>json_decode($row->sector,true),'poi'=>json_decode($row->poi,true),'address'=>$row->p_address,'telephone'=>$row->p_telephone);
		}
		echo json_encode($poi1);
	}
	public function getPolygon($user,$category){
		header('Content-type: application/json');
		$upolygon="";
		$polygon="";
		$length=count($user);
		
		
		for ($i=0;$i<$length;$i++){
			$polygon.=$user[$i]['lng'].' '.$user[$i]['lat'].' ,';
		}
		$polygon.=$user[0]['lng'].' '.$user[0]['lat'];
		print_r($polygon);
		die;
		$query = $this->db->query('select  p.p_name,p.p_type,st_asgeojson(p.p_geom) as poi,p.p_address,p.p_telephone
									from  services.poi as p,services.sector as s
									where  s.s_id=p.s_id and  st_contains(st_geomfromtext(\'POLYGON(('  . $polygon .'))\',4326),p.p_geom) and  p.p_type=\'' . $category .'\' ;'); 
		foreach ($query->result() as $row)
		{
			$upolygon[]= array('name'=>$row->p_name,'type'=>$row->p_type,'poi'=>json_decode($row->poi,true),'address'=>$row->p_address,'telephone'=>$row->p_telephone);
		}
		echo json_encode($upolygon);
	}
	public function getLine($user,$category){
		header('Content-type: application/json');
		
		$line="";
		$uline="";
		$length=count($user);
		for ($i=0;$i<$length-1;$i++){
			
			$line.=$user[$i]['Za'].' '.$user[$i]['Ya'].' ,';
		}
		$line.=$user[$length-1]['Za'].' '.$user[$length-1]['Ya'];
		$query = $this->db->query('select  p.p_name,p.p_type,st_asgeojson(p.p_geom) as poi,p.p_address,p.p_telephone
				from services.poi as p,services.sector as s	where  s.s_id=p.s_id and st_contains(st_buffer(st_geomfromtext(\'LINESTRING('  . $line .')\',4326),0.002),p.p_geom) and  p.p_type=\'' . $category .'\' ;'); 
		foreach ($query->result() as $row)
		{
			$uline[]= array('name'=>$row->p_name,'type'=>$row->p_type,'poi'=>json_decode($row->poi,true),'address'=>$row->p_address,'telephone'=>$row->p_telephone);
		}
	
		echo json_encode($uline);
	
	}


	
}