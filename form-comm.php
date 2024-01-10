<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>bose</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="comments.css">
</head>

<body>

    <section class="container-comments">
        <form class="comments-form" action="comments.php" method="post">
            <input id="nameInput" type="text" placeholder="Name" name="name">
            <textarea cols="30" rows="10" placeholder="Comment" name="comment"></textarea>
            <button type="submit">Publish</button>
        </form>

        <ul class="comments-container" id="commentsContainer"></ul>
        <ul id="xxxxxxx"></ul>
    </section>

    <script>
        // Отримання форми та обробник події
        const commentsForm = document.querySelector('.comments-form');

        commentsForm.addEventListener('submit', async function(event) {
            event.preventDefault();

            try {
                const formData = new FormData(this);
                const response = await fetch('comments.php', {
                    method: 'POST',
                    body: formData
                });

                if (response.ok) {
                    displayComments(); // Оновлення списку коментарів після успішної відправки
                    this.reset(); // Очищення форми після відправки

                    alert(`Коментар успішно додано!`); // Повідомлення про успішне додавання коментаря
                } else {
                    throw new Error('Network response was not ok.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Помилка');
            }
        });

        // Оновлення списку коментарів при завантаженні сторінки
        async function displayComments() {
            try {
                const response = await fetch('comments.php', {
                    method: 'GET'
                });

                if (response.ok) {
                    const comments = await response.json();
                    let commentsContainer = document.getElementById('commentsContainer');
                    commentsContainer.innerHTML = '';

                    const commentsHTML = comments.map(comment => `
                        <li>
                            <p>${comment.name}</p>
                            <p>${comment.comment}</p>
                            <span>${comment.created_at}</span>
                            <button class="delete-comment" data-comment-id="${comment.comment_id}">Delete</button>
                        </li>
                    `).join('');

                    // console.log('comment.comment_id', comment.comment_id)

                    // <button onclick="deleteComment(${comment.comment_id})">Delete</button>
                    // <button class="delete-comment" data-comment-id="${comment.comment_id}">Delete</button>

                    commentsContainer.insertAdjacentHTML('beforeend', commentsHTML);
                } else {
                    throw new Error('Network response was not ok.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Помилка');
            }
        }

        // Виклик функції для завантаження коментарів при завантаженні сторінки
        displayComments();


        // // Оновлена функція deleteComment
        // async function deleteComment(commentId) {
        //     try {
        //         const response = await fetch('comments.php', {
        //             method: 'DELETE',
        //             body: JSON.stringify({
        //                 comment_id: commentId
        //             })
        //         });

        //         console.log('commentId', commentId);

        //         if (response.ok) {
        //             // Оновлення списку коментарів після видалення (якщо потрібно)
        //             displayComments();
        //         } else {
        //             throw new Error('Network response was not ok.');
        //         }
        //     } catch (error) {
        //         console.error('Error:', error);
        //         alert('Помилка');
        //     }
        // }


        async function deleteComment(commentId) {
            try {
                const response = await fetch('comments.php', {
                    method: 'DELETE',
                    body: JSON.stringify({
                        comment_id: commentId
                    })
                });

                console.log('commentId', commentId);

                if (response.ok) {
                    displayComments();
                } else {
                    throw new Error('Network response was not ok.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Помилка');
            }
        }








        // // Функція для створення нового коментаря
        // function createComment(name, comment) {
        //     const formData = new FormData();
        //     formData.append('name', name);
        //     formData.append('comment', comment);

        //     fetch('http://localhost/bose-nc/comments.php', {
        //             method: 'POST',
        //             body: formData
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             // Обробка відповіді від сервера після створення коментаря
        //             console.log(data);
        //             // Оновлення інтерфейсу або інші дії в залежності від відповіді
        //         })
        //         .catch(error => {
        //             // Обробка помилок
        //             console.error('Помилка:', error);
        //         });
        // }

        // // Функція для отримання всіх коментарів
        // function getAllComments() {
        //     fetch('http://localhost/bose-nc/comments.php')
        //         .then(response => response.json())
        //         .then(comments => {
        //             // Обробка отриманих коментарів
        //             console.log(comments);
        //             // Оновлення інтерфейсу або інші дії в залежності від коментарів
        //             const commentsContainer = document.getElementById('commentsContainer');
        //             commentsContainer.innerHTML = '';

        //             const commentsHTML = comments.map(comment => `
        //                 <li>
        //                     <p>${comment.name}</p>
        //                     <p>${comment.comment}</p>
        //                     <span>${comment.created_at}</span>
        //                     <button onclick="deleteComment(${comment.comment_id})">Delete</button>
        //                 </li>
        //                 `).join('');

        //             commentsContainer.insertAdjacentHTML('beforeend', commentsHTML);
        //         })
        //         .catch(error => {
        //             // Обробка помилок
        //             console.error('Помилка:', error);
        //         });
        // }

        // // // Функція для видалення коментаря за його ID
        // // function deleteComment(commentId) {
        // //     fetch('http://localhost/bose-nc/comments.php', {
        // //             method: 'DELETE',
        // //             body: JSON.stringify({
        // //                 comment_id: commentId
        // //             })
        // //         })
        // //         .then(response => response.json())
        // //         .then(data => {
        // //             // Обробка відповіді від сервера після видалення коментаря
        // //             console.log('Обробка відповіді від сервера після видалення коментаря', data);
        // //             // Оновлення інтерфейсу або інші дії в залежності від відповіді
        // //         })
        // //         .catch(error => {
        // //             // Обробка помилок
        // //             console.error('Помилка:', error);
        // //         });
        // // }

        // function deleteComment(commentId) {
        //     fetch('http://localhost/bose-nc/comments.php', {
        //             method: 'DELETE',
        //             headers: {
        //                 'Content-Type': 'application/json'
        //             },
        //             body: JSON.stringify({
        //                 comment_id: commentId
        //             })
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             // Обробка відповіді від сервера після видалення коментаря
        //             console.log('Обробка відповіді від сервера після видалення коментаря', data);
        //             // Оновлення інтерфейсу або інші дії в залежності від відповіді
        //         })
        //         .catch(error => {
        //             // Обробка помилок
        //             console.error('Помилка:', error);
        //         });
        // }


        // // // Приклад використання функцій:
        // // // Додати новий коментар
        // // createComment('Ім\'я користувача', 'Текст коментаря');

        // // Отримати всі коментарі
        // getAllComments();

        // // Видалити коментар з певним ID
        // deleteComment(8); // Приклад ID коментаря для видалення
    </script>

</body>

</html>