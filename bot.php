<?php
/*
copyright @WikiBot OA
Developed @Maxi Aditya
2017

*/

require_once('./line_class.php');
require_once('./unirest-php-master/src/Unirest.php');

$channelAccessToken = 'jenIJuMCEovzgp46ZDWb1/+SnDdOHtbgOQe5hHRXoB7OYslDwAMm5uxMxaxRpTc32eF9yIJcuYdJ4nhyVqi2UQP3MrfAP4pR0tq2724iYdlZLvYXibHKp8rQof0hLB0IPLU2/BlBXdD3o65BiiZ00gdB04t89/1O/w1cDnyilFU='; //sesuaikan 
$channelSecret = '2f03581fe23f7b29687a9a3ffa5166c1';//sesuaikan

$client = new LINEBotTiny($channelAccessToken, $channelSecret);

$userId 	= $client->parseEvents()[0]['source']['userId'];
$groupId 	= $client->parseEvents()[0]['source']['groupId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$timestamp	= $client->parseEvents()[0]['timestamp'];
$type 		= $client->parseEvents()[0]['type'];

$message 	= $client->parseEvents()[0]['message'];
$messageid 	= $client->parseEvents()[0]['message']['id'];

$profil = $client->profil($userId);

$say_datang = explode(" ", $message['text']);
$pesan_datang = explode(" ", $message['text']);
$command_datang = $message['text'];

$command = $pesan_datang[0];
$options = $pesan_datang[1];
$say     = $say_datang[1];

if (count($say_datang) > 2) {
    for ($i = 2; $i < count($say_datang); $i++) {
        $say .= ' ';
        $say .= $say_datang[$i];
    }
}

if (count($pesan_datang) > 2) {
    for ($i = 2; $i < count($pesan_datang); $i++) {
        $options .= '+';
        $options .= $pesan_datang[$i];
    }
}
function anime_syn($title) {
    $parsed = anime($title);
    $result = "Judul : " . $parsed['title'];
    $result .= "\n\nSynopsis :\n" . $parsed['synopsis'];
    return $result;
}
function send($input, $rt){
    $send = array(
        'replyToken' => $rt,
        'messages' => array(
            array(
                'type' => 'text',					
                'text' => $input
            )
        )
    );
    return($send);
}
function jawabs(){
    $list_jwb = array(
		'Ya',
		'Tentu Iya',	    
		'Tidak',
		'Tentu Tidak',	    
		'Bisa jadi',
		'Mungkin',
		'Coba tanya lagi',    
		'Coba sekali lagi'
		);
    $jaws = array_rand($list_jwb);
    $jawab = $list_jwb[$jaws];
    return($jawab);
}

function dosa($keyword){
    $list_jwb = array(
    		'Dosanya si '. $keyword .' sebesar 0%
Sangad M U S T A H Y L :D',
		'Dosanya si '. $keyword .' sebesar 10%
Baguslah dia masih polos :D',
		'Dosanya si '. $keyword .' sebesar 15%
Baguslah dia masih polos :D',
		'Dosanya si '. $keyword .' sebesar 20%
Masih bersih dari Dosa :D',
		'Dosanya si '. $keyword .' sebesar 25%
Masih bersih dari Dosa :D',
		'Dosanya si '. $keyword .' sebesar 30%
Sering sering jaga iman ya :)',
		'Dosanya si '. $keyword .' sebesar 35%
Sering sering jaga iman ya :)',
		'Dosanya si '. $keyword .' sebesar 40%
Si '. $keyword .' Sering barbuat dosa yaa :(',
		'Dosanya si '. $keyword .' sebesar 45%
Si '. $keyword .' Sering barbuat dosa yaa :(',
		'Dosanya si '. $keyword .' sebesar 50%
Si '. $keyword .' Harus rajin beribadah dan memohon ampunan tuh',
		'Dosanya si '. $keyword .' sebesar 55%
Si '. $keyword .' Harus rajin beribadah dan memohon ampunan tuh',
		'Dosanya si '. $keyword .' sebesar 60%
Cepat cepat tobat kak',
		'Dosanya si '. $keyword .' sebesar 65%
Cepat cepat tobat kak',
		'Dosanya si '. $keyword .' sebesar 70%
Tobat sekarang kak!',
		'Dosanya si '. $keyword .' sebesar 75%
Tobat sekarang kak!',
		'Dosanya si '. $keyword .' sebesar 80%
Dosanya si '. $keyword .' Sudah melampaui batas',
		'Dosanya si '. $keyword .' sebesar 85%
Dosanya si '. $keyword .' Sudah melampaui batas',
		'Dosanya si '. $keyword .' sebesar 90%
CEPAT MENJAUH dari si '. $keyword .' BANYAK DOSA!',
		'Dosanya si '. $keyword .' sebesar 95%
CEPAT MENJAUH dari si '. $keyword .' nanti dosanya ketularan!',
        'Dosanya si '. $keyword .' sebesar 100%
Sudah tidak dipungkiri lagi, Si '. $keyword .' sudah tak terampuni'
		);
    $jaws = array_rand($list_jwb);
    $jawab = $list_jwb[$jaws];
    return($jawab);
}
function anime($keyword) {

    $fullurl = 'https://myanimelist.net/api/anime/search.xml?q=' . $keyword;
    $username = 'jamal3213';
    $password = 'FZQYeZ6CE9is';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_URL, $fullurl);

    $returned = curl_exec($ch);
    $xml = new SimpleXMLElement($returned);
    $parsed = array();

    $parsed['id'] = (string) $xml->entry[0]->id;
    $parsed['image'] = (string) $xml->entry[0]->image;
    $parsed['title'] = (string) $xml->entry[0]->title;
    $parsed['desc'] = "Episode : ";
    $parsed['desc'] .= $xml->entry[0]->episodes;
    $parsed['desc'] .= "\nNilai : ";
    $parsed['desc'] .= $xml->entry[0]->score;
    $parsed['desc'] .= "\nTipe : ";
    $parsed['desc'] .= $xml->entry[0]->type;
    $parsed['synopsis'] = str_replace("<br />", "\n", html_entity_decode((string) $xml->entry[0]->synopsis, ENT_QUOTES | ENT_XHTML, 'UTF-8'));
    return $parsed;
}
#-------------------------[Fungsi YT CONVERTER]-------------------------#
function videolihat($keyword) {
    $uri = "https://www.saveitoffline.com/process/?url=" . $keyword . '&type=json';

    $response = Unirest\Request::get("$uri");


    $json = json_decode($response->raw_body, true);
	$result['video'] .= $json['urls'][0]['id'];
	$result['thumbnail'] .= "https://img.youtube.com/vi/' . $keyword . '/2.jpg";
	
    return $result;
}
function saveitoffline($keyword) {
    $uri = "https://www.saveitoffline.com/process/?url=" . $keyword . '&type=json';

    $response = Unirest\Request::get("$uri");


    $json = json_decode($response->raw_body, true);
    $result .= "Judul : ";
	$result .= $json['title'];
	$result .= "\n\nUkuran : ";
	$result .= $json['urls'][0]['label'];
	$result .= "\nURL Download : ";
	$result .= $json['urls'][0]['id'];
	$result .= "\n\nUkuran : ";
	$result .= $json['urls'][1]['label'];
	$result .= "\nURL Download : ";
	$result .= $json['urls'][1]['id'];
	$result .= "\n\nUkuran : ";
	$result .= $json['urls'][2]['label'];
	$result .= "\nURL Download : ";
	$result .= $json['urls'][2]['id'];
	$result .= "\n\nUkuran : ";
	$result .= $json['urls'][3]['label'];
	$result .= "\nURL Download : ";
	$result .= $json['urls'][3]['id'];	
    return $result;
}
function convertbeta($keyword) {
    $uri = "https://www.saveitoffline.com/process/?url=" . $keyword . '&type=json';

    $response = Unirest\Request::get("$uri");


    $json = json_decode($response->raw_body, true);
    $result['konpert'] .= $keyword;
	$result['judul'] .= $json['title'];
	$result['uk1'] .= $json['urls'][0]['label'];
	$result['url1'] .= $json['urls'][0]['id'];
	$result['uk2'] .= $json['urls'][1]['label'];
	$result['url2'] .= $json['urls'][1]['id'];
	$result['uk3'] .= $json['urls'][2]['label'];
	$result['url3'] .= $json['urls'][2]['id'];
	$result['uk4'] .= $json['urls'][3]['label'];
	$result['url4'] .= $json['urls'][3]['id'];	
    return $result;
}
#-------------------------[Fungsi MUSIK]-------------------------#
function musik($keyword) { 
    $uri = "http://ide.fdlrcn.com/workspace/yumi-apis/joox?songname=" . $keyword . ""; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
    $result['judul'] .= $json['0']['0'];
    $result['durasi'] .= $json['0']['1'];
    $result['donlod'] .= $json['0']['4'];
    return $result; 
}
function denger($keyword) { 
    $uri = "http://ide.fdlrcn.com/workspace/yumi-apis/joox?songname=" . $keyword . ""; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
    $result['durasi'] .= $json['0']['2'];
    $result['musik'] .= $json['0']['3'];
    return $result; 
}
function musikbiasa($keyword) { 
    $uri = "http://ide.fdlrcn.com/workspace/yumi-apis/joox?songname=" . $keyword . ""; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
    $result .= "Judul lagu : ";
    $result .= $json['0']['0'];
    $result .= "\nDurasi : ";
    $result .= $json['0']['1'];
    $result .= "\nLink Download : ";
    $result .= $json['0']['4'];
    return $result; 
}
#-------------------------[Fungsi LIRIK]-------------------------#
function lirik($keyword) { 
    $uri = "http://ide.fdlrcn.com/workspace/yumi-apis/joox?songname=" . $keyword . ""; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
    $result .= "Judul lagu : ";
    $result .= $json['0']['0'];
    $result .= "\nDurasi : ";
    $result .= $json['0']['1'];
    $result .= "\nLirik :\n";
    $result .= $json['0']['5'];
    return $result; 
}
#-------------------------[Fungsi GUGEL PELAY SETORE]-------------------------#
function ps($keyword) { 
    $uri = "https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20171227T171852Z.fda4bd604c7bf41f.f939237fb5f802608e9fdae4c11d9dbdda94a0b5&text=" . $keyword . "&lang=id-id"; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
    $result .= "Title: ";
    $result .= $json['text']['0'];
    $result .= "\nSource: Google Play Store";
    $result .= "\nLink: ";
    $result .= "https://play.google.com/store/search?q=" . $keyword . "";
    return $result; 
}
#-------------------------[Fungsi GNTPW]-------------------------#
function lokasi($keyword) { 
    $uri = "https://time.siswadi.com/pray/" . $keyword; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
 $result['address'] .= $json['location']['address'];
 $result['latitude'] .= $json['location']['latitude'];
 $result['longitude'] .= $json['location']['longitude'];
    return $result; 
}
function qibla($keyword) { 
    $uri = "https://time.siswadi.com/qibla/" . $keyword; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
 $result['image'] .= $json['data']['image']; 
 $result['address'] .= $json['location']['address'];
 $result['latitude'] .= $json['location']['latitude'];
 $result['longitude'] .= $json['location']['longitude'];
    return $result; 
}
function waktu($keyword) { 
    $uri = "https://time.siswadi.com/pray/" . $keyword; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
    $result = "- WAKTU -\n";
    $result .= "\nLokasi : "; 
 $result .= $json['location']['address']; 
 $result .= "\nJam : ";
 $result .= $json['time']['time'];
 $result .= "\nSunrise : ";
 $result .= $json['debug']['sunrise'];
 $result .= "\nSunset : ";
 $result .= $json['debug']['sunset'];
 $result .= "\n\n- WAKTU -";
    return $result; 
}
#-------------------------[Fungsi GNTPW]-------------------------#
function password($keyword) { 
    $uri = "http://www.passwordrandom.com/query?command=password&format=json&count=1"; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
    $result .= "Password: ";
    $result .= $json['char']['0']; 
    $result .= "\n\nKeaman : 100%";
    $result .= "\nDapat digunakan sebagai password sosial media Dan lain lain";
    return $result; 
}
#-------------------------[Fungsi Translate]-------------------------#
function trenid($keyword) { 
    $uri = "https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20171227T171852Z.fda4bd604c7bf41f.f939237fb5f802608e9fdae4c11d9dbdda94a0b5&text=" . $keyword . "&lang=en-id"; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
    $result .= $json['text']['0']; 
    return $result; 
}
#-------------------------[Fungsi Translate]-------------------------#
function triden($keyword) { 
    $uri = "https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20171227T171852Z.fda4bd604c7bf41f.f939237fb5f802608e9fdae4c11d9dbdda94a0b5&text=" . $keyword . "&lang=id-en"; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
    $result .= $json['text']['0']; 
    return $result; 
}
#-------------------------[Fungsi Quotes]-------------------------#
function quote($keyword) { 
    $uri = "https://favqs.com/api/qotd/"; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
    $result .= "- Quotes Of The Day -\n\n";
    $result .= $json['quote']['body']; 
    $result .= "\n\nAuthor: ";
    $result .= $json['quote']['author']; 
    return $result; 
}
#-------------------------[Fungsi Say]-------------------------#
function say($keyword) { 

 $result .= $keyword; 
    return $result; 
}
#-------------------------[Fungsi Cek zodiak]-------------------------#
function cekzodiak($keyword) { 
    $uri = "https://script.google.com/macros/exec?service=AKfycbw7gKzP-WYV2F5mc9RaR7yE3Ve1yN91Tjs91hp_jHSE02dSv9w&nama=miya&tanggal=" . $keyword; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
    $result .= "- CEK ZODIAK -";
    $result .= "\nLahir : "; 
 $result .= $json['data']['lahir']; 
 $result .= "\nUsia : "; 
 $result .= $json['data']['usia']; 
 $result .= "\nUltah : "; 
 $result .= $json['data']['ultah']; 
  $result .= " lagi"; 
 $result .= "\nZodiak : "; 
 $result .= $json['data']['zodiak']; 
    return $result; 
}
#-------------------------[Fungsi Cuaca]-------------------------#
function cuaca($keyword) {
    $uri = "http://api.openweathermap.org/data/2.5/weather?q=" . $keyword . ",ID&units=metric&appid=e172c2f3a3c620591582ab5242e0e6c4";
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $result = "Ramalan cuaca Untuk daerah ";
	$result .= $json['name'];
	$result .= " dan sekitarnya";
	$result .= "\nPada ".date('Y-m-d');
	$result .= "\n\nCuaca : ";
	$result .= $json['weather']['0']['main'];
	$result .= "\nDeskripsi : ";
	$result .= $json['weather']['0']['description'];
    return $result;
}
#-------------------------[Fungsi Shalat]-------------------------#
function shalat($keyword) {
    $uri = "https://time.siswadi.com/pray/" . $keyword . "";

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
	$result['lokasi'] .= $json['location']['address'];
	$result['tanggal'] .= $json['time']['date'];
	$result['shubuh'] .= $json['data']['Fajr'];
	$result['dzuhur'] .= $json['data']['Dhuhr'];
	$result['ashar'] .= $json['data']['Asr'];
	$result['maghrib'] .= $json['data']['Maghrib'];
	$result['isya'] .= $json['data']['Isha'];
    return $result;
}
#-------------------------[Function]-------------------------#

