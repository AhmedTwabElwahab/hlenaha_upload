<x-app bodyClass="g-sidenav-show bg-gray-200" >
    <x-navbars.sidebar activePage="Banners"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage=" {{__('Banners/index.edit_Banner')}}" parent="{{__('Banners/index.Banners')}}"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="hlenaha_bk sign_bk border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize pe-3">{{__('Banners/index.edit_Banner')}}</h6>
                            </div>
                        </div>
                        <div class="card-body mx-3 mx-md-4 mt-n6">
                            <div class="card card-plain h-100">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-md-8 d-flex align-items-center">
                                            <h6 class="mb-3">{{__('Banners/index.edit_Banner')}}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <x-error></x-error>
                                    <form method='POST' action='{{ route('Banners.update', $banner)}}' enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">{{__('Banners/index.title')}}</label>
                                                <input type="text"
                                                       name="title" class="form-control border border-2 p-2"
                                                       value='{{ $banner->title }}'>
                                                @error('title')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">{{__('Banners/index.image')}}</label>
                                                <input type="file" name="image" class="form-control border border-2 p-2" >
                                                @error('image')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <img src="{{asset($banner->image)}}" alt="banner image" >
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-12">
                                                <label for="floatingTextarea2">{{__('Banners/index.disc')}}</label>
                                                <textarea class="form-control border border-2 p-2"
                                                          placeholder="{{__('Banners/index.description_p')}}" id="floatingTextarea2" name="disc"
                                                          rows="4" cols="50">{{ $banner->disc }}</textarea>
                                                @error('disc')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>
                                        <button type="submit" class="btn bg-gradient-success">{{__('drivers/index.add')}}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app>
