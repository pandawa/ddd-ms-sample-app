<?php

declare(strict_types=1);

namespace Acme\Api;

use Pandawa\Arjuna\Event\MessageExceptionOccurred;
use Pandawa\Component\Module\AbstractModule;
use Pandawa\Component\Module\Provider\EventProviderTrait;
use Pandawa\Component\Module\Provider\RouteProviderTrait;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
final class AcmeApiModule extends AbstractModule
{
    use RouteProviderTrait, EventProviderTrait;

    protected function build(): void
    {
        $this->app['events']->listen(MessageExceptionOccurred::class, function (MessageExceptionOccurred $event) {
            logger('erro coi!!');
        });
    }

    protected function routes(): array
    {
        return [
            [
                'type'       => 'group',
                'middleware' => 'api',
                'prefix'     => 'api/v{version}',
                'children'   => $this->getCurrentPath().'/Resources/routes/routes.yaml',
            ],
        ];
    }

    protected function listens(): array
    {
        return [];
    }
}
