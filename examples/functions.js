/**
 * Variables
 */
var JsVars = jQuery('#js-vars').data('variables');

// Example
var config = JsVars.config;


/**
 * Translations
 */
var JsTranslations = jQuery('#js-vars').data('translations');

function t(key) {
    if (JsTranslations[key]) {
        return JsTranslations[key];
    } else {
        if (console && JsVars.debug) {
            console.warn('Translation not found: '+key);
        }

        return key;
    }
}

// Example
t('home.page');


/**
 * Router
 */
Router = {
    routes: jQuery('#js-vars').data('routes'),

    generateUrl: function (name)
    {
        if (Router.routes[name]) {
            return Router.routes[name];
        } else if (console && JsVars.debug) {
            console.warn('Route '+name+' not passed to JsVars');
        }

        return '#';
    }
};

// Example
Router.generateUrl('acme_user_profile');
