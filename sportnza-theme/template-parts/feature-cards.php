<?php
/**
 * Template part: Feature cards section (4 feature cards).
 *
 * @package Sportnza
 */
?>
<section class="feature-cards-section">
    <div class="container">
        <div class="feature-cards-grid">

            <div class="feature-card">
                <img src="<?php echo esc_url( SPORTNZA_URI . '/assets/images/SPORTS.svg' ); ?>" alt="<?php echo esc_attr( sportnza_t( 'Multi-Sports Action' ) ); ?>" class="feature-card-icon">
                <h3 class="feature-card-title"><?php echo esc_html( sportnza_t( 'Multi-Sports Action' ) ); ?></h3>
                <p class="feature-card-text"><?php echo esc_html( sportnza_t( 'Bet on football, basketball, tennis, and dozens more sports from leagues around the world. Live odds updated in real time.' ) ); ?></p>
                <a href="#" class="feature-card-link"><?php echo esc_html( sportnza_t( 'Explore Sports' ) ); ?> &rarr;</a>
            </div>

            <div class="feature-card">
                <img src="<?php echo esc_url( SPORTNZA_URI . '/assets/images/LIVE.svg' ); ?>" alt="<?php echo esc_attr( sportnza_t( 'Live Casino Games' ) ); ?>" class="feature-card-icon">
                <h3 class="feature-card-title"><?php echo esc_html( sportnza_t( 'Live Casino Games' ) ); ?></h3>
                <p class="feature-card-text"><?php echo esc_html( sportnza_t( 'Experience the thrill of real-time casino action with live dealers. Roulette, blackjack, baccarat, and more at your fingertips.' ) ); ?></p>
                <a href="#" class="feature-card-link"><?php echo esc_html( sportnza_t( 'Play Live' ) ); ?> &rarr;</a>
            </div>

            <div class="feature-card">
                <img src="<?php echo esc_url( SPORTNZA_URI . '/assets/images/FANTASY.svg' ); ?>" alt="<?php echo esc_attr( sportnza_t( 'Fantasy League Fun' ) ); ?>" class="feature-card-icon">
                <h3 class="feature-card-title"><?php echo esc_html( sportnza_t( 'Fantasy League Fun' ) ); ?></h3>
                <p class="feature-card-text"><?php echo esc_html( sportnza_t( 'Build your dream team, compete against friends, and climb the leaderboard. Daily and weekly fantasy contests available.' ) ); ?></p>
                <a href="#" class="feature-card-link"><?php echo esc_html( sportnza_t( 'Start Playing' ) ); ?> &rarr;</a>
            </div>

            <div class="feature-card">
                <img src="<?php echo esc_url( SPORTNZA_URI . '/assets/images/VIP.svg' ); ?>" alt="<?php echo esc_attr( sportnza_t( 'Player Rewards' ) ); ?>" class="feature-card-icon">
                <h3 class="feature-card-title"><?php echo esc_html( sportnza_t( 'Player Rewards' ) ); ?></h3>
                <p class="feature-card-text"><?php echo esc_html( sportnza_t( 'Earn points on every wager and unlock exclusive bonuses, cashback offers, and VIP perks as you level up your account.' ) ); ?></p>
                <a href="#" class="feature-card-link"><?php echo esc_html( sportnza_t( 'View Rewards' ) ); ?> &rarr;</a>
            </div>

        </div>
    </div>
</section>
