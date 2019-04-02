<?php
/*
	* Created On 10/08/17
	* Created By Akansh Sirohi (C.Sc Student)
*/
/*
	* Understanding pixels using Php GD
	* Created only for experimental use
	* Works On True Colour Images
	* Images can be easily get damaged on any type of compression
	* Speed of encoding or decoding depends upon the data size
	* It generated linear strip of pixels with data encoded in it
*/
/*
	* DataPixPHP Version 3
	* Stores 4 Characters In 1 Pixel
*/
class DataPixPHP {
	function __construct() {
		// Empty
	}
	public function encode($str,$nameC='0') 
	{
			/*
				* (required) $str is string to encode into pixels
				* (optional) $nameC is path or image file name  
			*/
			if(empty($str)) {
				return null;
			}
			$data1='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890=/+'; // Characters used in base64 encoding 
			
			$dataR='0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64';
			$dataG='0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64';
			$dataB='0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64';
			$dataA='0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64';
			
			$dataR=explode(',',$dataR);
			$dataG=explode(',',$dataG);
			$dataB=explode(',',$dataB);
			$dataA=explode(',',$dataA);
			
			$str64=base64_encode($str); // Encode string into base64 format to to make it safe to encode
			$x = strlen($str64);
			$y=1;
			$loc1;$loc2;$loc3;$loc4;
			$pix=0;
			$gd = imagecreatetruecolor($x, $y);  // Generate Blank Image of NxN
			imagealphablending($gd, false); // Turn off blending to support alpha channel
			
			// Data Encoding Start Into Image 
			for($k=0; $k<=$y; $k++) 
			{	
					for($i=0; $i<$x; $i=$i+4) 
					{
							for($g=0; $g<=64; $g++) 
							{
								if($i<$x) 
								{
									if($str64[$i]==$data1[$g]) 
									{
										$loc1=$g;
									}
								}
							}
							for($g=0; $g<=64; $g++) 
							{
								if($i+1<$x) 
								{
									if($str64[$i+1]==$data1[$g]) 
									{
										$loc2=$g;
									}
								}
							}
							for($g=0; $g<=64; $g++) 
							{
								if($i+2<$x) 
								{
									if($str64[$i+2]==$data1[$g]) 
									{
										$loc3=$g;
									}
								}
							}
							for($g=0; $g<=64; $g++) 
							{
								if($i+3<$x) 
								{
									if($str64[$i+3]==$data1[$g]) 
									{
										$loc4=$g;
									}
								}
							}
							$col=imagecolorallocatealpha($gd, $dataR[$loc1], $dataG[$loc2], $dataB[$loc3], $dataA[$loc4]); //gen of color
							imagesetpixel($gd, $pix ,$k, $col); //set color to pixel  $i=x-axis  0=y-axis=$k
							$pix++;
					}
			}
			$pixels=$x/4;
			$gd=imagecrop($gd,['x'=>0,'y'=>0,'width'=>$pixels,'height'=>1]);
			
			// Base64 string written into image
			// Image Generation Completed!
			
			// Generating Image File
			if($nameC=='0') 
			{
					$name=sha1(md5(rand(0,10000))).'data.png';
					for($i=0; $i<1000; $i++) 
					{
							if(file_exists($name)) 
							{
								$name=sha1(md5(rand(0,10000))).'data.png';
							}
							else
							{
								break;
							}
					}
			}
			else
			{
					$name=$nameC.'.png';
			}
			imagepng($gd,$name);
			return $name;
	}


	public function decode($data)
	{
			/*
				* (required) $data is image file path or name to decode
			*/
			if(file_exists($data))
			{       
					$im = imagecreatefrompng($data);
					imagealphablending($im, false); // Turn off blending to support alpha channel
					$x1=imagesx($im);
					$data1='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890=/+'; // Characters used in base64 encoding 
					$main="";
					
					// Extracting the data from image
					for($i=0; $i<$x1; $i++) 
					{
						$rgb = imagecolorat($im, $i, 0);
						$colors = imagecolorsforindex($im, $rgb);
						if($colors['red']!='65') 
						{
							$main=$main.$data1[$colors['red']];
						}
						if($colors['green']!='65') 
						{
							$main=$main.$data1[$colors['green']];
						}
						if($colors['blue']!='65') 
						{
							$main=$main.$data1[$colors['blue']];
						}
						if($colors['alpha']!='65') 
						{
							$main=$main.$data1[$colors['alpha']];
						}
					}
					
					// Decode Base64 string written in it
					$main=base64_decode($main);
					return $main;
			}else{
				return null;
			}
	}
}
?>
