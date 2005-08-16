--TEST--
sqlite-oo: calling static methods
--INI--
sqlite.assoc_case=0
--SKIPIF--
<?php # vim:ft=php
if (!extension_loaded("sqlite")) print "skip"; 
?>
--FILE--
<?php

require_once('blankdb_oo.inc'); 

class foo {
    static function bar($param = NULL) {
		return $param;
    }
}

function baz($param = NULL) {
	return $param;
}

var_dump($db->singleQuery("select php('baz')", 1));
var_dump($db->singleQuery("select php('baz', 1)", 1));
var_dump($db->singleQuery("select php('baz', \"PHP\")", 1));
var_dump($db->singleQuery("select php('foo::bar')", 1));
var_dump($db->singleQuery("select php('foo::bar', 1)", 1));
var_dump($db->singleQuery("select php('foo::bar', \"PHP\")", 1));
var_dump($db->singleQuery("select php('foo::bar(\"PHP\")')", 1));

?>
===DONE===
--EXPECTF--
NULL
string(1) "1"
string(3) "PHP"
NULL
string(1) "1"
string(3) "PHP"

Fatal error: Call to undefined method foo::bar("php")() in %ssqlite_oo_030.php on line %d
--UEXPECTF--
NULL
unicode(1) "1"
unicode(3) "PHP"
NULL
unicode(1) "1"
unicode(3) "PHP"

Fatal error: Call to undefined method foo::bar("php")() in %ssqlite_oo_030.php on line %d
