<?php
/**
 * Created by PhpStorm.
 * User: Garrinar
 * Date: 03.05.2016
 * Time: 23:33
 */

namespace Garrinar\Brain\Interfaces;


use Garrinar\Brain\Base\BrainBase;

interface SkillInterface
{
    public static function compile(BrainBase $brain);

    public static function acceptLocale($locale);
    
}