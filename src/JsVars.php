<?php

/**
 * @author Julien Maulny
 * @license MIT
 * @link https://github.com/alcalyn/js-vars
 */
namespace Alcalyn\JsVars;

use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Routing\RouterInterface;
use Alcalyn\JsVars\Exception\JsVarsException;

/**
 * Contains variables, translations and routes.
 * Declare this class as a service and pass variables to javascript.
 *
 * @author Julien Maulny
 * @license MIT
 * @link https://github.com/alcalyn/js-vars
 */
class JsVars
{
    /**
     * @var array
     */
    private $variables;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var array
     */
    private $translations;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var array
     */
    private $routes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translator = null;
        $this->router = null;
        $this->variables = array();
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        return $this->variables[$key];
    }

    /**
     * @param string $key
     * @param mixed $value
     *
     * @return JsVars
     */
    public function __set($key, $value)
    {
        $this->variables[$key] = $value;

        return $this;
    }

    /**
     * @param string $key
     *
     * @return boolean
     */
    public function __isset($key)
    {
        return isset($this->variables[$key]);
    }

    /**
     * @param string $key
     */
    public function __unset($key)
    {
        unset($this->variables[$key]);
    }

    /**
     * @return array
     */
    public function getVariables()
    {
        return $this->variables;
    }

    /**
     * Enable translator so it can pass translated strings to js
     *
     * @param TranslatorInterface $translator
     *
     * @return JsVars
     */
    public function enableTranslator(TranslatorInterface $translator)
    {
        $this->translator = $translator;
        $this->translations = array();
        $this->_locale = $translator->getLocale();

        return $this;
    }

    /**
     * Provide a translated string to js
     *
     * @param string $key
     *
     * @return JsVars
     *
     * @throws JsVarsException if translator is not enabled
     */
    public function trans($key)
    {
        if (null === $this->translator) {
            throw new JsVarsException('Translator must be enabled to use trans()');
        }

        $this->translations[$key] = $this->translator->trans(/** @Ignore */ $key);

        return $this;
    }

    /**
     * @return array
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * Enable router so it can pass url to js
     *
     * @param RouterInterface $router
     *
     * @return JsVars
     */
    public function enableRouter(RouterInterface $router)
    {
        $this->router = $router;
        $this->routes = array();

        return $this;
    }

    /**
     * Provide an url to js
     *
     * @param string $name the name of the route
     *
     * @return JsVars
     *
     * @throws JsVarsException if router is not enabled
     */
    public function addRoute($name)
    {
        if (null === $this->router) {
            throw new JsVarsException('Router must be enabled to use addRoute()');
        }

        $this->routes[$name] = $this->router->generate($name);

        return $this;
    }

    /**
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }
}
