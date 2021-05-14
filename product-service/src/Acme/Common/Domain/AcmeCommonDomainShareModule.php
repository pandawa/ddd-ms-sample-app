<?php

declare(strict_types=1);

namespace Acme\Common\Domain;

use Pandawa\Component\Module\AbstractModule;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class AcmeCommonDomainShareModule extends AbstractModule
{
    protected function build(): void
    {
        $this->configurePublishing();
    }

    protected function configurePublishing(): void
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/Resources/database/migrations/2021_04_25_113740_create_categories_table.php' => database_path('migrations/2021_04_25_113740_create_categories_table.php'),
        ], ['acme-common', 'acme']);
    }
}
