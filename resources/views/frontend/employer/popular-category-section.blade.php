<section class="section">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="section-title text-center mb-4 pb-2">
                    <h4 class="title title-line pb-5">Categorías Populares</h4>
                    <p class="text-muted para-desc mx-auto mb-1">Elige la categoría que te interese.</p>
                </div>
            </div>
        </div>

        <div class="row">

            @foreach($categories AS $category)

                <div class="col-lg-3 col-md-6 mt-4 pt-2">
                    <a href="javascript:void(0)">
                        <div class="popu-category-box bg-light rounded text-center p-4">
                            <div class="popu-category-icon mb-3">
                                <i class="mdi mdi-star d-inline-block rounded-pill h3 text-primary"></i>
                            </div>

                            <div class="popu-category-content">
                                <h5 class="mb-2 text-dark title">{{$category['category_name']}}</h5>
                                <p class="text-success mb-0 rounded">{{$category->jobs->count()}} Puestos</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>


{{--        <div class="row justify-content-center">--}}

{{--            <div class="col-12 text-center mt-4 pt-2">--}}

{{--                <a href="javascript:void(0)" class="btn btn-primary-outline">Navega todas las categorías <i class="mdi mdi-chevron-right"></i></a>--}}

{{--            </div>--}}

{{--        </div>--}}

    </div>

</section>