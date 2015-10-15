<?php
	require_once "Db.php";
	class Localization {
		static $possibleLanguages;
		static $LANG_DEFAULT;
	}
	if (isset($_GET['lang'])){
		$lang = $_GET['lang'];
		setcookie('lang', $lang);
        $_COOKIE['lang'] = $lang;
	
	}
	function __($tag) {
		$lang = isset($_COOKIE["lang"]) ? $_COOKIE["lang"] : Localization::$LANG_DEFAULT;
		$db = Db::getInstance();
		$query = "SELECT text_{$lang} FROM translations WHERE tag='$tag'";
		$db->query($query, [$lang, $tag]);
		$row = $db->fetchAll();
		//var_dump($row);
		return $row[0]['text_' . $lang];
	}
?>