<?php
$baseURL='http://www.mammarzenie.org';
$offset=0;

$html=file_get_contents($baseURL . '/marzyciele/spelnione/oddzial/caly-kraj/?offset='. $offset . '&wish=6&wish_year=');
$html=str_replace('&nbsp;', '', $html);
		$html=str_replace('&', '&amp;', $html);
		$html=preg_replace('#(.*?)<div id="main-content">#is', '', $html);
print_r($html);

//match movie title 
          preg_match_all('!<a href="\/title\/.*?\/\?ref_=adv_li_tt"\n>(.*?)<\/a>!',$result,$match);
?>