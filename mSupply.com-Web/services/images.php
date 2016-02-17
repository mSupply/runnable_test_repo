<?php
	function HeroImages($data)
	{
			$images = mysql_query("SELECT * FROM `homepage_images`") or die(mysql_error());
			if(mysql_num_rows($images) > 0)
			{
				while($row = mysql_fetch_array($images))
				{
					//$imgData['Image'] = $row['image'];
					$imgData['Image_path'] = $row['image_path'];
					//$imgData['url_path'] = $row['url_path'];
					$imgArr['data'][] = $imgData;					
				}
				
				$imgArr['message'] = 'Success';
			}
			else
			{
				$imgArr['data'] = null; 					
				$imgArr['message'] = "No Hero Images Found.Try After Sometime";
				
			}
		
		return $imgArr;		
	}	
	
	
?>
