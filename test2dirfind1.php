<?php

    if (is_dir('zbackupsoftwarefiles')) 
	{
        //code to use if directory
		echo 'Dir Found.';
    }
	else
	{
		echo 'Dir Not Found';
		mkdir("zbackupsoftwarefiles");
		echo 'Dir Created';
	}


?>