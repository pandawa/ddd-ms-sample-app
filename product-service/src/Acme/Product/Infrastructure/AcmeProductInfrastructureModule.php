<?php

declare(strict_types=1);

namespace Acme\Product\Infrastructure;

use Pandawa\Arjuna\Provider\ArjunaProviderTrait;
use Pandawa\Component\Module\AbstractModule;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class AcmeProductInfrastructureModule extends AbstractModule
{
    use ArjunaProviderTrait;
}
