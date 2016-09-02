<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Edmonton Prayer Times</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/clock.css" />
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.0.0/moment.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<script type="text/javascript">
		var timerdate = "";
		var id="";
		var rowid = "";
		var timerdateM = "";
		var idM="";
		window.onload = function(){
					getdata();
				};
			function getdata()
			{	
				$.ajax({
					type : 'GET', // Using GET method to sent data
					url : 'getdata.php',
					dataType : 'json',  //return data type is JavaScript Object Notation
					success : function(response) 
					{ 	
						$('.date').html(response.date);
						$('.month').html(response.month);
						
						//show Local Times
						$('.fajr').html(response.fajr);
						$('.sunrise').html(response.sunrise);
						$('.thuhr').html(response.thuhr);
						$('.asr').html(response.asr);
						$('.maghrib').html(response.maghrib);
						$('.isha').html(response.isha);
						
						//show Iqama Times
						$('.fajrM').html(response.fajrM);
						$('.sunriseM').html(response.sunriseM);
						$('.thuhrM').html(response.thuhrM);
						$('.asrM').html(response.asrM);
						$('.maghribM').html(response.maghribM);
						$('.ishaM').html(response.ishaM);
						
						//Local Time counter - Start
						if(gettimediffer(response.timerdate1) > 0)
						{
							timerdate = response.timerdate1;
							id = 'timer1';
							rowid = 'row1';
						}
						else if(gettimediffer(response.timerdate2) > 0)
						{
							timerdate = response.timerdate2;
							id = 'timer2';
							rowid = 'row2';
						}
						else if(gettimediffer(response.timerdate3) > 0)
						{
							timerdate = response.timerdate3;
							id = 'timer3';
							rowid = 'row3';
						}
						else if(gettimediffer(response.timerdate4) > 0) 
						{
							timerdate = response.timerdate4;
							id = 'timer4';
							rowid = 'row4';
						}
						else if(gettimediffer(response.timerdate5) > 0)
						{
							timerdate = response.timerdate5;
							id = 'timer5';
							rowid = 'row5';
						}
						else if(gettimediffer(response.timerdate6) > 0)
						{
							timerdate = response.timerdate6;
							id = 'timer6';
							rowid = 'row6';
						}	
						//Local Time counter - End

						//Iqama Time Counter - Start
						if(gettimediffer(response.timerdateM1) > 0)
						{
							timerdateM = response.timerdateM1;
							idM = 'timerM1';
							rowid = 'row1';
						}
						else if(gettimediffer(response.timerdateM2) > 0)
						{
							timerdateM = response.timerdateM2;
							idM = 'timerM2';
							rowid = 'row2';
						}
						else if(gettimediffer(response.timerdateM3) > 0)
						{
							timerdateM = response.timerdateM3;
							idM = 'timerM3';
							rowid = 'row3';
						}
						else if(gettimediffer(response.timerdateM4) > 0)
						{
							timerdateM = response.timerdateM4;
							idM = 'timerM4';
							rowid = 'row4';
						}
						else if(gettimediffer(response.timerdateM5) > 0)
						{
							timerdateM = response.timerdateM5;
							idM = 'timerM5';
							rowid = 'row5';
						}
						else if(gettimediffer(response.timerdateM6) > 0)
						{
							timerdateM = response.timerdateM6;
							idM = 'timerM6';
							rowid = 'row6';
						}	
						//Iqama Time Counter - End
						
						$('#'+rowid+'').css('background', "#0a0a0a"); 
						$('#'+rowid+'').css('background', "-moz-linear-gradient(top,  #0a0a0a 0%, #0a0a0a 49%, #202020 49%, #252525 65%, #171717 100%)"); 
						$('#'+rowid+'').css('background', "-webkit-gradient(linear, left top, left bottom, color-stop(0%,#0a0a0a), color-stop(49%,#0a0a0a), color-stop(49%,#202020), color-stop(65%,#252525), color-stop(100%,#171717))"); 
						$('#'+rowid+'').css('background', "-webkit-linear-gradient(top,  #0a0a0a 0%,#0a0a0a 49%,#202020 49%,#252525 65%,#171717 100%)"); 
						$('#'+rowid+'').css('background', "-o-linear-gradient(top,  #0a0a0a 0%,#0a0a0a 49%,#202020 49%,#252525 65%,#171717 100%)"); 
						$('#'+rowid+'').css('background', "-ms-linear-gradient(top,  #0a0a0a 0%,#0a0a0a 49%,#202020 49%,#252525 65%,#171717 100%)"); 
						$('#'+rowid+'').css('background', "linear-gradient(to bottom,  #0a0a0a 0%,#0a0a0a 49%,#202020 49%,#252525 65%,#171717 100%)"); 
						$('#'+rowid+'').css('filter', "progid:DXImageTransform.Microsoft.gradient( startColorstr='#0a0a0a', endColorstr='#171717',GradientType=0 )"); 
					},
					complete : function(response)
					{		
						timer();
						timerM();
					}  
					});

			}
		function timer() 
		{	
			var xmas = new Date(timerdate);
			var now = new Date();
			var timeDiff = xmas.getTime() - now.getTime();
			if(timeDiff <= 0)
			{	
				clearTimeout(timercall);
				document.getElementById(id).innerHTML = ' ';
				id = "";
				$('#'+rowid+'').css('background', "#e10c0e"); 
				$('#'+rowid+'').css('background', "-moz-linear-gradient(top, #e10c0e 0%, #ff2323 0%, #e80808 10%, #ff2323 10%, #e80607 49%, #ff2323 50%, #f5191b 100%)"); 
				$('#'+rowid+'').css('background', "-webkit-gradient(linear, left top, left bottom, color-stop(0%,#e10c0e), color-stop(0%,#ff2323), color-stop(10%,#e80808), color-stop(10%,#ff2323), color-stop(49%,#e80607), color-stop(50%,#ff2323), color-stop(100%,#f5191b))"); 
				$('#'+rowid+'').css('background', "-webkit-linear-gradient(top, #e10c0e 0%,#ff2323 0%,#e80808 10%,#ff2323 10%,#e80607 49%,#ff2323 50%,#f5191b 100%)"); 
				$('#'+rowid+'').css('background', "-o-linear-gradient(top, #e10c0e 0%,#ff2323 0%,#e80808 10%,#ff2323 10%,#e80607 49%,#ff2323 50%,#f5191b 100%)"); 
				$('#'+rowid+'').css('background', "-ms-linear-gradient(top, #e10c0e 0%,#ff2323 0%,#e80808 10%,#ff2323 10%,#e80607 49%,#ff2323 50%,#f5191b 100%)"); 
				$('#'+rowid+'').css('background', "linear-gradient(to bottom, #e10c0e 0%,#ff2323 0%,#e80808 10%,#ff2323 10%,#e80607 49%,#ff2323 50%,#f5191b 100%)"); 
				$('#'+rowid+'').css('filter', "progid:DXImageTransform.Microsoft.gradient( startColorstr='#e10c0e', endColorstr='#f5191b',GradientType=0 )"); 
				getdata();
			}
			var seconds = Math.floor(timeDiff / 1000);
			var minutes = Math.floor(seconds / 60);
			var hours = Math.floor(minutes / 60);
			//var days = Math.floor(hours / 24);
			hours %= 24;
			minutes %= 60;
			seconds %= 60;
			var str = seconds.toString();
			if(str.length < 2)
			str = '0'+str;
			document.getElementById(id).innerHTML = hours+'h : '+minutes+'m : '+str+'s';
			var timercall = setTimeout('timer()',1000);
		}
		
		
		function timerM() 
		{	
			var xmas = new Date(timerdateM);
			var now = new Date();
			var timeDiff = xmas.getTime() - now.getTime();
			if(timeDiff <= 0)
			{	
				clearTimeout(timercall);
				document.getElementById(idM).innerHTML = ' ';
				idM = "";
				$('#'+rowid+'').css('background', "#e10c0e"); 
				$('#'+rowid+'').css('background', "-moz-linear-gradient(top, #e10c0e 0%, #ff2323 0%, #e80808 10%, #ff2323 10%, #e80607 49%, #ff2323 50%, #f5191b 100%)"); 
				$('#'+rowid+'').css('background', "-webkit-gradient(linear, left top, left bottom, color-stop(0%,#e10c0e), color-stop(0%,#ff2323), color-stop(10%,#e80808), color-stop(10%,#ff2323), color-stop(49%,#e80607), color-stop(50%,#ff2323), color-stop(100%,#f5191b))"); 
				$('#'+rowid+'').css('background', "-webkit-linear-gradient(top, #e10c0e 0%,#ff2323 0%,#e80808 10%,#ff2323 10%,#e80607 49%,#ff2323 50%,#f5191b 100%)"); 
				$('#'+rowid+'').css('background', "-o-linear-gradient(top, #e10c0e 0%,#ff2323 0%,#e80808 10%,#ff2323 10%,#e80607 49%,#ff2323 50%,#f5191b 100%)"); 
				$('#'+rowid+'').css('background', "-ms-linear-gradient(top, #e10c0e 0%,#ff2323 0%,#e80808 10%,#ff2323 10%,#e80607 49%,#ff2323 50%,#f5191b 100%)"); 
				$('#'+rowid+'').css('background', "linear-gradient(to bottom, #e10c0e 0%,#ff2323 0%,#e80808 10%,#ff2323 10%,#e80607 49%,#ff2323 50%,#f5191b 100%)"); 
				$('#'+rowid+'').css('filter', "progid:DXImageTransform.Microsoft.gradient( startColorstr='#e10c0e', endColorstr='#f5191b',GradientType=0 )"); 
				getdata();
			}
			var seconds = Math.floor(timeDiff / 1000);
			var minutes = Math.floor(seconds / 60);
			var hours = Math.floor(minutes / 60);
			//var days = Math.floor(hours / 24);
			hours %= 24;
			minutes %= 60;
			seconds %= 60;
			var str = seconds.toString();
			if(str.length < 2)
			str = '0'+str;
			document.getElementById(idM).innerHTML = hours+'h : '+minutes+'m : '+str+'s';
			var timercall = setTimeout('timerM()',1000);
		}
		
		function gettimediffer(date)
		{
			var caldate = new Date(date);
			var nowtime = new Date();
			var timeDiffer = caldate.getTime() - nowtime.getTime();
			return timeDiffer;		
		}
		</script>	
	</head>
	<body>
		
		<!-- Mid Container Start -->
		<div class="mid_container"> 
			
			<!-- Mid header Start -->
			<div class="mid_content">
				<table class="content_table" border="0" align="center" cellspacing="5">
					<tr>
						<td class="mid_header" colspan="3">Edmonton Prayer Times</td>
					</tr>
					<tr>
						<!--<td><span class="date"></span></td>-->
						<td id="clock" colspan="3" class="dark"><span class="digits" ></span><span class="ampm"></span></td>
						<!--<td><span class="month"></span></td>-->
					</tr>
					<tr>
						<td style="color: #15a0e5;"><b>Prayer</b> </td>
						<td style="color: #15a0e5;"><b>Local Times</b></td>
						<td style="color: #15a0e5;"><b>Iqama Times</b></td>
					</tr>
					<tr id="row1">
						<td>FAJR</td>
						<td><span class="fajr"></span><span class="timer" id="timer1"></span></td>
						<td><span class="fajrM"></span><span class="timer" id="timerM1"></span></td>
					</tr>
					<tr id="row2">
						<td>SUNRISE</td>
						<td><span class="sunrise"></span><span class="timer" id="timer2"></span></td>
						<td><span class="sunriseM"><span class="timer" id="timerM2"></span> </td>
					</tr>
					<tr id="row3">
						<td>DHUHR</td>
						<td><span class="thuhr"></span><span class="timer" id="timer3"></span></td>
						<td><span class="thuhrM"></span><span class="timer" id="timerM3"></span> </td>
					</tr>
					<?php if(date('l') == 'Friday') {?>
					<tr id="row3">
						<td>JUMAH</td>
						<td><span class="thuhr"></span></td>
						<td><span class="thuhrM"></span> </td>
					</tr>
					<?php }; ?>
					<tr id="row4">
						<td>ASR</td>
						<td><span class="asr"></span><span class="timer" id="timer4"></span></td>
						<td><span class="asrM"></span><span class="timer" id="timerM4"></span> </td>
					</tr>
					<tr id="row5">
						<td>MAGHRIB</td>
						<td><span class="maghrib"></span><span class="timer" id="timer5"></span></td>
						<td><span class="maghribM"></span><span class="timer" id="timerM5"></span> </td>
					</tr>
					<tr id="row6">
						<td>ISHA</td>
						<td><span class="isha"></span><span class="timer" id="timer6"></span></td>
						<td> <span class="ishaM"></span><span class="timer" id="timerM6"></span></td>
					</tr>
				</table>
			</div>
			<!-- Mid header End -->
		</div>
		<!-- Mid Container End -->
		
	</body>
</html>