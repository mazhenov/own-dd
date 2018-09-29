<?php
if (!function_exists('dd')) {
    function dd(){
		$args = func_get_args();
		$data['str'] = owndd(func_get_args());
		$data['count'] = count($args);
		$data['datetime'] = date("Y/m/d H:i:s");
		require "tpl.php";
		exit();
	}
	function owndd($args){
		$data = '';
		foreach( $args as $key => $item){
			$str = "#".$key;
			if(is_array($item)){
				if(count($item) == 0){
					$str = "<i>Empty array.</i>";
				}
				else {
					$str = $str."<div style='padding:10px;border:1px solid #d0d0d0;border-radius:3px;'>";
					$str = $str."<div style='padding: 2px;background-color:#2196f3;color:white;border-radius:3px;'>Type: ".gettype($item).", ".count($item)." Element(s)</div>";
					$str = $str.owndd($item);
					$str = $str."</div>";
				}
			}
			else if(is_object($item)){
				$str = $str."<div style='padding:10px;border:1px solid #d0d0d0;border-radius:3px;'>";
				$str = $str."<div style='padding: 2px;background-color:#2196f3;color:white;border-radius:3px;'>Type: ".gettype($item)."</div>";
				$str = $str."<div style='padding: 10px 0;'>Object Vars:</div> <div style='padding:10px;border:1px solid #d0d0d0;border-radius:3px;'>";
				$str = $str.owndd(get_object_vars($item));
				$str = $str."</div></div>";
			}
			else if(is_null($item)){
				$str = $str."<div style='padding:10px;border:1px solid #d0d0d0;border-radius:3px;'>";
				$str = $str."<div style='padding: 2px;background-color:#2196f3;color:white;border-radius:3px;'>Value: ".gettype($item)."</div>";
				$str = $str."</div>";
			}
			else if(is_bool($item)){
				if($item){$item = 'true';}else {$item = 'false';}
				$str = $str.'<div style="padding:10px;border:1px solid #d0d0d0;border-radius:3px;">Type: Boolen<br/> Value: '.$item.'</div>';
			}
			else {
				$str = $str.'<div style="padding:10px;border:1px solid #d0d0d0;border-radius:3px;">Type: '.gettype($item).'<br/> Value: '.$item.'</div>';
			}
			$data = $data.$str;
		}
		return $data;
        
    }
}
?>