<?php ini_set('max_execution_time', 300); //300 seconds = 5 minutes
$needle='sizeer';

if( !empty($_GET['action']) AND ($_GET['action']=='do')) {

	$baseURL='http://www.mammarzenie.org';
	$offset=0;
	$offsetIncrement=30;
	$maxOffset=200000;
	$doIterate=true;
	$sponsored=array();

	while($doIterate) {

		$html=file_get_contents($baseURL . '/marzyciele/spelnione/oddzial/caly-kraj/?offset='. $offset . '&wish=6&wish_year=');
		$html=str_replace('&nbsp;', '', $html);
		$html=str_replace('&', '&amp;', $html);
		$html=preg_replace('#(.*?)<div id="main-content">#is', '', $html);
		$html=preg_replace('#<!(.*?)</html>#is', '', $html);
		$html=preg_replace('#<form>(.*?)</form>#is', '', $html);
		$html=preg_replace('#<div id="title">(.*?)</div>#is', '', $html);
		/*$html = preg_replace('#<div class="marzenie">(.*?)</div>#is', '', $html);
		$html = preg_replace('#<div class="name_surname">(.*?)</div>#is', '', $html);
		$html = preg_replace('#<div class="info">(.*?)</div>#is', '', $html);
		$html = preg_replace('#<img(.*?)/>#is', '', $html);
		$html = preg_replace('#<!(.*?)>#is', '', $html);*/
		$html=preg_replace('#style="(.*?)"#is', '', $html);

		$html=trim($html);
		//print ':' . $html . ':';

		$xml=simplexml_load_string($html);
		$json=json_encode($xml);
		$array=json_decode($json, TRUE);

		if( !is_array($array['div'])) {

			$doIterate=false;
			//			print 'pusto';
			continue;

		}

		if( !is_array($array['div']['0'])) {

			$tmpArray=$array['div'];
			$array['div']=array();
			$array['div'][]=$tmpArray;

		}

		//		print_r($array);

		foreach ($array['div'] as $container) {
			if($container['@attributes']['class']=='box-marzyciel') {
				if(array_key_exists('0', $container['div'])) {
					if($container['div']['0']['@attributes']['class']=='info') {
						unset($array[0]);
						if($container['div']['1']['@attributes']['class']=='sponsors') {
							if( !is_array($container['div']['1']['a'])) {
								$tmpArray=$container['div']['a'];
								$container['div']['a']=array();
								$container['div']['a'][]=$tmpArray;
							}
							$record=array();
							if(array_key_exists('a', $container['div']['0'])) {
								$record['link']=$baseURL . $container['div']['0']['a']['@attributes']['href'];
							}
							else {
								$record['link']=$baseURL . $container['div']['a']['@attributes']['href'];
							}
							$addRecord=false;
							if(array_key_exists('a', $container['div']['1'])) {
								foreach($container['div']['1']['a'] as $sponsor) {
									if(array_key_exists('@attributes', $sponsor)) {
										if(array_key_exists('href', $sponsor['@attributes'])) {
											if (strpos($sponsor['@attributes']['href'], $needle) !==false) {
												$addRecord=true;
											}
											if($addRecord) {
												$record['sponsor'][]=$sponsor['@attributes']['href'];
												$record['description']=getDescription($record['link']);
												$record['name']=$container['div']['0']['a']['div'];
												$record['titleName']=$container['div']['0']['div'];
												$record['wish']=getWish($record['link']);
												$record['wishDay']=getWishDay($record['link']);
												if(array_key_exists('src', $container['a']['img']['@attributes'])) {
													$record['avatar']=getAvatar($container['a']['img']['@attributes']['src']);
												}
												$record['gallery']=getGallery($record['link']);
												$sponsored[]=$record;
											}
										}
									}
									else {
										// $tmpArray = $sponsor['href'];
										// $container['div']['1']['a'] = array();
										// $container['div']['1']['a']['@attributes'][] = $tmpArray;
										if(array_key_exists('href', $sponsor)) {
											if (strpos($sponsor['href'], $needle) !==false) {
												$addRecord=true;
											}
											if($addRecord) {
												$record['sponsor'][]=$sponsor['href'];
												$record['description']=getDescription($record['link']);
												$record['gallery']=getGallery($record['link']);
												echo '<pre style="background: green;">';
												print_r($container['div']['0']['a']['div']);
												echo '</pre>';
												$record['name']=$container['div']['0']['a']['div'];
												$record['titleName']=$container['div']['0']['div'];
												$record['wish']=getWish($record['link']);
												$record['wishDay']=getWishDay($record['link']);
												if(array_key_exists('src', $container['a']['img']['@attributes'])) {
													$record['avatar']=getAvatar($container['a']['img']['@attributes']['src']);
												}
												$sponsored[]=$record;
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
		/* end foreach loop */
		echo '<pre>';
		print_r($sponsored);
		echo '</pre><hr/>';
		$offset+=$offsetIncrement;
		if($offset > $maxOffset) {
			$doIterate=false;
		}
		//		print $offset . ':';
		$fp=fopen("baza_mammarzenie.json", "w+");
		fputs($fp, trim(json_encode($sponsored)));
		fclose($fp);
	}
}
else {
	$html=file_get_contents('http://emesit.vot.pl/stub.html');
	$dom=new DOMDocument;
	$dom->loadXML($html);
	print $dom->saveHTML();
}
function getAvatar($profileAvatar) {
	$output=substr($profileAvatar, strpos($profileAvatar, '=')+1);
	$output=substr($output, 0, strpos($output, '&'));
	return $output;
}
function getWish($profileURL) {
	$html=file_get_contents($profileURL);
	$html=trim($html);
	$output=str_replace("\n\n", "\n", strip_tags($html));
	$output=substr($output, strpos($output, '-')+2);
	$output=substr($output, 0, strpos($output, '|')-1);
	return $output;
}
function getDescription($profileURL) {
	$html=file_get_contents($profileURL);
	$html=str_replace('&nbsp;', '', $html);
	$html=str_replace('&oacute;', 'ó', $html);
	$html=preg_replace('#(.*?)<div class="report">#is', '', $html);
	$html=preg_replace('#</div>(.*?)</html>#is', '', $html);
	$html=preg_replace('#<!(.*?)>#is', '', $html);
	$html=preg_replace('#<style>(.*?)</style>#is', '', $html);
	$html=preg_replace('#<xml>(.*?)</xml>#is', '', $html);
	$html=trim($html);
	$output=str_replace("\n\n", "\n", strip_tags($html));
	return $output;
}

function getWishDay($profileURL){
	
$output = array();
$html=file_get_contents($profileURL);

$doc = new DOMDocument;
$doc->loadHTML($html);
$xpath = new DOMXpath($doc);
$nodeList = $xpath->query( '//table[@class="spotkania"]');
foreach($nodeList as $node)
{
	$output[] = $node->childNodes[1];

    //echo trim($node->textContent);
}
return $output;
}

function getGallery($profileURL){
	$gallery = array();
	$output = array();
$html=file_get_contents($profileURL);
preg_match_all("'<div class=\"photo\">(.*?)</div>'si", $html, $gallery);

 	$doc = new DOMDocument();
	$doc->loadHTML($html);
	$classname="photo";
 $finder = new DomXPath($doc);
	$imageTags = $finder->query("//*[contains(@class, '$classname')]");
	
	//$imageTags = $doc->getElementsByClassName('photo');
	

    foreach($imageTags as $item) {
		$href =  $item->lastChild->attributes[0]->value;
		array_push($output,$href);
		//print_r($item->getAtrr);
	}
	
	return $output;

// foreach($gallery[0] as $item){
// preg_match('<img[^>]+src="([^">]+)"',$html, $newArray);
// }
	 

// 	 print_r($newArray);
	// $html=str_replace('&oacute;', 'ó', $html);
	// $html=preg_replace('#(.*?)<div id="left-sidebar">#is', '', $html);
	// $html=preg_replace('#(.*?)<div class="vertical event-image">#s', '', $html);
	
	//$html=preg_replace('#</div>(.*?)</html>#is', '', $html);
		//echo $html;
	// $html=preg_replace('#<!(.*?)>#is', '', $html);
	// $html=preg_replace('#<style>(.*?)</style>#is', '', $html);
	// $html=preg_replace('#<xml>(.*?)</xml>#is', '', $html);
	
// foreach($gallery[0] as $item){
// 	//preg_match('/<a\s+href=["\']([^"\']+)["\']/i');
// 	array_push($output,$item);

// }

	// $html=trim($html);
	// $output=str_replace("\n\n", "\n", strip_tags($html));
}