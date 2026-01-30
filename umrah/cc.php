<?php
class GoogleCurrencyConverter
{
	// GOOGLE URL
	CONST GOOGLE_URL = "http://finance.google.com/finance/converter?a=%d&from=%s&to=%s";
	/*
	Fetch with CURL
	params: amount, 3 Digit Currency Code From,3 Digit Currency Code to
	*/
	private function load($a,$from,$to)
	{
		$ch = curl_init ();
			  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			  curl_setopt($ch, CURLOPT_URL, sprintf(self::GOOGLE_URL,$a,$from,$to));
			  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			  $response = curl_exec($ch);
			  curl_close($ch);
		return $response;
	}
	/*
	Try to Convert
	params: amount, 3 Digit Currency Code From,3 Digit Currency Code to
	*/
	public static function convert($a,$from,$to)
	{
		$response = self::load($a,$from,$to);
		$return_value = false;
		if($response) {
			if (preg_match('%<tds+.*?id="currency_converter_result"s+.*?>(.*?)</td>%s', $response, $matches)) {
				$response = $matches[1];
				$response = str_replace('&nbsp;', ' ', $response);
			}
			$pattern = "%([d|.]+)s+$froms+=s+<spansclass=([^>]*)>([d|.]+)s+$tos*</span>%s";
			if (preg_match($pattern, $response, $matches)) {
				$return_value = $matches[3];
			}
		}
		return $return_value;
	}
}


$rate = GoogleCurrencyConverter::convert(1,'EUR','USD');
if($rate) {
	echo '1 Euro equivalent to '.number_format($rate,4).' Rupiah';
} else {
	echo 'Cant process the conversion';
}


?>
