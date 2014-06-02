<?php

/* 
 * The MIT License
 *
 * Copyright 2014 Maciej Lew <maciej.lew.1987@gmail.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

require_once '../lib/ServiceProxy.php';
require_once '../lib/ServiceRegister.php';
require_once '../lib/ServiceRegisterProxyNotSetException.php';
require_once '../lib/SoapCascadeServer.php';

use SoapCascade\SoapCascadeServer;

require_once './CalcService.php';
require_once './CalcExtraService.php';


$http = 'http'; // https
$host = 'sandbox.localdomain';
$port = 80;
$path = 'SoapCascade/examples/calc_server.php';

$template = '%s://%s:%d/%s';

$uri = sprintf($template, $http, $host, $port, $path);

$options = array(
    'uri' => $uri,
    'location' => $uri,
);

$calc_service = new CalcService();
$calc_extra_service = new CalcExtraService();

try {
    
    $server = new SoapCascadeServer(null, $options);
    $server->registerService($calc_service);
    $server->registerService($calc_extra_service);
    $server->handle();
    
} catch (Exception $ex) {
    
    throw new SoapFault('SERVER', 'Application Error: ' . $ex->getMessage());
    
}