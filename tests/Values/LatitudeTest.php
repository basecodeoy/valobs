<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Valobs\Values\Latitude;

it('creates from valid latitude', function (): void {
    $validLatitude = 45.0;
    $latitude = Latitude::createFromNumber($validLatitude);

    expect($latitude->toString())->toEqual($validLatitude);
});

it('throws exception for latitude too low', function (): void {
    $tooLowLatitude = -91.0;
    Latitude::createFromNumber($tooLowLatitude);
})->throws(OutOfRangeException::class);

it('throws exception for latitude too high', function (): void {
    $tooHighLatitude = 91.0;
    Latitude::createFromNumber($tooHighLatitude);
})->throws(OutOfRangeException::class);

it('returns correct string representation', function (): void {
    $validLatitude = 45.0;
    $latitude = Latitude::createFromNumber($validLatitude);

    expect($latitude->toString())->toEqual((string) $validLatitude);
});

it('returns correct string when casted to string', function (): void {
    $validLatitude = 45.0;
    $latitude = Latitude::createFromNumber($validLatitude);

    expect((string) $latitude)->toEqual((string) $validLatitude);
});
