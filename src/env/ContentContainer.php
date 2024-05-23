<?php
    declare(strict_types=1);

    namespace Ataccama\ContentManager\Env;

    use Ataccama\Common\Env\BaseArray;
    use Ataccama\ContentManager\Exceptions\ContentNotFound;


    /**
     * Class ContentContainer
     * @package Ataccama\ContentManager\Env
     */
    class ContentContainer extends BaseArray implements IModifiable
    {
        use ModifiableContent;


        /**
         * @return Content
         */
        public function current(): Content
        {
            $content = parent::current();
            if ($content instanceof Content) {
                foreach ($this->modifiers as $modifier) {
                    $content->addModifier($modifier);
                }
            }

            return $content;
        }

        /**
         * Returns a part of the content with specific
         *
         * @param string $name
         * @return Content
         * @throws ContentNotFound
         */
        public function __get(string $name): Content
        {
            if (isset($this->items[$name])) {
                return $this->modify($this->items[$name]);
            }

            throw new ContentNotFound("Content '$name' not found.");
        }

        /**
         * @param string $name
         * @return Content
         * @throws ContentNotFound
         */
        public function get($name): Content
        {
            if (isset($this->items[$name])) {
                return $this->items[$name];
            }
            throw new ContentNotFound("Content '$name' not found.");
        }

        /**
         * @param Content $content
         */
        public function add($content): self
        {
            $this->items[$content->name] = $content;

            return $this;
        }

        /**
         * @param $name
         * @return bool
         */
        public function __isset($name): bool
        {
            return isset($this->items[$name]);
        }
    }