# require_once('./src/function/search-1.php');
# require_once('./src/function/download.php');
# require_once('./src/function/random.php');
# require_once('./src/function/search-2.php');
# require_once('./src/function/hard.php');

//show menu, saat join dan command /menu
if ($command_datang == '/help: cara menggunakan BOT') {
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
										'type' => 'text',					
										'text' => '- WikiBot HELP -
Cara Menggunakan BOT:
- Pastikan kamu sudah add Bot ini
- Invite ke grup yang kamu sukai :)

Bot tidak mau masuk Grup?
Caranya:
- Cek, apakah ada BOT lain di grup itu
Jika ada, kick out BOT itu dari grup
- Lalu kamu cek, apakah ada Invite-an OA / BOT yang masih pending
Jika ada, cancel pending invitation tersebut
- Setelah semua beres, Invite BOT ini ke grup itu
- SELESAI -

Masih belum join juga?
Hubungi admin
>> http://line.me/ti/p/~wibusenja'
            )
        )
    );
}
if ($type == 'join') {
		array_push($get_sub,$aa);	

		$get_sub[] = array(
						'type' => 'sticker',									
						'packageId' => '1',
						'stickerId' => '14'
						
					);

		$get_sub[] = array(
									'type' => 'text',									
									'text' => 'Hai kak Makasi ya udah invite WikiBot ke grup kamu! pada

Tanggal : '. date('Y-m-d') .'
Waktu : '. date('H:i:s') . '
Group ID : ' .$groupId. '

Ketik /help untuk melihat Kemampuan BOT
Ketik /keyword untuk melihat fitur seru BOT ini ya!'
								);
		
		$balas = array(
					'replyToken' 	=> $replyToken,														
					'messages' 		=> $get_sub
				 );	
	}
