<?php
	require("config.php");
	require("code.php");
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Расписание</title>
		<link href="/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.min.css" rel="stylesheet">
		<style>
			.btop{
			border-top: 2px solid #000000;
			}
			.bleft{
			border-left: 2px solid #000000;
			}
			.bright{
			border-right: 2px solid #000000;
			}
			.bbottom{
			border-bottom: 2px solid #000000;
			}
		</style>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">Расписание <?=$name_grup?></a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="/?p">Выбрать группу</a></li>
					<li><a href="/?page=all-par">На всю неделю</a></li>
					<!--
						<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Еще <b class="caret"></b></a>
						<ul class="dropdown-menu">
						<li><a href="/?page=add-grup">Добавить группу</a></li>
						<li class="divider"></li>
						<li><a href="/?page=allow-edit-par">Доступ к редактированию</a></li>
						//<?php
							//if(isset($pin) && ($_COOKIE['pin'.$id_grup] == $pin)){
							//echo '<li class="divider"></li>
							//<li><a href="/?page=add-par">Добавить пару</a></li>';
							//<li class="disabled"><a href="/?page=edit-par">Редактировать пары</a></li>';
							//}
							//if($_SESSION['mast']){
							//	echo '<li class="divider"></li>
							//	<li><a href="/?page=add-par-bonch">Добавление пар Бонч</a></li>';
						//}?>
						</ul>
						</li>
					-->
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a style="padding-top: 10px; padding-bottom: 10px" href="#">
						
						<!-- Yandex.Metrika counter -->
					<script type="text/javascript" >
						(function (d, w, c) {
							(w[c] = w[c] || []).push(function() {
								try {
									w.yaCounter47804353 = new Ya.Metrika({
                    					id:47804353,
                    					clickmap:true,
                    					trackLinks:true,
                    					accurateTrackBounce:true,
                    					webvisor:true,
                    					trackHash:true
									});
								} catch(e) { }
							});
							var n = d.getElementsByTagName("script")[0],
							s = d.createElement("script"),
							f = function () { n.parentNode.insertBefore(s, n); };
							s.type = "text/javascript";
							s.async = true;
							s.src = "https://mc.yandex.ru/metrika/watch.js";
							if (w.opera == "[object Opera]") {
								d.addEventListener("DOMContentLoaded", f, false);
							} else { f(); }
						})(document, window, "yandex_metrika_callbacks");
					</script>
					<noscript><div><img src="https://mc.yandex.ru/watch/47804353" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
					<!-- /Yandex.Metrika counter -->
					
					</a></li>
				</ul>
			</div><!--/.nav-collapse -->
					
		</div><!--Строка меню-->
		<div style="margin-top: 70px;" class="container">
			<?php
			if(isset($alert))
				echo $alert;
			if((!isset($_COOKIE['id'])) or $vibr_grup) //Выбор группы
			{
				if($rez = $mysqli->query( "SELECT groups_original.`ID` as 'id_grup', timetable.`class` as 'name' FROM timetable LEFT JOIN groups_original ON timetable.`class` = groups_original.`Naimenovanie` GROUP BY timetable.`class` ORDER BY timetable.`class`")){
			?>
			<table width=100%">
				<tr>
					<td valign="center">
						<div align="center">
							<div class="page-header"><h1>Привет</h1></div>
		        			<p>Выбери свою группу.</p>
							<div class="btn-group">
								<button style="width: 150px;" type="button" class="btn btn-lg btn-default dropdown-toggle" data-toggle="dropdown">Выбери <span class="caret"></span></button>
								<ul style="min-width: 100px; width: 150px; text-align: center;" class="dropdown-menu" role="menu">
									<?php while($result = $rez->fetch_assoc()){ echo '<li><a style="white-space: normal; word-wrap: break-word;" href="/?id='.$result['id_grup'].'">'.$result['name'].'</a></li>'; } ?>
								</ul>
							</div>
						</div>
					</td>
				</tr>
			</table>
			<?php
				$rez->free(); 
				}else
					echo'<div class="alert alert-danger">Ошибка запроса</div>';
			}
			else
			{
			?>
			<div class="alert alert-info">
				<div class="row text-center">
				<div class="col-md-4 col-xs-12"><h3 class="panel-title">Сегодня: <b><?=day($day_num)?></b></h3></div>
				<div class="col-md-4 col-xs-6"><h3 class="panel-title">Идет <b><?=$week?></b> неделя.</h3></div>
				<div class="col-md-3 col-xs-6"><h3 class="panel-title">Время: <b id="clock"><?=date('G:i:s',(time()+60*60*3))?></b></h3></div>
			</div>
		</div><!--Информация о дне, неделе, времени-->
			<?php
				if(!isset($error1)){
					if(isset($alert2))
						echo $alert2;
					if($_GET['page'] == 'all-par'){
						if(isset($_GET['num'])){
							$week_all = htmlspecialchars($_GET['num']);
							$popravka = $week_all-$week;
							if ($popravka==1)
								$last_monday = strtotime("Next Monday");
							elseif($popravka==0)
								$last_monday = strtotime("last Monday");
							elseif($popravka<0){
								$popravka--;
								$last_monday = strtotime($popravka." Monday");
							}
							else
								$last_monday = strtotime($popravka." Monday");
						}
						else
						{
							$week_all = $week;
							$last_monday = strtotime("last Monday");	
						}		
						$work_data = date_create(); 
						date_timestamp_set($work_data, $last_monday);
						date_modify($work_data, '-1 day');
			?>
		<div class="panel panel-info text-center"><div class="panel-heading"><h3 class="panel-title">Сейчас показана <b><?=$week_all?></b> неделя.</h3></div></div>
			<ul class="pager">
				<li class="previous"><a href="/?page=all-par&num=<?=$week_all-1?>">&larr; Предыдущая</a></li>
				<li class="next"><a href="/?page=all-par&num=<?=$week_all+1?>">Следующая &rarr;</a></li>
			</ul>
			<div class="row">
			<?php
						for($num_day=1; $num_day<=6; $num_day++){
							if($week_all == $week && $num_day == $day_num)
								$co = 'style="background: #ffab60;"';
							else
								$co = '';
			?>
			<div class="col-md-4 col-xs-12" >
				<div <?=$co?> class="panel panel-default"><!--Вывод расписания на всю неделю-->
			<?php
							date_modify($work_data, '+1 day');
							$workday=date_format($work_data, "Y-m-d");
							$monthes = array(
								1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
								5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
								9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря'
							);
			?>
					<div class="panel-heading">
						<h3 class="panel-title"><?=day($num_day)." (".date('d ', strtotime($workday)).$monthes[(date('n', strtotime($workday)))],")" ?></h3>
					</div>
			<?php
							if($rez = $mysqli->query("SELECT * FROM timetable WHERE class = '$name_grup' AND `date`='$workday' ORDER BY `timeStart` ASC")){
								if(($rez->num_rows)>0){
									$num_par = 0;
									while($result = $rez->fetch_assoc()){
										$num_par++;
										$result['time'] = $result['time']=="" ? $time_start_par[$result['para']-1] : $result['time'];
										$prepod = str_replace('<span' ,'<span data-toggle="tooltip"', $result['teacher']);
										$nachalo=strtotime($result['timeStart']."+1 HOUR");
										$konec=strtotime($result['timeStop']."+1 HOUR");
										$list_par[$num_par] = '<tr class="para_num_'.$num_par.' bright bleft">
										<td class="time_para" rowspan="2" style="border-bottom: 2px solid #000000;"><b>'.$result['para'].'</b><br>'.gmdate("H:i", $nachalo).'<br>'.gmdate("H:i", $konec).'</td>
										<td colspan="2">'.$result['discipline'].' <span class="label label-default">'.$result['type'].'</span></td></tr>
										<tr class="para_num_'.$num_par.' bbottom bright"><td style="word-wrap: break-word;">'.$result['cabinet'].'</td><td>'.$prepod.'</td></tr>';
									}
									if($num_par > '0'){
			?>
					<table class="table table-bordered">
						<thead>
							<tr class="btop bleft bbottom bright">
								<th class="text-center">время</th>
								<th class="text-center">ауд.</th>
								<th class="text-center">Преподаватель</th>
							</tr>
						</thead>
						<tbody class="text-center">
			<?php
										foreach ($list_par as $value11) {
											echo $value11;
										}
			?>
						</tbody>
					</table>
    		<?php 
									}else
										echo'<h2 class="text-center">Пар нет!</h2>';
								}else
									echo'<h2 class="text-center">Пар нет!</h2>';
							}else
								echo'<div class="alert alert-danger">Ошибка запроса</div>';
			?>
			<!--Вывод расписания на всю неделю-->
				</div>
			</div>
			<?php
							unset($list_par);
							$rez->free();
							if($num_day == 3)
								echo'</div><div class="row">';
						}
						echo'</div>';
					}//---------------------------Вывод всей недели
					else{
						if(isset($_GET['day'])){
							if(htmlspecialchars($_GET['day']) != 0){
			?>
			<div class="alert alert-info">
				<div class="row text-center">
					<div class="col-md-4 col-xs-12"><h3 class="panel-title">Сейчас показана <b><?=$week_new?></b> неделя,</h3></div>
					<div class="col-md-4 col-xs-6"><h3 class="panel-title"><b><?=day(date("N", strtotime($den)))?></b></h3></div>
					<div class="col-md-3 col-xs-6"><h3 class="panel-title">Число: <b><?=$data_11?></b></h3></div>
				</div>
			</div>
			<?php
							}
						}
			?>
			<ul class="pager">
				<li class="previous"><a href="/?day=<?=$day_11-1?>">&larr; Предыдущий</a></li>
				<li class="next"><a href="/?day=<?=$day_11+1?>">Следующий &rarr;</a></li>
			</ul>
				
				
			<div class="row"><!--Основной вывод расписания-->
				<div class="col-xs-12 col-md-4 col-md-offset-4">
					<div style="background: " class="panel panel-default">
						<table class="table table-bordered">
							<thead>
								<tr class="btop bleft bbottom bright">
									<th class="text-center">время</th>
									<th class="text-center">ауд.</th>
									<th class="text-center">Преподаватель</th>
								</tr>
							</thead>
							<tbody class="text-center">
			<?php
						if(isset($error2)){			
						}elseif($num_par == 0){
							echo '<tr class="bbottom bright bleft"><td colspan="3"><h2 class="text-center">Пар нет!</h2></td></tr>';
						}else{
							foreach ($list_par as $value11) {
								echo $value11;
							}
						}
			?>
							</tbody>
						</table>
					</div>
				</div>
			</div><!--Основной вывод расписания-->
				
			<?php
					} //--------------------------------------------------------Основной вывод
				}
			}
			?>
		</div><!-- /.container --> 
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/jquery-3.1.1.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();
			});
				
			window.onload = function(){
				var list1 = document.getElementsByClassName("time_para");
				var list2 = [];
				if(list1[0]!=undefined){
					for (var i = 0; i < list1.length; i++) {
						var list3 = [];
						list3[0] = parseInt(list1[i].innerText.substr(0,1));
						list3[1] = parseInt(list1[i].innerText.substr(3,1));
						if(list3[1] == 1){
							list3[1] = parseInt(list1[i].innerText.substr(3,2));
							list3[2] = parseInt(list1[i].innerText.substr(6,2));
							list3[3] = parseInt(list1[i].innerText.substr(9,2));
							list3[4] = parseInt(list1[i].innerText.substr(12,2));
						}else{
							list3[2] = parseInt(list1[i].innerText.substr(5,2));
							list3[3] = parseInt(list1[i].innerText.substr(8,2));
							list3[4] = parseInt(list1[i].innerText.substr(11,2));
						}
						list2[i] = list3;
					}
				}
				var lin = window.location.href;
				var simb = lin.substr(lin.length-2,2);
				
				window.setInterval(function(){
					var date = new Date();
					date.setUTCHours(date.getUTCHours()+4);
					var hours = date.getUTCHours();
					var minutes = date.getMinutes();
					var seconds = date.getSeconds();
				
					if (minutes < 10) 
						minutes = '0' + minutes;
					if (seconds < 10) 
						seconds = '0' + seconds;
					if((simb=="f/")||(simb=="=0")){	
						if(list1[0]!=undefined){
							for (var i = 0; i < list1.length; i++) {
								var ii = i+1;
								var temp = "para_num_" + ii;
								var temp1 = document.getElementsByClassName(temp);
								if((hours==list2[i][1] && minutes>=list2[i][2]) || (hours==list2[i][3] && minutes<=list2[i][4]) || (list2[i][1]<hours && hours<list2[i][3])){
									temp1[0].style.background = "#ffab60";
									temp1[1].style.background = "#ffab60";
								}else{
									temp1[0].style.background = "#ffffff";
									temp1[1].style.background = "#ffffff";
								}
							}
						}
					}
					var str = hours + ':' + minutes + ':' + seconds;
					document.getElementById('clock').innerHTML = str;
				}, 1000);
			}
		</script>
	</body>
</html>			
				<?php
			$mysqli->close();
				?>					