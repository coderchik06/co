<?php
define('API_KEY','1297794420:AAGqPUEDc0rkogT36ocpaYdI4MDCQKYdOkE');
$admin = "621617473";
$kanal = "-1001153541413";




function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$cid = $message->chat->id;
$name = $message->chat->first_name;
$user1 = $message->from->username;
$tx = $message->text;
$step = file_get_contents("step/$cid.step");
$mid = $message->message_id;
$type = $message->chat->type;
$text = $message->text;
$uid= $message->from->id;
$name = $message->from->first_name;
$newid = $message->new_chat_member->id;
$username = $message->from->username;
$newname = $message->new_chat_member->first_name;
$data = $update->callback_query->data;
$cid2 = $update->callback_query->message->chat->id; 
$cqid = $update->callback_query->id;
$chat_id2 = $update->callback_query->message->chat->id;
$ch_user2 = $update->callback_query->message->chat->username;
$message_id2 = $update->callback_query->message->message_id;
$fadmin = $message->from->id;

$name2 = $update->callback_query->from->first_name;
$step = file_get_contents("$cid.step");



mkdir("data");


$lichka = file_get_contents("CoDeR.ids");
if($type=="private"){
if(strpos($lichka,"$uid") !==false){
}else{
file_put_contents("CoDeR.ids","$lichka\n$uid");
}
} 

@$juser = json_decode(file_get_contents("user.json"),true); 
$user_list = $juser["user_list"];
 
if($type=="private"){
if(strpos($user_list,"$uid") !==false){
}else{
$juser["user_list"]=$uid.'|'.$user_list;
$juser = json_encode($juser,true);
file_put_contents("user.json",$juser);
}
}

@$command = file_get_contents("data/$cid.step");

$key = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"👫Juftli rasm👫"],['text'=>"👨‍💼Yakkali rasm👩‍💼"]],
[['text'=>"Statistika📊"],],
]
]);



if($data=="join"){
$check1 = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=$kanal&user_id=$cid2"))->result->status;
if($check1 != "member" && $check1 != "creator" && $check1 != "administrator"){
  bot('answerCallbackQuery',[
'callback_query_id'=>$cqid,
'text'=>"🚫Kechirasiz ,

Siz Kanalimizga azo bolmadingiz",
'show_alert'=>true
]);
}else{
        bot('answerCallbackQuery',[
'callback_query_id'=>$cqid,
'text'=>"✅Urraaaa,
Siz kanalimizga azo boldingiz",
'show_alert'=>true
]);
bot('deletemessage',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
]);
bot('sendphoto',[
'photo'=>"https://t.me/hacker_progi/53642",
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
	    'caption'=>"⌚ Salom <a href = 'tg://user?id=$cid2'>$name2</a> 
🤖: <b>Men orqali ismingiz ajoyib rasmga joylashingiz mumkin

Buning uchun pastdagi bolimlarni birini tanlang</b>👇",
    'parse_mode'=>'html',
    'reply_markup'=>$key,
    ]);
}
}


$vaqt = date("d",strtotime("5 hour"));
$otex = "💫 Ortga qaytish";

$otmen = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"$otex"],],
]
]);

$keyi = json_encode([ 
        'inline_keyboard'=>[ 
       [['text'=>"👫Do'stlarga ulashish💌", "url"=>"https://telegram.me/share/url?url=@MultikName_bot  👈😘Telegramdagi eng zor bot ekan, Yaqinda qo'shildim manga judayam yoqdi 
🌅 Ajoyib Multik  rasm yasab berar ekan"]], 
       ] 
       ]);

$panel = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"📤Send oddiy"],['text'=>"📤Send Forward"],],
[['text'=>"💫 Ortga qaytish"],['text'=>"Bekor qilish⛔"]],
]
]);

if ($text == "/admin" and $cid == $admin){
bot ('SendMessage', [
'chat_id'=> $cid,
'text'=>"👨‍💻Admin paneli:",
'reply_to_message_id'=> $mid,
'reply_markup'=> $panel,
]);
}

if($text=="/start"){
	
bot('sendphoto',[
'photo'=>"https://t.me/hacker_progi/53642",
    'chat_id'=>$cid,
    'caption'=>"⌚ *Salom* [$name](tg://user?id=$cid)  🤖: *Men orqali ismingiz ajoyib rasmga joylashingiz mumkin

Buning uchun pastdagi bolimlarni birini tanlang*👇",
    'parse_mode'=>'markdown',
    'reply_markup'=>$key,
    ]);
}



