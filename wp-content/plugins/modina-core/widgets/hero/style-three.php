<section class="hero-slide-wrapper hero-3">
    <div class="hero-slider-active slider-<?php echo $dynamic_id; ?> owl-theme owl-carousel">
    <?php if (!empty($hero_slides)) { $i = 0;
        foreach ($hero_slides as $item) { $i++; ?>
        <div class="single-slide bg-cover" style="background-image: url('<?php echo esc_url($item['hero_image']['url']); ?>')">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 offset-lg-2 text-center">
                        <div class="hero-contents">
                            <?php if( !empty($item['hero_heading'] ) ) : ?>
                            <h1 class="animated-text bg-heading"><?php echo htmlspecialchars_decode(esc_html($item['hero_heading'])); ?></h1>
                            <?php endif; ?>
                            <?php if( !empty($item['hero_text'] ) ) : ?>
                            <h4 class="mt-4 animated-text small-heading text-white"><?php echo htmlspecialchars_decode(esc_html($item['hero_text'])); ?></h4>
                            <?php endif; ?>

                            <?php if( !empty( $item['btn_link1']['url'] && $item['button_text1'] ) ) : ?>
                            <a href="<?php echo esc_url($item['btn_link1']['url']); ?>" <?php modina_is_external($item['btn_link1']); ?> <?php modina_is_nofollow($item['btn_link1']); ?> class="theme-btn animated-text animated-btn"><?php echo esc_html( $item['button_text1'] ); ?> <i class="fal fa-long-arrow-right"></i></a>
                            <?php endif; ?>
                            <?php if( !empty( $item['btn_link2']['url'] &&  $item['button_text2'] ) ) : ?>
                            <a href="<?php echo esc_url($item['btn_link2']['url']); ?>" <?php modina_is_external($item['btn_link2']); ?> <?php modina_is_nofollow($item['btn_link2']); ?> class="theme-btn animated-text animated-btn minimal-btn"><?php echo esc_html( $item['button_text2'] ); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }
    } ?>
    </div>
</section>