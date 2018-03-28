<?php
/**
 * Created by PhpStorm.
 * User: timgrob
 * Date: 3/26/18
 * Time: 7:32 PM
 */

namespace AppBundle\Parser;


interface ParserInterface
{
    public function load($data);
    public function execute();
}