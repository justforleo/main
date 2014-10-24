<?php 
class String
{
    /*
     * 如果string是空就返回内容或false;
     *
     * @param String|Array $string 要检测的内容
     * @return true|空的Key
     * */
    static public function valueNotEmpty($string)
    {
        $str = [];
        if (is_array($string)) {
            foreach ($string as $key => $val) {
                $str[] = empty($val)?$key:true;
            }
        } else {
            return empty($string)?false:true;
        }
        return $str;
    }
}
 ?>