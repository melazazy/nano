
<?php
 function testString($str)
 {
    $new='';

    for($i=strlen($str);$i>=0;$i--)
    {
        // AZaz pattern alpha pattern
        if(!($str[$i]=='AZ' || $str[$i]=='az'))
        {
            return false;
        }
    }
    return true;

}


echo testString('aaADE');
