<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Valobs\Values;

use Illuminate\Support\Str;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\Castable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

final class ShippingMethodIdentifier extends Data implements \Stringable, Castable
{
    public function __construct(
        public readonly string $source,
        public readonly string $carrier,
        public readonly ?string $service,
    ) {}

    #[\Override()]
    public function __toString(): string
    {
        return $this->toString();
    }

    public static function createFromString(string|self $value): self
    {
        if ($value instanceof self) {
            $value = $value->getSource();
        }

        $carrier = Str::before($value, '.') ?: null;

        if ($carrier === null) {
            throw new \InvalidArgumentException('Invalid service identifier: '.$value);
        }

        $service = Str::after($value, '.') ?: null;

        if ($service === null) {
            throw new \InvalidArgumentException('Invalid service identifier: '.$value);
        }

        return new self($value, $carrier, $service);
    }

    #[\Override()]
    public static function dataCastUsing(...$arguments): Cast
    {
        return new class() implements Cast
        {
            public function cast(DataProperty $dataProperty, mixed $value, array $properties, CreationContext $creationContext): mixed
            {
                return ShippingMethodIdentifier::createFromString((string) $value);
            }
        };
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getCarrier(): string
    {
        return $this->carrier;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    public function isEqualTo(self $other): bool
    {
        return $this->toString() === $other->toString();
    }

    public function toString(): string
    {
        return \sprintf('%s.%s', $this->carrier, $this->service);
    }
}
