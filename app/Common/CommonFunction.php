<?php


function getFormBySlug($slug)
{
    $path = resource_path('views/front/forms/'.$slug.'.blade.php');
    $file = file_exists($path);
    return $file ? true : false;
}


function _get($array, $path, $default = null)
{
    return \Illuminate\Support\Arr::get($array, $path, $default);
}