if($text== $otex){
unlink("data/$cid.step");
unlink("data/goto.jpg");
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"⤵ Bosh menuga qaytingiz!",
'reply_markup'=>$key,
]);
}
if($text == "👫Juftli rasm👫"){

bot('sendphoto', [
'chat_id' => $cid,
'photo'=>"https://t.me/hacker_progi/53638",
'caption'=>"*O'zingizga yoqqan rasmga ism yozish uchun bittasini tanlang*👇",
'parse_mode'=>'markdown',
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard' => [
[['text'=>"1⃣",'callback_data'=>"juft1"],['text'=>"2⃣",'callback_data'=>"juft2"]]
]
]),
]);
}

if ($data == "juft1"){
file_put_contents("data/$cid2.step","juft1");
bot ('sendmessage', [
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"*Ismingizni  rasmga tushirish uchun ismingizni yuboring*✍

*Namuna:*❗
`Sarvar+Madina`",
       'parse_mode'=>'markdown',
       'reply_markup'=>$otmen,
]);
bot ('deletemessage', [
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
]);
}

if($command == "juft1"){
	if($text=="💫 Ortga qaytish"){
}else{
bot('sendphoto', [
'chat_id' => $cid,
'photo'=>"https://github.com/coderchik06/co/blob/master/juft2.php?text=$text",
'caption'=>"📋*Buyurtma*: *$text*

➡ [Dardlarim...😕](https://t.me/joinchat/AAAAAETBpSWxAFjppkDCow) ⬅
➡[Asabchalar🤣](https://t.me/joinchat/AAAAAEcKyzKaJ-UAP7flIg)⬅

[@MultikName_bot] *O'z ismingizni chiroyli rasmlarga qoyib beruvchi bot*",
'reply_to_message_id'=>$mid,
'parse_mode'=>'markdown',
'reply_markup'=>$keyi,
]);
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*👆Do'stlaringizga ham yuboring va ularni ham habardor qiling😃* ",
'parse_mode'=>'markdown',
'reply_markup'=>$key,
]);
file_put_contents("data/$cid.step","none");
unlink("data/$cid.step");
unlink("data/goto.jpg");
}
}

if ($data == "juft2"){
file_put_contents("data/$cid2.step","juft2");
bot ('sendmessage', [
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"*Ismingizni  rasmga tushirish uchun ismingizni yuboring*✍

*Namuna:*❗
`Sarvar+Madina`",
       'parse_mode'=>'markdown',
       'reply_markup'=>$otmen,
]);
bot ('deletemessage', [
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
]);
}

if($command == "juft2"){
	if($text=="💫 Ortga qaytish"){
}else{
bot('sendphoto', [
'chat_id' => $cid,
'photo'=>"https://github.com/coderchik06/co/blob/master/juft1.php?text=$text",
'caption'=>"📋*Buyurtma*: *$text*

➡ [Dardlarim...😕](https://t.me/joinchat/AAAAAETBpSWxAFjppkDCow) ⬅
➡[Asabchalar🤣](https://t.me/joinchat/AAAAAEcKyzKaJ-UAP7flIg)⬅

[@MultikName_bot] *O'z ismingizni chiroyli rasmlarga qoyib beruvchi bot*",
'reply_to_message_id'=>$mid,
'parse_mode'=>'markdown',
'reply_markup'=>$keyi,
]);
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*👆Do'stlaringizga ham yuboring va ularni ham habardor qiling😃* ",
'parse_mode'=>'markdown',
'reply_markup'=>$key,
]);
file_put_contents("data/$cid.step","none");
unlink("data/$cid.step");
unlink("data/goto.jpg");
}
}

if($text == "👨‍💼Yakkali rasm👩‍💼"){
bot('sendphoto', [
'chat_id' => $cid,
'photo'=>"https://t.me/hacker_progi/53639",
'caption'=>"*O'zingizga yoqqan rasmga ism yozish uchun bittasini tanlang*👇",
'parse_mode'=>'markdown',
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard' => [
[['text'=>"1⃣",'callback_data'=>"yakka1"],['text'=>"2⃣",'callback_data'=>"yakka2"]],
[['text'=>"3⃣",'callback_data'=>"yakka3"],['text'=>"4⃣",'callback_data'=>"yakka4"]]
]
]),
]);
}


