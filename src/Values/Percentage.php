<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Valobs\Values;

use Illuminate\Support\Number;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\Castable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

final class Percentage extends Data implements \Stringable, Castable
{
    public function __construct(
        public readonly float $number,
        public readonly int $precision,
        public readonly ?int $maxPrecision,
        public readonly ?string $locale,
    ) {}

    #[\Override()]
    public function __toString(): string
    {
        return $this->toString();
    }

    public static function createFromNumber(
        float $number,
        int $precision = 0,
        ?int $maxPrecision = null,
        ?string $locale = null,
    ): self {
        return new self($number, $precision, $maxPrecision, $locale);
    }

    #[\Override()]
    public static function dataCastUsing(...$arguments): Cast
    {
        return new class() implements Cast
        {
            public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
            {
                return Percentage::createFromNumber((float) $value);
            }
        };
    }

    public function getNumber(): float
    {
        return $this->number;
    }

    public function isEqualTo(self $other): bool
    {
        return $this->toString() === $other->toString();
    }

    public function toString(): string
    {
        return (string) Number::percentage($this->number, $this->precision, $this->maxPrecision, $this->locale);
    }
}
