<?php
    declare(strict_types=1);

    namespace Ataccama\ContentManager\Env;

    use Ataccama\Common\Utils\Comparator\Comparator;
    use Ataccama\Common\Utils\Comparator\Sorter;


    /**
     * Trait ModifiableContent
     * @package Ataccama\ContentManager\Env
     */
    trait ModifiableContent
    {
        /** @var IModifier[] */
        private array $modifiers = [];
        private array $modifications = [];

        public function addModifier(IModifier $modifier): void
        {
            // adding the modifier
            $this->modifiers[] = $modifier;

            // sorting by priority
            Sorter::sort($this->modifiers, new Comparator(), Sorter::DESC);
        }

        /**
         * @param Content $content
         * @return Content
         */
        protected function modify(Content $content): Content
        {
            foreach ($this->modifiers as $modifier) {
                if (!$this->isApplied($content, $modifier)) {
                    $content = $modifier->modify($content);
                    $this->modifications[$content->id][get_class($modifier)] = true;
                }
            }

            return $content;
        }

        /**
         * @param Content   $content
         * @param IModifier $modifier
         * @return bool
         */
        protected function isApplied(Content $content, IModifier $modifier): bool
        {
            return isset($this->modifications[$content->id][get_class($modifier)]);
        }
    }