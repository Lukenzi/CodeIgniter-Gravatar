<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
* Gravatar třída pro CodeIgniter
*
* @author Lukenzi <lukenzi@gmail.com>
* @package Codeigniter
* @subpackage Gravatar
*
*/

class Gravatar{



	// Emailová adresa uživatele
	private $user_email = '';

	// Zabezpečená URL adresa pro vygenerování gravataru
	private $g_url      = 'https://secure.gravatar.com/avatar/';

	// Velikost gravataru v pixelech (max 2048)
	private $g_size     = 80;

	// Výchozí typ gravataru, pokud není obrázek (404, mm, identicon, monsterid, wavatar)
	private $g_default  = 'mm';

	// Výchozí hodnocení obrázku gravataru (g, pg, r, x)
	private $g_rating   = 'g';

	// Vratí pouze URL adresu a nikoliv celý HTML tag
	private $g_img      = FALSE;

	// Chybová zpráva
	private $error      = '';



	// -----------------------------------------------------------------



	/** Inicializace třídy
	 *
	 * @param string Emailová adresa
	 * @return void
	 */
	public function __construct($email = false){
		if($email != false){
			if($this->_CheckEmail($email)){
				$this->user_email = trim(strtolower($email));
			}else{
				$this->error = 'Emailová adresa není zadaná ve správném tvaru!';
			}
		}
	}



	/** Nastavení emailové adresy
	 *
	 * @param string Emailová adresa
	 * @return void
	 */
	public function SetEmail($email){
		if($this->_CheckEmail($email)){
				$this->user_email = trim(strtolower($email));
		}else{
				$this->error = 'Emailová adresa nební zadaná ve správném tvaru!';
		}
	}



	/** Nastavení velikosti vráceného gravataru (max 2048px)
	 *
	 * @param int Velikost v pixelech
	 * @return void
	 */
	public function SetSize($size){
		if(!is_numeric($size)){
			$this->error = 'Je chybně zadaná velikost Gravataru!';
		}else{
			if($size > 2048){ $size = 2048; }

			$this->g_size = $size;
		}
	}



	/** Nastavení typu výchozího gravataru pokud nemá uživatel nastaven obrázek
	 *
	 * @param string Typ výchozího gravataru (404, mm, identicon, monsterid, wavatar)
	 * @return void
	 */
	public function SetType($type){
		if(!is_string($type)){
			$this->error = 'Je chybně zadán typ výchozího gravataru!';
		}else{
			if(!in_array($type, array('404', 'mm', 'identicon', 'monsterid', 'wavatar'))){
				$this->error = 'Zadaný typ výchozího gravataru neexistuje!';
			}else{
				$this->g_default = trim(strtolower($type));
			}
		}
	}



	/** Nastavení hodnocení uživatelem nahraného obrázku
	 *
	 * @param string Hodnocení (g, pg, r, x)
	 * @return void
	 */
	public function SetRating($rating){
		if(!is_string($rating)){
			$this->error = 'Je chybně zadáno hodnocení vašeho gravataru!';
		}else{
			if(!in_array($rating, array('g', 'pg', 'r', 'x'))){
				$this->error = 'Zadané hodnocení neexistuje!';
			}else{
				$this->g_rating = trim(strtolower($rating));
			}
		}
	}



	/** Vrátí URL adresu k vygenerovanému gravataru
	 *
	 * @return string URL adresa k obrázku gravataru
	 */
	public function GetUrl(){
		if(!empty($this->error)){
			return false;
		}else{
			$result = $this->g_url.md5($this->user_email).'?s='.$this->g_size.'&d='.$this->g_default.'&r='.$this->g_rating;
			return $result;
		}
	}



	/** Vrátí kompletní HTML tag pro obrázek gravataru (obsahuje CSS třídu "gravatar")
	 *
	 * @return string HTML tag obrázku gravataru i s URL adresou
	 */
	public function GetImage(){
		if(!empty($this->error)){
			return false;
		}else{
			$result = '<img src="'.$this->GetUrl().'" width="'.$this->g_size.'" height="'.$this->g_size.'" class="gravatar">';
			return $result;
		}
	}



	/** Vrátí případnou chybovou zprávu, jinak prázdný string
	 *
	 * @return string Chybová zpráva
	 */
	public function GetError(){
		if(!empty($this->error)){
			return $this->error;
		}else{
			return '';
		}
	}



	/** Kontrola správnosti emailové adresy
	 *
	 * @param string Emailová adresa
	 * @return bool Zda je platná nebo ne
	 */
	private function _CheckEmail($email){
		return preg_match('#^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$#i', $email);

		//if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ return false; }else{ return true; }
	}



}

/* End of file Gravatar.php */
/* Location: ./application/libraries/Gravatar.php */