//WikiBot
if ($command == '/qibla') {
		$get_sub = array();
		$result = qibla($options);
		$aa =   array(
                    'type' => 'location',
                    'title' => 'Lokasi',
                    'address' => $result['address'],
                    'latitude' => $result['latitude'],
                    'longitude' => $result['longitude']
						
					);
		array_push($get_sub,$aa);	

		$get_sub[] = array(
									'type' => 'image',					
									'originalContentUrl' => $result['image'],
									'previewImageUrl' => $result['image']
								);
		
		$balas = array(
					'replyToken' 	=> $replyToken,														
					'messages' 		=> $get_sub
				 );	
	}
if($message['type']=='text') {
    $pesan_datang = strtolower($message['text']);
    $filter = explode(' ', $pesan_datang);
    if($filter[0] == 'Apakah') {
        $balas = send(jawabs(), $replyToken);
    } else {}
} if($message['type']=='text') {
    $pesan_datang = strtolower($message['text']);
    $filter = explode(' ', $pesan_datang);
    if($filter[0] == 'Bisakah') {
        $balas = send(jawabs(), $replyToken);
    } else {}
} if($message['type']=='text') {
    $result = dosa($say);
    if($command == 'Dosanya') {
		$balas = send(dosa($say), $replyToken);
    } else {}
} else {}
if($message['type']=='text') {
    $pesan_datang = strtolower($message['text']);
    $filter = explode(' ', $pesan_datang);
    if($filter[0] == 'apakah') {
        $balas = send(jawabs(), $replyToken);
    } else {}
} if($message['type']=='text') {
    $pesan_datang = strtolower($message['text']);
    $filter = explode(' ', $pesan_datang);
    if($filter[0] == 'bisakah') {
        $balas = send(jawabs(), $replyToken);
    } else {}
} if($message['type']=='text') {
    $pesan_datang = strtolower($message['text']);
    $filter = explode(' ', $pesan_datang);
    if($filter[0] == 'mungkinkah') {
        $balas = send(jawabs(), $replyToken);
    } else {}
} if($message['type']=='text') {
    $result = dosa($say);
    if($command == 'dosanya') {
		$balas = send(dosa($say), $replyToken);
    } else {}
} else {}

if ($command_datang == '/ga') {
		$get_sub = array();
		$aa =   array(
										'type' => 'sticker',					
										'packageId' => '1',
										'stickerId' => '1'
						
					);
		array_push($get_sub,$aa);	

		$get_sub[] = array(
									'type' => 'text',					
									'text' => 'Trus lu maunya apa '.$profil->displayName.''
								);
		
		$balas = array(
					'replyToken' 	=> $replyToken,														
					'messages' 		=> $get_sub
				 );	
	}
if($message['type']=='text') {
	    if ($command == '/fotoig') {

        $result = fotoig($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
						'type' => 'image',									
						'originalContentUrl' => $result,
						'previewImageUrl' => $result
                )
            )
        );
    }

}
if($message['type']=='text') {
	    if ($command == '/tonton' || $command == '/Tonton') {

        $result = videolihat($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'video',
                    'originalContentUrl' => 'https://youtu.be/ppdgqgG0Eaw',
                    'previewImageUrl' => $result['thumbnail']
                ),
            )
        );
    }

}
/* if($message['type']=='text') {
	    if ($command == '/convert' || $command == '/Convert') {

        $result = saveitoffline($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result,
                ),
            )
        );
    }

} */
if ($command == '/convert' || $command == '/Convert') {
        $result = convertbeta($options);
        $tekes = $result['konpert'];
        $altText = "Convert Done";
        $teks = $result['judul'];
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'template',
                    'altText' => $altText,
                    'template' => array(
                        'type' => 'buttons',
                        'title' => 'Convert Selesai',
                        'thumbnailImageUrl' => 'https://fmedia.000webhostapp.com/img/convert.png',
                        'text' => $teks,
                        'actions' => array(
                            array(
                                'type' => 'uri',
                                'label' => $result['uk1'],
				                'uri' => $result['url1']
                            ),
                            array(
                                'type' => 'uri',
                                'label' => $result['uk2'],
				                'uri' => $result['url2']
                            ),
                            array(
                                'type' => 'uri',
                                'label' => $result['uk3'],
				                'uri' => $result['url3']
                            ),
                            array(
                                'type' => 'uri',
                                'label' => $result['uk4'],
				                'uri' => $result['url4']
                            ),
                        )
                    )
                )
            )
        );
    }
if ($command == '/anime-syn') {
		$get_sub = array();
        $result = anime_syn($options);
		$balas =   array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result

                )
            )
        );
    }
/* if($message['type']=='text') {
	    if ($command == '/muskkkk' || $command == '/Muskkkk') {

        $result = musikbiasa($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text'  => $result
                ),
            )
        );
    }

} */
if($message['type']=='text') {
	    if ($command == '/dengar' || $command == '/Dengar') {

        $result = denger($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'audio',
                    'originalContentUrl'  => $result['musik'],
		    'duration' => $result['durasi']
                ),
            )
        );
    }

}
if ($command == '/musik') {
        $result = musik($say);
        $altText = $result['judul'];
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'template',
                    'altText' => $altText,
                    'template' => array(
                        'type' => 'buttons',
                        'title' => $result['judul'],
                        'thumbnailImageUrl' => 'https://fmedia.000webhostapp.com/img/musik.png',
                        'text' => "Judul : " . $result['judul'] . "\nDurasi : " . $result['durasi'],
                        'actions' => array(
                            array(
                                'type' => 'postback',
                                'label' => 'Dapatkan Lirik',
                                'data' => 'action=add&itemid=123',
                                'text' => '/lirik ' . $say
                            ),
                            array(
                                'type' => 'uri',
                                'label' => 'Download',
                                'uri' => $result['donlod']
                            )
                        )
                    )
                )
            )
        );
    }
 if($message['type']=='text') {
	    if ($command == '/lokasi' || $command == '/Lokasi') {

        $result = lokasi($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'location',
                    'title' => 'Lokasi',
                    'address' => $result['address'],
                    'latitude' => $result['latitude'],
                    'longitude' => $result['longitude']
                ),
            )
        );
    }

}
if($message['type']=='text') {
	    if ($command == '/lirik' || $command == '/lirik') {

        $result = lirik($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text'  => $result
                ),
            )
        );
    }

}
if($message['type']=='text') {
	    if ($command == '/cuaca' || $command == '/Cuaca') {

        $result = cuaca($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }

}
if ($command_datang == '/ramalan cuaca' || $command_datang == '/Ramalan cuaca' || $command_datang == '/Ramalan Cuaca') {
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
										'type' => 'text',					
										'text' => '- CUACA -
Ketik
/cuaca <nama daerah>
Contoh:
/cuaca Pekanbaru

Ini berguna untuk cek Cuaca saat ini'
            )
        )
    );
}
/*
Fitur kalo ngomong langsung di respon
else{
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'WikiBot sudah kembali //normal ya!
Ketik 
untuk melihat Fitur asyik BOT
Ketik /keyword untuk melihat kemampuan WikiBot ya!'
									)
							)
						);
						
	} */
