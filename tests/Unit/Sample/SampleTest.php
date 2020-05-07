<?php

namespace Tests\Unit\Sample;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Sample;

class SampleTest extends TestCase
{
 use RefreshDatabase;
 /**
  * A basic test example.
  *
  * @return void
  */
 public function test_add()
 {
  $sample = new Sample;
  $sum = $sample->add(5, 3);
  $this->assertEquals(8, $sum);
 }

 public function test_sub()
 {
  $sample = new Sample;
  $sub = $sample->sub(5, 3);
  $this->assertEquals(2, $sub);
 }
}
