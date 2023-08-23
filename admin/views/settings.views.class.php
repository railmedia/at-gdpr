<?php
class AT_GDPR_Admin_Settings_Views {

    function settings( $data = null ) {
        ob_start();
    ?>
    <div class="wrap atr-gdpr-settings">
        <h1><?php _e('AT GDPR Settings', 'oie-stripe'); ?></h1>
        <form action="<?php echo admin_url(); ?>/options.php" method="POST">
        <?php
            settings_fields('at_gdpr_settings');
            do_settings_sections('at_gdpr');
            submit_button();
        ?>
        </form>
    </div>
    <?php
        return ob_get_clean();
    }

    function markup( $type, $args ) {
        ob_start();

        switch( $type ) {
            case 'checkbox':
?>
        <input id="<?php echo $args['id']; ?>" name="<?php echo $args['id']; ?>" type="checkbox" <?php echo $args['value'] == 'on' ? 'checked="checked"' : ''; ?> />
<?php
            break;
            case 'select':

            if( $args['multiple'] ) {
                $fieldname = $args['id'] . '[]';
                $multiple = 'multiple="multiple"';
                $size = '20';
            } else {
                $fieldname = $args['id'];
                $multiple = '';
                $size = '';
            }
?>
        <select id="<?php echo $args['id']; ?>" name="<?php echo $fieldname; ?>" size="<?php echo $size; ?>" <?php echo $multiple; ?>>
        <?php
            foreach( $args['options'] as $value => $label ) {
                //var_dump($args['value']);
                if( is_array( $args['value'] ) ) {
                    $selected = in_array( $value, $args['value'] ) ? 'selected="selected"' : '';
                } else {
                    $selected = $value == $args['value'] ? 'selected="selected"' : '';
                }
        ?>
            <option <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $label; ?></option>
        <?php } ?>
        </select>
<?php
            break;
            case 'textarea':
?>
        <textarea id="<?php echo $args['id']; ?>" name="<?php echo $args['id']; ?>" style="width:100%; min-height:200px;"><?php echo $args['value']; ?></textarea>
<?php
            break;
            case 'text':
?>
        <input type="text" id="<?php echo $args['id']; ?>" name="<?php echo $args['id']; ?>" value="<?php echo $args['value']; ?>" />
<?php
            break;
            case 'editor':
        wp_editor( $args['value'], $args['id'] );
            break;
        }

        return ob_get_clean();
    }

}
?>
