<?php

function sitemapGen(array $news){
$dom = new DOMDocument("1.0", "UTF-8");
$urlset = $dom->createElement("urlset");

$xmlns = $dom->createAttribute('xmlns');
$xmlnsxsi= $dom->CreateAttribute('xmlns:xsi');
$xsi= $dom->createAttribute('xsi:schemaLocation');
$xsimage = $dom->createAttribute('xmlns:image');



$xmlns->value="http://www.sitemaps.org/schemas/sitemap/0.9";
$xmlnsxsi->value="http://www.w3.org/2001/XMLSchema-instance";
$xsimage->value="http://www.google.com/schemas/sitemap-image/1.1";
$xsi->value="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd";
			
$urlset->appendChild($xmlns);
$urlset->appendChild($xmlnsxsi);
$urlset->appendChild($xsimage);
$urlset->appendChild($xsi);

$url = $dom->createElement('url');
$loc = $dom->createElement('loc', 'http://scimmiettapsicopatica.altervista.org');
$lastmod = $dom->createElement('lastmod', date('Y-m-d'));
$priority = $dom->createElement('priority', '1.00');
$image= $dom->createElement('image:image');
$imageloc= $dom->createElement('image:loc', 'http://scimmiettapsicopatica.altervista.org/images/titolo_tramonto.jpg');
$imagecaption=$dom->createElement('image:caption');
$imagecaption->appendChild($dom->createCDATASection('Scimmietta pSiCoPaTiCa - titolo'));


$urlset->appendChild($url);
$url->appendChild($loc);
$url->appendChild($lastmod);
$url->appendChild($priority);
$url->appendChild($image);
$image->appendChild($imageloc);
$image->appendChild($imagecaption);

foreach($news as $articolo){
	$url = $dom->createElement('url');
	$loc = $dom->createElement('loc', 'http://scimmiettapsicopatica.altervista.org/'.$articolo['url']);
	$lastmod = $dom->createElement('lastmod', date('Y-m-d', strtotime($articolo['create_at'])));
	$priority = $dom->createElement('priority', '0.80');
	if($articolo['immagini']){
		$image= $dom->createElement('image:image');
		$imageloc= $dom->createElement('image:loc', 'http://scimmiettapsicopatica.altervista.org/images/'.$articolo['immagini']);
		$imagecaption=$dom->createElement('image:caption');
		$imagecaption->appendChild($dom->createCDATASection($articolo['titolo']));
	}
	$urlset->appendChild($url);
	$url->appendChild($loc);
	$url->appendChild($lastmod);
	$url->appendChild($priority);
	if($articolo['immagini']){
		$url->appendChild($image);
		$image->appendChild($imageloc);
		$image->appendChild($imagecaption);
	}
}




$dom->appendChild($urlset);
$dom->formatOutput=true;
 $dom->save('sitemap.xml');
 

}

