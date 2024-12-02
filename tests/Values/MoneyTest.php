<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Valobs\Values\Money;
use Symfony\Component\Intl\Exception\MissingResourceException;

it('creates from valid amount and currency code string', function (): void {
    expect(Money::createFromMajor(100, 'USD')->toString())->toEqual('USD 100.00');
    expect(Money::createFromMajor(100.00, 'USD')->toString())->toEqual('USD 100.00');
    expect(Money::createFromMajor('100', 'USD')->toString())->toEqual('USD 100.00');
});

it('creates from valid minor amount and currency code string', function (): void {
    expect(Money::createFromMinor(100, 'USD')->toString())->toEqual('USD 1.00');
    expect(Money::createFromMinor(100.00, 'USD')->toString())->toEqual('USD 1.00');
    expect(Money::createFromMinor('100', 'USD')->toString())->toEqual('USD 1.00');
});

it('formats from valid amount and currency code string', function (): void {
    expect(Money::createFromMajor(100, 'USD')->format('en_US'))->toEqual('$100.00');
    expect(Money::createFromMajor(100.00, 'USD')->format('en_US'))->toEqual('$100.00');
    expect(Money::createFromMajor('100', 'USD')->format('en_US'))->toEqual('$100.00');
});

it('formats from valid minor amount and currency code string', function (): void {
    expect(Money::createFromMinor(100, 'USD')->format('en_US'))->toEqual('$1.00');
    expect(Money::createFromMinor(100.00, 'USD')->format('en_US'))->toEqual('$1.00');
    expect(Money::createFromMinor('100', 'USD')->format('en_US'))->toEqual('$1.00');
});

it('throws exception for invalid currency code string', function (): void {
    Money::createFromMajor(100, 'XXX');
})->throws(MissingResourceException::class);

it('can perform a plus operation', function (): void {
    $a = Money::createFromMajor(100, 'USD');
    $b = Money::createFromMajor(100, 'USD');

    expect($a->plus($b)->toString())->toEqual('USD 200.00');
});

it('can perform a minus operation', function (): void {
    $a = Money::createFromMajor(200, 'USD');
    $b = Money::createFromMajor(100, 'USD');

    expect($a->minus($b)->toString())->toEqual('USD 100.00');
});

it('can perform a multiplied by operation', function (): void {
    $a = Money::createFromMajor(100, 'USD');

    expect($a->multipliedBy(2)->toString())->toEqual('USD 200.00');
});

it('can perform a divided by operation', function (): void {
    $a = Money::createFromMajor(200, 'USD');

    expect($a->dividedBy(2)->toString())->toEqual('USD 100.00');
});

it('checks if value is zero', function (): void {
    $zero = Money::createFromMajor(0, 'USD');
    $nonZero = Money::createFromMajor(100, 'USD');

    expect($zero->isZero())->toBeTrue();
    expect($nonZero->isZero())->toBeFalse();
});

it('checks if value is positive', function (): void {
    $positive = Money::createFromMajor(100, 'USD');
    $negative = Money::createFromMajor(-100, 'USD');

    expect($positive->isPositive())->toBeTrue();
    expect($negative->isPositive())->toBeFalse();
});

it('checks if value is negative', function (): void {
    $negative = Money::createFromMajor(-100, 'USD');
    $positive = Money::createFromMajor(100, 'USD');

    expect($negative->isNegative())->toBeTrue();
    expect($positive->isNegative())->toBeFalse();
});

it('checks if value is less than other', function (): void {
    $value = Money::createFromMajor(50, 'USD');
    $other = Money::createFromMajor(100, 'USD');

    expect($value->isLessThan($other))->toBeTrue();
    expect($other->isLessThan($value))->toBeFalse();
});

it('checks if value is less than or equal to other', function (): void {
    $value = Money::createFromMajor(50, 'USD');
    $other = Money::createFromMajor(50, 'USD');
    $greater = Money::createFromMajor(100, 'USD');

    expect($value->isLessThanOrEqualTo($other))->toBeTrue();
    expect($greater->isLessThanOrEqualTo($value))->toBeFalse();
});

it('checks if value is greater than other', function (): void {
    $value = Money::createFromMajor(100, 'USD');
    $other = Money::createFromMajor(50, 'USD');

    expect($value->isGreaterThan($other))->toBeTrue();
    expect($other->isGreaterThan($value))->toBeFalse();
});

it('checks if value is greater than or equal to other', function (): void {
    $value = Money::createFromMajor(100, 'USD');
    $other = Money::createFromMajor(100, 'USD');
    $lesser = Money::createFromMajor(50, 'USD');

    expect($value->isGreaterThanOrEqualTo($other))->toBeTrue();
    expect($lesser->isGreaterThanOrEqualTo($value))->toBeFalse();
});
