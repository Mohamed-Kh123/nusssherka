@extends('layouts.store')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <hr>
                <h2 style="color: #f03455;">{{ $category->name }}</h2>
            </div>
        </div>

        <div class="row p-2">
            @foreach ($category->products as $product)
                <div class="col-md-4 col-lg-3 p-2 col-6">
                    <div class="card">
                        {{--                    شوف يخال، المشكلة مش باك، المشكلة بالفرونت، عنا ال target تبع ال button مأشر على مكان واحد، عشان هيك بيفحش الا سوشيال ميديا، عشان هيك راح نعطيهم dynimc traget من ال object الي راجعلك --}}
                        <button type="button" class="modal-btn-img" data-bs-toggle="modal"
                            data-bs-target="#{{ $product->slug }}">
                            <img src="{{ $product->image_url }}" class="card-img-top" alt="Category 6">
                        </button>
                    </div>
                </div>



                <!-- Modal -->
                <div class="modal fade" id="{{ $product->slug }}" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <form class="form modal-content" id="form" action="{{ route('checkout.store') }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ $product->name }}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group" id="append-form">
                                    @if (getFormBySlug($product->slug))
                                        @include('front.forms.' . $product->slug, [
                                            'total' => $product->price,
                                            'type' => $product->slug,
                                        ])
                                    @else
                                        @include('front.forms.default', [
                                            'total' => $product->price,
                                            'type' => $product->slug,
                                        ])
                                    @endif
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="purchase btn" type="submit">اتمام عملية الدفع</button>
                                <button type="button" class="btn dismiss" data-bs-dismiss="modal">إلغاء
                                    الأمر
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Button trigger modal -->
@endsection


{{--@push('script')--}}
    {{--    <script> --}}
    {{--        function generateForm(serviceName) { --}}
    {{--            if (serviceName === 'soshal-mydya') { --}}
    {{--                $('#append-form').empty(); --}}
    {{--                $('#append-form').append(` --}}
    {{--                                        <div class="input-container"> --}}
    {{--                                            <input type="text" placeholder="اسم المؤسسة" name="org_name" required> --}}
    {{--                                        </div> --}}
    {{--                                        <div class="input-container"> --}}
    {{--                                            <textarea placeholder="تعريف عام بالمشروع" name="general_def" --}}
    {{--                                                      required></textarea> --}}
    {{--                                        </div> --}}
    {{--                                        <div class="input-container"> --}}
    {{--                                            <textarea placeholder="بيانات التواصل" name="contacts" required></textarea> --}}
    {{--                                        </div> --}}
    {{--                                        <div class="input-container"> --}}
    {{--                                            <input type="text" placeholder="أبرز المنافسين" name="competitors" required> --}}
    {{--                                        </div> --}}
    {{--                                        <div class="input-container"> --}}
    {{--                                            <input type="text" placeholder="المنطقة الجغرافية" name="geographical_area"> --}}
    {{--                                        </div> --}}
    {{--                                        <div class="input-container"> --}}
    {{--                                            <textarea placeholder="محتوى التصميم" name="design_content" --}}
    {{--                                                      required></textarea> --}}
    {{--                                        </div> --}}
    {{--                                        <div class="input-container"> --}}
    {{--                                            <input type="text" placeholder="ملاحظات للمصمم" name="notes"> --}}
    {{--                                        </div> --}}
    {{--                                        <div class="input-container"> --}}
    {{--                                            <label>إرفق الشعارات وملفات الهوية</label> --}}
    {{--                                            <input type="file" multiple name="images"> --}}
    {{--                                        </div> --}}
    {{--                                    `); --}}
    {{--            } --}}
    {{--            if (serviceName === 'shaaarat') { --}}
    {{--                $('#append-form').empty(); --}}
    {{--                $('#append-form').append(` --}}
    {{--                                        --}}
    {{--                `); --}}
    {{--            } --}}
    {{--        } --}}
    {{--    </script> --}}
    {{--    <script> --}}
    {{--        const dropContainer = document.getElementById("dropcontainer") --}}
    {{--        const fileInput = document.getElementById("images") --}}

    {{--        dropContainer.addEventListener("dragover", (e) => { --}}
    {{--            // prevent default to allow drop --}}
    {{--            e.preventDefault() --}}
    {{--        }, false) --}}

    {{--        dropContainer.addEventListener("dragenter", () => { --}}
    {{--            dropContainer.classList.add("drag-active") --}}
    {{--        }) --}}

    {{--        dropContainer.addEventListener("dragleave", () => { --}}
    {{--            dropContainer.classList.remove("drag-active") --}}
    {{--        }) --}}

    {{--        dropContainer.addEventListener("drop", (e) => { --}}
    {{--            e.preventDefault() --}}
    {{--            dropContainer.classList.remove("drag-active") --}}
    {{--            fileInput.files = e.dataTransfer.files --}}
    {{--        }) --}}
    {{--    </script> --}}
{{--@endpush--}}
