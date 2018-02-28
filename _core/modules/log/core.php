<?php
class Logger{
	public static function write($msg){		
		if (!$msg) {
			$file = fopen ( "logger.txt", "a" );
			fwrite ( $file , date("Y-m-d h:i:sa")." [". $_SERVER['REMOTE_ADDR']."] ".$msg. PHP_EOL );
			fclose ( $file );
		}
		$file = fopen ( "logger.txt", "a" );
		fwrite ( $file , date("Y-m-d h:i:sa")." ".json_encode($msg). PHP_EOL );
		fclose ( $file );
	}
}
?>