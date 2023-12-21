<!-- start of slider -->
<div class="slider">
    <div class="container">
        <div class="owl-carousel owl-theme" id="slider">
            @foreach ($sliders as $slider)
                <div class="box">
                    <div class="photo">
                        <img src="{{ $slider->image }}">
                    </div>
                    <h2 class="title">{{ $slider->title }}</h2>
                    <p>{{ $slider->content }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- end of slider -->
<form action="{{ route('aqars.index') }}">
    <!-- start of filtering -->
    <div class="filtering">
        <div class="container">
            <ul class="nav nav-tabs list-group-horizontal" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">

                        @lang('All')
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">

                        @lang('For Rent')
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">

                        @lang('For Sale')
                    </a>
                </li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane active " id="tabs-1" role="tabpanel">
                    <div class="first">
                        <div class="row">

                            <div class="col-md">
                                <div class="parent">
                                    <select name='category_id' class=" myselect" style="width: 100%">
                                        <option value="0" disabled selected>@lang('Choose Category')</option>
                                        @foreach ($categories as $row)
                                            <option value='{{ $row->id }}'>{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="parent">
                                    <select name='category_unit_id' class=" myselect" style="width: 100%">
                                        <option value="0" selected disabled>@lang('Choose Unit Type')</option>
                                        @foreach ($unit_categories as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="parent">
                                    <select name='governrate_id' class=" myselect" style="width: 100%">
                                        <option value="0" selected disabled>@lang('Choose Area')</option>
                                        @foreach ($areas as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="parent">
                                    <select name='area_id' class=" myselect" style="width: 100%">
                                        <option value="0" disabled selected>@lang('Choose City')</option>
                                        @foreach ($cities ?? [] as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="parent">
                                    <button type="submit" class="form-control">
                                        <i class="fa fa-search"></i>
                                        <span>@lang('Search Now')</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>
