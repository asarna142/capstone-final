class UserLogin {
    constructor(dotPath) {
        this.pathDots = dotPath;

        this.modalResource();
    }

    modalResource() {
        if (document.getElementById('sweetalert2') === null) {
            var styleElement = document.createElement('link');
            styleElement.href = this.pathDots + '/css/sweetalert2.css';
            styleElement.rel = 'stylesheet';
            styleElement.id = 'sweetalert2';
            styleElement.type = 'text/css';
            document.getElementsByTagName('head')[0].appendChild(styleElement);
        }
    }

    signup() {
        Swal.fire({
            title: 'Sign Up',
            html: `<input type="text" id="login" class="swal2-input" placeholder="Username" autofocus required>
                    <input type="password" id="password" class="swal2-input" placeholder="Password" required>
                    <input type="email" id="email" class="swal2-input" placeholder="Email" required>`,
            confirmButtonText: 'Sign Up',
            showCloseButton: true,
            allowOutsideClick: false,
            allowEscapeKey: true,
            preConfirm: () => {
                const login = Swal.getPopup().querySelector('#login').value;
                const password = Swal.getPopup().querySelector('#password').value;
                const email = Swal.getPopup().querySelector('#email').value;
                if (!login || !password || !email) {
                    Swal.showValidationMessage(`Please enter login, password and email.`);
                }
                return {
                    login: login,
                    password: password,
                    email: email,
                    pathDot: this.pathDots
                }
            }
        }).then((result) => {
            if (result.value !== undefined) {
                $.post({
                    url: this.pathDots + '/php/post-usages/simpleSignUp.php',
                    data: {
                        username: result.value['login'].toLowerCase(),
                        password: result.value['password'],
                        email: result.value['email'].toLowerCase()
                    },
                    dataType: 'json',
                    success: function (json) {
                        for (var message in json) {
                            switch (message.toUpperCase()) {
                                case 'SUCCESSFUL':
                                    Swal.fire({
                                        icon: 'success',
                                        allowOutsideClick: false,
                                        text: json[message]
                                    });
                                    break;
                                case 'ERROR':
                                    Swal.fire({
                                        icon: 'error',
                                        allowOutsideClick: false,
                                        text: json[message]
                                    }).then(response => {
                                        new UserLogin(result.value['pathDot']).signup();
                                    });
                                    break;
                            }
                        }
                    }
                });
            }
        });
    }

    userLogin() {
        Swal.fire({
            title: 'Login Form',
            html: `<input type="text" id="login" class="swal2-input" placeholder="Username" autofocus required>
            <input type="password" id="password" class="swal2-input" placeholder="Password" required>`,
            confirmButtonText: 'Sign in',
            showCloseButton: true,
            allowEscapeKey: true,
            allowOutsideClick: false,
            preConfirm: () => {
                const login = Swal.getPopup().querySelector('#login').value;
                const password = Swal.getPopup().querySelector('#password').value;
                if (!login || !password) {
                    Swal.showValidationMessage(`Please enter login and password`);
                }
                return {
                    login: login,
                    password: password,
                    pathDot: this.pathDots
                }
            }
        }).then(result => {
            if (result.value !== undefined) {
                $.post({
                    url: this.pathDots + '/php/post-usages/simpleLogin.php',
                    data: {
                        username: result.value['login'],
                        password: result.value['password']
                    },
                    dataType: 'json',
                    success: function (json) {
                        for (var items in json) {
                            switch (items.toUpperCase()) {
                                case 'SUCCESSFUL':
                                    window.location.reload();
                                    break;
                                case 'UNKNOWN':
                                    Swal.fire({
                                        icon: 'info',
                                        allowOutsideClick: false,
                                        text: json[items]
                                    }).then(response => {
                                        new UserLogin(result.value['pathDot']).userLogin();
                                    });
                                    break;
                                case 'ERROR':
                                    Swal.fire({
                                        icon: 'error',
                                        allowOutsideClick: false,
                                        text: json[items]
                                    }).then(response => {
                                        new UserLogin(result.value['pathDot']).userLogin();
                                    });
                                    break;
                            }
                        }
                    }
                });
            }
        });
    }

    userLogOut() {
        var pathDot = this.pathDots;
        $.post({
            url: this.pathDots + '/php/post-usages/User.php',
            data: {
                logout: 'You have successfully logged out.'
            },
            dataType: 'json',
            success: function (json) {
                for (var message in json) {
                    switch (message.toUpperCase()) {
                        case 'LOGOUT':
                            Swal.fire({
                                icon: 'success',
                                allowOutsideClick: false,
                                text: json[message]
                            }).then(result => {
                                if (result.isConfirmed) {
                                    window.location.assign(pathDot + '/');
                                }
                            });
                            break;
                    }
                }
            }
        });
    }
}
