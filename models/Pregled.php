<?php
class Pregled extends ci_Model{
	public function __construct(){
        parent::__construct();
    }

	/*----------------------------------------------------------------------------------------------------------------------------------------------*/

	public function login(){
		$podaci_prim= array('username' =>"" ,'password'=>"",'remember'=>"off",'sub'=>"" );
		$podaci=array_merge($podaci_prim,isset($_POST['login'])?$_POST['login']:array());
		
		if ($podaci==$podaci_prim) {
			$podaci_form=array();
			foreach ($podaci_prim as $key => $value) {
				if($key=='password'){
					$tekst_tip='password';
				}elseif($key=='remember'){
					$tekst_tip='checkbox';
				}else{
					$tekst_tip='text';
				}
				if ($key!='sub') {
					$podaci_form[$key]='<input type="'.$tekst_tip.'" name="login['.$key.']">';
				}
			}		
			
			return (array('',$podaci_form,'login',$podaci,''));
		}elseif ($podaci['sub']=='Log in') {
			return(Pregled::kompletnost($podaci));
		}
	}

	/*----------------------------------------------------------------------------------------------------------------------------------------------*/

	public function registracija(){
		$podaci=isset($_POST['registracija'])?$_POST['registracija']:"";
	}

	/*----------------------------------------------------------------------------------------------------------------------------------------------*/

	public function dobrodosli(){
		return(array('','','dobrodosli',''));
	}
	/*----------------------------------------------------------------------------------------------------------------------------------------------*/

	public function problem(){
		$podaci=isset($_POST['problem'])?$_POST['problem']:"";
	}

	/*----------------------------------------------------------------------------------------------------------------------------------------------*/

	public function kompletnost($podaci){
		$provera=array();
		foreach ($podaci as $key=>$value) {
		
			if($key=='password'){
				$tekst_tip='password';
			}elseif($key=='remember'){
				$tekst_tip='checkbox';
			}else{
				$tekst_tip='text';
			}
		
			if($value==""){
				$provera[$key]='<input type="'.$tekst_tip.'" name="login['.$key.']">Unesite '.$key.'!';
			}elseif($key!='sub'){
				if($key=='remember' && $value=='on'){
					$remember='checked';
				}else{
					$remember="";
				}
				if($key=='remember'){
					$provera[$key]='<input type="'.$tekst_tip.'" name="login['.$key.']" '.$remember.'>';
				}else{
					$provera[$key]='<input type="'.$tekst_tip.'" name="login['.$key.']" value="'.$podaci[$key].'">';
				}
			}else{
				$provera[$key]= $value;
			}
		}
		foreach ($podaci as $key=>$value) {
			if($podaci['username']=="" or $podaci['password']==""){
				return(array('Nisu uneseni svi podaci<br>', $provera,'login', $podaci,''));
			}else{
				return(array('', $provera,'dobrodosli', $podaci, Pregled::redirect('http://localhost/ci/index.php/kontroler/view/dobrodosli')));
			}
		}
	}

	/*----------------------------------------------------------------------------------------------------------------------------------------------*/

	public function redirect ($url){
		header('Location: '.$url);
		die();
	}
}