<?php
$banner = "\e[36;1m                                                                                 
                                                                                 
           #         ######   
           #    #             
  ######   #    #  ########## 
           #    #  #        # 
           #######        ##  
##########      #       ##    
                #     ##      
                              
                                                                                 
[#] Facebook Bot Comment [#]    
                                   
Coded by : Revan AR                  
Team     : IndoSec                   
Github   : https//github.com/revan-ar/\n\n\e[0;1m";
sleep(3);
echo $banner;
sleep(2);

echo ">>> Access Token : ";
$toket = trim(fgets(STDIN));
sleep(2);
echo "\n(tanda plus untuk spasi dan gunakan (br) untuk baris baru)\n";
sleep(3);
echo ">>> Text bot : ";
$text = trim(fgets(STDIN));
sleep(1);
echo "Sedang Menjalankan Bot....\n";
sleep(5);
echo "[+] Result [+]\n\n";

for ($i=1; $i; $i++) {
	
	$cok = curl_init();
		curl_setopt($cok, CURLOPT_URL, "https://graph.facebook.com/v3.2/me/friends?access_token=".$toket);
		curl_setopt($cok, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($cok, CURLOPT_HEADER, 0);
	$exe = curl_exec($cok);
	curl_close($cok);
	$id = json_decode($exe);
	$count = $id->summary->total_count;

	$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/v3.2/me/friends?access_token=".$toket."&pretty=1&fields=name&limit=".$count);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
	$exe = curl_exec($ch);
	curl_close($ch);
	$id_teman = json_decode($exe);

	$rand = rand(0, count($id_teman->data));
	$get_friend_status = $id_teman->data[$rand]->id;
	$cok = curl_init();
		curl_setopt($cok, CURLOPT_URL, "https://graph.facebook.com/v3.2/".$get_friend_status."/feed?access_token=".$toket);
		curl_setopt($cok, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($cok, CURLOPT_HEADER, 0);
	$exe = curl_exec($cok);
	curl_close($cok);

	$id_post = json_decode($exe);
	$target = $id_post->data[0]->id;

	$ganti = str_replace("(br)", "\n", $text);
	$asu = curl_init();
		curl_setopt($asu, CURLOPT_URL, "https://graph.facebook.com/v3.2/".$target."/comments/?access_token=".$toket);
		curl_setopt($asu, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($asu, CURLOPT_HEADER, 0);
		curl_setopt($asu, CURLOPT_POST, 1);
		curl_setopt($asu, CURLOPT_POSTFIELDS, "message=".$ganti);
	$su = curl_exec($asu);
	curl_close($asu);

	$respon = json_decode($su);

	if(!empty($respon->id)) {
		echo "BOT SUKSES !!!!\n";
	}else{
		echo "BOT GAGAL :(\n";
		}
		
	sleep(30);

}