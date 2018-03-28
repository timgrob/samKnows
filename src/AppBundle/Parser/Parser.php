<?php
/**
 * Created by PhpStorm.
 * User: timgrob
 * Date: 3/26/18
 * Time: 7:35 PM
 */

namespace AppBundle\Parser;


abstract class Parser implements ParserInterface
{
    protected $dataObject;

    public function load($dataObject)
    {
        $this->dataObject = $dataObject;
    }

    public function execute()
    {
    }

}
