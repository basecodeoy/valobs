<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Valobs\Values\Email;
use Illuminate\Validation\ValidationException;

it('creates from valid email', function (): void {
    $validEmail = 'test@example.com';
    $email = Email::createFromString($validEmail);

    expect($email->toString())->toEqual($validEmail);
});

it('throws exception for invalid email', function (): void {
    $invalidEmail = 'not-an-email';
    Email::createFromString($invalidEmail);
})->throws(ValidationException::class);

it('returns correct string representation', function (): void {
    $validEmail = 'test@example.com';
    $email = Email::createFromString($validEmail);

    expect($email->toString())->toEqual($validEmail);
});
