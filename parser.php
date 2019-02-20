<?php include('simple_html_dom.php');

//ini_set('max_execution_time', 60); //300 seconds = 5 minutes
//ini_set('error_reporting', E_ALL);
  //  ini_set('display_errors', 1);
$needle='sizeer';

$baseURL='http://www.mammarzenie.org';
$offset=0;
$offsetIncrement=30;
$maxOffset=7000;
$doIterate=true;
$sponsored=array();

while($doIterate) {
$curl=curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_URL, $baseURL . '/marzyciele/spelnione/oddzial/caly-kraj/?offset='. $offset . '&wish=6');
    curl_setopt($curl, CURLOPT_REFERER, $baseURL . '/marzyciele/spelnione/oddzial/caly-kraj/?offset='. $offset . '&wish=6');
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.125 Safari/533.4");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    $str=curl_exec($curl);
    curl_close($curl);

    $html=new simple_html_dom();
    // Load HTML from a string
    $html->load($str);


    foreach($html->find('div.box-marzyciel') as $dreamer) {
        foreach($dreamer->find('div.sponsors') as $sponsor) {
            $a=$sponsor->childNodes(0);
            //echo $a->href.'<br/>';
            $a=$a->href;

            if(strpos($a, $needle) !==false) {
                $sponsored[]=$dreamer;
            }

        }
    }

    $offset+=$offsetIncrement;

    if($offset > $maxOffset) {
        $doIterate=false;
    }
}

 echo '<pre>';
 //print_r($sponsored);
 echo '</pre>';

foreach($sponsored as $dreamer) {
    $record['link']=getLink($dreamer);
    $record['name']=getName($dreamer);
    $record['wish']=getWish($dreamer);
$record['avatar']=getAvatar($dreamer);
    $record['description']=getDescription($record['link']);
    $record['wishday'] = getWishDay($record['link']);
    $record['gallery'] = getGallery($record['link']);


    $dreamers[]=$record;

}

// echo '<pre>';
 //print_r($dreamers);
 //echo '</pre>';

	$fp=fopen("baza_mammarzenie.json", "w+");
		fputs($fp, trim(json_encode($dreamers)));
		fclose($fp);


function getDescription($profileURL) {
    $curl=curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_URL, 'http://www.mammarzenie.org'. $profileURL);
    curl_setopt($curl, CURLOPT_REFERER, 'http://www.mammarzenie.org'. $profileURL);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.125 Safari/533.4");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    $str=curl_exec($curl);
    curl_close($curl);

    $html=new simple_html_dom();
    // Load HTML from a string
    $html->load($str);

    foreach($html->find('div.report') as $el) {
        return $el->plaintext;
    }
}

function getWishDay($profileURL) {
     $curl=curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_URL, 'http://www.mammarzenie.org'. $profileURL);
    curl_setopt($curl, CURLOPT_REFERER, 'http://www.mammarzenie.org'. $profileURL);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.125 Safari/533.4");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    $str=curl_exec($curl);
    curl_close($curl);

    $html=new simple_html_dom();
    // Load HTML from a string
    $html->load($str);

   

    foreach($html->find('div.timeline') as $el) {
            return substr($el->children(1)->children(1)->children(1)->children(0)->plaintext,21);
    }
}

function getLink($profile) {
    return $profile->children(1)->children(0)->href;
}

function getName($profile) {
    return $profile->children(1)->children(0)->children(0)->innertext;
}

function getWish($profile) {
    return substr($profile->children(1)->children(1)->plaintext, 13);
}

function getAvatar($profileAvatar) {
    return 'http://www.mammarzenie.org'. $profileAvatar->children(0)->children(0)->src;
}

function getGallery($profileURL){
    $curl=curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_URL, 'http://www.mammarzenie.org'. $profileURL);
    curl_setopt($curl, CURLOPT_REFERER, 'http://www.mammarzenie.org'. $profileURL);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.125 Safari/533.4");
    $str=curl_exec($curl);
    curl_close($curl);

    $html=new simple_html_dom();
    // Load HTML from a string
    $html->load($str);
    $gallery = array();

    foreach($html->find('div#left-sidebar') as $container){

       foreach($container->find('div.slides') as $slides){
        foreach($slides->find('a') as $slide){
            $gallery[] = $slide->href;
        }
       }
            
        
    }
    return $gallery;
}
?>