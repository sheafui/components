# File upload

`x-ui.file-upload` wraps FilePond and uploads through a Livewire property. It requires
`wire:model` and calls `getUploadedFiles` on the current Livewire component to load
existing files.

```blade
<x-ui.file-upload
    wire:model="photos"
    multiple
    :max-files="5"
    :accepted-file-types="['image/png', 'image/jpeg']"
/>
```

The installable component includes `InteractWithFiles`, which uses Livewire's
`WithFileUploads` trait. The host Livewire component must provide the
`getUploadedFiles` and `removeUploadedFile` methods declared by
`HasFileUploadsActions`.

The JavaScript implementation imports FilePond, its size, type, image, and media
preview plugins, and `mime`. Its stylesheet imports FilePond's base and image
preview CSS.
