<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . "../../componets/head.php"; ?>

<body>

    <section class="container-comments">
        <form class="comments-form" action="comments.php" method="post">
            <input id="nameInput" type="text" placeholder="Name" name="name">
            <textarea cols="30" rows="10" placeholder="Comment" name="comment"></textarea>
            <button type="submit">Publish</button>
        </form>

        <ul class="comments-container" id="commentsContainer"></ul>

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
                    const commentsContainer = document.getElementById('commentsContainer');
                    commentsContainer.innerHTML = '';

                    // console.log(comments.map(comment => comment.comment_id));


                    const commentsHTML = comments.map(comment => `
                        <li>
                            <p>${comment.name}</p>
                            <p>${comment.comment}</p>
                            <span>${comment.created_at}</span>
                            <button onclick="deleteComment(${comment.comment_id})">Delete</button>
                        </li>
                    `).join('');

                    // console.log('comment.comment_id', comment.comment_id)

                    // <button onclick="deleteComment(${comment.comment_id})">Delete</button>
                    // <button class="delete-comment" data-comment-id="${comment.comment_id}">Delete</button>

                    commentsContainer.insertAdjacentHTML('beforeend', commentsHTML);
                    // commentsContainer.innerHTML = commentsHTML;
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

        // Оновлена функція deleteComment
        async function deleteComment(commentId) {
            try {
                const response = await fetch(`comments.php?comment_id=${commentId}`, {
                    method: 'DELETE'
                });

                console.log('commentId', commentId)

                if (response.ok) {
                    // Викликайте функцію displayComments() для оновлення списку коментарів після видалення
                    displayComments();
                } else {
                    throw new Error('Network response was not ok.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Помилка');
            }
        }
    </script>

</body>

</html>