<?php
    require __DIR__ . "/../bootstrap.php";

    use Tester\Assert;


    $language = new \Ataccama\ContentManager\Env\Language(5, 'cs');

    Assert::same(5, $language->id);
    Assert::same('cs', $language->isoCode);

    \Ataccama\ContentManager\Env\Language::setDefaultLanguage(8, "sk");

    $defaultLanguage = \Ataccama\ContentManager\Env\Language::default();

    Assert::same(\Ataccama\ContentManager\Env\Language::default()->id, $defaultLanguage->id);
    Assert::same(\Ataccama\ContentManager\Env\Language::default()->isoCode, $defaultLanguage->isoCode);

    $currentLanguage = new \Ataccama\ContentManager\Env\Language(10, "de");

    Assert::same(\Ataccama\ContentManager\Env\Language::current()->id, $defaultLanguage->id);
    Assert::same(\Ataccama\ContentManager\Env\Language::current()->isoCode, $defaultLanguage->isoCode);

    \Ataccama\ContentManager\Env\Language::set($currentLanguage);

    Assert::same(\Ataccama\ContentManager\Env\Language::current()->id, $currentLanguage->id);
    Assert::same(\Ataccama\ContentManager\Env\Language::current()->isoCode, $currentLanguage->isoCode);