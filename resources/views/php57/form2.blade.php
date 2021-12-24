<?php 
	$so1 = Request::get("so1") != "" ? Request::get("so1") : 0;
	$so2 = Request::get("so2") != "" ? Request::get("so2") : 0;
	$tong = $so1 + $so2;
 ?>
<form method="post" action="">
	<!-- phai co ham sau thi laravel moi bat du lieu duoc sau khi an nut submit -->
	@csrf
	<fieldset style="width:300px; margin:20px auto;">
		<legend>Cộng 2 số</legend>
		<table cellpadding="5">
			<tr>
				<td>Số 1</td>
				<td><input type="number" name="so1" required></td>
			</tr>
			<tr>
				<td>Số 2</td>
				<td><input type="number" name="so2" required></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Thực hiện"></td>
			</tr>
		</table>
		<h1>{{ "$so1 + $so2 = $tong" }}</h1>
	</fieldset>
</form>