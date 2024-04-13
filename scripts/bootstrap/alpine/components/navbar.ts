import Alpine from "alpinejs";

Alpine.data('navbar', () => ({
    open: false,
    toggle() {
        this.open = !this.open;
    },
    init() {
    }
}));