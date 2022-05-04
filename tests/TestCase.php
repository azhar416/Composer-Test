<?php

namespace azhar\helloworld\Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        # Set-up tambahan seperti inisialisasi Model.

        // code here
        $this->artisan('migrate', [
            '--database' => 'testbench',
            '--realpath' => realpath(__DIR__.'/../migrations'),
        ]);

        $this->withFactories(__DIR__.'/factories');
    }

    protected function getPackageProviders($app)
    {
        return [
            # CustomServiceProvider.class,
            'Acme\AcmeServiceProvider'
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Acme' => 'Acme\Facade'
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        # Implementasi setting-up environment
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function resolveApplicationConsoleKernel($app)
    {
        $app->singleton('Illuminate\Contracts\Console\Kernel', 'Acme\Testbench\Console\Kernel');
    }

    protected function resolveApplicationHttpKernel($app)
    {
        $app->singleton('Illuminate\Contracts\Http\Kernel', 'Acme\Testbench\Http\Kernel');
    }

    protected function getApplicationTimezone($app)
    {
        return 'Asia/Kuala_Lumpur';
    }
}

?>