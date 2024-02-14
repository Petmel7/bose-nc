async function checkAuthentication() {
    try {
        const response = await fetch('api_php/check-auth.php', {
            method: 'GET',
            credentials: 'include', // Включає передачу куки для авторизації
        });

        if (response.ok) {
            const data = await response.json();
            console.log("checData", data)
            if (data.authenticated) {
                // Користувач авторизований, повертаємо true
                return true;
            } else {
                // Користувач не авторизований, повертаємо false
                return false;
            }
        } else {
            throw new Error('Network response was not ok.');
        }
    } catch (error) {
        console.error('Error:', error);
        // Помилка під час спроби перевірки авторизації
        return false;
    }
}


// async function checkAuthentication() {
//     try {
//         const response = await fetch('signin-signup/handleGetRequest.php', {
//             method: 'GET',
//             // credentials: 'include', // Включає передачу куки для авторизації
//         });

//         if (response.ok) {
//             const data = await response.json();
//             console.log("checData", data)
//             if (data.authorized) {
//                 // Користувач авторизований, повертаємо true
//                 return true;
//             } else {
//                 // Користувач не авторизований, повертаємо false
//                 return false;
//             }
//         } else {
//             throw new Error('Network response was not ok.');
//         }
//     } catch (error) {
//         console.error('Error:', error);
//         // Помилка під час спроби перевірки авторизації
//         return false;
//     }
// }
