<div class="left-sidebar">
    <div class="accordion" id="accordionExample">

        <!-- collapse one end -->
        <div class="card rounded mt-4">
            <a data-toggle="collapse" href="#collapsetwo" class="job-list" aria-expanded="true" aria-controls="collapsetwo">
                <div class="card-header" id="headingtwo">
                    <h6 class="mb-0 text-dark f-18">Categorías</h6>
                </div>
            </a>
            <div id="collapsetwo" class="collapse show" aria-labelledby="headingtwo">
                <div class="card-body p-0">

                    @foreach($categories AS $category)
                        <div class="custom-control custom-radio">
                            <input type="radio" id="category-panel-{{$category->id}}" name="filter[category_panel]" class="custom-control-input filter-panel"
                            value="{{$category->id}}"  {{((isset($filterJobs['category_panel']) and $filterJobs['category_panel']==$category->id) ? 'checked' : '')}}>
                            <label class="custom-control-label ml-1 text-muted f-15" for="category-panel-{{$category->id}}">
                                {{ucfirst(mb_strtolower($category->category_name))}}
                            </label>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <!-- collapse one end -->


        <div class="card rounded mt-4">
            <a data-toggle="collapse" href="#collapsethree" class="job-list" aria-expanded="true" aria-controls="collapsethree">
                <div class="card-header" id="headingthree">
                    <h6 class="mb-0 text-dark f-18">Experiencias</h6>
                </div>
            </a>
            <div id="collapsethree" class="collapse show" aria-labelledby="headingthree">
                <div class="card-body p-0">

                    <div class="custom-control custom-radio">
                        <input type="radio" id="experience-1" name="filter[experience]" class="custom-control-input filter-panel">
                        <label class="custom-control-label ml-1 text-muted f-15" for="experience-1">
                            {{ucfirst(mb_strtolower(\App\Models\PublishedJobs::EXPERIENCE_1))}}
                        </label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input type="radio" id="experience-2" name="filter[experience]" class="custom-control-input filter-panel"
                               value="{{\App\Models\PublishedJobs::EXPERIENCE_2}}"
                                {{((isset($filterJobs['experience']) and $filterJobs['experience']==\App\Models\PublishedJobs::EXPERIENCE_2) ? 'checked' : '')}}>
                        <label class="custom-control-label ml-1 text-muted f-15" for="experience-2">
                            {{ucfirst(mb_strtolower(\App\Models\PublishedJobs::EXPERIENCE_2))}}
                        </label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input type="radio" id="experience-3" name="filter[experience]" class="custom-control-input filter-panel"
                               value="{{\App\Models\PublishedJobs::EXPERIENCE_3}}"
                                {{((isset($filterJobs['experience']) and $filterJobs['experience']==\App\Models\PublishedJobs::EXPERIENCE_3) ? 'checked' : '')}}>
                        <label class="custom-control-label ml-1 text-muted f-15" for="experience-3">
                            {{ucfirst(mb_strtolower(\App\Models\PublishedJobs::EXPERIENCE_3))}}
                        </label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input type="radio" id="experience-4" name="filter[experience]" class="custom-control-input filter-panel"
                               value="{{\App\Models\PublishedJobs::EXPERIENCE_MAS}}"
                                {{((isset($filterJobs['experience']) and $filterJobs['experience']==\App\Models\PublishedJobs::EXPERIENCE_MAS) ? 'checked' : '')}}>
                        <label class="custom-control-label ml-1 text-muted f-15" for="experience-4">
                            {{ucfirst(mb_strtolower(\App\Models\PublishedJobs::EXPERIENCE_MAS))}}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <!-- collapse one end -->


        <div class="card rounded mt-4">
            <a data-toggle="collapse" href="#collapsefour" class="job-list" aria-expanded="true" aria-controls="collapsefour">
                <div class="card-header" id="headingfour">
                    <h6 class="mb-0 text-dark f-18">Género</h6>
                </div>
            </a>
            <div id="collapsefour" class="collapse show" aria-labelledby="headingfour">
                <div class="card-body p-0">


                    <div class="custom-control custom-radio">
                        <input type="radio" id="gender-1" name="filter[gender]" class="custom-control-input filter-panel"
                               value="{{\App\Models\UserProfile::GENDER_M}}"
                                {{((isset($filterJobs['gender']) and $filterJobs['gender']==\App\Models\UserProfile::GENDER_M) ? 'checked' : '')}}>
                        <label class="custom-control-label ml-1 text-muted f-15" for="gender-1">
                            {{ucfirst(mb_strtolower(\App\Models\UserProfile::GENDER_M))}}
                        </label>
                    </div>


                    <div class="custom-control custom-radio">
                        <input type="radio" id="gender-2" name="filter[gender]" class="custom-control-input filter-panel"
                               value="{{\App\Models\PublishedJobs::GENDER_F}}"
                                {{((isset($filterJobs['gender']) and $filterJobs['gender']==\App\Models\PublishedJobs::GENDER_F) ? 'checked' : '')}}>
                        <label class="custom-control-label ml-1 text-muted f-15" for="gender-2">
                            {{ucfirst(mb_strtolower(\App\Models\PublishedJobs::GENDER_F))}}
                        </label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input type="radio" id="gender-2" name="filter[gender]" class="custom-control-input filter-panel"
                               value="{{\App\Models\PublishedJobs::GENDER_O}}"
                                {{((isset($filterJobs['gender']) and $filterJobs['gender']==\App\Models\PublishedJobs::GENDER_O) ? 'checked' : '')}}>
                        <label class="custom-control-label ml-1 text-muted f-15" for="gender-2">
                            {{ucfirst(mb_strtolower(\App\Models\PublishedJobs::GENDER_O))}}
                        </label>
                    </div>

                </div>
            </div>
        </div>
        <!-- collapse one end -->
    </div>
</div>