// Alpine.js functionality if needed in a separate file
document.addEventListener('alpine:init', () => {
    Alpine.data('modal', () => ({
        open: false,
        toggle() {
            this.open = !this.open;
        }
    }));
});
