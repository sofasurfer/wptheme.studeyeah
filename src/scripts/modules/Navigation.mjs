/**
 * Responsible for adding "open" classes to submenus with children when clicked or currently active page
 *
 * @class Navigation
 */
class Navigation {

    constructor(navigation = '.c-offcanvas-nav-list') {
        this.navigations = document.querySelectorAll(navigation) || [];
        this.scrollPos = 0;
        this.init()
    }

    init() {
        for (let navigation of this.navigations) {

            // const lists = navigation.querySelectorAll('.menu-item');

            // for (let list of lists) {
            //     this.setupToggle(list);
            //     this.copyMainAnchorToSubmenu(list);
            //     this.openCurrentlyActiveLists(list);
            // }

            var offcanvasElements = document.querySelectorAll('.c-offcanvas-trigger');
            if(offcanvasElements){
                offcanvasElements.forEach(offcanvas => {
                    offcanvas.addEventListener('click', (event) => this.handleOffcanvas(event));
                });            
            }
        }
    }

    /**
     * @param list {HTMLElement}
     * @returns {boolean} fail or success
     */
    setupToggle(list) {
        const className = 'menu-item-has-children'
        const anchor = list.querySelector('a')

        if (!list.classList.contains(className)) {
            return false
        }

        list.addEventListener('click', (event) => {
            if (event.target === anchor) {
                event.preventDefault()
            }

            list.classList.toggle('c-is-open')
        })

        return true
    }

    /**
     * @param list {HTMLElement}
     * @returns {boolean} fail or success
     */
    openCurrentlyActiveLists(list) {
        const isCurrent = list.classList.contains('current-menu-item') || list.classList.contains('current_page_item')
        const hasChildrenClass = list.classList.contains('menu-item-has-children')
        const isParent = list.classList.contains('current-menu-parent') || list.classList.contains('current-menu-ancestor')

        if (isParent) {
            list.classList.add('c-is-open')
            return true
        } else if (hasChildrenClass && isCurrent) {
            list.classList.add('c-is-open')
            return true
        }

        return false
    }

    /**
     * @param list {HTMLElement}
     * @returns {boolean} fail or success
     */
    copyMainAnchorToSubmenu(list) {
        const anchor = list.querySelector('a')
        const submenuChild = list.querySelector('.sub-menu')

        if (!submenuChild) {
            return false
        }

        const clone = anchor.cloneNode(true)
        const li = document.createElement('li')
        li.appendChild(clone)
        submenuChild.insertBefore(li, submenuChild.firstChild)

        return true
    }

    handleOffcanvas(event){
        event.preventDefault(); 
        var offcanvas = document.getElementById('open-navigation');
        if( offcanvas.classList.contains('open') ){
            offcanvas.classList.remove('open');
        }else{
            this.scrollPos = window.scrollY;
            offcanvas.classList.add('open');
        }
    }
}

export default Navigation;