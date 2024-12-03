<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Valobs\Exceptions\InvalidDimensionsException;
use BaseCodeOy\Valobs\Values\CubicMeter;

it('can create from meters', function (): void {
    $cubicMeter = CubicMeter::createFromMeter(10, 10, 10);

    expect($cubicMeter->getVolume())->toEqual(1_000.0);
    expect($cubicMeter->getLength())->toEqual(10.0);
    expect($cubicMeter->getWidth())->toEqual(10.0);
    expect($cubicMeter->getHeight())->toEqual(10.0);
    expect($cubicMeter->toString())->toEqual('1,000');
});

it('can create from meters as array', function (): void {
    $cubicMeter = CubicMeter::createFromMeterArray([
        'length' => 10,
        'width' => 10,
        'height' => 10,
    ]);

    expect($cubicMeter->getVolume())->toEqual(1_000.0);
    expect($cubicMeter->getLength())->toEqual(10.0);
    expect($cubicMeter->getWidth())->toEqual(10.0);
    expect($cubicMeter->getHeight())->toEqual(10.0);
    expect($cubicMeter->toString())->toEqual('1,000');
});

it('can create from decimeters', function (): void {
    $cubicMeter = CubicMeter::createFromDecimeter(100, 100, 100);

    expect($cubicMeter->getVolume())->toEqual(1_000.0);
    expect($cubicMeter->getLength())->toEqual(10.0);
    expect($cubicMeter->getWidth())->toEqual(10.0);
    expect($cubicMeter->getHeight())->toEqual(10.0);
    expect($cubicMeter->toString())->toEqual('1,000');
});

it('can create from decimeters as array', function (): void {
    $cubicMeter = CubicMeter::createFromDecimeterArray([
        'length' => 100,
        'width' => 100,
        'height' => 100,
    ]);

    expect($cubicMeter->getVolume())->toEqual(1_000.0);
    expect($cubicMeter->getLength())->toEqual(10.0);
    expect($cubicMeter->getWidth())->toEqual(10.0);
    expect($cubicMeter->getHeight())->toEqual(10.0);
    expect($cubicMeter->toString())->toEqual('1,000');
});

it('can create from centimeters', function (): void {
    $cubicMeter = CubicMeter::createFromCentimeter(1_000, 1_000, 1_000);

    expect($cubicMeter->getVolume())->toEqual(1_000.0);
    expect($cubicMeter->getLength())->toEqual(10.0);
    expect($cubicMeter->getWidth())->toEqual(10.0);
    expect($cubicMeter->getHeight())->toEqual(10.0);
    expect($cubicMeter->toString())->toEqual('1,000');
});

it('can create from centimeters as array', function (): void {
    $cubicMeter = CubicMeter::createFromCentimeterArray([
        'length' => 1_000,
        'width' => 1_000,
        'height' => 1_000,
    ]);

    expect($cubicMeter->getVolume())->toEqual(1_000.0);
    expect($cubicMeter->getLength())->toEqual(10.0);
    expect($cubicMeter->getWidth())->toEqual(10.0);
    expect($cubicMeter->getHeight())->toEqual(10.0);
    expect($cubicMeter->toString())->toEqual('1,000');
});

it('throws an exception if the length is empty', function (): void {
    CubicMeter::createFromMeter(0, 10, 10);
})->throws(InvalidDimensionsException::class);

it('throws an exception if the width is empty', function (): void {
    CubicMeter::createFromMeter(10, 0, 10);
})->throws(InvalidDimensionsException::class);

it('throws an exception if the height is empty', function (): void {
    CubicMeter::createFromMeter(10, 10, 0);
})->throws(InvalidDimensionsException::class);
