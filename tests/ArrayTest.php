<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use sagittaracc\ArrayHelper;

final class ArrayTest extends TestCase
{
    public function testArrays(): void
    {
        $this->assertEquals(ArrayHelper::slice_by_keys([
            'e1' => 'v1',
            'e2' => 'v2',
            'e3' => 'v3',
        ], ['e1', 'e3']), [
            'e1' => 'v1',
            'e3' => 'v3',
        ]);

        $this->assertTrue(ArrayHelper::isSequential([1, 2, 3]));
        $this->assertFalse(ArrayHelper::isSequential(['foo' => 'bar']));

        $this->assertEquals(ArrayHelper::rename_keys([
            'old_key1' => 1,
            'old_key2' => 2,
            'old_key3' => 3,
        ], [
            'new_key1', 'new_key2', 'new_key3'
        ]), [
            'new_key1' => 1,
            'new_key2' => 2,
            'new_key3' => 3,
        ]);

        $this->assertNull(ArrayHelper::rename_keys([
            'old_key1' => 1,
            'old_key2' => 2,
            'old_key3' => 3,
        ], [
            'new_key1', 'new_key2', 'new_key3', 'new_key4'
        ]));

        $this->assertEquals(ArrayHelper::index('id', [
            ['id' => 1, 'text' => 'foo'],
            ['id' => 2, 'text' => 'bar'],
        ]), [
            1 => [
                'id' => 1,
                'text' => 'foo'
            ],
            2 => [
                'id' => 2,
                'text' => 'bar'
            ],
        ]);

        $this->assertEquals(ArrayHelper::index(['id', 'text'], [
            ['id' => 1, 'text' => 'foo'],
            ['id' => 2, 'text' => 'bar'],
        ]), [
            1 => [
                'foo' => [
                    'id' => 1,
                    'text' => 'foo',
                ],
            ],
            2 => [
                'bar' => [
                    'id' => 2,
                    'text' => 'bar',
                ],
            ],
        ]);

        $this->assertEquals(ArrayHelper::group('text', [
            ['id' => 1, 'text' => 'foo'],
            ['id' => 2, 'text' => 'bar'],
            ['id' => 3, 'text' => 'bar'],
        ]), [
            'foo' => [
                ['id' => 1, 'text' => 'foo']
            ],
            'bar' => [
                ['id' => 2, 'text' => 'bar'],
                ['id' => 3, 'text' => 'bar'],
            ],
        ]);

        $this->assertEquals(ArrayHelper::group(['text', 'data'], [
            ['id' => 1, 'text' => 'foo', 'data' => 'input'],
            ['id' => 2, 'text' => 'bar', 'data' => 'output'],
            ['id' => 3, 'text' => 'bar', 'data' => 'output'],
        ]), [
            'foo' => [
                'input' => [
                    ['id' => 1, 'text' => 'foo', 'data' => 'input'],
                ]
            ],
            'bar' => [
                'output' => [
                    ['id' => 2, 'text' => 'bar', 'data' => 'output'],
                    ['id' => 3, 'text' => 'bar', 'data' => 'output'],
                ]
            ],
        ]);
    }

    public function testGetValue(): void
    {
        $this->assertEquals(
            ['foo' => 'bar'],
            ArrayHelper::getValue(['foo' => 'bar'])
        );

        $this->assertEquals(
            ['bar', 'boo'],
            ArrayHelper::getValue(['foo' => ['bar', 'boo']], 'foo')
        );
    }
}
