<?php
extract( shortcode_atts( array(
    'color' 	=> '',
    'el_class'	=> '',
    'el_id'     => ''
), $atts ) );

$elementClass = 'fugu-message-box ' . $color . $this->getExtraClass( $el_class );

$iconClass = 'fugu-font fugu-font-textsms flip';

switch ( $color ) {
    case 'warning':
        $iconClass = 'fugu-font fugu-font-textsms flip';
        break;
    case 'success':
        $iconClass = 'fugu-font fugu-font-thumb-up';
        break;
    case 'danger':
        $iconClass = 'fugu-font fugu-font-thumb-down';
        break;
    default:
        break;
}

$wrapper_attributes = array();

$wrapper_attributes[] = 'class="' . $elementClass . '"';

if ( ! empty( $el_id ) ) {
    $wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

$output = '
    <div ' . implode( ' ', $wrapper_attributes ) . '>
        <div class="fugu-message-box-icon"><i class="' . esc_attr( $iconClass ) . '"></i></div>
        <div class="fugu-message-box-text">' . $content . '</div>
    </div>';

echo $output; // Escaped
