<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Valobs\Values\Coordinate;

it('creates from valid coordinates', function (): void {
    $latitude = 45.0;
    $longitude = 90.0;

    $coordinates = Coordinate::createFromNumber($latitude, $longitude);

    expect($coordinates->toString())->toEqual('45,90');
});

it('throws exception for invalid latitude', function (): void {
    $invalidLatitude = 100.0;
    $validLongitude = 90.0;

    Coordinate::createFromNumber($invalidLatitude, $validLongitude);
})->throws(OutOfRangeException::class);

it('throws exception for invalid longitude', function (): void {
    $validLatitude = 45.0;
    $invalidLongitude = 200.0;

    Coordinate::createFromNumber($validLatitude, $invalidLongitude);
})->throws(OutOfRangeException::class);
