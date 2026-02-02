<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content="theme_ocean">
    <!--! The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags !-->
    <!--! BEGIN: Apps Title-->
    <title>Duralux || Invoice Create</title>
    <!--! END:  Apps Title-->
    <!--! BEGIN: Favicon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('adminAssets/images/favicon.ico')}}">
    <!--! END: Favicon-->
    <!--! BEGIN: Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('adminAssets/css/bootstrap.min.cs')}}s">
    <!--! END: Bootstrap CSS-->
    <!--! BEGIN: Vendors CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('adminAssets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminAssets/vendors/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminAssets/vendors/css/select2-theme.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminAssets/vendors/css/datepicker.min.css')}}">
    <!--! END: Vendors CSS-->
    <!--! BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('adminAssets/css/theme.min.css')}}">
    <!--! END: Custom CSS-->
    <!--! HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries !-->
    <!--! WARNING: Respond.js doesn"t work if you view the page via file: !-->
    <!--[if lt IE 9]>
			<script src="https:oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https:oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>

<body>
    @include('admin.sidebar')

    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Add Product</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Create</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <div class="page-header-right-items">
                        <div class="d-flex d-md-none">
                            <a href="javascript:void(0)" class="page-header-right-close-toggle">
                                <i class="feather-arrow-left me-2"></i>
                                <span>Back</span>
                            </a>
                        </div>
                        <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                            <a href="javascript:void(0);" class="btn btn-light-brand successAlertMessage">
                                <i class="feather-layers me-2"></i>
                                <span>Save as Draft</span>
                            </a>
                            <a href="javascript:void(0);" class="btn btn-primary successAlertMessage">
                                <i class="feather-save me-2"></i>
                                <span>Save Invoice</span>
                            </a>
                        </div>
                    </div>
                    <div class="d-md-none d-flex align-items-center">
                        <a href="javascript:void(0)" class="page-header-right-open-toggle">
                            <i class="feather-align-right fs-20"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- [ page-header ] end -->
            <!-- [ Main Content ] start -->
            <div class="main-content">
  <div class="row">
    <!-- LEFT: MAIN FORM -->
    <div class="col-xl-8">
  <div class="card invoice-container">
    <div class="card-header">
      <h5>Edit Base Product </h5>
      <small class="text-muted d-block">
        Admin catalog item. Designers will apply artwork later in InkForge Studio.
      </small>
    </div>

    <div class="card-body p-3">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('product.update', $product->id) }}">
    @csrf
    @method('PUT')
        

        <!-- TABS -->
        <ul class="nav nav-tabs mb-4">
          <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#tab_basic">Catalog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#tab_variants">Variants (SKU)</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#tab_images">Mockups</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#tab_attrs">Filters & Tags</a>
          </li>
        </ul>

        <div class="tab-content">

          <!-- ===================== CATALOG (PRODUCTS) ===================== -->
          <div class="tab-pane fade show active" id="tab_basic">
            <div class="row">

              <!-- Product Name -->
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label class="form-label">Product Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="name"
                         value="{{ old('name', $product->name) }}"
                         placeholder="e.g. Unisex T-Shirt / Hoodie / Mug" required>
                  @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <!-- Slug -->
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label class="form-label">Slug</label>
                  <input type="text" class="form-control" name="slug"
                         value="{{ old('slug', $product->slug) }}"
                         placeholder="Leave empty to auto-generate">
                  <div class="fs-12 text-muted mt-1">DB requires slug (generate in controller if empty).</div>
                </div>
              </div>

              <!-- Category -->
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label class="form-label">Category <span class="text-danger">*</span></label>
                  <select class="form-control" name="category_id" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $c)
                      <option value="{{ $c->id }}" {{ $product->category_id == $c->id ? 'selected' : '' }}>
                        {{ $c->name }}
                      </option>
                    @endforeach
                  </select>
                  @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <!-- Base Price -->
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label class="form-label">Base Cost (Product Base Price) <span class="text-danger">*</span></label>
                  <input type="number" class="form-control" name="base_price" step="0.01" min="0"
                         value="{{ old('base_price', $product->base_price) }}"
                         placeholder="0.00" required>
                  <div class="fs-12 text-muted mt-1">Used later to calculate listing price with markup.</div>
                  @error('base_price')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <!-- Short Description -->
              <div class="col-12">
                <div class="form-group mb-3">
                  <label class="form-label">Short Description</label>
                  <input type="text" class="form-control" name="short_description" maxlength="500"
                         value="{{ old('short_description', $product->short_description) }}"
                         placeholder="Short summary shown in catalog cards">
                </div>
              </div>

              <!-- Full Description -->
              <div class="col-12">
                <div class="form-group mb-3">
                  <label class="form-label">Description</label>
                  <textarea rows="5" class="form-control" name="description"
                            placeholder="Product details, material, fit, wash care...">{{ old('description', $product->description) }}</textarea>
                </div>
              </div>

              <!-- Weight -->
              <div class="col-md-4">
                <div class="form-group mb-3">
                  <label class="form-label">Weight (grams)</label>
                  <input type="number" class="form-control" name="weight_grams" min="0"
                         value="{{ old('weight_grams', $product->weight_grams ?? 0) }}">
                  <div class="fs-12 text-muted mt-1">Used for shipping rates.</div>
                </div>
              </div>

              <!-- Switches -->
              <div class="col-md-8 d-flex gap-3 align-items-center mt-2">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" name="is_active" 
                         {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                  <label class="form-check-label">Active</label>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" name="is_featured"
                         {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                  <label class="form-check-label">Featured</label>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" name="is_embroidery_compatible"
                         {{ old('is_embroidery_compatible', $product->is_embroidery_compatible) ? 'checked' : '' }}>
                  <label class="form-check-label">Embroidery Compatible</label>
                </div>
              </div>

              <!-- Advanced Print Rules (collapsed) -->
              <div class="col-12 mt-4">
                <div class="d-flex align-items-center justify-content-between">
                  <div>
                    <h6 class="fw-bold mb-0">Advanced Print Rules</h6>
                    <div class="fs-12 text-muted">
                      Used by InkForge Designer for validation (print area + DPI warnings).
                    </div>
                  </div>
                  <button class="btn btn-sm btn-light-brand" type="button"
                          data-bs-toggle="collapse" data-bs-target="#advancedPrintRules">
                    Toggle
                  </button>
                </div>

                <div class="collapse mt-3" id="advancedPrintRules">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group mb-3">
                        <label class="form-label">Print Area Width</label>
                        <input type="number" class="form-control" name="print_area_width" min="0"
                               value="{{ old('print_area_width', $product->print_area_width) }}" placeholder="e.g. 300">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group mb-3">
                        <label class="form-label">Print Area Height</label>
                        <input type="number" class="form-control" name="print_area_height" min="0"
                               value="{{ old('print_area_height', $product->print_area_height) }}" placeholder="e.g. 400">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group mb-3">
                        <label class="form-label">Min DPI</label>
                        <input type="number" class="form-control" name="min_dpi" min="72"
                               value="{{ old('min_dpi', $product->min_dpi ?? 150) }}">
                        <div class="fs-12 text-muted mt-1">Default 150 DPI as per spec.</div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label">Mockup Template (optional)</label>
                        <input type="text" class="form-control" name="mockup_template"
                               value="{{ old('mockup_template', $product->mockup_template) }}"
                               placeholder="template file name / path">
                        <div class="fs-12 text-muted mt-1">Admin-only. Used for mockup generation presets.</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <!-- ===================== VARIANTS ===================== -->
          <div class="tab-pane fade" id="tab_variants">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div>
                <h6 class="fw-bold mb-0">Variants (SKU)</h6>
                <div class="fs-12 text-muted">Each variant becomes a sellable SKU (size/color).</div>
              </div>
              <button type="button" id="addVariant" class="btn btn-sm btn-primary">Add Variant</button>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered" id="variantsTable">
                <thead>
                  <tr>
                    <th>SKU <span class="text-danger">*</span></th>
                    <th>Color</th>
                    <th>Hex</th>
                    <th>Size</th>
                    <th>Stock</th>
                    <th>Additional Cost</th>
                    <th class="text-center">X</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($product->variants as $i => $variant)
                  <tr>
                    <td><input class="form-control" name="variants[{{ $i }}][sku]" value="{{ old('variants.'.$i.'.sku', $variant->sku) }}" required></td>
                    <td><input class="form-control" name="variants[{{ $i }}][color_name]" value="{{ old('variants.'.$i.'.color_name', $variant->color_name) }}"></td>
                    <td><input class="form-control" name="variants[{{ $i }}][color_hex]" value="{{ old('variants.'.$i.'.color_hex', $variant->color_hex) }}"></td>
                    <td><input class="form-control" name="variants[{{ $i }}][size]" value="{{ old('variants.'.$i.'.size', $variant->size) }}"></td>
                    <td><input class="form-control" name="variants[{{ $i }}][stock_count]" type="number" value="{{ old('variants.'.$i.'.stock_count', $variant->stock_count) }}"></td>
                    <td><input class="form-control" name="variants[{{ $i }}][additional_cost]" type="number" step="0.01" value="{{ old('variants.'.$i.'.additional_cost', $variant->additional_cost) }}"></td>
                    <td class="text-center">
                      <button type="button" class="btn btn-sm bg-soft-danger text-danger removeRow">Remove</button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <!-- ===================== IMAGES ===================== -->
          <div class="tab-pane fade" id="tab_images">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div>
                <h6 class="fw-bold mb-0">Mockups</h6>
                <div class="fs-12 text-muted">Used on product pages (multi-angle mockups).</div>
              </div>
              <button type="button" id="addImage" class="btn btn-sm btn-primary">Add Image</button>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered" id="imagesTable">
                <thead>
                  <tr>
                    <th>Image URL <span class="text-danger">*</span></th>
                    <th>Type</th>
                    <th>Angle</th>
                    <th>Alt Text</th>
                    <th class="text-center">X</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($product->images as $i => $image)
                  <tr>
                    <td><input class="form-control" name="images[{{ $i }}][image_url]" value="{{ old('images.'.$i.'.image_url', $image->image_url) }}" required></td>
                    <td>
                      <select class="form-control" name="images[{{ $i }}][image_type]">
                        <option value="mockup" {{ $image->image_type == 'mockup' ? 'selected' : '' }}>mockup</option>
                        <option value="preview" {{ $image->image_type == 'preview' ? 'selected' : '' }}>preview</option>
                        <option value="lifestyle" {{ $image->image_type == 'lifestyle' ? 'selected' : '' }}>lifestyle</option>
                      </select>
                    </td>
                    <td><input class="form-control" name="images[{{ $i }}][angle]" value="{{ old('images.'.$i.'.angle', $image->angle) }}"></td>
                    <td><input class="form-control" name="images[{{ $i }}][alt_text]" value="{{ old('images.'.$i.'.alt_text', $image->alt_text) }}"></td>
                    <td class="text-center">
                      <button type="button" class="btn btn-sm bg-soft-danger text-danger removeRow">Remove</button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <!-- ===================== FILTERS & TAGS ===================== -->
          <div class="tab-pane fade" id="tab_attrs">
            <div class="mb-3">
              <h6 class="fw-bold mb-0">Filters & Tags</h6>
              <div class="fs-12 text-muted">Used for marketplace filtering (material, theme, audience...)</div>
            </div>

            <div class="row">
              @foreach($attributes as $i => $a)
                @php
                  $attrValue = $product->attributes->firstWhere('attribute_id', $a->id)->value ?? '';
                @endphp
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label class="form-label">{{ $a->name }}</label>
                    <input type="hidden" name="attrs[{{ $i }}][attribute_id]" value="{{ $a->id }}">
                    <input class="form-control" name="attrs[{{ $i }}][value]" value="{{ old('attrs.'.$i.'.value', $attrValue) }}" placeholder="Enter {{ strtolower($a->name) }}">
                  </div>
                </div>
              @endforeach
            </div>

            <hr>

            <div class="form-group mb-3">
              <label class="form-label">Tags</label>
              <select class="form-control" name="tag_ids[]" multiple>
                @foreach($tags as $t)
                  <option value="{{ $t->id }}" {{ in_array($t->id, old('tag_ids', $product->tags->pluck('id')->toArray() ?? [])) ? 'selected' : '' }}>
                    {{ strtoupper($t->type) }} — {{ $t->name }}
                  </option>
                @endforeach
              </select>
              <div class="fs-12 text-muted mt-1">Hold Ctrl to select multiple</div>
            </div>
          </div>

        </div>

        <!-- ACTIONS -->
        <div class="d-flex justify-content-end gap-2 mt-4">
          <a href="javascript:history.back()" class="btn btn-light-brand">Cancel</a>
          <button type="submit" class="btn btn-primary">Update Base Product</button>
        </div>

      </form>
    </div>
  </div>
</div>
    <!-- RIGHT: HELP / RULES -->
    <div class="col-xl-4">

      <div class="card stretch stretch-full">
        <div class="card-body">
          <h6 class="fw-bold">Admin Guidance</h6>
          <p class="fs-12 text-muted mb-2">
            You are creating a <b>blank base product</b> (catalog item). Designers will later upload artwork and publish listings.
          </p>
          <div class="fs-12 text-muted">
            Required for a complete catalog entry:
            <ul class="mb-0">
              <li><b>Name</b> + <b>Category</b> + <b>Base Price</b></li>
              <li>At least <b>1 Variant</b> (SKU)</li>
              <li>At least <b>1 Mockup Image</b></li>
            </ul>
          </div>
        </div>
      </div>

      <div class="card stretch stretch-full">
        <div class="card-body">
          <h6 class="fw-bold">Why “Min DPI” exists</h6>
          <p class="fs-12 text-muted mb-0">
            It supports the Designer validation rule (spec says ≥150 DPI warning). Keep it under Advanced Print Rules
            so admin isn’t confused.
          </p>
        </div>
      </div>

    </div>
  </div>
</div>

      </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
        <!-- [ Footer ] start -->
        <footer class="footer">
            <p class="fs-11 text-muted fw-medium text-uppercase mb-0 copyright">
                <span>Copyright ©</span>
                <script>
                    document.write(new Date().getFullYear());
                </script>
            </p>
            <p><span>By: <a target="_blank" href="https://wrapbootstrap.com/user/theme_ocean" target="_blank">theme_ocean</a></span> • <span>Distributed by: <a target="_blank" href="https://themewagon.com" target="_blank">ThemeWagon</a></span></p>
            <div class="d-flex align-items-center gap-4">
                <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Help</a>
                <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Terms</a>
                <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Privacy</a>
            </div>
        </footer>
        <!-- [ Footer ] end -->
    </main>
    <!--! ================================================================ !-->
    <!--! [End] Main Content !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! BEGIN: Theme Customizer !-->
    <!--! ================================================================ !-->
    <div class="theme-customizer">
        <div class="customizer-handle">
            <a href="javascript:void(0);" class="cutomizer-open-trigger bg-primary">
                <i class="feather-settings"></i>
            </a>
        </div>
        <div class="customizer-sidebar-wrapper">
            <div class="customizer-sidebar-header px-4 ht-80 border-bottom d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Theme Settings</h5>
                <a href="javascript:void(0);" class="cutomizer-close-trigger d-flex">
                    <i class="feather-x"></i>
                </a>
            </div>
            <div class="customizer-sidebar-body position-relative p-4" data-scrollbar-target="#psScrollbarInit">
                <!--! BEGIN: [Navigation] !-->
                <div class="position-relative px-3 pb-3 pt-4 mt-3 mb-5 border border-gray-2 theme-options-set">
                    <label class="py-1 px-2 fs-8 fw-bold text-uppercase text-muted text-spacing-2 bg-white border border-gray-2 position-absolute rounded-2 options-label" style="top: -12px">Navigation</label>
                    <div class="row g-2 theme-options-items app-navigation" id="appNavigationList">
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-navigation-light" name="app-navigation" value="1" data-app-navigation="app-navigation-light" checked>
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-navigation-light">Light</label>
                        </div>
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-navigation-dark" name="app-navigation" value="2" data-app-navigation="app-navigation-dark">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-navigation-dark">Dark</label>
                        </div>
                    </div>
                </div>
                <!--! END: [Navigation] !-->
                <!--! BEGIN: [Header] !-->
                <div class="position-relative px-3 pb-3 pt-4 mt-3 mb-5 border border-gray-2 theme-options-set mt-5">
                    <label class="py-1 px-2 fs-8 fw-bold text-uppercase text-muted text-spacing-2 bg-white border border-gray-2 position-absolute rounded-2 options-label" style="top: -12px">Header</label>
                    <div class="row g-2 theme-options-items app-header" id="appHeaderList">
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-header-light" name="app-header" value="1" data-app-header="app-header-light" checked>
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-header-light">Light</label>
                        </div>
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-header-dark" name="app-header" value="2" data-app-header="app-header-dark">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-header-dark">Dark</label>
                        </div>
                    </div>
                </div>
                <!--! END: [Header] !-->
                <!--! BEGIN: [Skins] !-->
                <div class="position-relative px-3 pb-3 pt-4 mt-3 mb-5 border border-gray-2 theme-options-set">
                    <label class="py-1 px-2 fs-8 fw-bold text-uppercase text-muted text-spacing-2 bg-white border border-gray-2 position-absolute rounded-2 options-label" style="top: -12px">Skins</label>
                    <div class="row g-2 theme-options-items app-skin" id="appSkinList">
                        <div class="col-6 text-center position-relative single-option light-button active">
                            <input type="radio" class="btn-check" id="app-skin-light" name="app-skin" value="1" data-app-skin="app-skin-light">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-skin-light">Light</label>
                        </div>
                        <div class="col-6 text-center position-relative single-option dark-button">
                            <input type="radio" class="btn-check" id="app-skin-dark" name="app-skin" value="2" data-app-skin="app-skin-dark">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-skin-dark">Dark</label>
                        </div>
                    </div>
                </div>
                <!--! END: [Skins] !-->
                <!--! BEGIN: [Typography] !-->
                <div class="position-relative px-3 pb-3 pt-4 mt-3 mb-0 border border-gray-2 theme-options-set">
                    <label class="py-1 px-2 fs-8 fw-bold text-uppercase text-muted text-spacing-2 bg-white border border-gray-2 position-absolute rounded-2 options-label" style="top: -12px">Typography</label>
                    <div class="row g-2 theme-options-items font-family" id="fontFamilyList">
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-font-family-lato" name="font-family" value="1" data-font-family="app-font-family-lato">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-font-family-lato">Lato</label>
                        </div>
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-font-family-rubik" name="font-family" value="2" data-font-family="app-font-family-rubik">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-font-family-rubik">Rubik</label>
                        </div>
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-font-family-inter" name="font-family" value="3" data-font-family="app-font-family-inter" checked>
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-font-family-inter">Inter</label>
                        </div>
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-font-family-cinzel" name="font-family" value="4" data-font-family="app-font-family-cinzel">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-font-family-cinzel">Cinzel</label>
                        </div>
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-font-family-nunito" name="font-family" value="6" data-font-family="app-font-family-nunito">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-font-family-nunito">Nunito</label>
                        </div>
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-font-family-roboto" name="font-family" value="7" data-font-family="app-font-family-roboto">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-font-family-roboto">Roboto</label>
                        </div>
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-font-family-ubuntu" name="font-family" value="8" data-font-family="app-font-family-ubuntu">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-font-family-ubuntu">Ubuntu</label>
                        </div>
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-font-family-poppins" name="font-family" value="9" data-font-family="app-font-family-poppins">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-font-family-poppins">Poppins</label>
                        </div>
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-font-family-raleway" name="font-family" value="10" data-font-family="app-font-family-raleway">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-font-family-raleway">Raleway</label>
                        </div>
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-font-family-system-ui" name="font-family" value="11" data-font-family="app-font-family-system-ui">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-font-family-system-ui">System UI</label>
                        </div>
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-font-family-noto-sans" name="font-family" value="12" data-font-family="app-font-family-noto-sans">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-font-family-noto-sans">Noto Sans</label>
                        </div>
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-font-family-fira-sans" name="font-family" value="13" data-font-family="app-font-family-fira-sans">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-font-family-fira-sans">Fira Sans</label>
                        </div>
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-font-family-work-sans" name="font-family" value="14" data-font-family="app-font-family-work-sans">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-font-family-work-sans">Work Sans</label>
                        </div>
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-font-family-open-sans" name="font-family" value="15" data-font-family="app-font-family-open-sans">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-font-family-open-sans">Open Sans</label>
                        </div>
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-font-family-maven-pro" name="font-family" value="16" data-font-family="app-font-family-maven-pro">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-font-family-maven-pro">Maven Pro</label>
                        </div>
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-font-family-quicksand" name="font-family" value="17" data-font-family="app-font-family-quicksand">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-font-family-quicksand">Quicksand</label>
                        </div>
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-font-family-montserrat" name="font-family" value="18" data-font-family="app-font-family-montserrat">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-font-family-montserrat">Montserrat</label>
                        </div>
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-font-family-josefin-sans" name="font-family" value="19" data-font-family="app-font-family-josefin-sans">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-font-family-josefin-sans">Josefin Sans</label>
                        </div>
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-font-family-ibm-plex-sans" name="font-family" value="20" data-font-family="app-font-family-ibm-plex-sans">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-font-family-ibm-plex-sans">IBM Plex Sans</label>
                        </div>
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-font-family-source-sans-pro" name="font-family" value="5" data-font-family="app-font-family-source-sans-pro">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-font-family-source-sans-pro">Source Sans Pro</label>
                        </div>
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-font-family-montserrat-alt" name="font-family" value="21" data-font-family="app-font-family-montserrat-alt">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-font-family-montserrat-alt">Montserrat Alt</label>
                        </div>
                        <div class="col-6 text-center single-option">
                            <input type="radio" class="btn-check" id="app-font-family-roboto-slab" name="font-family" value="22" data-font-family="app-font-family-roboto-slab">
                            <label class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label" for="app-font-family-roboto-slab">Roboto Slab</label>
                        </div>
                    </div>
                </div>
                <!--! END: [Typography] !-->
            </div>
            <div class="customizer-sidebar-footer px-4 ht-60 border-top d-flex align-items-center gap-2">
                <div class="flex-fill w-50">
                    <a href="javascript:void(0);" class="btn btn-danger" data-style="reset-all-common-style">Reset</a>
                </div>
                <div class="flex-fill w-50">
                    <a href="https://www.themewagon.com/themes/Duralux-admin" target="_blank" class="btn btn-primary">Download</a>
                </div>
            </div>
        </div>
    </div>

    <!--! ================================================================ !-->
    <!--! [End] Theme Customizer !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! Footer Script !-->
    <!--! ================================================================ !-->
    <!--! BEGIN: Vendors JS !-->
    <script src="{{asset('adminAssets/vendors/js/vendors.min.js')}}"></script>
    <!-- vendors.min.js {always must need to be top} -->
    <script src="{{asset('adminAssets/vendors/js/select2.min.js')}}"></script>
    <script src="{{asset('adminAssets/vendors/js/select2-active.min.js')}}"></script>
    <script src="{{asset('adminAssets/vendors/js/datepicker.min.js')}}"></script>
    <script src="{{asset('adminAssets/vendors/js/cleave.min.js')}}"></script>
    <!--! END: Vendors JS !-->
    <!--! BEGIN: Apps Init  !-->
    <script src="{{asset('adminAssets/js/common-init.min.js')}}"></script>
    <script src="{{asset('adminAssets/js/invoice-create-init.min.js')}}"></script>
    <!--! END: Apps Init !-->
    <!--! BEGIN: Theme Customizer  !-->
    <script src="{{asset('adminAssets/js/theme-customizer-init.min.js')}}"></script>
    <!--! END: Theme Customizer !-->
    <script>
        $(document).ready(function() {
            var i = 1;
            $("#add_row").click(function() {
                b = i - 1;
                $("#addr" + i)
                    .html($("#addr" + b).html())
                    .find("td:first-child")
                    .html(i + 1);
                $("#tab_logic").append('<tr id="addr' + (i + 1) + '"></tr>');
                i++;
            });
            $("#delete_row").click(function() {
                if (i > 1) {
                    $("#addr" + (i - 1)).html("");
                    i--;
                }
                calc();
            });
            $("#tab_logic tbody").on("keyup change", function() {
                calc();
            });
            $("#tax").on("keyup change", function() {
                calc_total();
            });
        });

        function calc() {
            $("#tab_logic tbody tr").each(function(i, element) {
                var html = $(this).html();
                if (html != "") {
                    var qty = $(this).find(".qty").val();
                    var price = $(this).find(".price").val();
                    $(this)
                        .find(".total")
                        .val(qty * price);
                    calc_total();
                }
            });
        }

        function calc_total() {
            total = 0;
            $(".total").each(function() {
                total += parseInt($(this).val());
            });
            $("#sub_total").val(total.toFixed(2));
            tax_sum = (total / 100) * $("#tax").val();
            $("#tax_amount").val(tax_sum.toFixed(2));
            $("#total_amount").val((tax_sum + total).toFixed(2));
        }
    </script>
</body>

</html>
