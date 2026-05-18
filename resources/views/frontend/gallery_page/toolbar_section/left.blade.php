<!-- LEFT -->
<div class="gallery-toolbar-left">

    <div class="gallery-total-images">

        <span id="visiblePhotoCount">
            {{ collect($galleryFolders)->sum(fn($folder) => count($folder['images'])) }}
        </span>

        Photos Available

    </div>

</div>
