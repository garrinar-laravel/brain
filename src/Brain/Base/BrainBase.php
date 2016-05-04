<?php
/**
 * Created by PhpStorm.
 * User: Garrinar
 * Date: 03.05.2016
 * Time: 23:03
 */

namespace Garrinar\Brain\Base;


use Faker;
use Garrinar\Brain\Interfaces\SkillInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BrainBase
{
    protected $defaultLocale = 'en_US';
    protected $knownLocales = [];
    protected $brain;
    public $skills;


    public function __construct(Collection $skills)
    {
        $this->skills = new \stdClass();
        $this->brain = Faker\Factory::create($this->defaultLocale);
        $this->knownLocales = collect([$this->defaultLocale]);
        $this->learnSkills($skills);
    }

    public function setDefaultLocale($locale)
    {
        $this->defaultLocale = $locale;
    }

    public function changeLocale($locale)
    {
        if ($this->knownLocales->contains($locale)) {
            $this->defaultLocale = $locale;
        }
    }

    public function getKnownLocales()
    {
        return $this->knownLocales->all();
    }

    public function addLocale($locale)
    {
        $this->knownLocales->push($locale);
    }

    public function learnSkills($skills)
    {
        collect($skills)->each(function ($skill) {
            /** @var SkillInterface $skill */
            return $this->learnSkill($skill::compile($this));
        });
    }

    public function learnSkill(SkillBase $skill)
    {
        $skill->learn($this);
        return true;
    }

    public function getKnownKeys(Collection $keys)
    {
        return $keys->map(function (&$item) {
            try {
                $item = [$item => $this->brain->$item];
            } catch (\InvalidArgumentException $e) {
                $item = [$item => false];
            }
            return $item;
        });
    }

    public function think($key)
    {
        try {
            return $this->brain->$key;
        } catch (\InvalidArgumentException $e) {
            return null;
        }
    }
    
    public function fillModel(Model $model) {
        $filled = new Collection();
        foreach ($model->getFillable() as $item) {
            try {
                $filled->put($item, $this->think($item));
            } catch (\InvalidArgumentException $e) {

            }

        }
        return $model->fill($filled->toArray());
    }
}