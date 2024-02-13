<?php
require_once __DIR__ . "../../actions/helpers.php";

$userId = getUserIdFromSession();
echo "<script>let userId = " . json_encode($userId) . ";</script>";
?>

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

                    const commentsHTML = comments.map(comment => {

                        const deleteButton = comment.authorized ? `<button class="coments-button" onclick="deleteComment(${comment.comment_id})">Delete</button>` : '';

                        return `
                        <li class="coments-child">
                            <div>
                                <p class="coments-child__name">${comment.name}</p>
                                <p class="coments-child__comment">${comment.comment}</p>
                            </div>
                            <div class="coments-child__block">
                                ${deleteButton}
                                <p class="coments-child__created_at">${comment.created_at}</p>
                            </div>
                        </li>`;
                    }).join('');

                    commentsContainer.innerHTML = commentsHTML;
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
            console.log('userId', userId)

            try {
                const response = await fetch('signin-signup/handleDeleteRequest.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        comment_id: commentId,
                        user_id: userId
                    }),
                });

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