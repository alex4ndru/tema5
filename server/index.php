<?php
namespace Main;
use Main\Api\Api;

include './vendor/autoload.php';

//echo "server.php<hr />";

if(isset($_GET))
{
    if(isset($_GET['api']))
    {
        $myApi = new Api();
        $myApi->get();
    }
    else echo "Api interface, no page here...";
}
else echo "Api interface, no page here...";

/*
$t = simplexml_load_file('db.xml');
foreach ($t->children() as $k => $v)
{
    echo "<hr style='border:2px solid blue' />";
    echo (string)$k;
    
    foreach($v->children() as $v2)
    {
        echo "<hr style='border:1px solid black' />";
        echo "$v2->id | $v2->name";        
    }
}
*/  