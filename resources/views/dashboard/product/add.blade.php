@extends('dashboard.layouts.main')

@section('main')
  <main class="lg:ml-64 min-h-screen px-4 md:px-8 lg:px-10 pt-14 pb-10">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2 py-10">
      <div>
        <h2 class="text-2xl font-bold mb-1 md:mb-0">Add Product Data</h2>
        <p class="text-sm font-normal">Add your product data here!</p>
      </div>
      <nav class="flex text-gray-700" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
          <li class="inline-flex items-center">
            <a href="{{ route('dashboard.index') }}"
              class="inline-flex items-center text-sm font-medium text-red-500 hover:text-red-600">
              <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                  d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
              </svg>
              Dashboard
            </a>
          </li>
          <li class="inline-flex items-center">
            <i class="fa-sharp fa-solid fa-chevron-right text-xs text-gray-400"></i>
            <a href="{{ route('dashboard.product.index') }}"
              class="ms-1 inline-flex items-center text-sm font-medium text-red-500 hover:text-red-600 md:ms-2">
              Product
            </a>
          </li>
          <li>
            <div class="flex items-center">
              <i class="fa-sharp fa-solid fa-chevron-right text-xs text-gray-400"></i>
              <p class="ms-1 text-sm font-medium text-gray-700 md:ms-2 dark:text-gray-400">Add</p>
            </div>
          </li>
        </ol>
      </nav>

    </div>

    <div class="rounded-lg mb-4">
      <section class="bg-gray-50 dark:bg-gray-900">
        <div class="bg-white dark:bg-gray-800 relative sm:rounded-lg overflow-hidden p-4">

          <form action="{{ route('dashboard.product.store') }}" method="POST" x-data="sizeSelector({{ $sizes->toJson() }})">
            @csrf
            <div class="grid gap-4 sm:grid-cols-2">
              <div class="w-full">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="text" name="name" id="name"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5"
                  placeholder="Product name" required="">
              </div>
              <div class="w-full">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price
                  (IDR)</label>
                <input type="number" name="price" id="price"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5"
                  placeholder="200000" required="">
              </div>

              <div>
                <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item
                  Weight (gram)</label>
                <input type="number" name="item-weight" id="item-weight"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5"
                  placeholder="200" required="">
              </div>

              <div>
                <label for="type_size" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type
                  Size</label>
                <select id="type_size" name="type_size" x-model="selectedType" @change="loadSizes()"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5"
                  required="">
                  <option selected disabled">Select type size</option>
                  <option value="clothing_size">Clothing Size</option>
                  <option value="shoe_size">Shoe Size</option>
                  <option value="accessories_size">Accessories Size</option>
                </select>
              </div>

              <div class="sm:col-span-2" x-show="sizes.length > 0">
                <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                <div class="grid gap-4 sm:grid-cols-4">

                  <template x-for="(size, index) in sizes" :key="size">
                    <div class="flex items-center gap-2">
                      <label :for="size" class="block w-12 text-sm font-medium text-gray-900 dark:text-white"
                        x-text="size + ' :'"></label>
                      <input type="number" :name="'stock[' + sizeIds[index] + ']'" :id="size"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-400 focus:border-red-400 block w-full p-2.5"
                        placeholder="200" required="">
                    </div>
                  </template>

                </div>
              </div>

              <div class="sm:col-span-2">
                <label for="description"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                <div class="grid gap-4 sm:grid-cols-6">
                  @foreach ($categories as $item)
                    <div class="flex items-start">
                      <div class="flex items-center h-5">
                        <input id="category_{{ $item->id }}" name="category[]" type="checkbox"
                          value="{{ $item->id }}"
                          class="w-4 h-4 text-red-500 bg-gray-100 border-gray-300 rounded focus:ring-red-300 dark:focus:ring-red-500 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                      </div>
                      <label for="category_{{ $item->id }}"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $item->name }}</label>
                    </div>
                  @endforeach
                </div>
              </div>

              <div class="sm:col-span-2">
                <label for="description"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
                <input type="file" class="filepond image" name="image" required>
              </div>

              <div class="sm:col-span-2">
                <label for="description"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                <textarea id="description" name="description"></textarea>
              </div>
            </div>

            <button type="submit"
              class="my-4 text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-500 dark:focus:ring-red-800 transition-all duration-200">
              <span id="button_text_add_category">Save</span>
            </button>
          </form>
        </div>
      </section>
    </div>
  </main>
@endsection

