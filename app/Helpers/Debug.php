<?php
/**
 * User: Conner
 * Date: 24/03/2016
 * Time: 02:07
 */

namespace Helpers;


class Debug
{
    public static function log()
    {
        $file = 'debug.log';
        $doc_root = realpath(dirname(dirname(__DIR__)));
        $doc_root = str_replace("\\", "/", $doc_root);
        $doc_root = preg_replace('/\/+$/', '/', $doc_root . '/');
        ob_start();
        $objs = func_get_args();
//        $objs = array_slice($objs,1);
        foreach ($objs as $obj) {
            var_dump($obj);
        }

        $out = PHP_EOL.'########### '. date('m/d/Y H:i:s') .' ###########'.PHP_EOL;
        $out .= ob_get_clean();
        $out .= '########### '. date('m/d/Y H:i:s') .' ###########'.PHP_EOL;

        file_put_contents($doc_root . $file, $out, FILE_APPEND);
        file_put_contents($doc_root . $file, "\r\n", FILE_APPEND);
    }

}