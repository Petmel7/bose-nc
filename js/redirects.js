function redirectTosigninPage() {
    window.location.href = 'index.php?page=signin';
}

// function redirectTosigninPage() {
//     // Перевірка, чи користувач автентифікований (вам потрібно реалізувати цю логіку)
//     const isAuthenticated = checkAuthentication(); // Вам потрібно реалізувати цю функцію
//     console.log("isAuthenticated", isAuthenticated)

//     // Перенаправлення користувача в залежності від статусу аутентифікації
//     if (isAuthenticated) {
//         window.location.href = 'index.php?page=form'; // Перенаправлення на form-comm.php, якщо користувач автентифікований
//     } else {
//         window.location.href = 'index.php?page=signin'; // Перенаправлення на signin-page.php, якщо користувач не автентифікований
//     }
// }
