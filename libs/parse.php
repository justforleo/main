<?php
class parse
{
    public static function run($txt)
    {
        $txt = file_get_contents($txt);
        $row = self::parseLine($txt);
//        foreach ($row as $key => $val) {
//
//        }
        return $row;
    }
    public static function parseLine($txt)
    {
        $rows = explode("\n", $txt);

        $rows = array_filter($rows, function($txt) {
            if (strpos($txt,'method') ) {
                return (bool)$txt;
            }
            return false;

        });
        var_dump($rows);
        $tmps = array();

        foreach ($rows as $txt) {
            list($key,$val)= explode(" ", $txt,2);

            $key = trim($key);
 
            if (isset($tmps[$key])) {
                throw new \Exception('重复的表达式名:'.$key);
            }

            $tmps[] = explode(' ', trim($val));
        }
        return $tmps;
    }
    public function getComment()
    {
        return $this->commentResult;
    }
}
?>