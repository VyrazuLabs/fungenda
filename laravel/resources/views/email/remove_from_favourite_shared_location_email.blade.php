<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
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
    			display: inline-block;
    		}
    		.changepw-body{
				background-color: #fff;
				padding: 0 2.5em;
			}
    		.favourite-greeting-text{
				color: #262626;
			    font-family: 'Roboto', sans-serif;
			    margin-bottom: 4px;
			    padding-top: 2em;
			    font-size: 1.6em;
			    font-weight: 300;
			}
			.favourite-greeting-textfirst{
				font-weight: 500;
				font-family: 'Roboto', sans-serif;
			}
			.favourite-greeting-subtext{
				color: #262626;
				font-family: 'Roboto', sans-serif;
			    margin: 0;
			    font-size: 1.6em;
			    font-weight: 300;
			}
			.mailer-fabourite-box-div{
				max-width: 100%;
			    padding: 0 2.5em;
			    float: left;
			    padding-top: 2.5em;
			    padding-bottom: 3em;
			}
			.favourite-image-box{
				max-width: 27%;
			    display: inline-block;
			    float: left;
			}
			.chnage-greeting-subtext{
				font-family: 'Roboto', sans-serif;
			    color: #262626;
			    font-size: 1em;
			    line-height: 26px;
			    padding-top: 1em;
			}
			.favourite-image-description-box{
				max-width: 62%;
			    display: inline-block;
			    text-align: left;
			}
			.favourite-image{
				width: 100%;
			}
			.image-description-text{
			    color: #262626;
			    font-family: 'Roboto', sans-serif;
			    margin: 0;
			    line-height: 24px;
			    padding-top: 1em;
			}
			.image-description-text-title{
				font-size: 1.7em;
				color: #262626;
				font-family: 'Roboto', sans-serif;
				margin: 0;
			}
			.changepw-footer{
				padding: 0 2.5em;
			    padding-top: 1em;
			    padding-bottom: 2.5em;
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
					<p class="favourite-greeting-text"><span class="favourite-greeting-textfirst">Hi {{ $first_name }}!</span><span class=""> you have removed this shared location successfully</span></p>
					<!-- <p class="chnage-greeting-subtext"> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type text ever since the</p> -->
				</div>
				<div class="mailer-fabourite-box-div">
					<div class="favourite-image-box">
					@if(!empty($share_location['file']) )
						<img class="favourite-image" src="{{ url('/images/placeholder.svg') }}" style="height: 100px; width: 100px;">
					@else
						<img src="{{ url('images/share_location/'.explode(',',$share_location['file'])[0]) }}" class="favourite-image">
					@endif
					</div>
					<div class="favourite-image-description-box">
						<p class="image-description-text-title">{{ $share_location['given_name'] }}</p>
						<p class="image-description-text">{{ $share_location['description'] }}</p>
					</div>
				</div>
				<!-- <div class="changepw-footer"> -->
					<!-- <a href="#"><button type="button" class="mailer-forgetpw-btn">Go to my shared location</button></a> -->
				<!-- </div> -->
			</div>
		</div>
	</body>
</html>
