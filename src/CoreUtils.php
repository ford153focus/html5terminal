<?php

class NotImplementedException extends BadMethodCallException
{

}

class CoreUtils
{

    public static function cd($path)
    {
        return chdir($path);
    }

    public static function chgrp($filename, $group)
    {
        return chgrp($filename, $group);
    }

    public static function chown($filename, $user)
    {
        return chown($filename, $user);
    }

    public static function chmod($filename, $permissions)
    {
        return chmod($filename, $permissions);
    }

    public static function cp($from, $to)
    {
        return copy($from, $to);
    }

    public static function dd()
    {
        throw new NotImplementedException();
    }

    public static function df()
    {
        throw new NotImplementedException();
    }

    public static function dir()
    {
        throw new NotImplementedException();
    }

    public static function dircolors()
    {
        throw new NotImplementedException();
    }

    public static function echo_($str)
    {
        return $str[0] === '$' ? $_ENV[$str] : $str;
    }

    public static function install()
    {
        throw new NotImplementedException();
    }

    public static function ln()
    {
        throw new NotImplementedException();
    }

    public static function ls()
    {
        throw new NotImplementedException();
    }

    public static function mkdir($directory, $permissions = 0777, $recursive = false, $context = null)
    {
        return mkdir($directory, $permissions, $recursive, $context);
    }

    public static function mkfifo()
    {
        throw new NotImplementedException();
    }

    public static function mknod()
    {
        throw new NotImplementedException();
    }

    public static function mktemp()
    {
        throw new NotImplementedException();
    }

    public static function mv()
    {
        throw new NotImplementedException();
    }

    public static function realpath()
    {
        throw new NotImplementedException();
    }

    public static function rm()
    {
        throw new NotImplementedException();
    }

    public static function rmdir()
    {
        throw new NotImplementedException();
    }

    public static function shred()
    {
        throw new NotImplementedException();
    }

    public static function sync()
    {
        throw new NotImplementedException();
    }

    public static function touch()
    {
        throw new NotImplementedException();
    }

    public static function truncate()
    {
        throw new NotImplementedException();
    }

    public static function vdir()
    {
        throw new NotImplementedException();
    }

    public static function base64()
    {
        throw new NotImplementedException();
    }

    public static function cat()
    {
        throw new NotImplementedException();
    }

    public static function cksum()
    {
        throw new NotImplementedException();
    }

    public static function comm()
    {
        throw new NotImplementedException();
    }

    public static function csplit()
    {
        throw new NotImplementedException();
    }

    public static function cut()
    {
        throw new NotImplementedException();
    }

    public static function expand()
    {
        throw new NotImplementedException();
    }

    public static function fmt()
    {
        throw new NotImplementedException();
    }

    public static function fold()
    {
        throw new NotImplementedException();
    }

    public static function head()
    {
        throw new NotImplementedException();
    }

    public static function join()
    {
        throw new NotImplementedException();
    }

    public static function md5sum()
    {
        throw new NotImplementedException();
    }

    public static function nl()
    {
        throw new NotImplementedException();
    }

    public static function numfmt()
    {
        throw new NotImplementedException();
    }

    public static function od()
    {
        throw new NotImplementedException();
    }

    public static function paste()
    {
        throw new NotImplementedException();
    }

    public static function ptx()
    {
        throw new NotImplementedException();
    }

    public static function pr()
    {
        throw new NotImplementedException();
    }

    public static function sha1sum()
    {
        throw new NotImplementedException();
    }

    public static function sha224sum()
    {
        throw new NotImplementedException();
    }

    public static function sha256sum()
    {
        throw new NotImplementedException();
    }

    public static function sha384sum()
    {
        throw new NotImplementedException();
    }

    public static function sha512sum()
    {
        throw new NotImplementedException();
    }

    public static function shuf()
    {
        throw new NotImplementedException();
    }

    public static function sort()
    {
        throw new NotImplementedException();
    }

    public static function split()
    {
        throw new NotImplementedException();
    }

    public static function sum()
    {
        throw new NotImplementedException();
    }

    public static function tac()
    {
        throw new NotImplementedException();
    }

    public static function tail()
    {
        throw new NotImplementedException();
    }

    public static function tr()
    {
        throw new NotImplementedException();
    }

    public static function tsort()
    {
        throw new NotImplementedException();
    }

    public static function unexpand()
    {
        throw new NotImplementedException();
    }

    public static function uniq()
    {
        throw new NotImplementedException();
    }

    public static function wc()
    {
        throw new NotImplementedException();
    }

    public static function arch()
    {
        throw new NotImplementedException();
    }

    public static function basename()
    {
        throw new NotImplementedException();
    }

    public static function chroot()
    {
        throw new NotImplementedException();
    }

    public static function date()
    {
        throw new NotImplementedException();
    }

    public static function dirname()
    {
        throw new NotImplementedException();
    }

    public static function du()
    {
        throw new NotImplementedException();
    }

    public static function env()
    {
        throw new NotImplementedException();
    }

    public static function expr()
    {
        throw new NotImplementedException();
    }

    public static function factor()
    {
        throw new NotImplementedException();
    }

    public static function false()
    {
        throw new NotImplementedException();
    }

    public static function groups()
    {
        throw new NotImplementedException();
    }

    public static function hostid()
    {
        throw new NotImplementedException();
    }

    public static function id()
    {
        throw new NotImplementedException();
    }

    public static function link()
    {
        throw new NotImplementedException();
    }

    public static function logname()
    {
        throw new NotImplementedException();
    }

    public static function nice()
    {
        throw new NotImplementedException();
    }

    public static function nohup()
    {
        throw new NotImplementedException();
    }

    public static function nproc()
    {
        throw new NotImplementedException();
    }

    public static function pathchk()
    {
        throw new NotImplementedException();
    }

    public static function pinky()
    {
        throw new NotImplementedException();
    }

    public static function printenv()
    {
        throw new NotImplementedException();
    }

    public static function printf()
    {
        throw new NotImplementedException();
    }

    public static function pwd()
    {
        throw new NotImplementedException();
    }

    public static function readlink()
    {
        throw new NotImplementedException();
    }

    public static function runcon()
    {
        throw new NotImplementedException();
    }

    public static function stdbuf()
    {
        throw new NotImplementedException();
    }

    public static function seq()
    {
        throw new NotImplementedException();
    }

    public static function sleep()
    {
        throw new NotImplementedException();
    }

    public static function stat()
    {
        throw new NotImplementedException();
    }

    public static function stty()
    {
        throw new NotImplementedException();
    }

    public static function tee()
    {
        throw new NotImplementedException();
    }

    public static function test()
    {
        throw new NotImplementedException();
    }

    public static function timeout()
    {
        throw new NotImplementedException();
    }

    public static function true()
    {
        throw new NotImplementedException();
    }

    public static function tty()
    {
        throw new NotImplementedException();
    }

    public static function uname()
    {
        throw new NotImplementedException();
    }

    public static function unlink()
    {
        throw new NotImplementedException();
    }

    public static function uptime()
    {
        throw new NotImplementedException();
    }

    public static function users()
    {
        throw new NotImplementedException();
    }

    public static function who()
    {
        throw new NotImplementedException();
    }

    public static function whoami()
    {
        file_put_contents("testFile", "test");
        $user = fileowner("testFile");
        unlink("testFile");

        return $user;
    }

    public static function yes()
    {
        throw new NotImplementedException();
    }
}
?>

