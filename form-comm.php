<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>bose</title>
    <!-- <link rel="stylesheet" href="styles/styles.css"> -->
</head>

<body>

    <form class="comments-form" action="comments.php" method="post">
        <input type="text" placeholder="Name" name="name">
        <textarea cols="30" rows="10" placeholder="Comment" name="comment"></textarea>
        <button type="submit">Send</button>
    </form>

    <ul class="comments-container" id="commentsContainer"></ul>

    <script>
        async function displayComments() {
            try {
                const response = await fetch('comments.php', {
                    method: 'GET'
                });

                if (response.ok) {
                    const comments = await response.json();
                    let commentsContainer = document.getElementById('commentsContainer');

                    const commentsHTML = comments.map(comment => `
                        <li>
                            <p>${comment.name}</p>
                            <p>${comment.comment}</p>
                            <span>${comment.created_at}</span>
                            <button>Delete</button>
                        </li>
                    `).join('');

                    commentsContainer.insertAdjacentHTML('beforeend', commentsHTML);

                } else {
                    throw new Error('Network response was not ok.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Помилка');
            }
        }

        // Обробник події для форми
        const commentsForm = document.querySelector('.comments-form');

        commentsForm.addEventListener('submit', async function(event) {
            event.preventDefault(); // Заборона стандартної відправки форми

            try {
                const formData = new FormData(this);
                const response = await fetch('comments.php', {
                    method: 'POST',
                    body: formData
                });

                if (response.ok) {
                    // Виклик функції відображення коментарів після успішного відправлення
                    displayComments();
                    this.reset(); // Очищення форми
                } else {
                    throw new Error('Network response was not ok.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Помилка');
            }
        });

        // Виклик функції для відображення коментарів при завантаженні сторінки
        displayComments();
    </script>

</body>

</html>