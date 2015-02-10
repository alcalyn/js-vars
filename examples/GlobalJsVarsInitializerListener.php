<?php

/**
 * @author Julien Maulny
 * @license MIT
 * @link https://github.com/alcalyn/js-vars
 */
namespace Acme\AppBundle\Listener;

use Alcalyn\JsVars\JsVars;

/**
 * Listen to kernel.controller event to declare global variables in templates.
 *
 * @author Julien Maulny
 * @license MIT
 * @link https://github.com/alcalyn/js-vars
 */
class GlobalJsVarsInitializerListener
{
    /**
     * @var JsVars
     */
    private $jsVars;

    /**
     * @param JsVars $jsVars
     */
    public function __construct(JsVars $jsVars)
    {
        $this->jsVars = $jsVars;
    }

    /**
     * Initialize global javascript variables here
     */
    public function onKernelController()
    {
        $this->jsVars->config = array(
            'websocket' => array(
                'host' => '127.0.0.1',
                'port' => '25069',
            ),
            'debug' => true,
        );
        
        $this->jsVars
            ->trans('home.page')
            ->trans('articles')
            ->trans('about')
            ->trans('help')
        ;
    }
}
