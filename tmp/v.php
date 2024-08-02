<?php
if(!isset($type)){exit();}
if(!isset($_GET["cid"]) or !is_numeric($_GET["cid"])){
header("HTTP/1.1 404 Not Found");
include "404.html";
exit();
}
$cid=$_GET["cid"];


$sql=$this->Sql("select  * from  `s_content`  where `cid`='".$this->res($cid)."' limit 0,1");
if($this->num($sql)==0){
header("HTTP/1.1 404 Not Found");
include "404.html";
exit();
}

$a=$this->row2($sql);
$content=$a["content"];
 
$sqlu=$this->Sql("select  `face`,`nickname` from  `s_user`  where `uid`='".$a["uid"]."' limit 0,1");
$u=$this->row2($sqlu);

$this->showhd($a["title"]);

//亲密度
$this->qinmidu($a["uid"]);


$vid=$this->iview($cid); 

?>

<Style>
.logo{height:55px;line-height:50px;font-size:17px;font-weight:bold;vertical-align:middle;background-color:#fff;position:fixed;left:0px;width:100%;top:0px;z-index:55;box-shadow: #b9bcbc 0px 8px 8px -8px;}
.logo #logo{display:inline-block;height:55px;line-height:50px;color:#777;float:left;}
#logo span{display:inline-block;height:50px;width:50px;border-radius:25px;margin-right:5px;margin-left:10px;border:0px;}
.logo img{vertical-align:middle;height:50px;border-radius:25px;}
#qq{float:right;margin-right:10px;font-size:20px;}
.sousuo{height:32px;width:32px;float:right;margin-top:11px;margin-right: 8px;background:#fff;display:inline-block;}
.sousuo img{height:32px;width:32px;}
.hmmm{display:inline-block;height:55px;line-height:55px;float:left;color:#777;font-size:20px;font-weight:bold;margin-left:10px;width:60px;text-align:center;}
</Style>
<div style='height:50px;'></div>
<div class='logo'><a  id='logo' href='/'><span><img src='/public/img/logo.png'/></span></a>

 
<a class='hmmm' href='/?type2=guan'  style='<?php  if($type2=="guan"){ echo "color:#000"; }  ?>'>关注</a>
<a class='hmmm' href='/?type2=tui' style='<?php  if($type2=="tui"){ echo "color:#000"; }  ?>'>推荐</a>
<a class='hmmm' href='/?type2=pai' style='<?php  if($type2=="pai"){ echo "color:#000"; }  ?>'>排行</a> 
<a href='/?type=soso'  class='sousuo'><img src='/public/img/sousuo1.png'/></a>
 

</div>






<style type="text/css">
.art1{margin:10px auto;border-radius:10px;max-width:1000px;}
.art11{background-color:#fff;margin-left:10px;margin-right:50px;border-radius:10px;padding:10px;}
.art1t{font-size:18px;font-weight:bold;line-height:35px;margin:3px 0px 3px 0px;color:#000;font-weight:bold;}
.art1c{line-height:28px;}
.art1a{font-size:12px;color:#999;line-height:25px;padding-right:60px;} 
.art1a img{height:13px;margin-left:3px;vertical-align: middle;margin-top:-2px;margin-right: 1px;}
.art1c img{border-radius:8px;max-width:500px;width:100%;}
.art1tag{line-height:28px;}    
.art1tag a{margin-right:8px;}
</style>

<div class='art1'><div class='art11'>
<div class='art1a'><?php  echo date("Y年m月d日",$a["time"]);  ?>发布 <img src='/public/img/view.png'/><?php  echo $a["view"]; ?></div>
<div class='art1c'><?php  echo $content;  ?></div>
</div></div>
 







<style type="text/css">
.art{margin:10px 10px 0px 10px;border-radius:8px;background-color:#fff;padding:8px;box-shadow: #b9bcbc 0px 8px 8px -8px;}
.artt{line-height:30px;color:#333;font-size:16px;font-weight:bold;} 
.artc{height:52px;line-height:26px;color:#888;overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;}    
 


.picsbx1{float:left;max-width:120px;margin-right:10px;}
.picsbx1 img{max-width:120px;width:100%;border-radius:10px;}

.picsbx2{max-height:80px;line-height:80px; vertical-align: middle;}
.picsbx2 img{width:50%;float:left;max-width:200px;vertical-align:middle;}
.picsbx3{max-height:60px;line-height:60px;vertical-align: middle;}
.picsbx3 img{width:33%;float:left;max-width:200px;vertical-align:middle;}




.user{line-height:45px;}
.user img{width:32px;height:32px;vertical-align:middle;border-radius:16px;margin-right:4px;}
.user a{color:#555;}


.arttm{border-top:1px solid #dedede;margin-top:5px;}
.arttm a{display:inline-block;width:33%;float:left;height:35px;line-height:35px;text-align:center;font-size: 12px;color:#777;}
.arttm img{width:20px;height:20px;vertical-align:middle;margin-right:4px;margin-top:-2px;}
.view{}
</style>
<?php  
$cids=array();
$cids[]=$a["cid"];
if($vid>0){
if($this->here()){
 
$asql=$this->Sql("select  `s_content`.*,`s_user`.`nickname`,`s_user`.`face`,ifnull(`s_clikes`.`lid`,0) as `lid`  from   `s_content` left join `s_user` using(`uid`)  left join `s_clikes` on(`s_content`.`cid`=`s_clikes`.`cid` and `s_clikes`.`uid`='".$_SESSION["uid"]."')  left join `s_cview` on(`s_content`.`cid`=`s_cview`.`cid` and `s_cview`.`uid`='".$_SESSION["uid"]."') where `s_cview`.`vid`<'".$vid."'  order  by  `s_cview`.`vid` desc   limit 0,1");
 
}else{
$asql=$this->Sql("select  `s_content`.*,`s_user`.`nickname`,`s_user`.`face`  from   `s_content` left join `s_user` using(`uid`)    left join `s_cview` on(`s_content`.`cid`=`s_cview`.`cid` and `s_cview`.`uiid`='".$_SESSION["uiid"]."') where `s_cview`.`vid`<'".$vid."'  order  by  `s_cview`.`vid` desc   limit 0,1");

}



while($a3=$this->row2($asql)){
$str="";
$str2=$a3["intro"];
if(preg_match("/picsbx1/",$a3["intro"])){
$str=$a3["intro"];
$str2="";
}

$cids[]=$a3["cid"];
$likepng="unlike";

if($this->here()){
if($a3["lid"]!=0){
$likepng="like";
}
}

echo "<div class='art'>
<Div class='user'><a href='/?type=user&uid=".$a3["uid"]."'><img src='/public/face/".$a3["face"]."'/>".$a3["nickname"]."</a></div>
<a href='/?type=v&cid=".$a3["cid"]."'><div>
".$str."
<div class='artt'>".$a3["title"]."</div>".$str2."
</div></a>
<div class='arttm'>
<a href='/?type=v&cid=".$a3["cid"]."' class='view'><img src='/public/img/view.png'/>".$a3["view"]."</a>
<a href='#' class='llike like cid".$a3["cid"]."' cid='".$a3["cid"]."'><img src='/public/img/".$likepng.".png'/><span>".$a3["likes"]."</span></a>
<a href='/?type=comment&cid=".$a3["cid"]."'><img src='/public/img/comment.png'/>".$a3["comment"]."</a>
</div>
</div>";

 


}





if($this->here()){
 
$asql2=$this->Sql("select  `s_content`.*,`s_user`.`nickname`,`s_user`.`face`,ifnull(`s_clikes`.`lid`,0) as `lid`  from   `s_content` left join `s_user` using(`uid`)  left join `s_clikes` on(`s_content`.`cid`=`s_clikes`.`cid` and `s_clikes`.`uid`='".$_SESSION["uid"]."')  left join `s_cview` on(`s_content`.`cid`=`s_cview`.`cid` and `s_cview`.`uid`='".$_SESSION["uid"]."') where `s_cview`.`vid`>'".$vid."'  order  by  `s_cview`.`vid` asc   limit 0,1");
 
}else{
$asql2=$this->Sql("select  `s_content`.*,`s_user`.`nickname`,`s_user`.`face`  from   `s_content` left join `s_user` using(`uid`)    left join `s_cview` on(`s_content`.`cid`=`s_cview`.`cid` and `s_cview`.`uiid`='".$_SESSION["uiid"]."') where `s_cview`.`vid`>'".$vid."'  order  by  `s_cview`.`vid` asc   limit 0,1");

}

while($a2=$this->row2($asql2)){
$str="";
$str2=$a2["intro"];
if(preg_match("/picsbx1/",$a2["intro"])){
$str=$a2["intro"];
$str2="";
}
$cids[]=$a2["cid"];

$likepng="unlike";

if($this->here()){
if($a2["lid"]!=0){
$likepng="like";
}
}

echo "<div class='art'>
<Div class='user'><a href='/?type=user&uid=".$a2["uid"]."'><img src='/public/face/".$a2["face"]."'/>".$a2["nickname"]."</a></div>
<a href='/?type=v&cid=".$a2["cid"]."'><div>
".$str."
<div class='artt'>".$a2["title"]."</div>".$str2."
</div></a>
<div class='arttm'>
<a href='/?type=v&cid=".$a2["cid"]."' class='view'><img src='/public/img/view.png'/>".$a2["view"]."</a>
<a href='#' class='llike like cid".$a2["cid"]."' cid='".$a2["cid"]."'><img src='/public/img/".$likepng.".png'/><span>".$a2["likes"]."</span></a>
<a href='/?type=comment&cid=".$a2["cid"]."'><img src='/public/img/comment.png'/>".$a2["comment"]."</a>
</div>
</div>";

 


}


}


?>




<?php  

$likes="";
$likes1="";
if($this->here()){
$likes="left join `s_clikes` on(`s_content`.`cid`=`s_clikes`.`cid` and `s_clikes`.`uid`='".$_SESSION["uid"]."')";
$likes1=",ifnull(`s_clikes`.`lid`,0) as `lid` ";
}

$mc="MATCH (`s_content`.`fulltext1`) AGAINST ('".mb_substr($a["fulltext1"],0,200)."')";

$asql=$this->Sql("select  `s_content`.*,`s_user`.`nickname`,`s_user`.`face`".$likes1.",".$mc." as `mc` from   `s_content` left join `s_user` using(`uid`)  ".$likes."  where ".$mc." order  by  `mc` desc   limit 0,15");
  
 
while($a4=$this->row2($asql)){
$haveapi=array_search($a4["cid"],$cids);
if($haveapi===false){ 
 
$str111="";
$str2111=$a4["intro"];
if(preg_match("/picsbx1/",$a4["intro"])){
$str=$a4["intro"];
$str2111="";
}


$likepng2="unlike";

if($this->here()){
if($a4["lid"]!=0){
$likepng2="like";
}
}

echo "<div class='art'>
<Div class='user'><a href='/?type=user&uid=".$a4["uid"]."'><img src='/public/face/".$a4["face"]."'/>".$a4["nickname"]."</a></div>
<a href='/?type=v&cid=".$a4["cid"]."'><div>
".$str111."
<div class='artt'>".$a4["title"]."</div>".$str2111."
</div></a>
<div class='arttm'>
<a href='/?type=v&cid=".$a4["cid"]."' class='view'><img src='/public/img/view.png'/>".$a4["view"]."</a>
<a href='#' class='like cid".$a4["cid"]."' cid='".$a["cid"]."'><img src='/public/img/".$likepng2.".png'/><span>".$a4["likes"]."</span></a>
<a href='/?type=comment&cid=".$a4["cid"]."'><img src='/public/img/comment.png'/>".$a4["comment"]."</a>
</div>
</div>";

 
 }

}
?>



<script>
$(function(){


$(".like").click(function(){
var cid=$(this).attr("cid");
$.post("/index.php",{"api":"pb","api2":"clikes","cid":cid},function(json){
if(json[0]==1){
$(".cid"+cid+" img").attr("src","/public/img/"+json[1]+".png"); 
var likes=parseInt($(".cid"+cid+" span").html());
if(json[1]=="like"){
$(".cid"+cid+" span").html(likes+1);
}else{
$(".cid"+cid+" span").html(likes-1);    
}
}else{
rs(json[1]);
}
},"json");
return false;
});

 


}); 



</script>













   
    
<style type="text/css">
.rm{position:fixed;z-index:35;bottom:160px;right:10px;width:50px;padding-bottom:8px;}
.rmface{width:50px;height:50px;border-radius:25px;background-color:#fff;}
.rmface img{border-radius:23px;width:46px;height:46px;margin-top:2px;margin-left:2px;}

.follow{background-color:rgb(254,44,85);width:16px;height:16px;display:inline-block;border-radius:8px;color:#fff;font-weight:bold;line-height:16px;text-align:center;font-size: 16px;position:absolute;left:17px;top:42px;}
.rlike{margin-top:15px;display:inline-block;width:50px;text-align:center;color:#777;}
.rlike img{width:40px;}  
.comment{margin-top:15px;display:inline-block;width:50px;text-align:center;color:#777;}
.comment img{width:40px;}  
.share{margin-top:15px;display:inline-block;width:50px;text-align:center;color:#d61f7f;font-size:12px;line-height:22px;}
.share img{width:40px;}  
.shoucang{margin-top:15px;display:inline-block;width:50px;text-align:center;color:#FFA919;font-size:12px;line-height:22px;}
.shoucang img{width:40px;}  
</style>
<div class='rm'>
<div class='rmface'><a href="/?type=user&uid=<?php  echo $a["uid"]; ?>"><img src='/public/face/<?php echo $u["face"]; ?>'/></a></div>  
<?php 
$g=0;
if($this->here()){
$fsql=$this->sql("SELECT * FROM `s_follow` where `uid`='".$_SESSION["uid"]."' and `uid2`='".$a["uid"]."' ");
if($this->num($fsql)==1){
$g=1;
}
}

if($g==0){
 ?>

<a  href='#' class='follow'  uid='<?php echo $a["uid"]; ?>'>+</a>
<?php } ?>


<a  href='#' class='rlike like cid<?php  echo $a["cid"];?>' cid='<?php echo $a["cid"]; ?>'><img src='/public/img/<?php $likes="unlike"; if($this->here()){
$sqll=$this->sql("select `lid` from `s_clikes` where `uid`='".$_SESSION["uid"]."' and `cid`='".$this->res($cid)."'");
if($this->num($sqll)==1){
$likes="like";
}
}

echo $likes;
 ?>.png'/><br/><span><?php echo $a["likes"]; ?></span></a>
<a  href='/?type=comment&cid=<?php echo $cid; ?>' class='comment'><img src='/public/img/comment.png'/><br/><?php echo $a["comment"]; ?></a>
<a  href='#' class='shoucang'><img src='/public/img/shoucang.png'/><br/>收藏</a>
<a  href='#' class='share'><img src='/public/img/share.png'/><br/>分享</a>
</div>


<script>
$(function(){

// 关注
$(".follow").click(function(){

$.post("/index.php",{"api":"user","api2":"follow","uid2":"<?php echo $a["uid"]; ?>"},function(json){
if(json[0]==1){
$(".follow").html("√");
$(".follow").css({"background-color":"#fff","color":"rgb(254,44,85)"});
$(".follow").animate({width:"24px",height:"24px",left:"13px",top:"38px"}).animate({width:"6px",height:"6px",left:"22px",top:"47px"},function(){$(this).remove();});
}else{
rs(json[1]);
}    
},"json");
 


return false;
});



//点赞
$(".like").click(function(){
var cid=$(this).attr("cid");
$.post("/index.php",{"api":"pb","api2":"clikes","cid":cid},function(json){
if(json[0]==1){
$(".cid"+cid+" img").attr("src","/public/img/"+json[1]+".png"); 
var likes=parseInt($(".cid"+cid+" span").html());
if(json[1]=="like"){
$(".cid"+cid+" span").html(likes+1);
}else{
$(".cid"+cid+" span").html(likes-1);	
}
}else{
rs(json[1]);
}
},"json");
return false;
});

 


});	



</script>

<script type="text/javascript">
  
$(function(){


$(".shoucang").click(function(){
rs("请使用手机浏览器自带收藏功能进行收藏。<br/><img src='https://sinpark.com/erweima.php?url=<?php  echo urlencode("http://".$_SERVER["SERVER_NAME"]."/?type=v&cid=".$cid);?>'/><br/>用手机浏览器扫一扫");
return false;
});

$(".share").click(function(){
rs("请使用手机浏览器自带分享功能进行分享。<br/><img src='https://sinpark.com/erweima.php?url=<?php  ?><?php  echo urlencode("http://".$_SERVER["SERVER_NAME"]."/?type=v&cid=".$cid);?>'/><br/>用手机浏览器扫一扫");
return false;
});

});
</script>

<style>
.title{position:fixed;bottom:71px;z-index:33;left:0px;width:100%;background-color:#fff;opacity:0.75;color:#000;}   
.title1{margin-right:60px;margin-left:10px; line-height:24px;font-size:14px;}
.title0{line-height:28px;font-size:16px;margin-left:10px;}
.title22{height:65px;}
</style>
<div class='title'>
<div class='title0'>@<?php echo $u["nickname"]; ?></div>
<div class='title1'><?php echo $a["title"];  ?></div></div>
<div class='title22'></div>

<?php  
include 'com/ft.php';

?>