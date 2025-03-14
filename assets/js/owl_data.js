$(document).ready(function() {
				$("#owl-demo").owlCarousel({
					autoPlay: 3000,
					navigation: true,
					slideSpeed: 300,
					paginationSpeed: 400,
					singleItem: true
				});
				$("#owl-demo2").owlCarousel({
					autoPlay: 3000,
					items: 4,
					itemsDesktop: [1199, 3],
					itemsDesktopSmall: [979, 3]
				});


				$("#owl-demo3").owlCarousel({
					autoPlay: 3000,
					items: 1,
					itemsDesktop: [1199, 3],
					itemsDesktopSmall: [1002, 3]
				});
			});