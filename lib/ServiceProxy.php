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

namespace SoapCascade;

/**
 * ServiceProxy
 *
 * @author Maciej Lew <maciej.lew.1987@gmail.com>
 */
class ServiceProxy
{
    private $methods = array();

    public function addMethod($name, $callback)
    {
        if(is_callable($callback)) {
            
            $this->methods[$name] = $callback;
            
            return true;
            
        }
        
        return false;
    }      

    public function __call($name, $args)
    {
        try {
            
            return call_user_func_array($this->methods[$name], $args);
            
        } catch (\Exception $ex) {
            
            throw new \SoapFault('SERVER', 'Application Error: ' . $ex->getMessage());
            
        }
    }
}