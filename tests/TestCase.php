<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected $sharedTableCols = ['id', 'created_at', 'updated_at'];
    use CreatesApplication;
    function getColsWithShared($arr){
        return array_merge(
            $this->sharedTableCols,
            $arr
        );
    }
}
