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

function display_results(array $results)
{
    foreach ($results as $result) {

        if (PHP_SAPI === 'cli') {

            echo $result;
            
        } else {

            echo nl2br($result);
            
        }
    }
}

$server_script = 'calc_server_v1.php';
//$server_script = 'calc_server_v2.php';

$http = 'http'; // https
$host = 'sandbox.localdomain';
$port = 80;
$path = 'SoapCascade/examples';

$template = '%s://%s:%d/%s/%s';

$uri = sprintf($template, $http, $host, $port, $path, $server_script);

$options = array(
    'uri' => $uri,
    'location' => $uri,
);

try {
    
    $client = new SOAPClient(null, $options);
    
} catch (Exception $ex) {
    
    die($ex->getMessage());
    
}

$x = 0.007;
$y = 0.007;

$results = array();
$results[] = 'x = ' . $x . PHP_EOL;
$results[] = 'y = ' . $y . PHP_EOL;

try {
    
    $results[] = 'x + y = ' . $client->add($x, $y) . PHP_EOL;
    $results[] = 'x - y = ' . $client->diff($x, $y) . PHP_EOL;
    $results[] = 'x * y = ' . $client->multiply($x, $y) . PHP_EOL;
    $results[] = 'x / y = ' . $client->divide($x, $y) . PHP_EOL;
    $results[] = 'Answer to the Ultimate Question of Life, The Universe, and Everything = ' 
        . $client->AnswerToTheUltimateQuestionOfLifeTheUniverseAndEverything() . PHP_EOL;
    // exception example
    $results[] = 'x / y = ' . $client->divide($x, 0) . PHP_EOL;
    
} catch (SoapFault $sf) {
    
    $results[] = $sf->getMessage() . PHP_EOL;
    
}

display_results($results);
