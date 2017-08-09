<?php
/******************************************************************
	@filename: File.class.php
	
	@function: 文件处理类

	@author:pengyong.info
	
	@date: 2012-10-11 09:32:33

	@copyright: centphp.com
*******************************************************************/
class File
{
	/*
		@function  		创建目录
		
		@var:$filename  目录名
			
		@return:   		true
	*/
	
	static public function mk_dir($dir)
	{
		$dir = rtrim($dir,'/').'/';
		if(!is_dir($dir))
		{
			if(mkdir($dir, 0700)==false)
			{
				return false;
			}
			return true;
		}
		return true;
	}
	

	/*
		@function  		读取文件内容
		
		@var:$filename  文件名
			
		@return:   		文件内容
	*/
	
	static public function read_file($filename)
	{
		$content = '';
		if(function_exists('file_get_contents')) 
		{
			@$content = file_get_contents($filename);
		}
		else
		{
			if(@$fp = fopen($filename, 'r'))
			{
				@$content = fread($fp, filesize($filename));
				@fclose($fp);
			}
		}
		return $content;
	}
	
	/*
		@function  		写文件
		
		@var:$filename  文件名
		
		@var:$writetext 文件内容
		
		@var:$openmod 	打开方式
			
		@return:   		成功=true
	*/
	
	static function write_file($filename, $writetext, $openmod='w')
	{
		if(@$fp = fopen($filename, $openmod)) 
		{
			flock($fp, 2);
			fwrite($fp, $writetext);
			fclose($fp);
			return true;
		}
		else 
		{ 
			return false;
		}
	}
	

	/*
		@function  		删除目录
		
		@var:$dirName  	原目录
			
		@return:   		成功=true
	*/
	
	static function del_dir($dirName)
	{
		if (!file_exists($dirName))
		{
			return false;
		}
    
		$dir = opendir($dirName);
		while ($fileName = readdir($dir))
		{
			$file = $dirName . '/' . $fileName;
			if ($fileName != '.' && $fileName != '..') 
			{
				if (is_dir($file))
				{
					self::del_dir($file);
				} 
				else 
				{
					unlink($file);
				}            
			}
		}
		closedir($dir);
		return rmdir($dirName);			
	}
	
	/*
		@function  		复制目录
		
		@var:$surDir  	原目录
		
		@var:$toDir  	目标目录
		
		@return:   		true
	*/
	
	static function copy_dir($surDir,$toDir)
	{
		$surDir = rtrim($surDir,'/').'/';
		$toDir = rtrim($toDir,'/').'/';
		if (!file_exists($surDir)) 
		{
			return  false;
		}
    
		if (!file_exists($toDir))
		{
			self::mk_dir($toDir);
		}
		$file = opendir($surDir);
		while ($fileName = readdir($file))
		{
			$file1 = $surDir .'/'.$fileName;
			$file2 = $toDir .'/'.$fileName;
			if ($fileName != '.' && $fileName != '..') 
			{
				if (is_dir($file1)) 
				{
					self::copy_dir($file1, $file2);        
				} 
				else 
				{
					copy($file1, $file2);
				}
			}
		}
		closedir($file);
		return true;
	}
	

	/*
		@function  列出目录
		
		@var:$dir  目录名
		
		@return:   目录数组
		
		列出文件夹下内容，返回数组 $dirArray['dir']:存文件夹；$dirArray['file']：存文件
	*/
	
	static function get_dirs($dir) 
	{
		$dir = rtrim($dir,'/').'/';
		$dirArray [][] = NULL;
		if (false != ($handle = opendir ( $dir )))
		{
			$i = 0;
			$j = 0;
			while ( false !== ($file = readdir ( $handle )) ) 
			{
				if (is_dir ( $dir . $file )) 
				{ //判断是否文件夹
					$dirArray ['dir'] [$i] = $file;
					$i ++;
				} 
				else 
				{
					$dirArray ['file'] [$j] = $file;
					$j ++;
				}
			}
			closedir ($handle);
		}
		return $dirArray;
	}
	
	/*
		@function  统计文件夹大小
		
		@var:$dir  目录名
		
		@return:   文件夹大小(单位 B)
	*/
	
	static function get_size($dir)
	{ 
		$dirlist = opendir($dir);
		$dirsize = 0;
		while (false !==  ($folderorfile = readdir($dirlist)))
		{ 
			if($folderorfile != "." && $folderorfile != "..")
			{ 
				if (is_dir("$dir/$folderorfile"))
				{ 
					$dirsize += self::get_size("$dir/$folderorfile"); 
				}
				else
				{ 
					$dirsize += filesize("$dir/$folderorfile"); 
				}
			}    
		}
		closedir($dirlist);
		return $dirsize;
	}
	
	/*
		@function  检测是否为空文件夹
		
		@var:$dir  目录名
		
		@return:   存在则返回true
	*/
	
	static function empty_dir($dir)
	{
		return (($files = @scandir($dir)) && count($files) <= 2); 
	}
	
	/*
		@function  文件缓存与文件读取
		
		@var:$name  文件名
		
		@var:$value  文件内容,为空则获取缓存
		
		@var:$path   文件所在目录,默认是当前应用的DATA目录
		
		@var:$cached  是否缓存结果,默认缓存
		
		@return:   返回缓存内容
	*/
	
