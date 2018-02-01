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
				background-color: #fff;
				-webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
    			box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
    			border-radius: 4px;
    		}
			.changepw-head{
				background-color: #30b571;
			    color: #fff;
			    padding: 0.2em 0em;
			    border-top-left-radius: 4px;
    			border-top-right-radius: 4px;
			}
			.changepw-title{
				font-size: 1.3em;
				font-family: 'Roboto', sans-serif; 
			}
			.changepw-body{
				background-color: #fff;
				padding: 0 2.5em;
			}
			.chnage-greeting-text{
				color: #3a464b;
			    font-family: 'Roboto', sans-serif;
			    text-align: left;
			    margin: 0;
			    padding-top: 1.6em;
			    font-weight: 500;
			}
			.newpass{
				color: #262626;
			    border: 1px solid #ccc;
			    padding: 0.9em 0.8em;
			    text-align: left;
			}
			.passno a{
				color: #e21325;
				font-weight: 500;
				text-decoration: none;
			}
			.chnage-greeting-subtext{
				text-align: left;
				font-family: 'Roboto', sans-serif;
				color: #607883;
				font-size: 0.9em;
				line-height: 29px;
			}
			.changepw-footer{
				padding: 0 2.5em;
			    padding-top: 1.6em;
			    padding-bottom: 2.5em;
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
				<div class="changepw-body">
					<p class="chnage-greeting-text">Hi {{ $first_name }} {{ $last_name }},</p>
					<p class="newpass">Your new password is<span class="passno"><a href="{{ url('/password/changing/')."/".$uniqueid."/".Crypt::encrypt($email) }}"> 'link for new password'</a></span></p>
					<!-- <p class="chnage-greeting-subtext">Don't forget to change your password,congratulations. Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry's standard dummy text</p> -->
				</div>
			</div>
		</div>
	</body>
</html>