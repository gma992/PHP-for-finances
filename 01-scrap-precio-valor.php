<?php

/* CURL */
function curl($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}

/* SCRAPED DATA IN BETWEEN STARTPOINT AND ENDPOINT */
function scrapeBetween($data, $start, $end){
	$data = stristr($data, $start); //strips everything before $start
	$data = substr($data, strlen($start)); //strips $start
	$stop = stripos($data, $end); //gets the position of $end
	$data = substr($data, 0, $stop); // strips all the data after
	echo $data;
}

/* SINGLE ITEM SCRAPPING */
$ticker = 'ko';
$scrapedPage = curl("http://finance.yahoo.com/q?s=$ticker");
$scrapedData = scrapeBetween($scrapedPage, "<title>","</title>");
$scrapedTickerPrice = scrapeBetween($scrapedPage, '<span class="time_rtq_ticker">','</span>');
$scrapedTickerTime = scrapeBetween($scrapedPage, '<span class="time_rtq">','</span>');
echo $scrapedData;
echo $scrapedTickerPrice;
echo $scrapedTickerTime;
