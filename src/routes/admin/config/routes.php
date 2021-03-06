<?php
/*
    PufferPanel - A Minecraft Server Management Panel
    Copyright (c) 2013 Dane Everitt

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see http://www.gnu.org/licenses/.
*/
namespace PufferPanel\Core;
use \ORM;

$klein->respond('GET', '/admin/config/global', function($request, $response, $service) use ($core) {
    
    $response->body($core->twig->render('admin/config/global.html'))->send();
    
});

$klein->respond('GET', '/admin/config/urls', function($request, $response, $service) use ($core) {
    
    $response->body($core->twig->render('admin/config/urls.html'))->send();
    
});

$klein->respond('GET', '/admin/config/email', function($request, $response, $service) use ($core) {
    
    $response->body($core->twig->render('admin/config/email.html'))->send();
    
});

$klein->respond('GET', '/admin/config/captcha', function($request, $response, $service) use ($core) {
    
    $response->body($core->twig->render('admin/config/captcha.html'))->send();
    
});