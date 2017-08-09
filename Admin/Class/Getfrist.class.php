<?php
// +----------------------------------------------------------------------
// | 文章操作类
// +----------------------------------------------------------------------
// | Copyright (c) 2013 IUANCMS All Rights Reserved.
// +----------------------------------------------------------------------
// | Author: IUAN 
// | Web site: http://www.w3cdream.com
// +----------------------------------------------------------------------
	//获取文章中的第一张图片
	Class Getimg{

		var $preg;					//配置的表达式

		var $content;				//匹配的内容

		function __construct($preg,$content,$match){
			$this->preg=$preg;
			$this->content=$content;
		}

		//正则匹配图片
		public function getPreg(){
			preg_match_all($this->preg,$this->content,$match);
			return $match;
		}

		//截取摘要
		public function cutChar($document){
			$document = trim($document);
			if (strlen($document) <= 0){
			  return $document;
			}
			$search = array ("'<script[^>]*?>.*?</script>'si",  // 去掉 javascript

			                  "'<[\/\!]*?[^<>]*?>'si",          // 去掉 HTML 标记

			                  "'([\r\n])[\s]+'",                // 去掉空白字符

			                  "'/\s(?=\s)/'",

			                  "'/[nrt]/'",
			                  
			                  "'/[\n\r\t]/'",

			                  "'/s(?=s)/'",

			                  "'&(quot|#34);'i",                // 替换 HTML 实体

			                  "'&(amp|#38);'i",

			                  "'&(lt|#60);'i",

			                  "'&(gt|#62);'i",

			                  "'&(nbsp|#160);'i"

			                  );                   

			$replace = array ("","","\\1","\"","&","<",">"," ");
			$String=@preg_replace ($search, $replace, $document);
			return $this->sysSubStr($String,500,true);
		}

		//截取字符串长度
		public function sysSubStr($String,$Length,$Append = false){ 
    		if (strlen($String) <= $Length ){ 
        		return $String; 
    		}else{ 
        		$I = 0; 
        	while ($I < $Length) { 
            	$StringTMP = substr($String,$I,1); 
            	if (ord($StringTMP) >=224){ 
                	$StringTMP = substr($String,$I,3); 
                	$I = $I + 3; 
            	}elseif(ord($StringTMP) >=192){ 
                	$StringTMP = substr($String,$I,2); 
                	$I = $I + 2; 
            	}else{ 
                	$I = $I + 1; 
            	} 
            	$StringLast[] = $StringTMP; 
        	} 
        	$StringLast = implode("",$StringLast); 
        	if($Append){ 
            	$StringLast .= "..."; 
        	} 
        	return $StringLast; 
  			} 
		}
	}
?>