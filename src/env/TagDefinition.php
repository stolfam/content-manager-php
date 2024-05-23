<?php
    declare(strict_types=1);

    namespace Ataccama\ContentManager\Env;

    /**
     * Class TagDefinition
     * @package Ataccama\ContentManager\Env
     */
    class TagDefinition
    {
        public string $name;

        /**
         * TagDefinition constructor.
         * @param string $name
         */
        public function __construct(string $name)
        {
            $this->name = $name;
        }
    }