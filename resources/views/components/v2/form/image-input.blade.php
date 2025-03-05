@props([
    'viewOnly' => false,
    'name' => 'image',
    'errorMessageId' => 'image_error',
    'idPlaceholderImage'=>'image_placeholder_id'
])

<style>
    .image-input-placeholder {
        background-image: url('{{asset('assets/media/svg/avatars/blank.svg')}}');
    }

    [data-bs-theme="dark"] .image-input-placeholder {
        background-image: url('{{asset('assets/media/svg/avatars/blank-dark.svg')}}');
    }
</style>
@if($viewOnly)
    <div class="image-input image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
        <div class="image-input-wrapper w-125px h-125px"
             style="background-image: url({{ FileHelper::getImage($image) }})">
        </div>
    </div>
@else
    <div class="image-input image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
        <div class="image-input-wrapper w-125px h-125px" id="{{$idPlaceholderImage}}"
             style="max-width: 200px; object-fit: cover">
        </div>
        <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
               data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click"
               title="Change {{$name}}">
            <i class="bi bi-pencil-fill fs-7"><span class="path1"></span><span class="path2"></span></i>
            <input type="file" name="{{ $name }}" accept="image/png, image/jpg, image/jpeg, image/webp"/>
            <input type="hidden" hidden name="{{ $name }}"/>
        </label>
        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
              data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Cancel Image">
        <i class="bi bi-x fs-2"></i>
    </span>
        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
              data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Hapus Foto">
        <i class="bi bi-x fs-2"></i>
    </span>
    </div>
    <div class="text-muted fs-7">
        can only upload images in *.png, *.jpg and *.jpeg formats (Max 2 Mb)
    </div>
    <ul class="error-message text-sm text-red-600 dark:text-red-400 space-y-1" style="display: none"
        id="{{$errorMessageId}}">
    </ul>
@endif
