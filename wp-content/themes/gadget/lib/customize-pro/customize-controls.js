( function( api ) {

	// Extends our custom "sale-my-gadget" section.
	api.sectionConstructor['sale-my-gadget'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
