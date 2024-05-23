<?php
    declare(strict_types=1);

    namespace Ataccama\ContentManager\Env;

    use Ataccama\Common\Env\IPair;
    use Ataccama\Common\Env\Pair;
    use Ataccama\Common\Interfaces\IdentifiableByInteger;
    use Nette\SmartObject;


    /**
     * Class Language
     * @package Ataccama\ContentManager\Env
     * @property-read int         $id
     * @property-read string      $isoCode
     * @property-read string|null $name
     * @property-read string|null $nativeName
     * @property-read bool        $active
     */
    class Language implements IdentifiableByInteger, IPair
    {
        use SmartObject;


        protected int $id;
        private static int $defaultLanguageId = 1;
        private static string $defaultIsoCode = "en";
        private static Language $current;

        /**
         * @var string
         * ISO 639-1 Code
         */
        protected string $isoCode;

        /** @var string|null */
        protected ?string $name = null;

        /** @var string|null */
        protected ?string $nativeName = null;

        /** @var bool */
        protected bool $active = true;

        /**
         * Language constructor.
         * @param int         $id
         * @param string      $isoCode
         * @param bool        $active
         * @param string|null $name
         * @param string|null $nativeName
         */
        public function __construct(
            int $id,
            string $isoCode,
            bool $active = true,
            ?string $name = null,
            ?string $nativeName = null
        ) {
            $this->id = $id;
            $this->isoCode = $isoCode;
            $this->active = $active;
            $this->name = $name;
            $this->nativeName = $nativeName;
        }

        /**
         * @return Language
         */
        public static function default(): Language
        {
            return new Language(self::$defaultLanguageId, self::$defaultIsoCode);
        }

        /**
         * @param int    $languageId
         * @param string $isoCode
         * @return Language
         */
        public static function setDefaultLanguage(int $languageId, string $isoCode): Language
        {
            self::$defaultLanguageId = $languageId;
            self::$defaultIsoCode = $isoCode;

            return self::default();
        }

        /**
         * @return string
         */
        public function getIsoCode(): string
        {
            return $this->isoCode;
        }

        /**
         * @return Language
         */
        public static function current(): Language
        {
            if (!isset(self::$current)) {
                self::$current = self::default();
            }

            return self::$current;
        }

        /**
         * @param Language $current
         */
        public static function set(Language $current): void
        {
            self::$current = $current;
        }

        /**
         * @return Pair
         *
         * @deprecated
         */
        public function toPair(): Pair
        {
            return new Pair($this->id, $this->isoCode);
        }

        public function getKey(): int
        {
            return $this->id;
        }

        public function getValue(): string
        {
            return $this->isoCode;
        }

        /**
         * @return string|null
         */
        public function getName(): ?string
        {
            return $this->name;
        }

        /**
         * @return string|null
         */
        public function getNativeName(): ?string
        {
            return $this->nativeName;
        }

        /**
         * @return bool
         */
        public function isActive(): bool
        {
            return $this->active;
        }

        public function getId(): int
        {
            return $this->id;
        }
    }