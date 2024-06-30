@extends('Common::index')
@section('title', $title)

@section('page')
    <main class="hero_section__">
        <div class="container">
            <div class="row row_modify with_row_gap">
                <div class="col-lg-6">
                    <h1 class="hero_main_title__">
                        @lang('Please select the item you are looking for')
                    </h1>
                    <p class="parag__">
                        @lang('Just choose the piece you are looking for and it will show you many of the results you want')
                    </p>
                    <div class="search_wrapper__">
                        <form action="{{ route('items.index') }}">
                            <div class="input_group__ flex_group__ group_gap__ flex_dir_col_xxs_screen__">
                                {{-- <input type="text" class="input__" name="keyword" placeholder="@lang('Search Keyword')"> --}}
                            </div>
                            <div class="input_group__ flex_group__ group_gap__ flex_dir_col_xxs_screen__">
                                <select name="brand_id" class="select__ selectpicker" data-title="@lang('Brand')">
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <select name="mark_id" class="select__ selectpicker" data-title="@lang('Model')">
                                    @foreach ($marks as $mark)
                                        <option value="{{ $mark->id }}">{{ $mark->name }}</option>
                                    @endforeach
                                </select>
                                <select name="model" class="select__ selectpicker" data-title="@lang('Year')">
                                    @foreach ($years as $y)
                                        <option value="{{ $y }}">{{ $y }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="button__ submit-button__ full_width__ hero_section_search_button">
                                <img class="icon__"
                                    src="{{ url('assets/web') }}/images/shapes/hero_section_search_button_icon.svg"
                                    alt="..." />
                                @lang('Search')
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <figure class="figure__ asp-om loading-omd">
                        <img class="img-om lazy-omd" data-src="{{ app_setting('hero_section_image') }}" alt="..." />
                    </figure>
                </div>
            </div>
        </div>
    </main>

    @include('Pages::home_about')


    @include('Agents::maintenance')

    @include('Agents::distributors')
@stop