if ($command_datang == '/keyword' || $command_datang == '/Keyword' || $command_datang == 'keyword' || $command_datang == 'Keyword') {
    $text = "- WikiBot HELP -
Menu:
- /kalender
- /waktu [NAMA KOTA]
- /shalat [NAMA KOTA]
- /cuaca [NAMA KOTA]
- /say [KATA KATA]
- /papimage
- /papvid
- /cekprofileku
- /zodiak
- /magic = Trik sulap
- /reset = Reset BOT
- /about";
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
										'type' => 'text',					
										'text' => $text
            )
        )
    );
}
if ($command_datang == '/kalender' || $command_datang == '/Kalender') {
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
										'type' => 'text',					
										'text' => 'Kalender: '. date('Y-m-d')
            )
        )
    );
}
if($message['type']=='text') { 
     if ($command == '/waktu' || $command == '/Waktu') { 
 
        $result = waktu($options); 
        $balas = array( 
            'replyToken' => $replyToken, 
            'messages' => array( 
                array( 
                    'type' => 'text', 
                    'text' => $result 
                ) 
            ) 
        ); 
    }
}
if ($command_datang == '/zodiak' || $command_datang == '/Zodiak') {
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
										'type' => 'text',					
										'text' => '- CEK ZODIAK -
Ketik
/cek <tanggal lahir>
Format: /cek Tanggal-Bulan-Tahun
Contoh:
/cek 10-05-1991

Ini berguna untuk Cek Zodiakmu'

            )
        )
    );
}
if ($command_datang == '/ga') {
		$get_sub = array();
		$aa =   array(
										'type' => 'sticker',					
										'packageId' => '1',
										'stickerId' => '1'
						
					);
		array_push($get_sub,$aa);	

		$get_sub[] = array(
									'type' => 'text',					
									'text' => 'Trus lu maunya apa '.$profil->displayName.''
								);
		
		$balas = array(
					'replyToken' 	=> $replyToken,														
					'messages' 		=> $get_sub
				 );	
	}
if ($command_datang == '/papvid' || $command_datang == '/papvideo' || $command_datang == '/Papvid' || $command_datang == '/Papvideo') {
		$get_sub = array();
		$aa =   array(
						'type' => 'video',									
						'originalContentUrl' => 'https://www.youtube.com/watch?v=5YJp_2BZEKA',
						'previewImageUrl' => 'https://pbs.twimg.com/media/DQNqT4oV4AEaUZ0.jpg:large'
						
					);
		array_push($get_sub,$aa);	

		$get_sub[] = array(
									'type' => 'text',									
									'text' => 'Itu pap video ku kak '.$profil->displayName.' :).'
								);
		
		$balas = array(
					'replyToken' 	=> $replyToken,														
					'messages' 		=> $get_sub
				 );	
	}
if ($command_datang == '/papimage' || $command_datang == '/Papimage') {
		$get_sub = array();
		$aa =   array(
						'type' => 'image',									
						'originalContentUrl' => 'https://memegenerator.net/img/images/400x/5000.jpg',
						'previewImageUrl' => 'https://memegenerator.net/img/images/400x/5000.jpg'
						
					);
		array_push($get_sub,$aa);	

		$get_sub[] = array(
									'type' => 'text',									
									'text' => 'Itu pap Foto ku kak '.$profil->displayName.' :).'
								);
		
		$balas = array(
					'replyToken' 	=> $replyToken,														
					'messages' 		=> $get_sub
				 );	
	}
if ($command_datang == '/Magic' || $command_datang == '/magic') {
		$get_sub = array();
		$aa =   array(
						'type' => 'image',									
						'originalContentUrl' => 'https://fmedia.000webhostapp.com/img/2.jpg',
						'previewImageUrl' => 'https://fmedia.000webhostapp.com/img/1.jpg'
						
					);
		array_push($get_sub,$aa);	

		$get_sub[] = array(
									'type' => 'text',									
									'text' => 'Itu Magic Trick aku kak '.$profil->displayName.'
Gimana, keren kann!'
								);
		
		$balas = array(
					'replyToken' 	=> $replyToken,														
					'messages' 		=> $get_sub
				 );	
	}
if ($command_datang == 'dor' || $command_datang == 'Dor') {
		$get_sub = array();
		$aa =   array(
						'type' => 'image',									
						'originalContentUrl' => 'https://memegenerator.net/img/images/400x/535534.jpg',
						'previewImageUrl' => 'https://memegenerator.net/img/images/400x/535534.jpg'
						
					);
		array_push($get_sub,$aa);	

		$get_sub[] = array(
									'type' => 'text',									
									'text' => 'Aaaa!, WikiBot  T E R Q E D J O E D :v'
								);
		
		$balas = array(
					'replyToken' 	=> $replyToken,														
					'messages' 		=> $get_sub
				 );	
	}
if ($command_datang == '/cekprofileku' || $command_datang == '/Cekprofileku') {
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(

										'type' => 'text',					
										'text' => '- PROFILE -
Nama: '.$profil->displayName.'

Picture: '.$profil->pictureUrl.'

Status: '.$profil->statusMessage.'

- E N D -

**WikiBot hanya bisa menampilkan Profilmu
jika kamu sudah Add BOT ini'
									)
							)
						);
				
	}
if ($command_datang == '/about' || $command_datang == '/About') {
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
										'type' => 'text',					
										'text' => '- About -

WikiBot adalah BOT yang sangat responsif
Dan memiliki fitur asik bagi penggunanya
WikiBot di bangun pada
1 April 2020

kl9z selaku Developer
dan Dibawah naungan WikiBot ID

>> KL9Z'
            )
        )
    );
}
if ($command_datang == '/jadwal' || $command_datang == '/jadwal') {
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
										'type' => 'text',					
										'text' => '- JADWAL MAPEL -
Ketik
/jadwal [Kelas]
Contoh:
/jadwal 10

Ini berguna untuk cek Jadwal Mapel'
            )
        )
    );
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == '/id-en') {

        $result = triden($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }

}
if($message['type']=='text') {
	    if ($command == '/en-id') {

        $result = trenid($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }

}
if($message['type']=='text') {
	    if ($command == '/getpw') {

        $result = password($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Generating password...'
                ),
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }

}
if($message['type']=='text') {
	    if ($command == '/cek' || $command == '/Cek') {

        $result = cekzodiak($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }

}
if($message['type']=='text') {
	    if ($command == '/say' || $command == '/Say') {

        $result = say($say);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }

}
if($message['type']=='text') {
	    if ($command == '/quote' || $command == '/Quote') {

        $result = quote($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }

}
if($message['type']=='text') {
	    if ($command == '/gp') {

        $result = ps($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text'  => 'Sedang mencari...'
                ),
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }

}
if ($command == '/shalat' || $command == '/Shalat') {
        $result = shalat($options);
        $altText = "Jadwal Shalat";
        $teks = "Daerah " . $options . "\nTanggal : " . date('Y-m-d') . "\nSHUBUH : " . $result['shubuh'];
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'template',
                    'altText' => $altText,
                    'template' => array(
                        'type' => 'buttons',
                        'title' => 'Jadwal Shalat',
                        'thumbnailImageUrl' => 'https://fmedia.000webhostapp.com/img/shalat.png',
                        'text' => $teks,
                        'actions' => array(
                            array(
                                'type' => 'postback',
                                'label' => 'Dzuhur : '. $result['dzuhur'],
                                'data' => 'action=add&itemid=123',
                            ),
                            array(
                                'type' => 'postback',
                                'label' => 'Ashar : '. $result['ashar'],
                                'data' => 'action=add&itemid=123',
                            ),
                            array(
                                'type' => 'postback',
                                'label' => 'Maghrib : '. $result['maghrib'],
                                'data' => 'action=add&itemid=123',
                            ),
                            array(
                                'type' => 'postback',
                                'label' => 'Isya : '. $result['isya'],
                                'data' => 'action=add&itemid=123',
                            )
                        )
                    )
                )
            )
        );
    }
