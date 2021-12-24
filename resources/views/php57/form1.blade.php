<form method="post" action="">
	<!-- phai co ham sau thi laravel moi bat du lieu duoc sau khi an nut submit -->
	@csrf
	<fieldset style="width:300px; margin:20px auto;">
		<legend>Form</legend>
		<input type="text" name="txt" required>
		<input type="submit" value="submit">
	</fieldset>
	<h1>Lấy dữ liệu trực tiếp từ view: {{ Request::get("txt") }}</h1>
</form>