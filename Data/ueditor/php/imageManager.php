<?php
    /**
     * Created by JetBrains PhpStorm.
     * User: taoqili
     * Date: 12-1-16
     * Time: 上午11:44
     * To change this template use File | Settings | File Templates.
     */
    header("Content-Type: text/html; charset=utf-8");
    error_reporting( E_ERROR | E_WARNING );

    //需要遍历的目录列表，最好使用缩略图地址，否则当网速慢时可能会造成严重的延时
    $paths = array('../Uploads/');
    // $paths=array('upload/');


    $action = htmlspecialchars( $_POST[ "action" ] );
    if ( $action == "get" ) {
        $files = array();
        foreach ( $paths as $path){
            $tmp = getfiles( $path );

            if($tmp){
                $files = array_merge($files,$tmp);
                print_r($files);
            }
        }
        if ( !count($files) ) return;
        //rsort($files,SORT_STRING);
        $str = "";
        foreach ( $files as $file ) {
            $str .= $file . "ue_separate_ue";
        }
        echo $str;
    }

    /**
     * 遍历获取目录下的指定类型的文件
     * @param $path
     * @param array $files
     * @return array
     */
    function getfiles( $path , &$files = array() )
    {
        if ( !is_dir( $path ) ) return null;
        $handle = opendir( $path );
        while ( false !== ( $file = readdir( $handle ) ) ) {
            if ( $file != '.' && $file != '..' ) {
                $path2 = $path . '/' . $file;
                if ( is_dir( $path2 ) ) {
                    getfiles( $path2 , $files );
                } else {
                    if ( preg_match( "/\.(gif|jpeg|jpg|png|bmp)$/i" , $file ) ) {
                        $files[] = $path2;
                    }
                }
            }
        }
        // print_r($files);
        // die();    
        return $files;
    }



    /**
 * @path 路径，支持相对和绝对
 * @absolute 返回的文件数组，是否包含完整路径
 
function getfiles($path, $absolute=1) {
    $files = array();
    $_path = realpath($path);
    if (!file_exists($_path)) return false;
    if (is_dir($_path)) {
        $list = scandir($_path);
        foreach ($list as $v) {
            if ($v == '.' || $v == '..') continue;
            $_paths = $_path.'/'.$v;
            if (is_dir($_paths)) {
                //递归
                $files = array_merge($files, get_files($_paths,$absolute));
            } else {
                $files[] = $absolute>0 ? $_paths : $v;
            }
        }
    } else {
        if (!is_file($_path)) return false;
        $files[] = $_path;
    }
    return $files;
}*/

