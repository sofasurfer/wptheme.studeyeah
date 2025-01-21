export default class LazyLoadImages {

    constructor() {
        this.setupLazyLoading()
    }

    setupLazyLoading() {
        // Run after the HTML document has finished loading
        // Get our lazy-loaded images
        let lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));

        // Do this only if IntersectionObserver is supported
        if ("IntersectionObserver" in window) {
            // Create new observer object
            let lazyImageObserver = new IntersectionObserver(function (entries, observer) {
                // Loop through IntersectionObserverEntry objects
                entries.forEach(function (entry) {
                    // Do these if the target intersects with the root
                    if (entry.isIntersecting) {
                        let lazyImage = entry.target;
                        lazyImage.src = lazyImage.dataset.src;
                        lazyImage.srcset = lazyImage.dataset.srcset;
                        lazyImage.classList.remove("lazy");
                        lazyImageObserver.unobserve(lazyImage);
                    }
                });
            });

            // Loop through and observe each image
            lazyImages.forEach(function (lazyImage) {
                lazyImageObserver.observe(lazyImage);
            });
        }
    }
}