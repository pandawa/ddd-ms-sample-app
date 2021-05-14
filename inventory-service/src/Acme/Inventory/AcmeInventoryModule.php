<?php

declare(strict_types=1);

namespace Acme\Inventory;

use Acme\Inventory\Application\AcmeInventoryApplicationModule;
use Acme\Inventory\Domain\AcmeInventoryDomainModule;
use Acme\Inventory\Infrastructure\AcmeInventoryInfrastructureModule;
use Pandawa\Component\Module\AbstractModule;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class AcmeInventoryModule extends AbstractModule
{
    protected $subModules = [
        AcmeInventoryDomainModule::class,
        AcmeInventoryInfrastructureModule::class,
        AcmeInventoryApplicationModule::class,
    ];
}
