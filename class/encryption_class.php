<?php
/*
2-Way Encryption Scheme
Created By	: Mahipal Adhikari
Created On	: 13-August-2010
Abstract: Ultra secure 2-way encryption for Linux & Unix.
Disclaimer: This algorithm has been tested against several types of partial knowledge, statistical and brute force attacks; however, I do not claim that this is an unbreakable encryption scheme and as such do not recommend using this in mission critical applications.
Bug Reports: Thanks to your feedback over the past 6 months I've been able to continue improving the algorithm, if you have any suggestions, questions or concerns feel free to shoot me an email.
*/
class EncryptDcrypt
{
	private $privateKey;
	private $publicKey;
	
	public function __construct()
	{
		$this->privateKey = 'ebcae1de98047a82831d218179e6a2a90917e484';
		$this->publicKey = 'b72435f3e7f4925c35edea8782415b71';
		
	}
 
	//Generates a 320 bit private key: The SHA-1 hash function is preformed on the UNIX epoch and an 	additional random 750 to 1000 bits of entropy generated by the /dev/urandom algorithm.
	public function genPrivateKey()
	{
		//$privateKey = //sha1(mktime().shell_exec('head -c '.mt_rand(750,1000).' < /dev/urandom'));
		return $this->privateKey;
	}

	//Generates a 256 bit public key: The MD5 hash function is performed on the UNIX epoch and an additional random amount of entropy from the /urandom function.
	function genPublicKey() {
		//$publicKey = //md5(mktime().shell_exec('head -c '.mt_rand(250,350).' < /dev/urandom'));
		return $this->publicKey;
	}

	//Returns an encrypted cipherstream provided plaintext and a private key.
	function encrypt($plainText) {   
		$textArray = str_split($plainText);    
		$shiftKeyArray = array();
		for($i=0;$i<ceil(sizeof($textArray)/40);$i++) array_push($shiftKeyArray,sha1($this->privateKey.$i.$this->publicKey));
		
		$cipherTextArray = array();
		for($i=0;$i<sizeof($textArray);$i++)
		{
			$cipherChar = ord($textArray[$i]) + ord($shiftKeyArray[$i]);
			$cipherChar -= floor($cipherChar/255)*255;
			$cipherTextArray[$i] = dechex($cipherChar);
		}
		
		unset($textarray);
		unset($shiftKeyArray);
		unset($cipherChar);
	 
		//$cipherStream = implode("",$cipherTextArray).":".$this->publicKey; //commented by Mahipal
		$cipherStream = implode("",$cipherTextArray); //added by Mahipal
		
		//unset($publicKey);
		unset($cipherTextArray);
		
		return $cipherStream;
	}

	//Returns plaintext given the cipherstream and the same private key used to make it.
	function decrypt($cipherStream) {
		
		//$cipherStreamArray = explode(":",$cipherStream); //commented by Mahipal
		
		$cipherText = $cipherStream; //added by Mahipal
		$publicKey = $this->publicKey; //added by Mahipal
		
		unset($cipherStream);
		
		//$cipherText = $cipherStreamArray[0];//commented by Mahipal
		//$publicKey = $cipherStreamArray[1];//commented by Mahipal
		//unset($cipherStreamArray);//commented by Mahipal
		
		$cipherTextArray = array();
		for($i=0;$i<strlen($cipherText);$i+=2) array_push($cipherTextArray,substr($cipherText,$i,2));
		unset($cipherText);
		
		$shiftKeyArray = array();
		for($i=0;$i<ceil(sizeof($cipherTextArray)/40);$i++) array_push($shiftKeyArray,sha1($this->privateKey.$i.$publicKey));
		//unset($privateKey);
		unset($publicKey);
		
		$plainChar = null;
		$plainTextArray = array();
		for($i=0;$i<sizeof($cipherTextArray);$i++)
		{
			$plainChar = hexdec($cipherTextArray[$i]) - ord($shiftKeyArray[$i]);
			$plainChar -= floor($plainChar/255)*255;
			$plainTextArray[$i] = chr($plainChar);
		}
		
		unset($cipherTextArray);
		unset($shiftKeyArray);
		unset($plainChar);
	 
		$plainText = implode("",$plainTextArray);
		return $plainText;
	}
	
	function random_password($length)
	{
		$rstr = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$nstr = "";
		mt_srand ((double) microtime() * 1000000);
		while(strlen($nstr) < $length)
		{
			$random = mt_rand(0,(strlen($rstr)-1));
			$nstr .= $rstr{$random};
		}
		return($nstr);
	}
}
?>