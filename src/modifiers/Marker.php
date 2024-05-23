<?php
    declare(strict_types=1);

    namespace Ataccama\ContentManager\Modifiers;

    use Ataccama\ContentManager\Env\Content;
    use Ataccama\ContentManager\Env\IModifier;


    /**
     * Class Marker
     * @package Ataccama\ContentManager\Modifiers
     */
    class Marker implements IModifier
    {
        /** @var string */
        private string $term;

        /** @var string */
        private string $classes;

        /**
         * Marker constructor.
         * @param string $term
         * @param string $classes
         */
        public function __construct(string $term, string $classes = "text-pink")
        {
            $this->term = $term;
            $this->classes = $classes;
        }

        /**
         * Returns modified content.
         *
         * @param Content $content
         * @return Content
         */
        public function modify(Content $content): Content
        {
            $content->body = str_replace($this->term, "<span class='$this->classes'>$this->term</span>",
                $content->body);

            return $content;
        }

        public function getPriority(): int
        {
            return IModifier::LOWEST_PRIORITY;
        }

        public function getValue(): int
        {
            return $this->getPriority();
        }
    }