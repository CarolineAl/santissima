<?php get_header() ?>

    <div id="content" class="no-content">

        <div class="container">

            <section class="page-not-found">
                <div class="row">
                    <?php if ($porto_settings['error-block']) : ?>
                    <div class="col-md-4">
                        <?php echo do_shortcode('[porto_block name="' . $porto_settings['error-block'] . '"]') ?>
                    </div>
                    <?php endif; ?>
                </div>
            </section>

        </div>
    
    </div>

<?php get_footer() ?>