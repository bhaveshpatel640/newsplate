<?php
function store_news($db,$feedUrl,$category){

 $raw=get_xml($feedUrl);
 $xml = new SimpleXmlElement($raw);

  foreach ($xml->channel->item as $item) {
      $title         =$item->title;
      $title=RemoveBS(htmlallentities($title));
      $link          =$item->link;
      $comments      =$item->comments;
      $pubDate       =$item->pubDate;
      $pubDate       =getdateformat($pubDate);
      $creater       =$item->children('dc', true)->creater;
      $guid          =$item->guid;
      $contentEncoded=$item->children('content', true)->encoded;
      $description   =$item->description;
      $description=decodeP(clearbrackets(RemoveBS(htmlallentities(strip_tags(encodeP($description.".".$contentEncoded))))));
      $news_feed     =$item->children('wfw', true)->commentRss;
      $imageTitle    =$item->mediacontent->children('media', true)->title;
      $imagesrcorginal=$item->mediacontent[2]['url'];
      $imageSrc      =$item->mediathumbnail['url'];

      if (empty($imagesrcorginal)===false) {
              $imageSrc =$imagesrcorginal;
        }
       
        if(!news_exists($db,$link)){
            if(!check_image_link($imageSrc)) {
              $imageSrc="images/noimage.jpg";
            }
            insert_news($db,$title,$link,$pubDate,$creater,$category,$description,$news_feed,$imageSrc,$imageTitle);
            
        }
    }
  }

function encodeP($str){
$str= str_replace("<p>"," paragraphstart ",$str);
$str= str_replace("</p>"," paragraphend ",$str);
return $str;
}

function decodeP($str){
$str= str_replace("paragraphstart","<p>",$str);
$str= str_replace("paragraphend","</p>",$str);
return $str;
}

function get_xml($feedUrl){
  $rawFeed = file_get_contents($feedUrl); 
  $rawFeed= str_replace("media:thumbnail","mediathumbnail",$rawFeed);
  $rawFeed= str_replace("media:content","mediacontent",$rawFeed);
  $rawFeed= str_replace("]]></description>","",$rawFeed);
  $rawFeed= str_replace("<content:encoded>","]]></description><content:encoded>",$rawFeed);
  return $rawFeed;
}


function isRssLinkExist($db,$link){
    if($result=$db->query("SELECT * From categorylist WHERE categoryLink='$link'")){
    
                  if($result->num_rows) {      //Return true if news exists else return false
                        return true;
                  }
                  else
                    return false;
    }
}

function getmonthnum($month){
switch ($month) {
 
  case 'Jan':
    return '01';
    break;
  case 'Feb':
    return '02';
    break;
  case 'Mar':
    return '03';
    break;
  case 'Apr':
    return '04';
    break;
  case 'May':
    return '05';
    break;
  case 'Jun':
    return '06';
    break;
  case 'Jul':
    return '07';
    break;
  case 'Aug':
    return '08';
    break;
  case 'Sep':
    return '09';
    break;
  case 'Oct':
    return '10';
    break;
  case 'Nov':
    return '11';
    break;
  case 'Dec':
    return '12';
    break;
  
  }
}
//2012-12-12 01:44:20

// Thu, 24 Sep 2015 00:30:07
// 012345678901234567890123456789
function getdateformat($pubDate) {
  return substr($pubDate,12,4)."-".getmonthnum(substr($pubDate,8,3))."-".substr($pubDate,5,2)." ".substr($pubDate,17,2).":".substr($pubDate,20,2).":".substr($pubDate,23,2);
}

function getnewsid($db,$link){
  if($result=$db->query("SELECT news_id From news WHERE link='$link'")){
    
               $row=$result->fetch_assoc();
               return $row['news_id'];
    }
}


function check_image_link($src){
  $flag=0;
  if(preg_match('/.jpg/',$src)==1)
    $flag=1;
  else if(preg_match('/.png/',$src)==1)
    $flag=1;
  else if(preg_match('/.gif/',$src)==1)
    $flag=1;
 
  if($flag==1)
    return true;
  else
    return false;

}


function news_exists($db,$link){
  if($result=$db->query("SELECT * From news WHERE link='$link'")){
    
                  if($result->num_rows) {      //Return true if news exists else return false
                        return true;
                  }
                  else
                    return false;
    }
}

function insert_news($db1,$title,$link,$pubDate,$creater,$category,$description,$news_feed,$imageSrc,$imageTitle){
  
  if($result=$db1->query("INSERT into news(title,link,pubDate,creater,category,description,news_feed,imageSrc,imageText) VALUES ('$title','$link','$pubDate','$creater','$category','$description','$news_feed','$imageSrc','$imageTitle')"))
  {
    //echo 'You successfully Entered..';
  } else {
           // echo 'Problem Occured'.$title;
  }
}

function clearbrackets($string){
  $stlen=strlen($string);
  $j=0;
  $flag=0;
  $str="";
  while ($j < $stlen-1) {

    if ($string[$j]=='[') {
      $flag=1;
    }
    else if ($string[$j]==']') {
      $j++;
      $flag=0;
    }

    if($flag==0){
      $str.=$string[$j];
    }

    $j++;
  }

      return $str;
}

function create_description($description){
  $diff=strlen($description)-214;

      if($diff>0){
        $description=substr($description,0,214);
        $description=$description.'...';
      }
      else{
        $x=-$diff;
        while ($x>0) {
            $description=$description." ";
            $x--;
        }
      }
      return $description;
}


// function protect_page(){
// 	if (logged_in()) {
// 		header('Location: protected_login'); ///implement this function only to those page which is user specific.
// 	}
// }

function htmlallentities($str){
      $res = '';
      $strlen = strlen($str);
        for($i=0; $i<$strlen; $i++){
          $byte = ord($str[$i]);
            if($byte < 128) // 1-byte char
              $res .= $str[$i];
            elseif($byte < 192); // invalid utf8
            elseif($byte < 224) // 2-byte char
              $res .= '&#'.((63&$byte)*64 + (63&ord($str[++$i]))).';';
            elseif($byte < 240) // 3-byte char
              $res .= '&#'.((15&$byte)*4096 + (63&ord($str[++$i]))*64 + (63&ord($str[++$i]))).';';
            elseif($byte < 248) // 4-byte char
              $res .= '&#'.((15&$byte)*262144 + (63&ord($str[++$i]))*4096 + (63&ord($str[++$i]))*64 + (63&ord($str[++$i]))).';';
        }
        return $res;
}

function RemoveBS($Str) {  
  $StrArr = str_split($Str); $NewStr = '';
  foreach ($StrArr as $Char) {    
    $CharNo = ord($Char);
    if ($CharNo == 163) { $NewStr .= $Char; continue; } // keep £
    if ($CharNo > 31 && $CharNo < 127) {
      $NewStr .= $Char;    
    }
  }  
  return $NewStr;
}

function sanitize($data){	
  	return mysqli_real_escape_string($data);
}

function logout(){
	session_start();
	session_destroy();
	header("Location :http://localhost/WT%20project/materialize/index.php");
	exit();
}
?>