if ($command_datang == 'WikiBot') {
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
										'type' => 'text',					
										'text' => 'Ada apa manggil manggil? , '.$profil->displayName.'
 Kangen ya sama WikiBot...'
            )
        )
    );
}
if($message['type']=='text') {
    if ($command_datang == '/admin') {
            $balas = array(
                'replyToken' => $replyToken,
                'messages' => array(
                array(
                    'type' => 'template',
                    'altText' => 'Admin & Developer',
                    'template' => array(
                        'type' => 'buttons',
                        'title' => 'Maxi Aditya',
                        'thumbnailImageUrl' => 'https://fmedia.000webhostapp.com/img/maindev.png',
                        'text' => 'Main Developer',
                        'actions' => array(
                            array(
                                'type' => 'uri',
                                'label' => 'Instagram',
                                'uri' => 'http://instagram.com/maxi.aditya'
                            ),
                            array(
                                'type' => 'uri',
                                'label' => 'Line Developer',
                                'uri' => 'http://line.me/ti/p/~wibusenja
                            ),
                        ),
                    ),
                ),
            ),
        );
    } else {}
} else {}
if($message['type']=='text') {
    if ($command_datang == '/mlshop') {
	        $balas = array(
							'replyToken' => $replyToken,
							'messages' => array(
								array (
										  'type' => 'template',
										  'altText' => 'Mobile Legends',
										  'template' => 
										  array (
										    'type' => 'carousel',
										    'columns' => 
										    array (
										      0 => 
										      array (
										        'thumbnailImageUrl' => 'https://d1qgcmfii0ptfa.cloudfront.net/S/content/common/images/mno/ML-logo-300.png?v=912',
										        'title' => 'Mobile Legends',
										        'text' => 'Silahkan pilih salah satu sesuai kebutuhan kamu',
										        'actions' => 
										        array (
										          0 => 
										          array (
										            'type' => 'uri',
										            'label' => 'Top Up Diamond',
													'uri' => 'https://api.whatsapp.com/send?phone=6287873328012&text=Halo Admin WikiBot...%0ASaya ingin Top Up Diamond Mobile Legends%0AMohon Penjelasannya'
										          ),
										          1 => 
										          array (
										            'type' => 'uri',
										            'label' => 'Beli SKIN',
													'uri' => 'https://api.whatsapp.com/send?phone=6287873328012&text=Halo Admin WikiBot...%0ASaya ingin membeli Skin Hero Mobile Legends%0AMohon Penjelasannya'
												  ),
										          2 => 
										          array (
										            'type' => 'uri',
										            'label' => 'Buat Skuad',
													'uri' => 'https://api.whatsapp.com/send?phone=6287873328012&text=Halo Admin WikiBot...%0ASaya ingin membuat Squad Mobile Legends%0AMohon Penjelasannya'
										          ),
										        ),
										      ),
										      1 => 
										      array (
										        'thumbnailImageUrl' => 'https://d1qgcmfii0ptfa.cloudfront.net/S/content/common/images/mno/ML-logo-300.png?v=912',
										        'title' => 'Mobile Legends',
										        'text' => 'Silahkan pilih salah satu sesuai kebutuhan kamu',
										        'actions' => 
										        array (
										          0 => 
										          array (
										            'type' => 'uri',
										            'label' => 'Starlight Member',
													'uri' => 'https://api.whatsapp.com/send?phone=6287873328012&text=Halo Admin WikiBot...%0ASaya ingin membeli Starlight member Mobile Legends%0AMohon Penjelasannya'
										          ),
										          1 => 
										          array (
										            'type' => 'uri',
										            'label' => 'Seasonal Starlight Member',
													'uri' => 'https://api.whatsapp.com/send?phone=6287873328012&text=Halo Admin WikiBot...%0ASaya ingin membeli Seasonal Starlight member Mobile Legends%0AMohon Penjelasannya'
										          ),
										          2 => 
										          array (
										            'type' => 'uri',
										            'label' => 'MPL Victory',
													'uri' => 'https://api.whatsapp.com/send?phone=6287873328012&text=Halo Admin WikiBot...%0ASaya ingin membeli MPL Victory Mobile Legends%0AMohon Penjelasannya'
										          ),
										        ),
										      ),
										      2 => 
										      array (
										        'thumbnailImageUrl' => 'https://d1qgcmfii0ptfa.cloudfront.net/S/content/common/images/mno/ML-logo-300.png?v=912',
										        'title' => 'Mobile Legends',
										        'text' => 'Silahkan pilih salah satu sesuai kebutuhan kamu',
										        'actions' => 
										        array (
										          0 => 
										          array (
										            'type' => 'uri',
										            'label' => 'MPL Glory',
													'uri' => 'https://api.whatsapp.com/send?phone=6287873328012&text=Halo Admin WikiBot...%0ASaya ingin membeli MPL Glory Mobile Legends%0AMohon Penjelasannya'
										          ),
										          1 => 
										          array (
										            'type' => 'uri',
										            'label' => 'Beli Akun ML',
													'uri' => 'https://api.whatsapp.com/send?phone=6287873328012&text=Halo Admin WikiBot...%0ASaya ingin membeli Akun Mobile Legends%0AMohon Penjelasannya'
										          ),
										          2 => 
										          array (
													'type' => 'postback',
													'label' => 'Jasa JOKI',
													'data' => 'action=add&itemid=111',
													'text' => 'Mohon maaf, Jasa Joki ML sedang tidak tersedia, kami akan segera memberi info jika sudah tersedia'
										          ),
										        ),
										      ),
										    ),
										  ),
										)					
			 
        )
    );
	}
	
}
if($message['type']=='text') {
    if ($command_datang == '/psshop') {
            $balas = array(
                'replyToken' => $replyToken,
                'messages' => array(
                array(
                    'type' => 'template',
                    'altText' => 'Play Store Shop',
                    'template' => array(
                        'type' => 'buttons',
                        'title' => 'Play Store Shop',
                        'thumbnailImageUrl' => 'https://d1qgcmfii0ptfa.cloudfront.net/S/content/common/images/mno/google-play-gift-code-card-300x193.png?v=912',
                        'text' => 'Isi saldo Google Play Store lebih gampang dan Murah dengan WikiBot!',
                        'actions' => array(
                            array(
                                'type' => 'uri',
                                'label' => 'Isi Saldo Play Store',
                                'uri' => 'https://api.whatsapp.com/send?phone=6287873328012&text=Halo Admin WikiBot...%0ASaya ingin Isi Saldo Google play Store%0AMohon Penjelasannya'
                            ),
                        ),
                    ),
                ),
            ),
        );
    } else {}
} else {}
if($message['type']=='text') {
    if ($command_datang == '/swshop') {
            $balas = array(
                'replyToken' => $replyToken,
                'messages' => array(
                array(
                    'type' => 'template',
                    'altText' => 'Play Store Shop',
                    'template' => array(
                        'type' => 'buttons',
                        'title' => 'Play Store Shop',
                        'thumbnailImageUrl' => 'https://d1qgcmfii0ptfa.cloudfront.net/S/content/common/images/steam-new-300x193.png?v=912',
                        'text' => 'Isi saldo Steam Wallet lebih gampang dan Murah dengan WikiBot!',
                        'actions' => array(
                            array(
                                'type' => 'uri',
                                'label' => 'Isi Steam Wallet',
                                'uri' => 'https://api.whatsapp.com/send?phone=6287873328012&text=Halo Admin WikiBot...%0ASaya ingin Isi Saldo Steam Wallet%0AMohon Penjelasannya'
                            ),
                            array(
                                'type' => 'uri',
                                'label' => 'Isi Steam Wallet - USD',
                                'uri' => 'https://api.whatsapp.com/send?phone=6287873328012&text=Halo Admin WikiBot...%0ASaya ingin Isi Saldo Steam Wallet - USD%0AMohon Penjelasannya'
                            ),
                        ),
                    ),
                ),
            ),
        );
    } else {}
} else {}
if($message['type']=='text') {
    if ($command_datang == '/toko') {
            $balas = array(
                'replyToken' => $replyToken,
                'messages' => array(
                array(
                    'type' => 'template',
                    'altText' => 'Ocelot Online Shop',
                    'template' => array(
                        'type' => 'buttons',
                        'title' => 'Ocelot Online Shop',
                        'thumbnailImageUrl' => 'https://fmedia.000webhostapp.com/img/toko.png',
                        'text' => 'Pilih salah satu game untuk berbelanja kebutuhanmu',
                        'actions' => array(
                            array(
                                'type' => 'message',
                                'label' => 'Mobile Legends',
                                'text' => '/mlshop'
                            ),
                            array(
                                'type' => 'message',
                                'label' => 'Play Store',
                                'text' => '/psshop'
                            ),
                            array(
                                'type' => 'message',
                                'label' => 'Steam Wallet',
                                'text' => '/swshop'
                            ),
                        ),
                    ),
                ),
            ),
        );
    } else {}
} else {}
if($message['type']=='text') {
    if ($command_datang == '/reset') {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'BOT telah di reset.'
                    ),
                    array(
                    'type' => 'template',
                    'altText' => 'Butuh bantuan?',
                    'template' => array(
                        'type' => 'confirm',
                        'title' => 'Butuh bantuan?',
                        'text' => 'Butuh bantuan?',
                        'actions' => array(
                            array(
                                'type' => 'message',
                                'label' => 'Ya',
                                'text' => '/help'
                            ),
                            array(
                                'type' => 'message',
                                'label' => 'Engga',
                                'text' => '/ga'
                            ),
                        ),
                    ),
                ),
            ),
        );
    } else {}
} else {}

