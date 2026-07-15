@extends('admin.layout')

@section('title', 'Add News')
@section('page-title', 'Add News')
@section('page-subtitle', 'Publish a new article')

@section('content')
    <style>
        .admin-content {
            padding: 24px;
            height: 100%;
            overflow-y: auto;
        }

        .form-panel {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
            max-width: 900px;
            margin: 0 auto 32px;
        }

        .form-panel-head {
            padding: 20px 24px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            border-radius: 16px 16px 0 0;
        }

        .form-panel-head h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #0f172a;
        }

        .form-panel-body {
            padding: 24px;
        }

        .form-section-label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #94a3b8;
            margin: 26px 0 14px;
            padding-top: 14px;
            border-top: 1px solid #f1f5f9;
        }

        .form-section-label:first-child {
            margin-top: 0;
            padding-top: 0;
            border-top: none;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .form-row .form-group {
            flex: 1;
            min-width: 220px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }

        label .req {
            color: #ef4444;
        }

        label .opt {
            color: #94a3b8;
            font-weight: 400;
            text-transform: none;
            font-size: 12px;
        }

        .form-control,
        select.form-control,
        textarea.form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            color: #0f172a;
            background: white;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #0f172a;
            box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.08);
        }

        .form-control:disabled {
            background: #f8fafc;
            color: #94a3b8;
            cursor: not-allowed;
        }

        textarea.form-control {
            resize: vertical;
        }

        #content {
            min-height: 220px;
        }

        #short_description {
            min-height: 70px;
        }

        .help-text {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 6px;
        }

        .error-text,
        .js-error {
            font-size: 12px;
            color: #ef4444;
            margin-top: 6px;
            display: none;
        }

        .error-text {
            display: block;
        }

        .is-invalid {
            border-color: #ef4444 !important;
        }

        .checkbox-group {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            padding: 14px 16px;
            background: #f8fafc;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-item input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #0f172a;
            cursor: pointer;
        }

        .checkbox-item label {
            margin: 0;
            font-weight: 500;
            cursor: pointer;
        }

        .image-preview-wrap {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-top: 10px;
        }

        .image-preview-wrap img {
            width: 96px;
            height: 96px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            display: none;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            padding-top: 8px;
            border-top: 1px solid #f1f5f9;
            margin-top: 8px;
        }

        .btn-sm {
            padding: 10px 22px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-cancel {
            background: #f1f5f9;
            color: #334155;
        }

        .btn-cancel:hover {
            background: #e2e8f0;
        }

        .btn-save {
            background: #0f172a;
            color: white;
        }

        .btn-save:hover {
            background: #1e293b;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.25);
        }

        @media (max-width: 576px) {
            .admin-content {
                padding: 16px;
            }

            .form-panel-body {
                padding: 16px;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .form-actions .btn-sm {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <div class="form-panel">
        <div class="form-panel-head">
            <h3>📝 Article Details</h3>
        </div>
        <div class="form-panel-body">
            <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data" id="newsForm"
                novalidate>
                @csrf

                <div class="form-section-label">Basic Info</div>

                <div class="form-group">
                    <label for="title">Title <span class="req">*</span></label>
                    <input type="text" name="title" id="title"
                        class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"
                        placeholder="Enter article title" required>
                    <div class="js-error"></div>
                    @error('title')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="category_id">Category <span class="req">*</span></label>
                        <select name="category_id" id="category_id"
                            class="form-control @error('category_id') is-invalid @enderror" required>
                            <option value="">Select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="js-error"></div>
                        @error('category_id')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="subcategory_id">Subcategory <span class="opt">(optional)</span></label>
                        <select name="subcategory_id" id="subcategory_id"
                            class="form-control @error('subcategory_id') is-invalid @enderror" disabled>
                            <option value="">Select category first</option>
                        </select>
                        <div class="help-text" id="subcategoryHint">Loads automatically once you pick a category.
                        </div>
                        @error('subcategory_id')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="short_description">Short Description <span class="opt">(optional)</span></label>
                    <textarea name="short_description" id="short_description"
                        class="form-control @error('short_description') is-invalid @enderror" maxlength="500"
                        placeholder="A one or two line summary shown in listings...">{{ old('short_description') }}</textarea>
                    @error('short_description')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content">Content <span class="req">*</span></label>
                    <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror"
                        placeholder="Write the article content...">{{ old('content') }}</textarea>
                    <div class="js-error"></div>
                    @error('content')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="featured_image">Featured Image <span class="opt">(optional)</span></label>
                    <input type="file" name="featured_image" id="featured_image"
                        class="form-control @error('featured_image') is-invalid @enderror"
                        accept="image/jpeg,image/png,image/webp">
                    <div class="help-text">JPG, PNG or WEBP. Max 2MB.</div>
                    <div class="js-error"></div>
                    <div class="image-preview-wrap">
                        <img id="imagePreview" alt="Preview">
                    </div>
                    @error('featured_image')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-section-label">Additional Details</div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="source">Source <span class="opt">(optional)</span></label>
                        <input type="text" name="source" id="source"
                            class="form-control @error('source') is-invalid @enderror" value="{{ old('source') }}"
                            placeholder="e.g. PTI, Reuters">
                        @error('source')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="location">Location <span class="opt">(optional)</span></label>
                        <input type="text" name="location" id="location"
                            class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}"
                            placeholder="e.g. New Delhi">
                        @error('location')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="tags">Tags <span class="opt">(comma separated)</span></label>
                    <input type="text" name="tags" id="tags"
                        class="form-control @error('tags') is-invalid @enderror" value="{{ old('tags') }}"
                        placeholder="e.g. politics, election, delhi">
                    @error('tags')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status <span class="req">*</span></label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror"
                        required>
                        <option value="">Select status</option>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published
                        </option>
                    </select>
                    <div class="js-error"></div>
                    @error('status')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Flags</label>
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" name="is_breaking" id="is_breaking" value="1"
                                {{ old('is_breaking') ? 'checked' : '' }}>
                            <label for="is_breaking">🔴 Breaking</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                {{ old('is_featured') ? 'checked' : '' }}>
                            <label for="is_featured">⭐ Featured</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="is_trending" id="is_trending" value="1"
                                {{ old('is_trending') ? 'checked' : '' }}>
                            <label for="is_trending">📈 Trending</label>
                        </div>
                    </div>
                </div>

                <div class="form-section-label">SEO <span class="opt">(optional)</span></div>

                <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title"
                        class="form-control @error('meta_title') is-invalid @enderror" value="{{ old('meta_title') }}"
                        placeholder="SEO title for search engines">
                    @error('meta_title')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <textarea name="meta_description" id="meta_description"
                        class="form-control @error('meta_description') is-invalid @enderror" maxlength="500"
                        placeholder="SEO description for search engines">{{ old('meta_description') }}</textarea>
                    @error('meta_description')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="meta_keywords">Meta Keywords</label>
                    <input type="text" name="meta_keywords" id="meta_keywords"
                        class="form-control @error('meta_keywords') is-invalid @enderror"
                        value="{{ old('meta_keywords') }}" placeholder="Comma separated keywords">
                    @error('meta_keywords')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.news.index') }}" class="btn-sm btn-cancel">Cancel</a>
                    <button type="submit" class="btn-sm btn-save">💾 Save Article</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        {{-- Load jQuery only if it isn't already loaded by the admin layout --}}
        <script>
            if (typeof jQuery === 'undefined') {
                document.write('<scr' + 'ipt src="https://code.jquery.com/jquery-3.7.1.min.js"><\/scr' + 'ipt>');
            }
        </script>
        <script>
            $(function() {
                /* ------------------------------------------------------------
                   Image preview
                ------------------------------------------------------------ */
                const $imageInput = $('#featured_image');
                const $imagePreview = $('#imagePreview');

                $imageInput.on('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = e => {
                            $imagePreview.attr('src', e.target.result).show();
                        };
                        reader.readAsDataURL(file);
                    } else {
                        $imagePreview.hide();
                    }
                });

                /* ------------------------------------------------------------
                   AJAX dependent Category -> Subcategory dropdown
                ------------------------------------------------------------ */
                const subcategoryUrlTemplate = "{{ route('admin.news.subcategories', ['category' => '__CAT__']) }}";
                const $subcategory = $('#subcategory_id');
                const $subcategoryHint = $('#subcategoryHint');

                function loadSubcategories(categoryId, selectedId) {
                    if (!categoryId) {
                        $subcategory.prop('disabled', true).html('<option value="">Select category first</option>');
                        $subcategoryHint.text('Loads automatically once you pick a category.');
                        return;
                    }

                    $subcategory.prop('disabled', true).html('<option value="">Loading...</option>');
                    $subcategoryHint.text('Loading subcategories…');

                    $.ajax({
                        url: subcategoryUrlTemplate.replace('__CAT__', categoryId),
                        method: 'GET',
                        dataType: 'json'
                    }).done(function(data) {
                        let options = '<option value="">Select subcategory</option>';
                        (data || []).forEach(function(item) {
                            const selected = selectedId && String(selectedId) === String(item.id) ?
                                'selected' : '';
                            options += `<option value="${item.id}" ${selected}>${item.name}</option>`;
                        });
                        $subcategory.html(options).prop('disabled', false);
                        $subcategoryHint.text(data && data.length ? '' :
                            'No subcategories found for this category.');
                    }).fail(function() {
                        $subcategory.html('<option value="">Failed to load</option>').prop('disabled', true);
                        $subcategoryHint.text('Could not load subcategories. Please try again.');
                    });
                }

                $('#category_id').on('change', function() {
                    loadSubcategories($(this).val(), null);
                });

                @if (old('category_id'))
                    loadSubcategories('{{ old('category_id') }}', '{{ old('subcategory_id') }}');
                @endif

                /* ------------------------------------------------------------
                   Client-side validation before submit
                ------------------------------------------------------------ */
                function showError($field, message) {
                    $field.addClass('is-invalid');
                    $field.closest('.form-group').find('.js-error').text(message).show();
                }

                function clearError($field) {
                    $field.removeClass('is-invalid');
                    $field.closest('.form-group').find('.js-error').hide();
                }

                $('#newsForm').on('submit', function(e) {
                    let valid = true;

                    const $title = $('#title');
                    if ($title.val().trim() === '') {
                        showError($title, 'Title is required.');
                        valid = false;
                    } else {
                        clearError($title);
                    }

                    const $category = $('#category_id');
                    if (!$category.val()) {
                        showError($category, 'Please select a category.');
                        valid = false;
                    } else {
                        clearError($category);
                    }

                    const $content = $('#content');
                    if ($content.val().trim() === '') {
                        showError($content, 'Content is required.');
                        valid = false;
                    } else {
                        clearError($content);
                    }

                    const $status = $('#status');
                    if (!$status.val()) {
                        showError($status, 'Please select a status.');
                        valid = false;
                    } else {
                        clearError($status);
                    }

                    const imageFile = $imageInput[0].files[0];
                    if (imageFile) {
                        const allowed = ['image/jpeg', 'image/png', 'image/webp'];
                        if (!allowed.includes(imageFile.type)) {
                            showError($imageInput, 'Only JPG, PNG or WEBP images are allowed.');
                            valid = false;
                        } else if (imageFile.size > 2 * 1024 * 1024) {
                            showError($imageInput, 'Image size must not exceed 2MB.');
                            valid = false;
                        } else {
                            clearError($imageInput);
                        }
                    } else {
                        clearError($imageInput);
                    }

                    if (!valid) {
                        e.preventDefault();
                        const $first = $('.is-invalid').first();
                        if ($first.length) {
                            $('html, body').animate({
                                scrollTop: $first.offset().top - 120
                            }, 300);
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