if ($data == "yakka1"){
file_put_contents("data/$cid2.step","yakka1");
bot ('sendmessage', [
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"*Ismingizni  rasmga tushirish uchun ismingizni yuboring*✍
",
       'parse_mode'=>'markdown',
       'reply_markup'=>$otmen,
]);
bot ('deletemessage', [
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
]);
}

if($command == "yakka1"){
	if($text=="💫 Ortga qaytish"){
}else{
bot('sendphoto', [
'chat_id' => $cid,
'photo'=>"https://github.com/coderchik06/co/blob/master/toq1.php?text=$text",
'caption'=>"📋*Buyurtma*: **$text**

➡ [Dardlarim...😕](https://t.me/joinchat/AAAAAETBpSWxAFjppkDCow) ⬅
➡[Asabchalar🤣](https://t.me/joinchat/AAAAAEcKyzKaJ-UAP7flIg)⬅

[@MultikName_bot] *O'z ismingizni chiroyli rasmlarga qoyib beruvchi bot*",
'reply_to_message_id'=>$mid,
'parse_mode'=>'markdown',
'reply_markup'=>$keyi,
]);
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*👆Do'stlaringizga ham yuboring va ularni ham habardor qiling😃* ",
'parse_mode'=>'markdown',
'reply_markup'=>$key,
]);
file_put_contents("data/$cid.step","none");
unlink("data/$cid.step");
unlink("data/goto.jpg");
}
}
if ($data == "yakka2"){
file_put_contents("data/$cid2.step","yakka2");
bot ('sendmessage', [
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"*Ismingizni  rasmga tushirish uchun ismingizni yuboring*✍
",
       'parse_mode'=>'markdown',
       'reply_markup'=>$otmen,
]);
bot ('deletemessage', [
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
]);
}

if($command == "yakka2"){
	if($text=="💫 Ortga qaytish"){
}else{
bot('sendphoto', [
'chat_id' => $cid,
'photo'=>"https://github.com/coderchik06/co/blob/master/toq2.php?text=$text",
'caption'=>"📋*Buyurtma*: **$text**

➡ [Dardlarim...😕](https://t.me/joinchat/AAAAAETBpSWxAFjppkDCow) ⬅
➡[Asabchalar🤣](https://t.me/joinchat/AAAAAEcKyzKaJ-UAP7flIg)⬅

[@MultikName_bot] *O'z ismingizni chiroyli rasmlarga qoyib beruvchi bot*",
'reply_to_message_id'=>$mid,
'parse_mode'=>'markdown',
'reply_markup'=>$keyi,
]);
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*👆Do'stlaringizga ham yuboring va ularni ham habardor qiling😃* ",
'parse_mode'=>'markdown',
'reply_markup'=>$key,
]);
file_put_contents("data/$cid.step","none");
unlink("data/$cid.step");
unlink("data/goto.jpg");
}
}
if ($data == "yakka3"){
file_put_contents("data/$cid2.step","yakka3");
bot ('sendmessage', [
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"*Ismingizni  rasmga tushirish uchun ismingizni yuboring*✍
",
       'parse_mode'=>'markdown',
       'reply_markup'=>$otmen,
]);
bot ('deletemessage', [
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
]);
}

if($command == "yakka3"){
	if($text=="💫 Ortga qaytish"){
}else{
bot('sendphoto', [
'chat_id' => $cid,
'photo'=>"https://github.com/coderchik06/co/blob/master/toq3.php?text=$text",
'caption'=>"📋*Buyurtma*: **$text**

➡ [Dardlarim...😕](https://t.me/joinchat/AAAAAETBpSWxAFjppkDCow) ⬅
➡[Asabchalar🤣](https://t.me/joinchat/AAAAAEcKyzKaJ-UAP7flIg)⬅

[@MultikName_bot] *O'z ismingizni chiroyli rasmlarga qoyib beruvchi bot*",
'reply_to_message_id'=>$mid,
'parse_mode'=>'markdown',
'reply_markup'=>$keyi,
]);
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*👆Do'stlaringizga ham yuboring va ularni ham habardor qiling😃* ",
'parse_mode'=>'markdown',
'reply_markup'=>$key,
]);
file_put_contents("data/$cid.step","none");
unlink("data/$cid.step");
unlink("data/goto.jpg");
}
}
if ($data == "yakka4"){
file_put_contents("data/$cid2.step","yakka4");
bot ('sendmessage', [
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'text'=>"*Ismingizni  rasmga tushirish uchun ismingizni yuboring*✍
",
       'parse_mode'=>'markdown',
       'reply_markup'=>$otmen,
]);
bot ('deletemessage', [
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
]);
}