if($message['type']=='text') {
    if ($command_datang == '/translate' || $command_datang == '/Translate') {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'template',
                    'altText' => 'TRANSLATE',
                    'template' => array(
                        'type' => 'buttons',
                        'title' => 'Translate',
                        'thumbnailImageUrl' => 'https://9to5google.files.wordpress.com/2017/03/googletranslate-900x420.jpg?quality=82&strip=all&w=900&strip=all&w=1600&h=1000',
                        'text' => 'WikiBot bisa Translate Lho! Coba aja!',
                        'actions' => array(
                            array(
                                'type' => 'message',
                                'label' => 'Indonesia -> Inggris',
                                'text' => 'Ketik /id-en [TEXT]
Contoh: /id-en Saya ganteng'
                            ),
                            array(
                                'type' => 'message',
                                'label' => 'Inggris -> Indonesia',
                                'text' => 'Ketik /en-id [TEXT]
Contoh: /en-id Ucok is ugly'
                            ),
                        ),
                    ),
                ),
            ),
        );
    } else {}
} else {}
if($message['type']=='text') {
    if ($command_datang == 'menu' || $command_datang == '/help' || $command_datang == '/Help' || $command_datang == 'Help' || $command_datang == 'help' || $command_datang == 'Menu') {
	        $balas = array(
							'replyToken' => $replyToken,
							'messages' => array(
								array (
										  'type' => 'template',
										  'altText' => 'Menu',
										  'template' => 
										  array (
										    'type' => 'carousel',
										    'columns' => 
										    array (
										      0 => 
										      array (
										        'thumbnailImageUrl' => 'https://fmedia.000webhostapp.com/img/menumultimedia.png',
										        'title' => 'Multimedia',
										        'text' => 'Menu Multimedia',
										        'actions' => 
										        array (
										          0 => 
										          array (
										            'type' => 'postback',
										            'label' => 'Convert Video',
										            'data' => 'action=add&itemid=111',
													'text' => 'Ketik /convert [URL Video Youtube]'
										          ),
										          1 => 
										          array (
										            'type' => 'postback',
										            'label' => 'Cari Anime',
										            'data' => 'action=add&itemid=111',
													'text' => 'Ketik /anime [Judul Anime]'
												  ),
										          2 => 
										          array (
										            'type' => 'postback',
										            'label' => 'Cari Musik',
										            'data' => 'action=add&itemid=111',
													'text' => 'Ketik /musik [JUDUL LAGU]'
										          ),
										        ),
										      ),
										      1 => 
										      array (
										        'thumbnailImageUrl' => 'https://fmedia.000webhostapp.com/img/menuutilitas.png',
										        'title' => 'Utilitas',
										        'text' => 'Menu Utilitas',
										        'actions' => 
										        array (
										          0 => 
										          array (
										            'type' => 'postback',
										            'label' => 'Cari Lirik',
										            'data' => 'action=add&itemid=111',
													'text' => 'Ketik /lirik [JUDUL LAGU]'
										          ),
										          1 => 
										          array (
													'type' => 'postback',
													'label' => 'Cari Lokasi',
													'data' => 'action=add&itemid=111',
													'text' => 'Ketik /lokasi [NAMA KOTA]'
										          ),
										          2 => 
										          array (
													'type' => 'postback',
													'label' => 'Cek Profile',
													'data' => 'action=add&itemid=111',
													'text' => '/cekprofileku'
										          ),
										        ),
										      ),
										      2 => 
										      array (
										        'thumbnailImageUrl' => 'https://fmedia.000webhostapp.com/img/menuutilitas.png',
										        'title' => 'Utilitas',
										        'text' => 'Menu Utilitas',
										        'actions' => 
										        array (
										          0 => 
										          array (
										            'type' => 'postback',
										            'label' => 'Translate',
										            'data' => 'action=add&itemid=111',
													'text' => '/translate'
										          ),
										          1 => 
										          array (
													'type' => 'postback',
													'label' => 'Cari Quotes',
													'data' => 'action=add&itemid=111',
													'text' => '/quote'
										          ),
										          2 => 
										          array (
													'type' => 'postback',
													'label' => 'Cek Tanggal Lahir',
													'data' => 'action=add&itemid=111',
													'text' => 'Ketik /cek [tanggal-bulan-tahun]
Contoh: /cek 10-05-1991'
										          ),
										        ),
										      ),
										      3 => 
										      array (
										        'thumbnailImageUrl' => 'https://fmedia.000webhostapp.com/img/ashiyap.png',
										        'title' => 'Science & Technology',
										        'text' => 'Menu Islamic & Science',
										        'actions' => 
										        array (
										          0 => 
										          array (
										            'type' => 'postback',
										            'label' => 'Jadwal Mapel',
										            'data' => 'action=add&itemid=111',
													'text' => 'Ketik /Jadwal [KELAS]'
										          ),
										          1 => 
										          array (
													'type' => 'postback',
													'label' => 'Cari Arah qibla',
													'data' => 'action=add&itemid=111',
													'text' => 'Ketik /qibla [NAMA KOTA]'
										          ),
										          2 => 
										          array (
													'type' => 'postback',
													'label' => 'Game',
													'data' => 'action=add&itemid=111',
													'text' => 'Maaf, untuk Fitur Game sedang dalam tahap Maintenance'
										          ),
										        ),
										      ),						
										      4 => 
										      array (
										        'thumbnailImageUrl' => 'https://fmedia.000webhostapp.com/img/menuscience.png',
										        'title' => 'Science',
										        'text' => 'Menu Science',
										        'actions' => 
										        array (
										          0 => 
										          array (
										            'type' => 'postback',
										            'label' => 'Waktu',
										            'data' => 'action=add&itemid=111',
													'text' => 'Ketik /waktu [Nama Kota]'
										          ),
										          1 => 
										          array (
													'type' => 'postback',
													'label' => 'Ramalan Cuaca',
													'data' => 'action=add&itemid=111',
													'text' => 'Ketik /cuaca [NAMA KOTA]'
										          ),
										          2 => 
										          array (
													'type' => 'postback',
													'label' => 'Kalender',
													'data' => 'action=add&itemid=111',
													'text' => '/kalender'
										          ),
										        ),
										      ),
										      5 => 
										      array (
										        'thumbnailImageUrl' => 'https://fmedia.000webhostapp.com/img/menuhiburan.png',
										        'title' => 'Hiburan',
										        'text' => 'Kerang Ajaib',
										        'actions' => 
										        array (
										          0 => 
										          array (
										            'type' => 'postback',
										            'label' => 'Apakah?',
										            'data' => 'action=add&itemid=111',
													'text' => 'ketik Apakah [PERTANYAAN]
Contoh:
Apakah saya jomblo?'
										          ),
										          1 => 
										          array (
													'type' => 'postback',
													'label' => 'Bisakah?',
													'data' => 'action=add&itemid=111',
													'text' => 'ketik Bisakah [PERTANYAAN]
Contoh:
Bisakah saya punya pacar?'
										          ),
										          2 => 
										          array (
													'type' => 'message',
													'label' => 'Cek Dosa',
													'data' => 'action=add&itemid=111',
													'text' => 'ketik Dosanya [NAMA]
Contoh:
Dosanya Ucok'
										          ),
										        ),
										      ),
										      6 => 
										      array (
										        'thumbnailImageUrl' => 'https://panelsmmbaru.000webhostapp.com/img/Toby.png',
										        'title' => 'Maxi Aditya - Youtube',
										        'text' => 'Semua Tutorial Ada Disini!',
										        'actions' => 
										        array (
										          0 => 
										          array (
										            'type' => 'uri',
										            'label' => 'SUBSCRIBE',
													'uri' => 'https://www.youtube.com/c/maxiaditya?sub_confirmation=1'
										          ),
										          1 => 
										          array (
													'type' => 'uri',
													'label' => 'Maxi Playlist',
													'uri' => 'https://youtu.be/cs2wxPymiRw'
										          ),
										          2 => 
										          array (
													'type' => 'postback',
													'label' => 'Maxi Aditya',
													'data' => 'action=add&itemid=111',
													'text' => '/maxiaditya'
										          ),
										        ),
										      ),
										      7 => 
										      array (
										        'thumbnailImageUrl' => 'https://panelsmmbaru.000webhostapp.com/img/Toby.png',
										        'title' => 'WikiBot',
										        'text' => 'Cek Dibawah',
										        'actions' => 
										        array (
										          0 => 
										          array (
										            'type' => 'postback',
										            'label' => 'Admin & Developer',
										            'data' => 'action=add&itemid=111',
													'text' => '/admin'
										          ),
										          1 => 
										          array (
													'type' => 'postback',
													'label' => 'About Ocelot',
													'data' => 'action=add&itemid=111',
													'text' => '/about'
										          ),
										          2 => 
										          array (
													'type' => 'uri',
													'label' => 'Request Fitur',
													'uri' => 'http://line.me/R/home/public/post?id=424imkvg&postId=1151057457705033852'
										          ),
										        ),
										      ),
										    ),
										  ),
										)					
			 
        )
    );
	}
	
}
if ($command == '/anime') {
        $result = anime($options);
        $altText = "Title : " . $result['title'];
        $altText .= "\n\n" . $result['desc'];
        $altText .= "\nMAL Page : https://myanimelist.net/anime/" . $result['id'];
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'template',
                    'altText' => $altText,
                    'template' => array(
                        'type' => 'buttons',
                        'title' => $result['title'],
                        'thumbnailImageUrl' => $result['image'],
                        'text' => $result['desc'],
                        'actions' => array(
                            array(
                                'type' => 'postback',
                                'label' => 'Baca Sinopsis-nya',
                                'data' => 'action=add&itemid=123',
                                'text' => '/anime-syn ' . $options
                            ),
                            array(
                                'type' => 'uri',
                                'label' => 'Website MAL',
                                'uri' => 'https://myanimelist.net/anime/' . $result['id']
                            )
                        )
                    )
                )
            )
        );
    }
