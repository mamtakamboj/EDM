<?php
/*
* =================================================================================================================
*
*										MODULE				:	Send data to user
*										PLATFORM			:	PHP 5, MYSQL 5
*										CREATED ON			:	19-Jul-13			
* =================================================================================================================
*/
?>
<?php
	/* Error Reporting - Start */	
	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	/* Error Reporting - End */
	
	/* Include Gregorian to Hijri date calculator file*/
	require_once('Gregorian_Hijri_Convert.class');
	
	
	/* Get today prayer time - start*/
	$dayNumber = date("z") + 1; 
	$response = array();
	$file = "time.csv";
	$i= 0;
	if (($handle = fopen("time.csv", "r")) !== FALSE) 
	{
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
		{
		   $filearray[$i] = $data;
		   $i++;
		}
		fclose($handle);
	}
	$content = $filearray[$dayNumber];
	$prayer_time = array_combine($filearray[0] , $content);
	/* Get today prayer time - end*/

	/*Get Hijri date from Current date - start*/
	$inputdate = date('dmY', strtotime($prayer_time['Date']));
	$hijrimonths = Array("Muharram","Safar","Rabi-AlAwwal","Rabi-AlThani","Jumada Al-Ula","Jumada Al-Thani","Rajab","Shaban","Ramadan","Shawwal","Thul Qadah","Thul Hijjah");
	$hijriobject = new Gregorian_HijriConvert;
	$outputdate = $hijriobject->GregorianToHijri($inputdate,'DDMMYYYY');
	$hijridatesepration = explode('-',$outputdate);
	$actualdate = $hijridatesepration[0]." ".$hijrimonths[$hijridatesepration[1]-1]." ".$hijridatesepration[2];
	/*Get Hijri date from Current date - end*/
	
	/*make response data - start*/
	$response['date'] = date('F jS Y', strtotime($prayer_time['Date']));
	$response['month'] = $actualdate;
	$response['fajr'] = date("g:i A", strtotime($prayer_time['Fajr']));
	$response['sunrise'] = date("g:i A", strtotime($prayer_time['Sunrise']));
	$response['thuhr'] = date("g:i A", strtotime($prayer_time['Thuhr'])); 
	$response['asr'] = date("g:i A", strtotime($prayer_time['Asr'])); 
	$response['maghrib'] = date("g:i A", strtotime($prayer_time['Maghrib']));
	$response['isha'] = date("g:i A", strtotime($prayer_time['Isha']));
	
	$response['fajrM'] = date("g:i A", strtotime($prayer_time['FajrM']));
	$response['sunriseM'] = date("g:i A", strtotime($prayer_time['SunriseM']));
	$response['thuhrM'] = date("g:i A", strtotime($prayer_time['ThuhrM'])); 
	$response['asrM'] = date("g:i A", strtotime($prayer_time['AsrM'])); 
	$response['maghribM'] = date("g:i A", strtotime($prayer_time['MaghribM']));
	$response['ishaM'] = date("g:i A", strtotime($prayer_time['IshaM'])); 
	/*make response data - end*/
	
	/*Set timer according to condition - start*/
		$response['timerdate1'] =  date('F d, Y H:i:s', strtotime($prayer_time['Fajr']));
		$response['timerdate2'] =  date('F d, Y H:i:s', strtotime($prayer_time['Sunrise']));
		$response['timerdate3'] =  date('F d, Y H:i:s', strtotime($prayer_time['Thuhr']));
		$response['timerdate4'] =  date('F d, Y H:i:s', strtotime($prayer_time['Asr']));
		$response['timerdate5'] =  date('F d, Y H:i:s', strtotime($prayer_time['Maghrib']));
		$response['timerdate6'] =  date('F d, Y H:i:s', strtotime($prayer_time['Isha']));
		
		$response['timerdateM1'] =  date('F d, Y H:i:s', strtotime($prayer_time['FajrM']));
		$response['timerdateM2'] =  date('F d, Y H:i:s', strtotime($prayer_time['SunriseM']));
		$response['timerdateM3'] =  date('F d, Y H:i:s', strtotime($prayer_time['ThuhrM']));
		$response['timerdateM4'] =  date('F d, Y H:i:s', strtotime($prayer_time['AsrM']));
		$response['timerdateM5'] =  date('F d, Y H:i:s', strtotime($prayer_time['MaghribM']));
		$response['timerdateM6'] =  date('F d, Y H:i:s', strtotime($prayer_time['IshaM']));
	/*Set timer according to condition - End*/
	
	// return a json array
	echo json_encode($response); //Push Data at Client end
	flush();
?>