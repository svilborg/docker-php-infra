<?php
echo "Tests";
echo "\n";

testExt("gd");
testExt("mbstring");
//testExt("mcrypt");
testExt("pdo_mysql");
testExt("pdo_pgsql");
testExt("curl");
testExt("json");
testExt("xml");
testExt("imagick");

test(function () {
    try {
        $dbh = new PDO("mysql:host=mysql;dbname=mysql", "root", "root");
    } catch (\Exception $e) {
        echo $e->getMessage();
        return false;
    }

    return true;
}, "Mysql Connection");

test(function () {
    try {
        $dbh = new PDO("pgsql:host=postgres;dbname=test", "root", "root");
    } catch (\Exception $e) {
        echo $e->getMessage();
        return false;
    }

    return true;
}, "Postgres Connection");

test(function () {
    try {
        $redis = new Redis();
        return $redis->connect('redis', 6379);
    } catch (\Exception $e) {
        echo $e->getMessage();
        return false;
    }

    return true;
}, "Redis Connection");

test(function () {
    try {
        $connection = new MongoDB\Driver\Manager("mongodb://localhost:27017");

        return $connection;
    } catch (\Exception $e) {
        echo $e->getMessage();
        return false;
    }

    return true;
}, "Mongodb Connection");


test(function () {
    $imagick = new Imagick();
    $imagickFormats = $imagick->queryFormats('PNG');
    if (!in_array('PNG', $imagickFormats)) {
        return false;
    }

    return true;
}, "PNG Support Image Magic");




// Functions
// ////////////////////////////////
function test($callback, $txt)
{
    if ($callback()) {
        ok($txt);
        return true;
    }
    ko($txt);
    return false;
}

function testExt($ext)
{
    if (! extension_loaded($ext)) {
        ko("Ext " . $ext . " not loaded");
        return false;
    }

    ok("Ext " . $ext . " loaded");
}

function ok($m)
{
    echo "OK (" . $m . ")";
    echo "\n";
}

function ko($m)
{
    echo "ERROR (" . $m . ")";
    echo "\n";
}