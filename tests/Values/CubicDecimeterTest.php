<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Valobs\Exceptions\InvalidDimensionsException;
use BaseCodeOy\Valobs\Values\CubicDecimeter;

it('can create from meters', function (): void {
    $currency = CubicDecimeter::createFromMeter(1, 1, 1);

    expect($currency->getVolume())->toEqual(1_000.0);
    expect($currency->getLength())->toEqual(10.0);
    expect($currency->getWidth())->toEqual(10.0);
    expect($currency->getHeight())->toEqual(10.0);
    expect($currency->toString())->toEqual('1,000');
});

it('can create from meters as array', function (): void {
    $currency = CubicDecimeter::createFromMeterArray([
        'length' => 1,
        'width' => 1,
        'height' => 1,
    ]);

    expect($currency->getVolume())->toEqual(1_000.0);
    expect($currency->getLength())->toEqual(10.0);
    expect($currency->getWidth())->toEqual(10.0);
    expect($currency->getHeight())->toEqual(10.0);
    expect($currency->toString())->toEqual('1,000');
});

it('can create from decimeters', function (): void {
    $currency = CubicDecimeter::createFromDecimeter(10, 10, 10);

    expect($currency->getVolume())->toEqual(1_000.0);
    expect($currency->getLength())->toEqual(10.0);
    expect($currency->getWidth())->toEqual(10.0);
    expect($currency->getHeight())->toEqual(10.0);
    expect($currency->toString())->toEqual('1,000');
});

it('can create from decimeters as array', function (): void {
    $currency = CubicDecimeter::createFromDecimeterArray([
        'length' => 10,
        'width' => 10,
        'height' => 10,
    ]);

    expect($currency->getVolume())->toEqual(1_000.0);
    expect($currency->getLength())->toEqual(10.0);
    expect($currency->getWidth())->toEqual(10.0);
    expect($currency->getHeight())->toEqual(10.0);
    expect($currency->toString())->toEqual('1,000');
});

it('can create from centimeters', function (): void {
    $currency = CubicDecimeter::createFromCentimeter(100, 100, 100);

    expect($currency->getVolume())->toEqual(1_000.0);
    expect($currency->getLength())->toEqual(10.0);
    expect($currency->getWidth())->toEqual(10.0);
    expect($currency->getHeight())->toEqual(10.0);
    expect($currency->toString())->toEqual('1,000');
});

it('can create from centimeters as array', function (): void {
    $currency = CubicDecimeter::createFromCentimeterArray([
        'length' => 100,
        'width' => 100,
        'height' => 100,
    ]);

    expect($currency->getVolume())->toEqual(1_000.0);
    expect($currency->getLength())->toEqual(10.0);
    expect($currency->getWidth())->toEqual(10.0);
    expect($currency->getHeight())->toEqual(10.0);
    expect($currency->toString())->toEqual('1,000');
});

it('throws an exception if the length is empty', function (): void {
    CubicDecimeter::createFromMeter(0, 100, 100);
})->throws(InvalidDimensionsException::class);

it('throws an exception if the width is empty', function (): void {
    CubicDecimeter::createFromMeter(100, 0, 100);
})->throws(InvalidDimensionsException::class);

it('throws an exception if the height is empty', function (): void {
    CubicDecimeter::createFromMeter(100, 100, 0);
})->throws(InvalidDimensionsException::class);
