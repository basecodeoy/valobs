<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Valobs\Values;

use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\Castable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

final class Email extends Data implements \Stringable, Castable
{
    public function __construct(
        #[\Spatie\LaravelData\Attributes\Validation\Email()]
        public readonly string $email,
    ) {}

    #[\Override()]
    public function __toString(): string
    {
        return $this->email;
    }

    public static function createFromString(string $email): self
    {
        return self::validateAndCreate(['email' => $email]);
    }

    #[\Override()]
    public static function dataCastUsing(...$arguments): Cast
    {
        return new class() implements Cast
        {
            public function cast(DataProperty $dataProperty, mixed $value, array $properties, CreationContext $creationContext): mixed
            {
                return Email::createFromString((string) $value);
            }
        };
    }

    public function isEqualTo(self $other): bool
    {
        return $this->email === $other->toString();
    }

    public function toString(): string
    {
        return $this->email;
    }
}
