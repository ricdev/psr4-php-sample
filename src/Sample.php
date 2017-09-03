<?php namespace App;

use Ibuffer\Faceplusplus\Facepp;

class Sample
{

	public function func()
	{
		return self::sample();
		//return true;
	}

	public function sample()
	{

		$api_key = '9cf1a493e16bb41b41123c09a34406e7';
		$api_secret = 'Bqhz3DkezstuPl-WnGRkX-BxRZLgKDl2';
		$facepp = new facepp($api_key, $api_secret);
		$params = array(
		    'url'          =>   'http://www.returnofkings.com/wp-content/uploads/2015/06/Kate-Upton-St.-Joseph-MI-667x1001.jpg',
		    'attribute'    =>   'gender,age,race,smiling,glass,pose'
		);
		$response = $facepp->execute('/detection/detect',$params);

		return $response;
	}

}