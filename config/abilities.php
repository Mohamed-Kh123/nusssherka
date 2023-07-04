<?php


$models = array('product', 'category', 
                'order', 'brand', 
                'color', 'aboutUs',
                'config', 'coupon', 
                'payment', 'role',
                'dimension', 'tag',
                'size', 'rating',
                'profile', 'cart',
                'contact', 'user', 
                'notification');

$methods = array('view-any', 'view', 'create', 'update', 'delete');                
$mylist = array();
foreach($models as $model){
    foreach($methods as $method){
        $abilities = "$method $model";
        $mylist["$model.$method"] = $abilities;
    }
};

return $mylist;