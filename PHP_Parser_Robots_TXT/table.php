<table>
	<tr>
		<th class="num">№</th>
		<th class="checkName">Название проверки</th>
		<th class="status">Статус</th>
		<th class="condition"></th>
		<th>Текущее состояние</th>
	</tr>
	<tr>
		<td colspan="5" class="delimiter"></td>
	</tr>
	<tr>
		<td rowspan="2" class="num">1</td>
		<td rowspan="2">Проверка наличия файла robots.txt</td>
		<?php if(strripos($headers[0], "200 OK")) { 
				$class = "class=\"ok\"";
				$status = "OK";
				$condition = "Файл robots.txt присутствует";
				$chit = "Доработки не требуются";
			} else { 
				$class = "class=\"err\"";
				$status = "Ошибка";
				$condition = "Файл robots.txt отсутствует";
				$chit = "Программист: Создать файл robots.txt и разместить его на сайте.";
			} 
			$data[0]['status'] = $status;
			$data[0]['condition'] = $condition;
			$data[0]['chit'] = $chit;
		?>
		<td rowspan="2" <?php echo $class ?>><?php echo $status; ?></td>
		<td>Состояние</td>
		<td><?php echo $condition; ?></td>
	</tr>
	<tr>
		<td>Рекомендации</td>
		<td><?php  echo $chit; ?></td>
	</tr>
	<tr>
		<td colspan="5" class="delimiter"></td>
	</tr>
	<tr>
		<td rowspan="2" class="num">2</td>
		<td rowspan="2">Проверка указания директивы Host</td>
		<?php if(strripos($contents, "Host:")) {
				$class = "class=\"ok\"";
				$status = "OK";
				$condition = "Директива Host указана";
				$chit = "Доработки не требуются";
			} else {
				$class = "class=\"err\"";
				$status = "Ошибка";
				$condition = "В файле robots.txt не указана директива Host";
				$chit = "Программист: Для того, чтобы поисковые системы знали, какая версия сайта является основным зеркалом, необходимо прописать адрес основного зеркала в директиве Host. В данный момент это не прописано. Необходимо добавить в файл robots.txt директиву Host. Директива Host задётся в файле 1 раз, после всех правил.";
			}
			$data[1]['status'] = $status;
			$data[1]['condition'] = $condition;
			$data[1]['chit'] = $chit;
		?>
		<td rowspan="2" <?php echo $class ?>><?php echo $status; ?></td>
		<td>Состояние</td>
		<td><?php echo $condition; ?></td>
	</tr>
	<tr>
		<td>Рекомендации</td>
		<td><?php echo $chit; ?></td>
	</tr>
	<tr>
		<td colspan="5" class="delimiter"></td>
	</tr>
	<tr>
		<td rowspan="2" class="num">3</td>
		<td rowspan="2">Проверка количества директив Host, прописанных в файле</td>
		<?php preg_match_all('/(Host)/i',$contents, $substring);
		$count = 0;
		foreach ($substring[0] as $tmp)
		$count++;
		if($count == 1){
			$class = "class=\"ok\"";
			$status = "OK";
			$condition = "В файле прописана 1 директива Host";
			$chit = "Доработки не требуются";
		} else if($count > 1) {
			$class = "class=\"err\"";
			$status = "Ошибка";
			$condition = "Количество директив Host, прописанных в файле: ".$count;
			$chit = "Программист: Директива Host должна быть указана в файле толоко 1 раз. Необходимо удалить все дополнительные директивы Host и оставить только 1, корректную и соответствующую основному зеркалу сайта";
		} else {
			$class = "class=\"err\"";
			$status = "Ошибка";
			$condition = "В файле не прописано ни одной директивы Host";
			$chit = "Программист: Директива Host должна быть указана в файле толоко 1 раз. Необходимо удалить все дополнительные директивы Host и оставить только 1, корректную и соответствующую основному зеркалу сайта";
		}
		$data[2]['status'] = $status;
		$data[2]['condition'] = $condition;
		$data[2]['chit'] = $chit;
		?>
		<td rowspan="2" <?php echo $class ?>><?php echo $status; ?></td>
		<td>Состояние</td>
		<td><?php echo $condition; ?></td>
	</tr>
	<tr>
		<td>Рекомендации</td>
		<td><?php echo $chit; ?></td>
	</tr>
	<tr>
		<td colspan="5" class="delimiter"></td>
	</tr>
	<tr>
		<td rowspan="2" class="num">4</td>
		<td rowspan="2">Проверка размера файла robots.txt</td>
		<?php 
		$length = $headers["Content-Length"];
		if(strripos($headers[0], "200 OK") && $length <= 32768) {
			$class = "class=\"ok\"";
			$status = "OK";
			$condition = "Размер файла robots.txt составляет $length байт, что находится в пределах допустимой нормы";
			$chit = "Доработки не требуются";
		} else if($length > 32768) { 
			$class = "class=\"err\"";
			$status = "Ошибка";
			$condition = "Размера файла robots.txt составляет $length байт, что превышает допустимую норму";
			$chit = "Программист: Максимально допустимый размер файла robots.txt составляем 32 кб. Необходимо отредактировть файл robots.txt таким образом, чтобы его размер не превышал 32 Кб";
		} else {
			$class = "class=\"err\"";
			$status = "Ошибка";
			$condition = "Размера файла robots.txt составляет 0 байт";
			$chit = "Программист: Максимально допустимый размер файла robots.txt составляем 32 кб. Необходимо отредактировть файл robots.txt таким образом, чтобы его размер не превышал 32 Кб";
		}
		$data[3]['status'] = $status;
		$data[3]['condition'] = $condition;
		$data[3]['chit'] = $chit;
		?>
		<td rowspan="2" <?php echo $class ?>><?php echo $status; ?>
		</td>
		<td>Состояние</td>
		<td><?php echo $condition; ?></td>
	</tr>
	<tr>
		<td>Рекомендации</td>
		<td><?php echo $chit; ?></td>
	</tr>
	<tr>
		<td colspan="5" class="delimiter"></td>
	</tr>
	<tr>
		<td rowspan="2" class="num">5</td>
		<td rowspan="2">Проверка указания директивы Sitemap</td>
		<?php if(strripos($contents, "Sitemap:")) {
			$class = "class=\"ok\"";
			$status = "OK";
			$condition = "Директива Sitemap указана";
			$chit = "Доработки не требуются";
		} else {
			$class = "class=\"err\"";
			$status = "Ошибка";
			$condition = "В файле robots.txt не указана директива Sitemap";
			$chit = "Программист: Добавить в файл robots.txt директиву Sitemap";
		}
		$data[4]['status'] = $status;
		$data[4]['condition'] = $condition;
		$data[4]['chit'] = $chit;
		?>
		<td rowspan="2" <?php echo $class ?>><?php echo $status; ?></td>
		<td>Состояние</td>
		<td><?php echo $condition; ?></td>
	</tr>
	<tr>
		<td>Рекомендации</td>
		<td><?php echo $chit; ?></td>
	</tr>
	<tr>
		<td colspan="5" class="delimiter"></td>
	</tr>
	<tr>
		<td rowspan="2" class="num">6</td>
		<td rowspan="2">Проверка кода ответа сервера для файла robots.txt</td>
		<?php if(strripos($headers[0], "200")) {
			$class = "class=\"ok\"";
			$status = "OK";
			$condition = "Файл robots.txt отдаёт код ответа сервера 200";
			$chit = "Доработки не требуются";
		} else {
			if (!empty($headers[0])) {
    				preg_match('/\d{3}/', $headers[0], $code);
			}
			$class = "class=\"err\"";
			$status = "Ошибка";
			$condition = "При обращении к файлу robots.txt сервер возвращает код ответа (".$code[0].")";
			$chit = "Программист: Файл robots.txt должны отдавать код ответа 200, иначе файл не будет обрабатываться. Необходимо настроить сайт таким образом, чтобы при обращении к файлу robots.txt сервер возвращает код ответа 200";
		}
		$data[5]['status'] = $status;
		$data[5]['condition'] = $condition;
		$data[5]['chit'] = $chit;
		?>
		<td rowspan="2" <?php echo $class ?>><?php echo $status; ?></td>
		<td>Состояние</td>
		<td><?php echo $condition; ?></td>
	</tr>
	<tr>
		<td>Рекомендации</td>
		<td><?php echo $chit; ?></td>
	</tr>
</table>
