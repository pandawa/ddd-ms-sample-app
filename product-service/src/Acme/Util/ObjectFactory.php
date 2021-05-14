<?php

declare(strict_types=1);

namespace Acme\Util;

use ReflectionClass;
use ReflectionParameter;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
final class ObjectFactory
{
    private function __construct(private ReflectionClass $class)
    {
    }

    public static function create(string $class): self
    {
        return new self(new ReflectionClass($class));
    }

    public function from(object $object): mixed
    {
        $data = [];

        foreach ($this->getArguments() as $key) {
            $data[$key] = $this->getValue($object, $key);
        }

        return $this->class->newInstanceArgs($data);
    }

    private function getValue(object $object, string $key): mixed
    {
        if (method_exists($object, $method = 'get' . ucfirst($key))) {
            return $object->{$method}();
        }

        return $object->{$key};
    }

    private function getArguments(): array
    {
        return array_map(
            fn(ReflectionParameter $parameter) => $parameter->getName(),
            $this->class->getConstructor()->getParameters()
        );
    }
}
