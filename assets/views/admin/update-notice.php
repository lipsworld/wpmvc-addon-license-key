<?php
/**
 * Available update notice.
 *
 * @author Cami Mostajo
 * @package WPMVC\Addons\LicenseKey
 * @license MIT
 * @version 1.0.5
 */
?>
<div class="notice notice-warning">
    <p>
        <?= sprintf(
            __( 'New update available for %s <strong>%s</strong>.', 'addon' ),
            $main->config->get( 'type' ),
            $main->config->get( 'license_api.name' )
        ) ?>
    </p>
    <p>
        <?php $main->addon_updater_button(
            $license_key->data->downloadable->url,
            'button-primary'
        ) ?>
    </p>
</div>