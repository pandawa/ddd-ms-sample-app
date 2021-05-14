<?php

declare(strict_types=1);

namespace Acme\Inventory\Infrastructure;

use Pandawa\Arjuna\Provider\ArjunaProviderTrait;
use Pandawa\Component\Module\AbstractModule;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class AcmeInventoryInfrastructureModule extends AbstractModule
{
    use ArjunaProviderTrait;
}
