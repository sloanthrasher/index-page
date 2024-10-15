/*
	=======================================================================================================
	This code snippet is a JavaScript function called `cstidx_generateIdx`.It takes two parameters: 
	`selectors` and`prefixChar`.The `selectors` parameter is a string of CSS selectors, and`prefixChar` is 
	an optional parameter that defaults to the character`'─'`.

	The function first checks if the`selectors` parameter is falsy or an empty string.If it is, it sets the 
	`selectors` to`'h1, h2, h3, h4, h5, h6'`.

	Next, it splits the `selectors` string into an array of individual selectors using the `,` as the 
	separator. It then clears the content of the element with the ID 'cstidx_pg_idx_list .cstidx-idx-container'.

	The function then initializes two variables: `uniqueCounter` and`elements`. `uniqueCounter` is used to 
	generate unique IDs for elements, and`elements` is an array to store the elements in the correct order.

	The function then iterates over the `selectorArray` and uses jQuery to find all elements that match 
	each selector.It pushes each element along with its level (based on the position of the selector in the
	`selectorArray`) and its original order in the DOM(using the `index()` function) into the `elements` array.

	After sorting the `elements` array based on the order of appearance in the DOM, the function defines a 
	helper function `getPrefix` to generate a prefix based on the level.

	Next, it iterates over the sorted `elements` array and creates a hierarchical list.For each element, it 
	generates a unique ID, sets it, creates a list item div, and appends it to the container.

	Finally, it adds an event listener to the container for click events on anchor tags.When an anchor tag 
	is clicked, it prevents the default behavior, retrieves the target ID, finds the matching element, and 
	animates the scroll to the element's position.

	Overall, this function generates a hierarchical index based on the provided CSS selectors and prefix 
	character.
	=======================================================================================================
*/
function cstidx_generateIdx(selectors, prefixChar = '─') {
	// Set default selectors if none are provided or if it's empty
	if (!selectors || selectors.trim() === '') {
		selectors = 'h1, h2, h3, h4, h5, h6';
	}

	// Split the selectors into an array
	const selectorArray = selectors.split(',').map(sel => sel.trim());
	const container = jQuery('#cstidx_pg_idx_list .cstidx-idx-container');
	container.empty(); // Clear any existing content

	// Initialize variables for tracking elements and unique IDs
	let uniqueCounter = 0; // Counter for generating unique IDs
	let elements = []; // Array to store elements in the correct order

	// Collect all elements matching the selectors and their corresponding level
	selectorArray.forEach((selector, index) => {
		jQuery(selector).each(function () {
			elements.push({
				element: jQuery(this),
				level: index + 1, // Determine level based on the selector's position
				domIndex: jQuery(this).index() // Track the original order in the DOM
			});
		});
	});

	// Sort the elements array by their order of appearance in the DOM
	elements.sort((a, b) => a.element.offset().top - b.element.offset().top);

	// Function to generate the prefix based on the level
	function getPrefix(level) {
		if (level <= 1) return ''; // No prefix for the first level
		return Array((level - 1) * 2).fill(prefixChar).join('');
	}

	// Iterate over the sorted elements array to create the hierarchical list
	elements.forEach(item => {
		const $element = item.element;
		const tagText = $element.text().trim();
		const elementLevel = item.level;

		// Generate a unique ID for the element and set it
		const uniqueId = `cstidx_${String(uniqueCounter).padStart(3, '0')}`;
		$element.attr('id', uniqueId);
		uniqueCounter++; // Increment the unique counter

		// Create the list item div
		const $listItem = jQuery('<div/>', {
			class: `cstidx-item-${elementLevel}`,
			html: `<a href="#${uniqueId}" name="${uniqueId}"><div class="cstidx-item-div"><div class="cstidx-prefix">${getPrefix(elementLevel)}</div><div class="cstidx-anchor">${tagText}</div></div></a>`
		});

		// Append the list item to the container
		container.append($listItem);
	});

	// Corrected on-click event handler to scroll to the target anchor
	container.on('click', 'a', function (e) {
		e.preventDefault();

		const targetId = jQuery(this).attr('href'); // Get the href, which is the target ID (e.g., "#cstidx_001")
		const targetElement = jQuery(targetId); // Use the target ID to find the matching element

		if (targetElement.length) {
			// Animate the scroll to the element's position
			jQuery('html, body').animate({
				scrollTop: targetElement.offset().top - 40 // Adjust this offset as needed based on the average height of the target elements.
			}, 750); // Set the duration (750ms)
		}
	});
}

jQuery(document).ready(function () {
	jQuery('.click_on_right, .click_on_left, .click_top_left, .click_top_right, .click_bottom_left, .click_bottom_right').click(function (ev) {
		// Get the parent element
		var parent = jQuery(this).parent();

		var idx = jQuery('#cstidx_pg_idx_list');
		// Reset all styles before applying new ones
		jQuery(idx).css({
			'position': 'relative',
			'float': 'none',
			'top': '',
			'bottom': '',
			'left': '',
			'right': ''
		});

		// Check if the clicked element has the target class or if its grandparent has the class
		var target = jQuery(ev.currentTarget);
		var targetClassElement = target.hasClass('click_on_right') || target.hasClass('click_on_left') ||
			target.hasClass('click_top_right') || target.hasClass('click_top_left') ||
			target.hasClass('click_bottom_right') || target.hasClass('click_bottom_left')
			? target : parent;

		if (targetClassElement.hasClass('click_on_right')) {
			jQuery(idx).css({
				'right': '0',
				'float': 'right'
			});
		} else if (targetClassElement.hasClass('click_on_left')) {
			jQuery(idx).css({
				'left': '0',
				'float': 'left'
			});
		} else if (targetClassElement.hasClass('click_top_right')) {
			jQuery(idx).css({
				'top': '40px',
				'right': '0',
				'position': 'fixed'
			});
		} else if (targetClassElement.hasClass('click_top_left')) {
			jQuery(idx).css({
				'top': '40px',
				'left': '0',
				'position': 'fixed'
			});
		} else if (targetClassElement.hasClass('click_bottom_right')) {
			jQuery(idx).css({
				'bottom': '10px',
				'right': '0',
				'position': 'fixed'
			});
		} else if (targetClassElement.hasClass('click_bottom_left')) {
			jQuery(idx).css({
				'bottom': '10px',
				'left': '0',
				'position': 'fixed'
			});
		} else {
			jQuery(idx).css({
				'right': '0',
				'float': 'right'
			});
		}
	});
});
