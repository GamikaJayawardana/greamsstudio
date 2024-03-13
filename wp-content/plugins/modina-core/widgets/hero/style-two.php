<section class="hero-slider hero-2">
    <div class="hero-slider-active slider-<?php echo $dynamic_id; ?> owl-carousel owl-theme">
    <?php if (!empty($hero_slides)) { $i = 0;
        foreach ($hero_slides as $item) { $i++; ?>
        <div class="single-slide bg-cover" style="background-image: url('<?php echo esc_url($item['hero_image']['url']); ?>')">
            <div class="container">
                <div class="row">
                    <div class="col-12 pe-lg-5 col-xxl-7 col-lg-10">
                        <div class="hero-contents pe-lg-3">
                            <h1 class="animated-text bg-heading"><?php echo htmlspecialchars_decode(esc_html($item['hero_heading'])); ?></h1>
                            <?php if( !empty($item['hero_text'] ) ) : ?>
                            <p class="pe-lg-5 animated-text small-heading"><?php echo htmlspecialchars_decode(esc_html($item['hero_text'])); ?></p>
                            <?php endif; ?>
                            <?php if( !empty( $item['btn_link1']['url'] && $item['button_text1'] ) ) : ?>
                            <a href="<?php echo esc_url($item['btn_link1']['url']); ?>" <?php modina_is_external($item['btn_link1']); ?> <?php modina_is_nofollow($item['btn_link1']); ?> class="theme-btn me-4 animated-text animated-btn"><?php echo esc_html( $item['button_text1'] ); ?> <i class="fal fa-long-arrow-right"></i></a>
                            <?php endif; ?>
                            <?php if( !empty( $item['btn_link2']['url'] &&  $item['button_text2'] ) ) : ?>
                            <a href="<?php echo esc_url($item['btn_link2']['url']); ?>" <?php modina_is_external($item['btn_link2']); ?> <?php modina_is_nofollow($item['btn_link2']); ?> class="theme-btn animated-text animated-btn"><?php echo esc_html( $item['button_text2'] ); ?></a>
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
