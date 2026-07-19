# Image editor

`x-ui.image-editor` uses Cropper.js to crop and transform an image in the browser.

```blade
<div x-on:image-cropped="editedImage = $event.detail.blob">
    <x-ui.image-editor
        image="/images/photo.jpg"
        :viewport-width="640"
        :viewport-height="360"
    />
</div>
```

Saving dispatches an `image-cropped` Alpine event. Its detail contains `blob`,
`canvas`, `cropData`, and `imageMatrix`. The current implementation does not bind
the edited image through `wire:model`.

The Blade view also declares `emptyFillColor` and `circleCropper`, but the current
JavaScript controller does not consume them.
