<?php

declare(strict_types=1);

/*
 * eduVPN - End-user friendly VPN.
 *
 * Copyright: 2016-2021, The Commons Conservancy eduVPN Programme
 * SPDX-License-Identifier: AGPL-3.0+
 */

namespace LC\Portal\Tests\Http;

use LC\Portal\Http\Response;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class ResponseTest extends TestCase
{
    public function testImport(): void
    {
        $response = Response::import(
            [
                'statusCode' => 200,
                'responseHeaders' => ['Content-Type' => 'application/json', 'X-Foo' => 'Bar'],
                'responseBody' => '{"a": "b"}',
            ]
        );

        static::assertSame(200, $response->getStatusCode());
        static::assertSame(
            [
                'Content-Type' => 'application/json',
                'X-Foo' => 'Bar',
            ],
            $response->getHeaders()
        );
        static::assertSame('{"a": "b"}', $response->getBody());
    }
}