if($message['type']=='text') {
    if ($command_datang == '/adminyoutube') {
	        $balas = array(
							'replyToken' => $replyToken,
							'messages' => array(
								array (
										  'type' => 'template',
										  'altText' => 'Maxi Aditya',
										  'template' => 
										  array (
										    'type' => 'carousel',
										    'columns' => 
										    array (
										      0 => 
										      array (
										        'thumbnailImageUrl' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRGQKS866VXl5F4fVTb2_-B8BXMLC08Hmpi3eBAzAnADk3UiYndIA',
										        'title' => 'Free Fire MEGA MOD APK',
										        'text' => 'Free Fire 1.13.0 MEGA MOD APK ANTI BANNED!',
										        'actions' => 
										        array (
										          0 => 
										          array (
										            'type' => 'uri',
										            'label' => 'Tutorial Pemasangan',
													'uri' => 'https://www.youtube.com/watch?v=V8wyncTaeu0&t'
										          ),
											  1 => 
										          array (
										            'type' => 'uri',
										            'label' => 'Download',
													'uri' => 'http://www.fidhomod.tk/2018/03/free-fire-mod-apk-1130-mega-hack.html'
										          ),
										        ),
										      ),
										      1 => 
										      array (
										        'thumbnailImageUrl' => 'https://d1qgcmfii0ptfa.cloudfront.net/S/content/common/images/mno/ML-logo-300.png?v=952',
										        'title' => 'Mobile Legends MOD APK',
										        'text' => 'Mobile Legends: Bang Bang MOD APK 1.2.56.2551 ANTI BANNED!',
										        'actions' => 
										        array (
										          0 => 
										          array (
										            'type' => 'uri',
										            'label' => 'Tutorial Pemasangan',
													'uri' => 'https://www.youtube.com/watch?v=S_WX_CyqE4M&t'
										          ),
										          1 => 
										          array (
										            'type' => 'uri',
										            'label' => 'Download',
													'uri' => 'http://www.fidhomod.tk/2018/03/halo-sobat-fidho-redana-yang-tercintaaa.html'
										          ),
										        ),
										      ),
										      2 => 
										      array (
										        'thumbnailImageUrl' => 'http://fmedia.000webhostapp.com/img/fidhomod.png',
										        'title' => 'BUG dan MASALAH',
										        'text' => 'Menemukan BUG atau MASALAh pada MO? Tanya disini!',
										        'actions' => 
										        array (
										          0 => 
										          array (
										            'type' => 'postback',
										            'label' => 'BANTUAN',
										            'data' => 'action=add&itemid=111',
													'text' => '/bantuanfidhomod'
										          ),
										          1 => 
										          array (
										            'type' => 'postback',
										            'label' => 'BANTUAN',
										            'data' => 'action=add&itemid=111',
													'text' => '/bantuanfidhomod'
										          ),
										        ),
										      ),											  
										    ),
										  ),
										)					
			 
        )
    );
	}
	
}
if ($command == '/bantuanfidhomod') {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'template',
                    'altText' => 'Bantuan FidhoMOD',
                    'template' => array(
                        'type' => 'buttons',
                        'title' => 'Bantuan FihoMOD',
                        'thumbnailImageUrl' => 'https://http://fmedia.000webhostapp.com/img/fidhomod.png',
                        'text' => 'Silakan Pilih Game',
                        'actions' => array(
                            array(
                                'type' => 'postback',
				'label' => 'Free Fire',
				'data' => 'action=add&itemid=111',
				'text' => '/bantuanfidhomodff'
                            ),
                            array(
                                'type' => 'uri',
                                'label' => 'Mobile Legends',
				'data' => 'action=add&itemid=111',
				'text' => '/bantuanfidhomodmlbb'
                            ),
                        )
                    )
                )
            )
        );
    }
