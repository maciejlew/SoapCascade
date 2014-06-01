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
 * ServiceRegister
 *
 * @author Maciej Lew <maciej.lew.1987@gmail.com>
 */
class ServiceRegister
{
    /** @var ServiceProxy **/
    protected $proxy;
    
    public function __construct(ServiceProxy $proxy = null, $service = null)
    {
        $this->proxy = $proxy;
        
        if ($service !== null) {
        
            $this->registerService($service);
        
        }
    }
    
    public function setProxy(ServiceProxy $proxy)
    {
        $this->proxy = $proxy;
    }
    
    public function registerService($service)
    {
        if ($this->proxy === null) {
            
            throw new ServiceRegisterProxyNotSetException('Service proxy not set!');
            
        }
        
        $service_reflection = new \ReflectionClass($service);
        
        $service_class_name = $service_reflection->getName();
        
        $service_methods = $service_reflection->getMethods(\ReflectionMethod::IS_STATIC);
        
        foreach ($service_methods as $service_method) {
            
            $service_method_name = $service_method->getName();
            
            $service_class_method_name = sprintf('%s::%s', $service_class_name, $service_method_name);
            
            $this->proxy->addMethod($service_method_name, $service_class_method_name);
            
        }
        
    }
    
}
