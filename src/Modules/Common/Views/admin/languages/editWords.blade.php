@extends('Common::admin.layout.page')
@section('page')
    <!-- START: Content-->

    <style>
        [v-cloak] {
            display: none;
        }

        #translate_table {
            height: 600px;
            overflow-y: auto;
        }
    </style>
    <div class="card border-light shadow-sm rounded-5">
        <div class="card-body">
            <div id="translate_table" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <table class="table table-striped table-bordered dt-responsive nowrap">
                    <tr>
                        <th>{{__('Word')}}</th>
                        <th>{{__('Translate')}}</th>
                    </tr>
                    <tr v-for="translate, key in alltranslation" v-cloak>
                        <td>@{{ key }}</td>
                        <td>
                            <input class="form-control" v-model="alltranslation[key]" v-on:blur="transInput(key)"
                                   type="text">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
        <script src="{{asset('assets/admin/js/vue.js')}}"></script>
        <script src="{{asset('assets/admin/js/axios.min.js')}}"></script>
        <script>
            let translate_table = new Vue({
                el: `#translate_table`,
                data: {
                    lang: `{{$slug}}`,
                    alltranslation: {!!json_encode($words)!!},
                },
                methods: {
                    transInput(key) {
                        axios.post(`{{route('admin.translations.transInput')}}`, {
                            id: key,
                            text: this.alltranslation[key],
                            lang: this.lang
                        }).then(function (response) {
                            toastr.success(response.data.message);
                        });
                    },

                }
            });
        </script>
@endsection
