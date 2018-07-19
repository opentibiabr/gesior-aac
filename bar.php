<?php 
    $x = addslashes(htmlspecialchars(trim($_REQUEST['long']))); 
    if($x < 1 or !is_numeric($x) or empty($x)) 
    { 
        $x=1; 
        $image=ImageCreate($x,10); 
        if($x < 15) 
        $color=ImageColorAllocate($image,255,0,0); 
        elseif($x < 35) 
        $color=ImageColorAllocate($image,255,106,0); 
        elseif($x <= 50) 
        $color=ImageColorAllocate($image,255,216,0); 
        elseif($x > 50) 
        $color=ImageColorAllocate($image,0,255,33); 
        ImageFill($image,1,1,$color); 

        header("Content-type: image/gif");  
        imagegif($image); 
    } 
    elseif($x > 100) 
    { 
        $x=100; 
        $image=ImageCreate($x,10); 
        if($x < 15) 
        $color=ImageColorAllocate($image,255,0,0); 
        elseif($x < 35) 
        $color=ImageColorAllocate($image,255,106,0); 
        elseif($x <= 50) 
        $color=ImageColorAllocate($image,255,216,0); 
        elseif($x > 50) 
        $color=ImageColorAllocate($image,0,255,33); 
        ImageFill($image,1,1,$color); 

        header("Content-type: image/gif");  
        imagegif($image);  
    } 
    else 
    { 
        $image=ImageCreate($x,10); 
        if($x < 15) 
        $color=ImageColorAllocate($image,255,0,0); 
        elseif($x < 35) 
        $color=ImageColorAllocate($image,255,106,0); 
        elseif($x <= 50) 
        $color=ImageColorAllocate($image,255,216,0); 
        elseif($x > 50) 
        $color=ImageColorAllocate($image,0,255,33); 
        ImageFill($image,1,1,$color); 

        header("Content-type: image/gif");  
        imagegif($image);  
    } 
     
?>