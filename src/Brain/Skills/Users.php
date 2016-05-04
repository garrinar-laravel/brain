<?php
namespace Garrinar\Brain\Skills;


use Garrinar\Brain\Base\BrainBase;
use Garrinar\Brain\Base\SkillBase;


class Users extends SkillBase
{
    public $model = null;
    public $brain;

    protected static $acceptLocales = [
        'ru_RU',
        'en_US',
        'ua_UK'
    ];

    public function __construct(BrainBase $brain)
    {
        $this->model = \App\User::class;
        $this->brain = $brain;
    }

    public function doAction($action)
    {

    }

}