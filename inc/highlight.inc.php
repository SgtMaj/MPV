<div id="highlight">
    <div id="highlight-container">
    <?php if ($highlight) : ?>
        <!-- http://www.creativejuiz.fr/trytotry/juizy-slideshow-full-css3-html5/ -->
        <div id="slideshow">
            <div id="slider">
                <figure id="slide-0" class="slide">
                    <img src="img/slide.jpg" alt="" />
                    <figcaption>
                        <strong>Website Design</strong>
                        Pellentesque habitant morbi tristique senectus et netus. Praesent in augue eleifend lacus dictum dapibus sit amet porttitor sem.
                    </figcaption>
                </figure>

                <figure id="slide-1" class="slide">
                    <img src="img/slide.jpg" alt="" />
                    <figcaption>
                        <strong>Aliquam Dictum</strong>
                        Praesent in augue eleifend lacus dictum dapibus sit amet porttitor sem. Pellentesque habitant morbi tristique senectus et netus.
                    </figcaption>
                </figure>
            </div>

            <div id="slideshow-navigation">
                <span class="bullet current"></span>
                <span class="bullet"></span>
                <span class="bullet"></span>
                <span class="bullet"></span>
                <span class="bullet"></span>
            </div>
        </div>
    <?php else : ?>
        <h3><?php echo ucwords($page); ?></h3>
    <?php endif; ?>
    </div>
</div>