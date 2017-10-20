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
				-webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
    			box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
    			background-color: #fff;
    			border-radius: 4px;
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
			.chnage-greeting-subtext{
				font-family: 'Roboto', sans-serif;
			    color: #262626;
			    font-size: 1em;
			    line-height: 26px;
			    padding-top: 1em;
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
			.changepw-footer{
				padding: 0 2.5em;
			    padding-top: 1em;
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
			.image-description-text-title{
				font-size: 1.7em;
				color: #262626;
				font-family: 'Roboto', sans-serif;
				margin: 0;
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
					<p class="favourite-greeting-text"><span class="favourite-greeting-textfirst">Hi {{ $first_name }}!</span><span class=""> you have successfully added this </span></p>
					<p class="favourite-greeting-subtext">business to your favourite list</p>
					<p class="chnage-greeting-subtext"> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type text ever since the</p>
				</div>
				<div class="mailer-fabourite-box-div">
					<div class="favourite-image-box">
						<img src="{{ url('/images/business/'.explode(',',$data['business_image'])[0]) }}" class="favourite-image">
					</div>
					<div class="favourite-image-description-box">
						<p class="image-description-text-title">{{ $data['business_title'] }}</p>
						<p class="image-description-text">Finger foods including burgers. This bar is sort of perfect.First of all it's right across from the police station...</p>
					</div>
				</div>
				<div class="changepw-footer">
					<a href="{{ route('frontend_more_business',['q'=>$data['business_id']]) }}"><button type="button" class="mailer-forgetpw-btn">Go to my business</button></a>
				</div>
			</div>
		</div>
	</body>
</html>