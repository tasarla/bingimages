<?php
header("Content-type: text/html; charset=UTF-8");

$baslik = "Turkey";
$baslik = rawurlencode($baslik);

$ch = curl_init();
$url = "https://www.bing.com/images/search?q=$baslik&first=1";

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if ($response === false) {
    echo 'Hata: ' . curl_error($ch);
} else {
    // Web sayfasının içeriğini aldık, şimdi resim etiketlerini çıkarabiliriz.
    
    // Resim etiketlerini bulup ekrana yazdıralım
    preg_match_all('/<img[^>]+src=["\']([^"\']+)["\']/i', $response, $matches);
    
    // İlk 10 resmi görüntüleyelim
    $counter = 0;
    foreach ($matches[1] as $imageURL) {
        if ($counter >= 10) {
            break; // İlk 10 resmi aldık, döngüyü durdur.
        }
        echo '<img src="' . $imageURL . '" alt="Resim ' . ($counter + 1) . '">';
       $resim=str_replace("//","https://","$imageURL");
       $resim = trim(html_entity_decode($resim));
       echo "<br/>$resim <br/>";
        $counter++;
    }
}

curl_close($ch);
?>
