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
                            
                        </li>
                    `).join('');

                    // <button class = "delete-comment" data - comment - id = "1" > Delete </button>

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

        // document.addEventListener('DOMContentLoaded', function() {
        //     // Знайдіть всі кнопки видалення
        //     const deleteButtons = document.querySelectorAll('.delete-comment');
        //     console.log('deleteButtons', deleteButtons);

        //     // Додайте слухача подій для кожної кнопки видалення
        //     deleteButtons.forEach(button => {
        //         button.addEventListener('click', async (event) => {
        //             const commentId = event.target.dataset.commentId; // Отримайте ідентифікатор коментаря з атрибута data-comment-id
        //             console.log('commentId', commentId);

        //             try {
        //                 const response = await fetch(`comments.php?comment_id=${commentId}`, {
        //                     method: 'DELETE'
        //                 });

        //                 if (response.ok) {

        //                     // Викликайте функцію displayComments() для оновлення списку коментарів після видалення
        //                     displayComments();
        //                 } else {
        //                     throw new Error('Network response was not ok.');
        //                 }
        //             } catch (error) {
        //                 console.error('Error:', error);
        //                 alert('Помилка');
        //             }
        //         });
        //     });
        // });








        document.addEventListener('DOMContentLoaded', function() {
            // Функція для створення кнопки видалення
            function createDeleteButton(commentId) {
                const li = document.createElement('li');
                const button = document.createElement('button');
                button.classList.add('delete-comment');
                button.textContent = 'Delete';
                button.dataset.commentId = commentId;

                button.addEventListener('click', async (event) => {
                    const commentId = event.target.dataset.commentId;

                    try {
                        const response = await fetch(`comments.php?comment_id=${commentId}`, {
                            method: 'DELETE'
                        });

                        if (response.ok) {
                            console.log('response', response);
                            // Викликайте функцію displayComments() для оновлення списку коментарів після видалення
                            displayComments();
                        } else {
                            throw new Error('Network response was not ok.');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Помилка');
                    }
                });

                // Отримайте елемент, куди бажаєте додати кнопку видалення та додайте її
                const commentsList = document.getElementById('xxxxxxx');
                li.appendChild(button);
                commentsList.appendChild(li);
            }

            // Потім ви можете викликати функцію для створення кнопки, передавши відповідний ідентифікатор коментаря
            createDeleteButton('1');
        });
    </script>

</body>

</html>