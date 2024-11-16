<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Valobs\Values;

use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid as Ramsey;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\Castable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

final class UUID extends Data implements \Stringable, Castable
{
    public function __construct(
        public readonly string $value,
    ) {}

    #[\Override()]
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @throws InvalidUuidStringException
     */
    public static function createFromString(string $value): self
    {
        return new self(Ramsey::fromString($value)->toString());
    }

    #[\Override()]
    public static function dataCastUsing(...$arguments): Cast
    {
        return new class() implements Cast
        {
            public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
            {
                return UUID::createFromString((string) $value);
            }
        };
    }

    public function isEqualTo(self $other): bool
    {
        return $this->value === $other->toString();
    }

    public function toString(): string
    {
        return $this->value;
    }
}
