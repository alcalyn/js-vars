<?php

/**
 * @author Julien Maulny
 * @license MIT
 * @link https://github.com/alcalyn/js-vars
 */
namespace Alcalyn\JsVars\Exception;

/**
 * @author Julien Maulny
 * @license MIT
 * @link https://github.com/alcalyn/js-vars
 */
class JsVarsException extends \Exception
{
    /**
     * @param string $message
     */
    public function __construct($message)
    {
        parent::__construct($message, 0, null);
    }
}
