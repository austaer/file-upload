<?php

namespace Libraries\MediaConvert\Facades;

use Illuminate\Support\Facades\Facade;
use Libraries\MediaConvert\Convertor as ConvertorInstance;

class Convertor extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ConvertorInstance::class;
    }
}