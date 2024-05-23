<?php

    require __DIR__ . "/../bootstrap.php";

    use Tester\Assert;


    $filter = new \Ataccama\ContentManager\Env\ContentFilter([
        \Ataccama\ContentManager\Env\ContentFilter::LANGUAGE    => new \Ataccama\ContentManager\Env\Language(1, "eng"),
        \Ataccama\ContentManager\Env\ContentFilter::TAGS        => ['tag1', 'tag2'],
        \Ataccama\ContentManager\Env\ContentFilter::PAGE        => new \Ataccama\Common\Env\Prototypes\IntegerId(5),
        \Ataccama\ContentManager\Env\ContentFilter::SEARCH_TERM => "term",
        \Ataccama\ContentManager\Env\ContentFilter::ALIASES     => ['default', 'foo']
    ]);

    Assert::same(1, $filter->language->id);
    Assert::same("eng", $filter->language->isoCode);
    Assert::same('tag1', $filter->tags[0]);
    Assert::same(5, $filter->page->id);
    Assert::same("term", $filter->term);
    Assert::same('foo', $filter->aliases[1]);