<?php

require_once("../admin-includes/lessc.inc.php");

$less = new lessc;


$less->checkedCompile("../css_less/base.less", "../css_less/base.css");





?>