	function cache($name, $value='', $path=DATA_PATH,$cached=true) 
	{
		static $_cache  = array();
		$filename       = $path . $name . '.php';
		if ('' !== $value) {
			if (is_null($value)) {
				// 删除缓存
				return false !== strpos($name,'*')?array_map("unlink", glob($filename)):unlink($filename);
			} else {
				// 缓存数据
				$dir            =   dirname($filename);
				// 目录不存在则创建
				if (!is_dir($dir))
					mkdir($dir,0755,true);
				$_cache[$name]  =   $value;
				return file_put_contents($filename, strip_whitespace("<?php\treturn " . var_export($value, true) . ";?>"));
			}
		}
		if (isset($_cache[$name]) && $cached==true) return $_cache[$name];
		// 获取缓存数据
		if (is_file($filename)) {
			$value          =   include $filename;
			$_cache[$name]  =   $value;
		} else {
			$value          =   false;
		}
		return $value;
	}


	/*
		@function  列出目录
		
		@var:$dir  目录名
		
		@return:   目录数组
		
		列出文件夹下内容，返回数组 $dirArray['dir']:存文件夹；$dirArray['file']：存文件
	*/
	
	function get_dir_file($dir) 
	{
		$dir = rtrim($dir,'/').'/';
		$dirArray [][][] = NULL;
		if (false != ($handle = opendir ( $dir )))
		{
			$i = 0;
			
			while ( false !== ($file = readdir ( $handle )) ) 
			{
				if (is_dir ( $dir . $file )) 
				{ //判断是否文件夹
					$dirArray ['dir'][$i] = $file;
					$i ++;

					$this->get_dir_file($dirArray ['dir'][$i]);
				} 
				// else 
				// {
				// 	$dirArray ['file'] [$j] = $file;
				// 	$j ++;
				// }
			}
			closedir ($handle);
		}
		return $dirArray;
	}


    /**
     * 列出指定目录下符合条件的文件和文件夹
     * @param string $dirname 路径
     * @param boolean $is_all 是否列出子目录中的文件
     * @param string $exts 需要列出的后缀名文件
     * @param string $sort 数组排序
     * @return ArrayObject
     */
    static function list_dir_info($dirname){
        
        $files = array();
        $subfiles = array();
        $i = 0;
        $j = 0;

        if(is_dir($dirname))
        {
            $fh = opendir($dirname);
            while (($file = readdir($fh)) !== FALSE)
            {
                if (strcmp($file, '.')==0 || strcmp($file, '..')==0) continue;
                array_push($files, $file);
                $filepath = $dirname.'/'.$file;
				array_push($files, $filepath);
				// array_push($files, "1");
				if(is_dir($filepath)){
					$hander=opendir($filepath);
					while (($tfile = readdir($hander)) !== FALSE) {
						if (strcmp($tfile, '.')==0 || strcmp($tfile, '..')==0) continue;
						$filepaths = $filepath.'/'.$tfile;

						if(preg_match("/\.(png)|\.(jpg)|\.(gif)/",$filepaths) && is_file($filepaths)){
	                		array_push($files, $filepaths);
	                	}
					}
                	
                }
                array_push($files, "1");			//增加标识
            }
            closedir($fh);
            closedir($hander);

            foreach ($files as $key => $value) {
            	if ($value != 1){
            		$filess[$i][$j] = $value;
            		$j++;
            	}

            	if($value == 1){
            		$i++;
            		$j=0;
            	}
            }

            return $filess;
        }
        else
        {
            return FALSE;
        }
    }

     /**
     * 文件夹操作(复制/移动)
     * @param string $old_path 指定要操作文件夹路径
     * @param string $aimDir 指定新文件夹路径
     * @param string $type 操作类型
     * @param boolean $overWrite 是否覆盖文件和文件夹
     * @return boolean
     */
    static function handle_dir($old_path,$new_path,$type='copy',$overWrite=FALSE)
    {
        $new_path = file::check_path($new_path);
        $old_path = file::check_path($old_path);
        if (!is_dir($old_path)) return FALSE;
        
        if (!file_exists($new_path)) file::mk_dir($new_path);
        
        $dirHandle = opendir($old_path);
        
        if (!$dirHandle) return FALSE;
        
        $boolean = TRUE;
        
        while(FALSE !== ($file=readdir($dirHandle))) 
        {
            if ($file=='.' || $file=='..') continue;
            
            if (!is_dir($old_path.$file)) 
            {
                $boolean = file::handle_file($old_path.$file,$new_path.$file,$type,$overWrite);
            }
            else 
            {
                file::handle_dir($old_path.$file,$new_path.$file,$type,$overWrite);
            }
        }
        switch ($type)
        {
            case 'copy':
                closedir($dirHandle);
                return $boolean;
                break;
            case 'move':
                closedir($dirHandle);
                return rmdir($old_path);
                break;
        }
    }

    /**
     * 文件操作(复制/移动)
     * @param string $old_path 指定要操作文件路径(需要含有文件名和后缀名)
     * @param string $new_path 指定新文件路径（需要新的文件名和后缀名）
     * @param string $type 文件操作类型
     * @param boolean $overWrite 是否覆盖已存在文件
     * @return boolean
     */
    static function handle_file($old_path,$new_path,$type='copy',$overWrite=FALSE)
    {
        $old_path = file::dir_replace($old_path);
        $new_path = file::dir_replace($new_path);
        if(file_exists($new_path) && $overWrite=FALSE)
        {
            return FALSE;
        }
        else if(file_exists($new_path) && $overWrite=TRUE)
        {
            file::unlink_file($new_path);
        }
        
        $aimDir = dirname($new_path);
        file::create_dir($aimDir);
        switch ($type)
        {
            case 'copy':
                return copy($old_path,$new_path);
                break;
            case 'move':
                return rename($old_path,$new_path);
                break;
        }
    }

    /**
     * 文件保存路径处理
     * @return string
     */
    static function check_path($path)
    {
        return (preg_match('/\/$/',$path)) ? $path : $path . '/';
    }
    	
}