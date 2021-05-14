<?php

declare(strict_types=1);

namespace Acme\Product;

use Acme\Product\Domain\AcmeProductDomainModule;
use Acme\Product\Infrastructure\AcmeProductInfrastructureModule;
use Pandawa\Component\Module\AbstractModule;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class AcmeProductModule extends AbstractModule
{
    protected function init(): void
    {
        $this->app->register(AcmeProductDomainModule::class);
        $this->app->register(AcmeProductInfrastructureModule::class);
    }
}
