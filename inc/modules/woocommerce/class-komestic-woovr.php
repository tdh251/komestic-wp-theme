<?php
defined( 'ABSPATH' ) || exit;

if ( !class_exists( 'WPClever_Woovr' ) || !class_exists( 'WC_Product' )  ) 
    return;

class Komestic_Woovr extends WPClever_Woovr {

    protected static $instance = null;
    protected $read_only = false;

    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function komestic_woovr_variations_form($product, $variation = false, $context = 'default', $allowed_terms = [], $read_only = false ) {
        $product_id = $product->get_id();
        $select_disabled = $read_only ? 'disabled' : '';
        $cache_id   = 'woovr_variations_form_' . $product_id;
        if ( ! self::enable_cache( $context ) || ( false === ( $variations_form = get_transient( $cache_id ) ) ) ) {
            ob_start();

            $unique_id          = uniqid( 'woovr_' . $product_id . rand() . '_' ); // compatible with WPC Product Bundles
            $active             = apply_filters( 'woovr_active', get_post_meta( $product_id, '_woovr_active', true ) ?: 'default', $product, $variation, $context );
            $show_clear         = apply_filters( 'woovr_show_clear', self::get_setting( 'show_clear', 'yes' ), $product, $variation, $context );
            $hide_unpurchasable = apply_filters( 'woovr_hide_unpurchasable', self::get_setting( 'hide_unpurchasable', 'no' ), $product, $variation, $context );

            // settings
            $selector          = apply_filters( 'woovr_default_selector', self::get_setting( 'selector', 'default' ), $product, $variation, $context );
            $orderby           = apply_filters( 'woovr_default_orderby', self::get_setting( 'orderby', 'default' ), $product, $variation, $context );
            $order             = apply_filters( 'woovr_default_order', self::get_setting( 'order', 'default' ), $product, $variation, $context );
            $show_name         = apply_filters( 'woovr_default_variation_name', self::get_setting( 'variation_name', 'formatted' ), $product, $variation, $context );
            $product_name      = apply_filters( 'woovr_default_product_name', self::get_setting( 'product_name', 'yes' ), $product, $variation, $context );
            $show_image        = apply_filters( 'woovr_default_show_image', self::get_setting( 'show_image', 'yes' ), $product, $variation, $context );
            $show_price        = apply_filters( 'woovr_default_show_price', self::get_setting( 'show_price', 'yes' ), $product, $variation, $context );
            $show_availability = apply_filters( 'woovr_default_show_availability', self::get_setting( 'show_availability', 'yes' ), $product, $variation, $context );
            $show_description  = apply_filters( 'woovr_default_show_description', self::get_setting( 'show_description', 'yes' ), $product, $variation, $context );
            $clear_label       = apply_filters( 'woovr_default_clear_label', self::get_setting( 'clear_label', esc_html__( 'Choose an option', 'komestic' ) ), $product, $variation, $context );
            $clear_image       = apply_filters( 'woovr_default_clear_image', self::get_setting( 'clear_image', 'placeholder' ), $product, $variation, $context );
            $clear_image_id    = apply_filters( 'woovr_default_clear_image_id', self::get_setting( 'clear_image_id', 0 ), $product, $variation, $context );

            if ( $active === 'yes' ) {
                // overwrite settings
                $selector          = get_post_meta( $product_id, '_woovr_selector', true ) ?: $selector;
                $orderby           = get_post_meta( $product_id, '_woovr_orderby', true ) ?: $orderby;
                $order             = get_post_meta( $product_id, '_woovr_order', true ) ?: $order;
                $show_name         = get_post_meta( $product_id, '_woovr_variation_name', true ) ?: $show_name;
                $show_image        = get_post_meta( $product_id, '_woovr_show_image', true ) ?: $show_image;
                $show_price        = get_post_meta( $product_id, '_woovr_show_price', true ) ?: $show_price;
                $show_availability = get_post_meta( $product_id, '_woovr_show_availability', true ) ?: $show_availability;
                $show_description  = get_post_meta( $product_id, '_woovr_show_description', true ) ?: $show_description;
                $clear_label       = ! empty( get_post_meta( $product_id, '_woovr_clear_label', true ) ) ? esc_html( get_post_meta( $product_id, '_woovr_clear_label', true ) ) : $clear_label;
                $clear_image       = get_post_meta( $product_id, '_woovr_clear_image', true ) ?: $clear_image;
                $clear_image_id    = get_post_meta( $product_id, '_woovr_clear_image_id', true ) ?: $clear_image_id;
            }

            if ( empty( $clear_label ) ) {
                $clear_label = esc_html__( 'Choose an option', 'komestic' );
            }

            // apply filters
            $clear_label       = apply_filters( 'woovr_clear_label', $clear_label, $product, $variation, $context );
            $clear_image       = apply_filters( 'woovr_clear_image', $clear_image, $product, $variation, $context );
            $clear_image_id    = apply_filters( 'woovr_clear_image_id', $clear_image_id, $product, $variation, $context );
            $selector          = apply_filters( 'woovr_selector', $selector, $product, $variation, $context );
            $orderby           = apply_filters( 'woovr_orderby', $orderby, $product, $variation, $context );
            $order             = apply_filters( 'woovr_order', $order, $product, $variation, $context );
            $show_name         = apply_filters( 'woovr_show_name', $show_name, $product, $variation, $context );
            $show_image        = apply_filters( 'woovr_show_image', $show_image, $product, $variation, $context );
            $show_price        = apply_filters( 'woovr_show_price', $show_price, $product, $variation, $context );
            $show_availability = apply_filters( 'woovr_show_availability', $show_availability, $product, $variation, $context );
            $show_description  = apply_filters( 'woovr_show_description', $show_description, $product, $variation, $context );

            // clear image src
            $clear_image_src = '';

            if ( $clear_image !== 'none' ) {
                $clear_image_src = wc_placeholder_img_src();

                if ( ( $clear_image === 'product' ) && ( $product_image_id = $product->get_image_id() ) ) {
                    $product_image   = wp_get_attachment_image_src( $product_image_id, self::$image_size );
                    $clear_image_src = $product_image[0];
                }

                if ( ( $clear_image === 'custom' ) && $clear_image_id ) {
                    $custom_image    = wp_get_attachment_image_src( $clear_image_id, self::$image_size );
                    $clear_image_src = $custom_image[0];
                }
            }

            $clear_image_src = apply_filters( 'woovr_clear_image_src', $clear_image_src, $product );

            // default attributes
            $df_attrs = [];

            if ( $variation ) {
                $df_attrs_o = $variation->get_attributes();
            } else {
                $df_attrs_o = $product->get_default_attributes();
            }

            foreach ( $df_attrs_o as $k => $v ) {
                $k_a              = 'attribute_' . str_replace( 'attribute_', '', $k );
                $df_attrs[ $k_a ] = $v;
            }

            // get default from URL
            $df_request = [];

            if ( isset( $_REQUEST ) ) {
                foreach ( $_REQUEST as $rk => $rv ) {
                    if ( str_starts_with( $rk, 'attribute_' ) ) {
                        $k_a                = 'attribute_' . str_replace( 'attribute_', '', $rk );
                        $df_request[ $k_a ] = wc_clean( stripslashes( urldecode( $rv ) ) );
                    }
                }
            }

            $df_attrs = array_merge( $df_attrs, $df_request );

            $children = apply_filters( 'woovr_get_children', $product->get_children(), $product );

            if ( ! empty( $children ) ) {
                // build children data
                $children_data = [];

                foreach ( $children as $child ) {
                    $child_product = wc_get_product( $child );

                    if ( ! $child_product || ! $child_product->variation_is_visible() ) {
                        continue;
                    }

                    if ( ( $hide_unpurchasable === 'yes' ) && ! self::is_purchasable( $child_product ) ) {
                        continue;
                    }

                    $attrs         = [];
                    $product_attrs = $product->get_attributes();
                    $child_attrs   = $child_product->get_attributes();

                    foreach ( $child_attrs as $k => $a ) {
                        if ( $a === '' ) {
                            if ( $product_attrs[ $k ]->get_id() ) {
                                foreach ( $product_attrs[ $k ]->get_terms() as $term ) {
                                    if ( ! empty( $allowed_terms ) && ! empty( $allowed_terms[ $k ] ) ) {
                                        if ( ! in_array( $term->slug, $allowed_terms[ $k ] ) ) {
                                            continue;
                                        }
                                    }

                                    $attrs[ 'attribute_' . $k ][] = $term->slug;
                                }
                            } else {
                                // custom attribute
                                foreach ( $product_attrs[ $k ]->get_options() as $option ) {
                                    if ( ! empty( $allowed_terms ) && ! empty( $allowed_terms[ $k ] ) ) {
                                        if ( ! in_array( $option, $allowed_terms[ $k ] ) ) {
                                            continue;
                                        }
                                    }

                                    $attrs[ 'attribute_' . $k ][] = $option;
                                }
                            }
                        } else {
                            if ( ! empty( $allowed_terms ) && ! empty( $allowed_terms[ $k ] ) ) {
                                if ( ! in_array( $a, $allowed_terms[ $k ] ) ) {
                                    continue 2;
                                }
                            }

                            $attrs[ 'attribute_' . $k ][] = $a;
                        }
                    }

                    $attrs = woovr_combinations( $attrs );

                    foreach ( $attrs as $attr ) {
                        $children_data[] = [
                            'id'      => $child,
                            'product' => $child_product,
                            'name'    => get_post_meta( $child, 'woovr_name', true ) ?: $child_product->get_formatted_name(),
                            'price'   => $child_product->get_price(),
                            'attrs'   => $attr
                        ];
                    }
                }

                $children_data = apply_filters( 'woovr_get_children_data', $children_data, $product );

                // order
                if ( is_string( $orderby ) && ! empty( $orderby ) && ( $orderby !== 'default' ) ) {
                    array_multisort( array_column( $children_data, $orderby ), SORT_ASC, $children_data );
                }

                if ( ! empty( $order ) && ( $order === 'desc' ) ) {
                    $children_data = array_reverse( $children_data );
                }

                $children_data = apply_filters( 'woovr_get_children_ordered_data', $children_data, $product );

                if ( ! empty( $children_data ) ) {
                    do_action( 'woovr_variations_above', $product );

                    echo '<div class="woovr-variations ' . esc_attr( 'woovr-variations-' . $selector ) . '" data-click="0" data-description="' . esc_attr( $show_description ) . '">';

                    do_action( 'woovr_variations_before', $product );
                    // should add a fieldset and legend
                    echo '<div class="woovr-variation woovr-variation-dropdown">';

                    if ( ( $selector === 'select' ) && ( $show_image === 'yes' ) ) {
                        echo '<div class="woovr-variation-image">' . apply_filters( 'woovr_clear_image', '<img src="' . esc_url( $clear_image_src ) . '"/>', $product ) . '</div>';
                    }

                    echo '<div class="woovr-variation-selector"><select ' . $select_disabled . ' class="woovr-variation-select pxl-nice-select" id="' . esc_attr( $unique_id ) . '">';

                    // show choose an option
                    if ( $show_clear === 'yes' ) {
                        $data_attrs = apply_filters( 'woovr_data_attributes_option_none', [
                            'id'            => 0,
                            'pid'           => $product_id,
                            'sku'           => '',
                            'purchasable'   => 'no',
                            'attrs'         => '',
                            'price'         => 0,
                            'regular-price' => 0,
                            'pricehtml'     => '',
                            'imagesrc'      => $show_image === 'yes' ? $clear_image_src : '',
                            'description'   => htmlentities( apply_filters( 'woovr_clear_description', '', $product ) ),
                            'availability'  => ''
                        ] );
                        echo '<option value="0" ' . self::data_attributes( $data_attrs ) . '>' . apply_filters( 'woovr_clear_name', $clear_label, $product ) . '</option>';
                    }

                    foreach ( $children_data as $child_data ) {
                        $child_id      = $child_data['id'];
                        $child_product = $child_data['product'];
                        $child_attrs   = htmlspecialchars( json_encode( $child_data['attrs'] ), ENT_QUOTES, 'UTF-8' );

                        // get name
                        if ( ( $custom_name = get_post_meta( $child_id, 'woovr_name', true ) ) && ! empty( $custom_name ) ) {
                            $child_name = $custom_name;
                        } else {
                            $child_name_arr = [];

                            foreach ( $child_data['attrs'] as $k => $a ) {
                                if ( $t = get_term_by( 'slug', $a, str_replace( 'attribute_', '', $k ) ) ) {
                                    $n = $t->name;
                                } elseif ( $t = get_term_by( 'name', $a, str_replace( 'attribute_', '', $k ) ) ) {
                                    $n = $t->name;
                                } else {
                                    $n = $a;
                                }

                                if ( $show_name === 'formatted_label' ) {
                                    $child_name_arr[] = wc_attribute_label( str_replace( 'attribute_', '', $k ), $product ) . ': ' . $n;
                                } else {
                                    $child_name_arr[] = $n;
                                }
                            }

                            $child_name = implode( ' <span>/</span> ', $child_name_arr );

                            if ( $product_name === 'yes' ) {
                                $child_name = $product->get_name() . ' – ' . $child_name;
                            }
                        }

                        // get image
                        if ( $child_product->get_image_id() && ( $child_image = wp_get_attachment_image_src( $child_product->get_image_id(), self::$image_size ) ) ) {
                            $child_image_src = $child_image[0];
                        } else {
                            $child_image_src = wc_placeholder_img_src();
                        }

                        // custom image
                        if ( ( $child_image_id = get_post_meta( $child_id, 'woovr_image_id', true ) ) && ( $child_image = wp_get_attachment_image_src( absint( $child_image_id ), self::$image_size ) ) ) {
                            $child_image_src = $child_image[0];
                        } elseif ( get_post_meta( $child_id, 'woovr_image', true ) ) {
                            $child_image_src = esc_url( get_post_meta( $child_id, 'woovr_image', true ) );
                        }

                        $child_image_src = esc_url( apply_filters( 'woovr_variation_image_src', $child_image_src, $child_product ) );

                        // get info
                        $child_info = '';

                        if ( $show_price === 'yes' ) {
                            $child_info .= '<span class="woovr-variation-price">' . apply_filters( 'woovr_variation_price', $child_product->get_price_html(), $child_product ) . '</span>';
                        }

                        if ( $show_availability === 'yes' ) {
                            $child_info .= '<span class="woovr-variation-availability">' . apply_filters( 'woovr_variation_availability', wc_get_stock_html( $child_product ), $child_product ) . '</span>';
                        }

                        if ( $show_description === 'yes' ) {
                            $child_info .= '<span class="woovr-variation-description">' . apply_filters( 'woovr_variation_description', $child_product->get_description(), $child_product ) . '</span>';
                        }

                        $data_attrs = apply_filters( 'woovr_data_attributes', [
                            'id'            => $child_id,
                            'pid'           => $product_id,
                            'sku'           => $child_product->get_sku(),
                            'purchasable'   => self::is_purchasable( $child_product ) ? 'yes' : 'no',
                            'attrs'         => $child_attrs,
                            'price'         => wc_get_price_to_display( $child_product ),
                            'regular-price' => wc_get_price_to_display( $child_product, [ 'price' => $child_product->get_regular_price() ] ),
                            'pricehtml'     => htmlentities( $child_product->get_price_html() ),
                            'imagesrc'      => $show_image === 'yes' ? $child_image_src : '',
                            'description'   => htmlentities( apply_filters( 'woovr_variation_info', $child_info, $child_product ) ),
                            'availability'  => htmlentities( wc_get_stock_html( $child_product ) )
                        ], $child_product );
                        $diff_attrs = array_diff( $child_data['attrs'], $df_attrs ); // find selected option

                        echo '<option value="' . esc_attr( $child_id ) . '" ' . self::data_attributes( $data_attrs ) . ' ' . esc_attr( empty( $diff_attrs ) ? 'selected' : '' ) . '>' . apply_filters( 'woovr_variation_name', $child_name, $child_product ) . '</option>';
                    }

                    echo '</select></div><!-- /woovr-variation-selector -->';

                    if ( ( $selector === 'select' ) && ( $show_price === 'yes' ) ) {
                        echo '<div class="woovr-variation-price"></div>';
                    }

                    echo '</div><!-- /woovr-variation -->';

                    do_action( 'woovr_variations_after', $product );

                    echo '</div><!-- /woovr-variations -->';

                    do_action( 'woovr_variations_below', $product );
                }
            }

            $variations_form = ob_get_clean();

            if ( self::enable_cache( $context ) ) {
                set_transient( $cache_id, $variations_form, 24 * HOUR_IN_SECONDS );
            }
        }

        echo apply_filters( 'woovr_variations_form', $variations_form, $product, $variation, $context, $allowed_terms );
    }

}