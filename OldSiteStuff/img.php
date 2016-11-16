<!DOCTYPE HTML>
<html>
	<title>Deconstruction Developments - Some Pictures</title>
	
	<title>Some Pictures</title>
	<link rel="stylesheet" href="../reset.css" />
	<link rel="stylesheet" href="../main.css" />
	<link rel="stylesheet" type="text/css" href="../jquery.lightbox-0.5.css" media="screen" />
	
	<script src="../javascripts/jquery-1.4.2.js" type="text/javascript"></script>
	<script type="text/javascript" src="../javascripts/jquery.lightbox-0.5.js" ></script>
	

	


	 <div id="container">
           <div id="header">
                <h1> Deconstruction Developments</h1>
                <h3>Image Gallery...Currently a work in progress</h3>
           </div>
            <div id="topNav">
                      <ul>
                        <li>
                            <a href="http://deconstructiondevelopments.com/">Home</a>
                        </li>
                       <li>
                            <a href="/blog/">Words</a>
                        </li>
                        <li>
                            <a class="current"  href="/img/img.php">Images</a>
                        </li>
                        <li>
                            <a href="http://deconstructiondevelopments.com/ThisPlaceIsHorrible/" target="_blank">Comic</a>
                        </li>
                     
                    </ul>
                </div>
            <div id="content">
            
                    <div class="postText" id="contentPortal">
		
			<div id="imgGallery" class="postContents" >
			<?php

				$dir = "./thumb";
				if(is_dir($dir))
				{
					if($dh = opendir($dir))
					{
						$count = 0;
						while (($file = readdir($dh)) !== false) 
						{
							if($count != 5)
							{
								$findJPG = ".jpg";
								$findPNG = ".png";
								$findGIF = ".gif";
								
								$jpgPos = strpos($file,$findJPG);
								$pngPos = strpos($file,$findPNG);
								$gifPos = strpos($file,$findGIF);
								
								$fullfile = str_replace("_tb", "", $file);
								
								if($jpgPos !== false)
								{
									echo "<a href='./gallery/$fullfile'><img src='thumb/$file' width='50px' /></a>&nbsp;";
								}
								if($pngPos !== false)
								{
									echo "<a href='./gallery/$fullfile'><img src='thumb/$file' width='50px' /></a>&nbsp;";
								}
								if($gifPos !== false)
								{
									echo "<a href='./gallery/$fullfile'><img src='thumb/$file' width='50px' /></a>&nbsp;";
								}
							//$count++;	
							}
							else
							{
								$count=0;
								$findJPG = ".jpg";
								$findPNG = ".png";
								$findGIF = ".gif";
								
								$jpgPos = strpos($file,$findJPG);
								$pngPos = strpos($file,$findPNG);
								$gifPos = strpos($file,$findGIF);
								
								
								
								if($jpgPos !== false)
								{
									echo "<a href='./gallery/$fullfile'><img src='thumb/$file' width='50px'  /></a>&nbsp;<br/>";
								}
								if($pngPos !== false)
								{
									echo "<a href='./gallery/$fullfile'><img src='thumb/$file' width='50px' /></a>&nbsp;<br/>";
								}
								if($gifPos !== false)
								{
									echo "<a href='./gallery/$fullfile'><img src='thumb/$file' width='50px' /></a>&nbsp;<br/>";
								}
							$count++;	
							}
							
							//echo "filename: $file <br />";
						}
						closedir($dh);
					}
				}
			?>
			</div>
			<div>
			
			</div>
		</div>
	    
            </div>
	    
	    <script type="text/javascript" language="javascript">
		
		$(function() 
		{
			$('#imgGallery a').lightBox(); // Select all links in object with gallery ID
		});

	</script>
	    
            <div id="footer">All of this stuff belongs to chrstopher E. graham. Lightbox by <a href="http://leandrovieira.com/projects/jquery/lightbox/">Leandro Vieira Pinho</a></div>
        </div>
	

</html>