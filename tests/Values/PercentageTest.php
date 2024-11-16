<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Valobs\Values\Percentage;

it('can format', function (): void {
    $currency = Percentage::createFromNumber(10);

    expect($currency->toString())->toEqual('10%');
});

it('can format with precision', function (): void {
    $currency = Percentage::createFromNumber(10, 2);

    expect($currency->toString())->toEqual('10.00%');
});

it('can format with max precision', function (): void {
    $currency = Percentage::createFromNumber(10.123_456_789, 10, 5);

    expect($currency->toString())->toEqual('10.12346%');
});

it('can format with locale', function (): void {
    $currency = Percentage::createFromNumber(10, 0, null, 'fi_FI');

    expect($currency->toString())->toMatchSnapshot();
});
