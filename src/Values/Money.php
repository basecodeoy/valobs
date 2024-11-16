<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Valobs\Values;

use BaseCodeOy\Internationalization\Values\CurrencyCode;
use Brick\Math\Exception\MathException;
use Brick\Math\Exception\NumberFormatException;
use Brick\Math\Exception\RoundingNecessaryException;
use Brick\Money\Exception\MoneyMismatchException;
use Brick\Money\Exception\UnknownCurrencyException;
use Brick\Money\Money as Brick;
use Spatie\LaravelData\Data;

/**
 * @see https://martinfowler.com/eaaCatalog/money.html
 */
final class Money extends Data implements \Stringable
{
    public function __construct(
        private readonly Brick $value,
        private readonly CurrencyCode $currency,
    ) {}

    #[\Override()]
    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * @throws NumberFormatException
     * @throws RoundingNecessaryException
     * @throws UnknownCurrencyException
     */
    public static function createFromMajor(int|float|string $value, string $currencyCode): self
    {
        $currencyCode = CurrencyCode::createFromString($currencyCode);

        return new self(
            // TODO: we should deprecate this and only use fromMinor because it's more accurate
            Brick::of($value, $currencyCode->toString()),
            $currencyCode,
        );
    }

    /**
     * @throws NumberFormatException
     * @throws RoundingNecessaryException
     * @throws UnknownCurrencyException
     */
    public static function createFromMinor(int|float|string $value, string $currencyCode): self
    {
        $currencyCode = CurrencyCode::createFromString($currencyCode);

        return new self(
            Brick::ofMinor($value, $currencyCode->toString()),
            $currencyCode,
        );
    }

    /**
     * @throws NumberFormatException
     * @throws RoundingNecessaryException
     * @throws UnknownCurrencyException
     */
    public static function tryFrom(int|float|string $value, string $currencyCode): self
    {
        try {
            return self::createFromMajor($value, $currencyCode);
        } catch (RoundingNecessaryException) {
            return self::createFromMinor($value, $currencyCode);
        }
    }

    /**
     * @throws MathException
     * @throws MoneyMismatchException
     */
    public function plus(self $other): self
    {
        return new self(
            $this->value->plus($other->toValue()),
            $this->currency,
        );
    }

    /**
     * @throws MathException
     * @throws MoneyMismatchException
     */
    public function minus(self $other): self
    {
        return new self(
            $this->value->minus($other->toValue()),
            $this->currency,
        );
    }

    /**
     * @throws MathException
     * @throws MoneyMismatchException
     */
    public function multipliedBy(int|float|string $multiplier): self
    {
        return new self(
            $this->value->multipliedBy($multiplier),
            $this->currency,
        );
    }

    /**
     * @throws MathException
     * @throws MoneyMismatchException
     */
    public function dividedBy(int|float|string $divisor): self
    {
        return new self(
            $this->value->dividedBy($divisor),
            $this->currency,
        );
    }

    public function isZero(): bool
    {
        return $this->value->isZero();
    }

    public function isPositive(): bool
    {
        return $this->value->isPositive();
    }

    public function isNegative(): bool
    {
        return $this->value->isNegative();
    }

    public function isLessThan(self $other): bool
    {
        return $this->value->isLessThan($other->toValue());
    }

    public function isLessThanOrEqualTo(self $other): bool
    {
        return $this->value->isLessThanOrEqualTo($other->toValue());
    }

    public function isGreaterThan(self $other): bool
    {
        return $this->value->isGreaterThan($other->toValue());
    }

    public function isGreaterThanOrEqualTo(self $other): bool
    {
        return $this->value->isGreaterThanOrEqualTo($other->toValue());
    }

    public function isEqualTo(self $other): bool
    {
        return $this->value->isEqualTo($other->toValue());
    }

    public function format(string $locale): string
    {
        return $this->value->formatTo($locale);
    }

    public function toValue(): string
    {
        return (string) $this->value->getAmount();
    }

    public function toString(): string
    {
        return (string) $this->value;
    }
}