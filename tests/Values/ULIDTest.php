<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Valobs\Values\ULID;
use Symfony\Component\Uid\Ulid as Symfony;

it('creates from valid ulid string', function (): void {
    $validUlid = Symfony::generate();
    $ulid = ULID::createFromString($validUlid);

    expect($ulid->toString())->toEqual($validUlid);
});

it('throws exception for invalid ulid string', function (): void {
    $invalidUlid = 'invalid-ulid';

    ULID::createFromString($invalidUlid);
})->throws(InvalidArgumentException::class);

it('returns correct string representation', function (): void {
    $validUlid = Symfony::generate();
    $ulid = ULID::createFromString($validUlid);

    expect($ulid->toString())->toEqual($validUlid);
});
