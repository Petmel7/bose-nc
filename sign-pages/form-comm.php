<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . "../../componets/head.php"; ?>

<body>

    <section class="container-comments">
        <form class="comments-form" action="signin-signup/comments.php" method="post">
            <input id="nameInput" type="text" placeholder="Name" name="name">
            <textarea cols="30" rows="10" placeholder="Comment" name="comment"></textarea>
            <button type="submit">Publish</button>
        </form>

        <ul class="comments-container" id="commentsContainer"></ul>

    </section>

    <script>
        const commentsForm = document.querySelector('.comments-form');

        commentsForm.addEventListener('submit', async function(event) {
            event.preventDefault();

            try {
                const formData = new FormData(this);
                const response = await fetch('signin-signup/handlePostRequest.php', {
                    method: 'POST',
                    body: formData
                });

                if (response.ok) {
                    displayComments();
                    this.reset();

                    alert(`Коментар успішно додано!`);
                } else {
                    throw new Error('Network response was not ok.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Помилка');
            }
        });
    </script>

    <script>
        async function displayComments() {
            try {
                const response = await fetch('signin-signup/handleGetRequest.php', {
                    method: 'GET'
                });

                if (response.ok) {
                    const comments = await response.json();
                    const commentsContainer = document.getElementById('commentsContainer');
                    commentsContainer.innerHTML = '';

                    const commentsHTML = comments.map(comment => `
                        <li>
                            <p>${comment.name}</p>
                            <p>${comment.comment}</p>
                            <span>${comment.created_at}</span>
                            <button onclick="deleteComment(${comment.comment_id})">Delete</button>
                        </li>
                    `).join('');

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
        displayComments();
    </script>

    <script>
        async function deleteComment(commentId) {
            try {
                const response = await fetch(`signin-signup/handleDeleteRequest.php?comment_id=${commentId}`, {
                    method: 'POST'
                });

                console.log('commentId', commentId)

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
    </script>

</body>

</html>