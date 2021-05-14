<?php

declare(strict_types=1);

namespace Acme\Product\Domain;

use Acme\Product\Domain\Event\ProductCreated;
use Acme\Product\Domain\Event\ProductDeleted;
use Acme\Product\Domain\Event\ProductUpdated;
use Acme\Product\Domain\Listener\SynchronizeProduct;
use Pandawa\Component\Module\AbstractModule;
use Pandawa\Component\Module\Provider\EventProviderTrait;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class AcmeProductDomainShareModule extends AbstractModule
{
    use EventProviderTrait;

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
            __DIR__.'/Resources/database/migrations/2021_04_22_150241_create_products_table.php' => database_path('migrations/2021_04_22_150241_create_products_table.php'),
        ], ['acme-product', 'acme']);
    }

    protected function listens(): array
    {
        return [
            ProductCreated::class => [
                [SynchronizeProduct::class, 'create']
            ],
            ProductUpdated::class => [
                [SynchronizeProduct::class, 'update']
            ],
            ProductDeleted::class => [
                [SynchronizeProduct::class, 'delete']
            ],
        ];
    }
}
