<?php
/**
 * The template for displaying the footer.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>

</div>
</div>

<?php
/**
 * generate_before_footer hook.
 *
 * @since 0.1
 */
do_action( 'generate_before_footer' );
?>

<div <?php generate_do_attr( 'footer' ); ?>>
    <?php
    /**
     * generate_before_footer_content hook.
     *
     * @since 0.1
     */
    do_action( 'generate_before_footer_content' );
    ?>
        
    <div class="grid-container">
    <div class="custom-footer">
        <div class="left-column">
            <?php
            echo '<a href="/"><img src="https://casinothai.vip/wp-content/uploads/2024/04/casinothaivip.svg" width="200" alt="CasinoThai.vip footer logo"></a>';
            echo '<p>CasinoThai.vip - แหล่งข้อมูลอันดับหนึ่งของคุณสำหรับรีวิวคาสิโนออนไลน์และโบนัสพิเศษที่ออกแบบมาเฉพาะสำหรับผู้เล่นชาวไทย เราสำรวจลึกลงไปในเว็บไซต์การพนันออนไลน์เพื่อให้คำแนะนำที่ซื่อสัตย์และโปร่งใส ดังนั้นผู้เล่นชาวไทยจึงสามารถมีประสบการณ์คาสิโนออนไลน์ที่ดีที่สุดได้ ตรวจสอบเนื้อหาและโปรโมชั่นที่อัปเดตอยู่เสมอ.</p>';
            ?>
            <div class="socials">
              <a href="https://x.com/casinothaivip"><img src="https://casinothai.vip/wp-content/uploads/2024/05/x-footer-icon-1.svg" alt="CasinoThai.vip on X"></a>
                <a href="https://www.facebook.com/casinothaivip"><img src="https://casinothai.vip/wp-content/uploads/2024/05/fb.svg" alt="CasinoThai.vip on Facebook"></a>
              <a href="https://line.me/ti/p/~@casinothaivip"><img src="https://casinothai.vip/wp-content/uploads/2024/04/line-logo.svg" alt="CasinoThai.vip on Line"></a>
              <a href="https://t.me/casinothaivip"><img src="https://casinothai.vip/wp-content/uploads/2024/05/telegram.svg" alt="CasinoThai.vip on Telegram"></a>
            </div>
        </div>
        <div class="right-column">
          <div class="right-column-inner-1">
            <?php
            // Register and display your four footer widgets here.
            if ( is_active_sidebar( 'footer-1' ) ) dynamic_sidebar( 'footer-1' );
            if ( is_active_sidebar( 'footer-2' ) ) dynamic_sidebar( 'footer-2' );
            ?>
            </div>

            <div class="right-column-inner-2">
            <?php
            if ( is_active_sidebar( 'footer-3' ) ) dynamic_sidebar( 'footer-3' );
            if ( is_active_sidebar( 'footer-4' ) ) dynamic_sidebar( 'footer-4' );
            ?>
            </div>
        </div>
    </div>
    </div>
    <div class="site-info">ลิขสิทธิ์ © <?php echo date('Y'); ?> CasinoThai.vip. สงวนลิขสิทธิ์ทุกประการ.</div>
    <?php
    /**
     * generate_after_footer_content hook.
     *
     * @since 0.1
     */
    do_action( 'generate_after_footer_content' );
    ?>
</div>

<?php
/**
 * generate_after_footer hook.
 *
 * @since 2.1
 */
do_action( 'generate_after_footer' );

wp_footer();
?>
</body>
</html>