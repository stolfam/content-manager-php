<?php
    require __DIR__ . "/../bootstrap.php";

    use Tester\Assert;


    $content = new \Ataccama\ContentManager\Env\Content(1, "default",
        new \Ataccama\ContentManager\Env\Language(1, "eng"), "Test content", [], null, [
            new \Ataccama\ContentManager\Env\ContentVersion(123, "original", \Nette\Utils\DateTime::from("2000-01-01"))
        ]);

    Assert::same("Test content", $content->body);
    Assert::same(1, $content->id);
    Assert::same(1, $content->language->id);
    Assert::same('eng', $content->language->isoCode);

    $content->tags[] = new \Ataccama\ContentManager\Env\Tag(3, "Three");

    $content->addModifier(new \Ataccama\ContentManager\Modifiers\Changer(['Test'], ['New']));

    $contentContainer = new \Ataccama\ContentManager\Env\ContentContainer();
    $contentContainer->add($content);

    Assert::same("Test content", $contentContainer->default->body); // not modified
    Assert::same("New content", "$contentContainer->default"); // modified
    Assert::same("New content", $contentContainer->default->body); // stays modified

    Assert::same("Three", $contentContainer->default->tags[0]->name);

    $content2 = new \Ataccama\ContentManager\Env\Content(2, "foo", new \Ataccama\ContentManager\Env\Language(2, "cs"),
        "Old content");

    $contentContainer->add($content2);

    $contentContainer->addModifier(new \Ataccama\ContentManager\Modifiers\Changer(['Test', 'content'],
        ['New', 'nothing']));

    Assert::same("New nothing", "$contentContainer->default");
    Assert::same("Old nothing", "$contentContainer->foo");

    Assert::count(2, $contentContainer);

    Assert::same("2000", $content->versions[0]->dtCreated->format("Y"));
    Assert::same("original", $content->versions[0]->content);
    Assert::same(123, $content->versions[0]->id);

    Assert::same('default', $contentContainer->get('default')->name);

    Assert::same(true, isset($contentContainer->default));