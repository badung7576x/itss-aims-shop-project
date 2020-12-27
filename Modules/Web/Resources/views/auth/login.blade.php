<aside id="sidebarContent" class="u-sidebar u-sidebar__lg u-unfold--css-animation u-unfold--hidden fadeOutRight" aria-labelledby="sidebarNavToggler" style="animation-duration: 500ms;">
    <div class="u-sidebar__scroller">
        <div class="u-sidebar__container">
            <div class="u-header-sidebar__footer-offset">
                <div class="d-flex align-items-center position-absolute top-0 right-0 z-index-2 mt-5 mr-md-6 mr-4">
                    <button
                        type="button"
                        class="close ml-auto target-of-invoker-has-unfolds"
                        aria-controls="sidebarContent"
                        aria-haspopup="true"
                        aria-expanded="false"
                        data-unfold-event="click"
                        data-unfold-hide-on-scroll="false"
                        data-unfold-target="#sidebarContent"
                        data-unfold-type="css-animation"
                        data-unfold-animation-in="fadeInRight"
                        data-unfold-animation-out="fadeOutRight"
                        data-unfold-duration="500"
                    >
                        <span aria-hidden="true">Close <i class="fas fa-times ml-2"></i></span>
                    </button>
                </div>
                <div class="u-sidebar__content u-header-sidebar__content">
                    <div id="login" data-target-group="idForm">
                        <header class="border-bottom px-4 px-md-6 py-4">
                            <h2 class="font-size-3 mb-0 d-flex align-items-center"><i class="flaticon-user mr-3 font-size-5"></i>Đăng nhập</h2>
                        </header>
                        <form id="loginForm" action="#" method="post">
                            <div class="p-4 p-md-6">
                                <div class="form-group mb-4">
                                    <div class="form-group mb-4">
                                        <p class="text-center" style="color: red" id="login-error"></p>
                                    </div>

                                    <div class="js-form-message js-focus-state">
                                        <label class="form-label">Email <span style="color: red">*</span></label>
                                        <input type="email" class="form-control rounded-0 height-4 px-4" id="login-mail" name="email" required />
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <div class="js-form-message js-focus-state">
                                        <label class="form-label">Mật khẩu <span style="color: red">*</span></label>
                                        <input type="password" class="form-control rounded-0 height-4 px-4" id="login-pass" name="password" required />
                                    </div>
                                </div>

                                <div class="mb-4d75">
                                    <button type="submit" class="btn btn-block py-3 rounded-0 btn-dark">Đăng nhập</button>
                                </div>
                                <div class="mb-2">
                                    <a href="javascript:;" class="js-animation-link btn btn-block py-3 rounded-0 btn-outline-dark font-weight-medium" data-target="#signup" data-link-group="idForm" data-animation-in="fadeIn">
                                        Tạo tài khoản
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div id="signup" style="display: none; opacity: 0;" data-target-group="idForm">
                        <header class="border-bottom px-4 px-md-6 py-4">
                            <h2 class="font-size-3 mb-0 d-flex align-items-center"><i class="flaticon-resume mr-3 font-size-5"></i>Tạo tài khoản</h2>
                        </header>
                        <form id="registerForm" action="#" method="post">
                            <div class="p-4 p-md-6">
                                <div class="form-group mb-4">
                                    <div class="js-form-message js-focus-state">
                                        <label class="form-label">Họ tên <span style="color: red">*</span></label>
                                        <input type="text" class="form-control rounded-0 height-4 px-4" id="register-name" name="name" required/>
                                        <p id="register-name-error" style="color: red"></p>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <div class="js-form-message js-focus-state">
                                        <label class="form-label">Số điện thoại <span style="color: red">*</span></label>
                                        <input type="text" class="form-control rounded-0 height-4 px-4" id="register-phonenumber" name="phone_number" required />
                                        <p id="register-phonenumber-error" style="color: red"></p>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <div class="js-form-message js-focus-state">
                                        <label class="form-label">Email <span style="color: red">*</span></label>
                                        <input type="email" class="form-control rounded-0 height-4 px-4" id="register-email" name="email" required />
                                        <p id="register-mail-error" style="color: red"></p>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <div class="js-form-message js-focus-state">
                                        <label class="form-label">Mật khẩu <span style="color: red">*</span></label>
                                        <input type="password" class="form-control rounded-0 height-4 px-4" id="register-pass" name="password" required />
                                        <p id="register-pass-error" style="color: red"></p>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <div class="js-form-message js-focus-state">
                                        <label class="form-label">Mật khẩu (Xác nhận) <span style="color: red">*</span></label>
                                        <input type="password" class="form-control rounded-0 height-4 px-4" id="register-rpass" name="re_password" required />
                                        <p id="register-rpass-error" style="color: red"></p>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-block py-3 rounded-0 btn-dark">Tạo tài khoản</button>
                                </div>
                                <div class="text-center mb-4">
                                    <span class="small text-muted">Đã có tài khoản trước đó ?</span>
                                    <a class="js-animation-link small" href="javascript:;" data-target="#login" data-link-group="idForm" data-animation-in="fadeIn">Đăng nhập </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('form#loginForm').addEventListener('submit', (event) => {
            event.preventDefault();
            loginSubmit();
        });

        document.querySelector('form#registerForm').addEventListener('submit', (event) => {
            event.preventDefault();
            registerSubmit();
        });

        function loginSubmit(){
            $.ajax({
                url: "{{route('web.post-login')}}",
                type:'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    email: $('#login-mail').val(),
                    password: $('#login-pass').val()
                },
                success:function (result){
                    if(result.status === true) {
                        location.reload();
                    } else {
                        $('#login-error').html("Email hoặc mật khẩu chưa chính xác");
                        $('#login-mail').val(result.email);
                        $('#login-pass').val("");
                    }
                }
            });
        }

        function registerSubmit(){
            $.ajax({
                url: "{{route('web.post-register')}}",
                type:'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    email: $('#register-email').val(),
                    name: $('#register-name').val(),
                    phone_number: $('#register-phonenumber').val(),
                    password: $('#register-pass').val(),
                    re_password: $('#register-rpass').val()
                },
                success: function (result){
                    location.reload();
                },
                error: function (result) {
                    cleanRegisterErrorMessage();
                    let errors = $.parseJSON(result.responseText).errors;
                    if(errors.email) $('#register-mail-error').html(errors.email[0]);
                    if(errors.name) $('#register-name-error').html(errors.name[0]);
                    if(errors.phone_number) $('#register-phonenumber-error').html(errors.phone_number[0]);
                    if(errors.password) $('#register-pass-error').html(errors.password[0]);
                    if(errors.re_password) $('#register-rpass-error').html(errors.re_password[0]);
                }
            });
        }

        function cleanRegisterErrorMessage() {
            $('#register-pass').val("");
            $('#register-rpass').val("");
            $('#register-mail-error').html("");
            $('#register-name-error').html("");
            $('#register-phonenumber-error').html("");
            $('#register-pass-error').html("");
            $('#register-rpass-error').html("");
        }

    </script>
</aside>
