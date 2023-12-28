@extends('Common::admin.layout.page')
@section('page')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Contact the administration') }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="contactus_txt" style="display: flex;justify-content:center">
                        <h3>
                            <i class="fa fa-phone"></i>
                            <span>{{ app_setting('contact_administration' , '0555555555555') }}</span>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
