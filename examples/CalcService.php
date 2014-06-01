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

/**
 * DivideByZeroException
 * 
 * @author Maciej Lew <maciej.lew.1987@gmail.com>
 */
class DivideByZeroException extends \Exception
{

    public function __construct($message = null, $code = null, $previous = null)
    {
        if ($message === null) {
            $message = 'Divide by zero exception!';
        }
        parent::__construct($message, $code, $previous);
    }

}

/**
 * CalcService
 * 
 * Some basic calc service methods.
 *
 * @author Maciej Lew <maciej.lew.1987@gmail.com>
 */
class CalcService
{
    /**
     * Calculates the sum of the arguments
     * 
     * @param number $x
     * @param number $y
     * @return number
     */
    public static function add($x, $y)
    {
        return $x + $y;
    }
    
    /**
     * Calculates the difference of the arguments
     * 
     * @param number $x
     * @param number $y
     * @return number
     */
    public static function diff($x, $y)
    {
        return $x - $y;
    }
    
    /**
     * Calculates the product of the arguments
     * 
     * @param number $x
     * @param number $y
     * @return number
     */
    public static function multiply($x, $y)
    {
        return $x * $y;
    }
    
    /**
     * Calculates the quotient of the arguments
     * 
     * @param number $x Nominator
     * @param number $y Denominator
     * @return number
     * @throws \DivideByZeroException Throw exception when denominator is zero
     */
    public static function divide($x, $y)
    {
        if ($y == 0) {
            
            throw new \DivideByZeroException();
            
        }
        
        return $x / $y;
    }
}



