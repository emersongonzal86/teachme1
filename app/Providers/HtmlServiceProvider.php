<?php

namespace TeachMe\Providers;


use Collective\Html\HtmlServiceProvider as ColectiveHtmlServiceProvider;
use TeachMe\Components\HtmlBuilder;

class HtmlServiceProvider extends ColectiveHtmlServiceProvider
{
    /**
     * Register the HTML builder instance.
     *
     * @return void
     */
    protected function registerHtmlBuilder()
    {
        $this->app->bindShared('html', function($app)
        {
            return new HtmlBuilder($app['config'],$app['view'],$app['url']);
        });
    }
}