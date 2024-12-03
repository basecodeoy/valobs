<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Valobs\Values;

use Spatie\LaravelData\Data;

final class Coordinate extends Data implements \Stringable
{
    public function __construct(
        public readonly Latitude $latitude,
        public readonly Longitude $longitude,
    ) {}

    #[\Override()]
    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * @throws \OutOfRangeException
     */
    public static function createFromNumber(float $latitude, float $longitude): self
    {
        return new self(
            Latitude::createFromNumber($latitude),
            Longitude::createFromNumber($longitude),
        );
    }

    public function getLatitude(): Latitude
    {
        return $this->latitude;
    }

    public function getLongitude(): Longitude
    {
        return $this->longitude;
    }

    public function isEqualTo(self $other): bool
    {
        return $this->toString() === $other->toString();
    }

    public function toString(): string
    {
        return \sprintf('%s,%s', $this->latitude, $this->longitude);
    }
}
