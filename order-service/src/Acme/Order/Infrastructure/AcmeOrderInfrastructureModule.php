<?php

declare(strict_types=1);

namespace Acme\Order\Infrastructure;

use Pandawa\Arjuna\Provider\ArjunaProviderTrait;
use Pandawa\Component\Module\AbstractModule;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class AcmeOrderInfrastructureModule extends AbstractModule
{
    use ArjunaProviderTrait;
}
