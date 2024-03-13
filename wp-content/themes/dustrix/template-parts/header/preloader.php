<?php
$opt = get_option('dustrix_opt');
$preloader_title = !empty($opt['preloader_title']) ? strtoupper($opt['preloader_title']) : strtoupper(get_bloginfo('name'));
$preloader_title_arr = str_split($preloader_title);
?>
<div id="preloader" class="preloader">
    <div class="animation-preloader">
        <div class="spinner">                
        </div>
        <div class="txt-loading">
        <?php
            if(is_array($preloader_title_arr)) {
                foreach ($preloader_title_arr as $pt_ti) {
                    ?>
                    <span data-text-preloader="<?php echo esc_attr($pt_ti) ?>" class="letters-loading">
                        <?php echo esc_html($pt_ti) ?>
                    </span>
                    <?php
                }
            }
        ?>
        </div>
        <?php if(!empty($opt['loading_text'])) : ?>
            <p class="text-center"><?php echo esc_html($opt['loading_text']); ?></p>
        <?php endif; ?>
    </div>
    <div class="loader">
        <div class="row">
            <div class="col-3 loader-section section-left">
                <div class="bg"></div>
            </div>
            <div class="col-3 loader-section section-left">
                <div class="bg"></div>
            </div>
            <div class="col-3 loader-section section-right">
                <div class="bg"></div>
            </div>
            <div class="col-3 loader-section section-right">
                <div class="bg"></div>
            </div>
        </div>
    </div>
</div>