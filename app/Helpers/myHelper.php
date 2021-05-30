<?php
function imageUpload($image,$directory){
    $type=$image->getClientOriginalExtension();
    $name=rand(0,1000).time().'.'.$type;

    $image->move($directory,$name);
    return $directory.$name;
}
