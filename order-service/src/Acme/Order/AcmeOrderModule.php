<?php

declare(strict_types=1);

namespace Acme\Order;

use Acme\Order\Application\AcmeOrderApplicationModule;
use Acme\Order\Domain\AcmeOrderDomainModule;
use Acme\Order\Infrastructure\AcmeOrderInfrastructureModule;
use Pandawa\Component\Module\AbstractModule;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class AcmeOrderModule extends AbstractModule
{
    protected $subModules = [
        AcmeOrderDomainModule::class,
        AcmeOrderApplicationModule::class,
        AcmeOrderInfrastructureModule::class,
    ];
}
