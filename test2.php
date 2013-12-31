<?php

echo $customercode = '"#228/B,3rd Floor,55th Cross,10th Main,3rd block,"';
echo '<br><br>';
echo preg_replace('/[!,^,+,=,[,],;,,,{,},|,\,<,>,?,~,#,]/', ' ', $customercode);

//$newstr = preg_replace('/[^a-zA-Z0-9\']/', '_', "There wouldn't be any");
//$newstr = str_replace("'", '', $newstr);

//Retains only alpha numeric characters.
$customercode = preg_replace('/[^a-zA-Z0-9\']/', ' ', $customercode);
$customercode = str_replace("'", '', $customercode);
echo '<br><br>'.$customercode;

?>