<?php
    declare(strict_types=1);

    namespace Ataccama\ContentManager\Env;

    use Ataccama\Common\Utils\Comparator\Comparable;


    /**
     * Interface IModifier
     * @package Ataccama\ContentManager\Env
     */
    interface IModifier extends Comparable
    {
        const LOWEST_PRIORITY = 0;
        const HIGHEST_PRIORITY = 1000;

        /**
         * Modifies content.
         *
         * @param Content $content
         * @return Content
         */
        public function modify(Content $content): Content;

        /**
         * Returns a priority of this modified.
         * I recommend: 1 = Highest priority, 10 = Normal, 100 = Low
         *
         * @return int
         */
        public function getPriority(): int;
    }