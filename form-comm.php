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

    <div class="comments-container" id="commentsContainer"></div>

    <script>
        function displayComments() {
            let xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    let responseString = xhr.responseText;
                    let responseObject = {};

                    if (responseString.trim() !== '') {
                        responseObject = JSON.parse(responseString);
                    }

                    let commentsContainer = document.getElementById('commentsContainer');
                    commentsContainer.innerHTML = '';

                    if (responseObject.hasOwnProperty('message')) {
                        let commentDiv = document.createElement('div');
                        commentDiv.textContent = responseObject.message;
                        commentsContainer.appendChild(commentDiv);
                    } else {
                        responseObject.forEach(function(comment) {
                            let commentDiv = document.createElement('div');
                            commentDiv.textContent = comment.name + ': ' + comment.comment;
                            commentsContainer.appendChild(commentDiv);
                        });
                    }
                }
            };

            xhr.open('GET', 'comments.php', true);
            xhr.send();
        }

        displayComments();
    </script>

</body>

</html>