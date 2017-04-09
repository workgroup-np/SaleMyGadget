<?php
/**
 * Contribute
 */
?>

<div id="contribute" class="sale-my-gadget-tab-pane">

	<h1><?php esc_html_e( 'How can I contribute?', 'sale-my-gadget' ); ?></h1>

	<hr/>

	<div class="sale-my-gadget-tab-pane-half sale-my-gadget-tab-pane-first-half">

		<p><strong><?php esc_html_e( 'Found a bug? Want to contribute with a fix?','sale-my-gadget'); ?></strong></p>

		<p><?php esc_html_e( 'Contact form is the place to go!','sale-my-gadget' ); ?></p>

		<p>
			<a href="<?php echo esc_url( 'http://themes4wp.com/contact/' ); ?>" class="contribute-button button button-primary"><?php printf( esc_html__( '%s contact form', 'sale-my-gadget' ), 'Alpha Store' ); ?></a>
		</p>

		<hr>

	</div>
	<div class="sale-my-gadget-tab-pane-half">

		<p><strong><?php printf( esc_html__( 'Are you a polyglot? Want to translate %s into your own language?', 'sale-my-gadget' ), 'Alpha Store' ); ?></strong></p>

		<p><?php esc_html_e( 'Get involved at WordPress.org.', 'sale-my-gadget' ); ?></p>

		<p>
			<a href="<?php echo esc_url( 'https://translate.wordpress.org/projects/wp-themes/sale-my-gadget/' ); ?>" class="translate-button button button-primary"><?php printf( esc_html__( 'Translate %s', 'sale-my-gadget' ), 'Alpha Store' ); ?></a>
		</p>

	</div>

	<div>

		<h4><?php printf( esc_html__( 'Are you enjoying %s?', 'sale-my-gadget' ), 'Alpha Store' ); ?></h4>

		<p class="review-link"><?php printf( esc_html__( 'Rate our theme on %s. We\'d really appreciate it!', 'sale-my-gadget' ), '<a href="https://wordpress.org/support/view/theme-reviews/sale-my-gadget?filter=5">' . esc_html( 'WordPress.org', 'sale-my-gadget' ) . '</a>' ); ?></p>

		<p><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></p>

	</div>

</div>
