 /*!
 * Custom JS
 */
window.showHidePasswordField = function(caller, target) {
    const password_box = document.getElementById(target);
    if (password_box.type === "password") {
        caller.innerHTML = '<i class="far fa-eye-slash"></i>';
        password_box.type = "text";
    } else {
        caller.innerHTML = '<i class="far fa-eye"></i>';
        password_box.type = "password";
    }
}
