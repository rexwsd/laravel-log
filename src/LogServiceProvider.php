<?php

namespace Laravel\Log;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Laravel\Log\Monolog\LogManager;

class LogServiceProvider extends ServiceProvider
{
    /**
     * 服务提供者加是否延迟加载.
     *
     * @var bool
     */
    protected $defer = true; // 延迟加载服务
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath($raw = __DIR__.'/config/logging.php') ?: $raw;

        if ($this->app instanceof LaravelApplication) {
            $this->publishes([$source => config_path('logging.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('logging');
        }

        $this->mergeConfigFrom($source, 'logging');
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // 单例绑定服务
        $this->app->singleton('Psr\Log\LoggerInterface', function () {
            return new LogManager($this->app);
        });
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        // 因为延迟加载 所以要定义 provides 函数 具体参考laravel 文档
        return ['Psr\Log\LoggerInterface'];
    }
}
