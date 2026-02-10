<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <?php sportnza_logo(); ?>

            <div class="footer-social">
                <a href="#" aria-label="<?php esc_attr_e( 'Follow us on X', 'sportnza' ); ?>" target="_blank" rel="noopener noreferrer">
                    <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                    </svg>
                </a>
            </div>

            <nav class="footer-links">
                <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Us', 'sportnza' ); ?></a>
            </nav>

            <p class="copyright"><?php printf( 'Copyright &copy; %s Sportaza is a legally recognized trademark. All Rights Reserved.', esc_html( date( 'Y' ) ) ); ?></p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
