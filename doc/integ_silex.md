# Integration to Silex

Assuming you are using Silex 1.x with Pimple


### Declare JsVars as Service

``` php
// app.php
<?php

use Alcalyn\JsVars\JsVars;

$app = new Silex\Application();

$app['acme.js_vars'] = $app->share(function () use ($app) {
    $jsVars = new JsVars();

    // Inject transator (optional)
    $jsVars->enableTranslator($app['translator']);

    // Inject url gnerator (optional)
    $jsVars->enableRouter($app['url_generator']);

    return $jsVars;
});
```


### Add JsVars in twig global variables

``` php
$app['twig']->addGlobal('js_vars', $app['acme.js_vars']);
```


### Insert variables into views

Here using Twig

``` twig
<div
    id="js-vars"
    data-variables="{{ js_vars.variables|json_encode|raw|replace('"', '\"') }}"
    {% if js_vars.translatorEnabled %}
        data-translations="{{ js_vars.translations|json_encode|raw|replace('"', '\"') }}"
    {% endif %}
    {% if js_vars.routerEnabled %}
        data-routes="{{ js_vars.routes|json_encode|raw|replace('"', '\"') }}"
    {% endif %}
></div>
```


### Declare a variable to pass to view

``` php
$app['acme.js_vars']->myGlobalVar = 'My global value';
```


### Declare a global variable to pass to all views

``` php
$app->before(function () use ($app) {
    $app['acme.js_vars']->debug = $app['debug'];
});
```


### Retrieve variable from Javascript

Here using jQuery

``` js
// Load all variables
var JsVars = $('#js-vars').data('variables');

JsVars.debug; // true or false
JsVars.myGlobalVar; // 'My global value'
```
