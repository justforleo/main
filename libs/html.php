<?php 
class Html
{

    static public function outLoad($string = [])
    {
        $str = '';
        if (is_array($string)) {
            foreach ($string as $key => $val) {
                $str .= self::tagScript($val);
            }
        }
        if (is_string($string)) {
            $str .= self::tagScript($string);
        }

        return $str;
    }
    static public function tagScript($val)
    {
        if (explode('.',$val)) {
            $ext = explode('.',$val)[1];
            switch ($ext) {
                case 'js':
                    $str = "<script src='{$val}' type='text/javascript'></script>\n";
                    break;
                case 'css':
                    $str = "<link href='{$val}' rel='stylesheet'>\n";
                    break;
            }
        } else {
            return false;
        }
        return $str;
    }
}
 ?>