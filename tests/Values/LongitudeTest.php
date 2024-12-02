<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Valobs\Values\Longitude;

it('creates from valid longitude', function (): void {
    $validLongitude = 90.0;
    $longitude = Longitude::createFromNumber($validLongitude);

    expect($longitude->toString())->toEqual($validLongitude);
});

it('throws exception for longitude too low', function (): void {
    $tooLowLongitude = -181.0;
    Longitude::createFromNumber($tooLowLongitude);
})->throws(OutOfRangeException::class);

it('throws exception for longitude too high', function (): void {
    $tooHighLongitude = 181.0;
    Longitude::createFromNumber($tooHighLongitude);
})->throws(OutOfRangeException::class);

it('returns correct string representation', function (): void {
    $validLongitude = 90.0;
    $longitude = Longitude::createFromNumber($validLongitude);

    expect($longitude->toString())->toEqual((string) $validLongitude);
});

it('returns correct string when casted to string', function (): void {
    $validLongitude = 90.0;
    $longitude = Longitude::createFromNumber($validLongitude);

    expect((string) $longitude)->toEqual((string) $validLongitude);
});