if ($command == '/bantuanfidhomodmlbb') {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'template',
                    'altText' => 'Bantuan MOD MLBB',
                    'template' => array(
                        'type' => 'buttons',
                        'title' => 'Bantuan MOD MLBB',
                        'thumbnailImageUrl' => 'https://http://fmedia.000webhostapp.com/img/fidhomod.png',
                        'text' => 'Silakan Pilih Salah Satu Pertanyaan',
                        'actions' => array(
                            array(
                                'type' => 'postback',
				'label' => 'MOD Sering LAGGING',
				'data' => 'action=add&itemid=111',
				'text' => '- Periksa koneksi internet mu
- Bersihkan aplikasi, video, foto yang tidak terpakai
- Hapus Cache Game Mobile Legends di Pengaturan
- Jika masih berlanjut, kirim email ke:
+ Fidhoredanabusiness@gmail.com'
                            ),
                            array(
                                'type' => 'uri',
                                'label' => 'Download Failed',
				'data' => 'action=add&itemid=111',
				'text' => '- Download dan Pakai data OBB MOD yang di sediakan di Website fidhomod.tk'
                            ),
                        )
                    )
                )
            )
        );
    }
if ($command == '/bantuanfidhomodff') {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'template',
                    'altText' => 'Bantuan MOD Free Fire',
                    'template' => array(
                        'type' => 'buttons',
                        'title' => 'Bantuan MOD Free Fire',
                        'thumbnailImageUrl' => 'https://http://fmedia.000webhostapp.com/img/fidhomod.png',
                        'text' => 'Silakan Pilih Salah Satu Pertanyaan',
                        'actions' => array(
                            array(
                                'type' => 'postback',
				'label' => 'MOD Sering LAGGING',
				'data' => 'action=add&itemid=111',
				'text' => '- Periksa koneksi internet mu
- Bersihkan aplikasi, video, foto yang tidak terpakai
- Hapus Cache Game Free Fire di Pengaturan
- Jika masih berlanjut, kirim email ke:
+ Fidhoredanabusiness@gmail.com'
                            ),
                            array(
                                'type' => 'uri',
                                'label' => 'Download Failed',
				'data' => 'action=add&itemid=111',
				'text' => '- Download dan Pakai data OBB MOD yang di sediakan di Website fidhomod.tk'
                            ),
                        )
                    )
                )
            )
        );
    }
if($message['type']=='text') {
    if ($command_datang == '/kebodlama') {
            $balas = array(
                'replyToken' => $replyToken,
                'messages' => array(
                    array(
                        "type" => "template",
                        "altText" => "Menu",
                        "template" => array(
                            "type" => "carousel",
                            "columns" => array(
                                array(
                                    //"thumbnailImageUrl" => "https://9to5google.files.wordpress.com/2017/03/googletranslate-900x420.jpg?quality=82&strip=all&w=900&strip=all&w=1600&h=1000",
                                    "title" => "Translate",
                                    "text" => "Fitur translate yang sangat pintar!",
                                    "actions" => array(
                                        array(
                                            'type' => 'message',
                                            'label' => 'Tranlsate',
                                            'text' => '/translate',
                                        ),
                                    ),
                                ),
                                array(
                                    //"thumbnailImageUrl"=> "https://example.com/bot/images/item2.jpg",
                                    "title" => "- Quotes Of The Day -",
                                    "text" => "Ribuan quotes keren dari Ocelot",
                                    "actions" => array(
                                        array(
                                            'type' => 'message',
                                            'label' => 'Cek Quotes',
                                            'text' => '/quote',
                                        ),
                                    ),
                                ),
                                array(
                                    //"thumbnailImageUrl"=> "https://example.com/bot/images/item2.jpg",
                                    "title" => "Google Play Search",
                                    "text" => "Lebih gampang nyari aplikasi Play Store di LINE!",
                                    "actions" => array(
                                        array(
                                            'type' => 'message',
                                            'label' => 'Cari Aplikasi',
                                            'text' => 'Cara cari aplikasi
Ketik
/gp [NAMA APLIKASI]
Contoh:
/gp Mobile Legend',
                                        ),
                                    ),
                                ),
                                array(
                                    //"thumbnailImageUrl"=> "https://example.com/bot/images/item2.jpg",
                                    "title" => "Youtube Converter",
                                    "text" => "Kini, bisa Download video youtube dengan Ocelot lho!",
                                    "actions" => array(
                                        array(
                                            'type' => 'message',
                                            'label' => 'Convert Video',
                                            'text' => 'Cara Convert Video Youtube
Ketik
/convert [Link Video YT]
Contoh:
/convert https://www.youtube.com/watch?v=5SaONVt5bDI',
                                        ),
                                    ),
                                ),
                                array(
                                    //"thumbnailImageUrl"=> "https://example.com/bot/images/item2.jpg",
                                    "title" => "Cari Anime",
                                    "text" => "Mencari Anime lebih gampang dengan Ocelot!",
                                    "actions" => array(
                                        array(
                                            'type' => 'message',
                                            'label' => 'Cari Anime',
                                            'text' => 'Cara cari Anime
Ketik
/anime [Judul Anime]
Contoh:
/anime Naruto',
                                        ),
                                    ),
                                ),
                                array(
                                    //"thumbnailImageUrl"=> "https://example.com/bot/images/item2.jpg",
                                    "title" => "Anime Sinopsis",
                                    "text" => "Mau tau sinopsis Anime?",
                                    "actions" => array(
                                        array(
                                            'type' => 'message',
                                            'label' => 'Cari sinopsis Anime',
                                            'text' => 'Cara cari Anime
Ketik
/anime-syn [Judul Anime]
Contoh:
/anime-syn Naruto',
                                        ),
                                    ),
                                ),
                                array(
                                    //"thumbnailImageUrl"=> "https://fmedia.000webhostapp.com/ocelotbg.png",
                                    "title" => "About",
                                    "text" => "Semua tentang WikiBot",
                                    "actions" => array(
                                        array(
                                            'type' => 'message',
                                            'label' => 'About',
                                            'text' => '/about',
                                        ),
                                    ),
                                ),
                                array(
                                    //"thumbnailImageUrl"=> "https://fmedia.000webhostapp.com/ocelotbg.png",
                                    "title" => "Admin",
                                    "text" => "Daftar Admin & Developer",
                                    "actions" => array(
                                        array(
                                            'type' => 'message',
                                            'label' => 'Lihat ADMIN',
                                            'text' => '/admin',
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            );
    
        } else {}
    } else {}

if ($command_datang == '/beli bot') {
		array_push($get_sub,$aa);	

		$get_sub[] = array(
						'type' => 'image',									
						'originalContentUrl' => 'https://www.fmedia.000webhostapp.com/jasa.png',
						'previewImageUrl' => 'https://www.fmedia.000webhostapp.com/jasa.png'
						
					);

		$get_sub[] = array(
									'type' => 'text',									
									'text' => 'Jasa pembuatan BOT OFFICIAL Unlimited Adders Unlimited Fiture

Add OA dibawah Ini
>> http://line.me/ti/p/~wibusenja'
								);
		
		$balas = array(
					'replyToken' 	=> $replyToken,														
					'messages' 		=> $get_sub
				 );	
	}
if ($command_datang == 'WikiBot' || $command_datang == 'Wikibot' || $command_datang == 'wikibot') {
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
										'type' => 'text',					
										'text' => 'Ada apa? '.$profil->displayName.'
Add aja bot ini ya :D'
            )
        )
    );
}
if ($command_datang == '/help: say') {
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
										'type' => 'text',					
										'text' => '- KATAKAN -
Ketik
/say <text>
Contoh:
/say Aku ganteng deh :v

Lalu WikiBot akan mengatakan persis sepertimu'
            )
        )
    );
}
// =============== [ Daftar ADMIN ] ===============
if (isset($balas)) {
    $result = json_encode($balas);
//$result = ob_get_clean();

    file_put_contents('./balasan.json', $result);


    $client->replyMessage($balas);
}
?>
