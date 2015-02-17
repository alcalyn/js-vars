# Integration to Symfony2

Assuming you are using Twig


### Declare JsVars as service

``` yml
services:
    # Service declaration into symfony2 with translator and router
    acme.js_vars:
        class: Alcalyn\JsVars\JsVars
        calls:
            - [ enableTranslator, [ @translator ]]  # Optional, to pass translations
            - [ enableRouter, [ @router ]]          # Optional, to pass urls
```


### Add service to global template scope

``` yml
twig:
    globals:
        js_vars: "@acme.js_vars"
```


### Export variables to your layout template

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


### If you want to create global variables

i.e visible in all templates, you should create a listener that listen to `kernel.controller`

See this example: [GlobalJsVarsInitializerListener](../examples/GlobalJsVarsInitializerListener.php)


## Using PHP template

You should create an helper, this article seems to be good:

[Symfony: PHP Templating Engine and Global Variables](https://tobymackenzie.wordpress.com/2012/04/26/symfony-php-templating-engine-and-global-variables/)
