<?php
/**
 * Created by PhpStorm.
 * User: Garrinar
 * Date: 03.05.2016
 * Time: 22:42
 */

namespace Garrinar\Brain;


use Garrinar\Brain\Base\BrainBase;
use Garrinar\Brain\Skills\Users;

class Brain extends BrainBase
{

    protected $defaultLocale = 'ru_RU';
    protected $knownLocales = ['en_US'];
    

    public function __construct()
    {
        return parent::__construct(collect(Users::class));
    }
}