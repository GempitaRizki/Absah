<?php 

$user = new User();
$user->name = $storeSession['store_name'];
$user->email = $storeSession['surel'];
$user->password = bcrypt($storeSession['password']);
$user->role = 1;

$user->save();