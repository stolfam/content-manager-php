<?php
    declare(strict_types=1);

    namespace Ataccama\ContentManager\Env;

    use Ataccama\Common\Interfaces\IdentifiableByInteger;
    use Latte\Runtime\HtmlStringable;
    use Nette\SmartObject;
    use Nette\Utils\DateTime;


    /**
     * Class Content
     * @package Ataccama\ContentManager\Env
     * @property-read DateTime         $dtCreated
     * @property-read ContentVersion[] $versions
     * @property-read int              $id
     */
    class Content extends ContentDefinition implements IdentifiableByInteger, IModifiable, HtmlStringable
    {
        use SmartObject;
        use ModifiableContent;


        protected int $id;
        protected DateTime $dtCreated;

        /** @var ContentVersion[] */
        protected array $versions = [];
        private ?string $modifiedBody = null;

        /**
         * Content constructor.
         * @param int              $id
         * @param string           $name
         * @param Language         $languageId
         * @param string|null      $body
         * @param Tag[]            $tags
         * @param DateTime|null    $dtCreated
         * @param ContentVersion[] $versions
         * @throws \Exception
         */
        public function __construct(
            int $id,
            string $name,
            Language $languageId,
            ?string $body = null,
            array $tags = [],
            ?DateTime $dtCreated = null,
            array $versions = []
        ) {
            parent::__construct($name, $languageId, $body, $tags);
            $this->id = $id;

            if (empty($this->dtCreated)) {
                $this->dtCreated = DateTime::from('now');
            } else {
                $this->dtCreated = $dtCreated;
            }

            if (isset($versions) && is_array($versions)) {
                foreach ($versions as $version) {
                    if ($version instanceof ContentVersion) {
                        $this->versions[] = $version;
                    }
                }
            }
        }

        /**
         * @return DateTime
         */
        public function getDtCreated(): DateTime
        {
            return $this->dtCreated;
        }

        /**
         * @return ContentVersion[]
         */
        public function getVersions(): array
        {
            return $this->versions;
        }

        function __toString(): string
        {
            $modifiedBody = $this->modify($this)->body;
            if ($modifiedBody === $this->modifiedBody) {
                return $modifiedBody;
            }

            $this->modifiedBody = $modifiedBody;

            return $modifiedBody ?? "";
        }

        public function cleanVersions(): void
        {
            $this->versions = [];
        }

        public function getId(): int
        {
            return $this->id;
        }
    }