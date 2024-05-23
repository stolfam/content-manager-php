<?php
    declare(strict_types=1);

    namespace Ataccama\ContentManager\Env;

    use Ataccama\Common\Utils\Cache\IKey;


    /**
     * Class ContentContainerKey
     * @package Ataccama\ContentManager\Env
     */
    class ContentContainerKey implements IKey
    {
        private string $id;

        /**
         * @param string $id
         */
        public function __construct(string $id)
        {
            $this->id = $id;
        }

        public function getId(): string
        {
            return $this->id;
        }

        public function getPrefix(): ?string
        {
            return "contentContainer";
        }
    }