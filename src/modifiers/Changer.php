<?php
    declare(strict_types=1);

    namespace Ataccama\ContentManager\Modifiers;

    use Ataccama\ContentManager\Env\Content;
    use Ataccama\ContentManager\Env\IModifier;


    /**
     * Class Changer
     * @package Ataccama\ContentManager\Modifiers
     */
    class Changer implements IModifier
    {
        private array $in = [];

        private array $out = [];

        /**
         * Changer constructor.
         * @param array $in
         * @param array $out
         */
        public function __construct(array $in, array $out)
        {
            $this->in = $in;
            $this->out = $out;
        }

        public function getValue(): int
        {
            return $this->getPriority();
        }

        public function modify(Content $content): Content
        {
            $content->body = str_replace($this->in, $this->out, $content->body);

            return $content;
        }

        public function getPriority(): int
        {
            return IModifier::HIGHEST_PRIORITY;
        }
    }