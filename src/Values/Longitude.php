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

final class Longitude extends Data implements \Stringable, Castable
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
        if ($value < -180 || $value > 180) {
            throw new \OutOfRangeException('Longitude must be between -180 and 180');
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
                return Longitude::createFromNumber((float) $value);
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
