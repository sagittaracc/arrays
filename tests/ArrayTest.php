<?php declare(strict_types = 1);

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

    $this->assertTrue(ArrayHelper::isSequential([1,2,3]));
    $this->assertFalse(ArrayHelper::isSequential(['foo' => 'bar']));
  }
}
