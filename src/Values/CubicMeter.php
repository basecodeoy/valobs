<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Valobs\Values;

use BaseCodeOy\Valobs\Exceptions\InvalidDimensionsException;
use Illuminate\Support\Number;
use Spatie\LaravelData\Data;

final class CubicMeter extends Data implements \Stringable
{
    public function __construct(
        public readonly float $volume,
        public readonly float $length,
        public readonly float $width,
        public readonly float $height,
        public readonly int $decimals,
    ) {}

    #[\Override()]
    public function __toString(): string
    {
        return $this->toString();
    }

    public static function createFromMeter(float $length, float $width, float $height, ?int $decimals = null): self
    {
        if (empty($width) || empty($height) || empty($length)) {
            throw InvalidDimensionsException::create($length, $width, $height);
        }

        return new self($length * $width * $height, $length, $width, $height, $decimals ?? 0);
    }

    public static function createFromMeterArray(array $dimensions, ?int $decimals = null): self
    {
        return self::createFromMeter($dimensions['length'], $dimensions['width'], $dimensions['height'], $decimals);
    }

    public static function createFromDecimeter(float $length, float $width, float $height, ?int $decimals = null): self
    {
        $length /= 10;
        $width /= 10;
        $height /= 10;

        return self::createFromMeter($length, $width, $height, $decimals ?? 0);
    }

    public static function createFromDecimeterArray(array $dimensions, ?int $decimals = null): self
    {
        return self::createFromDecimeter($dimensions['length'], $dimensions['width'], $dimensions['height'], $decimals);
    }

    public static function createFromCentimeter(float $length, float $width, float $height, ?int $decimals = null): self
    {
        return self::createFromMeter($length / 100, $width / 100, $height / 100, $decimals);
    }

    public static function createFromCentimeterArray(array $dimensions, ?int $decimals = null): self
    {
        return self::createFromCentimeter($dimensions['length'], $dimensions['width'], $dimensions['height'], $decimals);
    }

    public function getVolume(): float
    {
        return $this->volume;
    }

    public function getLength(): float
    {
        return $this->length;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function isEqualTo(self $other): bool
    {
        return $this->toString() === $other->toString();
    }

    public function toString(): string
    {
        return (string) Number::format($this->volume, $this->decimals);
    }
}
