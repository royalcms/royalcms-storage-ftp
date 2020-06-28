<?php

namespace Royalcms\Component\Storage\Ftp;

use Illuminate\Contracts\Support\DeferrableProvider;
use Royalcms\Component\Storage\StorageServiceProvider;
use Royalcms\Component\Support\ServiceProvider;

class StorageFtpServiceProvider extends ServiceProvider implements DeferrableProvider
{
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        /**
         * Create an instance of the Ftpext driver.
         *
         * @param  array  $config
         * @return \Royalcms\Component\Contracts\Filesystem\Filesystem
         */
        $this->royalcms['storage']->extend('ftpext', function ($royalcms, array $config) {
            return $royalcms['storage']->adapt(
                $royalcms['storage']->createFilesystem(
                    new Ftpext($config),
                    $config
                )
            );
        });

        /**
         * Create an instance of the Ftpsockets oss driver.
         *
         * @param  array  $config
         * @return \Royalcms\Component\Contracts\Filesystem\Filesystem
         */
        $this->royalcms['storage']->extend('ftpsockets', function ($royalcms, array $config) {
            return $royalcms['storage']->adapt(
                $royalcms['storage']->createFilesystem(
                    new Ftpsockets($config),
                    $config
                )
            );
        });

	}

    /**
     * Get the events that trigger this service provider to register.
     *
     * @return array
     */
    public function when()
    {
        return [StorageServiceProvider::class];
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

}
