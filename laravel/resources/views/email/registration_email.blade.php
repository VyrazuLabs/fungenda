<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900" rel="stylesheet">
		<style type="text/css">
			body{
				margin: 0;
				padding: 0;
			}
			.main-box{
				max-width: 100%;
				text-align: center;
				background-color: #eef4f9;
				height: 100vh;
			}
			.fungenda-mailer-logo-div{
				padding: 1em 0em;
			}
			.fungenda-mailer-logo{
				width: 12%;
    			max-width: 100%;
			}
			.changepwsub-box{
				width: 600px;
				margin: auto;
				float: none;
				-webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
    			box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
    			border-radius: 4px;
    		}
    		.changepw-body{
				background-color: #fff;
				padding: 0 2.5em;
			}
			.registration-body{
				padding-top: 2em;
			}
			.chnage-greeting-text{
				color: #3a464b;
			    font-family: 'Roboto', sans-serif;
			    text-align: left;
			    margin: 0;
			    padding-top: 1.6em;
			    font-weight: 500;
			}
			.chnage-greeting-subtext{
				text-align: left;
			    font-family: 'Roboto', sans-serif;
			    color: #607883;
			    font-size: 0.9em;
			    line-height: 29px;
			    margin-bottom: 0;
			}
    		.changepw-footer{
				padding: 0 2.5em;
			    padding-top: 1em;
			    padding-bottom: 2.5em;
			    background-color: #fff;
			}
			.mailer-forgetpw-btn{
				background-color: #e21325;
			    border: 2px solid #e21325;
			    color: #fff;
			    box-shadow: 0px 2px 5px rgba(0,0,0,0.3);
			    outline: none;
			    border-radius: 55px;
			    padding: 13px 33px;
			    margin: 0;
			    font-size: 1em;
			    font-family: 'Roboto', sans-serif;
			}
		</style>
	</head>
	<body>
		<div class="main-box">
			<div class="fungenda-mailer-logo-div">
				<img src="{{ url('images/logo.png') }}" class="fungenda-mailer-logo">
			</div>
			<div class="changepwsub-box">
				<div class="changepw-body registration-body">
					<p class="chnage-greeting-text">Hi {{ $first_name }} {{ $last_name }},</p>
					<!-- <p class="chnage-greeting-subtext">Your have successfully signed up. Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry's standard dummy text</p> -->
				</div>
				<div class="changepw-footer">
					<a href="{{ url('/') }}"><button type="button" class="mailer-forgetpw-btn">Get me in there</button></a>
				</div>
			</div>
		</div>
	</body>
	</html>