<?php



namespace Dev;



class Debug

{
    public $propertyName;
    private static $server_arr = [
        "DOCUMENT_ROOT",
        "REQUEST_SCHEME",
        "SERVER_NAME",
        "HTTP_HOST",
        "HTTP_USER_AGENT",
        "PHP_SELF",
        "SCRIPT_NAME",
        "SCRIPT_FILENAME",
        "REQUEST_METHOD",
        "REQUEST_URI",
        "REDIRECT_URL",
        "QUERY_STRING",
    ];

    private static function pre($func, $obj = null)
    {
        echo '<br><pre>';
        \call_user_func($func, $obj);
        debug_print_backtrace();
        echo '</pre><br>';
    }

    public static function vd($obj)
    {
        self::pre('var_dump', $obj);
    }

    public static function print($obj)
    {
        self::pre('print_r', $obj);
    }

    public static function server()
    {
        echo '<br><table>';
        foreach (self::$server_arr as $value) {
            echo "<tr><td>\$_SERVER[$value]</td><td> ==> </td><td>$_SERVER[$value]</td></tr>";
        }
        echo '</table><br>';
        \debug_print_backtrace();
    }
}
