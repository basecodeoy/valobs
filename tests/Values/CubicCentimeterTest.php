<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Valobs\Exceptions\InvalidDimensionsException;
use BaseCodeOy\Valobs\Values\CubicCentimeter;

it('can create from meters', function (): void {
    $cubicCentimeter = CubicCentimeter::createFromMeter(1, 1, 1);

    expect($cubicCentimeter->getVolume())->toEqual(1_000_000.0);
    expect($cubicCentimeter->getLength())->toEqual(100.0);
    expect($cubicCentimeter->getWidth())->toEqual(100.0);
    expect($cubicCentimeter->getHeight())->toEqual(100.0);
    expect($cubicCentimeter->toString())->toEqual('1,000,000');
});

it('can create from meters as array', function (): void {
    $cubicCentimeter = CubicCentimeter::createFromMeterArray([
        'length' => 1,
        'width' => 1,
        'height' => 1,
    ]);

    expect($cubicCentimeter->getVolume())->toEqual(1_000_000.0);
    expect($cubicCentimeter->getLength())->toEqual(100.0);
    expect($cubicCentimeter->getWidth())->toEqual(100.0);
    expect($cubicCentimeter->getHeight())->toEqual(100.0);
    expect($cubicCentimeter->toString())->toEqual('1,000,000');
});

it('can create from decimeters', function (): void {
    $cubicCentimeter = CubicCentimeter::createFromDecimeter(10, 10, 10);

    expect($cubicCentimeter->getVolume())->toEqual(1_000_000.0);
    expect($cubicCentimeter->getLength())->toEqual(100.0);
    expect($cubicCentimeter->getWidth())->toEqual(100.0);
    expect($cubicCentimeter->getHeight())->toEqual(100.0);
    expect($cubicCentimeter->toString())->toEqual('1,000,000');
});

it('can create from decimeters as array', function (): void {
    $cubicCentimeter = CubicCentimeter::createFromDecimeterArray([
        'length' => 10,
        'width' => 10,
        'height' => 10,
    ]);

    expect($cubicCentimeter->getVolume())->toEqual(1_000_000.0);
    expect($cubicCentimeter->getLength())->toEqual(100.0);
    expect($cubicCentimeter->getWidth())->toEqual(100.0);
    expect($cubicCentimeter->getHeight())->toEqual(100.0);
    expect($cubicCentimeter->toString())->toEqual('1,000,000');
});

it('can create from centimeters', function (): void {
    $cubicCentimeter = CubicCentimeter::createFromCentimeter(100, 100, 100);

    expect($cubicCentimeter->getVolume())->toEqual(1_000_000.0);
    expect($cubicCentimeter->getLength())->toEqual(100.0);
    expect($cubicCentimeter->getWidth())->toEqual(100.0);
    expect($cubicCentimeter->getHeight())->toEqual(100.0);
    expect($cubicCentimeter->toString())->toEqual('1,000,000');
});

it('can create from centimeters as array', function (): void {
    $cubicCentimeter = CubicCentimeter::createFromCentimeterArray([
        'length' => 100,
        'width' => 100,
        'height' => 100,
    ]);

    expect($cubicCentimeter->getVolume())->toEqual(1_000_000.0);
    expect($cubicCentimeter->getLength())->toEqual(100.0);
    expect($cubicCentimeter->getWidth())->toEqual(100.0);
    expect($cubicCentimeter->getHeight())->toEqual(100.0);
    expect($cubicCentimeter->toString())->toEqual('1,000,000');
});

it('throws an exception if the length is empty', function (): void {
    CubicCentimeter::createFromMeter(0, 10, 10);
})->throws(InvalidDimensionsException::class);

it('throws an exception if the width is empty', function (): void {
    CubicCentimeter::createFromMeter(10, 0, 10);
})->throws(InvalidDimensionsException::class);

it('throws an exception if the height is empty', function (): void {
    CubicCentimeter::createFromMeter(10, 10, 0);
})->throws(InvalidDimensionsException::class);
