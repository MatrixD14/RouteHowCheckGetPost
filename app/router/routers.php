<?php

return [
    '/' => 'HomeController@index',
    '/contact/[0-9]+' => 'ContactController@index',
    '/user/[0-9]+/name/[a-z]+' => 'User@name'
];
