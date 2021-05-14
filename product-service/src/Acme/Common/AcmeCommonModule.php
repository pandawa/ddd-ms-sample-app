<?php

declare(strict_types=1);

namespace Acme\Common;

use Acme\Common\Domain\AcmeCommonDomainModule;
use Pandawa\Component\Module\AbstractModule;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class AcmeCommonModule extends AbstractModule
{
    protected $subModules = [
        AcmeCommonDomainModule::class,
    ];
}
