<?php
require_once 'zss_lib/kensaku_joken/kj_util.php';

class KjDataMusi{
	function getData(){
			



		$data['kuwagata'] = array(field=> 'kuwagata' ,wamei=>'クワガタ',kind=> 'text' ,cnd_ope=> 2 , 
			value=>'ヒラタクワガタ',value2=>'ヒラタクワガタ2' , visible=> true,txtFormType=>'text');
			
		$data['kani'] = array(field=> 'kani' ,wamei=>'カニ',kind=> 'int' ,cnd_ope=> 3 , 
			value=>'100',value2=>'200' , visible=> true,txtFormType=>'number');
			
		$data['akamusi'] = array(field=> 'akamusi' ,wamei=>'アカムシ【float】',kind=> 'float' ,cnd_ope=> 0 , 
			value=>'99',value2=>'199' , visible=> true,txtFormType=>'number');
			
		$data['iruka'] = array(field=> 'iruka' ,wamei=>'イルカ【double】',kind=> 'double' ,cnd_ope=> 0 , 
			value=>'99',value2=>'199' , visible=> true,txtFormType=>'number');
			
		$data['usi'] = array(field=> 'usi' ,wamei=>'牛【long】',kind=> 'long' ,cnd_ope=> 0 , 
			value=>'99',value2=>'199' , visible=> true,txtFormType=>'number');
			
		$data['ebi'] = array(field=> 'ebi' ,wamei=>'エビ【decimal】',kind=> 'decimal' ,cnd_ope=> 0 , 
			value=>'99',value2=>'199' , visible=> true,txtFormType=>'number');
			
			
		$data['kabuto'] = array(field=> 'kabuto' ,wamei=>'カブトムシ【comb】',kind=> 'comb' ,cnd_ope=> 0 , 
			value=>'2' ,value2=>'', visible=> true,txtFormType=>'text');
			
		$data['ookami'] = array(field=> 'ookami' ,wamei=>'オオカミ【radio】',kind=> 'radio' ,cnd_ope=> 0 , 
			value=>'2' ,value2=>'', visible=> true,txtFormType=>'');
		
		$data['kitune'] = array(field=> 'kitune' ,wamei=>'キツネ【chk】',kind=> 'chk' ,cnd_ope=> 0 , 
			value=>'1',value2=>'' , visible=> true,txtFormType=>'');
			
		$data['kuma'] = array(field=> 'kuma' ,wamei=>'クマ【bool】',kind=> 'bool' ,cnd_ope=> 0 , 
			value=>true,value2=>'' , visible=> true,txtFormType=>'');
			
		$data['kemusi'] = array(field=> 'kemusi' ,wamei=>'ケムシ【date】',kind=> 'date' ,cnd_ope=> 0 , 
			value=>'2012/12/12',value2=>'2012/12/15' , visible=> true,txtFormType=>'text');
			
		$data['korogi'] = array(field=> 'korogi' ,wamei=>'コオロギ【time】',kind=> 'time' ,cnd_ope=> 0 , 
			value=>'12:12:12',value2=>'' , visible=> true,txtFormType=>'text');
			
		$data['sasori'] = array(field=> 'sasori' ,wamei=>'サソリ【datetime】',kind=> 'datetime' ,cnd_ope=> 0 , 
			value=>'2012/12/12 12:12:12',value2=>'2012/12/12 12:12:59' , visible=> true,txtFormType=>'datetime');
			
		
		//▽選択用データの生成	
		$data['kabuto']['selectData']=$this->createSelectDataKuwagata();
		
		//▽選択用データの生成	
		$data['ookami']['selectData']=$this->createSelectDataKuwagata();
		
		

		
		return $data;
	}
	
	//▽コンボボックスデータの生成	
	private function createSelectDataKuwagata(){
		$data[0]['value']=0;
		$data[0]['text']='タイワンカブト';
		$data[1]['value']=1;
		$data[1]['text']='ヘラクレスオオカブト';
		$data[2]['value']=2;
		$data[2]['text']='コーカサスオオカブト';
		$data[3]['value']=3;
		$data[3]['text']='アトランティスオオカブト';
		
		return $data;
	}
	
	
}
?>