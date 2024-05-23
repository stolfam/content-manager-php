# ataccama/content-manager-php
This is a bundle of helpful PHP classes for creating and managing a multilingual content.

### Modifiers
Modifiers give you option to temporarily change the content before final rendering.
```
final class YourModifier implements IModifier {
    public function modify(Content $content): Content {
        // replace each word 'sample' for 'test'
        $content->body = str_replace('sample', 'test', $content->body);

        return $content
    }
}
```
This will make the modification above on each ``Content`` in ``ContentContainer``.

### Example
Imagine that you have one piece of content like this:
```
$content = new Content(1, 'sample', Language::default(), 'Body of sample content', ['tag1']);
```
Your repository (implements interface ``IContentRepository``) has to return ``ContentContainer`` including your piece of content, when you want it:
```
// instance of IContentRepository
$contentContainer = $contentRepository->listContent( new ContentFilter([
        ContentFilter::TAGS => ['tag1', 'tag2]
    ]) );

// optional: adding an IModifier
$contentContainer->addModifier( new YourModifier() );

// rendering a content named 'sample'
echo $contentContainer->sample;
```
Your output will look like this:
```
Body of sample content
```

When you added a modifier ``YourModifier``, then your output looks like this:
```
Body of test content
```