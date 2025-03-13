<x-layout bodyClass="bg-gray-200">

        <main class="main-content  mt-0">
            <div class="page-header align-items-start min-vh-100"
                style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
                <span class="mask bg-gradient-dark opacity-6"></span>
                <div class="container mt-5">
                    <div class="row signin-margin">
                        <div class="col-lg-4 col-md-8 col-12 mx-auto">
                            <div class="card z-index-0 fadeIn3 fadeInBottom">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                    <div class="sign_bk shadow_hlenaha border-radius-lg py-4 pe-1">
                                        <div class="" style="max-width: 100px; margin: auto">
                                            <img src="{{asset('images/logo/logo.png')}}" alt="logo" style="width: 100%">
                                        </div>
                                        <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">{{__('global.sign_in')}}</h4>

{{--                                        <div>--}}
{{--                                            <a class="btn mt-3 shadow-lg bg-white rounded"  onClick="socialSignin('google');">--}}
{{--                                                <img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />--}}
{{--                                                <span class="fa fa-google"></span> Sign in with Google--}}
{{--                                            </a>--}}
{{--                                            <form id="social-login-form" action="" method="POST" style="display: none;">--}}
{{--                                                @csrf--}}
{{--                                                <input id="social-login-access-token" name="social-login-access-token" type="text">--}}
{{--                                                <input id="social-login-tokenId" name="access_token" type="text">--}}
{{--                                                <input  name="provider"  value="google" type="text">--}}
{{--                                            </form>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="{{ route('login') }}" class="text-start">
                                        @csrf
                                        @if (Session::has('status'))
                                        <div class="alert alert-success alert-dismissible text-white" role="alert">
                                            <span class="text-sm">{{ Session::get('status') }}</span>
                                            <button type="button" class="btn-close text-lg py-3 opacity-10"
                                                data-bs-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif

                                        <div class="input-group input-group-outline mt-3">
                                            <label class="form-label">{{__('validation.attributes.email')}}</label>
                                            <input type="email" class="form-control" name="email" value="{{ 'admin@admin.com' }}">
                                        </div>
                                        @error('email')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                        <div class="input-group input-group-outline mt-3">
                                            <label class="form-label">{{__('validation.attributes.password')}}</label>
                                            <input type="password" class="form-control" name="password" value='{{ '123456'}}'>
                                        </div>
                                        @error('password')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                        <div class="form-check form-switch d-flex align-items-center p-0 my-3 justify-content-between" >
                                            <input class="form-check-input" type="checkbox" id="rememberMe">
                                            <label class="form-check-label mb-0 ms-2" for="rememberMe">{{__('global.remember_me')}}</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn sign_bk text-white w-100 my-4 mb-2">{{__('global.sign_in')}}</button>
                                        </div>
                                        <p class="text-sm text-center">
                                            {{__('global.forget_p')}}
                                            <a href="{{ route('verify') }}"
                                                class="sign_bk text-gradient font-weight-bold">{{__('global.here')}}</a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        @push('js')
<script src="{{ asset('assets') }}/js/jquery.min.js"></script>
<script>
    $(function() {

    var text_val = $(".input-group input").val();
    if (text_val === "") {
      $(".input-group").removeClass('is-filled');
    } else {
      $(".input-group").addClass('is-filled');
    }
});
</script>

{{--        <script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-app.js"></script>--}}
{{--        <script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-auth.js"></script>--}}
{{--        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>--}}
{{--        <script>--}}
{{--            // Initialize Firebase--}}
{{--            var config = {--}}
{{--                apiKey: "AIzaSyCLsG0vgLEKkX2aCARvJGK-x9iHA_mAeyQ",--}}
{{--                authDomain: "halinaha-7041e.firebaseapp.com",--}}
{{--                projectId: "halinaha-7041e",--}}
{{--                storageBucket: "halinaha-7041e.firebasestorage.app",--}}
{{--                messagingSenderId: "652170422777",--}}
{{--                appId: "1:652170422777:web:0b53be3115afb99a2f7528",--}}
{{--                measurementId: "G-H9WXD313W3"--}}
{{--            };--}}
{{--            firebase.initializeApp(config);--}}
{{--            var facebookProvider = new firebase.auth.FacebookAuthProvider();--}}
{{--            var googleProvider = new firebase.auth.GoogleAuthProvider();--}}
{{--            var facebookCallbackLink = '/api/socialLogin';--}}
{{--            var googleCallbackLink = '/api/socialLogin';--}}
{{--            async function socialSignin(provider) {--}}
{{--                var socialProvider = null;--}}
{{--                if (provider === "facebook") {--}}
{{--                    socialProvider = facebookProvider;--}}
{{--                    document.getElementById('social-login-form').action = facebookCallbackLink;--}}
{{--                } else if (provider === "google") {--}}
{{--                    socialProvider = googleProvider;--}}
{{--                    document.getElementById('social-login-form').action = googleCallbackLink;--}}
{{--                } else {--}}
{{--                    return;--}}
{{--                }--}}
{{--                firebase.auth().signInWithPopup(socialProvider).then(function(result) {--}}
{{--                    result.user.getIdToken().then(function(result) {--}}
{{--                        document.getElementById('social-login-tokenId').value = result;--}}
{{--                        document.getElementById('social-login-form').submit();--}}
{{--                    });--}}
{{--                }).catch(function(error) {--}}
{{--                    // do error handling--}}
{{--                    console.log(error);--}}
{{--                });--}}
{{--            }--}}
{{--        </script>--}}


@endpush
</x-layout>
