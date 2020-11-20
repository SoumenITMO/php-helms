<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	</head>
<body>

Please enter your name and pick the Sectors you are currently involved in.
	<br>
	<br>
	<form action="saveuser" method="POST">
		
		Name: 
		<input type="text" name="username" value={{ $formdata["username"] }} required>
		@if($errors->has('username'))
				<div style="color:red">{{ $errors->first('username') }}</div>
		@endif
		<br>
		<br>
		
		Sectors: 
			<select size='20' style='width:50%' name="sectors" required>
				<?=$formdata["sectors"]?>
			</select>
			@if($errors->has('sectors'))
				<div style="color:red">{{ $errors->first('sectors') }}</div>
			@endif
		<br>
		<br>
		
		<input type="checkbox" name="terms_condition" required> Agree to terms
		@if($errors->has('terms_condition'))
			<div style="color:red">{{ $errors->first('terms_condition') }}</div>
		@endif
		
		<br>
		<br>
		<input type="submit" value="Save">
	</form>
	
</body>
</html>

