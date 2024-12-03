<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Valobs\Values\UUID;
use Ramsey\Uuid\Uuid as RamseyUuid;

it('creates from valid uuid string', function (): void {
    $uuidString = RamseyUuid::uuid4()->toString();
    $uuid = UUID::createFromString($uuidString);

    expect($uuid->toString())->toEqual($uuidString);
});

it('throws exception for invalid uuid string', function (): void {
    UUID::createFromString('invalid-uuid-string');
})->throws(InvalidArgumentException::class);

it('returns correct string representation', function (): void {
    $uuidString = RamseyUuid::uuid4()->toString();
    $uuid = UUID::createFromString($uuidString);

    expect($uuid->toString())->toEqual($uuidString);
});

it('returns correct string when casted to string', function (): void {
    $uuidString = RamseyUuid::uuid4()->toString();
    $uuid = UUID::createFromString($uuidString);

    expect((string) $uuid)->toEqual($uuidString);
});
