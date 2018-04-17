<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  	<title>Сheck domain</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrapper">
<?php
@$domain;
if (isset($_GET['domain'])) {
	$domain = $_GET['domain'];
	$head = "Проверка для ".$domain;
	$table = 'table.php';
	if (isset($_GET['report'])){
		header('Content-Type: application/vnd.ms-excel; charset=utf-8');
		header("Content-Disposition: attachment;filename=".date("d-m-Y")."-report.xls");
		header("Content-Transfer-Encoding: binary ");
	}
} else {
	$head = "Введите название сайта";
}

@$scheme = parse_url($domain, PHP_URL_SCHEME);
if(!isset($scheme)) {
	$new_domain = "http://".$domain;	
	preg_match('/\d{3}/', get_headers($new_domain)[0], $code);
	if($code[0] > 200) {
		$pos = strripos($new_domain, 'www');
		if($pos > 0){
			$domain = "http://".substr($new_domain, $pos + 4);
			preg_match('/\d{3}/', get_headers($domain)[0], $code);
			if($code[0] > 200) {
				$domain = "https://".substr($new_domain, $pos + 4);
			}
		} else {
			$domain = "https://".$domain;
		}
	} else {
		$domain = $new_domain;
	}
}
$robots = $domain."/robots.txt";
$headers = get_headers($robots);
$contents = file_get_contents($robots);
?>

<h3><?php echo $head; ?></h3>
<div class="form">
	<form action="/" method="GET">
		<div class="field"><input type="text" name="domain" id="domain"><input type="submit" value="Проверить сайт"/></div>
	</form>
</div>
<?php
include $table;
if(isset($_GET['domain'])) {
echo<<<HTML
<div class="form">
	<form action="/" method="GET">
		<input type="hidden" name="domain" value="$domain"/>
		<input type="hidden" name="report" value=""/>
		<input type="submit" value="Сохранить отчёт"/>
	</form>
</div>
HTML;
}
?>
</div>
</body>
</html>
