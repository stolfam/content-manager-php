<?php
    declare(strict_types=1);

    namespace Ataccama\ContentManager\Env;

    use Ataccama\Common\Interfaces\IdentifiableByInteger;
    use Nette\SmartObject;
    use Nette\Utils\DateTime;


    /**
     * Class ContentVersion
     * @package Ataccama\ContentManager\Env
     * @property-read int         $id
     * @property-read DateTime    $dtCreated
     * @property-read string      $content
     * @property-read string|null $author
     */
    class ContentVersion implements IdentifiableByInteger
    {
        use SmartObject;


        protected int $id;
        protected string $content;
        protected DateTime $dtCreated;
        protected ?string $author;

        /**
         * ContentVersion constructor.
         * @param int         $id
         * @param string      $content
         * @param DateTime    $dtCreated
         * @param string|null $author
         */
        public function __construct(int $id, string $content, DateTime $dtCreated, ?string $author = null)
        {
            $this->id = $id;
            $this->content = $content;
            $this->dtCreated = $dtCreated;
            $this->author = $author;
        }

        /**
         * @return DateTime
         */
        public function getDtCreated(): DateTime
        {
            return $this->dtCreated;
        }

        /**
         * @return string
         */
        public function getContent(): string
        {
            return $this->content;
        }

        /**
         * @return string|null
         */
        public function getAuthor(): ?string
        {
            return $this->author;
        }

        public function getId(): int
        {
            return $this->id;
        }
    }