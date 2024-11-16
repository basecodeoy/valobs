<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Valobs\Values\ShippingMethodIdentifier;

it('can parse carrier and service', function (): void {
    $value = ShippingMethodIdentifier::createFromString('FedEx.Express');

    expect($value->getCarrier())->toBe('FedEx');
    expect($value->getService())->toBe('Express');
});

it('fails to parse service identifier without a carrier', function (): void {
    ShippingMethodIdentifier::createFromString('.MissingCarrier');
})->throws(InvalidArgumentException::class);

it('fails to parse service identifier without a service', function (): void {
    ShippingMethodIdentifier::createFromString('OnlyCarrier.');
})->throws(InvalidArgumentException::class);
