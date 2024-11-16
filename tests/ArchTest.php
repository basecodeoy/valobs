<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

arch('globals')
    ->expect(['dd', 'dump'])
    ->not->toBeUsed();

// arch('BaseCodeOy\Valobs\Values')
//     ->expect('BaseCodeOy\Valobs\Values')
//     ->toUseStrictTypes()
//     ->toBeFinal()
//     ->ignoring('BaseCodeOy\Valobs\Values\Algorithms')
//     ->ignoring('BaseCodeOy\Valobs\Values\Exceptions');

// arch('BaseCodeOy\Valobs\Values\Algorithms')
//     ->expect('BaseCodeOy\Valobs\Values\Algorithms')
//     ->toUseStrictTypes()
//     ->toBeFinal()
//     ->toBeReadonly();

// arch('BaseCodeOy\Valobs\Values\Exceptions')
//     ->expect('BaseCodeOy\Valobs\Values\Exceptions')
//     ->toUseStrictTypes()
//     ->toBeFinal()
//     ->toHaveSuffix('Exception')
//     ->toExtend('InvalidArgumentException');
