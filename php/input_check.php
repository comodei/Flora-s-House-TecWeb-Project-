<?php
/*
 * Classe che implementa sicurezza sull'input
 */

class input_check{
    /* Controllo sul codice fiscale */
    public static function cf_check($field){
        if (preg_match("^[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]$^", $field)==1){ 
            return true;
        }
        return false;
    }
	
	public static function date_check($field){
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $field)==1) { //preg_match data
            return true;
        }
        return false;
    }
	
	public static function check_nome($nome){
	    if(strlen($nome)==0){
			return false;
		}
        if(preg_match('/^([\p{L}\s]*)$/u',$nome)==1){
            return true;
        }
        return false;
    }
	
	public static function check_pwd($password){
        if(preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/',$password)==1){
            return true;
        }
        return false;
    }
	
	public static function check_email($email){
        if(preg_match('/^([\w\-\+\.]+)\@([\w\-\+\.]+)\.([\w\-\+\.]+)$/',$email)==1){
            if (filter_var($email, FILTER_VALIDATE_EMAIL)){
				return true;
			}
        }
        return false;
    }
	public static function check_card($card){
		if(preg_match('^(?:4[0-9]{12}(?:[0-9]{3})?|[25][1-7][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$^',$card)==1){
            return true;
        }
        return false;		
	}
	public static function check_num($num){
		
		if(preg_match('^(\((00|\+)39\)|(00|\+)39)?(38[890]|34[7-90]|36[680]|33[3-90]|32[89])\d{7}$^',$num)==1){
            return true;
        }
       return false;
		
	}

}



?>