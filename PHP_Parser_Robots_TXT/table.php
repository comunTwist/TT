<table>
	<tr>
		<th>№</th>
		<th>Название проверки</th>
		<th>Статус</th>
		<th>Текущее состояние</th>
	</tr>
	<tr>
		<td>1</td>
		<td>Проверка наличия файла robots.txt</td>
		<td><?php if(strripos($headers[0], "200 OK")) { $status = "OK";} else { $status = "ОШИБКА"; } echo $status; ?></td>
		<td><?php if($status == "OK") { echo "Файл robots.txt присутствует";} else {echo "Файл robots.txt отсутствует";} ?></td>
	</tr>
	<tr>
		<td>2</td>
		<td>Проверка указания директивы Host</td>
		<td><?php if(strripos($contents, "Host:")) { $status = "OK";} else { $status = "ОШИБКА"; } echo $status; ?></td>
		<td><?php if($status == "OK") { echo "Директива Host указана";} else {echo "В файле robots.txt не указана директива Host";} ?></td>
	</tr>
	<tr>
		<td>3</td>
		<td>Проверка количества директив Host, прописанных в файле</td>
		<td><?php if(strripos($contents, "Host:")) { $status = "OK";} else { $status = "ОШИБКА"; } echo $status; ?></td>
		<td><?php preg_match_all('/(Host)/i',$contents, $substring);
			$count = 0;
			foreach ($substring[0] as $tmp)
			$count++;
			echo "Количество директив Host, пописанных в файле: ".$count; ?>
		</td>
	</tr>
	<tr>
		<td>4</td>
		<td>Проверка размера файла robots.txt</td>
		<td><?php if(strripos($headers[0], "200 OK")) { $status = "OK";} else { $status = "ОШИБКА"; } echo $status; ?></td>
		<td><?php foreach($headers as $v) {
				if (stristr($v, 'content-length')) { 
	 				$v = explode(":", $v); 
	 				echo trim($v[1]);
					break;
				} 
 			}  ?>
		</td>
	</tr>
	<tr>
		<td>5</td>
		<td>Проверка указания директивы Sitemap</td>
		<td><?php if(strripos($contents, "Sitemap:")) { $status = "OK";} else { $status = "ОШИБКА"; } echo $status; ?></td>
		<td><?php if($status == "OK") { echo "Директива Sitemap указана";} else {echo "В файле robots.txt не указана директива Sitemap";} ?></td>
	</tr>
	<tr>
		<td>6</td>
		<td>Проверка кода ответа сервера для файла robots.txt</td>
		<td><?php if(strripos($headers[0], "200")) { $status = "OK";} else { $status = "ОШИБКА"; } echo $status; ?></td>
		<td><?php if($status == "OK") {
				echo "Файл robots.txt отдаёт код ответа сервера 200";
			}else {
				if (!empty($headers[0])) {
    					preg_match('/\d{3}/', $headers[0], $code);
				}
				echo "При обращении к файлу robots.txt сервер возвращает код ответа (".$code[0].")";
			} ?>
		</td>
	</tr>
</table>
