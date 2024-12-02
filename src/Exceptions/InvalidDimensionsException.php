<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Valobs\Exceptions;

final class InvalidDimensionsException extends \InvalidArgumentException
{
    public static function create(?float $length, ?float $width, ?float $height): self
    {
        return new self(
            \sprintf(
                'Invalid dimensions provided (%s X %s X %s).',
                $length ?? 'NaN',
                $width ?? 'NaN',
                $height ?? 'NaN',
            ),
        );
    }
}
