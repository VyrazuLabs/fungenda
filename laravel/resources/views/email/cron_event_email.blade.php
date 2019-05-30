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
				width: 800px;
				margin: auto;
				float: none;
				-webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
    			box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
    			border-radius: 4px;
    			background-color: #fff;
    			display: inline-block;
    		}
    		.mailer-fabourite-box-div{
				max-width: 100%;
			    padding: 0 2.5em;
			    padding-top: 3.2em;
			    padding-bottom: 6em;
			}
			.favourite-image-description-box{
				width: 25%;
			    display: inline-block;
			    text-align: center;
			    float: left;
			}
			.favourite-image{
				text-align: center;
				width: 35%;
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
			.chnage-business-subtext{
				color: #262626;
			    font-family: 'Roboto', sans-serif;
			    margin-bottom: 4px;
			    font-size: 1.6em;
			    font-weight: 300;
			    margin-top: 0;
			}
			.image-description-text{
			    color: #262626;
			    font-family: 'Roboto', sans-serif;
			    margin: 0;
			    /*line-height: 24px;*/
			    /*padding-top: 1em;*/
			}
			.image-description-text-title{
				font-size: 1.7em;
				color: #262626;
				font-family: 'Roboto', sans-serif;
				margin: 0;
			}
    		.changepw-footer{
				padding: 0 2.5em;
			    padding-top: 1.6em;
			    padding-bottom: 2.5em;
			}
			.image-div{
				max-width: 33.33%;
			    display: inline-block;
			    float: left;
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
				@php
					$logo_image = env('LOGO_IMAGE_PATH');
				@endphp
				<img src="{{ $logo_image }}" class="fungenda-mailer-logo">
			</div>
			<div class="changepwsub-box">
				<div class="changepw-body registration-body">
					<p class="favourite-greeting-text"><span class="favourite-greeting-textfirst">Hi {{ $first_name }}!</span><span class=""> The list of all edited events</span></p>
				</div>
			@if(!empty($all_event))
				@foreach($all_event as $data)
				<div class="mailer-fabourite-box-div" style="margin-right: 18em;">
					<div class="favourite-image-description-box">

					@if(empty($data['event_main_image']))
						@php
							$default_img = env('DEFAULT_IMAGE_PATH').'/placeholder.svg';
						@endphp
						<img class="favourite-image" src="{{ $default_img }}" style="height: 100px; width: 100px;margin-bottom: 22px">
					@else
						@php
							$default_img = env('EVENT_IMAGE_PATH').'/'.$data['event_main_image'];
						@endphp
						<img src="{{ $default_img }}" class="favourite-image" style="width: 56%;">
					@endif

					</div>
					<div class="favourite-image-description-box">
						<p class="image-description-text" style="font-size: 15px;">{{ $data['event_title'] }}</p>
					</div>
					<div class="favourite-image-description-box">
						<p class="image-description-text" style="font-size: 15px;">{{ $data['event_venue'] }}</p>
					</div>
					<div class="favourite-image-description-box">
						<p class="image-description-text" style="font-size: 15px;">{{ $data['event_fb_link'] }}</p>
					</div>
				</div>
				@endforeach
			@endif
			</div>
		</div>
	</body>
</html>
