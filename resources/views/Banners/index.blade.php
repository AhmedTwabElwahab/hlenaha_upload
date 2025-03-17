<x-app bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="Banners"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="{{__('global.Banners')}}"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    @if (session('status'))
                        <div class="row">
                            <div class="alert alert-success alert-dismissible text-white" role="alert">
                                <span class="text-sm">{{ Session::get('status') }}</span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10"
                                        data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="hlenaha_bk sign_bk border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">{{__('global.Banners')}}</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="card-body p-3">
                                <div class="row">

                                    @isset($banners)
                                        @foreach($banners as $index => $banner)
                                             <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                                    <div class="card card-blog card-plain">
                                                        <div class="position-relative">
                                                            <a class="d-block">
                                                                <img src="{{asset($banner->image)}}" alt="img-blur-shadow" class="img-fluid shadow border-radius-md">
                                                            </a>
                                                        </div>
                                                        <div class="card-body px-1 pb-0">
                                                            <p class="text-secondary mb-0 text-sm">#{{$index + 1}} {{__('global.Banner')}}</p>
                                                            <a href="{{route('Banners.edit',$banner->id)}}">
                                                                <h5 class="font-weight-bolder">
                                                                    {{$banner->title}}
                                                                </h5>
                                                            </a>
                                                            <p class="mb-4 text-sm">
                                                                {{$banner->disc}}
                                                            </p>
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <a  href="{{route('Banners.edit',$banner->id)}}" class="btn btn-outline-success btn-sm mb-0">تعديل</a>
                                                                <div class="avatar-group mt-2">
                                                                    <form method="POST" id="DELETE_DRIVER_FORM" action="{{ route('Banners.destroy', $banner -> id) }}">
                                                                        @csrf
                                                                        <input type="hidden" name="_method" value="DELETE">
                                                                        <a class=""
                                                                           type="button"
                                                                           data-bs-toggle="modal"
                                                                           data-bs-target="#DeleteModal"
                                                                        >
                                                                            <span class="btn-inner--icon">
                                                                                <i class="material-icons ">delete</i>
                                                                            </span>
                                                                        </a>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        @endforeach
                                    @endisset
                                    <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                        <div class="card h-100 card-plain border">
                                            <div class="card-body d-flex flex-column justify-content-center text-center">
                                                <a href="{{route('Banners.create')}}">
                                                    <i class="fa fa-plus text-secondary mb-3"></i>
                                                    <h5 class=" text-secondary"> إضافة إعلان </h5>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--        MODEL SECTION --}}
                            <!-- Modal -->
                            <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight-normal" id="DeleteModalLabel">{{__('global.sure_title')}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{__('global.sure_delete_p')}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">{{__('global.close')}}</button>
                                            <button type="submit" form="DELETE_DRIVER_FORM" class="btn bg-gradient-primary">{{__('global.sure')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--    END  MODEL SECTION --}}


                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
</x-app>
