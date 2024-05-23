<?php
    declare(strict_types=1);

    namespace Ataccama\ContentManager\Env;

    /**
     * Interface IModifiable
     * @package Ataccama\ContentManager\Env
     */
    interface IModifiable
    {
        public function addModifier(IModifier $modifier): void;
    }