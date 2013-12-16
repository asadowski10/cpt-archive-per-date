<?php
class CPT_APD_Plugin{
	
	public function __construct() {
		
	}
	
	public static function activate() {  
		flush_rewrite_rules();
	}
	
	public static function deactivate() {
		flush_rewrite_rules();
	}
}