<?php 
	class Language{

		private $language;
		private $dictionary;

		public function __construct(){

			global $config;
			$this->language = $config['default_lang'];

			if(!empty($_SESSION['language']) && file_exists('lang/'.$_SESSION['language'].'.ini')){
				$this->language = $_SESSION['language'];
			}

			$this->dictionary = parse_ini_file('lang/'.$this->language.'.ini');
		}

		public function get($word, $return = false){

			$text = $word;

			if(isset($this->dictionary[$word])){
				$text = $this->dictionary[$word];
			}

			if($return){
				return $text;
			}else{
				echo $text;
			}
		}
	}
 ?>