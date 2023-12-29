<section class="footer-container">
    <div class="footer-img"></div>
</section>
<footer class="container">
    <div class="footer-block">
        <div>
            <h2 class="footer-title general-title">FEEDBACK</h2>
            <p class="footer-text">We'll help you find the right headphones for you.</p>
        </div>

        <form id="form" class="footer-form" method="post" action="sendmail.php">
            <label class="form-label" for="">
                <input class="form-input _req" type="text" placeholder="Your name" name="name">
            </label>
            <label class="form-label" for="">
                <input class="form-input _req" type="email" placeholder="Your e-mail" name="email">
            </label>
            <label class="form-label" for="">
                <textarea class="form-input form-textarea" cols="30" rows="10" placeholder="Send us a message" name="comment"></textarea>
            </label>

            <div class="form-checkbox">
                <input class="form-checkbox--input _req" type="checkbox" id="checkbox" value="agree" name="agree">
                <label class="form-checkbox--label" for="checkbox">
                    <div class="form-checkbox--icon">
                        <svg class="form-checkbox--svg">
                            <use href="images.svg/symbol-defs-galka.svg#icon-galka"></use>
                        </svg>
                    </div>
                    <p class="checkbox-text">I agree to the <span class="privacy-policy"><a href="#">privacy policy</a></span></p>
                </label>
            </div>

            <button class="form-button" type="submit">SEND</button>
        </form>

    </div>

    <div class="general-footer--block">
        <div class="footer-block--list">
            <ul class="footer-children">
                <li>
                    <p>Characteristics</p>
                </li>
                <li>
                    <p>History</p>
                </li>
                <li>
                    <p>Reviews</p>
                </li>
            </ul>
            <ul class="footer-children footer-right">
                <li>
                    <p>Payment and delivery</p>
                </li>
                <li>
                    <p>Store addresses</p>
                </li>
                <li>
                    <p>FAQ</p>
                </li>
            </ul>
        </div>
        <p class="footer-number">8 (800) 111-11-11</p>
    </div>
</footer>

<script src="js/burger.js"></script>
<script src="js/FAQ.js"></script>
<script src="js/bose-checkbox.js"></script>
<script src="js/bose-modal.js"></script>
<script src="https://hammerjs.github.io/dist/hammer.min.js"></script>
<script src="js/reviews-slider.js"></script>
<script src="js/form-mail.js"></script>

</body>

</html>