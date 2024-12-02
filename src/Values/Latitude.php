<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Valobs\Values;

use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\Castable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;
use Symfony\Component\Intl\Exception\MissingResourceException;

final class Latitude extends Data implements \Stringable, Castable
{
    public function __construct(
        public readonly float $value,
    ) {}

    #[\Override()]
    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * @throws MissingResourceException
     */
    public static function createFromNumber(float $value): self
    {
        if ($value < -90 || $value > 90) {
            throw new \OutOfRangeException('Latitude must be between -90 and 90');
        }

        return new self($value);
    }

    #[\Override()]
    public static function dataCastUsing(...$arguments): Cast
    {
        return new class() implements Cast
        {
            public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
            {
                return Latitude::createFromNumber((float) $value);
            }
        };
    }

    public function isEqualTo(self $other): bool
    {
        return $this->toString() === $other->toString();
    }

    public function toValue(): float
    {
        return $this->value;
    }

    public function toString(): string
    {
        return (string) $this->value;
    }
}
