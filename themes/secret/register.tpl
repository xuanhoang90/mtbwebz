<html>
	<head>
		<style>
			body{
				background: #f1f1f1;
			}
			.register{
				width: 90%;
				max-width: 500px;
				margin: 50px auto;
				display: block;
				background: white;
				padding: 10px;
				border-radius: 5px;
				-webkit-border-radius: 5px;
				-moz-border-radius: 5px;
				-o-border-radius: 5px;
				box-shadow: 0px 0px 5px gray;
				-webkit-box-shadow: 0px 0px 5px gray;
				-moz-box-shadow: 0px 0px 5px gray;
				-o-box-shadow: 0px 0px 5px gray;
				background: green;
			}
			.register .header, .register .body, .register .footer{
				display: block;
				margin: 5px;
				padding: 5px;
			}
			.register .header .register-title{
				display: block;
				margin: 5px auto;
				padding: 5px;
				line-height: 30px;
				font-size: 30px;
				font-weight: bold;
				color: white;
				text-align: center;
			}
			.register .header .title-desc{
				display: block;
				margin: 5px auto;
				line-height: 20px;
				font-size: 15px;
				font-weight: bold;
				color: #fafafa;
				text-align: center;
			}
			.register .body .input-nav{
				display: block;
				margin: 5px auto;
				width: 80%;
				padding: 5px;
				max-width: 300px;
			}
			.register .body .input-nav .label{
				width: 90%;
				margin: 5px auto;
				display: block;
				padding: 5px;
				border: none;
				outline: none;
				line-height: 18px;
				color: white;
				font-weight: bold;
			}
			.register .body .input-nav .input-text, .register .body .input-nav .input-select{
				width: 90%;
				margin: 5px auto;
				display: block;
				padding: 10px;
				border: none;
				outline: none;
				line-height: 20px;
				font-size: 14px;
				color: green;
				font-family: "Arial";
			}
			.register .footer .input-text{
				width: 200px;
				line-height: 30px;
				display: block;
				margin: 10px auto;
				background: green;
				border: none;
				outline: none;
				text-align: center;
				color: white;
				font-family: "Arial";
				font-size: 15px;
				font-weight: bold;
				border: 3px solid white;
				border-radius: 5px;
				-webkit-border-radius: 5px;
				-moz-border-radius: 5px;
				-o-border-radius: 5px;
				cursor: pointer;
			}
			.register .footer .input-text:hover{
				background: darkgreen;
			}
		</style>
	</head>
	<body>
		<form action="#" method="GET" class="register">
			<input name="d133d489c50faa670fda92df205f52bf" value="1" type="hidden" />
			<input name="action" value="register_do" type="hidden" />
			<div class="header">
				<h1 class="register-title">TAKA Multisite</h1>
				<p class="title-desc">Register new Website</p>
			</div>
			<div class="body">
				<legend class="input-nav">
					<p class="label">Domain:</p>
					<input type="text" name="domain" class="input-text" value="" placeholder="Your domain"/>
				</legend>
				<legend class="input-nav">
					<p class="label">Main Account:</p>
					<input type="text" name="account_name" class="input-text" value="" placeholder="Main Account"/>
				</legend>
				<legend class="input-nav">
					<p class="label">Password:</p>
					<input type="password" name="account_pwd" class="input-text" value="" placeholder="Password"/>
				</legend>
				<legend class="input-nav">
					<p class="label">Repeat password:</p>
					<input type="password" name="repassword" class="input-text" value="" placeholder="Repeat password"/>
				</legend>
				<legend class="input-nav">
					<p class="label">Repeat password:</p>
					<select name="account_type" class="input-select">
						<option value="default">--Select--</option>
						<option value="package1">Package 1</option>
						<option value="package2">Package 2</option>
						<option value="package3">Package 3</option>
						<option value="package4">Package 4</option>
						<option value="package5">Package 5</option>
					</select>
				</legend>
				<legend class="input-nav">
					<p class="label">Data Size:</p>
					<input type="text" name="account_size" class="input-text" value="" placeholder="Data size"/>
				</legend>
			</div>
			<div class="footer">
				<input type="submit" name="submit" value="Register" class="input-text" />
			</div>
		</form>
	</body>
</html>