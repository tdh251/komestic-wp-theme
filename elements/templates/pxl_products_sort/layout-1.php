<?php 
$sort_value = isset($_GET['sort']) ? $_GET['sort'] : '';
?>
<div class="pxl-widget product-sort">
    <form id="form-sort" class="form" method="GET">
        <select id="product-sort-select" name="order" class="form__field sort pxl-nice-select">
            <option value=""><?php echo esc_html__('Default Sorting', 'komestic'); ?></option>
            <option value="featured">
                <?php echo esc_html__('Featured', 'komestic'); ?>
            </option>
            <option value="best-selling">
                <?php echo esc_html__('Best Selling', 'komestic'); ?>
            </option>
            <option value="title-asc">
                <?php echo esc_html__('Alphabetically, A-Z', 'komestic'); ?>
            </option>
            <option value="title-desc">
                <?php echo esc_html__('Alphabetically, Z-A', 'komestic'); ?>
            </option>
            <option value="price-asc" >
                <?php echo esc_html__('Price, Low To Hight', 'komestic'); ?>
            </option>
            <option value="price-desc" >
                <?php echo esc_html__('Price, Hight To Low', 'komestic'); ?>
            </option>
            <option value="date-asc" >
                <?php echo esc_html__('Date, old to new', 'komestic'); ?>
            </option>
            <option value="date-desc" >
                <?php echo esc_html__('Date, new to old', 'komestic'); ?>
            </option>
        </select>
    </form>
</div>