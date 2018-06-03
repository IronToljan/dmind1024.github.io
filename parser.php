<?php
$res = '';
 
function startElement($parser, $name, $attrs) {
    global $res;
    switch ($name) {
        case 'TOWN':
            $res .= 'Город - ';
            $res .= '<strong>'.mb_convert_encoding(
                        urldecode($attrs['SNAME']),
                        'UTF-8', 'windows-1251').'</strong><br />';
            $res .= 'широта - '.$attrs['LATITUDE'].' градусов<br />';
            $res .= 'долгота - '.$attrs['LONGITUDE'].' градусов<br />';
            break;
        case 'FORECAST':
            $res .= 'Температура '.$attrs['DAY'].'.'.$attrs['MONTH'].'.'.
                $attrs['YEAR'].' в '.$attrs['HOUR'].'-00 будет от ';
            break;
        case 'TEMPERATURE':
            $res .= '<strong>'.$attrs['MIN'].'°</strong> до <strong>'.
                $attrs['MAX'].'°</strong><br />';
            break;
    }
}
 
function endElement($parser, $name) {}
 
$ch = curl_init();
 
curl_setopt($ch, CURLOPT_URL, 'http://informer.gismeteo.ua/xml/33345_1.xml');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_PROXYPORT, 8080);
curl_setopt($ch, CURLOPT_PROXY, '192.168.0.1');
 
$data = curl_exec($ch);
 
curl_close($ch);
 
$XMLparser = xml_parser_create();
xml_set_element_handler($XMLparser, 'startElement', 'endElement');
if (!xml_parse($XMLparser, $data)) {
    die('Ошибка обработки данных');
}
xml_parser_free($XMLparser);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Данные от gismeteo</title>
</head>
<body style="font-family:Verdana, sans-serif">
<?php
echo $res;
?>
</body>
</html>