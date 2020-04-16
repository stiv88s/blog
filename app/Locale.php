<?php


namespace App;


use http\Env\Request;
use Illuminate\Support\Facades\Session;

class Locale
{
    /**
     * Cached copy of the configured supported locales
     *
     * @var string
     */
    protected static $configuredSupportedLocales = [];

    /**
     * Our instance of the Laravel app
     *
     * @var Illuminate\Foundation\Application
     */
    protected $app = '';


    /**
     * Make a new Locale instance
     *
     * @param Illuminate\Foundation\Application $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }


    /**
     * Retrieve the currently set locale
     *
     * @return string
     */
    public function current()
    {
        return $this->app->getLocale();
    }


    /**
     * Retrieve the configured fallback locale
     *
     * @return string
     */
    public function fallback()
    {
        return $this->app->make('config')['app.fallback_locale'];
    }


    /**
     * Set the current locale
     *
     * @param string $locale
     */
    public function set($locale)
    {
        $this->app->setLocale($locale);
    }


    /**
     * Retrieve the current locale's directionality
     *
     * @return string
     */
    public function dir()
    {
        return $this->getConfiguredSupportedLocales()[$this->current()]['dir'];
    }

    /**
     * Retrieve the name of the current locale in the app's
     * default language
     *
     * @return string
     */
    public function nameFor($locale)
    {
        return $this->getConfiguredSupportedLocales()[$locale]['name'];
    }


    /**
     * Retrieve all of our app's supported locale language keys
     *
     * @return array
     */
    public function supported()
    {
        return array_keys($this->getConfiguredSupportedLocales());
    }


    /**
     * Determine whether a locale is supported by our app
     * or not
     *
     * @return boolean
     */
    public function isSupported($locale)
    {
        return in_array($locale, $this->supported());
    }


    /**
     * Retrieve our app's supported locale's from configuration
     *
     * @return array
     */
    protected function getConfiguredSupportedLocales()
    {
        // cache the array for future calls
        if (empty(static::$configuredSupportedLocales)) {
            static::$configuredSupportedLocales = $this->app->make('config')['app.supported_locales'];
        }

        return static::$configuredSupportedLocales;
    }

    public static function getUrlSegment($segment)
    {

        if(Session::has('locale')){
            $locale = Session('locale');
            return $locale;
        }else{
            if (in_array($segment, array_keys(config('app.supported_locales')))) {
                $locale = Session(['locale'=>$segment]);
                return $segment;
            } else {
                return config('app.fallback_locale');
            }
        }
    }

}
