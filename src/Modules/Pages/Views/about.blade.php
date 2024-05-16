@if ($about)
    <!-- Start About Us -->
    <main class="about_us_section default_section__">
        <div class="container">
            <div class="row row_modify with_row_gap">
                <div class="col-12 col-lg-5 img_wrapper col_start__">
                    <figure class="figure__ asp-om loading-omd">
                        <img class="lazy-omd img-om" data-src="{{ $page->image }}" alt="..." />
                    </figure>
                </div>
                <div class="col-12 col-lg-7 col_start__">
                    <div class="about_us_description">
                        <div class="section_header">
                            <h2 class="site_head__">
                                {{ $page->title }}
                            </h2>
                            <h2 class="site_head_sub_title__">{!! $page->content !!}</h2>
                        </div>
                        @foreach ($page->sections ?? [] as $row)
                            <div class="about_us_block__">
                                <h4 class="title__">{{ $row->title }}</h4>
                                <p class="parag__">{{ $row->content }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- End About Us -->
@endif
