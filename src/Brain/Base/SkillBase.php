<?php
/**
 * Created by PhpStorm.
 * User: Garrinar
 * Date: 03.05.2016
 * Time: 23:20
 */

namespace Garrinar\Brain\Base;


use Garrinar\Brain\Interfaces\SkillInterface;

abstract class SkillBase implements SkillInterface
{
    protected static $acceptLocales;

    public static function compile(BrainBase $brain)
    {
        return new static($brain);
    }

    public static function acceptLocale($locale)
    {
        return in_array($locale, static::$acceptLocales);
    }

    public function learn(BrainBase $brain)
    {
        $name = static::class;
        $brain->skills->$name = $this;
    }

    public function forget()
    {
        // TODO: Implement forget() method.
    }


}