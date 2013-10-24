<?php
    /**
    * Debug tool to print a variable
    * @param (mixed) var The variable to print
    * @param (int) line The line where this function is call
    * @param (path) file The file where this function is call
    * @param (bool) return Return or print the variable
    * @return HTML
    */
    if (!function_exists('dbg')) {
        function dbg($var, $line, $file, $return = false) {
            $x  = '<pre style="width=940px; margin: 20px auto; padding: 20px; color: #ccc; background: #333; border: 1px solid #ccc; white-space: pre-wrap;">';
            $x .= '<strong style="width: 100%; margin-bottom: 10px; line-height: 1.5em; font-size: 1.2em; color: #333; text-indent: 10px; background: #38C7F7; display: inline-block;">Line ' . $line . ' - file : ' . $file . '</strong><br />';
            $x .= print_r($var, 1);
            $x .= '</pre>';

            if($return)
                return $x;
            else
                print $x;
        }
    }