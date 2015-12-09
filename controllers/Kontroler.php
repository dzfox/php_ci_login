<?php
class Kontroler extends CI_Controller {

	public function view($page='login'){
		
        $this->load->model('Pregled');
		$data['provera']=$this->Pregled->$page();
        if ( ! file_exists(APPPATH.'/views/pages/'.$this->Pregled->$page()['2'].'.php'))
        {
            show_404();
        }
        $data['title'] = ucfirst($this->Pregled->$page()['2']);
		$this->load->view('templates/header', $data);
        $this->load->view('pages/'.$this->Pregled->$page()['2'], $data);
        $this->load->view('templates/links', $data);
		$this->load->view('templates/footer', $data);

	}
	public function dataBase (){
		
		$this->load->model('Baza');
		$konektovanje=$this->Baza->konektujNaServer();
		echo $konektovanje.'<br>';
	}
}