@push('scripts')
  <script>
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $(document).ready(function() {
      $('.js-example-basic-multiple').select2();
    });

    function sizeSelector(sizeData) {
      return {
        selectedType: '',
        sizeOptions: sizeData,
        sizes: [],
        sizeIds: [],
        loadSizes() {
          const selectedType = this.selectedType;
          console.log('Selected Type:', selectedType);
          const selectedOption = this.sizeOptions.find(option => option.type === selectedType);

          if (selectedOption) {
            this.sizes = selectedOption.size_names;
            this.sizeIds = selectedOption.size_ids;
          } else {
            this.sizes = [];
            this.sizeIds = [];
          }
        }
      }
    }

    // FilePond.create(
    //   document.querySelector('.image'), {
    //     server: {
    //       process: "/dashboard/product/upload-file",
    //       revert: "/dashboard/product/cancel-file",
    //       headers: {
    //         "X-CSRF-TOKEN": CSRF_TOKEN,
    //       }
    //     },
    //     allowMultiple: false,
    //     allowReorder: false,
    //     allowFileSizeValidation: true,
    //     allowFileTypeValidation: true,
    //     maxFiles: 1,
    //     maxFileSize: '2MB',
    //     labelMaxFileSize: 'Maximum file size is {filesize}',
    //     acceptedFileTypes: ['image/*'],
    //     labelFileTypeNotAllowed: 'File of invalid type. Please upload PNG, JPG, or JPEG files only.',
    //   }
    // );

    FilePond.create(
      document.querySelector('.image'), {
        server: {
          process: "/dashboard/product/upload-file-multiple",
          revert: "/dashboard/product/cancel-file-multiple",
          headers: {
            "X-CSRF-TOKEN": CSRF_TOKEN,
          }
        },
        allowMultiple: true,
        allowReorder: true,
        allowFileSizeValidation: true,
        allowFileTypeValidation: true,
        maxFiles: 5,
        maxFileSize: '2MB',
        labelMaxFileSize: 'Maximum file size is {filesize}',
        acceptedFileTypes: ['image/*'],
        labelFileTypeNotAllowed: 'File of invalid type. Please upload PNG, JPG, or JPEG files only.',
      }
    );

    CKEDITOR.ClassicEditor.create(document.querySelector('#description'), {
      toolbar: {
        items: [
          'heading', '|',
          'bold', 'italic', 'underline', 'subscript', 'superscript', 'link', "uploadImage", '|',
          'bulletedList', 'numberedList', 'blockQuote', '|',
          'undo', 'redo', 'sourceEditing',
          '-',
        ],
        shouldNotGroupWhenFull: true,
      },
      heading: {
        options: [{
            model: 'paragraph',
            title: 'Paragraph',
            class: 'ck-heading_paragraph'
          },
          {
            model: 'heading6',
            view: 'h6',
            title: 'Heading 6',
            class: 'ck-heading_heading6'
          }
        ],
      },
      placeholder: "Write Drescription",
      link: {
        decorators: {
          addTargetToExternalLinks: true,
          defaultProtocol: "https://",
          toggleDownloadable: {
            mode: "manual",
            label: "Downloadable",
            attributes: {
              download: "file",
            },
          },
        },
      },
      image: {
        resizeOptions: [{
            name: 'resizeImage:100',
            value: '100',
            icon: 'full'
          },
          {
            name: 'resizeImage:75',
            value: '75',
            icon: 'large'
          },
          {
            name: 'resizeImage:50',
            value: '50',
            icon: 'medium'
          },
          {
            name: 'resizeImage:original',
            value: null,
            icon: 'original'
          },
        ],
        styles: {
          options: [{
              name: 'alignLeft',
              title: 'Align Left',
              icon: 'left',
              className: 'image-align-left'
            },
            {
              name: 'alignCenter',
              title: 'Align Center',
              icon: 'center',
              className: 'image-align-center'
            },
            {
              name: 'alignRight',
              title: 'Align Right',
              icon: 'right',
              className: 'image-align-right'
            },
          ]
        },
        toolbar: [
          'imageStyle:alignLeft',
          'imageStyle:alignCenter',
          'imageStyle:alignRight',
          '|', 'resizeImage', 'toggleImageCaption', 'linkImage'
        ],
      },
      ckfinder: {
        uploadUrl: "{{ route('dashboard.product.image', ['_token' => csrf_token()]) }}",
      },
      removePlugins: [
        // 'ExportPdf',
        // 'ExportWord',
        "AIAssistant",
        // "CKBox",
        // "CKFinder",
        // "EasyImage",
        // 'Base64UploadAdapter',
        "RealTimeCollaborativeComments",
        "RealTimeCollaborativeTrackChanges",
        "RealTimeCollaborativeRevisionHistory",
        "PresenceList",
        "Comments",
        "TrackChanges",
        "TrackChangesData",
        "RevisionHistory",
        "Pagination",
        "WProofreader",
        "MathType",
        "SlashCommand",
        "Template",
        "DocumentOutline",
        "FormatPainter",
        "TableOfContents",
        "PasteFromOfficeEnhanced",
        "CaseChange",
      ],
    });
  </script>
@endpush
