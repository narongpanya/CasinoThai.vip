<?php
/**
 * Front Page Template
 */

// Add custom body class to the head
add_filter( 'body_class', 'add_body_class' );
function add_body_class( $classes ) {
    $classes[] = 'front-page';
    return $classes;
}

get_header();

?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <!-- Get Started Section -->
        <section class="get-started">
            <div class="wrap">
                <?php
                // Manual translation array
                $months_thai = [
                    'January' => 'มกราคม',
                    'February' => 'กุมภาพันธ์',
                    'March' => 'มีนาคม',
                    'April' => 'เมษายน',
                    'May' => 'พฤษภาคม',
                    'June' => 'มิถุนายน',
                    'July' => 'กรกฎาคม',
                    'August' => 'สิงหาคม',
                    'September' => 'กันยายน',
                    'October' => 'ตุลาคม',
                    'November' => 'พฤศจิกายน',
                    'December' => 'ธันวาคม'
                ];

                $current_month = date('F'); // Get the current month in English
                $current_year = date('Y'); // Get the current year

                // Translate the month to Thai and combine it with the year
                $current_month_year = $months_thai[$current_month] . ' ' . $current_year;

                ?>


                <h2>คาสิโนออนไลน์ที่ดีที่สุดในปี <?php echo $current_month_year; ?></h2>
                <small class="disclaimer"><strong>ข้อจำกัดความรับผิดชอบ:</strong> CasinoThai.vip ใช้ลิงก์พันธมิตรเพื่อแนะนำข้อเสนอคาสิโน หากคุณเยี่ยมชมและฝากเงินผ่านลิงก์เหล่านี้ เราจะได้รับค่าคอมมิชชั่นโดยไม่มีค่าใช้จ่ายเพิ่มเติมจากคุณ อย่างไรก็ตาม รีวิวและคำแนะนำของเรายังคงเป็นกลาง โดยปฏิบัติตามมาตรฐานบรรณาธิการอิสระและวิธีการวิชาชีพ</small>
                <ul class="casino-list">
                <?php
                $args = array(
                  'post_type' => 'casino',
                  'posts_per_page' => -1
                );
                $query = new WP_Query($args);

                $casinos = array();

                while ($query->have_posts()) {
                  $query->the_post();
                  $post_id = get_the_ID();

                  $casino_logo = get_field('casino_logo');
                  if ($casino_logo) {
                    $casino_logo_url = $casino_logo['url'];
                    $casino_logo_alt = $casino_logo['alt'];
                  }

                  $casinos[] = array(
                    'post_id' => $post_id,
                    'casino_logo_url' => $casino_logo_url,
                    'casino_logo_alt' => $casino_logo_alt,
                    'casino_name' => get_field('casino_name'),
                    'link_to_casino' => get_field('link_to_casino'),
                    'welcome_bonus' => get_field('welcome_bonus'),
                    'promo_code' => get_field('promo_code'),
                    'year_established' => get_field('year_established'),
                    'games' => get_field('games'),
                    'rating' => get_field('rating'),
                    'deposit_methods' => get_field('deposit_methods'),
                    'withdrawal_methods' => get_field('withdrawal_methods'),
                    'pros' => get_field('pros'),
                    'permalink' => get_permalink(),
                  );
                }

                // Sort casinos by rating, highest first
                usort($casinos, function($a, $b) {
                  return $b['rating'] - $a['rating'];
                });

                wp_reset_postdata();
                ?>

                <?php foreach ($casinos as $casino) : 
                $radius = 31.5;
                $circumference = 2 * M_PI * $radius;
                $filledLength = ($casino['rating'] / 100) * $circumference;
                $emptyLength = $circumference - $filledLength;
                ?>
                <li class="casino-item">
                  <div class="casino-item-upper">
                    <div class="casino-logo">
                      <a href="<?php echo esc_url($casino['link_to_casino']); ?>" target="_blank">
                        <img src="<?php echo esc_url($casino['casino_logo_url']); ?>" alt="<?php echo esc_attr($casino['casino_logo_alt']); ?>" title="<?php echo esc_attr($casino['casino_name']); ?>">
                      </a>
                    </div>
                    <div class="casino-info">
                      <span class="aggr-title">โบนัสต้อนรับ</span>
                      <div class="bonuses">
                        <div class="welcome-bonus"><?php echo esc_html($casino['welcome_bonus']); ?></div>
                      </div>
                    </div>

                    <div class="casino-rating">
                      <span class="aggr-title">คะแนน</span>
                      <svg width="72" height="70" viewPort="0 0 72 70" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <circle r="31.5" cx="36" cy="35" fill="transparent" stroke="#ddd" stroke-width="7"/>
                        <circle r="31.5" cx="36" cy="35" fill="transparent" stroke="#86ff95" stroke-width="7"
                                stroke-dasharray="<?= $filledLength ?> <?= $emptyLength ?>"
                                stroke-dashoffset="0"
                                transform="rotate(-90 36 35)"/>
                        <text x="50%" y="54%" text-anchor="middle" fill="black" font-size="14px"><?= number_format($casino['rating'], 0) ?>%</text>
                      </svg>
                    </div>

                    <div class="play-now">
                      <div class="link-to-casino">
                        <a href="<?php echo esc_url($casino['link_to_casino']); ?>" target="_blank">เล่นเลย</a>
                      </div>
                      <div class="play-now-lower">
                      <div class="banking-methods">
                        <?php
                        if ($casino['deposit_methods']) {
                          $display_limit = 5;
                          $total_methods = count($casino['deposit_methods']);
                          $additional_methods = $total_methods - $display_limit;

                          foreach ($casino['deposit_methods'] as $index => $method) {
                            if ($index >= $display_limit) {
                              break;
                            }
                            $method_lowercase = strtolower($method);
                            $method_dashed = str_replace(' ', '-', $method_lowercase);
                            echo '<div class="payment-img-holder">';
                            echo '<img src="' . '/wp-content/uploads/2024/05/' . $method_dashed . '.svg" alt="' . esc_attr($method) . ' Logo" title="' . esc_attr($method) . '">';
                            echo '</div>';
                          }

                          if ($additional_methods > 0) {
                            echo '<div class="additional-methods expand-left" title="' . implode(', ', array_slice($casino['deposit_methods'], $display_limit)) . '">+' . $additional_methods . '</div>';
                          }
                        }
                        ?>
                      </div>
                      <div class="link-to-review">
                        <a href="<?php echo esc_url($casino['permalink']); ?>">อ่านรีวิว</a>
                      </div>
                      <button class="more-details-mobile">
                        <span class="plus-icon">ดูเพิ่มเติม+</span>
                      </button>
                    </div>
                    </div>
                  </div>
                  <button class="more-details">
                    <span class="plus-icon">+</span>
                  </button>
                  <div class="additional-info">
                    <div class="border"><hr></div>
                    <div class="flexbox-grid">
                      <div class="column pros">
                        <ul>
                          <?php
                          if ($casino['pros']) {
                            foreach ($casino['pros'] as $pro) {
                              echo '<li>' . esc_html($pro['pro']) . '</li>';
                            }
                          }
                          ?>
                        </ul>
                      </div>
                      <div class="column details">
                        <div class="box-upper">
                          <div class="year-established ezbox"><div class="attribute-name">ปีที่ก่อตั้ง:</div><?php echo esc_html($casino['year_established']); ?></div>
                        </div>
                        <div class="box-lower">
                        <div class="promo-code ezbox">
                          <div class="attribute-name">รหัสโปรโมชั่น:</div>
                            <?php
                            if (!empty($casino['promo_code']) && $casino['promo_code'] !== 'N/A') {
                            echo esc_html($casino['promo_code']);
                            } else {
                            echo 'ไม่ต้องใช้รหัส';
                            }
                            ?>
                        </div>
                          <div class="games ezbox">
                            <div class="attribute-name">เกมที่มีให้บริการ:</div>
                            <div class="games-row">
                              <?php
                              if ($casino['games']) {
                                foreach ($casino['games'] as $game) {
                                  // Define the Thai name and image URL for each game type
                                  switch ($game) {
                                    case 'Slots':
                                      $game_name = 'สล็อต';
                                      $image_url = 'https://casinothai.vip/wp-content/uploads/2024/05/cherry.svg'; // Update this URL with the correct path
                                      break;
                                    case 'Table Games':
                                      $game_name = 'เกมโต๊ะ';
                                      $image_url = 'https://casinothai.vip/wp-content/uploads/2024/05/casino-games-1.svg'; // Update this URL with the correct path
                                      break;
                                    case 'Sports':
                                      $game_name = 'การพนันกีฬา';
                                      $image_url = 'https://casinothai.vip/wp-content/uploads/2024/05/sports.svg'; // Update this URL with the correct path
                                      break;
                                    case 'Live Dealer':
                                      $game_name = 'คาสิโนสด';
                                      $image_url = 'https://casinothai.vip/wp-content/uploads/2024/05/live-dealer.svg'; // Update this URL with the correct path
                                      break;
                                    case 'Fish Games':
                                      $game_name = 'เกมตกปลา';
                                      $image_url = 'https://casinothai.vip/wp-content/uploads/2024/05/fish.svg'; // Update this URL with the correct path
                                      break;
                                    case 'Esports':
                                      $game_name = 'อีสปอร์ต';
                                      $image_url = 'https://casinothai.vip/wp-content/uploads/2024/05/esports.svg'; // Update this URL with the correct path
                                      break;
                                    case 'Cockfight':
                                      $game_name = 'ชนไก่';
                                      $image_url = 'https://casinothai.vip/wp-content/uploads/2024/05/cockfight.svg'; // Update this URL with the correct path
                                      break;
                                    case 'Lottery':
                                      $game_name = 'ล็อตเตอรี่';
                                      $image_url = 'https://casinothai.vip/wp-content/uploads/2024/05/lotto.svg'; // Update this URL with the correct path
                                      break;
                                    case 'Quick Win':
                                      $game_name = 'ชนะด่วน';
                                      $image_url = 'https://casinothai.vip/wp-content/uploads/2024/05/instant-win.svg'; // Update this URL with the correct path
                                      break;
                                    default:
                                      $game_name = $game; // Default case to handle other games
                                      $image_url = 'https://casinothai.vip/wp-content/uploads/2024/05/cherry.svg'; // Provide a default image URL
                                      break;
                                  }

                                  echo '<div class="game-icon">';
                                  echo '<img src="' . $image_url . '" alt="' . esc_attr($game_name) . ' Icon" title="' . esc_attr($game_name) . '">';
                                  echo '</div>';
                                }
                              }
                              ?>
                            </div>
                          </div>
                     </div>
                      </div>
                    </div>
                  </div>
                </li>
                <?php endforeach; ?>
                </ul>
              </div>
          </section>


        <!-- Casino Games Section -->
        <section class="casino-games">
            <div class="wrap">
                <h2>ลองเล่นเกมคาสิโนออนไลน์ที่ดีที่สุด</h2>
                <p>ลองเล่นเกมคาสิโนออนไลน์ที่ดีที่สุดที่ CasinoThai.vip พร้อมให้คุณสัมผัสกับเกมยอดนิยมอย่างแบล็คแจ็ค, บาคาร่า, รูเล็ต, ซิกโบ, และไพ่เสือมังกร. เราได้คัดสรรเกมที่น่าตื่นเต้นและมีคุณภาพสูงสุดเพื่อให้คุณได้เพลิดเพลินกับประสบการณ์การเล่นเกมคาสิโนอย่างเต็มที่. ไม่ว่าคุณจะเป็นผู้เล่นมือใหม่หรือมีประสบการณ์, คาสิโนของเราพร้อมทั้งความสนุกและโอกาสในการชนะที่คุณไม่ควรพลาด!</p>
                <div class="nav-container">
                <nav class="hero-links normal-spacing">
                    <a href="/roulette-online/"><img class="button-img" src="https://casinothai.vip/wp-content/uploads/2024/05/roulette-1.webp" alt="รูเล็ต"> รูเล็ต</a>
                    <a href="/blackjack-online/"><img class="button-img" src="https://casinothai.vip/wp-content/uploads/2024/05/blackjack.webp" alt="แบล็คแจ็ค"> แบล็คแจ็ค</a>
                    <a href="/baccarat-online/"><img class="button-img" src="https://casinothai.vip/wp-content/uploads/2024/05/baccarat.webp" alt="บาคาร่า"> บาคาร่า</a>
                    <a href="/dragon-tiger-online/"><img class="button-img" src="https://casinothai.vip/wp-content/uploads/2024/05/dragon-tiger.webp" alt="ไพ่เสือมังกร"> ไพ่เสือมังกร</a>
                    <a href="/sic-bo-online/"><img class="button-img" src="https://casinothai.vip/wp-content/uploads/2024/05/sic-bo.webp" alt="ซิกโบ"> ซิกโบ</a>
                </nav>
                <div class="arrow-container">
                  <div class="arrow-icon arrow-left"></div>
                  <div class="arrow-icon arrow-right"></div>
                </div>
              </div>
            </div>
        </section>

        <!-- CasinoBonuses Section -->
        <section class="casinobonuses">
            <div class="wrap">
                <h2>โปรโมชั่นคาสิโนที่ทันสมัยและยุติธรรมเสมอ</h2>
                <p>บนเว็บไซต์ CasinoThai.vip เราได้รับ<a href="/bonuses/">ข้อเสนอจากคาสิโนออนไลน์</a>อย่างสม่ำเสมอ เราทดสอบเหล่านี้ด้วยตัวเองก่อนที่จะรวมไว้ในเว็บไซต์ของเรา นี่คือเพื่อให้แน่ใจว่าเราเสนอเพียงโบนัสที่ทันสมัยและมีเงื่อนไขที่ยุติธรรม</p>
                <p>นี่คือเหตุผลว่าทำไมคุณควรมองหาโบนัสคาสิโนเมื่อสมัครคาสิโน:</p>
                <ol>
                <li><p><strong>เพิ่มเงินทุน</strong>: โบนัสเช่นการฝากคู่สามารถเพิ่มเงินทุนเริ่มต้นของคุณอย่างมาก ให้เงินเพิ่มเติมในการเล่น ซึ่งสามารถยืดเวลาการเล่นของคุณโดยไม่ต้องลงทุนเพิ่มเติม</p>
                </li>
                <li><p><strong>ลดความเสี่ยง</strong>: สปินฟรี, เล่นฟรี หรือโบนัสที่ไม่ต้องฝากเงินช่วยให้ผู้เล่นเล่นเกมโดยไม่ต้องเสี่ยงเงินของตนเอง นี่อาจดึงดูดผู้เล่นใหม่ที่ต้องการทดลองเล่นเกมและได้รับประสบการณ์โดยไม่มีความเสี่ยงทางการเงิน</p>
                </li>
                <li><p><strong>โอกาสในการชนะเพิ่มขึ้น</strong>: ด้วยเงินทุนที่เพิ่มขึ้น ผู้เล่นสามารถเข้าร่วมเกมได้มากขึ้นหรือวางเดิมพันที่ใหญ่กว่าที่จะทำได้หากไม่มีโบนัส นี่อาจเพิ่มโอกาสในการชนะ</p>
                </li>
                <li><p><strong>ทดลองเกมใหม่</strong>: โบนัสมักมาพร้อมกับโอกาสในการทดลองเกมใหม่หรือเฉพาะที่ผู้เล่นอาจไม่ได้พิจารณามาก่อน สามารถเพิ่มประสบการณ์การเล่นเกมและทำให้เกมที่เล่นมีความหลากหลาย</p>
                </li>
                <li><p><strong>รางวัลความภักดี</strong>: คาสิโนออนไลน์จำนวนมากเสนอโบนัสความภักดีเป็นส่วนหนึ่งของโปรแกรมรางวัล ผู้เล่นประจำสามารถได้รับโบนัสเพิ่มเติมซึ่งอาจรวม</p>
                </li>
                </ol>
                <p>ถึงสปินฟรี, เงินคืน หรือสิทธิพิเศษอื่นๆ เพิ่มคุณค่าโดยรวมของการเล่นอย่างสม่ำเสมอ</p>
                <ol>
                <li><strong>ผลตอบแทนที่ดีขึ้น</strong>: การใช้โบนัสอย่างมีกลยุทธ์สามารถปรับปรุงผลตอบแทนจากการลงทุนของคุณ โดยใช้เงินของคาสิโนคุณสามารถเปลี่ยนโบนัสให้เป็นกำไรจริงในสถานการณ์ที่เหมาะสม</li>
                </ol>
                <p>อย่างไรก็ตาม สำคัญมากที่จะต้องอ่านเงื่อนไขที่เกี่ยวข้องกับโบนัสคาสิโนใดๆ ข้อกำหนดการเดิมพัน ขีดจำกัดการถอนเงิน และข้อจำกัดเกมสามารถส่งผลต่อประโยชน์จริงของโบนัส การเข้าใจเหล่านี้สามารถช่วยเพิ่มข้อได้เปรียบในขณะที่ลดข้อเสียที่อาจเกิดขึ้น</p>
                <p>สมัครรับข้อมูลจาก CasinoThai.vip และเราจะส่งโปรโมชั่นที่ดีที่สุดไปยังกล่องจดหมายของคุณ</p>

            </div>
        </section>

        <!-- About CasinoThai Section -->
        <section class="about">
            <div class="wrap">
                <h2>เกี่ยวกับ CasinoThai.vip</h2>
                <p>ยินดีต้อนรับสู่ CasinoThai.vip! ที่นี่เราเสนอรีวิวคาสิโน, โบนัสล่าสุด, และกลยุทธ์ที่เหมาะสำหรับทั้งผู้เล่นใหม่และผู้ที่มีประสบการณ์ในเมืองไทย. เป้าหมายของเราคือการนำเสนอข้อมูลที่โปร่งใสและมีประโยชน์เพื่อช่วยให้คุณเลือกคาสิโนออนไลน์ที่ดีที่สุด. สำรวจข้อเสนอโบนัสที่ไม่เหมือนใครและเพิ่มประสบการณ์การเล่นของคุณกับเรา - ทั้งหมดนี้ฟรี.</p>
            </div>
        </section>

        <!-- Contact Us Section -->
        <section class="contact">
            <div class="wrap">
                <h2>ติดต่อเรา</h2>
                <p>หากคุณมีคำถามหรือต้องการข้อมูลเพิ่มเติมเกี่ยวกับ CasinoThai.vip หรือต้องการส่งข้อเสนอแนะ, โปรดอย่าลังเลที่จะติดต่อเรา. เราพร้อมให้บริการและยินดีรับฟังทุกคำติชมเพื่อปรับปรุงบริการของเราให้ดียิ่งขึ้น. คุณสามารถเยี่ยมชมหน้า <a href="https://casinothai.vip/contact">ฟอร์มติดต่อ</a> เพื่อส่งข้อความโดยตรงไปยังทีมของเรา.</p>
            </div>
        </section>
    </main>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const detailsElements = document.querySelectorAll('.more-details, .more-details-mobile');

    detailsElements.forEach(function(element) {
        element.addEventListener('click', function() {
            this.classList.toggle('active');
            const casinoItem = this.closest('.casino-item');
            if (casinoItem) {
                casinoItem.classList.toggle('details-active'); // Toggle a class on the .casino-item
            }
        });
    });
});
</script>

<?php get_footer(); ?>