<?php
    declare(strict_types=1);

    namespace Ataccama\ContentManager\Env;

    use Ataccama\Common\Utils\Cache\IKey;


    /**
     * Class ContentKey
     * @package Ataccama\ContentManager\Env
     */
    class ContentKey implements IKey
    {
        private int $id;
        private int $languageId;

        /**
         * ContentKey constructor.
         * @param int $contentId
         * @param int $languageId
         */
        public function __construct(int $contentId, int $languageId)
        {
            $this->id = $contentId;
            $this->languageId = $languageId;
        }

        public function getPrefix(): ?string
        {
            return $this->languageId . "_content";
        }

        public function getId(): string
        {
            return (string) $this->id;
        }
    }