if($command == "yakka4"){
	if($text=="💫 Ortga qaytish"){
}else{
bot('sendphoto', [
'chat_id' => $cid,
'photo'=>"https://github.com/coderchik06/co/blob/master/toq4.php?text=$text",
'caption'=>"📋*Buyurtma*: **$text**

➡ [Dardlarim...😕](https://t.me/joinchat/AAAAAETBpSWxAFjppkDCow) ⬅
➡[Asabchalar🤣](https://t.me/joinchat/AAAAAEcKyzKaJ-UAP7flIg)⬅

[@MultikName_bot] *O'z ismingizni chiroyli rasmlarga qoyib beruvchi bot*",
'reply_to_message_id'=>$mid,
'parse_mode'=>'markdown',
'reply_markup'=>$keyi,
]);
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"*👆Do'stlaringizga ham yuboring va ularni ham habardor qiling😃* ",
'parse_mode'=>'markdown',
'reply_markup'=>$key,
]);
file_put_contents("data/$cid.step","none");
unlink("data/$cid.step");
unlink("data/goto.jpg");
}
}
if($text == "Statistika📊"){

$vaq = date("⏰H:i  📅d_m_Y",strtotime("2 hour"));
$baza = file_get_contents("CoDeR.ids");
$us = substr_count($baza,"\n"); 
$del = explode('|', $user_list);
$cou = count($del);
     bot('sendMessage',[
     'chat_id'=>$cid,
     'text'=>"*🔹Botimiz Azolari👥: * [$us] *ta!*\n 🔹 [$vaq]",
     'parse_mode'=>'markdown',
     ]);
bot('sendMessage',[
     'chat_id'=>$cid,
     'text'=>"*🔹Botimiz Azolari👥: * [$cou] *ta!*\n 🔹 [$vaq]",
     'parse_mode'=>'markdown',
     ]);
     }
     
     if($text == "Bekor qilish⛔"&&$cid==$admin){
      bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"Xabar yuborish Bekor qilindi!",
'parse_mode'=>"html",
'reply_markup'=>$panel,
]);
      unlink("send.ok");
      unlink("send.no");
      }
    
    if ($text == "📤Send oddiy" and $cid == $admin ){
        file_put_contents("$cid.step", "send");
        bot('sendmessage', [
            'chat_id' => $cid,
            'text' => "Xabaringizni yuboring",
            'reply_to_message_id'=>$mid,
            'reply_markup'=>$panel
        ]);
    } 
if ($step== "send") {
        file_put_contents("$cid.step", "no");
        $fp = fopen("CoDeR.ids", 'r');
        while (!feof($fp)) {
            $ckar = fgets($fp);
            bot('sendMessage', [
'chat_id'=>$ckar,
'text'=>$text,
]);
        }
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "Xabar muofaqiyatli yuborildi",
            'reply_to_message_id'=>$mid,
            'reply_markup' => $panel
        ]);
        unlink("$cid.step");
    } 
if ($text == "📤Send Forward" and $cid == $admin){
        file_put_contents("$cid.step", "fwd");
        bot('sendmessage', [
            'chat_id' => $cid,
            'text' => "Xabaringizni yuboring",
            'reply_to_message_id'=>$mid,
            'reply_markup'=>$key
        ]);
    } 
if ($step == 'fwd') {
        file_put_contents("$cid.step", "no");
        $forp = fopen("CoDeR.ids", 'r');
        while (!feof($forp)) {
            $fakar = fgets($forp);
            bot('forwardMessage', [
'chat_id'=>$fakar,
'from_chat_id'=>$cid,
'message_id'=>$mid,
]);
        }
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "Xabar yuborildi",
            'reply_to_message_id'=>$mid,
            'reply_markup' => $key
        ]);
        unlink("$cid.step");
    } 


if($text == '/code' and $cid == $admin){
bot('sendDocument',[
'chat_id'=>$cid,
'document'=>new CURLFile(__FILE__),
'caption'=>" <b>code</b>",
'parse_mode'=>"html",
'reply_to_message_id'=>$mid,
]);
}
